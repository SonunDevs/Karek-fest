<?php
if ( function_exists( 'penci_customizer_page_header' ) ){
	return;
}
function penci_customizer_page_header() {
	$css = '';

	$pheader_show = penci_check_page_title_show();
	if ( ! $pheader_show ) {
		return;
	}

	$post_id = get_the_ID();

	$width          = penci_get_theme_mod( 'penci_pheader_width' );

	$ptop          = penci_get_theme_mod( 'penci_pheader_ptop' );
	$pbottom       = penci_get_theme_mod( 'penci_pheader_pbottom' );
	$bgcolor       = penci_get_theme_mod( 'penci_pheader_bgcolor' );
	$bgimg         = penci_get_theme_mod( 'penci_pheader_bgimg' );


	$hideline      = penci_get_theme_mod( 'penci_pheader_hideline' );
	$turn_offup    = penci_get_theme_mod( 'penci_pheader_turn_offup' );
	$title_pbottom = penci_get_theme_mod( 'penci_pheader_title_pbottom' );
	$title_mbottom = penci_get_theme_mod( 'penci_pheader_title_mbottom' );

	$fonttitle   = penci_get_theme_mod( 'penci_pheader_fonttitle' );
	$title_fsize = penci_get_theme_mod( 'penci_pheader_title_fsize' );

	$fwtitle     = penci_get_theme_mod( 'penci_pheader_fwtitle' );
	$bread_fsize = penci_get_theme_mod( 'penci_pheader_bread_fsize' );

	$title_color   = penci_get_theme_mod( 'penci_pheader_title_color' );
	$bread_color   = penci_get_theme_mod( 'penci_pheader_bread_color' );
	$bread_hcolor  = penci_get_theme_mod( 'penci_pheader_bread_hcolor' );



	$pre__ptop          = get_post_meta( $post_id, 'penci_pheader_ptop', true );
	$pre__pbottom       = get_post_meta( $post_id, 'penci_pheader_pbottom', true );
	$pre__bgcolor       = get_post_meta( $post_id, 'penci_pheader_bgcolor', true );
	$pre__bgimg         = get_post_meta( $post_id, 'penci_pheader_bgimg', true );


	$pre__turn_offup    = get_post_meta( $post_id, 'penci_pheader_turn_offup', true );
	$pre__title_pbottom = get_post_meta( $post_id, 'penci_pheader_title_pbottom', true );
	$pre__title_mbottom = get_post_meta( $post_id, 'penci_pheader_title_mbottom' , true );

	$pre__fwtitle      = get_post_meta( $post_id, 'penci_pheader_fwtitle', true );
	$pre__title_fsize  = get_post_meta( $post_id, 'penci_pheader_title_fsize', true );
	$pre__bread_fsize  = get_post_meta( $post_id, 'penci_pheader_bread_fsize', true );


	$pre__title_color   = get_post_meta( $post_id, 'penci_pheader_title_color', true );
	$pre__bread_color   = get_post_meta( $post_id, 'penci_pheader_bread_color', true );
	$pre__bread_hcolor  = get_post_meta( $post_id, 'penci_pheader_bread_hcolor', true );
	$pre__hideline      = get_post_meta( $post_id, 'penci_pheader_hideline', true );

	if( $pre__ptop || '0' == $pre__ptop  ){ $ptop = $pre__ptop; }
	if( $pre__pbottom || '0' == $pre__pbottom ){ $pbottom = $pre__pbottom; }
	if( $pre__bgcolor ){ $bgcolor = $pre__bgcolor; }

	if( $pre__title_pbottom || '0' == $pre__title_pbottom ){ $title_pbottom = $pre__title_pbottom; }
	if( $pre__title_mbottom || '0' == $pre__title_mbottom ){ $title_mbottom = $pre__title_mbottom; }
	if( $pre__title_fsize ){ $title_fsize = $pre__title_fsize; }
	if( $pre__bread_fsize ){ $bread_fsize = $pre__bread_fsize; }
	if( $pre__title_color ){ $title_color = $pre__title_color; }
	if( $pre__bread_color ){ $bread_color = $pre__bread_color; }
	if( $pre__bread_hcolor ){ $bread_hcolor = $pre__bread_hcolor; }

	if( $pre__bgimg ){
		 $bgimg = wp_get_attachment_url( $pre__bgimg );
	}

	if( $pre__fwtitle ){
		$fwtitle = $pre__fwtitle;
	}
	if( $pre__turn_offup ){
		if ( 'on' == $pre__turn_offup ) {
			$turn_offup = 0;
		} elseif ( 'off' == $pre__turn_offup ) {
			$turn_offup = 1;
		}
	}
	if( $pre__hideline ){
		if ( 'hide' == $pre__hideline ) {
			$hideline = 1;
		} elseif ( 'show' == $pre__hideline ) {
			$hideline = 0;
		}
	}

	$css_wapper = '';

	// Custom width
	if( $width ){
		$css .= '.penci-page-header .penci-page-header-inner{ max-width:' . intval( $width + 30 ) . 'px; }';
	}

	if( $ptop || '0' === $ptop ){
		$css_wapper .= 'padding-top:' . esc_attr( $ptop ) . 'px;';
	}

	if( $pbottom || '0' === $pbottom ){
		$css_wapper .= 'padding-bottom:' . esc_attr( $pbottom ) . 'px;';
	}

	if( $bgcolor ){
		$css_wapper .= 'background-color:' . esc_attr( $bgcolor ) . ';';
	}
	if( $bgimg ){
		$css_wapper .= 'background-image: url('. esc_url( $bgimg ) .');';
	}

	if( $css_wapper ){
		$css .= '.penci-page-header{' . $css_wapper . '}';
	}

	$css_titlle = '';
	if( $turn_offup ){
		$css_titlle .= 'text-transform: none;';
	}

	if( $title_color ){
		$css_titlle .= 'color: ' . esc_attr( $title_color ) . ';';
	}

	if( $title_pbottom || '0' === $title_pbottom ){
		$css_titlle .= 'padding-bottom: ' . esc_attr( $title_pbottom ) . 'px;';
	}

	if( $title_mbottom || '0' === $title_mbottom ){
		$css_titlle .= 'margin-bottom: ' . esc_attr( $title_mbottom ) . 'px;';
	}

	if( $title_fsize ) {
		$css_titlle .= 'font-size: ' . esc_attr( $title_fsize ) . 'px;';
	}

	if( $fonttitle ) {
		$css_titlle .= 'font-family: ' . esc_attr( $fonttitle ) . ';';
	}
	if( $fwtitle ) {
		$css_titlle .= 'font-weight: ' . esc_attr( $fwtitle ) . ';';
	}

	if( $css_titlle ){
		$css .= '.penci-page-header .penci-page-header-title {' . $css_titlle . '; }';
	}
	if( $hideline ){
		$css .= '.penci-page-header .penci-page-header-title:before{ content: none; }';
	}

	if( $bread_fsize ){
		$css .= '.penci-page-header .penci_breadcrumbs{ font-size: ' . esc_attr( $bread_fsize ) . 'px; }';
	}if( $bread_color ){
		$css .= '.penci-page-header .penci_breadcrumbs{ color:' . esc_attr( $bread_color ) . '; }';
	}if( $bread_hcolor ){
		$css .= '.penci-page-header .penci_breadcrumbs a:hover{ color:' . esc_attr( $bread_hcolor ) . '; }';
	}

	

	return $css;
}