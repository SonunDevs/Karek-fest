<?php

if ( function_exists( 'penci_customizer_woo' ) ) {
	return;
}
function penci_customizer_woo() {

	$css = '';

	if ( ! class_exists( 'WooCommerce' ) ) {
		return '';
	}

	$shortcode_dis_bg = penci_get_theme_mod( 'penci_woo_shortcode_dis_bg' );
	$shortcode_bg     = penci_get_theme_mod( 'penci_woo_shortcode_bg' );

	if ( $shortcode_dis_bg ) {
		$css .= '.vc_row .woocommerce{ background: transparent; }';
	}

	if ( $shortcode_bg ) {
		$css .= sprintf( '.vc_row .woocommerce{ background-color:%s; }', esc_attr( $shortcode_bg ) );
	}

	return $css;
}