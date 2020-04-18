<?php
if ( function_exists( 'penci_customizer_sign_up_form' ) ) {
	return;
}
function penci_customizer_sign_up_form() {

	$css = '';

	$penci_login_bg_img          = penci_get_theme_mod( 'penci_login_bg_img' );
	$penci_login_bg_repeat       = penci_get_theme_mod( 'penci_login_bg_repeat' );
	$penci_login_bg_pos          = penci_get_theme_mod( 'penci_login_bg_pos' );
	$penci_login_bg_size         = penci_get_theme_mod( 'penci_login_bg_size' );
	$lregister_bg_color          = penci_get_theme_mod( 'penci_login_register_bg_color' );
	$lregister_title_color       = penci_get_theme_mod( 'penci_login_register_title_color' );
	$lregister_text_color        = penci_get_theme_mod( 'penci_login_register_text_color' );
	$lregister_input_color       = penci_get_theme_mod( 'penci_login_register_input_color' );
	$lregister_input_placeholder = penci_get_theme_mod( 'penci_login_register_input_placeholder' );
	$lregister_input_brcolor     = penci_get_theme_mod( 'penci_login_register_input_brcolor' );
	$lregister_link_color        = penci_get_theme_mod( 'penci_login_register_link_color' );
	$lregister_link_hcolor       = penci_get_theme_mod( 'penci_login_register_link_hcolor' );
	$lregister_button_color      = penci_get_theme_mod( 'penci_login_register_button_color' );
	$lregister_button_bgcolor    = penci_get_theme_mod( 'penci_login_register_button_bgcolor' );
	$lregister_button_hcolor     = penci_get_theme_mod( 'penci_login_register_button_hcolor' );
	$lregister_button_hbgcolor   = penci_get_theme_mod( 'penci_login_register_button_hbgcolor' );


	$penci_login_background = '';
	if ( $penci_login_bg_img ) {
		$penci_login_background .= sprintf( 'background-image:url(%s);', esc_attr( $penci_login_bg_img ) );
	}

	if ( $penci_login_bg_repeat ) {
		$penci_login_background .= sprintf( 'background-repeat:%s;', esc_attr( $penci_login_bg_repeat ) );
	}

	if ( $penci_login_bg_pos ) {
		$penci_login_background .= sprintf( 'background-position:%s;', esc_attr( $penci_login_bg_pos ) );
	}

	if ( $penci_login_bg_size ) {
		$penci_login_background .= sprintf( 'background-size:%s;', esc_attr( $penci_login_bg_size ) );
	}

	if ( $lregister_bg_color ) {
		$penci_login_background .= sprintf( 'background-color:%s', esc_attr( $lregister_bg_color ) );
	}

	if ( $penci_login_background ) {
		$css .= sprintf( '.penci-popup-login-register .penci-login-container{ %s; }', esc_attr( $penci_login_background ) );
	}

	if ( $lregister_title_color ) {
		$css .= sprintf( '.penci-popup-login-register h4{ color:%s ; }', $lregister_title_color );
	}

	if ( $lregister_text_color ) {
		$css .= sprintf( '.penci-popup-login-register .penci-login-container{ color:%s ; }', $lregister_text_color );
	}


	if ( $lregister_input_color ) {
		$css .= sprintf( '.penci-login-container .penci-login input[type="text"], .penci-login-container .penci-login input[type=password], .penci-login-container .penci-login input[type="submit"], .penci-login-container .penci-login input[type="email"]{ color:%s ; }',
			esc_attr( $lregister_input_color ) );
	}

	if ( $lregister_input_placeholder ) {
		$css .= sprintf(
			'.penci-popup-login-register .penci-login-container .penci-login input[type="text"]::-webkit-input-placeholder,' .
			'.penci-popup-login-register .penci-login-container .penci-login input[type=password]::-webkit-input-placeholder,' .
			'.penci-popup-login-register .penci-login-container .penci-login input[type="submit"]::-webkit-input-placeholder,' .
			'.penci-popup-login-register .penci-login-container .penci-login input[type="email"]::-webkit-input-placeholder{ color:%s !important; }' .

			'.penci-popup-login-register .penci-login-container .penci-login input[type="text"]::-moz-placeholder,' .
			'.penci-popup-login-register .penci-login-container .penci-login input[type=password]::-moz-placeholder,' .
			'.penci-popup-login-register .penci-login-container .penci-login input[type="submit"]::-moz-placeholder,' .
			'.penci-popup-login-register .penci-login-container .penci-login input[type="email"]::-moz-placeholder{ color:%s !important; }' .

			'.penci-popup-login-register .penci-login-container .penci-login input[type="text"]:-ms-input-placeholder,' .
			'.penci-popup-login-register .penci-login-container .penci-login input[type=password]:-ms-input-placeholder,' .
			'.penci-popup-login-register .penci-login-container .penci-login input[type="submit"]:-ms-input-placeholder,' .
			'.penci-popup-login-register .penci-login-container .penci-login input[type="email"]:-ms-input-placeholder{ color:%s !important; }' .

			'.penci-popup-login-register .penci-login-container .penci-login input[type="text"]:-moz-placeholder,' .
			'.penci-popup-login-register .penci-login-container .penci-login input[type=password]:-moz-placeholder,' .
			'.penci-popup-login-register .penci-login-container .penci-login input[type="submit"]:-moz-placeholder,' .
			'.penci-popup-login-register .penci-login-container .penci-login input[type="email"]:-moz-placeholder { color:%s !important; }',
			esc_attr( $lregister_input_placeholder ),
			esc_attr( $lregister_input_placeholder ),
			esc_attr( $lregister_input_placeholder ),
			esc_attr( $lregister_input_placeholder )
		);
	}

	if ( $lregister_input_brcolor ) {
		$css .= sprintf( '.penci-popup-login-register .penci-login-container .penci-login input[type="text"],
		 .penci-popup-login-register .penci-login-container .penci-login input[type=password],
		 .penci-popup-login-register .penci-login-container .penci-login input[type="submit"],
		 .penci-popup-login-register .penci-login-container .penci-login input[type="email"]{ border-color:%s ; }',
			esc_attr( $lregister_input_brcolor ) );
	}


	if ( $lregister_link_color ) {
		$css .= sprintf( '.penci-popup-login-register .penci-login-container a{ color:%s ; }', esc_attr( $lregister_link_color ) );
	}

	if ( $lregister_link_hcolor ) {
		$css .= sprintf( '.penci-popup-login-register .penci-login-container a:hover{ color:%s ; }', esc_attr( $lregister_link_hcolor ) );
	}


	if ( $lregister_button_color ) {
		$css .= sprintf( '.penci-popup-login-register .penci-login-container .penci-login input[type="submit"]{ color:%s ; }', esc_attr( $lregister_button_color ) );
	}

	if ( $lregister_button_bgcolor ) {
		$css .= sprintf( '.penci-popup-login-register .penci-login-container .penci-login input[type="submit"]{ background-color:%s ; }', esc_attr( $lregister_button_bgcolor ) );
	}

	if ( $lregister_button_hcolor ) {
		$css .= sprintf( '.penci-popup-login-register .penci-login-container .penci-login input[type="submit"]:hover{ color:%s ; }', esc_attr( $lregister_button_hcolor ) );
	}

	if ( $lregister_button_hbgcolor ) {
		$css .= sprintf( '.penci-popup-login-register .penci-login-container .penci-login input[type="submit"]:hover{ background-color:%s ; }', esc_attr( $lregister_button_hbgcolor ) );
	}


	return $css;
}