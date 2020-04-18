<?php

namespace ElfsightInstagramFeedApi\Core;


if (!defined('PHP_VERSION_ID')) {
    $version = explode('.', PHP_VERSION);

    define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
}


abstract class Api {
    public $Helper;
    public $Cache;
    public $Throttle;
    public $User;

    public $pluginSlug;
    public $pluginFile;

    private $proxy;

    private $routes;

    public static $client;

    public function __construct($config, $routes) {
        $this->pluginSlug = $config['plugin_slug'];
        $this->pluginFile = $config['plugin_file'];

        $this->proxy = $this->setProxy($config);

        $this->routes = $routes;

        // @TODO static Helper
        $this->Helper = new Helper($this->pluginSlug);
        $this->Cache = new Cache($this->Helper, $config);

        $this->initOptions($config);

        if (isset($config['use']) && in_array('throttle', $config['use'])) {
            $this->Throttle = new Throttle($this->Helper, $config);
        }

        if (isset($config['use']) && in_array('user', $config['use'])) {
            $this->User = new User($this->Helper, $config);
        }

        add_action('wp_ajax_nopriv_' . $this->Helper->getOptionName('api'), array($this, 'run'));
        add_action('wp_ajax_' . $this->Helper->getOptionName('api'), array($this, 'run'));
    }

    public function initOptions($config) {
        if (class_exists('\ElfsightInstagramFeedApi\Options')) {
            new \ElfsightInstagramFeedApi\Options($this->Helper, $config);
        } else {
            new \ElfsightInstagramFeedApi\Core\Options($this->Helper, $config);
        }
    }

    public function run() {
        $method = $this->input('method', '', false);

        $route = $this->routes[$method];

        if (empty($route) || !method_exists($this, $route)) {
            $this->error(400, 'invalid request', 'requested route not found');
        }

        return call_user_func(array($this, $route));
    }

    public function request($type, $url, $options = array()) {
        $type = strtoupper($type);

        $curl = curl_init();

        $request_url = $url;

        if (!empty($options['query'])) {
            $request_url .= '?' . http_build_query($options['query']);
        }

        $curl_options = array(
            CURLOPT_URL            => $request_url,
            CURLOPT_HEADER         => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CONNECTTIMEOUT => 15,
            CURLOPT_TIMEOUT        => 60,
            CURLOPT_FOLLOWLOCATION => !empty($options['follow']) && $options['follow'],
            CURLOPT_HTTPHEADER     => $this->getHeadersList($options),
            CURLOPT_PROXY          => $this->proxy['url'],
            CURLOPT_PROXYUSERPWD   => $this->proxy['credentials']
        );

        curl_setopt_array($curl, $curl_options);

        $response = curl_exec($curl);
        $info     = curl_getinfo($curl);
        $error    = curl_error($curl);

        curl_close($curl);

        if ($info['http_code'] === 0) {
            $this->error(400, 'transport error', $error);
        }

        return $this->requestResponse($response);
    }

    private function getHeadersList($options = array()) {
        $headers_raw_list = array();
        $cookies_raw_list = array();

        $cookies = !empty(self::$client['cookies']) ? self::$client['cookies'] : array();
        $headers = !empty(self::$client['headers']) ? self::$client['headers'] : array();

        if (!empty($options['cookies'])) {
            $cookies = $this->Helper->arrayMergeAssoc($cookies, $options['cookies']);
        }

        if (isset($options['headers'])) {
            $headers = $this->Helper->arrayMergeAssoc($headers, $options['headers']);
        }

        foreach ($cookies as $cookie_name => $cookie_value) {
            $cookies_raw_list[] = $cookie_name . '=' . $cookie_value;
        }
        unset($cookie_name, $cookie_data);

        $headers['Cookie'] = implode('; ', $cookies_raw_list);

        foreach ($headers as $header_key => $header_value) {
            $headers_raw_list[] = $header_key . ': ' . $header_value;
        }
        unset($header_key, $header_value);

        return $headers_raw_list;
    }

    public function requestResponse($response_str) {
        @list ($response_headers_str, $response_body_encoded, $alt_body_encoded) = explode("\r\n\r\n", $response_str);

        if ($alt_body_encoded) {
            $response_headers_str = $response_body_encoded;
            $response_body_encoded = $alt_body_encoded;
        }

        $response_body = $response_body_encoded;

        $response_headers_raw_list = explode("\r\n", $response_headers_str);
        $response_http = array_shift($response_headers_raw_list);

        preg_match('#^([^\s]+)\s(\d+)\s?([^$]+)?$#', $response_http, $response_http_matches);
        array_shift($response_http_matches);

        list ($response_http_protocol, $response_http_code) = $response_http_matches;

        $response_http_message = '';
        if (isset($response_http_matches[2])) {
            $response_http_message = $response_http_matches[2];
        }

        $response_headers = array();
        $response_cookies = array();

        foreach ($response_headers_raw_list as $header_row) {
            list ($header_key, $header_value) = explode(': ', $header_row, 2);

            if (strtolower($header_key) === 'set-cookie') {
                $cookie_params = explode('; ', $header_value);

                if (empty($cookie_params[0])) {
                    continue;
                }

                list ($cookie_name, $cookie_value) = explode('=', $cookie_params[0]);
                $response_cookies[$cookie_name] = $cookie_value;

            } else {
                $response_headers[$header_key] = $header_value;
            }
        }
        unset($header_row, $header_key, $header_value, $cookie_name, $cookie_value);

        if ($response_cookies) {
            self::$client['cookies'] = $this->Helper->arrayMergeAssoc(self::$client['cookies'], $response_cookies);
        }

        return array(
            'status' => 1,
            'http_protocol' => $response_http_protocol,
            'http_code' => $response_http_code,
            'http_message' => $response_http_message,
            'headers' => $response_headers,
            'cookies' => $response_cookies,
            'body' => $response_body
        );
    }

    public function response($data, $json = false) {
        if (ob_get_length()) {
            ob_end_clean();
            ob_start();
        }

        $callback = $this->input('callback', null, false);
        $output = $json ? $data : json_encode($data);
        $contentType = 'application/json';

        if (!empty($callback)) {
            $callback = htmlspecialchars(strip_tags($callback));
            $validate_callback = preg_match('#^jQuery[0-9]*\_[0-9]*$#', $callback);

            if ($validate_callback) {
                $output = '/**/ ' . $callback . '(' . $output . ')';
                $contentType = 'application/javascript';
            }
        }

        header('Content-type: ' . $contentType . '; charset=utf-8');
        exit($output);
    }

    public function error($code = 400, $error_message = 'service is unavailable now', $additional = '') {
        $error = array(
            'meta' => array(
                'code' => $code,
                'error_message' => $error_message
            )
        );

        if ($additional) {
            $additional && $error['meta']['_additional'] = $additional;
        }

        $this->response($error);
    }

    public function subError($additional) {
        return $this->error(400, 'service is unavailable now', $additional);
    }

    public function input($name, $default = null, $check_empty = true) {
        $value = isset($_REQUEST[$name]) ? $_REQUEST[$name] : $default;

        if (empty($value) && $check_empty) {
            $this->error(400, 'invalid request', $name . ' is not defined');
        }

        return $value;
    }

    private function setProxy($config) {
        $url = null;
        $credentials = null;

        if (isset($config['proxy'])) {
            $proxy_config = $config['proxy'];

            if (isset($proxy_config['proxy']) && !empty($proxy_config['proxy'])) {
                if (!empty($proxy_config['proxy']['server'])) {
                    $url = $proxy_config['proxy']['server'];
                }

                if (!empty($proxy_config['proxy']['user']) && !empty($proxy_config['proxy']['password'])) {
                    $credentials = $proxy_config['proxy']['user'] . ':' . $proxy_config['proxy']['password'];
                }
            }
        }

        return array(
            'url' => $url,
            'credentials' => $credentials
        );
    }

    public function debug($data, $options = array()) {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $defaults = array(
            'title' => false,
            'height' => 300,
            'die' => true,
            'var_dump' => false
        );

        $options = !empty($options) ? array_merge($defaults, $options) : $defaults;

        $wrap_styles = array('position: relative;', 'width: 100%;', 'max-width: calc(100vw - 80px);', 'background: #212121;', 'border-radius: 3px;', 'overflow: hidden;', 'margin: 20px auto;', 'box-sizing: border-box;');
        $pre_styles = array('overflow: auto;', 'font: 11px monospace;', 'color: #fff;', 'padding: 12px;', 'box-sizing: border-box;', 'width: 100%;', 'height: 100%;', 'margin: 0;');
        $title_styles = array('position: absolute;', 'font: 15px helvetica;', 'color: #fff;', 'line-height: 32px;', 'padding: 0 12px;', 'background: #181818;', 'width: 100%;', 'top: 0;', 'display: flex;', 'justify-content: space-between;', 'box-sizing: border-box;');

        if ($options['title']) {
            $wrap_styles[] = 'padding-top: 32px;';
        }

        if ($options['die'] && $options['height'] === $defaults['height'] || in_array($options['height'], array('100', 100, 'full'))) {
            $wrap_styles[] = 'height: calc(100vh - 40px);';
        } else {
            $wrap_styles[] = 'height: ' . $options['height'] . 'px;';
        }

        $backtrace = debug_backtrace();
        $file = $backtrace[0]['file'];
        $line = $backtrace[0]['line'];

        echo '<div style="'.implode(' ',$wrap_styles).'">';
        if ($options['title']) {
            echo '<div style="'.implode(' ',$title_styles).'"><span>' . $options['title'] . '</span><small>' . $file . ' [' . $line . ']</small></div>';
        }

        echo '<pre style="'.implode(' ',$pre_styles).'">';

        if ($options['var_dump']) {
            var_dump($data);
        } else {
            print_r($data);
        }

        echo '</pre>';
        echo '</div>';

        if ($options['die']) {
            die();
        } else {
            unset($data);
            unset($options);
            unset($backtrace);
        }
    }
}
