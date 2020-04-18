<?php
if ( function_exists( 'penci_customizer_header' ) ){
	return;
}
function penci_customizer_header() {
	$padding_top_logo      = penci_get_theme_mod( 'penci_logo_padding_top' );
	$padding_bottom_logo   = penci_get_theme_mod( 'penci_logo_padding_bottom' );
	$width_logo            = penci_get_theme_mod( 'penci_logo_width' );
	$header_layout         = penci_get_setting( 'penci_header_layout' );
	$main_menu_line_height = penci_get_theme_mod( 'penci_main_menu_line_height' );
	$css                   = '';

	if( $padding_top_logo || 0 === $padding_top_logo  ){

		if( in_array( $header_layout, array( 'header_s3','header_s4','header_s6' ) ) ) {
			$css .= sprintf( '.site-header .site-branding,.header__top .site-branding{ padding-top:%spx !important; }',
				esc_attr( $padding_top_logo )
			);
		}elseif( in_array( $header_layout, array( 'header_s2','header_s8', 'header_s9' ) ) ){
			$css .= '.header__top.header--s2{ padding-top:' . esc_attr( $padding_top_logo ) . 'px; }';
		}else{
			$css .= sprintf( '.site-header .site-branding a,.header__top .site-branding a{ transform: translateY( %spx ); }',
				esc_attr( $padding_top_logo )
			);
		}
	}

	if( $padding_bottom_logo || 0 === $padding_bottom_logo  ){
		if( in_array( $header_layout, array( 'header_s3','header_s4','header_s6' ) ) ) {
			$css .= sprintf( '.site-header .site-branding,.header__top .site-branding{ padding-bottom:%spx !important; }',
				esc_attr( $padding_bottom_logo )
			);
		}elseif( in_array( $header_layout, array( 'header_s2','header_s8','header_s9' ) ) ){
			$css .= '.header__top.header--s2{ padding-bottom:' . esc_attr( $padding_bottom_logo ) . 'px; }';
		}else{
			$css .= sprintf( '.site-header .site-branding .site-title,.header__top .site-branding .site-title{ padding-bottom:%spx !important; }',
				esc_attr( $padding_bottom_logo )
			);
		}
	}
	if ( $width_logo && ( in_array( $header_layout, array('header_s3', 'header_s4', 'header_s6', 'header_s12', 'header_s13') ) || ( $width_logo < 400 ) ) ) {

		if ( 'header_s1' == $header_layout ) {
			$css .= sprintf( '.header--s1 .site-branding,.header--s1 .site-branding img {max-width: %spx !important;overflow: hidden; }', esc_attr( $width_logo ) );
		} elseif ( 'header_s2' == $header_layout ) {
			$css .= sprintf( '.header--s2 .site-branding,.header--s2 .site-branding img {max-width: %spx !important;overflow: hidden; }', esc_attr( $width_logo ) );
		} elseif ( 'header_s3' == $header_layout || 'header_s4' == $header_layout ) {
			$css .= sprintf( '.header--s3 .site-branding img {max-width: %spx !important;overflow: hidden; }', esc_attr( $width_logo ) );
		} elseif ( 'header_s5' == $header_layout ) {
			$css .= sprintf( '.header--s5 .site-branding,.header--s5 .site-branding img {max-width: %spx !important;overflow: hidden; }', esc_attr( $width_logo ) );
		} elseif ( 'header_s6' == $header_layout ) {
			$css .= sprintf( '.header--s6 .site-branding img {max-width: %spx !important;overflow: hidden; }', esc_attr( $width_logo ) );
		} elseif ( 'header_s7' == $header_layout ) {
			$css .= sprintf( '.header--s7 .site-branding,.header--s7 .site-branding img {max-width: %spx !important;overflow: hidden; }', esc_attr( $width_logo ) );
		} elseif ( 'header_s8' == $header_layout ) {
			$css .= sprintf( '.header--s8 .site-branding img {max-width: %spx !important;overflow: hidden; }', esc_attr( $width_logo ) );
		} elseif ( 'header_s9' == $header_layout ) {
			$css .= sprintf( '.header--s9 .site-branding img {max-width: %spx !important;overflow: hidden; }', esc_attr( $width_logo ) );
		} elseif ( 'header_s10' == $header_layout ) {
			$css .= sprintf( '.header--s10 .site-branding,.header--s10 .site-branding img {max-width: %spx !important;overflow: hidden; }', esc_attr( $width_logo ) );
		} elseif ( 'header_s11' == $header_layout ) {
			$css .= sprintf( '.header--s11 .site-branding,.header--s11 .site-branding img {max-width: %spx !important;overflow: hidden; }', esc_attr( $width_logo ) );
		}elseif ( 'header_s12' == $header_layout ) {
			$css .= sprintf( '.header--s12 .site-branding,.header--s12 .site-branding img {max-width: %spx !important;overflow: hidden; }', esc_attr( $width_logo ) );
		}elseif ( 'header_s13' == $header_layout ) {
			$css .= sprintf( '.header--s13 .site-branding,.header--s13 .site-branding img {max-width: %spx !important;overflow: hidden; }', esc_attr( $width_logo ) );
		}else{
			$css .= sprintf( '.header__top .site-branding img {max-width: %spx !important;overflow: hidden; }', esc_attr( $width_logo ) );
		}
	}

	// Slogan
	$css_slogan = '';
	$font_slogan        = penci_get_theme_mod( 'penci_font_slogan' );
	$font_weight_slogan = penci_get_theme_mod( 'penci_font_weight_slogan' );
	$font_style_slogan  = penci_get_theme_mod( 'penci_font_style_slogan' );
	$fontsize_slogan    = penci_get_theme_mod( 'penci_fontsize_slogan' );
	$padding_top_slogan = penci_get_theme_mod( 'penci_padding_top_slogan' );

	if ( $font_slogan ) {
		$css_slogan .= sprintf( 'font-family: %s;', penci_google_fonts_parse_attributes( $font_slogan ) );
	}
	if ( $font_weight_slogan ) {
		$css_slogan .= sprintf( 'font-weight: %s;', esc_attr( $font_weight_slogan ) );
	}
	if ( $font_style_slogan ) {
		$css_slogan .= sprintf( 'font-style: %s;', esc_attr( $font_style_slogan ) );
	}
	if ( $fontsize_slogan ) {
		$css_slogan .= sprintf( 'font-size: %spx;', esc_attr( $fontsize_slogan ) );
	}

	if ( $padding_top_slogan ) {
		$css_slogan .= sprintf( 'padding-top: %spx;', esc_attr( $padding_top_slogan ) );
	}

	if ( $css_slogan ) {
		$css .= '.site-description{ ' . $css_slogan . ' }';
	}

	// Main menu
	$font_main_menu_item           = penci_get_theme_mod( 'penci_font_main_menu_item' );
	$font_weight_menu_item         = penci_get_theme_mod( 'penci_font_weight_menu_item' );
	$font_size_menu_lever1         = penci_get_theme_mod( 'penci_font_size_menu_lever1' );
	$font_size_menu_dropdown       = penci_get_theme_mod( 'penci_font_size_menu_dropdown' );
	$font_size_child_cat_mega      = penci_get_theme_mod( 'penci_font_size_child_cat_mega' );
	$font_size_ptitle_cat_mega     = penci_get_theme_mod( 'penci_font_size_ptitle_cat_mega' );
	$font_size_pdate_cat_mega      = penci_get_theme_mod( 'penci_font_size_pdate_cat_mega' );
	$hide_uppercase_menu_item      = penci_get_theme_mod( 'penci_hide_uppercase_menu_item' );
	$hide_uppercase_chid_mega_menu = penci_get_theme_mod( 'penci_hide_uppercase_chid_mega_menu' );
	$align_pdate_mega_menu   = penci_get_theme_mod( 'penci_align_pdate_mega_menu' );
	$font_for_body                 = penci_default_setting( 'penci_font_for_body' );

	if( $main_menu_line_height && $main_menu_line_height >= 35 ) {

		$css .='.main-navigation > ul:not(.children) > li.highlight-button{ min-height: ' . esc_attr( $main_menu_line_height ) . 'px; }';

		$css .='.site-header,.main-navigation > ul:not(.children) > li > a,';
		$css .='.site-header.header--s7 .main-navigation > ul:not(.children) > li > a,';
		$css .='.search-click,';
		$css .='.penci-menuhbg-wapper,';
		$css .='.header__social-media,';
		$css .='.site-header.header--s7,';
		$css .='.site-header.header--s1 .site-branding .site-title,';
		$css .='.site-header.header--s7 .site-branding .site-title,';
		$css .='.site-header.header--s10 .site-branding .site-title,';
		$css .='.site-header.header--s5 .site-branding .site-title';
		$css .='{ line-height: ' . intval( $main_menu_line_height - 1 ) . 'px; min-height: ' . esc_attr( $main_menu_line_height ) . 'px; }';

		$css .= '.site-header.header--s7 .custom-logo, .site-header.header--s10 .custom-logo,.site-header.header--s11 .custom-logo, .site-header.header--s1 .custom-logo, .site-header.header--s5 .custom-logo { max-height: ' .  intval( $main_menu_line_height - 4 ) . 'px; }';
	}

	if ( $font_main_menu_item || $font_for_body != penci_default_setting( 'penci_font_for_body' ) ) {
		$css .= sprintf( '.main-navigation a,.mobile-sidebar .primary-menu-mobile li a, .penci-menu-hbg .primary-menu-mobile li a{ font-family: %s; }',
			penci_google_fonts_parse_attributes( $font_main_menu_item ) );
	}

	if ( $font_weight_menu_item ) {
		$css .= sprintf( '.main-navigation a,.mobile-sidebar .primary-menu-mobile li a, .penci-menu-hbg .primary-menu-mobile li a{ font-weight: %s; }',
			esc_attr( $font_weight_menu_item ) );
	}

	if ( $font_size_menu_lever1 ) {
		$css .= sprintf( '.main-navigation > ul:not(.children) > li > a{ font-size: %spx; }', esc_attr( $font_size_menu_lever1 ) );
	}

	if ( $font_size_menu_dropdown ) {
		$css .= sprintf( '.main-navigation ul ul a{ font-size: %spx; }', esc_attr( $font_size_menu_dropdown ) );
	}

	if ( $font_size_child_cat_mega ) {
		$css .= sprintf( '#site-navigation .penci-megamenu .penci-mega-child-categories a{ font-size: %spx; }', esc_attr( $font_size_child_cat_mega ) );
	}

	if ( $font_size_ptitle_cat_mega ) {
		$css .= sprintf( '#site-navigation .penci-megamenu .penci-content-megamenu .penci-mega-latest-posts .penci-mega-post a:not(.mega-cat-name){ font-size: %spx; }',
			esc_attr( $font_size_ptitle_cat_mega ) );
	}

	if ( $font_size_pdate_cat_mega ) {
		$css .= sprintf( '#site-navigation .penci-megamenu .penci-mega-date{ font-size: %spx; }', esc_attr( $font_size_pdate_cat_mega ) );
	}

	if ( $hide_uppercase_menu_item ) {
		$css .= sprintf( '.main-navigation a{ text-transform: none; }' );
	}

	if( penci_get_theme_mod( 'penci_hide_arrow_down_menu_item' ) ) {
		$css .= sprintf( '.main-navigation li.penci-mega-menu > a:after, .main-navigation li.menu-item-has-children > a:after, .main-navigation li.page_item_has_children > a:after{ content: none; }' );
	}

	if( penci_get_theme_mod( 'penci_hide_arrow_right_menu_item' ) ) {
		$css .= sprintf( '.main-navigation li li.menu-item-has-children > a:after, .main-navigation li li.page_item_has_children > a:after{ content: none; }' );
	}

	if( penci_get_theme_mod( 'penci_hide_line_top_dropdown_menu' ) ) {
		$css .= sprintf( '.main-navigation > ul:not(.children) > li ul.sub-menu{ border-top: 0 !important; }' );
	}

	if ( $hide_uppercase_chid_mega_menu ) {
		$css .= sprintf( '#site-navigation .penci-megamenu .penci-mega-child-categories a{ text-transform: none; }' );
	}

	if( $align_pdate_mega_menu ) {
		$css .= sprintf( '#site-navigation .penci-megamenu .post-mega-title a, #site-navigation .penci-megamenu .penci-mega-date{ text-align: center; }' );
	}

	$ajaxsearch_bg_color         = penci_get_theme_mod( 'penci_ajaxsearch_bg_color' );
	$ajaxsearch_title_color      = penci_get_theme_mod( 'penci_ajaxsearch_title_color' );
	$ajaxsearch_title_hcolor     = penci_get_theme_mod( 'penci_ajaxsearch_title_hcolor' );
	$ajaxsearch_postmeta_color   = penci_get_theme_mod( 'penci_ajaxsearch_postmeta_color' );
	$ajaxsearch_border_color     = penci_get_theme_mod( 'penci_ajaxsearch_border_color' );
	$ajaxsearch_border_top_color = penci_get_theme_mod( 'penci_ajaxsearch_border_top_color' );

	if ( $ajaxsearch_bg_color ) {
		$css .= sprintf( '#top-search .show-search .show-search__content, #top-search-mobile .show-search .show-search__content{ background: %s; }', esc_attr( $ajaxsearch_bg_color ) );
	}

	if ( $ajaxsearch_title_color ) {
		$css .= sprintf( '#top-search .penci-viewall-results a,
		#top-search .penci-ajax-search-results-wrapper .penci__post-title a,
		.penci_dark_layout #top-search .penci-viewall-results a,
		.penci_dark_layout #top-search .penci-ajax-search-results-wrapper .penci__post-title a{ color: %s; }', esc_attr( $ajaxsearch_title_color ) );

		$css .= sprintf( '#top-search-mobile .penci-viewall-results a,
		#top-search-mobile .penci-ajax-search-results-wrapper .penci__post-title a,
		.penci_dark_layout #top-search-mobile .penci-viewall-results a,
		.penci_dark_layout #top-search-mobile .penci-ajax-search-results-wrapper .penci__post-title a{ color: %s; }', esc_attr( $ajaxsearch_title_color ) );
	}

	if ( $ajaxsearch_title_hcolor ) {
		$css .= sprintf( '#top-search .penci-viewall-results a:hover,
		#top-search .penci-ajax-search-results-wrapper .penci__post-title a:hover,
		.penci_dark_layout #top-search .penci-viewall-results a:hover,
		 .penci_dark_layout #top-search .penci-ajax-search-results-wrapper .penci__post-title a:hover{ color: %s; }', esc_attr( $ajaxsearch_title_hcolor ) );

		$css .= sprintf( '#top-search-mobile .penci-viewall-results a:hover,
		#top-search-mobile .penci-ajax-search-results-wrapper .penci__post-title a:hover,
		.penci_dark_layout #top-search-mobile .penci-viewall-results a:hover,
		 .penci_dark_layout #top-search-mobile .penci-ajax-search-results-wrapper .penci__post-title a:hover{ color: %s; }', esc_attr( $ajaxsearch_title_hcolor ) );
	}

	if ( $ajaxsearch_postmeta_color ) {
		$css .= sprintf( '#top-search .penci-ajax-search-results-wrapper .penci__general-meta .penci_post-meta,#top-search-mobile .penci-ajax-search-results-wrapper .penci__general-meta .penci_post-meta{ color: %s; }', esc_attr( $ajaxsearch_postmeta_color ) );
	}

	if ( $ajaxsearch_border_color ) {
		$css .= sprintf( '#top-search .show-search .show-search__content,#top-search .penci-ajax-search-results-wrapper,#top-search .penci-viewall-results,#top-search .show-search .search-field{ border-color: %s; }', esc_attr( $ajaxsearch_border_color ) );
		$css .= sprintf( '#top-search-mobile .show-search .show-search__content,#top-search-mobile .penci-ajax-search-results-wrapper,#top-search-mobile .penci-viewall-results,#top-search-mobile .show-search .search-field{ border-color: %s; }', esc_attr( $ajaxsearch_border_color ) );
	}

	if ( $ajaxsearch_border_top_color ) {
		$css .= sprintf( '.show-search .show-search__content:after{ background-color: %s; }', esc_attr( $ajaxsearch_border_top_color ) );
	}

	return $css;
}