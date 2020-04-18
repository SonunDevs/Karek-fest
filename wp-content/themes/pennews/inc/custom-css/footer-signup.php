<?php
if ( function_exists( 'penci_customizer_footer_signup' ) ){
	return;
}
function penci_customizer_footer_signup() {

	$css = '';

	$signup_padding_top       = penci_get_theme_mod( 'penci_footer_signup_ptop' );
	$signup_padding_bottom    = penci_get_theme_mod( 'penci_footer_signup_pbottom' );
	$footer_signup_mar_bottom = penci_get_theme_mod( 'penci_footer_signup_mar_bottom' );

	$signup_padding = '';

	if ( $signup_padding_top || ( 0 == $signup_padding_top && false !== $signup_padding_top ) ) {
		$signup_padding .= 'padding-top:' . esc_attr( $signup_padding_top ) . 'px;';
	}
	if ( $signup_padding_bottom || ( 0 == $signup_padding_bottom && false !== $signup_padding_bottom ) ) {
		$signup_padding .= 'padding-bottom:' . esc_attr( $signup_padding_bottom ) . 'px;';
	}
	if ( $footer_signup_mar_bottom || ( 0 == $footer_signup_mar_bottom && false !== $footer_signup_mar_bottom ) ) {
		$signup_padding .= 'margin-bottom:' . esc_attr( $footer_signup_mar_bottom ) . 'px;';
	}
	if ( $signup_padding ) {
		$css .= '.footer-subscribe{ ' . ( $signup_padding ) . '; }';
	}

	$signup_bg            = penci_get_theme_mod( 'penci_footer_signup_bg' );
	$signup_color         = penci_get_theme_mod( 'penci_footer_signup_color' );
	$signup_heading_color = penci_get_theme_mod( 'penci_footer_signup_heading_color' );
	$signup_input_border  = penci_get_theme_mod( 'penci_footer_signup_input_border' );
	$signup_input_color   = penci_get_theme_mod( 'penci_footer_signup_input_color' );
	$signup_iplace_color  = penci_get_theme_mod( 'penci_footer_signup_iplace_color' );
	$signup_submit_bg     = penci_get_theme_mod( 'penci_footer_signup_submit_bg' );
	$signup_submit_color  = penci_get_theme_mod( 'penci_footer_signup_submit_color' );
	$signup_submit_hbg    = penci_get_theme_mod( 'penci_footer_signup_submit_hbg' );
	$signup_submit_hcolor = penci_get_theme_mod( 'penci_footer_signup_submit_hcolor' );

	if( $signup_bg ){
		$css .= '.footer-subscribe.penci-mailchimp{ background-color:' . esc_attr( $signup_bg ) . '; }';
	}

	if( $signup_color ){
		$css .= '.footer-subscribe .mc4wp-form{ color:' . esc_attr( $signup_color ) . '; }';
	}

	if( $signup_heading_color ){
		$css .= '.footer-subscribe h4.footer-subscribe-title{ color:' . esc_attr( $signup_heading_color ) . '; }';
	}

	if( $signup_input_border ){
		$css .= '.footer-subscribe .mc4wp-form input[type="text"],
		 .footer-subscribe .mc4wp-form input[type="email"],
		 .footer-subscribe .mc4wp-form input[type="number"],
		 .footer-subscribe .mc4wp-form input[type="date"]{ border-color:' . esc_attr( $signup_input_border ) . '; }';
	}

	if( $signup_input_color ){
		$css .= '.footer-subscribe .mc4wp-form input[type="text"],
		 .footer-subscribe .mc4wp-form input[type="email"],
		 .footer-subscribe .mc4wp-form input[type="number"],
		 .footer-subscribe .mc4wp-form input[type="date"]{ color:' . esc_attr( $signup_input_color ) . '; }';
	}

	if( $signup_submit_bg ){
		$css .= '.footer-subscribe .mc4wp-form input[type="submit"]{ background-color:' . esc_attr( $signup_submit_bg ) . '; }';
	}

	if( $signup_submit_color ){
		$css .= '.footer-subscribe .mc4wp-form input[type="submit"]{ color:' . esc_attr( $signup_submit_color ) . '; }';
	}

	if( $signup_submit_hbg ){
		$css .= '.footer-subscribe .mc4wp-form input[type="submit"]:hover{ background-color:' . esc_attr( $signup_submit_hbg ) . '; }';
	}

	if( $signup_submit_hcolor ){
		$css .= '.footer-subscribe .mc4wp-form input[type="submit"]:hover{ color:' . esc_attr( $signup_submit_hcolor ) . '; }';
	}

	if ( $signup_iplace_color ) {
		$css .= sprintf(
			'.footer-subscribe .mc4wp-form input[type="text"]::-webkit-input-placeholder,' .
			'.footer-subscribe .mc4wp-form input[type=password]::-webkit-input-placeholder,' .
			'.footer-subscribe .mc4wp-form input[type="email"]::-webkit-input-placeholder{ color:%s; }' .
			'.footer-subscribe .mc4wp-form input[type="text"]::-moz-placeholder,' .
			'.footer-subscribe .mc4wp-form input[type=password]::-moz-placeholder,' .
			'.footer-subscribe .mc4wp-form input[type="email"]::-moz-placeholder{ color:%s; }' .
			'.footer-subscribe .mc4wp-form input[type="text"]:-ms-input-placeholder,' .
			'.footer-subscribe .mc4wp-form input[type=password]:-ms-input-placeholder,' .
			'.footer-subscribe .mc4wp-form input[type="email"]:-ms-input-placeholder{ color:%s; }' .
			'.footer-subscribe .mc4wp-form input[type="text"]:-moz-placeholder,' .
			'.footer-subscribe .mc4wp-form input[type=password]:-moz-placeholder,' .
			'.footer-subscribe .mc4wp-form input[type="email"]:-moz-placeholder { color:%s; }',
			esc_attr( $signup_iplace_color ),
			esc_attr( $signup_iplace_color ),
			esc_attr( $signup_iplace_color ),
			esc_attr( $signup_iplace_color )
		);
	}



	return $css;
}