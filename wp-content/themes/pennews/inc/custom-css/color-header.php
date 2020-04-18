<?php
if ( function_exists( 'penci_customizer_color_header' ) ) {
	return;
}
function penci_customizer_color_header() {
	$header_background_color = penci_get_theme_mod( 'penci_header_background_color' );
	$header_background_img   = penci_get_setting( 'penci_header_background_img' );

	$css = '';

	if ( penci_get_setting( 'penci_use_textlogo' ) ) {

		$font_textlogo        = penci_get_theme_mod( 'penci_font_textlogo' );
		$font_weight_textlogo = penci_get_theme_mod( 'penci_font_weight_textlogo' );
		$fontsize_textlogo    = penci_get_theme_mod( 'penci_fontsize_textlogo' );
		$textlogo_color       = penci_get_theme_mod( 'header_textlogo_color' );

		if ( $font_textlogo ) {
			$css .= sprintf( '.site-branding .site-title ,.footer__logo a, .mobile-sidebar #sidebar-nav-logo a {font-family: %s; }',
				penci_google_fonts_parse_attributes( $font_textlogo ) );
		}

		if ( $font_weight_textlogo ) {
			$css .= sprintf( '.site-branding .site-title ,.footer__logo a,.mobile-sidebar #sidebar-nav-logo a{font-weight: %s; }',
				esc_attr( $font_weight_textlogo ) );
		}

		if ( $fontsize_textlogo ) {
			$css .= sprintf( '.site-branding .site-title,.footer__logo a, .mobile-sidebar #sidebar-nav-logo a,
			.header__top.header--s8 .site-branding .site-title,
			.header__top.header--s9 .site-branding .site-title,
			.header--s2 .site-branding .site-title,
			.header__top.header--s3 .site-branding .site-title,
			.header__top.header--s4 .site-branding .site-title,
			.header__top.header--s6 .site-branding .site-title {font-size: %spx; }',
				esc_attr( $fontsize_textlogo ) );


			$css .= '.penci-menu-hbg-inner .site-branding .site-title {line-height: ' . esc_attr( $fontsize_textlogo ) . 'px;}';
		}

		if ( $textlogo_color ) {
			$css .= sprintf( '.site-branding .site-title a { color: %s; }', esc_attr( $textlogo_color ) );
		}

		$font_textlogo_on_mobile        = penci_get_theme_mod( 'penci_font_textlogo_on_mobile' );
		$font_weight_textlogo_on_mobile = penci_get_theme_mod( 'penci_font_weight_textlogo_on_mobile' );
		$fontsize_textlogo_on_mobile    = penci_get_theme_mod( 'penci_fontsize_textlogo_on_mobile' );

		$textlogo_mobile_css = '';
		if ( $font_textlogo_on_mobile ) {
			$textlogo_mobile_css .= 'font-family: ' . penci_google_fonts_parse_attributes( $font_textlogo_on_mobile ) . ' !important;';
		}

		if ( $font_weight_textlogo_on_mobile ) {
			$textlogo_mobile_css .= 'font-weight: ' . esc_attr( $font_weight_textlogo_on_mobile ) . '!important;';
		}

		if ( $fontsize_textlogo_on_mobile ) {
			$textlogo_mobile_css .= 'font-size: ' . esc_attr( $fontsize_textlogo_on_mobile ) . 'px !important;';
		}

		if ( $textlogo_mobile_css ) {
			$css .= '.penci-header-mobile .site-branding .site-title {' . ( $textlogo_mobile_css ) . '}';
		}
	}

	$header_slogan_color = penci_get_theme_mod( 'header_slogan_color' );
	if( $header_slogan_color ) {
		$css .= sprintf( '.site-description{ color: %s; }', esc_attr( $header_slogan_color ) );
	}

	$font_size__social_icon = penci_get_theme_mod( 'penci_font_size__social_icon' );
	if ( $font_size__social_icon ) {
		$css .= sprintf( '.header__social-media a, .cart-icon span{font-size: %spx; }', esc_attr( $font_size__social_icon ) );
	}

	$font_size__search_icon = penci_get_theme_mod( 'penci_font_size__search_icon' );
	if ( $font_size__search_icon ) {
		$css .= sprintf( '.search-click i{font-size: %spx; }', esc_attr( $font_size__search_icon ) );
	}

	/***** Background color ******/
	if ( $header_background_color ) {
		$css .= sprintf( '.header__top, .header__bottom { background-color: %s; }', esc_attr( $header_background_color ) );
	}

	if ( $header_background_img ) {
		$css .= sprintf( '.header__top, .header__bottom { background-image: url( %s ); }', esc_attr( $header_background_img ) );
	}

	/***** Header social ******/
	$header_social_color       = penci_get_theme_mod( 'header_social_color' );
	$header_social_color_hover = penci_get_theme_mod( 'header_social_color_hover' );
	$menu_hbg_icon_color       = penci_get_theme_mod( 'menu_hbg_icon_color' );
	$menu_hbg_icon_color_hover = penci_get_theme_mod( 'menu_hbg_icon_color_hover' );

	if ( $header_social_color ) {
		$css .= sprintf( '.header__social-media a{ color:%s; }', esc_attr( $header_social_color ) );

	}

	if ( $header_social_color_hover ) {
		$css .= sprintf( '.header__social-media a:hover{ color:%s; }', esc_attr( $header_social_color_hover ) );
	}

	if ( $menu_hbg_icon_color ) {
		$css .= sprintf(
		'.penci-menuhbg-toggle .lines-button:after,
		.penci-menuhbg-toggle .penci-lines:before,
		.penci-menuhbg-toggle .penci-lines:after{ background-color:%s; }', esc_attr( $menu_hbg_icon_color ) );

	}

	if ( $menu_hbg_icon_color_hover ) {
		$css .= sprintf(
		'.penci-menuhbg-toggle:hover .lines-button:after,
		.penci-menuhbg-toggle:hover .penci-lines:before,
		.penci-menuhbg-toggle:hover .penci-lines:after{ background-color:%s; }', esc_attr( $menu_hbg_icon_color_hover ) );
	}

	/******  Main bar *********/

	$main_bar_bg             = penci_get_theme_mod( 'main_bar_bg' );
	$main_bar_border_color   = penci_get_theme_mod( 'main_bar_border_color' );
	$main_bar_nav_color      = penci_get_theme_mod( 'main_bar_nav_color' );
	$main_bar_color_active   = penci_get_theme_mod( 'main_bar_color_active' );
	$main_bar_bgcolor_active = penci_get_theme_mod( 'main_bar_bgcolor_active' );

	if ( $main_bar_bg ) {
		$css .= sprintf( '.site-header{ background-color:%s; }', esc_attr( $main_bar_bg ) );
		if( ! $main_bar_border_color ) {
			$main_bar_border_color = $main_bar_bg;
		}
	}

	if ( $main_bar_border_color ) {
		$css .= sprintf( '.site-header{
			box-shadow: inset 0 -1px 0 %s;
			-webkit-box-shadow: inset 0 -1px 0 %s;
			-moz-box-shadow: inset 0 -1px 0 %s;
		  }',
			esc_attr( $main_bar_border_color ),
			esc_attr( $main_bar_border_color ),
			esc_attr( $main_bar_border_color )
		);

		$css .= sprintf( '.site-header.header--s2:before, .site-header.header--s3:not(.header--s4):before, .site-header.header--s6:before{ background-color:%s !important }',
			esc_attr( $main_bar_border_color ) );
	}

	if ( $main_bar_nav_color ) {
		$css .= sprintf( '.main-navigation ul.menu > li > a{ color:%s }', esc_attr( $main_bar_nav_color ) );
	}

	if ( $main_bar_color_active ) {
		$css .= sprintf(
			'.main-navigation.penci_enable_line_menu > ul:not(.children) > li > a:before{background-color: %s; }' .
			'.main-navigation > ul:not(.children) > li:hover > a,' .
			'.main-navigation > ul:not(.children) > li.current-category-ancestor > a,' .
			'.main-navigation > ul:not(.children) > li.current-menu-ancestor > a,' .
			'.main-navigation > ul:not(.children) > li.current-menu-item > a,' .
			'.site-header.header--s11 .main-navigation.penci_enable_line_menu .menu > li:hover > a,' .
			'.site-header.header--s11 .main-navigation.penci_enable_line_menu .menu > li:active > a,' .
			'.site-header.header--s11 .main-navigation.penci_enable_line_menu .menu > li.current-category-ancestor > a,' .
			'.site-header.header--s11 .main-navigation.penci_enable_line_menu .menu > li.current-menu-ancestor > a,' .
			'.site-header.header--s11 .main-navigation.penci_enable_line_menu .menu > li.current-menu-item > a,' .
			'.main-navigation.penci_disable_padding_menu > ul:not(.children) > li:hover > a,' .
			'.main-navigation.penci_disable_padding_menu > ul:not(.children) > li.current-category-ancestor > a,' .
			'.main-navigation.penci_disable_padding_menu > ul:not(.children) > li.current-menu-ancestor > a,' .
			'.main-navigation.penci_disable_padding_menu > ul:not(.children) > li.current-menu-item > a,' .
			'.main-navigation.penci_disable_padding_menu ul.menu > li > a:hover,' .
			'.main-navigation ul.menu > li.current-menu-item > a,' .
			'.main-navigation ul.menu > li > a:hover{ color: %s }',
			esc_attr( $main_bar_color_active ),
			esc_attr( $main_bar_color_active )
		);

		if( penci_get_theme_mod( 'penci_disable_padding_menu_lever1' ) ){
			$css .= '.main-navigation.penci_disable_padding_menu > ul:not(.children) > li.highlight-button > a{ color: ' . esc_attr( $main_bar_color_active ) . ';border-color: ' . esc_attr( $main_bar_color_active ) . '; }';

			$css .= '.main-navigation.penci_disable_padding_menu > ul:not(.children) > li.highlight-button:hover > a,' .
			        '.main-navigation.penci_disable_padding_menu > ul:not(.children) > li.highlight-button:active > a,' .
			        '.main-navigation.penci_disable_padding_menu > ul:not(.children) > li.highlight-button.current-category-ancestor > a,' .
			        '.main-navigation.penci_disable_padding_menu > ul:not(.children) > li.highlight-button.current-menu-ancestor > a,' .
			        '.main-navigation.penci_disable_padding_menu > ul:not(.children) > li.highlight-button.current-menu-item > a{ border-color: ' . esc_attr( $main_bar_color_active ) . '; }';
		}else{
			$css .= '.main-navigation > ul:not(.children) > li.highlight-button > a{ color: ' . esc_attr( $main_bar_color_active ) . '; }';
		}

	}

	if ( $main_bar_bgcolor_active ) {
		$css .= sprintf(
			'.main-navigation > ul:not(.children) > li:hover > a,' .
			'.main-navigation > ul:not(.children) > li:active > a,' .
			'.main-navigation > ul:not(.children) > li.current-category-ancestor > a,' .
			'.main-navigation > ul:not(.children) > li.current-menu-ancestor > a,' .
			'.main-navigation > ul:not(.children) > li.current-menu-item > a,' .
			'.site-header.header--s11 .main-navigation.penci_enable_line_menu .menu > li:hover > a,' .
			'.site-header.header--s11 .main-navigation.penci_enable_line_menu .menu > li:active > a,' .
			'.site-header.header--s11 .main-navigation.penci_enable_line_menu .menu > li.current-category-ancestor > a,' .
			'.site-header.header--s11 .main-navigation.penci_enable_line_menu .menu > li.current-menu-ancestor > a,' .
			'.site-header.header--s11 .main-navigation.penci_enable_line_menu .menu > li.current-menu-item > a,' .
			'.main-navigation ul.menu > li > a:hover{ background-color: %s }', esc_attr( $main_bar_bgcolor_active ) );

		if( ! penci_get_theme_mod( 'penci_disable_padding_menu_lever1' ) ) {

			$css .= '.main-navigation > ul:not(.children) > li.highlight-button > a{ background-color: ' . esc_attr( $main_bar_bgcolor_active ) . '; }';


			$css .= '.main-navigation > ul:not(.children) > li.highlight-button:hover > a,' .
			        '.main-navigation > ul:not(.children) > li.highlight-button:active > a,' .
			        '.main-navigation > ul:not(.children) > li.highlight-button.current-category-ancestor > a,' .
			        '.main-navigation > ul:not(.children) > li.highlight-button.current-menu-ancestor > a,' .
			        '.main-navigation > ul:not(.children) > li.highlight-button.current-menu-item > a{ border-color: ' . esc_attr( $main_bar_bgcolor_active ) . '; }';
		}
	}

	$drop_bg_color            = penci_get_theme_mod( 'drop_bg_color' );
	$drop_border_top_color    = penci_get_theme_mod( 'drop_border_top_color' );
	$drop_items_border        = penci_get_theme_mod( 'drop_items_border' );
	$drop_text_color          = penci_get_theme_mod( 'drop_text_color' );
	$drop_text_hover_color    = penci_get_theme_mod( 'drop_text_hover_color' );
	$drop_items_bgcolor       = penci_get_theme_mod( 'drop_items_bgcolor' );
	$drop_items_bgcolor_hover = penci_get_theme_mod( 'drop_items_bgcolor_hover' );


	if ( $drop_border_top_color ) {
		$css .= sprintf( '.main-navigation > ul:not(.children) > li ul.sub-menu{ border-color:%s ; }', esc_attr( $drop_border_top_color ) );
	}

	if ( $drop_bg_color ) {
		$css .= sprintf( '.main-navigation ul li:not( .penci-mega-menu ) ul, .main-navigation ul.menu > li.megamenu > ul.sub-menu{ background-color:%s ; }', esc_attr( $drop_bg_color ) );
	}

	if ( $drop_items_border ) {
		$css .= sprintf( '.main-navigation ul li:not( .penci-mega-menu ) ul li{ border-color:%s ; }', esc_attr( $drop_items_border ) );
	}


	if ( $drop_items_bgcolor ) {
		$css .= sprintf( '.main-navigation ul li:not( .penci-mega-menu ) ul li{ background-color:%s; }', esc_attr( $drop_items_bgcolor ) );
	}

	if ( $drop_text_color ) {
		$css .= sprintf( '.main-navigation ul li:not( .penci-mega-menu ) ul a{ color:%s }', esc_attr( $drop_text_color ) );
	}

	if ( $drop_text_hover_color ) {
		$css .= sprintf(
			'.main-navigation ul li:not( .penci-mega-menu ) ul li.current-category-ancestor > a,'.
			'.main-navigation ul li:not( .penci-mega-menu ) ul li.current-menu-ancestor > a,'.
			'.main-navigation ul li:not( .penci-mega-menu ) ul li.current-menu-item > a,'.
			'.main-navigation ul li:not( .penci-mega-menu ) ul a:hover{ color:%s }', esc_attr( $drop_text_hover_color ) );
	}

	if ( $drop_items_bgcolor_hover ) {
		$css .= sprintf(
			'.main-navigation ul li:not( .penci-mega-menu ) ul li.current-category-ancestor > a,'.
			'.main-navigation ul li:not( .penci-mega-menu ) ul li.current-menu-ancestor > a,'.
			'.main-navigation ul li:not( .penci-mega-menu ) ul li.current-menu-item > a,'.
			'.main-navigation ul li:not( .penci-mega-menu ) ul li a:hover{background-color: %s }', esc_attr( $drop_items_bgcolor_hover ) );
	}

	/******* Mega menu **********/

	$mega_bg_color           = penci_get_theme_mod( 'mega_bg_color' );
	$mega_border_color       = penci_get_theme_mod( 'mega_post_border_color' );
	$mega_child_cat_color    = penci_get_theme_mod( 'mega_child_cat_color' );
	$mega_child_cat_bg_color = penci_get_theme_mod( 'mega_child_cat_bg_color' );
	$mega_post_date_color    = penci_get_theme_mod( 'mega_post_date_color' );
	$mega_post_cat_color     = penci_get_theme_mod( 'mega_post_cat_color' );
	$mega_post_cat_bgcolor   = penci_get_theme_mod( 'mega_post_cat_bgcolor' );
	$mega_accent_color       = penci_get_theme_mod( 'mega_accent_color' );

	if ( $mega_bg_color ) {
		$css .= sprintf( ' #site-navigation .penci-megamenu,
		 #site-navigation .penci-megamenu .penci-mega-child-categories a.cat-active{ background-color:%s !important }',
			esc_attr( $mega_bg_color )
		);
	}

	if( $mega_border_color ) {
		$css .= sprintf( '#site-navigation .penci-megamenu .penci-mega-child-categories:after,
		#site-navigation .penci-megamenu .penci-content-megamenu .penci-mega-latest-posts .penci-mega-post:before{ background-color:%s !important }',
			esc_attr( $mega_border_color )
		);
	}

	if ( $mega_child_cat_color ) {
		$css .= sprintf( '#site-navigation .penci-megamenu .penci-mega-child-categories a.cat-active{ color:%s !important }',
			esc_attr( $mega_child_cat_color )
		);
	}

	if ( $mega_child_cat_bg_color ) {
		$css .= sprintf( '#site-navigation .penci-megamenu .penci-mega-child-categories{ background-color:%s !important }',
			esc_attr( $mega_child_cat_bg_color )
		);
	}

	if ( $mega_child_cat_item_bg_hcolor = penci_get_theme_mod( 'mega_child_cat_item_bg_hcolor' ) ) {
		$css .= sprintf( '#site-navigation .penci-megamenu .penci-mega-child-categories.penci-child_cat-style-2 .mega-cat-child.cat-active{ background-color:%s !important }',
			esc_attr( $mega_child_cat_item_bg_hcolor )
		);
	}

	if ( $mega_post_date_color ) {
		$css .= sprintf( '#site-navigation .penci-megamenu .penci-mega-date{ color:%s !important }', esc_attr( $mega_post_date_color ) );
	}

	if ( $mega_post_cat_color ) {
		$css .= sprintf( '#site-navigation .penci-megamenu .penci-mega-thumbnail .mega-cat-name{ color:%s; }', esc_attr( $mega_post_cat_color ) );
	}

	if ( $mega_post_cat_bgcolor ) {
		$css .= sprintf( '#site-navigation .penci-megamenu .penci-mega-thumbnail .mega-cat-name{ background-color:%s; }', esc_attr( $mega_post_cat_bgcolor ) );
	}

	if ( $mega_accent_color ) {
		$css .= sprintf( '#site-navigation .penci-megamenu .penci-content-megamenu .penci-mega-latest-posts .penci-mega-post a:not( .mega-cat-name ),
		 #site-navigation .penci-megamenu .penci-mega-child-categories a{ color:%s !important }',
			esc_attr( $mega_accent_color )
		);
	}

	$mega_post_nav_bgcolor = penci_get_theme_mod( 'mega_post_nav_bgcolor' );
	$mega_post_nav_color   = penci_get_theme_mod( 'mega_post_nav_color' );

	if ( $mega_post_nav_bgcolor ) {
		$css .= sprintf( '.penci-megamenu .penci-block-pag,
		.penci-megamenu .penci-mega-pag:not(.penci-pag-disabled):hover,
		.penci-megamenu .penci-mega-pag.penci-pag-disabled:hover{ background-color:%s; }', esc_attr( $mega_post_nav_bgcolor ) );
	}

	if ( $mega_post_nav_color ) {
		$css .= sprintf( '.penci-megamenu .penci-mega-pag,.penci-megamenu .penci-mega-pag:not(.penci-pag-disabled):hover,
		.penci-megamenu .penci-mega-pag.penci-pag-disabled:hover{ color:%s; }', esc_attr( $mega_post_nav_color ) );
	}


	/***** Header search ******/
	$header_search_color         = penci_get_theme_mod( 'header_search_color' );
	$header_search_color_hover   = penci_get_theme_mod( 'header_search_color_hover' );
	$header_search_bgcolor       = penci_get_theme_mod( 'header_search_bgcolor' );
	$header_search_bgcolor_hover = penci_get_theme_mod( 'header_search_bgcolor_hover' );

	if ( $header_search_color ) {
		$css .= sprintf( '.header__search:not(.header__search_dis_bg) .search-click, .header__search_dis_bg .search-click{ color: %s }', esc_attr( $header_search_color ) );
	}

	if ( $header_search_bgcolor ) {
		$css .= sprintf( '.header__search:not(.header__search_dis_bg) .search-click{ background-color:%s; }', esc_attr( $header_search_bgcolor ) );
	}

	if ( $header_search_color_hover ) {
		$css .= sprintf( '
		.show-search .search-submit:hover,
		 .header__search_dis_bg .search-click:hover,
		 .header__search:not(.header__search_dis_bg) .search-click:hover,
		 .header__search:not(.header__search_dis_bg) .search-click:active,
		 .header__search:not(.header__search_dis_bg) .search-click.search-click-forcus{ color:%s; }', esc_attr( $header_search_color_hover ) );
	}

	if ( $header_search_bgcolor_hover ) {
		$css .= sprintf( '.header__search:not(.header__search_dis_bg)
		 .search-click:hover, .header__search:not(.header__search_dis_bg) .search-click:active,
		  .header__search:not(.header__search_dis_bg) .search-click.search-click-forcus{ background-color:%s; }', esc_attr( $header_search_bgcolor_hover ) );
	}


	// Header mobile
	$header_mobile_bgcolor   = penci_get_theme_mod( 'header_menu_mobile_bgcolor' );
	$header_icon_menu_mobile = penci_get_theme_mod( 'header_icon_menu_mobile' );

	if ( $header_mobile_bgcolor ) {
		$css .= sprintf( '.penci-header-mobile .penci-header-mobile_container{ background-color:%s; }', esc_attr( $header_mobile_bgcolor ) );
	} elseif ( $main_bar_bg ) {
		$css .= sprintf( '.penci-header-mobile .penci-header-mobile_container{ background-color:%s; }', esc_attr( $main_bar_bg ) );
	}

	if ( $header_icon_menu_mobile ) {
		$css .= sprintf( '.penci-header-mobile  .menu-toggle, .penci_dark_layout .menu-toggle{ color:%s; }', esc_attr( $header_icon_menu_mobile ) );
	}

	// Header trans

	$header_trans_logo_color    = penci_get_theme_mod( 'header_trans_logo_color' );
	$header_trans_el_color      = penci_get_theme_mod( 'header_trans_el_color' );
	$header_trans_menul1_hcolor = penci_get_theme_mod( 'header_trans_menul1_hcolor' );
	$header_trans_icon_hcolor   = penci_get_theme_mod( 'header_trans_icon_hcolor' );
	$header_trans_slogan_color   = penci_get_theme_mod( 'header_trans_slogan_color' );
	$header_trans_border_tcolor   = penci_get_theme_mod( 'header_trans_border_tcolor' );
	$header_trans_border_bcolor   = penci_get_theme_mod( 'header_trans_border_bcolor' );

	if( $header_trans_logo_color ) {
		$css .= '@media only screen and ( min-width: 1025px) { .penci-header-transparent .site-header-wrapper.penci-trans-nav .site-branding a { color: ' . esc_attr( $header_trans_logo_color ) . ' }}';
	}

	if ( $header_trans_el_color ) {
		$css .= '@media only screen and ( min-width: 1025px) { .penci-header-transparent .penci-trans-nav .main-navigation > ul:not(.children) > li > a,';
		$css .= '.penci-header-transparent .site-header-wrapper.penci-trans-nav .header__social-media a,';
		$css .= '.penci-header-transparent .site-header-wrapper.penci-trans-nav .header__search .search-click';
		$css .= '{ color: ' . esc_attr( $header_trans_el_color ) . ' } }';

		$css .= '@media only screen and ( min-width: 1025px) { .penci-header-transparent .penci-trans-nav .penci-menuhbg-toggle .lines-button:after,';
		$css .= '.penci-header-transparent .site-header-wrapper.penci-trans-nav .penci-menuhbg-toggle .penci-lines:before,';
		$css .= '.penci-header-transparent .site-header-wrapper.penci-trans-nav .penci-menuhbg-toggle .penci-lines:after';
		$css .= '{ background-color: ' . esc_attr( $header_trans_el_color ) . ' } }';
	}

	if( $header_trans_menul1_hcolor ) {
		$css .= '@media only screen and ( min-width: 1025px) { .penci-header-transparent .penci-trans-nav .main-navigation > ul:not(.children) > li > a:hover, .penci-header-transparent .penci-trans-nav .main-navigation > ul:not(.children) > li.current-menu-item > a{ color: ' . $header_trans_menul1_hcolor . ' }';
		$css .= '.penci-header-transparent .site-header-wrapper.penci-trans-nav .main-navigation.penci_enable_line_menu > ul:not(.children) > li > a:before{ background-color: ' . $header_trans_menul1_hcolor . ' } }';
	}

	if( $header_trans_icon_hcolor ) {
		$css .= '@media only screen and ( min-width: 1025px) { .penci-header-transparent .penci-trans-nav .header__social-media a:hover,';
		$css .= '.penci-header-transparent .site-header-wrapper.penci-trans-nav .header__search .search-click:hover';
		$css .= '{ color: ' . esc_attr( $header_trans_icon_hcolor ) . ' }';

		$css .= '.penci-header-transparent .site-header-wrapper.penci-trans-nav .penci-menuhbg-toggle:hover .lines-button:after,';
		$css .= '.penci-header-transparent .site-header-wrapper.penci-trans-nav .penci-menuhbg-toggle:hover .penci-lines:before,';
		$css .= '.penci-header-transparent .site-header-wrapper.penci-trans-nav .penci-menuhbg-toggle:hover .penci-lines:after';
		$css .= '{ background-color: ' . esc_attr( $header_trans_icon_hcolor ) . ' } }';
	}

	if( $header_trans_slogan_color ) {
		$css .= '.penci-header-transparent .site-description{ color: ' . $header_trans_slogan_color . ' }';
	}

	if( $header_trans_border_tcolor ) {
		$css .= '.penci-header-transparent .site-header-wrapper.penci-trans-nav .site-header.header--s2:before,';
		$css .= '.penci-header-transparent .site-header-wrapper.penci-trans-nav .site-header.header--s3:not(.header--s4):before,';
		$css .= '.penci-header-transparent .site-header-wrapper.penci-trans-nav .site-header.header--s6:before';
		$css .= '{ background-color: ' . esc_attr( $header_trans_border_tcolor ) . ' } }';
	}

	if( $header_trans_border_bcolor ) {
		$css .= '.penci-header-transparent .site-header-wrapper.penci-trans-nav .site-header{ border-bottom: 1px solid ' . $header_trans_border_bcolor . ' }';
	}

	return $css;
}