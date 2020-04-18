<?php
if ( function_exists( 'penci_customizer_single' ) ) {
	return;
}
function penci_customizer_single() {
	if ( ! is_singular() ) {
		return '';
	}

	$css = '';

	$w_container             = penci_get_theme_mod( 'penci_single_w_container' );
	$related_post_title_size = penci_get_theme_mod( 'penci_related_post_title_size' );
	$rel_com_boxtitle_fsize  = penci_get_theme_mod( 'penci_rel_com_boxtitle_fsize' );
	$single_author_size      = penci_get_theme_mod( 'penci_single_author_size' );
	$single_next_prev_title  = penci_get_theme_mod( 'penci_single_next_prev_title' );
	$single_next_prev_label  = penci_get_theme_mod( 'penci_single_next_prev_label' );
	$single_size_post_meta   = penci_get_theme_mod( 'penci_single_size_post_meta' );
	$single_size_post_title  = penci_get_theme_mod( 'penci_single_size_post_title' );
	$penci_single_gdpr_fsize  = penci_get_theme_mod( 'penci_single_gdpr_fsize' );

	$single_sidebar_layout = penci_get_setting( 'penci_single_sidebar_layout' );
	$single_w2col          = penci_get_theme_mod( 'penci_single_width_2col' );
	$single_w3col          = penci_get_theme_mod( 'penci_single_width_3col' );

	$single_w3col_total = $single_w2col_total = 0;
	if( $single_w3col  ){
		$single_w3col_arr   = Penci_Resizable_Width::parseData( $single_w3col );
		$single_w3col_total = isset( $single_w3col_arr['total'] ) ? $single_w3col_arr['total'] : '1400';

		$single_w3col_sbar1 = isset( $single_w3col_arr['sidebar1'] ) ? $single_w3col_arr['sidebar1'] : '21';
		$single_w3col_sbar2 = isset( $single_w3col_arr['sidebar2'] ) ? $single_w3col_arr['sidebar2'] : '21';
		$single_w3col_main  = 100 - ( $single_w3col_sbar1 + $single_w3col_sbar2 );

		if( $single_w3col_sbar1 && $single_w3col_sbar2 ){
			$css .= '@media screen and (min-width: 1240px){';
			$css .= '.single.two-sidebar .site-main .penci-container .widget-area-1 {width: ' . $single_w3col_sbar2 . '%;}';
			$css .= '.single.two-sidebar .site-main .penci-container .widget-area-2{ width: ' . $single_w3col_sbar1 . '%; }';
			$css .= '.single.two-sidebar .site-main .penci-container .penci-wide-content { width: ' . $single_w3col_main  . '%;max-width: 100%; }';
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
			$css .= '.single.sidebar-left .site-main .penci-wide-content,';
			$css .= '.single.sidebar-right .site-main .penci-wide-content{';
			$css .= 'width: ' . $single_w2col_main . '%;max-width: 100%;}';

			$css .= '.single.sidebar-left .site-main .widget-area,';
			$css .= '.single.sidebar-right .site-main .widget-area{';
			$css .= 'width: ' . $single_w2col_sbar1 . '%;max-width: 100%;}';
			$css .= '}';

			$css .= '@media screen and (max-width: 1240px) and (min-width: 960px){';
			$css .= '.single.sidebar-left .site-main .penci-wide-content,';
			$css .= '.single.sidebar-right .site-main .penci-container__content,';
			$css .= '.single.two-sidebar .site-main .penci-wide-content { margin-left:0; width: ' . $single_w2col_main . '%;}';
			$css .= '.single.two-sidebar .site-main .widget-area { width: ' . $single_w2col_sbar1 . '%;}';
			$css .= '}';
		}
	}

	if( $single_w3col_total && 'two-sidebar' == $single_sidebar_layout ){
		$w_container = $single_w3col_total;
	} elseif( $single_w2col_total ){
		$w_container = $single_w2col_total;
	}

	if( ( ( function_exists( 'is_bbpress' ) && is_bbpress() ) || ( function_exists( 'is_buddypress' ) && is_buddypress() ) ) && 'two-sidebar' == $single_sidebar_layout ){
		$w_container = '';
	}

	$single_columns_gap = get_theme_mod( 'penci_single_columns_gap' );
	if ( $single_columns_gap ) {

		$css .= '@media screen and (min-width: 960px){';
		$css .= '.single.sidebar-left .site-main .penci-wide-content {padding-left: ' . esc_attr( $single_columns_gap ) . 'px;}';
		$css .= '.single.sidebar-right .site-main .penci-wide-content {padding-right: ' . esc_attr( $single_columns_gap ) . 'px;}';

		$css .= '}';
		$css .= '@media screen and (min-width: 1240px){';
		$css .= '.single.two-sidebar .site-main .penci-container .penci-wide-content{ padding-left: ' . esc_attr( $single_columns_gap ) . 'px; padding-right: ' . esc_attr( $single_columns_gap ) . 'px;}';
		$css .= '}';
	}

	if ( $w_container  ) {
		$w_container = $w_container + 30;
		$css .= sprintf( '@media screen and (min-width: %spx){ .single .site-main > .penci-container, .single .site-main .penci-entry-media + .penci-container, .single .site-main .penci-entry-media .penci-container { max-width:%spx;margin-left: auto; margin-right: auto; } }',
			esc_attr( $w_container  ),esc_attr( $w_container  ) );

	}

	if ( $single_size_post_title ) {
		$css .= sprintf( '.single .penci-entry-title{ font-size:%spx; }', esc_attr( $single_size_post_title ) );
	}

	if ( $single_size_post_meta ) {
		$css .= sprintf( '.single .penci-entry-meta{ font-size:%spx; }', esc_attr( $single_size_post_meta ) );
	}

	if ( $single_next_prev_label ) {
		$css .= sprintf( '.single .penci-post-pagination span{ font-size:%spx; }', esc_attr( $single_next_prev_label ) );
	}

	if ( $single_next_prev_title ) {
		$css .= sprintf( '.penci-post-pagination h5{ font-size:%spx; }', esc_attr( $single_next_prev_title ) );
	}

	if ( $single_author_size ) {
		$css .= sprintf( '.penci-author-content h5 a{ font-size:%spx; }', esc_attr( $single_author_size ) );
	}

	if ( $related_post_title_size ) {
		$css .= sprintf( '.penci-post-related .item-related h4{ font-size:%spx; }', esc_attr( $related_post_title_size ) );
	}

	if ( $rel_com_boxtitle_fsize ) {
		$css .= '
		.penci-post-related .post-title-box .post-box-title,
		.post-comments .post-title-box .post-box-title, 
		.site-content .post-comments #respond h3{ font-size: ' . $rel_com_boxtitle_fsize . 'px !important; }';
	}

	if ( $penci_single_gdpr_fsize ) {
		$css .= 'form#commentform > div.penci-gdpr-message{ font-size: ' . $penci_single_gdpr_fsize . 'px !important; }';
	}

	$post_id = get_the_ID();

	$css_heading = '';
	for ( $i = 1; $i < 7; $i ++ ) {
		$heading_fsize      = penci_get_theme_mod( 'penci_pp_h' . $i . '_fsize' );
		$heading_fsize_pmta = get_post_meta( $post_id, 'penci_pp_h' . $i . '_fsize', true );
		if ( $heading_fsize_pmta ) {
			$heading_fsize = $heading_fsize_pmta;
		}
		if ( $heading_fsize ) {
			$css_heading .= '.penci-content-post .entry-content h' . $i . '{ font-size: ' . $heading_fsize . 'px; }';
		}
	}
	if( $css_heading ){
		$css .= '@media only screen and (min-width: 768px) {' . $css_heading . '}';
	}

	$single_image_ratio = get_theme_mod( 'penci_post_featured_image_ratio' );

	$pmeta_single_image_ratio = get_post_meta( get_the_ID(), 'penci_pfeatured_image_ratio', true );
	if( $pmeta_single_image_ratio ){
		$single_image_ratio = $pmeta_single_image_ratio ;
	}

	
	if( $single_image_ratio ){
		$single_image_ratio = array_filter( explode( ':', $single_image_ratio . ':') );
		$single_image_width = isset( $single_image_ratio[0] ) ? $single_image_ratio[0] : '';
		$single_image_height = isset( $single_image_ratio[1] ) ? $single_image_ratio[1] : '';
		
		if( $single_image_width && $single_image_height ) {
			$css  .= '.single .penci-single-featured-img{ padding-top: ' . number_format(  $single_image_height / $single_image_width * 100, 4 ) . '% !important; }';
		}
	}

	return $css;
}