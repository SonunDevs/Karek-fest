<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * enqueue static files: javascript and css for backend
 */

wp_enqueue_style('icofonts', EXHIBZ_CSS . '/icofont.css', null, EXHIBZ_VERSION);
wp_enqueue_style('exhibz-admin', EXHIBZ_CSS . '/exhibz-admin.css', null, EXHIBZ_VERSION);
wp_enqueue_script('exhibz-admin', EXHIBZ_JS . '/exhibz-admin.js', array('jquery'), EXHIBZ_VERSION, true);




