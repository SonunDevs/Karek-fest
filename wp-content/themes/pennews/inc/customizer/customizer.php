<?php

/**
 * Register theme options in the Customizer
 */
class Penci_Customizer
{
	/**
	 * Add hooks for customizer
	 */
	public function __construct()
	{
		add_action( 'customize_register', array( $this, 'register' ) );
		add_action('customize_register', array( $this, 'move_settings' ), 30);
		add_action( 'customize_preview_init', array( $this, 'customize_preview' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'customize_controls_print_footer_scripts', array( $this, 'color_scheme_template' ) );
	}


	/**
	 * Register customizer settings
	 * @param WP_Customize_Manager $wp_customize WordPress customizer manager instance
	 */
	public function register(WP_Customize_Manager $wp_customize)
	{
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


		require_once get_template_directory() . '/inc/customizer/custom-control/custom-control.php';
		require_once get_template_directory() . '/inc/customizer/custom-control/radio-image.php';
		require_once get_template_directory() . '/inc/customizer/custom-control/radio-html.php';
		require_once get_template_directory() . '/inc/customizer/sanitizer.php';

		$wp_customize->register_control_type( 'Penci_Customize_Control_Radio_Image' );
		$wp_customize->register_control_type( 'Penci_Customize_Control_Radio_HTML' );
		$sanitizer = new Penci_Customize_Sanitizer();

		// Theme option sections
		require_once get_template_directory() . '/inc/customizer/01-general.php';
		require_once get_template_directory() . '/inc/customizer/35-layout-boxed.php';
		require_once get_template_directory() . '/inc/customizer/02-topbar.php';
		require_once get_template_directory() . '/inc/customizer/03-header.php';
		require_once get_template_directory() . '/inc/customizer/31-header-signup.php';
		require_once get_template_directory() . '/inc/customizer/33-menu-hamburger.php';
		require_once get_template_directory() . '/inc/customizer/04-ajax-search.php';
		require_once get_template_directory() . '/inc/customizer/34-page-header.php';
		require_once get_template_directory() . '/inc/customizer/05-page.php';
		require_once get_template_directory() . '/inc/customizer/06-archive.php';

		if( class_exists( 'Penci_Framework' ) ) {
			require_once get_template_directory() . '/inc/customizer/06-block-pag.php';
		}

		require_once get_template_directory() . '/inc/customizer/07-single.php';
		require_once get_template_directory() . '/inc/customizer/08-sidebar.php';
		require_once get_template_directory() . '/inc/customizer/09-footer.php';
		require_once get_template_directory() . '/inc/customizer/10-mobile-nav.php';
		require_once get_template_directory() . '/inc/customizer/11-social-link.php';
		require_once get_template_directory() . '/inc/customizer/12-transition-text.php';

		if ( class_exists( 'WooCommerce' ) ) {
			require_once get_template_directory() . '/inc/customizer/13-woocommerce.php';
		}
		if ( class_exists( 'Penci_Portfolio' ) ) {
			require_once get_template_directory() . '/inc/customizer/14-portfolio.php';
		}
		if ( class_exists( 'bbPress' ) ) {
			require_once get_template_directory() . '/inc/customizer/15-bbpress.php';
		}
		if ( class_exists( 'BuddyPress' ) ) {
			require_once get_template_directory() . '/inc/customizer/16-buddypress.php';
		}

		if ( class_exists( 'Tribe__Events__Main' ) ) {
			require_once get_template_directory() . '/inc/customizer/16-event.php';
		}

		require_once get_template_directory() . '/inc/customizer/19-page404.php';
		require_once get_template_directory() . '/inc/customizer/20-color-general.php';
		require_once get_template_directory() . '/inc/customizer/21-color-header.php';
		require_once get_template_directory() . '/inc/customizer/22-color-topbar.php';
		require_once get_template_directory() . '/inc/customizer/23-color-topbar-singnup.php';
		require_once get_template_directory() . '/inc/customizer/24-color-sidebar.php';
		require_once get_template_directory() . '/inc/customizer/25-color-single.php';
		require_once get_template_directory() . '/inc/customizer/30-color-footer.php';

		require_once get_template_directory() . '/inc/customizer/32-footer-signup.php';
	}

	/**
	 * Move default WordPress settings into Theme Options for better organization.
	 *
	 * @param WP_Customize_Manager $wp_customize WordPress customizer manager instance
	 */
	public function move_settings($wp_customize)
	{
		$wp_customize->get_control('site_icon')->section = 'general';
		$wp_customize->get_control('site_icon')->priority = 5;
		$wp_customize->get_control('custom_logo')->section = 'penci_panel_header';
		$wp_customize->get_control('custom_logo')->priority = 10;


		// Remove default WordPress header image section and move that settings into theme's Header section
		$wp_customize->remove_section('header_textcolor');
		$wp_customize->get_control('header_textcolor')->section = 'penci_section_color_header';

		$wp_customize->remove_section('header_image');
		$wp_customize->get_control('header_image')->section = 'penci_page_title_bread';

		// Remove default WordPress custom background section and move that settings into theme's General section
		$wp_customize->remove_section('background_image');
		$wp_customize->get_control('background_image')->section = 'general';

		$wp_customize->remove_section('background_color');
		$wp_customize->get_control('background_color')->section = 'penci_section_color_general';

		$wp_customize->remove_section('background_preset');
		$wp_customize->get_control('background_preset')->section = 'general';

		$wp_customize->remove_section('background_position');
		$wp_customize->get_control('background_position')->section = 'general';

		$wp_customize->remove_section('background_size');
		$wp_customize->get_control('background_preset')->section = 'general';

		$wp_customize->remove_section('background_size');
		$wp_customize->get_control('background_preset')->section = 'general';

		$wp_customize->remove_section('background_repeat');
		$wp_customize->get_control('background_repeat')->section = 'general';

		$wp_customize->remove_section('background_attachment');
		$wp_customize->get_control('background_attachment')->section = 'general';

		if ($wp_customize->get_section('typography')) {
			$wp_customize->get_section('typography')->priority = 160;
		}

		if ($wp_customize->get_section('custom_css')) {
			$wp_customize->get_section('custom_css')->priority = 1000;
		}

       // Remmove section of Widgets
		$sections = $wp_customize->sections();
		foreach ( $sections as $section_id => $object ) {
			if( false !== strpos( $section_id, 'widgets' ) ) {
				$wp_customize->remove_section( $section_id );
			}
		}

		if (method_exists($wp_customize, 'add_panel')) {
			/* Menus */
			$wp_customize->add_panel(
				'nav_menus', array(
					'priority' => 1000,
					'title' => esc_html__('Menus', 'pennews'),
				)
			);
		}

		/* Site Identity */
		$wp_customize->add_section('title_tagline', array(
			'title' => esc_html__('Site Identity', 'pennews'),
			'priority' => 999,
		));

		/* Static Front Page */
		if (get_pages()) {
			$wp_customize->add_section('static_front_page', array(
				'title' => esc_html__('Static Front Page', 'pennews'),
				'priority' => 998,
				'description' => esc_html__('Your theme supports a static front page.', 'pennews'),
			));
		}
	}

	/**
	 * Enqueue script for customizer control
	 */
	public function enqueue()
	{
		wp_enqueue_style( 'penci-customizer', get_template_directory_uri() . '/css/customizer.css' );

		wp_enqueue_script('penci-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '', true);
		wp_localize_script('penci-customizer', 'PenNewsCustomizer',
			array_merge(
				array(
					'docs' => esc_html__('View documentation', 'pennews'),
				),
				$this->get_color_schemes()
			)
		);
	}

	/**
	 * Bind JS handlers to instantly live-preview changes.
	 */
	public function customize_preview() {
		wp_enqueue_script( 'pennews-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '', true );


	}

	public function color_scheme_template() {

	}

	/**
	 * Register color schemes for theme.
	 * The order of colors in a colors array:
	 * 1. Background Color.
	 * 2. Body Text Colors.
	 * 3. Block and Widget Background Colors.
	 * 4. Accent Colors.
	 *
	 * @return array An associative array of color scheme options.
	 */
	public function get_color_schemes()
	{
		return array(
			'light' => array(
				'label'  => esc_html__( 'Light', 'pennews' ),
				'colors' => array(
					'',
					'#666666',
					'#ffffff',
					'#3f51b5',
					'#111111',
					'#111111',
					'#999999',
					'#dedede'
				),
			),
			'dark'    => array(
				'label'  => esc_html__( 'Dark', 'pennews' ),
				'colors' => array(
					'#111111',
					'#afafaf',
					'#111111',
					'#385c7b',
					'#ffffff',
					'#ffffff',
					'#ffffff',
					'#444444'

				),
			)
		);
	}
}

new Penci_Customizer;


