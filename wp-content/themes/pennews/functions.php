<?php

/**
 * PenNews functions and definitions
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package PenNews
 */
update_option( 'penci_pennews_is_activated', 1 );
define( 'PENCI_PENNEWS_VERSION', '6.5.5' );

if ( ! function_exists( 'penci_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 */
	function penci_setup() {

		load_theme_textdomain( 'pennews', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );


		$dis_thumb_480_645   = get_theme_mod( 'penci_dis_thumb_480_645' );
		$dis_thumb_480_480   = get_theme_mod( 'penci_dis_thumb_480_480' );
		$dis_thumb_480_320   = get_theme_mod( 'penci_dis_thumb_480_320' );
		$dis_thumb_280_376   = get_theme_mod( 'penci_dis_thumb_280_376' );
		$dis_thumb_280_186   = get_theme_mod( 'penci_dis_thumb_280_186' );
		$dis_thumb_280_280   = get_theme_mod( 'penci_dis_thumb_280_280' );
		$dis_thumb_760_570   = get_theme_mod( 'penci_dis_thumb_760_570' );
		$dis_thumb_1920_auto = get_theme_mod( 'penci_dis_thumb_1920_auto' );
		$dis_thumb_960_auto  = get_theme_mod( 'penci_dis_thumb_960_auto' );
		$dis_thumb_auto_400  = get_theme_mod( 'penci_dis_thumb_auto_400' );
		$dis_thumb_585_auto  = get_theme_mod( 'penci_dis_thumb_585_auto' );
		$hide_sidebar_editor = get_theme_mod( 'penci_hide_sidebar_editor' );


		if ( ! $dis_thumb_480_645 ): add_image_size( 'penci-thumb-480-645', 480, 645, true ); endif;
		if ( ! $dis_thumb_480_480 ): add_image_size( 'penci-thumb-480-480', 480, 480, true ); endif;
		if ( ! $dis_thumb_480_320 ): add_image_size( 'penci-thumb-480-320', 480, 320, true ); endif;

		if ( ! $dis_thumb_280_376 ): add_image_size( 'penci-thumb-280-376', 280, 376, true ); endif;
		if ( ! $dis_thumb_280_186 ): add_image_size( 'penci-thumb-280-186', 280, 186, true ); endif;
		if ( ! $dis_thumb_280_280 ): add_image_size( 'penci-thumb-280-280', 280, 280, true ); endif;

		if ( ! $dis_thumb_760_570 ): add_image_size( 'penci-thumb-760-570', 760, 570, true ); endif;
		if ( ! $dis_thumb_1920_auto ): add_image_size( 'penci-thumb-1920-auto', 1920, 999999, false ); endif;
		if ( ! $dis_thumb_960_auto ): add_image_size( 'penci-thumb-960-auto', 960, 999999, false ); endif;
		if ( ! $dis_thumb_auto_400 ): add_image_size( 'penci-thumb-auto-400', 999999, 400, false ); endif;
		if ( ! $dis_thumb_585_auto ): add_image_size( 'penci-masonry-thumb', 585, 99999, false ); endif;

		add_theme_support( 'post-formats', array( 'gallery', 'audio', 'video' ) );

		add_editor_style( array( penci_fonts_url(), get_template_directory_uri() . '/css/font-awesome.min.css', 'css/editor-style.css', ) );

		if ( $hide_sidebar_editor ) {
			add_editor_style( array( get_template_directory_uri() . '/css/fix-editor-style.css' ) );
		}

		register_nav_menus( array(
				'menu-1' => esc_html__( 'Primary', 'pennews' ),
				'menu-2' => esc_html__( 'Footer', 'pennews' ),
				'menu-3' => esc_html__( 'Topbar', 'pennews' ),
			)
		);

		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', ) );
		add_theme_support( 'custom-background', apply_filters( 'penci_custom_background_args', array( 'default-color' => '', 'default-image' => '', ) ) );
		add_theme_support( 'custom-logo' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'yoast-seo-breadcrumbs' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'pennews' ),
					'shortName' => __( 'S', 'pennews' ),
					'size'      => 14,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'pennews' ),
					'shortName' => __( 'N', 'pennews' ),
					'size'      => 16,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Medium', 'pennews' ),
					'shortName' => __( 'M', 'pennews' ),
					'size'      => 20,
					'slug'      => 'medium',
				),
				array(
					'name'      => __( 'Large', 'pennews' ),
					'shortName' => __( 'L', 'pennews' ),
					'size'      => 32,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'pennews' ),
					'shortName' => __( 'XL', 'pennews' ),
					'size'      => 42,
					'slug'      => 'huge',
				)
			)
		);

		// Add support for responsive embedded content.
		//add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'penci_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function penci_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'penci_content_width', 1400 );
}

add_action( 'after_setup_theme', 'penci_content_width', 0 );

require get_template_directory() . '/inc/default.php';
require get_template_directory() . '/inc/transition-default.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/fonts.php';
require get_template_directory() . '/inc/self-fonts.php';
require get_template_directory() . '/inc/media.php';
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/excerpt.php';
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/social-media.php';
require get_template_directory() . '/inc/social-share.php';
require get_template_directory() . '/inc/breadcrumbs.php';
require get_template_directory() . '/inc/post-format/post-format.php';
require get_template_directory() . '/inc/custom-css/custom-css.php';
require get_template_directory() . '/inc/max-mega-menu/max-mega-menu.php';
require get_template_directory() . '/inc/login-popup.php';
require get_template_directory() . '/inc/woocommerce.php';
require get_template_directory() . '/inc/single-loadmore.php';
require get_template_directory() . '/inc/ajaxified-search.php';
require get_template_directory() . '/inc/json-schema-validar.php';
require get_template_directory() . '/inc/multiple-comments.php';

require get_template_directory() . '/inc/custom-sidebar.php';
Penci_Custom_Sidebar::initialize();

/**
 * Load dashboard
 */
require get_template_directory() . '/inc/dashboard/class-penci-dashboard.php';
$dashboard = new Penci_Dashboard();

if ( is_admin() ) {
	require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
	require_once get_template_directory() . '/inc/admin/plugins.php';
}
remove_action( 'wp_head', 'rest_output_link_wp_head' );

require_once( 'wp-updates-theme.php' );
new WPUpdatesThemeUpdater_2239( 'http://wp-updates.com/api/2/theme', basename( get_template_directory() ) );

/**
 * Disable VC check license whenever update
 *
 * @see js_composer\include\classes\updaters\class-vc-updater.php
 * @see js_composer\include\classes\updaters\class-vc-updating-manager.php
 */
if ( ! function_exists( 'penci_fix_update_vc' ) ):
	function penci_fix_update_vc() {
		if ( function_exists( 'vc_license' ) && function_exists( 'vc_updater' ) && ! vc_license()->isActivated() ) {

			remove_filter( 'upgrader_pre_download', array( vc_updater(), 'preUpgradeFilter' ), 10 );
			remove_filter( 'pre_set_site_transient_update_plugins', array( vc_updater()->updateManager(), 'check_update' ) );

			if ( function_exists( 'vc_plugin_name' ) ) {
				remove_filter( 'in_plugin_update_message-' . vc_plugin_name(), array( vc_updater()->updateManager(), 'addUpgradeMessageLink', ) );
			}
		}
	}

	add_action( 'admin_init', 'penci_fix_update_vc', 9 );
endif;

/**
 * Compatible with Custom Sidebars – Dynamic Widget Area Manager plugin
 */
add_filter( 'cs_sidebar_params', function ( $sidebar ) {
	$class_before_widget      = ' penci-block-vc penci-widget-sidebar';
	$class_before_widget      .= ' ' . penci_get_setting( 'penci_style_block_title' );
	$class_before_widget      .= ' ' . penci_get_setting( 'penci_align_blocktitle' );
	$before_widget            = '<div id="%1$s" class="widget ' . $class_before_widget . ' %2$s">';
	$before_title             = '<div class="penci-block-heading"><h4 class="widget-title penci-block__title"><span>';
	$after_title              = '</span></h4></div>';
	$sidebar['before_widget'] = $before_widget;
	$sidebar['after_widget']  = '</div>';
	$sidebar['before_title']  = $before_title;
	$sidebar['after_title']   = $after_title;

	return $sidebar;
} );

