<?php

if (!defined('ABSPATH')) exit;


require_once(plugin_dir_path(__FILE__) . '/includes/update.php');
require_once(plugin_dir_path(__FILE__) . '/includes/widgets-api.php');
require_once(plugin_dir_path(__FILE__) . '/includes/admin.php');
require_once(plugin_dir_path(__FILE__) . '/includes/widget.php');
require_once(plugin_dir_path(__FILE__) . '/includes/vc-element.php');

if (!class_exists('ElfsightInstagramFeedPlugin')) {
    class ElfsightInstagramFeedPlugin {
        private $name;
        private $slug;
        private $version;
        private $textDomain;
        private $editorSettings;
        private $scriptUrl;

        private $pluginFile;
        private $pluginSlug;

        private $updateUrl;

        private $purchaseCode;

        private $update;
        private $widgetsApi;
        private $admin;
        private $widget;
        private $vcElement;

        private $isShortcodePresent;

        public function __construct($config) {
            $this->name = $config['name'];
            $this->slug = $config['slug'];
            $this->version = $config['version'];
            $this->textDomain = $config['text_domain'];
            $this->editorSettings = $config['editor_settings'];
            $this->scriptUrl = $config['script_url'];

            $this->pluginFile = $config['plugin_file'];
            $this->pluginSlug = $config['plugin_slug'];

            $this->updateUrl = $config['update_url'];

            $this->purchaseCode = get_option($this->getOptionName('purchase_code'), '');

            $this->update = new ElfsightInstagramFeedPluginUpdate($this->updateUrl, $this->version, $this->pluginSlug, $this->purchaseCode);
            $this->widgetsApi = new ElfsightInstagramFeedWidgetsApi($this->slug, $this->pluginFile, $this->textDomain);
            $this->admin = new ElfsightInstagramFeedPluginAdmin($config, $this->widgetsApi);
            $this->widget = new ElfsightInstagramFeedWidget($config, $this->widgetsApi);
            $this->vcElement = new ElfsightInstagramFeedVCElement($config, $this->widgetsApi);

            add_action('wp_footer', array($this, 'printAssets'));
            add_shortcode(str_replace('-', '_', $this->slug), array($this, 'addShortcode'));
            add_action('plugin_action_links_' . $this->pluginSlug, array($this, 'addPluginActionLinks'));
            add_action('widgets_init', array($this, 'registerWidget'));

            add_action('init', array($this, 'initBlock'));
            add_action('enqueue_block_editor_assets', array($this, 'enqueueBlockAssets'));
            add_action('plugins_loaded', array($this, 'loadTextDomain'));
        }

        public function loadTextDomain() {
            load_plugin_textdomain($this->textDomain, false, dirname(plugin_basename($this->pluginFile)) . '/languages/');
        }

        public function initBlock() {
            if (function_exists('register_block_type')) {
                register_block_type($this->slug.'/block', array(
                    'attributes' => array(
                        'id' => array(
                            'type' => 'number'
                        )
                    ),
                    'render_callback' => array($this, 'addShortcode')
                ));
            }
        }

        public function enqueueBlockAssets() {
            if (function_exists('register_block_type')) {
                wp_enqueue_script($this->slug . '-block-editor', plugins_url('assets/elfsight-block.js', $this->pluginFile), array(), $this->version, true);
                wp_enqueue_style($this->slug . '-block-editor', plugins_url('assets/elfsight-block.css', $this->pluginFile), array(), $this->version);

                wp_enqueue_script($this->slug, $this->scriptUrl, array($this->slug . '-block-editor'), $this->version, true);
            }
        }

        public function printAssets() {
            $force_script_add = get_option($this->getOptionName('force_script_add'));

            if ($this->isShortcodePresent || $force_script_add === 'on') {
                $uploads_dir_params = wp_upload_dir();
                $uploads_dir = $uploads_dir_params['basedir'] . '/' . $this->slug;
                $uploads_url = $this->checkUrlSertificate($uploads_dir_params['baseurl'] . '/' . $this->slug);
                $custom_css_path = $uploads_dir . '/' . $this->slug . '-custom.css';
                $custom_js_path = $uploads_dir . '/' . $this->slug . '-custom.js';

                wp_enqueue_script($this->slug, $this->checkUrlSertificate($this->scriptUrl), array(), $this->version);

                if (is_readable($custom_js_path) && filesize($custom_js_path) > 0) {
                    wp_enqueue_script($this->slug . '-custom', $uploads_url . '/' . $this->slug . '-custom.js', array(), $this->version);
                }

                if (is_readable($custom_css_path) && filesize($custom_css_path) > 0) {
                    wp_enqueue_style($this->slug . '-custom', $uploads_url . '/' . $this->slug . '-custom.css', array(), $this->version);
                }
            }
        }

        public function checkUrlSertificate($url) {
            return is_ssl() ? str_replace('http://', 'https://', $url) : $url;
        }

        public function recursiveDefaults($properties, $defaults){
            foreach($properties as $property) {
                if (isset($property['type']) && $property['type'] == 'subgroup') {
                    $defaults = $this->recursiveDefaults($property['subgroup']['properties'], $defaults);
                } else {
                    $defaultValue = null;

                    if (isset($property['defaultValue'])) {
                        $defaultValue = $property['defaultValue'];
                    }

                    if (isset($property['id'])) {
                        $defaults[$property['id']] = $defaultValue;
                    }
                }
            }

            return $defaults;
        }

        public function addShortcode($atts) {
            $this->isShortcodePresent = true;

            $atts = $atts ? $this->formatAtts($atts) : $atts;
            $widget_id = !empty($atts['id']) ? $atts['id'] : null;

            $defaults = $this->recursiveDefaults($this->editorSettings['properties'], array());

            if (!empty($widget_id)) {
                $widget_options = $this->getWidgetOptions($widget_id);

                if (!$widget_options) {
                    return '';
                }

                $atts = array_combine(
                    array_merge(array_keys($widget_options), array_keys($atts)),
                    array_merge(array_values($widget_options), array_values($atts))
                );
            }

            $options = shortcode_atts($defaults, $atts, str_replace('-', '_', $this->slug));
            $options = apply_filters($this->getOptionName('shortcode_options'), $options, $widget_id);

            $options['widgetId'] = $widget_id;

            $options_string = rawurlencode(json_encode($options));

            $version = $this->version;

            $result = '
            <div 
                class="elfsight-widget-' . esc_html(str_replace('elfsight-', '', $this->slug)) . ' elfsight-widget" 
                data-' . esc_html($this->slug) . '-options="' . esc_html($options_string) . '" 
                data-' . esc_html($this->slug) . '-version="' . esc_html($version) . '"
                data-elfsight-widget-id="' . esc_html($this->slug . '-' . $widget_id) . '">
            </div>
            ';

            return $result;
        }

        public function formatAtts($atts) {
            $attsKey['true'] = array_keys($atts, 'true', true);
            $attsKey['false'] = array_keys($atts, 'false', true);

            if (!empty($attsKey['true']) || !empty($attsKey['false'])) {
                foreach ($attsKey as $bool => $arKey) {
                    foreach ($arKey as $key) {
                        if ($bool == 'false') {
                            $atts[$key] = false;
                        } else {
                            $atts[$key] = true;
                        }
                    }
                }

                unset($attsKey);
            }

            if (!function_exists('dashesToCamelCase')) {
                function dashesToCamelCase($string, $capitalizeFirstCharacter = false) {
                    $string = preg_replace_callback('/_[a-zA-Z]/', 'capitalize', $string);
                    $string = preg_replace_callback('/-[a-zA-Z]/', 'capitalize', $string);

                    return $string;
                }
            }

            if (!function_exists('capitalize')) {
                function capitalize($matches) {
                    return strtoupper($matches[0][1]);
                }
            }

            foreach ($atts as $key => $value) {
                $atts[dashesToCamelCase($key)] = $value;
            }

            return $atts;
        }

        function registerWidget() {
            if (!empty($this->widget)) {
                if (!get_option($this->getOptionName('widget_hash'))) {
                    register_widget($this->widget);

                    add_option($this->getOptionName('widget_hash'), spl_object_hash($this->widget));
                } else {
                    global $wp_widget_factory;

                    $wp_widget_factory->widgets[get_option($this->getOptionName('widget_hash'))] = $this->widget;
                }
            }
        }

        public function addPluginActionLinks($links) {
            $links[] = '<a href="' . esc_url(admin_url('admin.php?page=' . $this->slug)) . '">Settings</a>';
            $links[] = '<a href="http://codecanyon.net/user/elfsight/portfolio?ref=Elfsight" target="_blank">More plugins by Elfsight</a>';

            return $links;
        }

        private function getWidgetOptions($id) {
            global $wpdb;

            $id = intval($id);

            $widgets_table_name = $this->widgetsApi->getTableName();

            $item = $wpdb->get_row($wpdb->prepare(
                "SELECT options FROM $widgets_table_name WHERE `id` = %d AND `active` = %d",
                esc_sql($id),
                esc_sql(1)
            ), ARRAY_A);

            if (!empty($item) && !empty($item['options'])) {
                $options = json_decode($item['options'], true);
            }
            else {
                $options = null;
            }

            return $options;
        }

        private function getOptionName($name) {
            return str_replace('-', '_', $this->slug) . '_' . $name;
        }
    }
}

?>
