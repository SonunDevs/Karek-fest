<?php

class Penci_Auto_Load_Previous_Post {

	public function __construct() {
		add_action( 'wp_ajax_nopriv_penci_single_load_more', array( $this, 'penci_single_load_more_callback' ) );
		add_action( 'wp_ajax_penci_single_load_more', array( $this, 'penci_single_load_more_callback' ) );
	}

	public function penci_single_load_more_callback() {

		if( class_exists( 'WPBMap' ) ){
			WPBMap::addAllMappedShortcodes();
		}

		$article = '';

		if ( isset( $_POST['_wpnonce'] ) ) {
			return;
		}

		$post_id = isset( $_POST['postid'] ) ? $_POST['postid'] : '';

		if ( empty( $post_id ) ) {
			return;
		}

		$postidloaded     = isset( $_POST['postidloaded'] ) ? $_POST['postidloaded'] : '';
		$pre_postidloaded = array_filter( explode( ',', $postidloaded . ',' ) );

		$offset       = isset( $_POST['offset'] ) ? $_POST['offset'] : '';

		$posts_per_page   = penci_get_setting( 'penci_autoload_prev_number' );
		$autoload_prev_by = penci_get_setting( 'penci_autoload_prev_by' );
		$post_type        = get_post_type( $post_id );
		$args = array(
			'post_type'           => $post_type,
			'posts_per_page'      => $posts_per_page,
			'ignore_sticky_posts' => 1,
			'post_status'         => 'publish'

		);
		if ( 'cat' == $autoload_prev_by && 'post' == $post_type ) {
			$categories = get_the_category( $post_id );
			if ( $categories ) {
				$category_ids = array();
				foreach ( $categories as $individual_category ) {
					$category_ids[] = $individual_category->term_id;
				}

				$args['category__in'] = $category_ids;
				$args['post__not_in'] = array( $post_id );
				$args['offset'] =  $offset;
			}

		} else {
			$post_current     = get_post( $post_id );

			$post_ids         = $this->get_post_siblings( $posts_per_page, $offset, $post_current->post_date, $post_type );
			$args['post__in'] = $post_ids;
		}

		$args = apply_filters( 'penci_args_support_polylang', $args );

		$loadmore_query = new WP_Query( $args );

		ob_start();
		$pinfo =  array();

		if ( $loadmore_query->have_posts() ) {
			while ( $loadmore_query->have_posts() ) {
				$loadmore_query->the_post();

				$post_id_new = get_the_ID();

				if( ! in_array( $post_id_new, $pre_postidloaded ) ) {
					$pinfo[]    = array(
						'id'   => get_the_ID(),
						'link' => is_ssl() ? set_url_scheme( get_the_permalink(), 'https' ) : get_the_permalink(),
						'title' => get_the_guid(),
					);

					$postidloaded .= ',' . $post_id_new;

					get_template_part( 'template-parts/content', 'single-loadmore' );
				}


			}
			wp_reset_postdata();
		}

		$article = ob_get_contents();
		ob_end_clean();

		wp_send_json_success( array( 'items' => $article, 'psinfo' => $pinfo, 'postidloaded' => $postidloaded ) );
	}

	/**
	 * Get post siblings
	 *
	 * @param int $ppp
	 * @param int $offset
	 * @param string $date
	 *
	 * @return array|null|object|void
	 */
	function get_post_siblings( $ppp = 3, $offset = 0, $date = '', $posttype = 'post' ) {
		global $wpdb, $post;

		if ( empty( $date ) ) {
			$date = $post->post_date;
		}
		//$date = '2009-06-20 12:00:00'; // test data

		$ppp = absint( $ppp );
		if ( ! $ppp ) {
			return;
		}

		$limit = '';
		if ( $offset && is_numeric( $offset ) ) {
			$limit .= absint( $offset ) . ', ';
		}

		$limit .= $ppp;

		$pre_post_ids = array();

		$post_ids = $wpdb->get_results( "(
		        SELECT p1.ID
		        FROM 
		            $wpdb->posts p1 
		        WHERE 
		            p1.post_date < '$date' AND 
		            p1.post_type = '$posttype' AND 
		            p1.post_status = 'publish' 
		        ORDER by 
		            p1.post_date DESC
		        LIMIT 
		            $limit
		    )" );

		foreach ( $post_ids as $post_id ) {
			if ( isset( $post_id->ID ) ) {
				$pre_post_ids[] = $post_id->ID;
			}
		}

		return $pre_post_ids;
	}

	public static function the_content( $more_link_text = null, $strip_teaser = false) {
		$content = self::get_the_content( $more_link_text, $strip_teaser );

		/**
		 * Filters the post content.
		 *
		 * @since 0.71
		 *
		 * @param string $content Content of the current post.
		 */
		$content = apply_filters( 'the_content', $content );
		$content = apply_filters( 'single_load_more_content', $content );
		$content = str_replace( ']]>', ']]&gt;', $content );
		echo ( $content );
	}
	public static function get_the_content( $more_link_text = null, $strip_teaser = false ) {
		global $page, $more, $preview, $pages, $multipage;
		$more = 1;
		$post = get_post();

		if ( null === $more_link_text ) {
			$more_link_text = sprintf(
				'<span aria-label="%1$s">%2$s</span>',
				sprintf(
				/* translators: %s: Name of current post */
					__( 'Continue reading %s','pennews' ),
					the_title_attribute( array( 'echo' => false ) )
				),
				__( '(more&hellip;)','pennews' )
			);
		}

		$output = '';
		$has_teaser = false;


		// If post password required and it doesn't match the cookie.
		if ( post_password_required( $post ) )
			return get_the_password_form( $post );

		if ( $page > count( (array)$pages ) ) // if the requested page doesn't exist
			$page = count( (array)$pages ); // give them the highest numbered page that DOES exist

		$content = $pages[$page - 1];
		if ( preg_match( '/<!--more(.*?)?-->/', $content, $matches ) ) {
			$content = explode( $matches[0], $content, 2 );
			if ( ! empty( $matches[1] ) && ! empty( $more_link_text ) )
				$more_link_text = strip_tags( wp_kses_no_null( trim( $matches[1] ) ) );

			$has_teaser = true;
		} else {
			$content = array( $content );
		}

		if ( false !== strpos( $post->post_content, '<!--noteaser-->' ) && ( ! $multipage || $page == 1 ) )
			$strip_teaser = true;

		$teaser = $content[0];

		if ( $more && $strip_teaser && $has_teaser )
			$teaser = '';

		$output .= $teaser;

		if ( count( (array)$content ) > 1 ) {

			if ( $more ) {
				$output .= '<span id="more-' . $post->ID . '"></span>' . $content[1];
			} else {
				if ( ! empty( $more_link_text ) )
					$output .= apply_filters( 'the_content_more_link', ' <a href="' . get_permalink() . "#more-{$post->ID}\" class=\"more-link\">$more_link_text</a>", $more_link_text );
				$output = function_exists( 'penci_force_balance_tags' ) ? penci_force_balance_tags( $output ) : $output;
			}
		}

		if ( $preview ) // Preview fix for JavaScript bug with foreign languages.
			$output =	preg_replace_callback( '/\%u([0-9A-F]{4})/', '_convert_urlencoded_to_entities', $output );

		return $output;
	}

	public static function comments_template( $file = '/comments.php', $separate_comments = false ) {
		global $wp_query, $withcomments, $post, $wpdb, $id, $comment, $user_login, $user_ID, $user_identity, $overridden_cpage;


		if ( empty( $post ) ) {
			return;
		}


		if ( empty( $file ) ) {
			$file = '/comments.php';
		}

		$req = get_option( 'require_name_email' );

		$commenter = wp_get_current_commenter();

		$comment_author = $commenter['comment_author'];

		$comment_author_email = $commenter['comment_author_email'];


		$comment_author_url = esc_url( $commenter['comment_author_url'] );

		$comment_args = array(
			'orderby'                   => 'comment_date_gmt',
			'order'                     => 'ASC',
			'status'                    => 'approve',
			'post_id'                   => $post->ID,
			'no_found_rows'             => false,
			'update_comment_meta_cache' => false, // We lazy-load comment meta for performance.
		);

		if ( get_option( 'thread_comments' ) ) {
			$comment_args['hierarchical'] = 'threaded';
		} else {
			$comment_args['hierarchical'] = false;
		}

		if ( $user_ID ) {
			$comment_args['include_unapproved'] = array( $user_ID );
		} elseif ( ! empty( $comment_author_email ) ) {
			$comment_args['include_unapproved'] = array( $comment_author_email );
		}

		$per_page = 0;
		if ( get_option( 'page_comments' ) ) {
			$per_page = (int) get_query_var( 'comments_per_page' );
			if ( 0 === $per_page ) {
				$per_page = (int) get_option( 'comments_per_page' );
			}

			$comment_args['number'] = $per_page;
			$page                   = (int) get_query_var( 'cpage' );

			if ( $page ) {
				$comment_args['offset'] = ( $page - 1 ) * $per_page;
			} elseif ( 'oldest' === get_option( 'default_comments_page' ) ) {
				$comment_args['offset'] = 0;
			} else {
				// If fetching the first page of 'newest', we need a top-level comment count.
				$top_level_query = new WP_Comment_Query();
				$top_level_args  = array(
					'count'   => true,
					'orderby' => false,
					'post_id' => $post->ID,
					'status'  => 'approve',
				);

				if ( $comment_args['hierarchical'] ) {
					$top_level_args['parent'] = 0;
				}

				if ( isset( $comment_args['include_unapproved'] ) ) {
					$top_level_args['include_unapproved'] = $comment_args['include_unapproved'];
				}

				$top_level_count = $top_level_query->query( $top_level_args );

				$comment_args['offset'] = ( ceil( $top_level_count / $per_page ) - 1 ) * $per_page;
			}
		}
		$comment_args  = apply_filters( 'comments_template_query_args', $comment_args );
		$comment_query = new WP_Comment_Query( $comment_args );
		$_comments     = $comment_query->comments;

		// Trees must be flattened before they're passed to the walker.
		if ( $comment_args['hierarchical'] ) {
			$comments_flat = array();
			foreach ( $_comments as $_comment ) {
				$comments_flat[]  = $_comment;
				$comment_children = $_comment->get_children( array(
					'format'  => 'flat',
					'status'  => $comment_args['status'],
					'orderby' => $comment_args['orderby']
				) );

				foreach ( $comment_children as $comment_child ) {
					$comments_flat[] = $comment_child;
				}
			}
		} else {
			$comments_flat = $_comments;
		}

		$wp_query->comments = apply_filters( 'comments_array', $comments_flat, $post->ID );

		$comments                        = $wp_query->comments;
		$wp_query->comment_count         = is_array( $wp_query->comments ) || is_object( $wp_query->comments ) ? count( $wp_query->comments ) : 0;
		$wp_query->max_num_comment_pages = $comment_query->max_num_pages;

		if ( $separate_comments ) {
			$wp_query->comments_by_type = separate_comments( $comments );
			$comments_by_type           = &$wp_query->comments_by_type;
		} else {
			$wp_query->comments_by_type = array();
		}

		$overridden_cpage = false;
		if ( '' == get_query_var( 'cpage' ) && $wp_query->max_num_comment_pages > 1 ) {
			set_query_var( 'cpage', 'newest' == get_option( 'default_comments_page' ) ? get_comment_pages_count() : 1 );
			$overridden_cpage = true;
		}

		if ( ! defined( 'COMMENTS_TEMPLATE' ) ) {
			define( 'COMMENTS_TEMPLATE', true );
		}

		$style_sheet_path = get_stylesheet_directory();
		$template_path    = get_template_directory();

		$theme_template = $style_sheet_path . $file;

		$include = apply_filters( 'comments_template', $theme_template );
		if ( file_exists( $include ) ) {
			require( $include );
		} elseif ( file_exists( $template_path . $file ) ) {
			require( $template_path . $file );
		} else // Backward compat code will be removed in a future release
		{
			require( ABSPATH . WPINC . '/theme-compat/comments.php' );
		}
	}
}

new Penci_Auto_Load_Previous_Post();

