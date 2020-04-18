<?php
class Penci_Search{
	public function __construct() {
		add_action( 'wp_ajax_penci_ajaxified_search', array( $this,'get_search_results'  ) );
		add_action( 'wp_ajax_nopriv_penci_ajaxified_search', array( $this,'get_search_results'  ) );

		if( penci_get_setting( 'penci_del_pages_fsearch' ) && ! is_admin() ) {
			add_action( 'init', array( $this, 'remove_pages_from_search' ) );
		}
	}

	/**
	 * Exclude pages form search results page
	 * Hook to init action
	 */
	public function remove_pages_from_search() {


		global $wp_post_types;
		$wp_post_types['page']->exclude_from_search = true;
	}

	public function get_search_results() {
		$nonce = isset( $_POST['nonce'] ) ? $_POST['nonce'] : '';
		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
			die ( 'Nope!' );
		}

		if ( empty( $_POST['s'] ) ) {
			return '';
		}

		global $wpdb;

		$number = penci_get_setting( 'penci_ajaxsearch_amount' );

		$search     = $wpdb->esc_like( $_POST['s'] );

		$args = array( 's' => $_POST['s'], 'post_status' => 'publish', 'posts_per_page' => $number ? intval( $number ) : 6 );
		$args = apply_filters( 'penci_args_support_polylang', $args );

		$query_search = new WP_Query( $args );
		$output = '';

		if ( ! $query_search->have_posts() ) {
			$output = '<div class="search-404">' . penci_get_tran_setting( 'penci_ajaxsearch_no_post' ) . '</div>';
			wp_send_json_success( array( 'output' => $output, 'textsearch' =>  $_POST['s'] ) );
		}

		$output .= '<div class="penci-post-list penci-animated_ajax">';

		while ( $query_search->have_posts() ) {
			$query_search->the_post();
			$output .= '<article  class="' . join( ' ', get_post_class( 'penci-sj-item penci__general-meta', get_the_ID() ) ) . '">';
			$output .= '<div class="penci_media_object">';
			if( class_exists( 'Penci_Helper_Shortcode' ) ):
				$output .= Penci_Helper_Shortcode::get_image_holder(  array(
					'image_size' => 'penci-thumb-280-186',
					'class'      => 'penci_mobj__img',
					'show_icon'  => ! penci_get_setting( 'penci_ajaxsearch_hide_postformat' ),
					'class_icon' => 'small-size-icon',
				) );
			endif;

			$output .= '<div class="penci_post_content penci_mobj__body">';
			$output .= '<h3 class="penci__post-title entry-title"><a href="' . get_the_permalink() . '" title="' . get_the_title( get_the_ID() ) . '">' . wp_trim_words( get_the_title( get_the_ID() ), 5, '...' ) . '</a></h3>';
			$output .= self::get_post_meta();
			$output .= penci_get_schema_markup();
			$output .= '</div></div></article>';
		}
		wp_reset_postdata();

		$output .= '</div>';
		$output .= '<div class="penci-viewall-results"><a href="' . esc_url( add_query_arg( 's', $_POST['s'], home_url( '/' ) ) ) . '">' . penci_get_tran_setting( 'penci_ajaxsearch_viewmore_text' ) . '</a></div>';

		wp_send_json_success( array( 'output' => $output, 'textsearch' =>  $_POST['s'] ) );
	}

	/**
	 * Render html post meta
	 *
	 * @param $args array( 'cat', 'author', 'comment', 'date', 'like', 'view'  )
	 * @param $atts
	 * @param bool $show
	 *
	 * @return string
	 */
	public static function get_post_meta(  ) {
		$hide_date = penci_get_setting( 'penci_ajaxsearch_hide_date' );
		$hide_comment = penci_get_setting( 'penci_ajaxsearch_hide_comment' );

		$output = '';
		$output .= empty( $hide_date ) ? penci_get_post_date( false ) : '';	
		$output .= empty( $hide_comment ) ? penci_get_comment_count( false ) : '';
				

		return $output ? '<div class="penci_post-meta">' . $output . '</div>' : '';
	}
}

new Penci_Search;