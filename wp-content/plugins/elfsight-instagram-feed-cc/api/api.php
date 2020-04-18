<?php

namespace ElfsightInstagramFeedApi;

if (!defined('ABSPATH')) exit;

require_once 'vendor/autoload.php';

class Api extends Core\Api {
    private $routes = array(
        '/media/shortcode/{shortcode}' => 'shortcode',
        '/users/{username}/media/recent' => 'userMedia',
        '/users/{username}' => 'user',
        '/tags/{tag}/media/recent' => 'tagMedia',
        '/locations/{tag}/media/recent' => 'locationMedia'
    );

    public $path;

    public $limit;
    public $count;
    public $maxId;

    public $cacheKey;

    public $rhxGis;
    public $csrfToken;

    public $Format;
    public $Endpoint;

    public $metaInfo = array();

    public function __construct($config) {
        parent::__construct($config, $this->routes);

        self::$client = array(
            'base_url' => 'https://www.instagram.com',
            'headers' => array(
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36',
                'Origin' => 'https://www.instagram.com',
                'Referer' => 'https://www.instagram.com',
                'Connection' => 'close'
            ),
            'cookies' => array(
                'ig_or' => 'landscape-primary',
                'ig_pr' => '1',
                'ig_vh' => 1080,
                'ig_vw' => 1920
            )
        );

        $this->routes = $this->route($this->routes);

        $this->limit = !empty($config['media_limit']) ? $config['media_limit'] : 100;

        $this->Format = new Format($this);
        $this->Endpoint = new Endpoint($this, self::$client);
    }

    public function run() {
        $handler_name = null;
        $handler_params = null;

        $this->path = $this->input('path', '', false);
        $this->count = $this->input('count', 33);

        foreach ($this->routes as $r) {
            $params_matches = array();

            if (preg_match('#^' . $r['regex'] . '#', preg_replace('#(.*)\/$#', '$1', $this->path), $params_matches)) {
                $handler_name = $r['handler'];
                $handler_params = array_slice($params_matches, 1);
                break;
            }
        }

        if (empty($handler_name) || !method_exists($this->Endpoint, $handler_name)) {
            $this->error(400, esc_html__('invalid request'), esc_html__('requested route not found'));
        }

        if ($handler_params[0]) {
            $handler_params[0] = urldecode($handler_params[0]);
        }

        return call_user_func(array($this->Endpoint, $handler_name), $handler_params[0]);
    }

    function route($list) {
        $map = array();

        foreach ($list as $path => $handler_name) {
            $map[] = array(
                'regex' => str_replace('/', '\/', preg_replace('#\{[^\{]+\}#', '([^/$]+)', $path)),
                'handler' => $handler_name
            );
        }

        return $map;
    }

    public function checkResponse($response, $exit) {
        if (!$response['status']) {
            return $exit ? $this->error(400, null, $response) : false;

        } else {
            if ($response['http_code'] !== '200') {
                if ($exit) {
                    return $this->error($response['http_code'], null, $response['http_message']);
                } else {
                    $this->metaInfo['query_err'] = $response['http_code'];
                    return false;
                }
            }
        }

        return true;
    }

    public function getPageData($response_body) {
        if (!preg_match('#window\._sharedData\s?=\s?(.*);<\/script>#', $response_body, $page_data_matches)) {
            return $this->subError('parse error');
        }

        $page_data = json_decode($page_data_matches[1], true);

        if (empty($page_data) || empty($page_data['entry_data'])) {
            return $this->subError(esc_html__('empty page data'));
        }

        $this->rhxGis = isset($page_data['rhx_gis']) ? $page_data['rhx_gis'] : '';
        $this->csrfToken = $page_data['config']['csrf_token'];

        return $page_data['entry_data'];
    }

    public function getEntryData($page_data, $path, $exit = true) {
        $entry = $page_data;

        for ($i = 0; $i < count($path); $i++) {
            if (!isset($entry[$path[$i]])) {
                return $exit ? $this->subError(esc_html__('empty entry tree data')) : false;
            } else {
                $entry = $entry[$path[$i]];
            }
        }

        if (isset($entry['is_private']) && $entry['is_private']) {
            return $this->subError(esc_html__('you cannot view this resource'));
        }

        if (empty($entry)) {
            return $exit ? $this->subError(esc_html__('empty entry data')) : false;
        } else {
            return $entry;
        }
    }

    public function getNodesData($query_body_json) {
        $nodes = array();
        $end_cursor = false;

        $query_body = json_decode($query_body_json, true);
        $data = $query_body['data'];

        if ($data) {
            if (isset($data['user'])) {
                $nodes = $data['user']['edge_owner_to_timeline_media']['edges'];
                $end_cursor = $this->setEndCursor($data['user']['edge_owner_to_timeline_media']);

            } else if (isset($data['hashtag'])) {
                $nodes = $data['hashtag']['edge_hashtag_to_media']['edges'];
                $end_cursor = $this->setEndCursor($data['hashtag']['edge_hashtag_to_media']);

            } else if (isset($data['location'])) {
                $nodes = $data['location']['edge_location_to_media']['edges'];
                $end_cursor = $this->setEndCursor($data['location']['edge_location_to_media']);

            }
        }

        return array($this->Format->formatNodes($nodes), $end_cursor, count($nodes));
    }

    public function recursiveQueryRequest($cache_key, $variables, $query_hash, $formatted_data = array(), $cursor = 0) {
        $query_res = $this->queryRequest($variables, $query_hash);

        if ($this->checkResponse($query_res, false)) {
            list($nodes, $end_cursor, $count) = $this->getNodesData($query_res['body']);

            $formatted_data = $this->Helper->uniqueSort(array_merge_recursive($formatted_data, $nodes), 'created_time');
            $formatted_data = array_slice($formatted_data, 0, $this->limit);

            $cursor += $count;

            if ($count < $variables['first'] || $cursor >= $this->limit) {
                $this->Cache->set($cache_key, $formatted_data, false);

                return $formatted_data;
            } else {
                sleep(1);
                $variables['after'] = $end_cursor;

                return $this->recursiveQueryRequest($cache_key, $variables, $query_hash, $formatted_data, $cursor);
            }
        } else {
            $this->Cache->set($cache_key, $formatted_data, true);

            return $formatted_data;
        }
    }

    function queryRequest($variables, $query_hash) {
        $variables_json = json_encode($variables);
        $gis = md5(join(':', array($this->rhxGis, $variables_json)));

        if (class_exists($this->Throttle)) {
            $this->Throttle->increment();
        }

        return $this->request('get', self::$client['base_url'] . '/graphql/query/', array(
            'query' => array(
                'query_hash' => $query_hash,
                'variables' => $variables_json
            ),
            'headers' => array(
                'X-Csrftoken' => $this->csrfToken,
                'X-Requested-With' => 'XMLHttpRequest',
                'X-Instagram-Ajax' => '1',
                'X-Instagram-Gis' => $gis
            )
        ));
    }

    public function setEndCursor($data) {
        if (!empty($data['page_info']) && !empty($data['page_info']['end_cursor'])) {
            return $data['page_info']['end_cursor'];
        }
    }

    public function paginate($list, $cursor) {
        $media_from_offset = 0;

        if ($this->maxId) {
            foreach ($list as $k => $item) {
                if ($item['id'] == $this->maxId) {
                    $media_from_offset = $k + 1;
                    break;
                }
            }
        }

        $pagination = null;
        $page_list = array_slice($list, $media_from_offset, $this->count);

        $next_media_offset = $media_from_offset + $this->count;

        if (!empty($list[$next_media_offset])) {
            $page_last_item = end($page_list);

            $pagination = array(
                'next_url' => $this->getNextPageUrl($page_last_item['id'], $cursor),
                'next_' . $cursor => $page_last_item['id']
            );
        }

        return array($page_list, $pagination);
    }

    public function fallbackCache($cache, $data) {
        if (!empty($data)) {
            return $data;
        }

        $cache_data = $this->Cache->get($cache['key'], false);

        if (!empty($cache_data)) {
            $this->metaInfo['fallback_cache'] = $cache['expired'];
            return json_decode($cache_data, true);
        } else {
            if (isset($this->metaInfo['throttle_limited'])) {
                return $data;
            } else {
                return $this->subError(esc_html__('storage empty'));
            }
        }
    }

    public function getNextPageUrl($next_id, $cursor) {
        $params = $_GET;
        $params[$cursor] = $next_id;

        return $this->path . ($params ? '?' . http_build_query($params): '');
    }

    public function getMeta($code) {
        $meta = array(
            'code' => $code
        );

        foreach ($this->metaInfo as $key => $value) {
            !!$value && $meta[$key] = $value;
        }

        return $meta;
    }
}
