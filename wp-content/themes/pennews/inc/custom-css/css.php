<?php

/**
 * Output custom CSS of the theme in <head>.
 */
class Pemag_Customizer_CSS {
	/**
	 * Add hook to <head> to output custom CSS.
	 */
	public function __construct() {

		$this->load_file();

		add_action( 'wp_enqueue_scripts', array( $this, 'output' ) );
	}

	/**
	 * Output custom CSS.
	 */
	public function output() {
		if ( $css = $this->get_css() ) {
			wp_add_inline_style( 'penci-style', $css );
		}
	}

	/**
	 * Load file
	 */
	public function load_file() {
	}

	/**
	 * Get custom CSS.
	 */
	protected function get_css() {

		$css = '';

		$css .= penci_list_self_fonts();
		$css .= $this->add_custom_fonts();

		$css .= penci_customizer_general();
		$css .= penci_customizer_topbar();
		$css .= penci_customizer_header();
		$css .= penci_customizer_single();
		$css .= penci_customizer_page();
		$css .= penci_customizer_archive();
		$css .= penci_customizer_portfolio();
		$css .= penci_customizer_woo();
		$css .= penci_customizer_sidebar();
		$css .= penci_customizer_footer();
		$css .= penci_customizer_sign_up_form();

		$css .= penci_customizer_color_general();
		$css .= penci_customizer_color_header();
		$css .= penci_customizer_color_sidebar();
		$css .= penci_customizer_color_single();
		$css .= penci_customizer_color_footer();
		$css .= penci_customizer_mobile_nav();

		$css .= penci_customizer_header_signup();
		$css .= penci_customizer_footer_signup();
		$css .= penci_customizer_page_header();
		$css .= penci_customizer_menu_hamburger();
		$css .= penci_customizer_layout_boxed();


		// Allow modules to add custom CSS later (see Typography module)
		$css = apply_filters( 'penci_style_custom_css', $css );

		// Custom CSS has highest priority
		$css .= $this->custom();

		return $css;
	}

	/**
	 * Get custom CSS entered by user in the Customizer.
	 *
	 * @return string
	 */
	protected function custom() {
		return penci_get_theme_mod( 'custom_css' );
	}

	public function add_custom_fonts(){

		$font_1      = penci_get_option( 'pennews_custom_font1' );
		$fontfamily1 = penci_get_option( 'pennews_custom_fontfamily1' );
		$font_2       = penci_get_option( 'pennews_custom_font2' );
		$fontfamily2 = penci_get_option( 'pennews_custom_fontfamily2' );
		$font_3       = penci_get_option( 'pennews_custom_font3' );
		$fontfamily3 = penci_get_option( 'pennews_custom_fontfamily3' );

		$font_4       = penci_get_option( 'pennews_custom_font4' );
		$fontfamily4 = penci_get_option( 'pennews_custom_fontfamily4' );

		$font_5       = penci_get_option( 'pennews_custom_font5' );
		$fontfamily5 = penci_get_option( 'pennews_custom_fontfamily5' );

		$font_6       = penci_get_option( 'pennews_custom_font6' );
		$fontfamily6 = penci_get_option( 'pennews_custom_fontfamily6' );

		$font_7       = penci_get_option( 'pennews_custom_font7' );
		$fontfamily7 = penci_get_option( 'pennews_custom_fontfamily7' );

		$font_8       = penci_get_option( 'pennews_custom_font8' );
		$fontfamily8 = penci_get_option( 'pennews_custom_fontfamily8' );

		$font_9       = penci_get_option( 'pennews_custom_font9' );
		$fontfamily9 = penci_get_option( 'pennews_custom_fontfamily9' );

		$font_10       = penci_get_option( 'pennews_custom_font10' );
		$fontfamily10 = penci_get_option( 'pennews_custom_fontfamily10' );

		$output = '';

		if( $font_1 && $fontfamily1 ){
			$output .= sprintf( ' @font-face {font-family: "%s";src: local("%s"), url("%s") format("woff");}',
				esc_attr( $fontfamily1 ),esc_attr( $fontfamily1 ),esc_attr( $font_1 )
			);
		}

		if( $font_2 && $fontfamily2 ){
			$output .= sprintf( ' @font-face {font-family: "%s";src: local("%s"), url("%s") format("woff");}',
				esc_attr( $fontfamily2 ),esc_attr( $fontfamily2 ),esc_attr( $font_2 )
			);
		}

		if( $font_3 && $fontfamily3 ){
			$output .= sprintf( ' @font-face {font-family: "%s";src: local("%s"), url("%s") format("woff");}',
				esc_attr( $fontfamily3 ),esc_attr( $fontfamily3 ),esc_attr( $font_3 )
			);
		}

		if( $font_4 && $fontfamily4 ){
			$output .= sprintf( ' @font-face {font-family: "%s";src: local("%s"), url("%s") format("woff");}',
				esc_attr( $fontfamily4 ),esc_attr( $fontfamily4 ),esc_attr( $font_4 )
			);
		}

		if( $font_5 && $fontfamily5 ){
			$output .= sprintf( ' @font-face {font-family: "%s";src: local("%s"), url("%s") format("woff");}',
				esc_attr( $fontfamily5 ),esc_attr( $fontfamily5 ),esc_attr( $font_5 )
			);
		}

		if( $font_6 && $fontfamily6 ){
			$output .= sprintf( ' @font-face {font-family: "%s";src: local("%s"), url("%s") format("woff");}',
				esc_attr( $fontfamily6 ),esc_attr( $fontfamily6 ),esc_attr( $font_6 )
			);
		}

		if( $font_7 && $fontfamily7 ){
			$output .= sprintf( ' @font-face {font-family: "%s";src: local("%s"), url("%s") format("woff");}',
				esc_attr( $fontfamily7 ),esc_attr( $fontfamily7 ),esc_attr( $font_7 )
			);
		}

		if( $font_8 && $fontfamily8 ){
			$output .= sprintf( ' @font-face {font-family: "%s";src: local("%s"), url("%s") format("woff");}',
				esc_attr( $fontfamily8 ),esc_attr( $fontfamily8 ),esc_attr( $font_8 )
			);
		}

		if( $font_9 && $fontfamily9 ){
			$output .= sprintf( ' @font-face {font-family: "%s";src: local("%s"), url("%s") format("woff");}',
				esc_attr( $fontfamily9 ),esc_attr( $fontfamily9 ),esc_attr( $font_9 )
			);
		}

		if( $font_10 && $fontfamily10 ){
			$output .= sprintf( ' @font-face {font-family: "%s";src: local("%s"), url("%s") format("woff");}',
				esc_attr( $fontfamily10 ),esc_attr( $fontfamily10 ),esc_attr( $font_10 )
			);
		}

		return $output;
	}
}
new Pemag_Customizer_CSS;