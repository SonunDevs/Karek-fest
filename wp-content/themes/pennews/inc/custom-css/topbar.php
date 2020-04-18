<?php
if ( function_exists( 'penci_customizer_topbar' ) ){
	return;
}
function penci_customizer_topbar() {

	$css = '';

	// Extra
	$topbar_font_size   = penci_get_theme_mod( 'penci_topbar_font_size' );
	$trending_text_fsize  = penci_get_theme_mod( 'penci_topbar_trending_text_fsize' );
	$trending_ptitle_fsize  = penci_get_theme_mod( 'penci_topbar_trending_ptitle_fsize' );
	$penci_topbar_socials_fsize  = penci_get_theme_mod( 'penci_topbar_socials_fsize' );

	if( $topbar_font_size ) {
		$css .= '.penci-topbar h3, .penci-topbar, .penci-topbar ul.menu>li>a,.penci-topbar ul.menu li ul.sub-menu li a,'.
		'.penci-topbar ul.topbar__logout li a, .topbar_weather .penci-weather-degrees{ font-size: ' . esc_attr( $topbar_font_size ) . 'px; }';
	}
	if( $trending_text_fsize ) {
		$css .= '.penci-topbar .topbar__trending .headline-title{ font-size: ' . esc_attr( $trending_text_fsize ) . 'px; }';
	}
	if( $trending_ptitle_fsize ) {
		$css .= '.penci-topbar .topbar__trending h3.penci__post-title{ font-size: ' . esc_attr( $trending_ptitle_fsize ) . 'px; }';
	}

	if( $penci_topbar_socials_fsize ) {
		$css .= '.penci-topbar .topbar__social-media a{ font-size: ' . esc_attr( $penci_topbar_socials_fsize ) . 'px; }';
	}

	$turn_off_upearcase = penci_get_theme_mod( 'penci_topbar_turn_off_upearcase' );
	$trending_width     = penci_get_theme_mod( 'penci_topbar_trending_width' );
	$trending_speed     = penci_get_theme_mod( 'penci_topbar_trending_speed' );
	$bgcolor            = penci_get_theme_mod( 'penci_topbar_bgcolor' );
	$color              = penci_get_theme_mod( 'penci_topbar_color' );
	$hover_color        = penci_get_theme_mod( 'penci_topbar_hover_color' );
	$icon_color         = penci_get_theme_mod( 'penci_topbar_icon_color' );
	$icon_hcolor        = penci_get_theme_mod( 'penci_topbar_icon_hcolor' );
	$tren_bgcolor       = penci_get_theme_mod( 'penci_topbar_tren_bgcolor' );
	$tren_color         = penci_get_theme_mod( 'penci_topbar_tren_color' );
	$submenu_bgcolor    = penci_get_theme_mod( 'penci_topbar_submenu_bgcolor' );
	$submenu_color      = penci_get_theme_mod( 'penci_topbar_submenu_color' );
	$submenu_hcolor     = penci_get_theme_mod( 'penci_topbar_submenu_hcolor' );
	$border_items       = penci_get_theme_mod( 'penci_topbar_border_items' );


	if( $turn_off_upearcase ) {
		$css .= '.penci-topbar.header--s7, .penci-topbar.header--s7 h3, 
		.penci-topbar.header--s7 ul li,
		.penci-topbar.header--s7 .topbar__trending .headline-title{ text-transform: none !important; }';
	}

	if ( $trending_speed ) {
		$css .= sprintf( '.topbar__trending .penci-owl-carousel-slider .animated { animation-duration: %sms; }', intval( $trending_speed ) );
	}

	if ( $trending_width ) {
		$trending_width = $trending_width >= 300 ? $trending_width : 300;

		$css .= sprintf( '.topbar__trending{ width:%spx ; }', esc_attr( $trending_width ) );
	}

	if ( $bgcolor ) {
		$css .= sprintf( '.penci-topbar{ background-color:%s ; }', esc_attr( $bgcolor ) );
	}

	if ( $color ) {
		$css .= sprintf( '.penci-topbar,.penci-topbar a, .penci-topbar ul li a{ color:%s ; }', esc_attr( $color ) );
	}

	if ( $hover_color ) {
		$css .= sprintf( '.penci-topbar a:hover , .penci-topbar ul li a:hover{ color:%s ; }', esc_attr( $hover_color ) );
	}

	if ( $icon_color ) {
		$css .= sprintf( '.topbar__social-media a{ color:%s ; }', esc_attr( $icon_color ) );
	}

	if ( $icon_hcolor ) {
		$css .= sprintf( '.topbar__social-media a:hover{ color:%s ; }', esc_attr( $icon_hcolor ) );
	}

	if ( $submenu_bgcolor ) {
		$css .= sprintf( '.penci-topbar ul.menu li ul.sub-menu{ background-color:%s ; }', esc_attr( $submenu_bgcolor ) );
	}

	if ( $submenu_color ) {
		$css .= sprintf( '.penci-topbar ul.menu li ul.sub-menu li a{ color:%s ; }', esc_attr( $submenu_color ) );
	}

	if ( $submenu_hcolor ) {
		$css .= sprintf( '.penci-topbar ul.menu li ul.sub-menu li a:hover{ color:%s ; }', esc_attr( $submenu_hcolor ) );
	}

	if ( $border_items ) {
		$css .= sprintf( '.penci-topbar ul.menu li ul.sub-menu li{ border-color:%s ; }', esc_attr( $border_items ) );
	}

	if ( $tren_bgcolor ) {
		$css .= sprintf( '.penci-topbar .topbar__trending .headline-title{ background-color:%s ; }', esc_attr( $tren_bgcolor ) );
	}

	if ( $tren_color ) {
		$css .= sprintf( '.penci-topbar .topbar__trending .headline-title{ color:%s ; }', esc_attr( $tren_color ) );
	}

	return $css;
}