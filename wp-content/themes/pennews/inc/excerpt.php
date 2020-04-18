<?php
/**
 * Functions related to post excerpt.
 * @package penci
 */

add_filter( 'excerpt_more', 'penci_excerpt_more' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'Continue reading' link.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function penci_excerpt_more()
{
	return '...';
}

/**
 * Auto add more links when using the_content() function.
 * @return string 'Continue reading' link
 */
function penci_more_link( $class = '' ) {
	return sprintf(
		'<div class="penci-pmore-link%s"><a href="%s" class="more-link button"><span>%s</span></a></div>',
		$class ? ' ' . $class : '',
		esc_url( get_permalink() ),
		esc_html( penci_get_tran_setting( 'penci_blog_more_text' ) )
	);
}

add_filter( 'excerpt_length', 'penci_excerpt_length' );

/**
 * Change excerpt length
 * @return int
 */
function penci_excerpt_length() {
	$number = get_theme_mod( 'penci_maximum_excerpt_length' );
	return ( $number ? $number : 50 );
}

function penci_excerpt_length_blog() {
	global $wp_query;

	$default = '25';
	if ( isset( $wp_query->query['penci_vc_block_pag'] ) ) {
		$excerpt_length = penci_get_theme_mod( 'penci_block_pag_content_limit' );
		return ( $excerpt_length ? $excerpt_length : $default );
	}

	$excerpt_length = penci_get_theme_mod( 'penci_blog_content_limit' );
	$excerpt_length = penci_convert_to_custom_option_tax( 'penci_content_limit', $excerpt_length );

	return ( $excerpt_length ? $excerpt_length : $default );
}

/**
 * Display limited post content
 *
 * Strips out tags and shortcodes, limits the content to `$num_words` words and appends more link to the end.
 *
 * @param integer $num_words The maximum number of words
 * @param string  $more      More link. Default is "...". Optional.
 * @param bool    $echo      Echo or return output
 * @param string  $class     Additional link class
 * @return string Limited content.
 */
function penci_content_limit( $num_words, $more = '...', $echo = true ) {

	$content = get_the_excerpt();
	$output  = wp_trim_words( $content, $num_words, '' );
	$output .= $more;

	if ( $echo ) {
		echo wp_kses_post( $output );
	}

	return $output;
}

/**
 * Get the small excerpt of the post.
 * @return string
 */
function penci_small_excerpt() {
	$post = get_post();
	$text = ! empty( $post->post_excerpt ) ? $post->post_excerpt : $post->post_content;
	$text = wp_trim_words( $text, 10 );
	echo wp_kses_post( $text );
}


/**
 * Display entry content or summary.
 */
function penci_entry_content( $show = true )
{
	$display = penci_get_theme_mod( 'penci_blog_display' );
	$display = penci_convert_to_custom_option_tax( 'penci_blog_display', $display );

	if( ! $show ){
		ob_start();
	}
	if ( 'more' == $display ) {
		the_content();
	} elseif ( 'content' == $display ) {
		$content   = apply_filters( 'the_content', get_the_content() );
		$num_words = penci_excerpt_length_blog();
		$content   = wp_trim_words( $content, $num_words, '...' );
		echo ( $content );
	} else {
		penci_content_limit( penci_excerpt_length_blog(),'...' );
	}

	if( ! $show ){
		return ob_get_clean();
	}
}

/**
 * Get main content
 *
 * @return mixed
 */
function penci_get_main_content() {

	$main_content = apply_filters( 'the_content', get_the_content() );
	if ( in_array( get_post_format(), array( 'audio', 'video' ), true ) ) {
		$media = get_media_embedded_in_content( $main_content, array(
			'audio',
			'video',
			'object',
			'embed',
			'iframe',
		) );
		$main_content = str_replace( $media, '', $main_content );
	}

	return $main_content;
}