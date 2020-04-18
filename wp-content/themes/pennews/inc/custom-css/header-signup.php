<?php
if ( function_exists( 'penci_customizer_header_signup' ) ){
	return;
}
function penci_customizer_header_signup() {

	$css = '';

	$signup_padding   = penci_get_theme_mod( 'penci_header_signup_padding' );
	$signup_margintop = penci_get_theme_mod( 'penci_header_signup_mtop' );

	if( $signup_padding || ( 0 == $signup_padding && false !== $signup_padding ) ) {
		$css .= '.penci-header-signup-form .penci-mailchimp { padding-top:' . esc_attr( $signup_padding ) . 'px; padding-bottom:' . esc_attr( $signup_padding ) . 'px; }';
	}
	if( $signup_margintop || ( 0 == $signup_margintop && false !== $signup_margintop ) ) {
		$css .= '.penci-header-signup-form{ margin-top:' . esc_attr( $signup_margintop ) . 'px; }';
	}

	$signup_bg            = penci_get_theme_mod( 'penci_header_signup_bg' );
	$signup_color         = penci_get_theme_mod( 'penci_header_signup_color' );
	$signup_heading_color = penci_get_theme_mod( 'penci_header_signup_heading_color' );
	$signup_input_border  = penci_get_theme_mod( 'penci_header_signup_input_border' );
	$signup_input_color   = penci_get_theme_mod( 'penci_header_signup_input_color' );
	$signup_iplace_color  = penci_get_theme_mod( 'penci_header_signup_iplace_color' );
	$signup_submit_bg     = penci_get_theme_mod( 'penci_header_signup_submit_bg' );
	$signup_submit_color  = penci_get_theme_mod( 'penci_header_signup_submit_color' );
	$signup_submit_hbg    = penci_get_theme_mod( 'penci_header_signup_submit_hbg' );
	$signup_submit_hcolor = penci_get_theme_mod( 'penci_header_signup_submit_hcolor' );

	if( $signup_bg ){
		$css .= '.penci-header-signup-form-fullwidth, .penci-header-signup-form-default .penci-mailchimp{ background-color:' . esc_attr( $signup_bg ) . '; }';
	}

	if( $signup_color ){
		$css .= '.penci-header-signup-form .mc4wp-form{ color:' . esc_attr( $signup_color ) . '; }';
	}

	if( $signup_heading_color ){
		$css .= '.penci-header-signup-form h4.header-signup-form{ color:' . esc_attr( $signup_heading_color ) . '; }';
	}

	if( $signup_input_border ){
		$css .= '.penci-header-signup-form .mc4wp-form input[type="text"],
		 .penci-header-signup-form .mc4wp-form input[type="email"],
		 .penci-header-signup-form .mc4wp-form input[type="number"],
		 .penci-header-signup-form .mc4wp-form input[type="date"]{ border-color:' . esc_attr( $signup_input_border ) . '; }';
	}

	if( $signup_input_color ){
		$css .= '.penci-header-signup-form .mc4wp-form input[type="text"],
		 .penci-header-signup-form .mc4wp-form input[type="email"],
		 .penci-header-signup-form .mc4wp-form input[type="number"],
		 .penci-header-signup-form .mc4wp-form input[type="date"]{ color:' . esc_attr( $signup_input_color ) . '; }';
	}

	if( $signup_submit_bg ){
		$css .= '.penci-header-signup-form .mc4wp-form input[type="submit"]{ background-color:' . esc_attr( $signup_submit_bg ) . '; }';
	}

	if( $signup_submit_color ){
		$css .= '.penci-header-signup-form .mc4wp-form input[type="submit"]{ color:' . esc_attr( $signup_submit_color ) . '; }';
	}

	if( $signup_submit_hbg ){
		$css .= '.penci-header-signup-form .mc4wp-form input[type="submit"]:hover{ background-color:' . esc_attr( $signup_submit_hbg ) . '; }';
	}

	if( $signup_submit_hcolor ){
		$css .= '.penci-header-signup-form .mc4wp-form input[type="submit"]:hover{ color:' . esc_attr( $signup_submit_hcolor ) . '; }';
	}

	if ( $signup_iplace_color ) {
		$css .= sprintf(
			'.penci-header-signup-form .mc4wp-form input[type="text"]::-webkit-input-placeholder,' .
			'.penci-header-signup-form .mc4wp-form input[type=password]::-webkit-input-placeholder,' .
			'.penci-header-signup-form .mc4wp-form input[type="email"]::-webkit-input-placeholder{ color:%s; }' .
			'.penci-header-signup-form .mc4wp-form input[type="text"]::-moz-placeholder,' .
			'.penci-header-signup-form .mc4wp-form input[type=password]::-moz-placeholder,' .
			'.penci-header-signup-form .mc4wp-form input[type="email"]::-moz-placeholder{ color:%s; }' .
			'.penci-header-signup-form .mc4wp-form input[type="text"]:-ms-input-placeholder,' .
			'.penci-header-signup-form .mc4wp-form input[type=password]:-ms-input-placeholder,' .
			'.penci-header-signup-form .mc4wp-form input[type="email"]:-ms-input-placeholder{ color:%s; }' .
			'.penci-header-signup-form .mc4wp-form input[type="text"]:-moz-placeholder,' .
			'.penci-header-signup-form .mc4wp-form input[type=password]:-moz-placeholder,' .
			'.penci-header-signup-form .mc4wp-form input[type="email"]:-moz-placeholder { color:%s; }',
			esc_attr( $signup_iplace_color ),
			esc_attr( $signup_iplace_color ),
			esc_attr( $signup_iplace_color ),
			esc_attr( $signup_iplace_color )
		);
	}



	return $css;
}