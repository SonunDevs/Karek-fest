<?php
if ( function_exists( 'penci_customizer_footer' ) ) {
	return;
}
function penci_customizer_footer() {

	$css = '';

	// Logo
	$font_textlogo        = penci_get_theme_mod( 'penci_footer_font_textlogo' );
	$font_weight_textlogo = penci_get_theme_mod( 'penci_footer_fweight_textlogo' );
	$fontsize_textlogo    = penci_get_theme_mod( 'penci_footer_fsize_textlogo' );

	$css_footer_logo = '';

	if ( $font_textlogo ) {
		$css_footer_logo .= 'font-family: ' . penci_google_fonts_parse_attributes( $font_textlogo ) . ';';
	}

	if ( $font_weight_textlogo ) {
		$css_footer_logo .= 'font-weight: ' . esc_attr( $font_weight_textlogo ) . ' !important;';
	}

	if ( $fontsize_textlogo ) {
		$css_footer_logo .= 'font-size: ' . esc_attr( $fontsize_textlogo ) . 'px !important;';
	}

	if ( $css_footer_logo ) {
		$css .= '.footer__bottom  .footer__logo a{' . ( $css_footer_logo ) . '}';
	}


	// Footer widget padding
	$footer_wptop    = penci_get_theme_mod( 'penci_footer_w_padding_top' );
	$footer_wpbottom = penci_get_theme_mod( 'penci_footer_w_padding_bottom' );
	$footer_wpadding = '';

	if ( $footer_wptop ) {
		$footer_wpadding .= 'padding-top: ' . esc_attr( $footer_wptop ) . 'px;';
	}

	if ( $footer_wpbottom ) {
		$footer_wpadding .= 'padding-bottom: ' . esc_attr( $footer_wpbottom ) . 'px;';
	}

	if ( $footer_wpadding ) {
		$css .= '#footer__sidebars.footer__sidebars{' . ( $footer_wpadding ) . '}';
	}

	// Widget
	$font_blocktitle                = penci_get_theme_mod( 'penci_fwidget_font_blocktitle' );
	$font_weight_blocktitle         = penci_get_theme_mod( 'penci_fwidget_weight_blocktitle' );
	$font_size_blocktitle           = penci_get_theme_mod( 'penci_fwidget_fontsize_blocktitle' );
	$border_bottom_width_blocktitle = penci_get_theme_mod( 'penci_fwidget_lineheight_blocktitle' );
	$dis_upper_blocktitle           = penci_get_theme_mod( 'penci_fwidget_upper_blocktitle' );
	$dis_border_blocktitle          = penci_get_theme_mod( 'penci_fwidget_border_blocktitle' );
	$dis_fwidth_border_bottom       = penci_get_theme_mod( 'penci_fwidget_border_bottom' );

	$css_blocktitle = '';
	if ( $font_size_blocktitle ) {
		$css_blocktitle .= sprintf( 'font-size:%spx;', esc_attr( $font_size_blocktitle ) );
	}

	if ( $font_weight_blocktitle ) {
		$css_blocktitle .= sprintf( 'font-weight:%s;', esc_attr( $font_weight_blocktitle ) );
	}

	if ( $font_blocktitle ) {
		$css_blocktitle .= sprintf( 'font-family:%s;', penci_google_fonts_parse_attributes( $font_blocktitle ) );
	}

	if ( $dis_upper_blocktitle ) {
		$css_blocktitle .= sprintf( 'text-transform: none;' );
	}

	if ( $css_blocktitle ) {
		$css .= sprintf( '.site-footer .penci-block-vc .penci-block__title{ %s }', ( $css_blocktitle ) );
	}

	if ( $border_bottom_width_blocktitle && ! $dis_border_blocktitle ) {
		$css .= '.site-footer .penci-block-vc .penci-block-heading';
		$css .= '{ border-bottom-width: ' . esc_attr( $border_bottom_width_blocktitle ) . 'px; }';
	}

	if ( $dis_border_blocktitle ) {
		$css .= '.site-footer .penci-block-vc .penci-block-heading{ border-bottom: 0; }';
		$css .= '.site-footer .penci-block-vc .penci-block-heading .penci-block__title{  padding-bottom: 0;; }';
	}

	if( $dis_fwidth_border_bottom ) {
		$css .='.footer__sidebars + .footer__bottom .footer__bottom_container:before{ content: none; }';
	}

	// Footer buttom
	$css_footer_bottom_padding    = '';
	$footer_bottom_padding_top    = penci_get_theme_mod( 'penci_footer_bottom_padding_top' );
	$footer_bottom_padding_bottom = penci_get_theme_mod( 'penci_footer_bottom_padding_bottom' );

	if ( $footer_bottom_padding_top ) {
		$css_footer_bottom_padding .= 'padding-top:' . esc_attr( $footer_bottom_padding_top ) . 'px;';
	}

	if ( $footer_bottom_padding_bottom ) {
		$css_footer_bottom_padding .= 'padding-bottom:' . esc_attr( $footer_bottom_padding_bottom ) . 'px;';
	}

	if ( $css_footer_bottom_padding ) {
		$css .= '.footer__bottom .footer__bottom_container{' . esc_attr( $css_footer_bottom_padding ) . '}';
	}

	$fsize_title_cr  = penci_get_theme_mod( 'penci_footer_fsize_title_cr' );
	$fsize_copyright = penci_get_theme_mod( 'penci_footer_fsize_copyright' );
	$fsize_copyright2 = penci_get_theme_mod( 'penci_footer_fsize_copyright2' );
	if ( $fsize_title_cr ) {
		$css .= sprintf( '.footer__bottom.style-2 .block-title{ font-size:%spx !important;}', esc_attr( $fsize_title_cr ) );
	}

	if ( $fsize_copyright ) {
		$css .= sprintf( '.site-footer .penci-footer-text-wrap { font-size:%spx;}', esc_attr( $fsize_copyright ) );
	}

	if( $fsize_copyright2 ) {
		$css .= '.site-info{font-size:' . esc_attr( $fsize_copyright2 ) . 'px;}';
	}

	// Logo
	$bottom_padding_logo        = penci_get_theme_mod( 'penci_footer_bottom_padding_logo' );
	$penci_footer_maxwidth_logo = penci_get_theme_mod( 'penci_footer_maxwidth_logo' );
	$fontsize_social            = penci_get_theme_mod( 'penci_footer_fontsize_social' );
	$wh_social                  = penci_get_theme_mod( 'penci_footer_wh_social' );
	$copyright_ptb              = penci_get_theme_mod( 'penci_footer_copyright_ptb' );

	if( $copyright_ptb ) {
		$css .= sprintf( '.footer__copyright_menu { padding-top:%spx; padding-bottom: %spx; }', esc_attr( $copyright_ptb ), esc_attr( $copyright_ptb ) );
	}

	if ( $bottom_padding_logo ) {
		$css .= sprintf( '.footer__logo a{ padding-bottom:%spx;}', esc_attr( $bottom_padding_logo ) );
	}

	if ( $penci_footer_maxwidth_logo ) {
		$css .= sprintf( '.footer__logo a,.footer__logo img{ max-width:%spx;}', esc_attr( $penci_footer_maxwidth_logo ) );
	}

	if ( $fontsize_social ) {
		$css .= sprintf( '@media ( min-width: 992px ){ .footer__social-media .social-media-item{font-size:%spx;} }', esc_attr( $fontsize_social ) );
	}

	if ( $wh_social ) {
		$css .= sprintf( '@media ( min-width: 992px ){ .footer__social-media .social-media-item{ width:%spx; height:%spx; line-height:%spx; } }',
			esc_attr( $wh_social ), esc_attr( $wh_social ), esc_attr( $wh_social )
		);
	}






	return $css;
}