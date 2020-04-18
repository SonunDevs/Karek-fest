<?php
if ( function_exists( 'penci_customizer_archive' ) ) {
	return;
}
function penci_customizer_archive() {
	$css = '';
	$w_container   = penci_get_theme_mod( 'penci_arch_w_container' );

	if( ! is_single() ) {
		$archive_w2col = penci_get_theme_mod( 'penci_archive_width_2col' );
		$archive_w3col = penci_get_theme_mod( 'penci_archive_width_3col' );
		$archive_sidebar_layout = penci_get_setting( 'penci_archive_sidebar_layout' );

		$archive_w3col_arr   = Penci_Resizable_Width::parseData( $archive_w3col );
		$archive_w3col_total = isset( $archive_w3col_arr['total'] ) ? $archive_w3col_arr['total'] : '';
		$archive_w3col_main  = isset( $archive_w3col_arr['main'] ) ? $archive_w3col_arr['main'] : '';
		$archive_w3col_sbar1 = isset( $archive_w3col_arr['sidebar1'] ) ? $archive_w3col_arr['sidebar1'] : '';
		$archive_w3col_sbar2 = isset( $archive_w3col_arr['sidebar2'] ) ? $archive_w3col_arr['sidebar2'] : '';


		if ( $archive_w3col_main && $archive_w3col_sbar1 && $archive_w3col_sbar2 ) {
			$css .= '@media screen and (min-width: 1240px){';
			$css .= '.two-sidebar .site-main .penci-container .widget-area-1, .penci-vc_two-sidebar.penci-container .widget-area-1,.penci-vc_two-sidebar.penci-container-fluid .widget-area-1{width: ' . $archive_w3col_sbar2 . '%; }';
			$css .= '.two-sidebar .site-main .penci-container .widget-area-2, .penci-vc_two-sidebar.penci-container .widget-area-2,.penci-vc_two-sidebar.penci-container-fluid .widget-area-2{width: ' . $archive_w3col_sbar1 . '%; }';
			$css .= '.two-sidebar .site-main .penci-container .penci-wide-content, .penci-vc_two-sidebar.penci-container .penci-wide-content,';
			$css .= '.penci-vc_two-sidebar.penci-container-fluid .penci-wide-content{ max-width: 100%; width: ' . $archive_w3col_main . '%; }';
			$css .= '}';
		}

		$archive_w2col_arr   = Penci_Resizable_Width::parseData( $archive_w2col );
		$archive_w2col_total = isset( $archive_w2col_arr['total'] ) ? $archive_w2col_arr['total'] : '';
		$archive_w2col_main  = isset( $archive_w2col_arr['main'] ) ? $archive_w2col_arr['main'] : '';
		$archive_w2col_sbar1 = isset( $archive_w2col_arr['sidebar1'] ) ? $archive_w2col_arr['sidebar1'] : '';

		if ( $archive_w2col_main && $archive_w2col_sbar1 ) {
			$css .= '@media screen and (min-width: 960px){';

			$css .= '.sidebar-left .site-main .penci-wide-content,';
			$css .= '.sidebar-right .site-main .penci-wide-content{';
			$css .= 'width: ' . $archive_w2col_main . '%;max-width: 100%;}';
			$css .= '.sidebar-left .site-main .widget-area,';
			$css .= '.sidebar-right .site-main .widget-area{';
			$css .= 'width: ' . $archive_w2col_sbar1 . '%;max-width: 100%;}';

			$css .= '.penci-con_innner-sidebar-left .penci-content-main,.penci-vc_sidebar-right .penci-con_innner-sidebar-left .penci-content-main { width: ' . $archive_w2col_main . '%;max-width: 100%; }';
			$css .= '}';

			$css .= '@media screen and (min-width: 1240px){ ';
			$css .= '.penci-vc_sidebar-left .penci-container__content .penci-content-main, .penci-vc_sidebar-right .penci-container__content .penci-content-main{ flex:inherit ; }';
			$css .= '.penci-vc_sidebar-left .widget-area, .penci-vc_sidebar-right .widget-area { width: ' . $archive_w2col_sbar1 . '%;max-width: 100%; }';
			$css .= '.penci-vc_sidebar-left .penci-content-main, .penci-vc_sidebar-right .penci-content-main{ width: ' . $archive_w2col_main . '%;max-width: 100%; }';
			$css .= '}';

			$css .= '@media screen and (max-width: 1240px) and (min-width: 960px){';

			$css .= '.penci-vc_two-sidebar .widget-area{ width: ' . $archive_w2col_sbar1 . '%;max-width: 100%; }';
			$css .= '.sidebar-left .site-main .penci-container__content, .sidebar-right .site-main .penci-container__content,';
			$css .= '.two-sidebar .site-main .penci-wide-content, .penci-vc_two-sidebar .penci-wide-content { margin-left:0; width: ' . $archive_w2col_main . '%;}';
			$css .= '}';

			$css .= '@media screen and (min-width: 1440px) {.penci-con_innner-sidebar-left .widget-area, .penci-con_innner-sidebar-right .widget-area { width: ' . $archive_w2col_sbar1 . '% !important; } }';
		}

		if ( $archive_w3col_total && 'two-sidebar' == $archive_sidebar_layout ) {
			$w_container = $archive_w3col_total;
		} elseif ( $archive_w2col_total ) {
			$w_container = $archive_w2col_total;
		}

		$archive_columns_gap = get_theme_mod( 'penci_archive_columns_gap' );
		if ( $archive_columns_gap ) {

			$css .= '@media screen and (min-width: 960px){';
			$css .= '.penci-con_innner-sidebar-left .penci-content-main, .penci-vc_sidebar-right .penci-con_innner-sidebar-left .penci-content-main, .penci-vc_sidebar-left .penci-content-main,';
			$css .= '.sidebar-left .site-main .penci-wide-content {padding-left: ' . esc_attr( $archive_columns_gap ) . 'px;}';
			$css .= '.sidebar-right .site-main .penci-wide-content, .two-sidebar .site-main .penci-wide-content {padding-right: ' . esc_attr( $archive_columns_gap ) . 'px;}';
			$css .= '}';

			$css .= '@media screen and (min-width: 1240px){';
			$css .= '.penci-vc_sidebar-right .penci-content-main{padding-right: ' . esc_attr( $archive_columns_gap ) . 'px;}';
			$css .= '.penci-vc_sidebar-left .penci-content-main{padding-left: ' . esc_attr( $archive_columns_gap ) . 'px;}';
			$css .= '.two-sidebar .site-main .penci-container .penci-wide-content, .penci-vc_two-sidebar.penci-container .penci-wide-content, .penci-vc_two-sidebar.penci-container-fluid .penci-wide-content';
			$css .= '{ padding-left: ' . esc_attr( $archive_columns_gap ) . 'px; padding-right: ' . esc_attr( $archive_columns_gap ) . 'px;}';
			$css .= '}';
		}
	}

	$w_container = penci_convert_to_custom_option_tax( 'penci__w_container', $w_container );

	if ( $w_container  ) {
		$w_container = $w_container + 30;
		$fix_container = '.archive .site-main .penci-container, body.blog .site-main .penci-container{ max-width: 100%; }';
		$css .= sprintf( '@media screen and (min-width: %spx){ .archive  .site-main, body.blog  .site-main{ max-width:%spx;margin-left: auto; margin-right: auto; } %s }',
			esc_attr( $w_container  ),esc_attr( $w_container  ), $fix_container );
	}

	if ( is_archive() || is_home() ) {
		$size_post_title      = penci_get_theme_mod( 'penci_archive_size_post_title' );
		$fweight_post_title   = penci_get_theme_mod( 'penci_arch_fweight_item_ptitle' );
		$size_item_post_title = penci_get_theme_mod( 'penci_archive_size_item_post_title' );
		$size_item_post_meta  = penci_get_theme_mod( 'penci_archive_size_item_post_meta' );
		$size_item_post_desc  = penci_get_theme_mod( 'penci_archive_size_item_post_desc' );

		if ( $size_post_title ) {
			$css .= sprintf( '.penci-archive__content .penci-page-title{ font-size:%spx; }', esc_attr( $size_post_title ) );
		}

		if ( $size_item_post_title ) {
			$css .= sprintf( '.penci-archive .penci-archive__content .penci-post-item .entry-title{ font-size:%spx; }', esc_attr( $size_item_post_title ) );
		}

		if ( $fweight_post_title ) {
			$css .= sprintf( '.penci-archive .penci-archive__content .penci-post-item .entry-title{ font-weight:%s; }', esc_attr( $fweight_post_title ) );
		}

		if ( $size_item_post_meta ) {
			$css .= sprintf( '.penci-archive__list_posts .penci-post-item .entry-meta{ font-size:%spx; }', esc_attr( $size_item_post_meta ) );
		}
		if ( $size_item_post_desc ) {
			$css .= sprintf( '.penci-archive__list_posts .penci-post-item .entry-content{ font-size:%spx; }', esc_attr( $size_item_post_desc ) );
		}

		// Color
		$archive_title_color               = penci_get_theme_mod( 'penci_archive_title_color' );
		$archive_title_border_bottom_color = penci_get_theme_mod( 'penci_archive_title_border_bottom_color' );
		$archive_breadcrumbs_color         = penci_get_theme_mod( 'penci_archive_breadcrumbs_color' );
		$archive_post_title_color          = penci_get_theme_mod( 'penci_archive_list_post_title_color' );
		$archive_post_meta_color           = penci_get_theme_mod( 'penci_archive_list_post_meta_color' );
		$archive_post_des_color            = penci_get_theme_mod( 'penci_archive_list_post_des_color' );

		$archive_post_cat_color    = penci_get_theme_mod( 'penci_archive_list_post_cat_color' );
		$archive_post_cat_bgcolor  = penci_get_theme_mod( 'penci_archive_list_post_cat_bgcolor' );
		$archive_post_cat_hcolor   = penci_get_theme_mod( 'penci_archive_list_post_cat_hcolor' );
		$archive_post_cat_hbgcolor = penci_get_theme_mod( 'penci_archive_list_post_cat_hbgcolor' );

		if ( $archive_title_color ) {
			$css .= sprintf( '.penci-archive__content  .penci-page-title { color: %s; }',
				esc_attr( $archive_title_color ) );
		}
		if ( $archive_title_border_bottom_color ) {
			$css .= sprintf( '.site-main .penci-archive__content .penci-entry-header{ border-color: %s; }',
				esc_attr( $archive_title_border_bottom_color ) );
		}
		if ( $archive_breadcrumbs_color ) {
			$css .= sprintf( '.penci-archive__content  .penci_breadcrumbs a,.penci-archive__content .penci_breadcrumbs span{ color: %s; }',
				esc_attr( $archive_breadcrumbs_color ) );
		}
		if ( $archive_post_title_color ) {
			$css .= sprintf( '.penci-archive__list_posts .penci-post-item .entry-title, .penci-archive__list_posts .penci-post-item .entry-title a{ color: %s; }',
				esc_attr( $archive_post_title_color ) );
		}
		if ( $archive_post_meta_color ) {
			$css .= sprintf( '.penci-archive__list_posts  .penci-archive .entry-meta,
			 .penci-archive .penci-archive__list_posts .entry-meta a,
			 .penci-archive .penci-archive__content .entry-meta span:not(.penci-chart-text),
			 .penci-archive .penci-archive__list_posts .entry-meta span{ color: %s; }',
				esc_attr( $archive_post_meta_color ) );

		}
		if ( $archive_post_des_color ) {
			$css .= sprintf( '.penci-archive__list_posts .penci-post-item .entry-content{ color: %s; }',
				esc_attr( $archive_post_des_color ) );
		}

		if ( $archive_post_cat_color ) {
			$css .= sprintf( '.penci-archive .penci-archive__list_posts .penci-cat-links a{ color: %s; }',
				esc_attr( $archive_post_cat_color ) );
		}
		if ( $archive_post_cat_bgcolor ) {
			$css .= sprintf( '.penci-archive .penci-archive__list_posts .penci-cat-links a{ background-color: %s; }',
				esc_attr( $archive_post_cat_bgcolor ) );
		}

		if ( $archive_post_cat_hcolor ) {
			$css .= sprintf( '.penci-archive .penci-archive__list_posts .penci-cat-links a:hover{ color: %s; }',
				esc_attr( $archive_post_cat_hcolor ) );
		}
		if ( $archive_post_cat_hbgcolor ) {
			$css .= sprintf( '.penci-archive .penci-archive__list_posts .penci-cat-links a:hover{ background-color: %s; }',
				esc_attr( $archive_post_cat_hbgcolor ) );
		}
	}

	$block_pag_size_item_post_title    = penci_get_theme_mod( 'penci_block_pag_size_item_post_title' );
	$block_pag_fweight_item_post_title = penci_get_theme_mod( 'penci_block_pag_fweight_item_ptitle' );
	$block_pag_size_item_post_meta     = penci_get_theme_mod( 'penci_block_pag_size_item_post_meta' );
	$block_pag_size_item_post_desc     = penci_get_theme_mod( 'penci_block_pag_size_item_post_desc' );

	if ( $block_pag_size_item_post_title ) {
		$css .= sprintf( '.penci-block-vc-pag  .penci-archive__list_posts .penci-post-item .entry-title{ font-size:%spx; }',
			esc_attr( $block_pag_size_item_post_title ) );
	}

	if ( $block_pag_fweight_item_post_title ) {
		$css .= sprintf( '.penci-block-vc-pag  .penci-archive__list_posts .penci-post-item .entry-title{ font-weight:%s; }',
			esc_attr( $block_pag_fweight_item_post_title ) );
	}
	if ( $block_pag_size_item_post_meta ) {
		$css .= sprintf( '.penci-block-vc-pag .penci-archive__list_posts .penci-post-item .entry-meta{ font-size:%spx; }',
			esc_attr( $block_pag_size_item_post_meta ) );
	}
	if ( $block_pag_size_item_post_desc ) {
		$css .= sprintf( '.penci-block-vc-pag .penci-archive__list_posts .penci-post-item .entry-content{ font-size:%spx; }',
			esc_attr( $block_pag_size_item_post_desc ) );
	}


	// Color
	$block_pag_breadcrumbs_color  = penci_get_theme_mod( 'penci_block_pag_breadcrumbs_color' );
	$block_pag_post_title_color   = penci_get_theme_mod( 'penci_block_pag_list_post_title_color' );
	$block_pag_post_meta_color    = penci_get_theme_mod( 'penci_block_pag_list_post_meta_color' );
	$block_pag_post_des_color     = penci_get_theme_mod( 'penci_block_pag_list_post_des_color' );
	$block_pag_post_cat_color     = penci_get_theme_mod( 'penci_block_pag_list_post_cat_color' );
	$block_pag_post_cat_bgcolor   = penci_get_theme_mod( 'penci_block_pag_list_post_cat_bgcolor' );
	$block_pag_post_cat_hcolor    = penci_get_theme_mod( 'penci_block_pag_list_post_cat_hcolor' );
	$block_pag_post_cat_hbgcolor  = penci_get_theme_mod( 'penci_block_pag_list_post_cat_hbgcolor' );

	if ( $block_pag_breadcrumbs_color ) {
		$css .= sprintf( '.penci-block-pagination .penci_breadcrumbs i, .penci-block-pagination .penci_breadcrumbs a,.penci-block-pagination .penci_breadcrumbs span { color: %s; }', esc_attr( $block_pag_breadcrumbs_color ) );
	}

	if ( $block_pag_post_title_color ) {
		$css .= sprintf( '.penci-block-vc-pag .penci-archive__list_posts .penci-post-item .entry-title,.penci-block-vc-pag .penci-archive__list_posts .penci-post-item .entry-title a{ color: %s; }', esc_attr( $block_pag_post_title_color ) );
	}

	if ( $block_pag_post_meta_color ) {
		$css .= sprintf( '.penci-block-vc-pag .penci-archive__list_posts .penci-post-item .entry-meta,
		 .penci-block-vc-pag .penci-archive .penci-archive__list_posts .entry-meta a,
		 .penci-block-vc-pag .penci-archive .penci-archive__list_posts .entry-meta span{ color: %s; }', esc_attr( $block_pag_post_meta_color ) );
	}
	if ( $block_pag_post_des_color ) {
		$css .= sprintf( '.penci-block-vc-pag .penci-archive__list_posts .penci-post-item .entry-content{ color: %s; }', esc_attr( $block_pag_post_des_color ) );
	}

	if ( $block_pag_post_cat_color ) {
		$css .= sprintf( '.penci-block-vc-pag .penci-archive__list_posts .penci-cat-links a{ color: %s; }', esc_attr( $block_pag_post_cat_color ) );
	}
	if ( $block_pag_post_cat_bgcolor ) {
		$css .= sprintf( '.penci-block-vc-pag .penci-archive__list_posts .penci-cat-links a{ background-color: %s; }', esc_attr( $block_pag_post_cat_bgcolor ) );
	}

	if ( $block_pag_post_cat_hcolor ) {
		$css .= sprintf( '.penci-block-vc-pag .penci-archive__list_posts .penci-cat-links a:hover{ color: %s; }', esc_attr( $block_pag_post_cat_hcolor ) );
	}
	if ( $block_pag_post_cat_hbgcolor ) {
		$css .= sprintf( '.penci-block-vc-pag .penci-archive__list_posts .penci-cat-links a:hover{ background-color: %s; }', esc_attr( $block_pag_post_cat_hbgcolor ) );
	}

	// Button read more
	$css_read_button = $css_read_button_hover = '';
	$penci_arch_rmore_font = penci_get_theme_mod( 'penci_arch_rmore_font' );
	if ( penci_get_theme_mod( 'penci_arch_rmore_font' ) ) {
		$css_read_button .= 'font-family:' . penci_google_fonts_parse_attributes( $penci_arch_rmore_font ) . ';';
	}
	if ( penci_get_theme_mod( 'penci_arch_rmore_fweight' ) ) {
		$css_read_button .= 'font-weight:' . penci_get_theme_mod( 'penci_arch_rmore_fweight' ) . ';';
	}
	if ( penci_get_theme_mod( 'penci_arch_rmore_fsize' ) ) {
		$css_read_button .= 'font-size:' . penci_get_theme_mod( 'penci_arch_rmore_fsize' ) . 'px; ';
	}

	if ( penci_get_theme_mod( 'penci_penci_arch_rmore_color' ) ) {
		$css_read_button .= 'color:' . penci_get_theme_mod( 'penci_penci_arch_rmore_color' ) . ';';
	}
	if ( penci_get_theme_mod( 'penci_penci_arch_rmore_bgcolor' ) ) {
		$css_read_button .= 'background-color:' . penci_get_theme_mod( 'penci_penci_arch_rmore_bgcolor' ) . ';';
	}
	if ( penci_get_theme_mod( 'penci_penci_arch_rmore_hcolor' ) ) {
		$css_read_button_hover .= 'color:' . penci_get_theme_mod( 'penci_penci_arch_rmore_hcolor' ) . ';';
	}
	if ( penci_get_theme_mod( 'penci_penci_arch_rmore_hbgcolor' ) ) {
		$css_read_button_hover .= 'background-color:' . penci_get_theme_mod( 'penci_penci_arch_rmore_hbgcolor' ) . ';';
	}

	if ( $css_read_button ) {
		$css .= '.penci-pmore-link .more-link{ ' . ( $css_read_button ) . ' }';
	}
	if ( $css_read_button_hover ) {
		$css .= '.penci-pmore-link .more-link:hover{ ' . esc_attr( $css_read_button_hover ) . ' }';
	}


	// Button read more on block pag number
	$css_read_button2 = $css_read_button_hover2 = '';
	$block_pag_rmore_font = penci_get_theme_mod( 'penci_block_pag_rmore_font' );
	if ( $block_pag_rmore_font ) {
		$css_read_button2 .= 'font-family:' . penci_google_fonts_parse_attributes( $block_pag_rmore_font ) . ';';
	}
	if ( penci_get_theme_mod( 'penci_block_pag_rmore_fweight' ) ) {
		$css_read_button2 .= 'font-weight:' . penci_get_theme_mod( 'penci_block_pag_rmore_fweight' ) . ';';
	}
	if ( penci_get_theme_mod( 'penci_block_pag_rmore_fsize' ) ) {
		$css_read_button2 .= 'font-size:' . penci_get_theme_mod( 'penci_block_pag_rmore_fsize' ) . 'px; ';
	}

	if ( penci_get_theme_mod( 'penci_block_pag_rmore_color' ) ) {
		$css_read_button2 .= 'color:' . penci_get_theme_mod( 'penci_block_pag_rmore_color' ) . ';';
	}
	if ( penci_get_theme_mod( 'penci_block_pag_rmore_bgcolor' ) ) {
		$css_read_button2 .= 'background-color:' . penci_get_theme_mod( 'penci_block_pag_rmore_bgcolor' ) . ';';
	}
	if ( penci_get_theme_mod( 'penci_block_pag_rmore_hcolor' ) ) {
		$css_read_button_hover2 .= 'color:' . penci_get_theme_mod( 'penci_block_pag_rmore_hcolor' ) . ';';
	}
	if ( penci_get_theme_mod( 'penci_block_pag_rmore_hbgcolor' ) ) {
		$css_read_button_hover2 .= 'background-color:' . penci_get_theme_mod( 'penci_block_pag_rmore_hbgcolor' ) . ';';
	}

	if ( $css_read_button2 ) {
		$css .= '.penci-block-vc-pag .penci-pmore-link .more-link{ ' . ( $css_read_button2 ) . ' }';
	}
	if ( $css_read_button_hover2 ) {
		$css .= '.penci-block-vc-pag .penci-pmore-link .more-link:hover{ ' . esc_attr( $css_read_button_hover2 ) . ' }';
	}


	return $css;
}

