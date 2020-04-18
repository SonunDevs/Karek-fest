<?php
/**
 * Display breadcrumbs for posts, pages, archive page with the microdata that search engines understand
 *
 * @see http://support.google.com/webmasters/bin/answer.py?hl=en&answer=185417
 *
 * @param array|string $args
 */
function penci_breadcrumbs( $args = '' )
{
	global $wp;

	$args = wp_parse_args( $args, array(
		'separator'         => '<i class="fa fa-angle-right"></i>',
		'home_label'        => penci_get_tran_setting( 'penci_breadcrumb_home_label' ),
		'home_class'        => 'home',
		'before'            => '',
		'before_item'       => '',
		'after_item'        => '',
		'taxonomy'          => 'category',
		'display_last_item' => true,
		'classes'           => ''
	) );

	if( is_front_page() ){
		return;
	}
	$use_yoast_breadcrumb = penci_get_theme_mod( 'penci_use_yoast_breadcrumb' );

	if ( function_exists( 'yoast_breadcrumb' ) && $use_yoast_breadcrumb ) {
		$yoast_breadcrumb = yoast_breadcrumb( '<div class="penci_breadcrumbs ">', '</div>', false );

		if ( $yoast_breadcrumb ) {
			echo $yoast_breadcrumb;

			return;
		}
	}

	$args = apply_filters( 'penci_breadcrumbs_args', $args );

	$items = array();
	// HTML template for each item
	$item_tpl      = '<a href="%s" itemprop="item"><span itemprop="name">%s</span></a>';
	$item_text_tpl = '<span itemprop="item"><span itemprop="name">%s</span></span>';

	// Home
	if ( ! $args['home_class'] )
	{
		$items[] = sprintf( $item_tpl, esc_url( home_url() ), esc_html( $args['home_label'] ) );
	}
	else
	{
		$items[] = sprintf(
			'<a class="%s" href="%s" itemprop="item"><span itemprop="name">%s</span></a>',
				esc_attr( $args['home_class'] ),
				esc_url( home_url() ),
				esc_html( $args['home_label'] )
			);
	}

	// Blog page, not Homepage
	if ( is_home() && ! is_front_page() )
	{
		$page = get_option( 'page_for_posts' );
		if ( $args['display_last_item'] ) {
			$items[] = sprintf( $item_tpl, get_permalink( $page ), get_the_title( $page ) );
		}
	}elseif ( is_post_type_archive( 'portfolio' ) || is_tax( 'portfolio-category' ) ) {

		$current_term = get_queried_object();
		$current_term_tax = isset( $current_term->taxonomy ) ? $current_term->taxonomy : '';
		$terms        = penci_get_term_parents( get_queried_object_id(), $current_term_tax );

		foreach ( (array)$terms as $term_id ) {
			$term    = get_term( $term_id, $current_term->taxonomy );
			$items[] = sprintf( $item_tpl, get_category_link( $term_id ), $term->name );
		}

		$current_term_label = isset( $current_term->label ) ?  $current_term->label : $current_term->name;
		$current_term_id = isset( $current_term->term_id ) ?  $current_term->term_id : '';

		if ( $args['display_last_item'] ){
			$items[] = sprintf( $item_tpl, get_category_link( $current_term_id ), $current_term_label );
		}

	}elseif ( is_single() ) {

		// Terms
		$terms = get_the_terms( get_the_ID(), $args['taxonomy'] );


		if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
			$term    = penci_bread_primary_term( current( $terms ), $args['taxonomy'] );
			$terms   = penci_get_term_parents( $term->term_id, $args['taxonomy'] );
			$terms[] = $term->term_id;
			foreach ( $terms as $term_id ) {
				$term = get_term( $term_id, $args['taxonomy'] );
				if ( ! is_wp_error( $term ) && ! empty( $term ) ) {
					$items[] = sprintf( $item_tpl, get_term_link( $term, $args['taxonomy'] ), $term->name );
				}
			}
			if ( $args['display_last_item'] ) {
				$items[] = sprintf( $item_tpl, get_permalink( ), get_the_title( ) );
			}
		}
	}
	elseif ( is_page() )
	{
		$pages = penci_get_post_parents( get_queried_object_id() );
		foreach ( $pages as $page )
		{
			$items[] = sprintf( $item_tpl, get_permalink( $page ), get_the_title( $page ) );
		}
		if ( $args['display_last_item'] )
			$items[] = sprintf( $item_tpl, get_permalink( ), get_the_title( ) );
	}
	elseif ( is_tax() || is_category() || is_tag() )
	{
		$current_term = get_queried_object();
		$terms        = penci_get_term_parents( get_queried_object_id(), $current_term->taxonomy );

		foreach ( $terms as $term_id ) {
			$term    = get_term( $term_id, $current_term->taxonomy );
			$items[] = sprintf( $item_tpl, get_category_link( $term_id ), $term->name );
		}

		$current_term_label = isset( $current_term->label ) ? $current_term->label : '';
		$current_term_id    = isset( $current_term->term_id ) ? $current_term->term_id : '';

		if ( $args['display_last_item'] ) {
			$items[] = sprintf( $item_tpl, get_category_link( $current_term_id ), $current_term_label );
		}
	}
	elseif ( is_search() )
	{
		$items[] = sprintf( $item_tpl,get_search_link( get_search_query() ), sprintf( esc_html__( '%s &quot;%s&quot;', 'pennews' ), penci_get_tran_setting( 'penci_search_title' ), get_search_query() ) );
	}
	elseif ( is_404() )
	{
		$items[] = sprintf( $item_tpl, penci_get_tran_setting( 'penci_breadcrumb_page_404' ) );
	}
	elseif ( is_author() )
	{
		$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );

		// Queue the first post, that way we know what author we're dealing with (if that is the case).
		$items[] = sprintf(
			$item_tpl,
			$author_url,
			sprintf(
				esc_html__( '%s %s', 'pennews' ),
				penci_get_tran_setting( 'penci_breadcrumb_author_archive' ),
				'<span class="vcard"><a class="url fn n" href="' . $author_url . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>'
			)
		);
	}
	elseif ( is_day() )
	{
		$items[] = sprintf(
			$item_tpl,
			home_url( add_query_arg( array(), $wp->request ) ),
			sprintf( esc_html__( '%s %s', 'pennews' ),penci_get_tran_setting( 'penci_breadcrumb_day_archive' ), get_the_date() )
		);
	}
	elseif ( is_month() )
	{
		$items[] = sprintf(
			$item_tpl,
			home_url( add_query_arg( array(), $wp->request ) ),
			sprintf( esc_html__( '%s %s', 'pennews' ),penci_get_tran_setting( 'penci_breadcrumb_monthly_archives' ), get_the_date( 'F Y' ) )
		);
	}
	elseif ( is_year() )
	{
		$items[] = sprintf(
			$item_tpl,
			home_url( add_query_arg( array(), $wp->request ) ),
			sprintf( esc_html__( '%s %s', 'pennews' ),penci_get_tran_setting( 'penci_breadcrumb_yearly_archives' ), get_the_date( 'Y' ) )
		);
	}
	else
	{
		$items[] = sprintf(
			$item_tpl,
			home_url( add_query_arg( array(), $wp->request ) ),
			penci_get_tran_setting( 'penci_breadcrumb_archives' )
		);
	}


	$items = apply_filters( 'penci_breadcrumbs_items', $items, $item_tpl, $item_text_tpl );

	$output =  '<div class="penci_breadcrumbs ' . esc_attr( $args['classes'] ) . '">';
	$output .=  '<ul itemscope itemtype="http://schema.org/BreadcrumbList">';
	$output .=  ( $args['before'] );

	$pos_item = 1;
	foreach( $items as $item )  {



		$output .= $args['before_item'];
		$output .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';

		if( $pos_item > 1 ) {
			$output .= $args['separator'];
		}
		$output .= $item;
		$output .= sprintf( '<meta itemprop="position" content="%s" />', absint( $pos_item ) );
		$output .= '</li>';
		$output .= $args['after_item'];

		$pos_item ++;
	}

	$output .= '</ul>';
	$output .= '</div>';

	echo ( $output );
}

/**
 * Searches for term parents' IDs of hierarchical taxonomies, including current term.
 * This function is similar to the WordPress function get_category_parents() but handles any type of taxonomy.
 * Modified from Hybrid Framework
 *
 * @param int|string    $term_id  The term ID
 * @param object|string $taxonomy The taxonomy of the term whose parents we want.
 *
 * @return array Array of parent terms' IDs.
 */
if( ! function_exists( 'penci_get_term_parents' ) ) {
	function penci_get_term_parents( $term_id = '', $taxonomy = 'category' ) {
		// Set up some default arrays.
		$list = array();

		// If no term ID or taxonomy is given, return an empty array.
		if ( empty( $term_id ) || empty( $taxonomy ) ) {
			return $list;
		}

		do {
			$list[] = $term_id;

			// Get next parent term
			$term    = get_term( $term_id, $taxonomy );
			$term_id = $term->parent;
		} while ( $term_id );

		// Reverse the array to put them in the proper order for the trail.
		$list = array_reverse( $list );
		array_pop( $list );

		return $list;
	}
}

/**
 * Gets parent posts' IDs of any post type, include current post
 * Modified from Hybrid Framework
 *
 * @param int|string $post_id ID of the post whose parents we want.
 *
 * @return array Array of parent posts' IDs.
 */
if( ! function_exists( 'penci_get_post_parents' ) ) {
	function penci_get_post_parents( $post_id = '' ) {
		// Set up some default array.
		$list = array();

		// If no post ID is given, return an empty array.
		if ( empty( $post_id ) ) {
			return $list;
		}

		do {
			$list[] = $post_id;

			// Get next parent post
			$post    = get_post( $post_id );
			$post_id = $post->post_parent;
		} while ( $post_id );

		// Reverse the array to put them in the proper order for the trail.
		$list = array_reverse( $list );
		array_pop( $list );

		return $list;
	}
}


if( ! function_exists( 'penci_bread_primary_term' ) ) {

	function penci_bread_primary_term( $term, $taxonomy ){
		if ( class_exists( 'WPSEO_Primary_Term' ) ) {
			$wpseo_primary_term = new WPSEO_Primary_Term( $taxonomy, get_the_id() );
			$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
			$primary_term       = get_term( $wpseo_primary_term );

			if ( ! is_wp_error( $primary_term ) ) {
				$term = $primary_term;
			}
		}

		return $term;
	}
}