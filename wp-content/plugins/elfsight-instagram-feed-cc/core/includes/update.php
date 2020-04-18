<?php

if (!defined('ABSPATH')) exit;

if (!class_exists('ElfsightInstagramFeedPluginUpdate')) {
    class ElfsightInstagramFeedPluginUpdate {
        public $currentVersion;
        public $updateUrl;
        public $pluginSlug;
        public $slug;
        public $purchaseCode;
        public $wpAutoUpgradeEnabled;
        public $host;

        function __construct($update_url, $current_version, $plugin_slug, $purchase_code) {
            $this->updateUrl = $update_url;
            $this->currentVersion = $current_version;
            $this->pluginSlug = $plugin_slug;
            $this->purchaseCode = $purchase_code;

            list($t1, $t2) = explode('/', $this->pluginSlug);
            $this->slug = str_replace('.php', '', $t2);
            $this->optionSlug = preg_replace('/-cc$/', '', $this->slug);

            $this->host = parse_url(site_url(), PHP_URL_HOST);

            add_filter('pre_set_site_transient_update_plugins', array(&$this, 'checkUpdate'));
            add_filter('plugins_api', array(&$this, 'checkInfo'), 10, 3);

            add_filter('auto_update_plugin', array($this, 'enrollUpgrade'), 10, 2);
            add_action('upgrader_process_complete', array($this, 'completeUpgrade'), 10, 2);
        }

        public function checkUpdate($transient) {
            $result = $this->getInfo('version');
            update_option($this->getOptionName('last_check_datetime'), time());

            if (!$transient) {
                return false;
            }

            if (empty($transient->response)) {
                $transient->response = array();
            }

            if (!$result->verification->valid) {
                delete_option($this->getOptionName('purchase_code'));
                delete_option($this->getOptionName('activated'));
            }

            if (
                $result &&
                empty($result->error)
                && !empty($result->data)
                && version_compare($this->currentVersion, $result->data->version, '<')
            ) {
                update_option($this->getOptionName('latest_version'), $result->data->version);

                $result->data->plugin = $this->pluginSlug;
                $transient->response[$this->pluginSlug] = $result->data;
            }

            return $transient;
        }

        public function checkInfo($result, $action, $args) {
            $result = false;

            if (isset($args->slug) && $args->slug === $this->slug) {
                $info = $this->getInfo('info');

                if (is_object($info) && empty($info->error) && !empty($info->data)) {
                    if (!empty($info->data->sections)) {
                        $info->data->sections = (array)$info->data->sections;
                    }

                    $result = $info->data;
                }
            }

            return $result;
        }

        public function getInfo($action) {
            $request_string = array(
                'body' => array(
                    'action' => urlencode($action),
                    'slug' => urlencode($this->slug),
                    'purchase_code' => urlencode($this->purchaseCode),
                    'version' => urlencode($this->currentVersion),
                    'host' => $this->host
                )
            );

            $result = false;

            $response = wp_remote_post($this->updateUrl, $request_string);

            if (!is_wp_error($response) || wp_remote_retrieve_response_code($response) === 200) {
                if ($response_body = json_decode(wp_remote_retrieve_body($response))) {
                    $result = $response_body;
                }
            }

            return $result;
        }

        public function sheduleAutoUpgrade() {
            $event = 'elfsight_plugin_auto_upgrade_' . md5($this->pluginSlug);

            add_action($event, array($this, 'upgrade'));

            if (wp_next_scheduled($event)) {
                return;
            }

            wp_schedule_event(time(), 'hourly', $event);
        }

        public function enrollUpgrade($default_state, $plugin) {
            if ($plugin->slug !== $this->slug) {
                return $default_state;
            }

            return get_option($this->getOptionName('auto_upgrade'), 'on') === 'on' ? true : false;
        }

        public function completeUpgrade($upgrader, $options) {
            if (
                $options['action'] !== 'update' ||
                $options['type'] !== 'plugin' ||
                !in_array($this->pluginSlug, $options['plugins'])
            ) {
                return;
            }

            update_option($this->getOptionName('last_upgraded_at'), time());
        }

        protected function getOptionName($name) {
            return str_replace('-', '_', $this->optionSlug) . '_' . $name;
        }
    }
}