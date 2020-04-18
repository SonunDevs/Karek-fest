<?php

/**
 * theme's main functions and globally usable variables, contants etc
 * added: v1.0 
 * textdomain: exhibz, class: Exhibz, var: $exhibz_, constants: EXHIBZ_, function: exhibz_
 */

// shorthand contants
// ------------------------------------------------------------------------
define('EXHIBZ_THEME', 'Exhibz Event WordPress Theme');
define('EXHIBZ_VERSION', time());
define('EXHIBZ_MINWP_VERSION', '4.3');


// shorthand contants for theme assets url
// ------------------------------------------------------------------------
define('EXHIBZ_THEME_URI', get_template_directory_uri());
define('EXHIBZ_IMG', EXHIBZ_THEME_URI . '/assets/images');
define('EXHIBZ_CSS', EXHIBZ_THEME_URI . '/assets/css');
define('EXHIBZ_JS', EXHIBZ_THEME_URI . '/assets/js');



// shorthand contants for theme assets directory path
// ----------------------------------------------------------------------------------------
define('EXHIBZ_THEME_DIR', get_template_directory());
define('EXHIBZ_IMG_DIR', EXHIBZ_THEME_DIR . '/assets/images');
define('EXHIBZ_CSS_DIR', EXHIBZ_THEME_DIR . '/assets/css');
define('EXHIBZ_JS_DIR', EXHIBZ_THEME_DIR . '/assets/js');

define('EXHIBZ_CORE', EXHIBZ_THEME_DIR . '/core');
define('EXHIBZ_COMPONENTS', EXHIBZ_THEME_DIR . '/components');
define('EXHIBZ_EDITOR', EXHIBZ_COMPONENTS . '/editor');
define('EXHIBZ_EDITOR_ELEMENTOR', EXHIBZ_EDITOR . '/elementor');
define('EXHIBZ_INSTALLATION', EXHIBZ_CORE . '/installation-fragments');
define('EXHIBZ_REMOTE_CONTENT', esc_url('http://demo.themewinter.com/demo-content/exhibz'));


// set up the content width value based on the theme's design
// ----------------------------------------------------------------------------------------
if (!isset($content_width)) {
    $content_width = 800;
}

// set up theme default and register various supported features.
// ----------------------------------------------------------------------------------------

function exhibz_setup() {

    // make the theme available for translation
    $lang_dir = EXHIBZ_THEME_DIR . '/languages';
    load_theme_textdomain('exhibz', $lang_dir);

    // add support for post formats
    add_theme_support('post-formats', [
        'standard', 'gallery', 'video', 'audio'
    ]);

    // add support for automatic feed links
    add_theme_support('automatic-feed-links');

    // let WordPress manage the document title
    add_theme_support('title-tag');

    // add support for post thumbnails
    add_theme_support('post-thumbnails');

    // hard crop center center
    set_post_thumbnail_size(750, 465, ['center', 'center']);

    // woocommerce support
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
 
    // register navigation menus
    register_nav_menus(
        [
            'primary' => esc_html__('Primary Menu', 'exhibz'),
            'footermenu' => esc_html__('Footer Menu', 'exhibz'),
        ]
    );

  
    // HTML5 markup support for search form, comment form, and comments
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ));

    /*
	 * Enable support for wide alignment class for Gutenberg blocks.
	 */
	add_theme_support( 'align-wide' );

}
add_action('after_setup_theme', 'exhibz_setup');



// hooks for unyson framework
// ----------------------------------------------------------------------------------------
function exhibz_framework_customizations_path($rel_path) {
    return '/components';
}
add_filter('fw_framework_customizations_dir_rel_path', 'exhibz_framework_customizations_path');


function exhibz_remove_fw_settings() {
    remove_submenu_page( 'themes.php', 'fw-settings' );
}
add_action( 'admin_menu', 'exhibz_remove_fw_settings', 999 );


//Gutenberg optimization enqueue files
add_action('enqueue_block_editor_assets', 'exhibz_action_enqueue_block_editor_assets' );
function exhibz_action_enqueue_block_editor_assets() {
    wp_enqueue_style( 'exhibz-fonts', exhibz_google_fonts_url(['Raleway:400,500,600,700,800,900', 'Roboto:400,700']), null, EXHIBZ_VERSION );
    wp_enqueue_style( 'exhibz-gutenberg-editor-font-awesome-styles', EXHIBZ_CSS . '/font-awesome.css', null, EXHIBZ_VERSION );
    wp_enqueue_style( 'exhibz-gutenberg-editor-customizer-styles', EXHIBZ_CSS . '/gutenberg-editor-custom.css', null, EXHIBZ_VERSION );
    wp_enqueue_style( 'exhibz-gutenberg-editor-styles', EXHIBZ_CSS . '/gutenberg-custom.css', null, EXHIBZ_VERSION );
    wp_enqueue_style( 'exhibz-gutenberg-blog-styles', EXHIBZ_CSS . '/blog.css', null, EXHIBZ_VERSION );
}

// include the init.php
// ----------------------------------------------------------------------------------------
require_once( EXHIBZ_CORE . '/init.php');
require_once( EXHIBZ_COMPONENTS . '/editor/elementor/elementor.php');
