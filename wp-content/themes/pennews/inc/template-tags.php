<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package PenNews
 */

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function penci_posted_on() {

	if(  ! penci_get_setting( 'penci_hide_single_author' ) ) {
		$byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

		echo '<span class="entry-meta-item penci-byline">' . penci_get_tran_setting( 'penci_translation_text_by' ). ' ' . $byline . '</span>';
	}


	if( ! penci_get_setting( 'penci_hide_single_date' ) ) {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$show_updated = penci_get_theme_mod( 'penci_show_date_updated' );

		$time_string = sprintf( $time_string,
			! $show_updated ? esc_attr( get_the_date( 'c' ) ) : esc_attr( get_the_modified_date( 'c' ) ),
			! $show_updated ? esc_html( get_the_date() ) : esc_html( get_the_modified_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		echo '<span class="entry-meta-item penci-posted-on"><i class="fa fa-clock-o"></i>' . $time_string . '</span>'; // WPCS: XSS OK.
	}

	if( ! penci_get_setting( 'penci_hide_single_comment_count' ) ) {
		penci_get_comment_count();
	}

	if( ! penci_get_setting( 'penci_hide_single_view' ) ) {
		echo '<span class="entry-meta-item penci-post-countview">';
		penci_get_post_countview( get_the_ID(), true );
		echo '</span>';
	}
}

function penci_posted_on_archive( $page = '' ) {

	$hide_post_author  = penci_get_setting( 'archive_hide_post_author' );
	$hide_date         = penci_get_setting( 'archive_hide_date' );
	$hide_post_comment = penci_get_setting( 'archive_hide_post_comment' );
	$hide_view         = penci_get_setting( 'archive_hide_view' );

	if ( 'block_pagination' == $page ) {
		$hide_post_author  = penci_get_setting( 'penci_block_pag_hide_post_author' );
		$hide_date         = penci_get_setting( 'penci_block_pag_hide_date' );
		$hide_post_comment = penci_get_setting( 'penci_block_pag_hide_post_comment' );
		$hide_view         = penci_get_setting( 'penci_block_pag_hide_view' );
	}

	if(  ! $hide_post_author ) {
		$byline = sprintf(
			esc_html_x( '%s', 'post author', 'pennews' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="entry-meta-item penci-byline">' . penci_get_tran_setting( 'penci_translation_text_by' ). ' ' . $byline . '</span>';
	}


	if( ! $hide_date ) {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$show_updated = penci_get_theme_mod( 'penci_show_date_updated' );

		$time_string = sprintf( $time_string,
			! $show_updated ? esc_attr( get_the_date( 'c' ) ) : esc_attr( get_the_modified_date( 'c' ) ),
			! $show_updated ? esc_html( get_the_date() ) : esc_html( get_the_modified_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			esc_html_x( '%s', 'post date', 'pennews' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="entry-meta-item penci-posted-on"><i class="fa fa-clock-o"></i>' . $posted_on . '</span>'; // WPCS: XSS OK.
	}

	if( ! $hide_post_comment ) {
		penci_get_comment_count();
	}

	if( ! $hide_view ) {
		echo '<span class="entry-meta-item penci-post-countview">';
		penci_get_post_countview( get_the_ID(), true );
		echo '</span>';
	}
}

function penci_get_comment_count( $show = true ) {

	$output ='<span class="entry-meta-item penci-comment-count">';
	$output .='<a class="penci_pmeta-link" href="'. esc_url( get_comments_link() ) . '"><i class="la la-comments"></i>';
	$output .= get_comments_number_text( esc_html__( '0', 'pennews' ), esc_html__( '1', 'pennews' ), '% ' . esc_html__( '', 'pennews' ) );
	$output .='</a></span>';

	if( ! $show ) {
		return $output;
	}

	echo ( $output );

}

function penci_get_post_author( $show = true, $has_icon = true ) {
	$byline = '<span class="author vcard"><a class="url fn n penci_pmeta-link" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

	$output = '<span class="entry-meta-item penci-byline">';
	$output .= penci_get_tran_setting( 'penci_translation_text_by' ). ' ';
	$output .= $byline;
	$output .= '</span>';

	if( ! $show ) {
		return $output;
	}

	echo ( $output );
}

function penci_get_post_date( $show = true ) {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$show_updated = penci_get_theme_mod( 'penci_show_date_updated' );

	$time_string = sprintf( $time_string,
		! $show_updated ? esc_attr( get_the_date( 'c' ) ) : esc_attr( get_the_modified_date( 'c' ) ),
		! $show_updated ? esc_html( get_the_date() ) : esc_html( get_the_modified_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'pennews' ),
		'<a class="penci_pmeta-link"  href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$output = '<span class="entry-meta-item penci-posted-on"><i class="fa fa-clock-o"></i>' . $time_string . '</span>'; // WPCS: XSS OK.

	if( ! $show ) {
		return $output;
	}

	echo ( $output );
}


/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function penci_entry_footer() {

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'pennews' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}

/**
 * Prints HTML with meta information for the categories.
 */
function penci_get_categories() {
	/* translators: used between list items, there is a space after the comma */
	$categories_list = get_the_category_list( esc_html__( ' ', 'pennews' ) );

	if( penci_get_theme_mod( 'archive_show_pri_cat' )&& class_exists( 'WPSEO_Primary_Term' ) ) {
		$category   = get_the_category();
		// Show the post's 'Primary' category, if this Yoast feature is available, & one is set
		$wpseo_primary_term = new WPSEO_Primary_Term( 'category', get_the_id() );
		$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
		$term               = get_term( $wpseo_primary_term );
		if ( is_wp_error( $term ) ) {
			// Default to first category (not Yoast) if an error is returned
			$category_display = $category[0]->name;
			$category_link    = get_category_link( $category[0]->term_id );
		} else {
			// Yoast Primary category
			$category_display = $term->name;
			$category_link    = get_category_link( $term->term_id );
		}

		echo ( '<span class="penci-cat-links"><a class="penci-cat-name" href="' . $category_link . '">' . $category_display . '</a></span>' );
	}elseif ( $categories_list ) {
		printf( '<span class="penci-cat-links">' . esc_html__( '%1$s', 'pennews' ) . '</span>', $categories_list ); // WPCS: XSS OK.
	}
}

function penci_get_tags( $post_id = 0 ) {
	/* translators: used between list items, there is a space after the comma */
	$tags_list = get_the_tag_list( '','','', $post_id );
	if ( $tags_list ) {
		printf( '<span class="tags-links penci-tags-links">' . esc_html__( '%1$s', 'pennews' ) . '</span>', $tags_list ); // WPCS: XSS OK.
	}
}

if( !function_exists( 'penci_get_post_countview' ) ) {
	function penci_get_post_countview( $post_id, $show = false ) {

		$count = (int) get_post_meta( $post_id, '_count-views_all', true );

		$output = '<span class="entry-meta-item penci-post-countview penci_post-meta_item">';
		$output .= '<i class="fa fa-eye"></i><span class="penci-post-countview-number penci-post-countview-p' . $post_id . '">' . $count . '</span>';
		$output .= '</span>';

		if ( $show ) {
			echo ( $output );
		}

		return $output;
	}
}

if( !function_exists( 'penci_link_pages_args' ) ){
	function penci_link_pages_args( $params ){
		$params['before'] = '<div class="page-links penci-pagination penci-pag-left"><nav class="navigation pagination"><div class="nav-links">';
		$params['after'] = '</div></nav></div>';

		return $params;
	}
}
add_filter( 'wp_link_pages_args', 'penci_link_pages_args', 9999 );

if( !function_exists( 'penci_link_pages_link' ) ){
	function penci_link_pages_link( $link ){
		$output = '';
		if( false !== strpos($link, '<a') ) {
			$output = str_replace('<a', '<a class="page-numbers" ', $link);
		}else{
			$output = '<span class="page-numbers current">' . $link .  '</span>';
		}
		
		return $output;
	}
}
add_filter( 'wp_link_pages_link', 'penci_link_pages_link', 9999 );


/**
 * Add Next Page/Page Break Button to WordPress Visual Editor
 *
 * @since 4.0.3
 */
if ( ! function_exists( 'penci_add_next_page_button_to_editor' ) ) {
	add_filter( 'mce_buttons', 'penci_add_next_page_button_to_editor', 1, 2 );
	function penci_add_next_page_button_to_editor( $buttons, $id ) {

		if ( 'content' != $id ) {
			return $buttons;
		}

		// add next page after more tag button
		array_splice( $buttons, 13, 0, 'wp_page' );

		return $buttons;
	}
}


if( ! function_exists( 'penci_get_archive_image_type' ) ){
	function penci_get_archive_image_type( $img_size, $type_img = '' ){

		if( empty( $type_img ) ){
			$type_img = penci_get_setting( 'penci_archive_image_type' );
		}

		$output   = $img_size;

		if( 'square' ==  $type_img ) {
			if( 'penci-thumb-280-186' == $img_size ){
				$output = 'penci-thumb-280-280';
			}elseif( 'penci-thumb-480-320' == $img_size ||
			         'penci-thumb-480-645' == $img_size ||
			         'penci-masonry-thumb' == $img_size ){
				$output = 'penci-thumb-480-480';
			}elseif( 'penci-thumb-760-570' == $img_size ){
				$output = 'penci-thumb-960-auto';
			}
		}elseif( 'vertical' ==  $type_img ) {
			if( 'penci-thumb-280-186' == $img_size ){
				$output = 'penci-thumb-280-376';
			}elseif( 'penci-thumb-480-320' == $img_size ||
			         'penci-thumb-480-645' == $img_size ||
			         'penci-masonry-thumb' == $img_size ){
				$output = 'penci-thumb-480-645';
			}elseif( 'penci-thumb-760-570' == $img_size ){
				$output = 'penci-thumb-960-auto';
			}
		}

		return $output;
	}
}