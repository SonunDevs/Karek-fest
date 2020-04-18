<?php
if ( function_exists( 'penci_customizer_general' ) ) {
	return;
}
function penci_customizer_general() {
	$css = '';

	$font_for_title               = penci_get_theme_mod( 'penci_font_for_title' );
	$font_weight_title            = penci_get_theme_mod( 'penci_font_weight_title' );

	$font_block__heading_title   = penci_get_theme_mod( 'penci_font_block_heading_title' );
	$fweight_block_heading_title = penci_get_theme_mod( 'penci_fweight_block_heading_title' );

	$font_for_body                = penci_get_theme_mod( 'penci_font_for_body' );
	$font_for_size_body           = penci_get_theme_mod( 'penci_font_for_size_body' );
	$space_between_content_footer = penci_get_theme_mod( 'penci_space_between_content_footer' );

	$css .= '.penci-block-vc.style-title-13:not(.footer-widget).style-title-center .penci-block-heading {border-right: 10px solid transparent; border-left: 10px solid transparent; }';
	$css .= '.site-branding h1, .site-branding h2 {margin: 0;}.penci-schema-markup { display: none !important; }';
	$css .= '.penci-entry-media .twitter-video { max-width: none !important; margin: 0 !important; }';
	$css .= '.penci-entry-media .fb-video { margin-bottom: 0; }';
	$css .= '.penci-entry-media .post-format-meta > iframe { vertical-align: top; }';
	$css .= '.penci-single-style-6 .penci-entry-media-top.penci-video-format-dailymotion:after, .penci-single-style-6 .penci-entry-media-top.penci-video-format-facebook:after, .penci-single-style-6 .penci-entry-media-top.penci-video-format-vimeo:after, .penci-single-style-6 .penci-entry-media-top.penci-video-format-twitter:after, .penci-single-style-7 .penci-entry-media-top.penci-video-format-dailymotion:after, .penci-single-style-7 .penci-entry-media-top.penci-video-format-facebook:after, .penci-single-style-7 .penci-entry-media-top.penci-video-format-vimeo:after, .penci-single-style-7 .penci-entry-media-top.penci-video-format-twitter:after { content: none; } .penci-single-style-5 .penci-entry-media.penci-video-format-dailymotion:after, .penci-single-style-5 .penci-entry-media.penci-video-format-facebook:after, .penci-single-style-5 .penci-entry-media.penci-video-format-vimeo:after, .penci-single-style-5 .penci-entry-media.penci-video-format-twitter:after { content: none; }';
	$css.= '@media screen and (max-width: 960px) { .penci-insta-thumb ul.thumbnails.penci_col_5 li, .penci-insta-thumb ul.thumbnails.penci_col_6 li { width: 33.33% !important; } .penci-insta-thumb ul.thumbnails.penci_col_7 li, .penci-insta-thumb ul.thumbnails.penci_col_8 li, .penci-insta-thumb ul.thumbnails.penci_col_9 li, .penci-insta-thumb ul.thumbnails.penci_col_10 li { width: 25% !important; } }';
	$css .= '.site-header.header--s12 .penci-menu-toggle-wapper,.site-header.header--s12 .header__social-search { flex: 1; }';
	$css .= '.site-header.header--s5 .site-branding {  padding-right: 0;margin-right: 40px; }';
	$css .= '.penci-block_37 .penci_post-meta { padding-top: 8px; }.penci-block_37 .penci-post-excerpt + .penci_post-meta { padding-top: 0; }';
	$css .= '.penci-hide-text-votes { display: none; }.penci-usewr-review {  border-top: 1px solid #ececec; }.penci-review-score {top: 5px; position: relative; }';
	$css .= '.penci-social-counter.penci-social-counter--style-3 .penci-social__empty a, .penci-social-counter.penci-social-counter--style-4 .penci-social__empty a, .penci-social-counter.penci-social-counter--style-5 .penci-social__empty a, .penci-social-counter.penci-social-counter--style-6 .penci-social__empty a { display: flex; justify-content: center; align-items: center; }';
	$css .= '.penci-block-error { padding: 0 20px 20px; }';
	$css .= '@media screen and (min-width: 1240px){ .penci_dis_padding_bw .penci-content-main.penci-col-4:nth-child(3n+2) { padding-right: 15px; padding-left: 15px; }}';
	$css .= '.bos_searchbox_widget_class.penci-vc-column-1 #flexi_searchbox #b_searchboxInc .b_submitButton_wrapper{ padding-top: 10px; padding-bottom: 10px; }';
	$css .= '.mfp-image-holder .mfp-close, .mfp-iframe-holder .mfp-close { background: transparent; border-color: transparent; }';

	$pos_ctsidebar_mb = penci_get_setting( 'penci_general_pos_ctsidebar_mb' );
	if ( $pos_ctsidebar_mb && 'con_sb2_sb1' != $pos_ctsidebar_mb ) {
		$css .= '@media (max-width: 768px) {';
		$css .= '.penci-sb2_con_sb1, .penci-sb2_sb1_con, .penci-sb1_con_sb2, .penci-sb1_sb2_con, .penci-con_sb1_sb2 { flex-direction: column; display: flex; }';
		$css .= '.penci-sb2_con_sb1 > .widget-area-2, .penci-sb2_sb1_con > .widget-area-2, .penci-sb1_con_sb2 > .widget-area-1, .penci-sb1_sb2_con > .widget-area-1, .penci-con_sb1_sb2 > .penci-wide-content { order: 1 !important;margin-top: 0; }';
		$css .= '.penci-sb2_con_sb1 > .penci-wide-content, .penci-sb2_sb1_con > .widget-area-1, .penci-sb1_con_sb2 > .penci-wide-content, .penci-sb1_sb2_con > .widget-area-2, .penci-con_sb1_sb2 > .widget-area-1 { order: 2 !important;margin-top: 20px; }';
		$css .= '.penci-sb2_con_sb1 > .widget-area-1, .penci-sb2_sb1_con > .penci-wide-content, .penci-sb1_con_sb2 > .widget-area-2, .penci-sb1_sb2_con > .penci-wide-content, .penci-con_sb1_sb2 > .widget-area-2 { order: 3 !important; }';
		$css .= '}';
	}

	if ( $font_for_title ) {
		$css .= sprintf( 'h1, h2, h3, h4, h5, h6,.error404 .page-title,
		.error404 .penci-block-vc .penci-block__title, .footer__bottom.style-2 .block-title {font-family: %s}',
			penci_google_fonts_parse_attributes( $font_for_title ) );

		if( class_exists( 'WooCommerce' ) ){
			$css .= sprintf( ' .product_list_widget .product-title,
			.woocommerce div.product .woocommerce-tabs ul.tabs li a,
			.woocommerce ul.cart_list li a, 
			.woocommerce ul.product_list_widget li a{font-family: %s}',
				penci_google_fonts_parse_attributes( $font_for_title ) );
		}

		if( function_exists( 'bos_create_searchbox' ) ) {
			$css .= sprintf( '.bos_searchbox_widget_class #flexi_searchbox h1, 
			 .bos_searchbox_widget_class #flexi_searchbox h2,
			 .bos_searchbox_widget_class #flexi_searchbox h3, 
			 .bos_searchbox_widget_class #flexi_searchbox h4 {font-family: %s}',
				penci_google_fonts_parse_attributes( $font_for_title ) );
		}
	}

	if ( $font_weight_title ) {
		$css .= sprintf( 'h1, h2, h3, h4, h5, h6,.error404 .page-title,
		 .error404 .penci-block-vc .penci-block__title, .product_list_widget .product-title, .footer__bottom.style-2 .block-title {font-weight: %s}',
			esc_attr( $font_weight_title ) );

		if( class_exists( 'WooCommerce' ) ){
			$css .= sprintf( '.product_list_widget .product-title,
			.woocommerce div.product .woocommerce-tabs ul.tabs li a,
			.woocommerce ul.cart_list li a, 
			.woocommerce ul.product_list_widget li a{font-weight: %s}',
				esc_attr( $font_weight_title ) );
		}
	}

	if ( $font_block__heading_title ) {
		$css .= '.penci-block-vc .penci-block__title, .penci-menu-hbg .penci-block-vc .penci-block__title, .penci-menu-hbg-widgets .menu-hbg-title{ font-family:' . penci_google_fonts_parse_attributes( $font_block__heading_title ) . '; }';
	}

	if ( $fweight_block_heading_title ) {
		$css .= '.penci-block-vc .penci-block__title, .penci-menu-hbg .penci-block-vc .penci-block__title, .penci-menu-hbg-widgets .menu-hbg-title{ font-weight:' . esc_attr( $fweight_block_heading_title ) . '; }';
	}

	if ( $font_for_body ) {
		$css .= sprintf(
			'body, button, input, select, textarea,'.
			'.woocommerce ul.products li.product .button,'.
			'#site-navigation .penci-megamenu .penci-mega-thumbnail .mega-cat-name{font-family: %s}', penci_google_fonts_parse_attributes( $font_for_body ) );

		if( function_exists( 'bos_create_searchbox' ) ) {
			$css .= sprintf( '.bos_searchbox_widget_class #flexi_searchbox #b_searchboxInc .b_submitButton_wrapper .b_submitButton{font-family: %s}',
				penci_google_fonts_parse_attributes( $font_for_body ) );
		}
	}

	if ( $font_for_size_body ) {
		$css .= sprintf( '.single .entry-content,.page .entry-content{ font-size:%spx; }', esc_attr( $font_for_size_body ) );
	}

	$margin_bottom_nav =  penci_get_theme_mod( 'penci_margin_bottom_menu_main' );

	if ( $margin_bottom_nav || 0 ===  $margin_bottom_nav ) {
		$css .= sprintf( '.site-content,.penci-page-style-1 .site-content, 
		.page-template-full-width.penci-block-pagination .site-content,
		.penci-page-style-2 .site-content, .penci-single-style-1 .site-content, 
		.penci-single-style-2 .site-content,.penci-page-style-3 .site-content,
		.penci-single-style-3 .site-content{ margin-top:%spx; }', esc_attr($margin_bottom_nav ) );}


	if( $space_between_content_footer ) {
		$css .= sprintf( '.site-content, .page-template-full-width.penci-block-pagination .site-content{ margin-bottom:%spx; }', esc_attr( $space_between_content_footer ) );
	}

	$space_content_sidebar = penci_get_theme_mod( 'penci_space_between_content_sidebar' );
	if ( $space_content_sidebar && $space_content_sidebar < 151 ) {

		$half_space = $space_content_sidebar / 2;

		$important = '!important';

		$css .= '.penci-vc_two-sidebar.penci-vc_2sidebar-content.penci-container .penci-wide-content,';
		$css .= '.penci-vc_two-sidebar.penci-vc_2sidebar-content.penci-container-fluid  .penci-wide-content,';
		$css .= '.penci-vc_two-sidebar.penci-vc_content-2sidebar.penci-container .penci-wide-content,';
		$css .= '.penci-vc_two-sidebar.penci-vc_content-2sidebar.penci-container-fluid .penci-wide-content {padding-left: 0 !important;padding-right: 0 !important;}';


		$css .= sprintf( '@media screen and (min-width: 1240px){
		.two-sidebar .site-main .penci-container .penci-wide-content,
		.penci-vc_two-sidebar.penci-container .penci-wide-content,
		.penci-vc_two-sidebar.penci-container-fluid .penci-wide-content{ padding-left: %dpx%s; padding-right:%dpx%s;  }}',
			    esc_attr( $space_content_sidebar ), esc_attr( $important ), esc_attr( $space_content_sidebar ) ,  esc_attr( $important ) );

		$css .= sprintf( '@media screen and (min-width: 1240px){
		 .penci-vc_sidebar-left .penci-content-main,
		 .penci-container-width-1400 .penci-con_innner-sidebar-left .penci_column_inner-main, 
		 .sidebar-left .site-main .penci-wide-content{ padding-left:%dpx %s;padding-right: 0 %s; }}',
			    esc_attr( $space_content_sidebar ) , esc_attr( $important ), esc_attr( $important ) );

		$css .= sprintf( '@media screen and (min-width: 1240px){ 
		 .penci-vc_sidebar-right .penci-content-main,
		 .sidebar-right .site-main .penci-wide-content,
		 .penci-container-width-1400 .penci-con_innner-sidebar-right .penci_column_inner-main { padding-right:%dpx %s; padding-left:0 %s; }}',
			   esc_attr( $space_content_sidebar ) , esc_attr( $important ), esc_attr( $important ) );

		$css .= sprintf( '@media screen and (min-width: 1240px){  .penci-container__content .penci-col-6:nth-child(2n+1), .penci-two-column .penci-container__content .penci-two-column-item:nth-child(2n+1){ padding-right:%dpx %s; }}',
			esc_attr( $half_space ), esc_attr( $important ) );
		$css .= sprintf( '@media screen and (min-width: 1240px){  .penci-container__content .penci-col-6:nth-child(2n+2), .penci-two-column .penci-container__content .penci-two-column-item:nth-child(2n+2){ padding-left:%dpx %s; }}',
			esc_attr( $half_space ), esc_attr( $important ) );

		$css .= sprintf( '@media screen and (min-width: 1240px){  .penci-container__content .penci-col-4:nth-child(3n+1){ padding-right:%dpx %s; }}',
			esc_attr( $half_space ), esc_attr( $important ) );
		$css .= sprintf( '@media screen and (min-width: 1240px){  .penci-container__content .penci-col-4:nth-child(3n+2){ padding-left:%dpx %s; padding-right:%dpx %s; }}',
			esc_attr( $half_space ), esc_attr( $important ), esc_attr( $half_space ), esc_attr( $important ) );
		$css .= sprintf( '@media screen and (min-width: 1240px){  .penci-container__content .penci-col-4:nth-child(3n+3){ padding-left:%dpx %s; }}',
			esc_attr( $half_space ), esc_attr( $important ) );


		$css .= sprintf( '@media screen and (min-width: 1240px){  .penci-container__content .penci-col-3:nth-child(4n+1){ padding-right:%dpx %s; }}',
			esc_attr( $half_space ), esc_attr( $important ) );
		$css .= sprintf( '@media screen and (min-width: 1240px){  .penci-container__content .penci-col-3:nth-child(4n+2),
		.penci-container__content .penci-col-3:nth-child(4n+3){ padding-left:%dpx %s; padding-right:%dpx %s; }}',
			esc_attr( $half_space ),esc_attr( $important ), esc_attr( $half_space ), esc_attr( $important ) );
		$css .= sprintf( '@media screen and (min-width: 1240px){  .penci-container__content .penci-col-3:nth-child(4n+4){ padding-left:%dpx %s; }}',
			esc_attr( $half_space ), esc_attr( $important ) );

		$css .= '@media screen and (min-width: 1240px) {.penci-recipe-index-wrap .penci-recipe-index .penci-recipe-index-item {padding-left: 10px !important;padding-right: 10px !important;}}';

		/**
		 * @media screen and (min-width: 1024px)
		 */
		$css .= sprintf( '@media screen and (min-width: 1240px){ 
		 .penci-vc_two-sidebar.penci-vc_content-2sidebar.penci-container .penci-wide-content,
		 .penci-vc_two-sidebar.penci-vc_content-2sidebar.penci-container-fluid .penci-wide-content,
		 .penci-vc_two-sidebar.penci-vc_2sidebar-content.penci-container .penci-wide-content,
		 .penci-vc_two-sidebar.penci-vc_2sidebar-content.penci-container-fluid .penci-wide-content{ max-width: calc( %s - %dpx) %s; }}',
			'100%', ( ( $space_content_sidebar * 2 ) + 600 ), esc_attr( $important ) );

		$css .= sprintf( '@media screen and (min-width: 1240px){ 
		 .penci-container-1080.penci-vc_two-sidebar .penci-content-main, 
		 .penci-container-width-1080.penci-vc_two-sidebar .penci-content-main{ max-width: calc( %s - %dpx) %s; }}',
			'100%', ( ( $space_content_sidebar * 2 ) + 600 ), esc_attr( $important ) );

		$css .= sprintf( '@media screen and (min-width: 1240px){ .penci-vc_two-sidebar.penci-vc_content-2sidebar.penci-container .widget-area-2,
		 .penci-vc_two-sidebar.penci-vc_content-2sidebar.penci-container-fluid .widget-area-2,
		 .penci-vc_two-sidebar.penci-vc_content-2sidebar.penci-container .widget-area-1, 
		 .penci-vc_two-sidebar.penci-vc_content-2sidebar.penci-container-fluid .widget-area-1{  padding-left:%dpx %s; width: %dpx %s; }}',
			esc_attr( $space_content_sidebar ), esc_attr( $important ), esc_attr( 300 + $space_content_sidebar ), esc_attr( $important ) );

		$css .= sprintf( '@media screen and (min-width: 1240px){ .penci-vc_two-sidebar.penci-vc_2sidebar-content.penci-container .widget-area-2,
		 .penci-vc_two-sidebar.penci-vc_2sidebar-content.penci-container-fluid .widget-area-2,
		 .penci-vc_two-sidebar.penci-vc_2sidebar-content.penci-container .widget-area-1, 
		 .penci-vc_two-sidebar.penci-vc_2sidebar-content.penci-container-fluid .widget-area-1{  padding-right:%dpx %s; width: %dpx %s; }}',
			esc_attr( $space_content_sidebar ), esc_attr( $important ), esc_attr( 300 + $space_content_sidebar ), esc_attr( $important ) );
	}

	return $css;
}