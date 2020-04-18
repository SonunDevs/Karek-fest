<?php
if ( function_exists( 'penci_customizer_sidebar' ) ) {
	return;
}
function penci_customizer_sidebar() {

	$css = '';

	$widget_margin_bottom =  penci_get_theme_mod( 'penci_sidebar_widget_margin_bottom' );

	if ( $widget_margin_bottom ) {
		$css .= sprintf( '@media( min-width: 768px ) {.penci-sidebar-widgets .penci-block-vc.widget, .penci_dis_padding_bw .penci-sidebar-widgets .penci-block-vc.widget { margin-bottom:%spx; } }',
			esc_attr( $widget_margin_bottom ) );
	}

	// Block title and widget title
	$fontfamily_blocktitle   = penci_get_theme_mod( 'penci_font_blocktitle' );
	$font_weight_blocktitle  = penci_get_theme_mod( 'penci_font_weight_blocktitle' );
	$font_size_blocktitle    = penci_get_theme_mod( 'penci_font_for_size_blocktitle' );
	$hline_bottom_blocktitle = intval( penci_get_theme_mod( 'penci_height_line_bottom_blocktitle' ) );
	$hline_top_blocktitle    = penci_get_theme_mod( 'penci_height_line_top_blocktitle' );

	$hline_blocktitle_11_12 = intval( penci_get_theme_mod( 'penci_height_line_blocktitle11_12' ) );

	$font_blocktitle = '';
	if ( $font_size_blocktitle ) {
		$font_blocktitle .= sprintf( 'font-size:%spx !important;', esc_attr( $font_size_blocktitle ) );
	}

	if ( $font_weight_blocktitle ) {
		$font_blocktitle .= sprintf( 'font-weight:%s !important;', esc_attr( $font_weight_blocktitle ) );
	}

	if ( $fontfamily_blocktitle ) {
		$font_blocktitle .= sprintf( 'font-family:%s !important;', penci_google_fonts_parse_attributes( $fontfamily_blocktitle ) );
	}

	if ( $fontfamily_blocktitle ) {
		$css .= sprintf( '.penci-menu-hbg-widgets .menu-hbg-title { font-family:%s }', penci_google_fonts_parse_attributes( $fontfamily_blocktitle ) );
	}

	if ( $font_blocktitle ) {
		$css .= sprintf( '
		.woocommerce div.product .related > h2,.woocommerce div.product .upsells > h2,
		.post-title-box .post-box-title,.site-content #respond h3,.site-content .widget-title,
		.site-content .widgettitle,
		body.page-template-full-width.page-paged-2 .site-content .widget.penci-block-vc .penci-block__title,
		body:not( .page-template-full-width ) .site-content .widget.penci-block-vc .penci-block__title{ %s }', ( $font_blocktitle ) );
	}

	if ( $hline_bottom_blocktitle ) {
		$css .= sprintf( '.site-content .widget.penci-block-vc .penci-block-heading{ border-bottom-width: %spx; }', esc_attr( $hline_bottom_blocktitle ) );
		$css .= sprintf( '.site-content .widget.penci-block-vc.style-title-3:not(.footer-widget) .penci-block-heading{ border-bottom-width: %spx; }', esc_attr( $hline_bottom_blocktitle ) );
		$css .= sprintf( '.site-content .widget.penci-block-vc.style-title-3:not(.footer-widget) .penci-block-heading:after{ height: %spx;bottom:%spx }',
			esc_attr( $hline_bottom_blocktitle ),
			( $hline_bottom_blocktitle > 0 ) ? '-' . ( $hline_bottom_blocktitle ) : ( $hline_bottom_blocktitle )
		);
	}

	if ( $hline_top_blocktitle ) {
		$css .= sprintf( '.site-content .widget.penci-block-vc.style-title-1 .penci-block__title:before{ border-top-width: %spx; }', esc_attr( $hline_top_blocktitle ) );
	}

	if( $hline_blocktitle_11_12 ){
		$css .= '.site-content .widget.penci-block-vc.style-title-11:not(.footer-widget) .penci-block__title:after,
		 .site-content .widget.penci-block-vc.style-title-11:not(.footer-widget) .penci-block__title:after{ height: ' . esc_attr( $hline_blocktitle_11_12 ) . 'px; }';
	}

	if( penci_get_theme_mod( 'penci_off_uppearcase_block_title' ) ) {
		$css .= sprintf( '.site-content .widget.penci-block-vc .penci-block__title{ text-transform: none; }' );
	}

	return $css;
}

