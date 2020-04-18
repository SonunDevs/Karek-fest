<?php
/*
Plugin Name: Elfsight Instagram Feed CC
Description: Add Instagram images to your website to engage your visitors
Plugin URI: https://elfsight.com/instagram-feed-instashow/wordpress/?utm_source=markets&utm_medium=codecanyon&utm_campaign=instagram-feed&utm_content=plugin-site
Version: 3.8.2
Author: Elfsight
Author URI: https://elfsight.com/?utm_source=markets&utm_medium=codecanyon&utm_campaign=instagram-feed&utm_content=plugins-list
*/

if (!defined('ABSPATH')) exit;


require_once('core/elfsight-plugin.php');
require_once('api/api.php');

$elfsight_instagram_feed_config_path = plugin_dir_path(__FILE__) . 'config.json';
$elfsight_instagram_feed_config = json_decode(file_get_contents($elfsight_instagram_feed_config_path), true);

new ElfsightInstagramFeedApi\Api(
    array(
        'plugin_slug' => 'elfsight-instagram-feed',
        'plugin_file' => __FILE__,
        'cache_time' => 21600,
        'media_limit' => 100,
        'editor_config' => &$elfsight_instagram_feed_config
    )
);

$elfsightInstagramFeed = new ElfsightInstagramFeedPlugin(
    array(
        'name' => esc_html__('Instagram Feed'),
        'description' => esc_html__('Add Instagram images to your website to engage your visitors'),
        'slug' => 'elfsight-instagram-feed',
        'version' => '3.8.2',
        'text_domain' => 'elfsight-instagram-feed',
        'editor_settings' => $elfsight_instagram_feed_config['settings'],
        'editor_preferences' => $elfsight_instagram_feed_config['preferences'],
        'script_url' => plugins_url('assets/elfsight-instagram-feed.js', __FILE__),

        'plugin_name' => esc_html__('Elfsight Instagram Feed'),
        'plugin_file' => __FILE__,
        'plugin_slug' => plugin_basename(__FILE__),

        'vc_icon' => plugins_url('assets/img/vc-icon.png', __FILE__),

        'menu_icon' => plugins_url('assets/img/menu-icon.png', __FILE__),
        'update_url' => esc_url('https://a.elfsight.com/updates/v1/'),

        'preview_url' => plugins_url('preview/preview.html', __FILE__),
        'observer_url' => plugins_url('preview/instagram-feed-observer.js', __FILE__),

        'product_url' => esc_url('https://codecanyon.net/item/elfsight-instagram-feed-wordpress-plugin/20574814?ref=Elfsight'),
        'support_url' => esc_url('https://elfsight.ticksy.com/submit/#100010647'),
    )
);

add_shortcode('instashow', array($elfsightInstagramFeed, 'addShortcode'));

?>
