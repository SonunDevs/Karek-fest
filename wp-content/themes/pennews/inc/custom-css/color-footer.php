<?php
if ( function_exists( 'penci_customizer_color_footer' ) ) {
	return;
}
function penci_customizer_color_footer() {
	$css = '';

	$footer_bg_img     = penci_get_theme_mod( 'penci_footer_background_img' );
	$footer_bg         = penci_get_theme_mod( 'penci_footer_bg' );
	$footer_border_top = penci_get_theme_mod( 'penci_footer_border_top' );



	if ( $footer_bg_img ) {
		$css .= sprintf( '.site-footer{background-image: url( %s ); }', esc_attr( $footer_bg_img ) );
	}
	if ( $footer_bg ) {
		$css .= sprintf( '.site-footer{ background-color:%s ; }', esc_attr ( $footer_bg ) );
	}

	if ( $footer_border_top ) {
		$css .= sprintf( '.site-footer{ border-top:1px solid %s; }', esc_attr( $footer_border_top ) );
	}

	// Footer bottom
	$footer_bottom_bg             = penci_get_theme_mod( 'penci_footer_bottom_bg' );
	$footer_bottom_text_color     = penci_get_theme_mod( 'penci_footer_bottom_text_color' );
	$footer_bottom_title_cr_color = penci_get_theme_mod( 'penci_footer_bottom_title_cr_color' );
	$footer_bottom_link_color     = penci_get_theme_mod( 'penci_footer_bottom_link_color' );
	$footer_bottom_link_hcolor    = penci_get_theme_mod( 'penci_footer_bottom_link_hcolor' );

	if ( $footer_bottom_bg ) {
		$css .= sprintf( '.footer__bottom { background-color:%s ; }', esc_attr( $footer_bottom_bg ) );
	}

	if( $footer_bottom_text_color ) {
		$css .= sprintf( '.footer__bottom .penci-footer-text-wrap{ color:%s ; }', esc_attr( $footer_bottom_text_color ) );
	}

	if( $footer_bottom_title_cr_color ) {
		$css .= sprintf( '.footer__bottom.style-2 .block-title{color:%s ; }', esc_attr( $footer_bottom_title_cr_color ) );
	}
	if( $footer_bottom_link_color ) {
		$css .= sprintf( '.footer__bottom a{ color:%s ; }', esc_attr( $footer_bottom_link_color ) );
	}
	if( $footer_bottom_link_hcolor ) {
		$css .= sprintf( '.footer__bottom a:hover { color:%s ; }', esc_attr( $footer_bottom_link_hcolor ) );
	}


	/********** Widget ************/
	$widget_area_bg            = penci_get_theme_mod( 'penci_footer_widget_area_bg' );
	$widget_area_border_bottom = penci_get_theme_mod( 'penci_footer_widget_area_border_bottom' );
	$widget_color              = penci_get_theme_mod( 'penci_footer_widget_color' );
	$widget_accent_color       = penci_get_theme_mod( 'penci_footer_widget_accent_color' );
	$widget_accent_hover_color = penci_get_theme_mod( 'penci_footer_widget_accent_hover_color' );
	$widget_list_border_color  = penci_get_theme_mod( 'penci_footer_widget_list_border_color' );

	$widget_title_border_color = penci_get_theme_mod( 'penci_footer_widget_title_border_color' );
	$widget_area_title_color   = penci_get_theme_mod( 'penci_footer_widget_area_title_color' );
	$widget_title_bg_color     = penci_get_theme_mod( 'penci_footer_widget_title_bg_color' );


	if ( $widget_area_bg ) {
		$css .= sprintf( '.footer__sidebars{ background-color:%s ; }', esc_attr( $widget_area_bg ) );

	}

	if ( $widget_area_border_bottom ) {
		$css .= sprintf( '.footer__sidebars + .footer__bottom .footer__bottom_container:before{ background-color:%s ; }', esc_attr( $widget_area_border_bottom ) );
	}

	if ( $widget_color ) {
		$css .= sprintf( '.footer__sidebars{ color:%s ; }.site-footer .widget ul li{ color:%s ; }', esc_attr( $widget_color ), esc_attr( $widget_color ) );
		$css .= sprintf( '.site-footer .widget-title,		
		.site-footer .penci-block-vc .penci-slider-nav a,
		.site-footer cite,
		.site-footer .widget select,
		.site-footer .mc4wp-form,
		.site-footer .penci-block-vc .penci-slider-nav a.penci-pag-disabled,
		.site-footer .penci-block-vc .penci-slider-nav a.penci-pag-disabled:hover{ color:%s ; }', esc_attr( $widget_color ) );


		$css .= '.site-footer input[type="text"], .site-footer input[type="email"],';
		$css .= '.site-footer input[type="url"], .site-footer input[type="password"],';
		$css .= '.site-footer input[type="search"], .site-footer input[type="number"],';
		$css .= '.site-footer input[type="tel"], .site-footer input[type="range"],';
		$css .= '.site-footer input[type="date"], .site-footer input[type="month"],';
		$css .= '.site-footer input[type="week"],.site-footer input[type="time"],';
		$css .= '.site-footer input[type="datetime"],.site-footer input[type="datetime-local"],';
		$css .= '.site-footer .widget .tagcloud a,';
		$css .= '.site-footer input[type="color"], .site-footer textarea';
		$css .= '{ color:' . esc_attr( $widget_color ) . ' ; }';
	}

	if ( $widget_area_title_color ) {
		$css .= sprintf( '.site-footer .penci-block-vc .penci-block__title a, .site-footer .penci-block-vc .penci-block__title span,.footer-instagram h4.footer-instagram-title span{ color:%s ; }',
			esc_attr( $widget_area_title_color ) );

		$css .= sprintf( '.site-footer .penci-block-vc.style-title-3 .penci-block-heading:after{ background-color:%s ; }',
			esc_attr( $widget_area_title_color ) );

	}

	if ( $widget_list_border_color ) {
		$css .= '.footer__sidebars .woocommerce.widget_shopping_cart .total,';
		$css .= '.footer__sidebars .woocommerce.widget_product_search input[type="search"],';
		$css .= '.footer__sidebars .woocommerce ul.cart_list li,';
		$css .= '.footer__sidebars .woocommerce ul.product_list_widget li,';
		$css .= '.site-footer .penci-recent-rv,';
		$css .= '.site-footer .penci-block_6 .penci-post-item,';
		$css .= '.site-footer .penci-block_10 .penci-post-item,';
		$css .= '.site-footer .penci-block_11 .block11_first_item, .site-footer .penci-block_11 .penci-post-item,';
		$css .= '.site-footer .penci-block_15 .penci-post-item,';
		$css .= '.site-footer .widget select,';
		$css .= '.footer__sidebars .woocommerce-product-details__short-description th,';
		$css .= '.footer__sidebars .woocommerce-product-details__short-description td,';
		$css .= '.site-footer .widget.widget_recent_entries li, .site-footer .widget.widget_recent_comments li, .site-footer .widget.widget_meta li,';
		$css .= '.site-footer input[type="text"], .site-footer input[type="email"],';
		$css .= '.site-footer input[type="url"], .site-footer input[type="password"],';
		$css .= '.site-footer input[type="search"], .site-footer input[type="number"],';
		$css .= '.site-footer input[type="tel"], .site-footer input[type="range"],';
		$css .= '.site-footer input[type="date"], .site-footer input[type="month"],';
		$css .= '.site-footer input[type="week"],.site-footer input[type="time"],';
		$css .= '.site-footer input[type="datetime"],.site-footer input[type="datetime-local"],';
		$css .= '.site-footer .widget .tagcloud a,';
		$css .= '.site-footer input[type="color"], .site-footer textarea';
		$css .= '{ border-color:' . esc_attr( $widget_list_border_color ) . ' ; }';

		$css .= sprintf( '.site-footer select,.site-footer .woocommerce .woocommerce-product-search input[type="search"]{ border-color:%s ; }', esc_attr( $widget_list_border_color ) );


	}

	if ( $widget_title_border_color ) {
		$css .= sprintf( '.site-footer .penci-block-vc .penci-block-heading,.footer-instagram h4.footer-instagram-title{ border-color:%s ; }', esc_attr( $widget_title_border_color ) );
	}

	if ( $widget_title_bg_color ) {
		$css .= sprintf( '.site-footer .penci-block-vc.style-title-2 .penci-block__title a,.site-footer .penci-block-vc.style-title-2 .penci-block__title span{ background-color:%s ; }', esc_attr( $widget_title_bg_color ) );
		$css .= sprintf( '.site-footer .penci-block-vc.style-title-4 .penci-block__title a,.site-footer .penci-block-vc.style-title-4 .penci-block__title span{ background-color:%s ; }', esc_attr( $widget_title_bg_color ) );
	}

	if ( $widget_accent_color  ) {
		$css .= sprintf( '.site-footer .widget ul li, .footer__sidebars li, .footer__sidebars a{ color:%s ; }
		.site-footer .widget .tagcloud a{ background: transparent; }
		.site-footer .widget.widget_recent_entries li a, .site-footer .widget.widget_recent_comments li a, .site-footer .widget.widget_meta li a{color:%s ;}',
		esc_attr( $widget_accent_color ),
		esc_attr( $widget_accent_color )

		);

		$css .= sprintf( '.footer__sidebars .penci-block-vc .penci__post-title a{ color:%s ; }', esc_attr( $widget_accent_color ) );
	}

	if ( $widget_accent_hover_color ) {
		$css .= sprintf( '.footer__sidebars a:hover { color:%s ; }
		.site-footer .widget .tagcloud a:hover{ background: %s;color: #fff;border-color:%s }',
			esc_attr( $widget_accent_hover_color ),
			esc_attr( $widget_accent_hover_color ),
			esc_attr( $widget_accent_hover_color )
		);

		$css .= sprintf( '.site-footer .widget.widget_recent_entries li a:hover,.site-footer .widget.widget_recent_comments li a:hover,.site-footer .widget.widget_meta li a:hover{ color:%s ; }', esc_attr(  $widget_accent_hover_color ) );
		$css .= sprintf( '.footer__sidebars .penci-block-vc .penci__post-title a:hover{ color:%s ; }', esc_attr( $widget_accent_hover_color ) );
	}

	/********** Social icon ************/
	$penci_footer_icon_color          = penci_get_theme_mod( 'penci_footer_icon_color' );
	$penci_footer_icon_bg_color       = penci_get_theme_mod( 'penci_footer_icon_bg_color' );
	$penci_footer_icon_hover_color    = penci_get_theme_mod( 'penci_footer_icon_hover_color' );
	$penci_footer_icon_bg_hover_color = penci_get_theme_mod( 'penci_footer_icon_bg_hover_color' );

	if ( $penci_footer_icon_color ) {
		$css .= sprintf( '.footer__social-media .social-media-item{ color:%s !important; }', esc_attr( $penci_footer_icon_color ) );
	}

	if ( $penci_footer_icon_bg_color ) {
		$css .= sprintf( '.footer__social-media .social-media-item{ background-color:%s!important ; }', esc_attr( $penci_footer_icon_bg_color ) );
		$css .= sprintf( '.footer__social-media .social-media-item.socail_media__instagram:before{ content: none; }' );
	}

	if ( $penci_footer_icon_bg_hover_color ) {
		$css .= sprintf( '.footer__social-media .social-media-item:hover{ background-color:%s !important; }', esc_attr( $penci_footer_icon_bg_hover_color ) );
	}

	if ( $penci_footer_icon_hover_color ) {
		$css .= sprintf( '.footer__social-media .social-media-item:hover{ color:%s !important; }', esc_attr( $penci_footer_icon_hover_color ) );
	}

	/********** Logo ************/
	$penci_footer_logo_color = penci_get_theme_mod( 'penci_footer_logo_color' );
	if ( $penci_footer_logo_color ) {
		$css .= sprintf( '.footer__logo a,.footer__logo a:hover{ color:%s ; }', esc_attr( $penci_footer_logo_color ) );
	}

	/********** Copyright ************/
	$penci_footer_copyright_bg_color   = penci_get_theme_mod( 'penci_footer_copyright_bg_color' );
	$penci_footer_copyright_text_color = penci_get_theme_mod( 'penci_footer_copyright_text_color' );
	$penci_footer_copyright_link_color = penci_get_theme_mod( 'penci_footer_copyright_link_color' );

	if ( $penci_footer_copyright_bg_color ) {
		$css .= sprintf( '.footer__copyright_menu{ background-color:%s ; }', esc_attr( $penci_footer_copyright_bg_color ) );
	}

	if ( $penci_footer_copyright_text_color ) {
		$css .= sprintf( '.site-info{ color:%s ; }', esc_attr( $penci_footer_copyright_text_color ) );
	}

	if ( $penci_footer_copyright_link_color ) {
		$css .= sprintf( '.site-info a, .site-info a:hover{ color:%s ; }', esc_attr( $penci_footer_copyright_link_color ) );
	}


	/********** Menu link ************/
	$footer_menu_color  = penci_get_theme_mod( 'penci_footer_menu_link_color' );
	$footer_menu_hcolor = penci_get_theme_mod( 'penci_footer_menu_link_hcolor' );

	if ( $footer_menu_color ) {
		$css .= sprintf( '.sub-footer-menu li a { color:%s ; }', esc_attr( $footer_menu_color ) );
	}
	if ( $footer_menu_hcolor ) {
		$css .= sprintf( '.sub-footer-menu li a:hover { color:%s ; }', esc_attr( $footer_menu_hcolor ) );
	}

	/********** Go to top ************/
	$penci_gototop_color         = penci_get_theme_mod( 'penci_gototop_color' );
	$penci_gototop_bgcolor       = penci_get_theme_mod( 'penci_gototop_bgcolor' );
	$penci_gototop_hover_color   = penci_get_theme_mod( 'penci_gototop_hover_color' );
	$penci_gototop_hover_bgcolor = penci_get_theme_mod( 'penci_gototop_hover_bgcolor' );

	if ( $penci_gototop_color ) {
		$css .= sprintf( '#scroll-to-top{ color:%s ; }', esc_attr( $penci_gototop_color ) );
	}

	if ( $penci_gototop_bgcolor ) {
		$css .= sprintf( '#scroll-to-top{ background-color:%s ; }', esc_attr( $penci_gototop_bgcolor ) );
	}

	if ( $penci_gototop_hover_color ) {
		$css .= sprintf( '#scroll-to-top:hover{ color:%s ; }', esc_attr( $penci_gototop_hover_color ) );
	}

	if ( $penci_gototop_hover_bgcolor ) {
		$css .= sprintf( '#scroll-to-top:hover{ background-color:%s ; }', esc_attr( $penci_gototop_hover_bgcolor ) );
	}

	// RDGP
	$gprd_bgcolor     = penci_get_theme_mod( 'penci_gprd_bgcolor' );
	$gprd_color       = penci_get_theme_mod( 'penci_gprd_color' );
	$gprd_btn_color   = penci_get_theme_mod( 'penci_gprd_btn_color' );
	$gprd_btn_bgcolor = penci_get_theme_mod( 'penci_gprd_btn_bgcolor' );
	$gprd_border      = penci_get_theme_mod( 'penci_gprd_border' );

	if ( $gprd_bgcolor ) {
		$css .= '.penci-wrap-gprd-law .penci-gdrd-show,.penci-gprd-law{ background-color: ' . $gprd_bgcolor . ' } ';
	}
	if ( $gprd_color ) {
		$css .= '.penci-wrap-gprd-law .penci-gdrd-show,.penci-gprd-law{ color: ' . $gprd_color . ' } ';
	}
	if ( $gprd_btn_color ) {
		$css .= '.penci-gprd-law .penci-gprd-accept{ color: ' . $gprd_btn_color . ' }';
	}
	if ( $gprd_btn_bgcolor ) {
		$css .= '.penci-gprd-law .penci-gprd-accept{ background-color: ' . $gprd_btn_bgcolor . ' }';
	}
	if ( $gprd_border ) {
		$css .= '.penci-gprd-law{ border-top: 2px solid ' . $gprd_border . ' } ';
		$css .= '.penci-wrap-gprd-law .penci-gdrd-show{ border: 1px solid ' . $gprd_border . '; border-bottom: 0; } ';
	}

	return $css;
}