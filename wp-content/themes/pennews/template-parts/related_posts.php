<?php
/**
 * Related post template
 * Render list related posts
 */

if( penci_get_setting( 'penci_hide_single_related' ) ) {
	return;
}

$orig_post = $post;
global $post;
$numbers_related = penci_get_setting('penci_single_related_amount');

if ( !isset( $numbers_related ) || $numbers_related < 1 ): $numbers_related = 10; endif;

$order_by = penci_get_setting( 'penci_related_orderby' );

$post_id = isset( $post->ID ) ? $post->ID : '';
$post_type = get_post_type( get_the_ID() );

$args             = array();
if( 'post' == $post_type ){
	$penci_related_by = penci_get_setting( 'penci_related_by' );
	if ( 'categories' == $penci_related_by ) {
		$categories = get_the_category( $post_id );

		if ( $categories ) {
			$category_ids = array();
			foreach ( $categories as $individual_category ) {
				$category_ids[] = $individual_category->term_id;
			}

			$args = array(
				'category__in'        => $category_ids,
				'post__not_in'        => array( $post_id ),
				'posts_per_page'      => $numbers_related,
				'orderby'             => $order_by,
				'ignore_sticky_posts' => 1,
			);
		}
	} else {
		$tags = wp_get_post_tags( $post_id );
		if ( $tags ) {
			$tag_ids = array();
			foreach ( $tags as $individual_tag ) {
				$tag_ids[] = $individual_tag->term_id;
			}
			$args = array(
				'tag__in'             => $tag_ids,
				'post__not_in'        => array( $post_id ),
				'posts_per_page'      => $numbers_related,
				'orderby'             => $order_by,
				'ignore_sticky_posts' => 1,
			);
		}
	}
} else {
	$custom_related_by = penci_get_theme_mod( 'penci_custompost_related_by' );

	if ( ! $custom_related_by ) {
		$args = array(
			'post_type'           => $post_type,
			'post__not_in'        => array( $post_id ),
			'posts_per_page'      => $numbers_related,
			'orderby'             => $order_by,
			'ignore_sticky_posts' => 1,
		);
	}else {
		$custom_related_by     = preg_replace( '/\s+/', '', $custom_related_by );
		$custom_related_by_arr = array_filter( explode( '|', $custom_related_by . '|' ) );
		foreach ( $custom_related_by_arr as $crb_item ) {
			if ( false === strpos( $crb_item, $post_type ) ) {
				continue;
			}

			$crb_item_arr  = array_filter( explode( ',', $crb_item . ',' ) );
			$crb_post_type = isset( $crb_item_arr[0] ) ? $crb_item_arr[0] : '';
			$crb_tax       = isset( $crb_item_arr[1] ) ? $crb_item_arr[1] : '';

			if ( $post_type != $crb_post_type || empty( $crb_tax ) ) {
				continue;
			}

			$terms = get_the_terms( $post_id, $crb_tax );

			if ( $terms && ! is_wp_error( $terms ) ) {
				$taxonomy_ids = array();

				foreach ( $terms as $term ) {
					if ( isset( $term->term_id ) ) {
						$taxonomy_ids[] = $term->term_id;
					}
				}

				$args = array(
					'post_type'           => $post_type,
					'tax_query'           => array(
						array(
							'taxonomy' => $crb_tax,
							'field'    => 'term_id',
							'terms'    => $taxonomy_ids,
							'operator' => 'NOT IN',
						),
					),
					'post__not_in'        => array( $post_id ),
					'posts_per_page'      => $numbers_related,
					'orderby'             => $order_by,
					'ignore_sticky_posts' => 1,
				);
			}
		}
	}
}

$args = apply_filters( 'penci_args_support_polylang', $args );

$related_query = new wp_query( $args );

if ( ! $related_query->have_posts() ) {
	return;
}

$post_items = '';

while ( $related_query->have_posts() ) : 
	$related_query->the_post(); 
	$show_img_default = penci_get_setting( 'penci_show_img_default_related' );
	$post_thumb_url = penci_get_featured_image_size( get_the_ID(), penci_get_archive_image_type( 'penci-thumb-480-320' ) );

	$class_post = 'item-related';
	$class_post .= ' penci-imgtype-' . penci_get_setting( 'penci_archive_image_type' );
	$class_post .= ! has_post_thumbnail() && $show_img_default ? ' penci-no-thumb' : '';

	$post_items .= '<div  class="' . join( ' ', get_post_class( $class_post , get_the_ID() ) ) . '">';

	$post_items .= sprintf( '<a class="related-thumb penci-image-holder penci-image_has_icon%s" %s href="%s">%s</a>',
		penci_check_lazyload_type( 'class','', false ),
		penci_check_lazyload_type( 'src', $post_thumb_url, false ),
		get_the_permalink(),
		penci_icon_post_format( false,'small-size-icon' )
	);

	$post_items .= '<h4 class="entry-title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h4>';
	$post_items .= penci_get_schema_markup();
	$post_items .= '</div>';
endwhile;

$post = $orig_post;
wp_reset_postdata();

$markup_slider = '';
$related_title = penci_get_setting('penci_single_related_text');
if( penci_get_setting( 'penci_enable_slider_related' ) ) {

	$data_auto = penci_get_setting( 'penci_post_related_autoplay' );
	$data_auto = $data_auto ? 1 : 0;

	$data_dots = penci_get_setting( 'penci_post_related_dots' );
	$data_dots = $data_dots ? 0 : 1;

	$data_arrows = penci_get_setting( 'penci_post_related_arrows' );
	$data_arrows = $data_arrows ? 0 : 1;

	$data_loop = $related_query->post_count  > 3 ?  0 : 1;

	$reponsive = '{0:{ items:1, nav:true},600:{items:3, nav:false},1000:{items:3, nav:true, loop:false }}';

	$markup_slider = sprintf('<div class="penci-owl-carousel-slider penci-related-carousel owl-carousel owl-theme" data-items="3" data-autowidth="0" data-auto="%s" data-autotime="4000" data-speed="600" data-loop="%s" data-dots="%s" data-nav="%s" data-center="0" data-reponsive="%s">',
	esc_attr( $data_auto ),
	esc_attr( $data_loop ),
	esc_attr( $data_dots ),
	esc_attr( $data_arrows ),
	esc_attr( $reponsive )
	);
}

$output = '<div class="penci-post-related">';
$output .= '<div class="post-title-box"><h4 class="post-box-title">' . esc_attr( $related_title ) .'</h4></div>';
$output .= '<div class="post-related_content">';
$output .= $markup_slider;
$output .= $post_items;
$output .= penci_get_setting( 'penci_enable_slider_related' ) ? '</div>' : '';
$output .= '</div>';
$output .= '</div>';

echo ( $output );
