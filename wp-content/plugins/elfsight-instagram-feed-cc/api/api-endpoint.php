<?php

namespace ElfsightInstagramFeedApi;


class Endpoint {
    private $Api;

    private $client;

    public function __construct($Api, $client) {
        $this->Api = $Api;

        $this->client = $client;
    }

    public function userMedia($username) {
        $data = array();

        $cache_key = '@' . $username . '_media';
        $cache_expired = $this->Api->Cache->expired($cache_key);

        $this->Api->maxId = $this->Api->input('max_id', null, false);
        $this->Api->metaInfo['throttle_limited'] = $limited = false;

        if (class_exists($this->Api->Throttle)) {
            $this->Api->metaInfo['throttle_limited'] = $limited = $this->Api->Throttle->isLimited();
        }

        if ($cache_expired && !$limited) {
            $page_res = $this->Api->request('get', $this->client['base_url'] . '/' . $username . '/');

            if (class_exists($this->Api->Throttle)) {
                $this->Api->Throttle->increment();
            }
            $this->Api->checkResponse($page_res, true);

            $page_data = $this->Api->getPageData($page_res['body']);
            $user_data = $this->Api->getEntryData($page_data, array('ProfilePage', '0', 'graphql', 'user'));
            $nodes = $user_data['edge_owner_to_timeline_media']['edges'];

            $this->Api->user = $this->Api->Format->formatUser($user_data);
            $page_formatted_data = $this->Api->Format->formatNodes($nodes);

            $data = $this->Api->recursiveQueryRequest(
                $cache_key,
                array(
                    'id' => $user_data['id'],
                    'first' => 50
                ),
                'f2405b236d85e8296cf30347c9f08c2a',
                $page_formatted_data,
                count($page_formatted_data)
            );
        }

        $result = $this->Api->fallbackCache(array('key' => $cache_key, 'expired' => $cache_expired), $data);
        list ($result_page, $pagination) = $this->Api->paginate($result, 'max_id');
        return $this->Api->response(array(
            'meta' => $this->Api->getMeta(200),
            'pagination' => $pagination,
            'data' => $result_page
        ));
    }

    function tagMedia($tag) {
        $data = array();

        $cache_key = '#' . $tag;
        $cache_expired = $this->Api->Cache->expired($cache_key);

        $this->Api->maxId = $this->Api->input('max_tag_id', null, false);
        $this->Api->metaInfo['throttle_limited'] = $limited = false;

        if (class_exists($this->Api->Throttle)) {
            $this->Api->metaInfo['throttle_limited'] = $limited = $this->Api->Throttle->isLimited();
        }

        if ($cache_expired && !$limited) {
            $page_res = $this->Api->request('get', $this->client['base_url'] . '/explore/tags/' . $tag . '/');

            if (class_exists($this->Api->Throttle)) {
                $this->Api->Throttle->increment();
            }
            $this->Api->checkResponse($page_res, true);

            $page_data = $this->Api->getPageData($page_res['body']);
            $hashtag_data = $this->Api->getEntryData($page_data, array('TagPage', '0', 'graphql', 'hashtag'));
            $nodes = array_merge_recursive(
                $hashtag_data['edge_hashtag_to_top_posts']['edges'],
                $hashtag_data['edge_hashtag_to_media']['edges']
            );

            $page_formatted_data = $this->Api->Format->formatNodes($nodes, 'hashtag');

            $data = $this->Api->recursiveQueryRequest(
                $cache_key,
                array(
                    'tag_name' => $tag,
                    'first' => 50
                ),
                'f92f56d47dc7a55b606908374b43a314',
                $page_formatted_data,
                count($page_formatted_data)
            );
        }

        $result = $this->Api->fallbackCache(array('key' => $cache_key, 'expired' => $cache_expired), $data);
        list ($result_page, $pagination) = $this->Api->paginate($result, 'max_tag_id');
        return $this->Api->response(array(
            'meta' => $this->Api->getMeta(200),
            'pagination' => $pagination,
            'data' => $result_page
        ));
    }

    function locationMedia($location_id) {
        $data = array();

        $cache_key = '&' . $location_id;
        $cache_expired = $this->Api->Cache->expired($cache_key);

        $this->Api->maxId = $this->Api->input('max_id', null, false);
        $this->Api->metaInfo['throttle_limited'] = $limited = false;

        if (class_exists($this->Api->Throttle)) {
            $this->Api->metaInfo['throttle_limited'] = $limited = $this->Api->Throttle->isLimited();
        }

        if ($cache_expired && !$limited) {
            if (class_exists($this->Api->Throttle)) {
                $this->Api->Throttle->increment();
            }

            $data = $this->Api->recursiveQueryRequest(
                $cache_key,
                array(
                    'id' => $location_id,
                    'first' => 50
                ),
                '1b84447a4d8b6d6d0426fefb34514485'
            );
        }

        $result = $this->Api->fallbackCache(array('key' => $cache_key, 'expired' => $cache_expired), $data);
        list ($result_page, $pagination) = $this->Api->paginate($result, 'max_tag_id');
        return $this->Api->response(array(
            'meta' => $this->Api->getMeta(200),
            'pagination' => $pagination,
            'data' => $result_page
        ));
    }

    function shortcode($shortcode) {
        $data = array();

        $cache_key = '&' . $shortcode;
        $cache_expired = $this->Api->Cache->expired($cache_key);

        if ($cache_expired) {
            $page_res = $this->Api->request('get', $this->client['base_url'] . '/p/' . $shortcode . '/?__a=1');

            $this->Api->checkResponse($page_res, true);

            $page_data = json_decode($page_res['body'], true);
            $shortcode_data = $this->Api->getEntryData($page_data, array('graphql', 'shortcode_media'));

            $data = $this->Api->Format->formatMedia($shortcode_data);

            $this->Api->Cache->set($cache_key, $data);
        }

        $result = $this->Api->fallbackCache(array('key' => $cache_key, 'expired' => $cache_expired), $data);
        return $this->Api->response(array(
            'meta' => $this->Api->getMeta(200),
            'data' => $result
        ));
    }

    function user($username) {
        $data = array();

        $cache_key = '@' . $username . '_profile';
        $cache_expired = $this->Api->Cache->expired($cache_key);

        if ($cache_expired) {
            $page_res = $this->Api->request('get', $this->client['base_url'] . '/' . $username . '/');

            $this->Api->checkResponse($page_res, true);

            $page_data = $this->Api->getPageData($page_res['body']);
            $user_data = $this->Api->getEntryData($page_data, array('ProfilePage', '0', 'graphql', 'user'));

            $data = $this->Api->Format->formatUser($user_data);

            $this->Api->Cache->set($cache_key, $data);
        }

        $result = $this->Api->fallbackCache(array('key' => $cache_key, 'expired' => $cache_expired), $data);
        return $this->Api->response(array(
            'meta' => $this->Api->getMeta(200),
            'data' => $result
        ));
    }
}
