<?php
if ( function_exists( 'penci_customizer_menu_hamburger' ) ) {
	return;
}
function penci_customizer_menu_hamburger() {
	$css = '';

	$header_layout = penci_get_theme_mod( 'penci_header_layout' );
	$hbg_show      = penci_get_theme_mod( 'penci_menu_hbg_show' );
	$nav_show      = penci_get_theme_mod( 'penci_verttical_nav_show' );

	if ( ! ( $hbg_show || $nav_show ) ) {
		return;
	}

	$hbg_bgimg          = penci_get_theme_mod( 'penci_menu_hbg_bgimg' );
	$hbg_bgcolor        = penci_get_theme_mod( 'penci_menu_hbg_bgcolor' );
	$fontsize_textlogo  = penci_get_theme_mod( 'penci_menu_hbg_fontsize_textlogo' );
	$fontsize_sitetitle = penci_get_theme_mod( 'penci_menu_hbg_fontsize_sitetitle' );
	$fontsize_desc      = penci_get_theme_mod( 'penci_menu_hbg_fontsize_desc' );
	$fontsize_ftext     = penci_get_theme_mod( 'penci_menu_hbg_fontsize_ftext' );
	$hbgfweight_wtitle  = penci_get_theme_mod( 'penci_menu_hbgfweight_wtitle' );
	$hbgfsize_wtitle    = penci_get_theme_mod( 'penci_menu_hbgfsize_wtitle' );
	$hbg_fsize_menu     = penci_get_theme_mod( 'penci_menu_hbg_fsize_menu' );

	$hbg_width     = penci_get_theme_mod( 'penci_menu_hbg_width' );
	if ( $hbg_width && 340 != $hbg_width && $hbg_width > 269 && $hbg_width < 501 ) {
		$css .= '.penci-menu-hbg { width:' . esc_attr( $hbg_width ) . 'px; transform: translateX(-' . esc_attr( $hbg_width ) . 'px); -webkit-transform: translateX(-' . esc_attr( $hbg_width ) . 'px); -moz-transform: translateX(-' . esc_attr( $hbg_width ) . 'px); }';
		$css .= '.penci-menu-hbg.penci-menu-hbg-right {transform: translateX(' . esc_attr( $hbg_width ) . 'px); -webkit-transform: translateX(' . esc_attr( $hbg_width ) . 'px); -moz-transform: translateX(' . esc_attr( $hbg_width ) . 'px);}';

		$css .= '.penci-menu-hbg .penci-block-vc .penci-block__title span:before, .penci-menu-hbg .penci-block-vc .penci-block__title span:after,';
		$css .= '.penci-menu-hbg-widgets .menu-hbg-title span:before,';
		$css .= '.penci-menu-hbg-widgets .menu-hbg-title span:after';
		$css .= '{width:' . esc_attr( $hbg_width ) . 'px}';

		if ( $nav_show ) {
			$css .= '.penci-vernav-poleft.penci-menuhbg-open .penci-vernav-toggle{left: ' . esc_attr( $hbg_width ) . 'px;}';
			$css .= '.penci-vernav-poright.penci-menuhbg-open .penci-vernav-toggle{right: ' . esc_attr( $hbg_width ) . 'px;}';

			$css .= '@media only screen and (min-width: 1240px) {';
			$css .= '.penci-vernav-enable .penci-menu-hbg-left + .penci-wrapper-boxed{padding-left: ' . esc_attr( $hbg_width ) . 'px;}';
			$css .= '.penci-vernav-enable .penci-menu-hbg-right + .penci-wrapper-boxed{padding-right: ' . esc_attr( $hbg_width ) . 'px;}';
			$css .= '.penci-vernav-enable .is-sticky .site-header{width: calc(100% - ' . esc_attr( $hbg_width ) . 'px);}';
			$css .= '}';
		}
	}


	if ( $hbg_bgimg ) {
		$css .= sprintf( '.penci-menu-hbg{ background-image:url( %s ); }', esc_attr( $hbg_bgimg ) );
	}

	if ( $hbg_bgcolor ) {
		$css .= sprintf( '.penci-menu-hbg{ background-color: %s; }', esc_attr( $hbg_bgcolor ) );
	}

	if ( $hbg_bgcolor ) {
		$css .= '.penci-hbg-logo .site-title { color: ' . $hbg_bgcolor . '; }';
	}

	if ( $fontsize_textlogo ) {
		$css .= '.penci-hbg-logo .site-title { font-size: ' . $fontsize_textlogo . 'px;line-height: ' . $fontsize_textlogo . 'px; }';
	}

	if ( $fontsize_sitetitle ) {
		$css .= '.penci-menu-hbg-inner .penci-hbg_sitetitle { font-size: ' . $fontsize_sitetitle . 'px; }';
	}

	if ( $fontsize_desc ) {
		$css .= '.penci-menu-hbg-inner .penci-hbg_desc { font-size: ' . $fontsize_desc . 'px; }';
	}

	if ( $fontsize_ftext ) {
		$css .= '.penci-menu-hbg-inner .penci_menu_hbg_ftext { font-size: ' . $fontsize_ftext . 'px; }';
	}

	if ( $hbgfweight_wtitle ) {
		$css .= '.penci-menu-hbg-widgets .menu-hbg-title{ font-weight: ' . $hbgfweight_wtitle . '; }';
	}

	if ( $hbgfsize_wtitle ) {
		$css .= '.penci-menu-hbg-widgets .menu-hbg-title{ font-size: ' . $hbgfsize_wtitle . 'px; }';
	}

	if ( $hbg_fsize_menu ) {
		$css .= '.penci-menu-hbg .primary-menu-mobile li a, .penci-menu-hbg .primary-menu-mobile .dropdown-toggle{ font-size: ' . $hbg_fsize_menu . 'px; }';
	}


	$hbgtitle_color  = penci_get_theme_mod( 'penci_menu_hbgtitle_color' );
	$hbgdesc_hcolor  = penci_get_theme_mod( 'penci_menu_hbgdesc_hcolor' );
	$hbgfooter_color = penci_get_theme_mod( 'penci_menu_hbgfooter_color' );

	if ( $hbgtitle_color ) {
		$css .= '.penci-hbg_sitetitle { color: ' . $hbgtitle_color . '; }';
	}

	if ( $hbgdesc_hcolor ) {
		$css .= '.penci-hbg_desc { color: ' . $hbgdesc_hcolor . '; }';
	}

	if ( $hbgfooter_color ) {
		$css .= '.penci_menu_hbg_ftext { color: ' . $hbgfooter_color . '; }';
	}


	$showsocial = penci_get_theme_mod( 'penci_menu_hbg_showsocial' );
	$showsocial = $showsocial ? $showsocial : 1;

	if ( $showsocial ) {

		$hbgfsize_social = penci_get_theme_mod( 'penci_menu_hbgfsize_social' );
		$hbg_wh_social   = penci_get_theme_mod( 'penci_menu_hbg_wh_social' );

		$icon_color          = penci_get_theme_mod( 'penci_menu_hbgicon_color' );
		$icon_bg_color       = penci_get_theme_mod( 'penci_menu_hbgicon_bg_color' );
		$icon_hover_color    = penci_get_theme_mod( 'penci_menu_hbgicon_hover_color' );
		$icon_bg_hover_color = penci_get_theme_mod( 'penci_menu_hbgicon_bg_hover_color' );

		if ( $icon_color ) {
			$css .= sprintf( '.penci-menu-hbg-socials .social-media-item{ color:%s !important; }', esc_attr( $icon_color ) );
		}

		if ( $icon_bg_color ) {
			$css .= sprintf( '.penci-menu-hbg-socials .social-media-item{ background-color:%s!important ; }', esc_attr( $icon_bg_color ) );
			$css .= sprintf( '.penci-menu-hbg-socials .social-media-item.socail_media__instagram:before{ content: none; }' );
		}

		if ( $icon_bg_hover_color ) {
			$css .= sprintf( '.penci-menu-hbg-socials .social-media-item:hover{ background-color:%s !important; }', esc_attr( $icon_bg_hover_color ) );
		}

		if ( $icon_hover_color ) {
			$css .= sprintf( '.penci-menu-hbg-socials .social-media-item:hover{ color:%s !important; }', esc_attr( $icon_hover_color ) );
		}

		if ( $hbgfsize_social ) {
			$css .= sprintf( '.penci-menu-hbg-socials .social-media-item{font-size:%spx;}', esc_attr( $hbgfsize_social ) );
		}

		if ( $hbg_wh_social ) {
			$css .= sprintf( '.penci-menu-hbg-socials .social-media-item{ width:%spx; height:%spx; line-height:%spx; }',
				esc_attr( $hbg_wh_social ), esc_attr( $hbg_wh_social ), esc_attr( $hbg_wh_social )
			);
		}
	}

	$accent_color       = penci_get_theme_mod( 'penci_menu_hbgaccent_color' );
	$accent_hover_color = penci_get_theme_mod( 'penci_menu_hbgaccent_hover_color' );
	$items_border       = penci_get_theme_mod( 'penci_menu_hbgitems_border' );

	if ( $accent_color ) {
		$css .= '.penci-menu-hbg .primary-menu-mobile li a,';
		$css .= '.penci-menu-hbg .sidebar-nav-social a,';
		$css .= '.penci-menu-hbg #sidebar-nav-logo a,';
		$css .= '.penci-menu-hbg .primary-menu-mobile .dropdown-toggle';

		$css .= '{ color:' . esc_attr( $accent_color ) . ' !important ; }';
	}

	if ( $accent_hover_color ) {
		$css .= '.penci-menu-hbg .primary-menu-mobile li a:hover,';
		$css .= '.penci-menu-hbg .primary-menu-mobile li.toggled-on > a,';
		$css .= '.penci-menu-hbg .primary-menu-mobile li.toggled-on > .dropdown-toggle,';
		$css .= '.penci-menu-hbg .primary-menu-mobile li.current-menu-item > a,';
		$css .= '.penci-menu-hbg .primary-menu-mobile li.current-menu-item > .dropdown-toggle,';

		$css .= '.penci-menu-hbg .sidebar-nav-social a:hover,';
		$css .= '.penci-menu-hbg #sidebar-nav-logo a:hover,';
		$css .= '.penci-menu-hbg .primary-menu-mobile .dropdown-toggle:hover,';
		$css .= '{ color: ' . esc_attr( $accent_hover_color ) . '; }';
	}

	if ( $items_border ) {
		$css .= sprintf( '.penci-menu-hbg .primary-menu-mobile li, .penci-menu-hbg ul.sub-menu{ border-color:%s ; }', esc_attr( $items_border ) );
	}

	if ( penci_get_theme_mod( 'penci_menu_hbg_menuoff_upper' ) ) {
		$css .= sprintf( '.penci-menu-hbg .primary-menu-mobile li a{ text-transform: none; }' );
	}

	$hbgwidget_align = penci_get_theme_mod( 'penci_menu_hbgwidget_align' );

	if ( 'left' == $hbgwidget_align ) {
		$css .= '.penci-menu-hbg-widgets .menu-hbg-title ,.penci-menu-hbg .penci-block-vc .penci-block__title{ text-align:left; }';
		$css .= '.penci-menu-hbg-widgets .menu-hbg-title span:before, .penci-menu-hbg .penci-block-vc .penci-block__title span:before{ content: none; }';
	} elseif ( 'right' == $hbgwidget_align ) {
		$css .= '.penci-menu-hbg-widgets .menu-hbg-title, .penci-menu-hbg .penci-block-vc .penci-block__title{ text-align:right; }';
		$css .= '.penci-menu-hbg-widgets .menu-hbg-title span:after, .penci-menu-hbg .penci-block-vc .penci-block__title span:after{ content: none; }';
	}

	$widget_title_color = penci_get_theme_mod( 'penci_mhbg_widget_title_color' );
	$widget_line_color  = penci_get_theme_mod( 'penci_mhbg_widget_line_color' );
	if ( $widget_title_color ) {
		$css .= '.penci-menu-hbg .penci-block-vc .penci-block__title,.penci-menu-hbg-widgets .menu-hbg-title,.penci-menu-hbg .penci-block-vc .penci-block__title a,.penci-menu-hbg .penci-block-vc .penci-block__title span { color: ' . $widget_title_color . ' }';
	}
	if ( $widget_line_color ) {
		$css .= '.penci-menu-hbg .penci-block-vc .penci-block__title span:before,
		 .penci-menu-hbg .penci-block-vc .penci-block__title span:after,
		  .penci-menu-hbg-widgets .menu-hbg-title span:before,
		   .penci-menu-hbg-widgets .menu-hbg-title span:after{ border-color: ' . $widget_line_color . ' }';
	}

	return $css;
}