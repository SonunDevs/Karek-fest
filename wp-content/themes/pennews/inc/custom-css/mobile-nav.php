<?php
if ( function_exists( 'penci_customizer_mobile_nav' ) ) {
	return;
}
function penci_customizer_mobile_nav() {
	$css = '';

	// Text logo
	if ( ! penci_get_theme_mod( 'hide_mobile_nav_logo' ) ) {
		$font_textlogo_on_mobile = penci_get_theme_mod( 'penci_font_textlogo_mobile_nav' );

		$css_nav_logo = '';
		if ( $font_textlogo_on_mobile ) {
			$css_nav_logo .= 'font-family: ' . penci_google_fonts_parse_attributes( $font_textlogo_on_mobile ) . ';';
		}

		if ( penci_get_theme_mod( 'penci_fweight_textlogo_mobile_nav' ) ) {
			$css_nav_logo .= 'font-weight: ' . esc_attr( penci_get_theme_mod( 'penci_fweight_textlogo_mobile_nav' ) ) . ';';
		}

		if ( penci_get_theme_mod( 'penci_fsize_textlogo_mobile_nav' ) ) {
			$css_nav_logo .= 'font-size: ' . penci_get_theme_mod( 'penci_fsize_textlogo_mobile_nav' ) . 'px;';
		}

		if ( $css_nav_logo ) {
			$css .= '.mobile-sidebar #sidebar-nav-logo a{' . ( $css_nav_logo ) . '}';
		}
	}

	$penci_mobile_bg           = penci_get_theme_mod( 'penci_mobile_bg' );
	$mobile_overlay_color      = penci_get_theme_mod( 'mobile_overlay_color' );
	$mobile_close_bg           = penci_get_theme_mod( 'mobile_close_bg' );
	$mobile_close_color        = penci_get_theme_mod( 'mobile_close_color' );
	$mobile_nav_bg             = penci_get_theme_mod( 'mobile_nav_bg' );
	$mobile_accent_color       = penci_get_theme_mod( 'mobile_accent_color' );
	$mobile_accent_hover_color = penci_get_theme_mod( 'mobile_accent_hover_color' );
	$mobile_items_border       = penci_get_theme_mod( 'mobile_items_border' );

	if ( $penci_mobile_bg ) {
		$css .= sprintf( '.mobile-sidebar{ background-image:url( %s ); }', esc_attr( $penci_mobile_bg ) );
	}
	if ( $mobile_overlay_color ) {
		$css .= sprintf( '#close-sidebar-nav:before{ background-color:%s ; }', esc_attr( $mobile_overlay_color ) );
	}

	if ( $mobile_close_bg ) {
		$css .= sprintf( '#close-sidebar-nav i { background-color:%s ; }', esc_attr( $mobile_close_bg ) );
	}

	if ( $mobile_close_color ) {
		$css .= sprintf( '#close-sidebar-nav i { color:%s ; }', esc_attr( $mobile_close_color ) );
	}

	if ( $mobile_nav_bg ) {
		$css .= sprintf( '.mobile-sidebar{ background-color:%s ; }', esc_attr( $mobile_nav_bg ) );
	}

	if ( $mobile_accent_color ) {
		$css .= sprintf(
			'.mobile-sidebar .primary-menu-mobile li a,
			.mobile-sidebar .sidebar-nav-social a, 
			.mobile-sidebar #sidebar-nav-logo a,
			.mobile-sidebar .primary-menu-mobile .dropdown-toggle{ color:%s ; }', esc_attr( $mobile_accent_color ) );
	}

	if ( $mobile_accent_hover_color ) {
		$css .= sprintf(
			'.mobile-sidebar .primary-menu-mobile li a:hover,
			.mobile-sidebar .sidebar-nav-social a:hover ,
			.mobile-sidebar #sidebar-nav-logo a:hover,
			.mobile-sidebar .primary-menu-mobile .dropdown-toggle:hover { color:%s ; }', esc_attr( $mobile_accent_hover_color ) );
	}

	if ( $mobile_items_border ) {
		$css .= sprintf( '.mobile-sidebar .primary-menu-mobile li, .mobile-sidebar ul.sub-menu{ border-color:%s ; }', esc_attr( $mobile_items_border ) );
	}

	$nav_menu_font_size =  penci_get_theme_mod( 'penci_mobile_nav_menu_font_size' );
	if( $nav_menu_font_size ) {
		$css .= sprintf( '.mobile-sidebar .primary-menu-mobile li a{ font-size:%spx ; }', esc_attr( $nav_menu_font_size ) );
	}

	$textlogo_fsize =  penci_get_theme_mod( 'penci_mobile_nav_textlogo_fsize' );
	if( $textlogo_fsize ) {
		$css .= sprintf( '.mobile-sidebar #sidebar-nav-logo a{ font-size:%spx ; }', esc_attr( $textlogo_fsize ) );
	}

	return $css;
}