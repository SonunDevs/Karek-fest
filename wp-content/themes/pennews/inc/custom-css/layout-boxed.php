<?php
if ( function_exists( 'penci_customizer_layout_boxed' ) ) {
	return;
}
function penci_customizer_layout_boxed() {
	$css = '';

	if ( is_page_template( 'page-templates/layout-boxed.php' ) ) {
		$page_id = get_the_ID();

		$boxed_body_bgimg      = get_post_meta( $page_id, 'boxed_body_bgimg', true );
		$boxed_body_bgcolor    = get_post_meta( $page_id, 'boxed_body_bgcolor', true );
		$boxed_body_repeat     = get_post_meta( $page_id, 'boxed_body_repeat', true );
		$boxed_body_attachment = get_post_meta( $page_id, 'boxed_body_attachment', true );
		$boxed_body_size       = get_post_meta( $page_id, 'boxed_body_size', true );

		$boxed_width                = get_post_meta( $page_id, 'boxed_width', true );
		$boxed_custom_width         = get_post_meta( $page_id, 'boxed_custom_width', true );
		$boxed_container_bgimg      = get_post_meta( $page_id, 'boxed_container_bgimg', true );
		$boxed_container_bgcolor    = get_post_meta( $page_id, 'boxed_container_bgcolor', true );
		$boxed_container_repeat     = get_post_meta( $page_id, 'boxed_container_repeat', true );
		$boxed_container_attachment = get_post_meta( $page_id, 'boxed_container_attachment', true );
		$boxed_container_size       = get_post_meta( $page_id, 'boxed_container_size', true );

		$css_body = '';
		if ( $boxed_body_bgimg ) {
			$css_body .= '  background-image: url(' . wp_get_attachment_url( $boxed_body_bgimg ) . ');';
		}

		if ( $boxed_body_bgcolor ) {
			$css_body .= 'background-color:' . $boxed_body_bgcolor . ';';
		}
		if ( $boxed_body_repeat ) {
			$css_body .= 'background-repeat:' . $boxed_body_repeat . ';';
		}
		if ( $boxed_body_attachment ) {
			$css_body .= 'background-attachment:' . $boxed_body_attachment . ';';
		}

		if ( $boxed_body_size ) {
			$css_body .= 'background-size:' . $boxed_body_size . ';';
		}

		if ( $css_body ) {
			$css .= 'body.page-id-' . $page_id . '.page-template-layout-boxed{' . $css_body . '}';
		}

		$css_container = '';
		$site_header   = '';
		if ( '1170' == $boxed_width ) {
			$site_header = $css_container .= ' max-width:1170px;';
		} elseif ( '1080' == $boxed_width ) {
			$site_header = $css_container .= ' max-width:1080px;';
		}
		if ( 'custom' == $boxed_width && $boxed_custom_width ) {
			$site_header = $css_container .= ' max-width:' . $boxed_custom_width . 'px;';
		}

		if ( $boxed_container_bgimg ) {
			$css_container .= '  background-image: url(' . wp_get_attachment_url( $boxed_container_bgimg ) . ');';
		}

		if ( $boxed_container_bgcolor ) {
			$css_container .= 'background-color:' . $boxed_container_bgcolor . ';';
		}
		if ( $boxed_container_repeat ) {
			$css_container .= 'background-repeat:' . $boxed_container_repeat . ';';
		}
		if ( $boxed_container_attachment ) {
			$css_container .= 'background-attachment:' . $boxed_container_attachment . ';';
		}

		if ( $boxed_container_size ) {
			$css_container .= 'background-size:' . $boxed_container_size . ';';
		}

		if ( $css_container ) {
			$css .= 'body.page-id-' . $page_id . '.page-template-layout-boxed .penci-enable-boxed{' . $css_container . '}';
		}

		if ( $site_header ) {
			$css .= '.page-template-layout-boxed .penci-enable-boxed .site-header{' . $site_header . '}';
		}
	}elseif( ! is_page_template( 'page-templates/full-width.php' ) ) {
		$boxed_body_bgimg      = penci_get_theme_mod( 'penci_boxed_body_bgimg' );
		$boxed_body_bgcolor    = penci_get_theme_mod( 'penci_boxed_body_bgcolor' );
		$boxed_body_repeat     = penci_get_theme_mod( 'penci_boxed_body_repeat' );
		$boxed_body_attachment = penci_get_theme_mod( 'penci_boxed_body_attachment' );
		$boxed_body_size       = penci_get_theme_mod( 'penci_boxed_body_size' );

		$boxed_width                = penci_get_theme_mod( 'penci_layout_boxed_width' );
		$boxed_container_bgimg      = penci_get_theme_mod( 'penci_boxed_container_bgimg' );
		$boxed_container_bgcolor    = penci_get_theme_mod( 'penci_boxed_container_bgcolor' );
		$boxed_container_repeat     = penci_get_theme_mod( 'penci_boxed_container_repeat' );
		$boxed_container_attachment = penci_get_theme_mod( 'penci_boxed_container_attachment' );
		$boxed_container_size       = penci_get_theme_mod( 'penci_boxed_container_size' );

		$css_body = '';
		if ( $boxed_body_bgimg ) {
			$css_body .= '  background-image: url(' . $boxed_body_bgimg . ');';
		}

		if ( $boxed_body_bgcolor ) {
			$css_body .= 'background-color:' . $boxed_body_bgcolor . ';';
		}
		if ( $boxed_body_repeat ) {
			$css_body .= 'background-repeat:' . $boxed_body_repeat . ';';
		}
		if ( $boxed_body_attachment ) {
			$css_body .= 'background-attachment:' . $boxed_body_attachment . ';';
		}

		if ( $boxed_body_size ) {
			$css_body .= 'background-size:' . $boxed_body_size . ';';
		}

		if ( $css_body ) {
			$css .= 'body.penci-body-boxed, body.custom-background.penci-body-boxed {' . $css_body . '}';
		}

		$css_container = $site_header   = '';

		if ( $boxed_width ) {
			$site_header = $css_container .= ' max-width:' . $boxed_width . 'px;';
		}

		if ( $boxed_container_bgimg ) {
			$css_container .= '  background-image: url(' . $boxed_container_bgimg . ');';
		}

		if ( $boxed_container_bgcolor ) {
			$css_container .= 'background-color:' . $boxed_container_bgcolor . ';';
		}
		if ( $boxed_container_repeat ) {
			$css_container .= 'background-repeat:' . $boxed_container_repeat . ';';
		}
		if ( $boxed_container_attachment ) {
			$css_container .= 'background-attachment:' . $boxed_container_attachment . ';';
		}

		if ( $boxed_container_size ) {
			$css_container .= 'background-size:' . $boxed_container_size . ';';
		}

		if ( $css_container ) {
			$css .= 'body.penci-body-boxed .penci-enable-boxed{' . $css_container . '}';
		}

		if ( $site_header ) {
			$css .= 'body.penci-body-boxed .penci-enable-boxed .site-header{' . $site_header . '}';
		}
	}

	return $css;
}