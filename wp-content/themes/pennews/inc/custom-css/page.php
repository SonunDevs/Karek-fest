<?php
if ( function_exists( 'penci_customizer_page' ) ) {
	return;
}
function penci_customizer_page() {
	if ( ! is_page() ) {
		return '';
	}

	$css             = '';
	$size_post_title = penci_get_theme_mod( 'penci_page_size_post_title' );

	if ( $size_post_title ) {
		$css .= sprintf( '.page .penci-entry-title{ font-size:%spx; }', esc_attr( $size_post_title ) );
		
	}

	$page_id = get_the_ID();
	if ( ! empty( $page_id ) ) {
		$use_option_current  = get_post_meta( $page_id, 'penci_use_option_current_page', true );
		$size_post_title_pre = get_post_meta( $page_id, 'penci_page_size_post_title', true );
		if ( ! empty( $use_option_current ) && $size_post_title_pre ) {
			$css .= sprintf( '.page-id-%s .penci-entry-title{ font-size:%spx; }', esc_attr( $page_id ), esc_attr( $size_post_title_pre ) );
		}
	}

	$w_container  = penci_get_theme_mod( 'penci_page_w_container' );

	$page_sidebar_layout = penci_get_setting( 'penci_page_sidebar_layout' );
	$single_w2col = penci_get_theme_mod( 'penci_single_width_2col' );
	$single_w3col = penci_get_theme_mod( 'penci_single_width_3col' );

	$single_w3col_total = $single_w2col_total = 0;
	if( $single_w3col  ){
		$single_w3col_arr   = Penci_Resizable_Width::parseData( $single_w3col );
		$single_w3col_total = isset( $single_w3col_arr['total'] ) ? $single_w3col_arr['total'] : '1400';

		$single_w3col_sbar1 = isset( $single_w3col_arr['sidebar1'] ) ? $single_w3col_arr['sidebar1'] : '21';
		$single_w3col_sbar2 = isset( $single_w3col_arr['sidebar2'] ) ? $single_w3col_arr['sidebar2'] : '21';
		$single_w3col_main  = 100 - ( $single_w3col_sbar1 + $single_w3col_sbar2 );

		if( $single_w3col_sbar1 && $single_w3col_sbar2 ){
			$css .= '@media screen and (min-width: 1240px){';
			$css .= '.page.two-sidebar:not( .penci-block-pagination ) .site-main .penci-container .widget-area-1 {width: ' . $single_w3col_sbar2 . '%;}';
			$css .= '.page.two-sidebar:not( .penci-block-pagination ) .site-main .penci-container .widget-area-2{ width: ' . $single_w3col_sbar1 . '%; }';
			$css .= '.page.two-sidebar:not( .penci-block-pagination ) .site-main .penci-container .penci-wide-content { width: ' . $single_w3col_main  . '%;max-width: 100%; }';
			$css .= '}';
		}
	}

	if( $single_w2col ){

		$single_w2col_arr       = Penci_Resizable_Width::parseData( $single_w2col );
		$single_w2col_total     = isset( $single_w2col_arr['total'] ) ? $single_w2col_arr['total'] : '1110';
		$single_w2col_sbar1     = isset( $single_w2col_arr['sidebar1'] ) ? $single_w2col_arr['sidebar1'] : '27';
		$single_w2col_main      = 100 - $single_w2col_sbar1;


		if( $single_w2col_main && $single_w2col_sbar1 ) {
			$css .= '@media screen and (min-width: 960px){';
			$css .= '.page.sidebar-left:not( .penci-block-pagination ) .site-main .penci-wide-content,';
			$css .= '.page.sidebar-right:not( .penci-block-pagination ) .site-main .penci-wide-content{';
			$css .= 'width: ' . $single_w2col_main . '%;max-width: 100%;}';

			$css .= '.page.sidebar-left:not( .penci-block-pagination ) .site-main .widget-area,';
			$css .= '.page.sidebar-right:not( .penci-block-pagination ) .site-main .widget-area{';
			$css .= 'width: ' . $single_w2col_sbar1 . '%;max-width: 100%;}';
			$css .= '}';

			$css .= '@media screen and (max-width: 1240px) and (min-width: 960px){';
			$css .= '.page.sidebar-left:not( .penci-block-pagination ) .site-main .penci-wide-content,';
			$css .= '.page.sidebar-right:not( .penci-block-pagination ) .site-main .penci-container__content,';
			$css .= '.page.two-sidebar:not( .penci-block-pagination ) .site-main .penci-wide-content { margin-left:0; width: ' . $single_w2col_main . '%;}';
			$css .= '}';
		}
	}

	if( $single_w3col_total && 'two-sidebar' == $page_sidebar_layout ){
		$w_container = $single_w3col_total;
	} elseif( $single_w2col_total ){
		$w_container = $single_w2col_total;
	}

	$single_columns_gap = get_theme_mod( 'penci_single_columns_gap' );
	if ( $single_columns_gap ) {

		$css .= '@media screen and (min-width: 960px){';
		$css .= '.page.sidebar-left:not( .penci-block-pagination ) .site-main .penci-wide-content {padding-left: ' . esc_attr( $single_columns_gap ) . 'px;}';
		$css .= '.page.sidebar-right:not( .penci-block-pagination ) .site-main .penci-wide-content {padding-right: ' . esc_attr( $single_columns_gap ) . 'px;}';

		$css .= '}';
		$css .= '@media screen and (min-width: 1240px){';
		$css .= '.page.two-sidebar:not( .penci-block-pagination ) .site-main .penci-container .penci-wide-content{ padding-left: ' . esc_attr( $single_columns_gap ) . 'px; padding-right: ' . esc_attr( $single_columns_gap ) . 'px;}';
		$css .= '}';
	}

	if ( $w_container  ) {
		$w_container   = $w_container  + 30;
		$fix_container = '.page-template-default .site-main .penci-container{ max-width: 100%; }';

		$css .= sprintf( '@media screen and (min-width: %spx){ .page-template-default  .site-main{ max-width:%spx;margin-left: auto; margin-right: auto; } %s }',
			esc_attr( $w_container  ),esc_attr( $w_container  ), $fix_container );
	}

	return $css;
}