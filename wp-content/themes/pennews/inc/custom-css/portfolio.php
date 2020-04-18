<?php
if ( function_exists( 'penci_customizer_portfolio' ) ){
	return;
}
function penci_customizer_portfolio() {

	$css = '';

	if ( ! class_exists( 'Penci_Portfolio' ) ) {
		return '';
	}

	$portfolio_id = get_the_ID();
	if ( ! empty( $portfolio_id ) ) {
		$use_option_current  = get_post_meta( $portfolio_id, 'penci_pfl_use_opt_current_page', true );
		$size_pfl_title_pre = get_post_meta( $portfolio_id, 'penci_pfl_size_post_title', true );
		if ( ! empty( $use_option_current ) && $size_pfl_title_pre ) {
			$css .= sprintf( '.postid-%s .penci-entry-title{ font-size:%spx; }', esc_attr( $portfolio_id ), esc_attr( $size_pfl_title_pre ) );
		}
	}

	$title_color     = penci_get_theme_mod( 'penci_portfolio_title_color' );
	$title_hcolor    = penci_get_theme_mod( 'penci_portfolio_title_hcolor' );
	$cate_color      = penci_get_theme_mod( 'penci_portfolio_cate_color' );
	$cate_hcolor     = penci_get_theme_mod( 'penci_portfolio_cate_hcolor' );
	$overlay_color   = penci_get_theme_mod( 'penci_portfolio_overlay_color' );
	$overlay_opacity = penci_get_theme_mod( 'penci_portfolio_overlay_opacity' );
	$space_item      = penci_get_theme_mod( 'penci_pfl_spacing_item' );

	if ( $space_item || '0' == $space_item ) {

		$space_item_pre = $space_item_wrap = 0;
		if ( 0 != $space_item ) {
			$space_item_pre  = intval( $space_item / 2 );
			$space_item_wrap = - $space_item_pre;
		}

		$css .= '.penci-portfolio-wrap{ margin-left: ' . $space_item_wrap . 'px; margin-right: ' . $space_item_wrap . 'px; }';
		$css .= '.penci-portfolio-wrap .portfolio-item{ padding-left: ' . $space_item_pre . 'px; padding-right: ' . $space_item_pre . 'px; margin-bottom:' . intval( $space_item ) . 'px; }';
	}

	if($title_color ) {
		$css .= sprintf( '.inner-item-portfolio .portfolio-desc h3, .penci-portfolio-below_img .inner-item-portfolio .portfolio-desc h3{ color:%s; }', esc_attr( $title_color ) );
	}

	if( $title_hcolor ) {
		$css .= sprintf( '.inner-item-portfolio .portfolio-desc h3:hover,
		 .penci-portfolio-below_img .inner-item-portfolio .portfolio-desc h3:hover{ color:%s; }', esc_attr( $title_hcolor ) );
	}

	if( $cate_color ) {
		$css .= sprintf( '.inner-item-portfolio .portfolio-desc span{ color:%s; }', esc_attr( $cate_color ) );
	}

	if( $cate_hcolor ) {
		$css .= sprintf( '.inner-item-portfolio .portfolio-desc span:hover{ color:%s; }', esc_attr( $cate_hcolor ) );
	}

	if( $overlay_color ) {
		$css .= sprintf( '.penci-portfolio-thumbnail a:after{ background-color:%s; }', esc_attr( $overlay_color ) );
	}

	if( $overlay_opacity ) {
		$css .= sprintf( '.inner-item-portfolio:hover .penci-portfolio-thumbnail a:after,.penci-portfolio-below_img .inner-item-portfolio:hover .penci-portfolio-thumbnail a:after{ opacity:%s; }',
			esc_attr( $overlay_opacity ) );
	}

	// Button load more
	$loadmore_color    = penci_get_theme_mod( 'penci_pft_loadmore_color' );
	$loadmore_bcolor   = penci_get_theme_mod( 'penci_pft_loadmore_bcolor' );
	$loadmore_bgcolor  = penci_get_theme_mod( 'penci_pft_loadmore_bgcolor' );
	$loadmore_hcolor   = penci_get_theme_mod( 'penci_pft_loadmore_hcolor' );
	$loadmore_hbcolor  = penci_get_theme_mod( 'penci_pft_loadmore_hbcolor' );
	$loadmore_hbgcolor = penci_get_theme_mod( 'penci_pft_loadmore_hbgcolor' );
	$loadmore_border_size = penci_get_theme_mod( 'penci_pft_loadmore_bordsize' );
	$loadmore_animation_color = penci_get_theme_mod( 'penci_pft_loadmore_animation_color' );
	$readmore_margin_top = penci_get_theme_mod( 'penci_pfl_readmore_margin_top' );

	if ( $loadmore_animation_color ) {
		$css .= '.penci-portfolio-more-button.penci-plf-loading-2 .penci-portfolio-ajaxdot{ background-color: ' . $loadmore_animation_color . '; }';
	}

	$loadmore_css = '';
	if ( $loadmore_color ) {
		$loadmore_css .= 'color:' . $loadmore_color . ';';
	}
	if ( $loadmore_bcolor ) {
		$loadmore_css .= 'border-color:' . $loadmore_bcolor . ';';
	}
	if ( $loadmore_bgcolor ) {
		$loadmore_css .= 'background-color:' . $loadmore_bgcolor . ';';
	}
	if ( $loadmore_border_size || '0' === $loadmore_border_size ) {
		$loadmore_css .= 'border-width:' . $loadmore_border_size . 'px;';
	}
	if ( $readmore_margin_top ) {
		$loadmore_css .= 'margin-top:' . $readmore_margin_top . 'px;';
	}

	if ( $loadmore_css ) {
		$css .= '.penci-ajax-more a.penci-portfolio-more-button{ ' . $loadmore_css . ' }';
	}

	$loadmore_hover_css = '';
	if ( $loadmore_hcolor ) {
		$loadmore_hover_css .= 'color:' . $loadmore_hcolor . ';';
	}
	if ( $loadmore_hbcolor ) {
		$loadmore_hover_css .= 'border-color:' . $loadmore_hbcolor . ';';
	}
	if ( $loadmore_hbgcolor ) {
		$loadmore_hover_css .= 'background-color:' . $loadmore_hbgcolor . ';';
	}
	if ( $loadmore_hover_css ) {
		$css .= '.penci-ajax-more a.penci-portfolio-more-button:hover { ' . $loadmore_hover_css . ' }';
	}


	// Typo

	$item_title_size = penci_get_theme_mod( 'penci_portfolio_item_title_size' );
	$item_cat_size = penci_get_theme_mod( 'penci_portfolio_item_cat_size' );

	if( $item_title_size ) {
		$css .= sprintf( '.inner-item-portfolio .portfolio-desc h3{ font-size:%spx; }', esc_attr( $item_title_size ) );
	}
	if( $item_cat_size ) {
		$css .= sprintf( '.inner-item-portfolio .portfolio-desc span{ font-size:%spx; }', esc_attr( $item_cat_size ) );
	}

	$archive_w_container = penci_get_theme_mod( 'penci_pflarchive_w_container' );
	if ( is_post_type_archive( 'portfolio' ) && $archive_w_container ) {
		$archive_w_container = $archive_w_container + 30;
		$fix_container       = '.archive.post-type-archive-portfolio .site-main .penci-container{ max-width: 100%; }';
		$css                 .= sprintf( '@media screen and (min-width: %spx){ .archive.post-type-archive-portfolio  .site-main{ max-width:%spx;margin-left: auto; margin-right: auto; } %s }',
			esc_attr( $archive_w_container ), esc_attr( $archive_w_container ), $fix_container );
	}

	if ( is_singular() ) {
		$w_container = penci_get_theme_mod( 'penci_pflsingle_w_container' );

		if ( $w_container  ) {
			$w_container = $w_container + 30;
			$css .= sprintf( '@media screen and (min-width: %spx){ .single.single-portfolio .site-main > .penci-container{ max-width:%spx;margin-left: auto; margin-right: auto; } }',
				esc_attr( $w_container  ),esc_attr( $w_container  ) );

		}
	}

	return $css;
}