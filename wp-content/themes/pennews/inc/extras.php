<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package PenNews
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */

function penci__header_tran(){
	$is_header_tran = false;
	if( is_page() ) {
		$paged  = class_exists( 'Penci_Pagination' ) ? Penci_Pagination::get_current_paged() : 1;
		if( get_post_meta( get_the_ID(), 'penci_enable_header_tran', true ) &&
		 ! ( $paged > 1 && is_page_template( 'page-templates/full-width.php' ) ) &&
		 ! ( $paged > 1 && is_page_template( 'page-templates/layout-boxed.php' ) )
		 ) {
			$is_header_tran = true;
		}
	}

	return $is_header_tran;
}

function penci_body_classes( $classes ) {

	$post_id = get_the_ID();

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if( penci_get_theme_mod( 'penci_disable_reponsive' ) ){
		$classes[] = 'penci-dis-reponsive';
	}

	if( ! penci_get_setting( 'penci_hide_header_sticky' ) ) {
		if( ! isset( $_GET['vc_editable'] ) || ( isset( $_GET['vc_editable'] ) && 'true' !== $_GET['vc_editable'] ) ) {
			$classes[] = 'header-sticky';
		}
	}

	if ( get_theme_mod( 'penci_body_boxed_layout' ) ){
		$classes[] = 'penci-body-boxed';
	}

	if( penci__header_tran() ){
		$classes[] = 'penci-header-transparent';
	}

	if( penci_get_setting( 'penci_enable_ajaxsearch' ) ) {
		$classes[] = 'penci_enable_ajaxsearch';
	}

	if( penci_get_theme_mod( 'penci_verttical_nav_show' ) ) {
		$classes[] = 'penci-vernav-enable';

		$vernavpos = penci_get_theme_mod( 'penci_menu_hbg_pos' );
		$vernavpos = $vernavpos ? $vernavpos : 'left';

		$classes[] = 'penci-vernav-po' . $vernavpos;
	}

	if ( penci_get_setting( 'penci_smooth_scroll' ) ) {
		$classes[] = 'penci_smooth_scroll';
	}

	if( ! penci_get_setting( 'penci_sticky_content_sidebar' ) ) {
		if( ! isset( $_GET['vc_editable'] ) || ( isset( $_GET['vc_editable'] ) && 'true' !== $_GET['vc_editable'] ) ) {
				$classes[] = 'penci_sticky_content_sidebar';
		}
	}

	if( penci_get_theme_mod( 'penci_dis_sticky_block_vc' ) ) {
		if( ! isset( $_GET['vc_editable'] ) || ( isset( $_GET['vc_editable'] ) && 'true' !== $_GET['vc_editable'] ) ) {
				$classes[] = 'penci-dis-sticky-block_vc';
		}
	}

	if ( penci_get_setting( 'penci_dis_padding_block_widget' ) ) {
		$classes[] = 'penci_dis_padding_bw';
	}

	if ( 'dark' == penci_get_setting( 'penci_colorscheme' ) ) {
		$classes[] = 'penci_dark_layout';
	}

	if( is_home() ) {
		$classes[] = penci_get_setting( 'penci_home_layout_style' );
	}elseif ( is_category() ) {
		$classes[] = penci_get_taxomony_layout_style( 'category' );
	}elseif ( is_archive() ) {
		$classes[] = penci_get_taxomony_layout_style( 'tag' );;
	}elseif ( is_search() ) {
		$classes[] = penci_get_setting( 'penci_archive_layout_style' );
	}
	if ( function_exists( 'is_shop' ) && ( is_shop() || is_product_category() || is_product_tag() ) ) {
		$classes[] = penci_get_setting( 'penci_woo_sidebar_shop' );
	}elseif ( is_singular( 'tribe_events' ) ) {
		$classes[] = penci_get_setting( 'penci_event_single_sidebar' );
	}elseif ( is_post_type_archive( 'tribe_events' )  ) {
		$classes[] = penci_get_setting( 'penci_event_sidebar' );
	}elseif ( is_singular( 'product' ) ) {
		$classes[] = penci_get_setting( 'penci_woo_sidebar_product' );
	}elseif ( is_singular( 'portfolio' ) ) {

		$portfolio_sidebar_layout = penci_get_setting( 'penci_portfolio_sidebar' );

		$pfl_single_use_option_current  = get_post_meta( $post_id, 'penci_pfl_use_opt_current_page', true );
		$pre_portfolio_sidebar_layout   = get_post_meta( $post_id, 'penci_pfl_sidebar_pos', true );

		if( $pfl_single_use_option_current ){
			$portfolio_sidebar_layout = $pre_portfolio_sidebar_layout;
		}

		$classes[] =  $portfolio_sidebar_layout;

	}elseif ( is_post_type_archive( 'portfolio' ) || is_tax( 'portfolio-category' ) ) {

		$portfolio_sidebar_layout = penci_get_setting( 'penci_pfl_archive_sidebar' );
		$classes[] =  $portfolio_sidebar_layout;

	}elseif ( function_exists( 'is_buddypress' ) && is_buddypress() ) {
		$classes[] = penci_get_setting( 'penci_buddypress_sidebar' );
	}elseif ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
		$classes[] = penci_get_setting( 'penci_bbpress_sidebar' );
	}elseif( is_page() ) {

		$paged  = class_exists( 'Penci_Pagination' ) ? Penci_Pagination::get_current_paged() : 1;
		if( $paged > 1 && ( is_page_template( 'page-templates/full-width.php' ) || is_page_template( 'page-templates/layout-boxed.php' ) ) ){

			$block_pag_sidebar_layout   = penci_get_setting( 'penci_block_pag_sidebar_layout' );

			$classes[] =  $block_pag_sidebar_layout;

			$classes[] = penci_get_setting( 'penci_block_pag_layout_style' );
			$classes[] = 'blog penci-block-pagination';
		}else{
			 $page_sidebar_layout = penci_get_setting( 'penci_page_sidebar_layout' );

			$pre_page_sidebar_layout  = get_post_meta( $post_id, 'page_sidebar_pos', true );
			$page_use_option_current  = get_post_meta( $post_id, 'penci_use_option_current_page', true );

			if( ! empty( $page_use_option_current ) && $pre_page_sidebar_layout ) {
				$page_sidebar_layout = $pre_page_sidebar_layout;
			}

			if( is_page_template( 'default' ) ) {
				$classes[] = $page_sidebar_layout;

				$page_style = penci_get_setting( 'penci_page_template' );
				$pre_page_style  = get_post_meta( $post_id, 'page_template_layout', true );
				if( ! empty( $page_use_option_current ) && $pre_page_style ) {
					$page_style = $pre_page_style;
				}
				$classes[] = 'penci-page-' . $page_style;
			}
		}
	}elseif ( is_archive() || is_home() || is_search() ) {
		$archive_sidebar_layout = penci_get_setting( 'penci_archive_sidebar_layout' );

		if( is_category() || is_tag() ){
			$term_id = penci_get_term_id();
			$tax_user_op = get_term_meta( $term_id, 'penci_use_opt_current', true );
			$ct_sidebar  = get_term_meta( $term_id, 'penci_sidebar_layout', true );
			if ( $tax_user_op && $ct_sidebar ) {
				$archive_sidebar_layout = $ct_sidebar;
			}
		}

		$classes[] =  $archive_sidebar_layout;

	}elseif ( is_singular() ) {

		$single_sidebar_layout = penci_get_setting( 'penci_single_sidebar_layout' );
		$single_template = penci_get_setting( 'penci_single_template' );

		$single_use_option_current  = get_post_meta( $post_id, 'penci_use_option_current_single', true );
		$pre_single_sidebar_layout  = get_post_meta( $post_id, 'single_sidebar_pos', true );
		$pre_single_template        = get_post_meta( $post_id, 'single_template_layout', true );

		if( $single_use_option_current ) {
			if( $pre_single_sidebar_layout ) {
				$single_sidebar_layout = $pre_single_sidebar_layout;
			}

			if( $pre_single_template  ) {
				$single_template = $pre_single_template ;
			}
		}

		$single_sidebar_layout = apply_filters( 'penci_single_sidebar_layout_hook', $single_sidebar_layout );

		$classes[] =  $single_sidebar_layout;

		$classes[] = 'penci-single-' . $single_template;
	}

	if( is_single() ) {

		$dis_auto_load_prev =  get_post_meta( $post_id, 'penci_dis_auto_load_prev', true );

		if( ! $dis_auto_load_prev ){
			$single_loadmore = penci_get_theme_mod( 'penci_auto_load_prev_post' );
			$dis_loadmore_mobile = penci_get_theme_mod( 'penci_dis_auto_load_prev_mobile' );

			if( class_exists( 'Mobile_Detect' ) && $dis_loadmore_mobile ) {
				$penci_detect = new Mobile_Detect;

				// Any mobile device (phones or tablets).
				if ( $penci_detect->isMobile() ) {
					$single_loadmore = false;
					$classes[] = 'penci-disalp-mobile';
				}
			}

			if ( $single_loadmore ) {
				$classes[] = 'penci-autoload-prev';
			}
		}
	}

	if( is_singular() || is_page() ) {
		$caption_above_img = penci_get_setting( 'penci_caption_above_img' );

		if ( $caption_above_img ) {
			$classes[] = 'penci-caption-above-img';
		}
	}

	return $classes;
}

add_filter( 'body_class', 'penci_body_classes' );

/**
 * Adds custom classes to the array of posts classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function penci_post_classes( $classes, $class, $post_id ) {
	$post = get_post( $post_id );

	if( 'post' == $post->post_type || 'page' == $post->post_type ) {
		$classes[] = 'penci-post-item';
	}

	return $classes;
}
add_filter( 'post_class', 'penci_post_classes',10,3 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function penci_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'penci_pingback_header' );

function penci_check_active_sidebar( $pos ) {
	$output = true;

	$id_option = '';

	if ( is_page() ) {
		$id_option = 'penci_page_sidebar_layout';

	}elseif ( is_archive() || is_home() || is_search() ) {

		$id_option = 'penci_archive_sidebar_layout';

		$paged  = class_exists( 'Penci_Pagination' ) ? Penci_Pagination::get_current_paged() : 1;

		if( $paged > 1 && ( is_page_template( 'page-templates/full-width.php' ) || is_page_template( 'page-templates/layout-boxed.php' ) ) ){
			$id_option = 'penci_block_pag_sidebar_layout';
		}

	}
	elseif ( is_singular() ) {
		$id_option = 'penci_single_sidebar_layout';
	}

	if ( empty( $id_option ) ) {
		return $output;
	}


	$sidebar_layout = penci_get_setting( $id_option );

	if ( is_page() ) {
		$pre_page_sidebar_layout  = get_post_meta( get_the_ID(), 'page_sidebar_pos', true );
		$page_use_option_current  = get_post_meta( get_the_ID(), 'penci_use_option_current_page', true );

		if( ! empty( $page_use_option_current ) && $pre_page_sidebar_layout ) {
				$sidebar_layout = $pre_page_sidebar_layout;
		}
	}elseif( is_singular() ){
		$pre_single_sidebar_layout  = get_post_meta( get_the_ID(), 'single_sidebar_pos', true );
		$single_use_option_current  = get_post_meta( get_the_ID(), 'penci_use_option_current_single', true );

		if( $single_use_option_current && $pre_single_sidebar_layout ) {
			$sidebar_layout = $pre_single_sidebar_layout;
		}

		$sidebar_layout = apply_filters( 'penci_single_sidebar_layout_hook', $sidebar_layout );
	}elseif( is_category() || is_tag() ) {
		$term_id = penci_get_term_id();
		$tax_user_op = get_term_meta( $term_id, 'penci_use_opt_current', true );
		$ct_ssidebar_layout  = get_term_meta( $term_id, 'penci_sidebar_layout', true );
		if ( $tax_user_op && $ct_ssidebar_layout ) {
			$sidebar_layout = $ct_ssidebar_layout;
		}
	}

	if ( 'right' == $pos ) {
		if ( in_array( $sidebar_layout, array( 'no-sidebar','no-sidebar-wide','no-sidebar-1080','sidebar-left'  ) ) ) {
			$output = false;
		}
	}
	elseif ( 'left' == $pos ) {

		if ( in_array( $sidebar_layout, array( 'no-sidebar','no-sidebar-wide','no-sidebar-1080','sidebar-right'  ) ) ) {
			$output = false;
		}
	}

	return $output;
}


function penci_block_pag_check_active_sidebar( $sidebar ) {
	$output = true;

	$sidebar_layout = penci_get_setting( 'penci_block_pag_sidebar_layout' );

	if ( 'right' == $sidebar ) {
		if ( in_array( $sidebar_layout, array( 'no-sidebar','no-sidebar-wide','sidebar-left'  ) ) ) {
			$output = false;
		}
	}
	elseif ( 'left' == $sidebar ) {

		if ( in_array( $sidebar_layout, array( 'no-sidebar','no-sidebar-wide','sidebar-right'  ) ) ) {
			$output = false;
		}
	}

	return $output;
}

add_filter( 'widget_tag_cloud_args', 'penci_tag_cloud_args' );
add_filter( 'woocommerce_product_tag_cloud_widget_args', 'penci_tag_cloud_args' );

/**
 * Change the tag could args
 *
 * @param $args
 *
 * @return mixed
 *
 */
function penci_tag_cloud_args( $args ) {
	$args['largest']  = 10; //largest tag
	$args['smallest'] = 10; //smallest tag
	$args['unit']     = 'px'; //tag font unit

	return $args;
}

/**
 * Social buttons class.
 */

function penci_get_social_share( $show =  true, $popup = false ) {

	$output = '';

	$list_social = array( 'facebook', 'twitter', 'google_plus', 'pinterest', 'linkedin', 'tumblr', 'reddit', 'stumbleupon','whatsapp','telegram','email','digg','vk','line','viber' );

	foreach ( $list_social as $k => $item ) {
		if ( penci_get_setting( 'penci_hide_block_share_' . $item ) ) {
			unset( $list_social[ $k ] );
		}
	}

	$markup_social_share = Penci_Social_Share::get_social_share( $list_social, $echo = false, $show_count = false );

	if( $markup_social_share ) {
		$output .=  '<span class="social-buttons">';
		$output .=  '<span class="social-buttons__content">';

		$output .= $markup_social_share;

		$output .= '</span>';

		if( $popup ) {
			$output .= '<a class="social-buttons__toggle" href="#"><i class="fa fa-share"></i></a>';
		}

		$output .= '</span>';
	}

	if( ! $show ) {
		return $output;
	}

	echo ( $output );


}

/**
 * Fallback when menu location is not checked
 * Callback function in wp_nav_menu() on header.php
 *
 * @since 1.0
 */
function penci_menu_fallback() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_page_menu();
	} else {
		echo '<ul class="menu"><li class="menu-item-first"><a href="' . esc_url( home_url( '/' ) ) . 'wp-admin/nav-menus.php?action=locations">' . esc_html__( 'Create or select a menu','pennews' ) . '</a></li></ul>';
	}
}

/**
 * Show icon post format
 *
 * @param bool $show
 * class : lager-size-icon, medium-size-icon,small-size-icon
 *
 * @return string
 */
function penci_icon_post_format( $show = true, $class = '' ) {
	$icon = '';

	$class = $class ? 'icon-post-format ' . $class : 'icon-post-format';
	switch ( get_post_format() ) {
		case 'video':
			$icon = 'play';
			$class  .= ' penci-playvideo';
			break;
		case 'audio':
			$icon = 'music';
			break;
		case 'gallery':
			$icon = 'picture-o';
			break;
		case 'link':
			$icon = 'link';
			break;
		case 'quote':
			$icon = 'quote-left';
			break;
	}

	if( empty( $icon ) ) {
		return '';
	}

	$output = '<span class="' . $class . '"><i class="fa fa-' . $icon . '"></i></span>';

	if( ! $show ) {
		return $output;
	}

	echo ( $output );
}

if ( ! function_exists( 'penci_get_class_post_format' ) ) {
	function penci_get_class_post_format( $style_slider,$count ) {

		$class = 'lager-size-icon';

		if ( 'style-3' == $style_slider && $count > 1 ) {
			$class = 'medium-size-icon';
		}elseif ( 'style-6' == $style_slider  ) {
			$class = 'medium-size-icon';
		}elseif ( 'style-7' == $style_slider && ( 2 == $count || 3 ==  $count  ) ) {
			$class = 'medium-size-icon';
		}elseif ( 'style-8' == $style_slider && $count > 1 ) {
			$class = 'medium-size-icon';
		}elseif ( 'style-9' == $style_slider ) {
			$class = 'medium-size-icon icon_pos_right';
		}elseif ( 'style-11' == $style_slider && $count != 3 ) {
			$class = 'medium-size-icon';
		}elseif ( 'style-15' == $style_slider ) {
			$class = 'medium-size-icon';
		}elseif ( 'style-16' == $style_slider && $count > 1 ) {
			$class = 'medium-size-icon';
		}elseif ( 'style-19' == $style_slider && $count > 1 ) {
			$class = 'medium-size-icon';
		}elseif ( 'style-21' == $style_slider ) {
			$class = 'medium-size-icon';
		}elseif ( 'style-22' == $style_slider ) {
			$class = 'medium-size-icon';
		}elseif ( 'style-24' == $style_slider ) {
			$class = 'medium-size-icon';
		}elseif ( 'style-25' == $style_slider ) {
			$class = 'medium-size-icon';
		}elseif ( 'style-26' == $style_slider ) {
			if( ( 4 == $count || 3 ==  $count  ) ) {
				$class = 'medium-size-icon';
			}

			if( ( $count >  1  ) ) {
				$class = ' icon_pos_right';
			}

		}

		return $class;
	}
}


/**
 * Comments template
 *
 * @since 1.0
 * @return void
 */
if ( ! function_exists( 'penci_comments_template' ) ) {
	function penci_comments_template( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;

		$author_img = get_avatar( $comment, $args['avatar_size'] );

		$attr_date = 'datetime="' . get_comment_time( 'Y-m-d\TH:i:sP' ) . '"';
		$attr_date .= 'title="' . get_comment_time( 'l, F j, Y, g:i a' ) . '"';
		$attr_date .= 'itemprop="commentTime"';

		?>
		<div <?php comment_class(); ?> id="comment-<?php comment_ID() ?>" itemprop="" itemscope="itemscope" itemtype="http://schema.org/UserComments">
		 <meta itemprop="discusses" content="<?php echo esc_attr( get_the_title() ); ?>"/>
         <link itemprop="url" href="#comment-<?php comment_ID() ?>">
		<div class="thecomment">
			<?php if( $author_img ): ?>
			<div class="author-img">
				<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
			</div>
			<?php endif; ?>
			<div class="comment-text">
				<span class="author"  itemprop="creator" itemtype="http://schema.org/Person"><span itemprop="name"><?php echo get_comment_author_link(); ?></span></span>
				<span class="date" <?php echo ( $attr_date ); ?>><i class="fa fa-clock-o"></i><?php printf( __( '%1$s at %2$s','pennews' ), get_comment_date( '', $comment ), get_comment_time() ); ?></span>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><i class="icon-info-sign"></i> <?php echo ( penci_get_tran_setting( 'penci_comment_awaiting_approval' ) ); ?></em>
				<?php endif; ?>
				<div class="comment-content" itemprop="commentText"><?php comment_text(); ?></div>
				<span class="reply">
						<?php comment_reply_link( array_merge( $args, array(
							'reply_text' => penci_get_tran_setting( 'penci_comment_reply_text' ),
							'depth'      => $depth,
							'max_depth'  => $args['max_depth']
						) ), $comment->comment_ID ); ?>
						<?php edit_comment_link( penci_get_tran_setting( 'penci_comment_edit_comment' ) ); ?>
					</span>
			</div>
		</div>
		<?php
	}
}

/**
 * Retrieves the next posts page link.
 *
 * @global int      $paged
 * @global WP_Query $wp_query
 *
 * @param string $label    Content for link text.
 * @param int    $max_page Optional. Max pages. Default 0.
 *
 * @return string|void HTML-formatted next posts page link.
 */
function penci_get_next_posts_link( $label = null, $max_page = 0 ) {
	global $paged, $wp_query;

	if ( !$max_page )
		{$max_page = $wp_query->max_num_pages;}

	if ( !$paged )
		{$paged = 1;}

	$nextpage = intval($paged) + 1;

	if ( null === $label )
		{$label = esc_html__( 'Next Page &raquo;','pennews' );}

	$class = 'penci-ajax-more-button';

	//Filters the anchor tag attributes for the next posts page link.
	$attr = apply_filters( 'next_posts_link_attributes', 'data-mes="'. penci_get_tran_setting( 'penci_content_no_more_post_text' ) . '"' );

	if ( $nextpage <= $max_page ) {

		$link = next_posts( $max_page, false );

		if( isset( $_GET['post_style'] ) ) {
			$link = add_query_arg( 'post_style', $_GET['post_style'], $link );
		}

		if( isset( $_GET['post_layout'] ) ) {
			$link = add_query_arg( 'post_layout', $_GET['post_layout'], $link );
		}
	}
	else {
		$link = '#';
		$class .= ' no-post';
	}

	return '<a  class="' . esc_attr( $class ) . '" href="' . esc_url( $link ) . "\" $attr><span class='ajax-more-text'>" . preg_replace('/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', $label) . '</span><span class="ajaxdot"></span><i class="fa fa-refresh"></i></a>';
}

/**
 * Displays a paginated navigation to next/previous set of posts, when applicable.
 */
function penci_posts_pagination( $page = '' ) {

	$type_infinite = penci_get_theme_mod( 'penci_blog_pagination' ) ? penci_get_theme_mod( 'penci_blog_pagination' ) : 'default';
	$pos           = penci_get_theme_mod( 'penci_blog_pag_pos' ) ? penci_get_theme_mod( 'penci_blog_pag_pos' ) : 'left';
	$num_load      = penci_get_theme_mod( 'penci_number_load_more' ) ? penci_get_theme_mod( 'penci_number_load_more' ) : 6;

	$type_infinite = penci_convert_to_custom_option_tax( 'penci_pag', $type_infinite );
	$pos           = penci_convert_to_custom_option_tax( 'penci__pag_pos', $pos );
	$num_load      = penci_convert_to_custom_option_tax( 'penci_number_lmore', $num_load );


	$handle_text   = penci_get_tran_setting( 'penci_click_handle_text' );


	if( 'block_pagination' == $page ) {
		$type_infinite = penci_get_theme_mod('penci_block_pag_pagination' ) ? penci_get_theme_mod('penci_block_pag_pagination' ) : 'default';
		$pos           = penci_get_theme_mod('penci_block_pag_pos' ) ? penci_get_theme_mod('penci_block_pag_pos' ) : 'left';
		$num_load      = penci_get_theme_mod( 'penci_block_pag_number_load_more' ) ? penci_get_theme_mod( 'penci_block_pag_number_load_more' ) : 6;
	}

	$pos = $pos ? 'penci-pag-' . $pos : '';
	if ( 'default' == $type_infinite && get_the_posts_pagination() ):
		echo '<div class="penci-pagination ' . $pos . '">';

		$pagination_args = array(
			'prev_text' => '<i class="fa fa-angle-left"></i>',
			'next_text' => '<i class="fa fa-angle-right"></i>',
		);
		$pagination_filter = apply_filters( 'penci_posts_pagination_args', $pagination_args );
		the_posts_pagination( $pagination_filter );
		echo '</div>';
	elseif ( 'default' != $type_infinite ):
		?>
		<div id="penci-infinite-handle" class="penci-pagination penci-ajax-more <?php echo esc_attr( $type_infinite . ' ' . $pos ); ?>">
		<?php
		$data_archive_type = '';
		$data_archive_value = '';

		if ( is_category() ) :
			$category = get_category( get_query_var( 'cat' ) );
			$cat_id = isset( $category->cat_ID ) ? $category->cat_ID : '';
			$data_archive_type = 'cat';
			$data_archive_value = $cat_id;
		elseif ( is_tag() ) :
			$tag = get_queried_object();
			$tag_id = isset( $tag->term_id ) ? $tag->term_id : '';
			$data_archive_type = 'tag';
			$data_archive_value = $tag_id;
		elseif ( is_day() ) :
			$data_archive_type = 'day';
			$data_archive_value = get_the_date( 'm|d|Y' );
		elseif ( is_month() ) :
			$data_archive_type = 'month';
			$data_archive_value = get_the_date( 'm|d|Y' );
		elseif ( is_year() ) :
			$data_archive_type = 'year';
			$data_archive_value = get_the_date( 'm|d|Y' );
		endif;

		$template = '';
		if ( is_home() ) {
			$template = 'home';
			$cat_layout_style = penci_get_setting( 'penci_home_layout_style' );
		} elseif ( is_category() ) {
			$template = 'category';
			$cat_layout_style = penci_get_taxomony_layout_style( 'category' );
		}else{
			$cat_layout_style = penci_get_taxomony_layout_style( 'tag' );
		}

		if ( in_array( $cat_layout_style, array( 'blog-standard', 'blog-classic', 'blog-overlay' ) ) ) {
			$template = 'classis';
		}

		$offset_number = get_option('posts_per_page');

		printf('<a class="penci-ajax-more-button" data-page="%s" data-template="%s" data-layoutstyle="%s" data-mes="%s" data-number="%s" data-offset="%s" data-archivetype="%s" data-archivevalue="%s">
				<span class="ajax-more-text">%s</span><span class="ajaxdot"></span><i class="fa fa-refresh"></i>
			</a>',
			esc_attr( $page ),
			esc_attr( $template ),
			esc_attr( $cat_layout_style ),
			penci_get_tran_setting( 'penci_content_no_more_post_text' ),
			esc_attr( intval( $num_load ) ),
			esc_attr(intval( $offset_number ) ),
			esc_attr( $data_archive_type ),
			esc_attr( $data_archive_value ),
			( $handle_text )
		);
		?>
	</div>
	<?php
	endif;

}

/**
 * Functions callback when more posts clicked
 *
 */
add_action('wp_ajax_nopriv_penci_more_post_ajax', 'penci_more_post_ajax_func');
add_action('wp_ajax_penci_more_post_ajax', 'penci_more_post_ajax_func');
function penci_more_post_ajax_func() {

	$nonce = $_POST['nonce'];
	if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ){
		die ( 'Nope!' );
	}

	$ppp      = isset( $_POST["ppp"] ) ? $_POST["ppp"] : 4;
	$offset   = isset( $_POST['offset'] ) ? $_POST['offset'] : 0;
	$archivetype    = isset( $_POST['archivetype'] )  ? $_POST['archivetype'] : '';
	$archivevalue   = isset( $_POST['archivevalue'] )  ? $_POST['archivevalue'] : '';
	$page        = isset( $_POST['page'] )  ? $_POST['page'] : '';
	$template   = isset( $_POST['template'] )  ? $_POST['template'] : '';
	$layout_style  = isset( $_POST['layoutstyle'] )  ? $_POST['layoutstyle'] : '';


	$args = array(
		'post_status'    	=> 'publish',
		'posts_per_page'   => $ppp,
		'offset'          => $offset
	);

	if( 'cat' == $archivetype ){
		$args['cat'] = $archivevalue;
	}elseif( 'tag' == $archivetype ){
		$args['tag_id'] = $archivevalue;
	}elseif ( 'day' == $archivetype ) {
			$date_arr = explode( '|', $archivevalue );
			$args['date_query'] = array(
				array(
					'year'  => isset( $date_arr[2] ) ? $date_arr[2] : '',
					'month' => isset( $date_arr[0] ) ? $date_arr[0] : '',
					'day'   => isset( $date_arr[1] ) ? $date_arr[1] : ''
				)
			);
		}
	elseif ( 'month' == $archivetype ) {
		$date_arr = explode( '|', $archivevalue );
		$args['date_query'] = array(
			array(
				'year'  => isset( $date_arr[2] ) ? $date_arr[2] : '',
				'month' => isset( $date_arr[0] ) ? $date_arr[0] : '',
			)
		);
	}
	elseif ( 'year' == $archivetype ) {
		$date_arr = explode( '|', $archivevalue );
		$args['date_query'] = array(
			array(
				'year'  => isset( $date_arr[2] ) ? $date_arr[2] : ''
			)
		);
	}

	$args = apply_filters( 'penci_args_support_polylang', $args );

	$loop = new WP_Query( $args );

	global $wp_query;
	$wp_query->queried_object =  get_term( $archivevalue, $template );

	ob_start();
	if ( $loop->have_posts() ) :  while ( $loop->have_posts() ) : $loop->the_post();

		if ( 'classis' == $template ) {
			set_query_var( 'penci_acsb_layout_style', $layout_style );
		}

		if( 'block_pagination' == $page ) {
			get_template_part( 'template-parts/content', 'block-pagination' );
		}else{
			$template = $template ? $template : get_post_format();
			get_template_part( 'template-parts/content', $template );
		}

	endwhile;
	endif;
	$wp_query->queried_object =  null;
	$items = ob_get_contents();
	ob_clean();
	ob_end_clean();
	wp_reset_postdata();

	wp_send_json_success( $items );
}


/**
* Gets the menus that where made by the user in wp-admin
 */
function penci_get_user_created_menus() {
	$menus_array = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

	$list_menu = array( '' => esc_html__( '-- No Menu --', 'pennews' ) );

	if ( ! is_array( $menus_array ) ) {
	    return $list_menu;
	}


	foreach ( $menus_array as $td_menu ) {
	    $menu_id = isset( $td_menu->term_id ) ? $td_menu->term_id : '';
	    $menu_name = isset( $td_menu->name ) ? $td_menu->name : '';

	    if( empty( $menu_id ) ) {
	        continue;
	    }

	    $list_menu[ $menu_id ] = $menu_name;

	}
    return $list_menu;
}


/**
 * Get list of terms.
 *
 * @param string $taxonomy
 *
 * @return array
 */
function penci_get_category( $taxonomy = 'category' ) {
	$terms   = get_terms( array(
		'taxonomy'   => $taxonomy,
		'hide_empty' => true,
	) );
	$options = array( '' => esc_html__( '-- All categories --', 'pennews' ) );
	if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
		foreach ( $terms as $term ) {
			$options[ $term->term_id ] = $term->name;
		}
	}

	return $options;
}


/**
* @param $new_value
* @param $key_option
 *
* @return bool
 */
function penci_option_changed( $new_value, $key_option ) {
	return ( $new_value && $new_value != penci_default_setting( $key_option ) );
}

/**
 * Pagination numbers
 *
 * @since 1.0
 * @return void
 */
if ( ! function_exists( 'penci_pagination_numbers' ) ) {
	function penci_pagination_numbers( $custom_query = false, $pagenavi_align = '' ) {
		global $wp_query;
		if ( !$custom_query ) {$custom_query = $wp_query;}

		$paged_get = 'paged';
		if( is_front_page() && ! is_home() ):
			$paged_get = 'page';
		endif;

		$big = 999999999; // need an unlikely integer
		$pagination = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var( $paged_get ) ),
			'total' => $custom_query->max_num_pages,
			'type'   => 'list',
			'prev_text'    => '<i class="fa fa-angle-left"></i>',
			'next_text'    => '<i class="fa fa-angle-right"></i>',
		) );

		if( ! $pagenavi_align ) {
			$pagenavi_align = penci_get_theme_mod( 'penci_blog_pag_pos' ) ? penci_get_theme_mod( 'penci_blog_pag_pos' ) : 'left';
		}

		if ( $pagination ) {
			return '<div class="penci-pagination align-'. esc_attr( $pagenavi_align ) .'">'. $pagination . '</div>';
		}
	}
}

/**
 * Get count footer columns
* @return int|string
 */
function penci_count_footer_col() {
	$footer_col =  penci_get_setting( 'penci_footer_col' );

	$count = '';
	if ( 'style-1' == $footer_col ) {
		$count = 1;
	} elseif ( in_array( $footer_col, array( 'style-2', 'style-5', 'style-6', 'style-7', 'style-8' ) ) ) {
		$count = 2;
	} elseif ( in_array( $footer_col, array( 'style-3', 'style-9', 'style-10', 'style-11' ) ) ) {
		$count = 3;
	} elseif ( 'style-4' == $footer_col ) {
		$count = 4;
	}

	return $count;
}


/**
 * Display post thumbnail. Use featured image first and fallback to first image in the post content
 *
 * @param array $args
 *
 * @return bool
 */
function penci_post_thumbnail( $args = array() )
{
	$args = wp_parse_args( $args, array(
		'post'   => get_the_ID(),
		'size'   => 'thumbnail',
		'before' => '',
		'after'  => '',
		'icon_format' => true,
		'echo'   => true,
	) );

	$url   = '';
	$image = '';

	// Get post thumbnail
	if ( has_post_thumbnail( $args['post'] ) ) {
		$image = get_the_post_thumbnail( $args['post'], $args['size'] );
	}

	$image = apply_filters( 'penci_post_thumbnail', $image, $args );

	$output =  $args['before'] . $image . $args['after'];

	if ( ! $args['echo'] ) {
		return $output;
	}

	echo ( $output );
}

add_filter( 'penci_post_thumbnail','penci_add_default_image', 10,2 );
function penci_add_default_image( $image, $args ) {
	if( ! empty( $image ) || ! class_exists( 'Penci_Framework_Helper' ) ) {
		return $image;
	}

	$w_img = $h_img = '';
	if(  class_exists( 'Penci_Framework_Helper' ) ) {
		$image_size_info = Penci_Framework_Helper::get_image_sizes( $args['size'] );
		$w_img = $image_size_info['width'];
		$h_img = $image_size_info['height'];
	}

	$image = '<img width="' . esc_attr( $w_img ) . '" height="' . esc_attr( $h_img ) . '" src="' . get_template_directory_uri() . '/images/no-image.jpg" alt="Image default"/>';
	
	return $image;
}
/**
 * Get class header with header width
 *
 * @param bool $echo
 *
 * @return mixed|string|void
 */
function penci_get_class_header_width( $echo = true ) {
	$header_width = penci_get_setting( 'penci_header_width' );
	$class = '';
	if ( '1080' == $header_width ) {
		$class = 'penci-container-1080';
	}if ( '1170' == $header_width ) {
		$class = 'penci-container-1170';
	}elseif ( '1400' == $header_width ) {
		$class = 'penci-container-fluid';
	}elseif ( 'fullwidth' == $header_width ) {
		$class = 'penci-container-full';
	}



	if( empty( $class ) ) {
		if( 'header_s1' == penci_get_setting( 'penci_header_layout' ) ){
			$class = 'penci-container-full';
		}else{
			$class = 'penci-container-fluid';
		}
	}

	$class =  apply_filters( 'penci_get_class_header_width', $class );

	if(  ! $echo  ) {
		return $class;
	}

	echo ( $class );
}

/**
 * Get class footer with footer width
 *
 * @param bool $echo
 *
 * @return mixed|string|void
 */
function penci_get_class_footer_width( $echo = true ) {
	$footer_width = penci_get_setting( 'penci_footer_width' );
	$class = 'footer__sidebars-inner penci-container-fluid';
	if ( '1080' == $footer_width ) {
		$class = 'footer__sidebars-inner penci-container-1080';
	}if ( '1170' == $footer_width ) {
		$class = 'footer__sidebars-inner penci-container-1170';
	}elseif ( 'fullwidth' == $footer_width ) {
		$class = 'penci-container-full';
	}

	$class =  apply_filters( 'penci_get_class_footer_width', $class );

	if(  ! $echo  ) {
		return $class;
	}

	echo ( $class );
}


/**
 * Convert hex color to RGB
 *
 * @param $color
 * @param int $opacity
 *
 * @return string
 */

if( ! function_exists( 'penci_convert_hex_rgb' ) ) {
	function penci_convert_hex_rgb( $color, $opacity = 1 ) {

		if ( empty( $color ) ) {
			$color = '#000000';
		}

		list( $r, $g, $b ) = sscanf( $color, "#%02x%02x%02x" );

		return sprintf( 'rgba(%s, %s, %s, %s)', $r, $g, $b, $opacity );
	}
}

/**
 * Find youtube Link in PHP string and Convert it into embed code
 *
 * @param $video
 *
 * @return mixed
 */
if( ! function_exists( 'penci_get_url_video_embed_code' ) ) {

	function penci_get_url_video_embed_code( $video ) {
		return  preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<i" . "frame width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></i" . "frame>", $video );
	}
}

if( !function_exists( 'penci_get_markup_infeed_ad' ) ) {
	function penci_get_markup_infeed_ad( $args ) {

		$defaults = array(
			'before'     => '<div class="penci-infeed_ad penci-post-item">',
			'after'      => '</div>',
			'order_ad'   => 3,
			'order_post' => '',
			'code'       => '',
			'echo'       => false
		);

		$r = wp_parse_args( $args, $defaults );


		$before = $after = $order_ad = $order_post = $code = '';
		extract( $r );

		if ( $order_ad != $order_post || empty( $code ) ) {
			return;
		}

		$output = $before;
		$output .= $code;
		$output .= $after;

		if ( ! $r['echo'] ) {
			return $output;
		}

		echo ( $output );
	}
}

/**
 * Return google adsense markup
 *
 * @since 3.2
 */
if ( ! function_exists( 'penci_render_google_adsense' ) ) {
	function penci_render_google_adsense( $option, $echo = true ) {
		if( ! penci_get_theme_mod( $option ) ){
			return '';
		}

		$ad = '<div class="penci-google-adsense '. $option .'">'. do_shortcode( penci_get_theme_mod( $option ) ) .'</div>';
		if( ! $echo  ) {
			return $ad;
		}

		echo ( $ad );
	}
}

if ( ! function_exists( 'penci_add_more_span_cat_count' ) ) {
	add_filter( 'wp_list_categories', 'penci_add_more_span_cat_count' );
	function penci_add_more_span_cat_count( $links ) {

		$links = preg_replace( '/<\/a> \(([0-9]+)\)/', ' <span class="category-item-count">(\\1)</span></a>', $links );

		return $links;
	}
}

function penci_pennews_login_form( $args = array() ) {
	$defaults = array(
		'echo' => true,
		'remember' => true,
		'value_username' => '',
		'value_remember' => false,
	);

	if( function_exists( 'penci_get_server_value' ) ) {
		$defaults['redirect'] = ( is_ssl() ? 'https://' : 'http://' ) . penci_get_server_value('HTTP_HOST') . penci_get_server_value('REQUEST_URI');
	}

	$args = wp_parse_args( $args, apply_filters( 'login_form_defaults', $defaults ) );
	$login_form_top = apply_filters( 'login_form_top', '', $args );
	$login_form_middle = apply_filters( 'login_form_middle', '', $args );
	$login_form_bottom = apply_filters( 'login_form_bottom', '', $args );

	$form = '
		<form name="loginform" class="penci-login-form" action="' . esc_url( site_url( 'wp-login.php', 'login_post' ) ) . '" method="post">
			' . $login_form_top . '
			<p class="login-username">
				<input type="text" name="log" class="input" value="' . esc_attr( $args['value_username'] ) . '"  size="20"  placeholder="' . penci_get_tran_setting( 'penci_plogin_email_place' ) . '"/>
			</p>
			<p class="login-password">
				<input type="password" name="pwd" class="input" value="" size="20" placeholder="'. penci_get_tran_setting( 'penci_plogin_pass_place' ) .'"/>
			</p>
			' . $login_form_middle . '
			' . ( $args['remember'] ? '<p class="login-remember"><label><input name="rememberme" type="checkbox" value="forever"' . ( $args['value_remember'] ? ' checked="checked"' : '' ) . ' /> ' .  penci_get_tran_setting( 'penci_plogin_label_remember' ) . '</label></p>' : '' ) . '
			<p class="login-submit">
				<input type="submit" name="wp-submit" class="button button-primary" value="' . esc_attr( penci_get_tran_setting( 'penci_plogin_label_log_in' ) ) . '" />
				<input type="hidden" name="redirect_to" value="' . esc_url( $args['redirect'] ) . '" />
			</p>
			' . $login_form_bottom . '
		</form>';

	if ( $args['echo'] )
		{echo ( $form );}
	else
		{return ( $form );}
}

if( ! function_exists( 'penci_get_data_height_nav' ) ) {

	function penci_get_data_height_nav(){
		$dataheight = 80;

		if( 'header_s7' == penci_get_theme_mod( 'penci_header_layout' ) ) {
			$dataheight = 100;
		}elseif( 'header_s11' == penci_get_theme_mod( 'penci_header_layout' ) ) {
			$dataheight = 110;
		}

		$datacustom = penci_get_theme_mod( 'penci_main_menu_line_height' );
		if( $datacustom && $datacustom > 35 ) {
			$dataheight = $datacustom + 20;
		}
		if( penci_get_theme_mod( 'penci_hide_header_sticky' ) ) {
			$dataheight = 20;
		}
		if( is_user_logged_in() ) {
			$dataheight = $dataheight  + 32;
		}

		return intval( $dataheight );
	}
}

if( ! function_exists( 'penci_get_schema_header' ) ) {

	function penci_get_schema_header(){
		echo 'itemscope="itemscope" itemtype="http://schema.org/WPHeader"';
	}
}



add_filter( 'get_custom_logo', 'penci_pennews_filter_logo' );
if( ! function_exists( 'penci_pennews_filter_logo' ) ) {
		function penci_pennews_filter_logo() {
	    $html = '';
		$switched_blog = false;

		if ( is_multisite() && ! empty( $blog_id ) && (int) $blog_id !== get_current_blog_id() ) {
			switch_to_blog( $blog_id );
			$switched_blog = true;
		}

		$custom_logo_id = penci_get_theme_mod( 'custom_logo' );

		// We have a logo. Logo is go.
		if ( $custom_logo_id ) {
			$custom_logo_attr = array(
				'class'    => 'custom-logo',
				'itemprop' => 'image',
			);

			/*
			 * If the logo alt attribute is empty, get the site title and explicitly
			 * pass it to the attributes used by wp_get_attachment_image().
			 */
			$image_alt = get_post_meta( $custom_logo_id, '_wp_attachment_image_alt', true );
			if ( empty( $image_alt ) ) {
				$custom_logo_attr['alt'] = get_bloginfo( 'name', 'display' );
			}

			/*
			 * If the alt attribute is not empty, there's no need to explicitly pass
			 * it because wp_get_attachment_image() already adds the alt attribute.
			 */
			$html = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url">%2$s</a>',
				esc_url( penci_home_url() ),
				wp_get_attachment_image( $custom_logo_id, 'full', false, $custom_logo_attr )
			);
		}

		// If no logo is set but we're in the Customizer, leave a placeholder (needed for the live preview).
		elseif ( is_customize_preview() ) {
			$html = sprintf( '<a href="%1$s" class="custom-logo-link" style="display:none;"><img class="custom-logo"/></a>',
				esc_url( penci_home_url() )
			);
		}

		if ( $switched_blog ) {
			restore_current_blog();
		}

		return $html;
	}
}


add_action( 'wp_head','penci_custom_code_inside_head_tag',10 );

if( ! function_exists( 'penci_custom_code_inside_head_tag' ) ) {
	function penci_custom_code_inside_head_tag() {
		if( penci_get_theme_mod( 'penci_custom_code_inside_head_tag' ) ){
			echo do_shortcode( penci_get_theme_mod( 'penci_custom_code_inside_head_tag' ) );
		}
	}
}
if( ! function_exists( 'penci_get_featured_image_size' ) ) {
	function penci_get_featured_image_size( $id, $size = 'full', $notdefault = false ) {
		$src = '';
		if( get_theme_mod( 'penci_regen_thumbvideo' ) ) {
			$post_format = get_post_format();

			if( 'video' == $post_format ) {
				$_video_thumb_id = get_post_meta($id, '_video_thumb_id', true );

				if( ! $_video_thumb_id || ! has_post_thumbnail( $id ) ) {
					$video = get_post_meta( $id, '_format_video_embed', true );
					$src = Penci_Video_Format::get_thumb_url( $video, $size );
				}
			}
			if( $src ) {
				return $src;
			}

		}

		$image_html = get_the_post_thumbnail( $id, $size );
		preg_match( '@src="([^"]+)"@', $image_html, $match );
		$src = array_pop( $match );
		$src_check = substr( $src, -4 );

		if( $src_check == '.gif' ){
			$image_full = get_the_post_thumbnail( $id, 'full' );
		    preg_match( '@src="([^"]+)"@', $image_full, $match_full );
		    $src = array_pop( $match_full );
	    }

	    if( get_theme_mod( 'penci_use_fpost_featured_img' ) ){

			$post = get_post( $id );
			preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );

			if ( isset( $matches[1][0] ) && $matches[1][0] ) {
				$src = $matches[1][0];
			}
	    }

		if( $notdefault ) {
			return $src;
		}


		if ( empty( $src ) ) {
			$src   = get_template_directory_uri()  . '/images/no-thumb.jpg';
		}

		return $src;
	}
}

if( ! function_exists( 'penci_pennews_get_video_size' ) ) {
	function penci_pennews_get_video_size( $size ) {

		switch ( $size ) {
		    case 'penci-thumb-760-570':
		    case 'penci-thumb-1920-auto':
		    case 'penci-thumb-960-auto':
		    case 'penci-thumb-auto-400':
		    case 'penci-masonry-thumb':
		        $video_size = 'maxresdefault.jpg';
		        break;
		    case 'penci-thumb-480-645':
		    case 'penci-thumb-480-480':
		    case 'penci-thumb-480-320':
		        $video_size = 'sddefault.jpg';
		        break;

		    default:
		        $video_size = 'sddefault.jpg';
		}

		return $video_size;
	}
}


if( ! function_exists( 'penci_pennews_get_youtube_link' ) ) {
	function penci_pennews_get_youtube_link( $link ) {
		$return = $link;
		$values = '';

		if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $link, $id)) {
			$values = $id[1];
		} else if (preg_match('/youtube\.com\/embed\/([^"]+)\?/', $link, $id)) {
			$values = $id[1];
		} else if (preg_match('/youtube\.com\/embed\/([^"]+)"/', $link, $id)) {
			$values = $id[1];
		} else if (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $link, $id)) {
			$values = $id[1];
		} else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $link, $id)) {
			$values = $id[1];
		}else if (preg_match('/youtube\.com\/verify_age\?next_url=\/watch%3Fv%3D([^\&\?\/]+)/', $link, $id)) {
			$values = $id[1];
		}elseif (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $link, $id) ) {
			$values = $id[1];
		}

		if( $values ){
			$return = 'https://www.youtube.com/watch?v=' . $values;
		}

		return $return;
	}
}

if( ! function_exists( 'penci_check_page_title_show' ) ) {
	function penci_check_page_title_show( ){

		$pheader_show = '';
		if( is_page() ){
			$pheader_show     = penci_get_theme_mod( 'penci_pheader_show' );
		}elseif( is_single() ){
			$pheader_show     = penci_get_theme_mod( 'penci_pheader_single_show' );
		}

		$pre_pheader_show = get_post_meta( get_the_ID(), 'penci_pheader_show', true );
		if ( $pre_pheader_show ) {
			if ( 'enable' == $pre_pheader_show ) {
				$pheader_show = 1;
			} elseif ( 'disable' == $pre_pheader_show ) {
				$pheader_show = 0;
			}
		}

		return $pheader_show;
	}
}

if (!function_exists('penci_get_option')) {
    function penci_get_option($key = null, $default = false)
    {
        static $data;

        $data = get_option('penci_pennews_options');

        if ($key === null) {
            return $data;
        }

        if (isset($data[$key])) {
            return $data[$key];
        }

        return get_option($key, $default);
    }
}

if (!function_exists('penci_update_option')) {
    function penci_update_option($data)
    {
        $old = penci_get_option();

        $data = array_merge( (array)$old, (array) $data);

        update_option('penci_pennews_options', $data);
    }
}


if (!function_exists('penci_get_theme_mod')) {
    function penci_get_theme_mod($name, $default = false)
    {
        static $mods;

        $mods = empty($mods) ? get_theme_mods() : $mods;

        if (isset($mods[$name])) {
            return apply_filters("theme_mod_{$name}", $mods[$name]);
        }

        if (is_string($default)) {
            $default = sprintf($default, get_template_directory_uri(), get_stylesheet_directory_uri());
        }

        return apply_filters("theme_mod_{$name}", $default);
    }
}

/**
 * Add schedules intervals
 *
 * @since  2.5.1
 *
 * @param  array $schedules
 *
 * @return array
 */
add_filter('cron_schedules', 'penci_add_schedules_intervals');
if (!function_exists('penci_add_schedules_intervals')) {
    function penci_add_schedules_intervals($schedules)
    {


        $schedules['weekly'] = array(
            'interval' => 5,
            'display'  => __('Weekly', 'pennews')
        );

        $schedules['monthly'] = array(
            'interval' => 2635200,
            'display'  => __('Monthly', 'pennews')
		);
		
		$schedules['yearly'] = array(
            'interval' => 31536000,
            'display'  => __('Yearly', 'pennews')
        );


        return $schedules;
    }
}

/**
 * Add scheduled event during theme activation
 *
 * @since  2.5.1
 * @return void
 */
// add_action('after_switch_theme', 'penci_add_schedule_events');
add_action('init', 'penci_add_schedule_events');

if (!function_exists('penci_add_schedule_events')) {

    function penci_add_schedule_events()
    {
        if ( ! get_option('penci_flag_cron')) {
            update_option('penci_flag_cron', 1);

            if (!wp_next_scheduled('penci_reset_track_data_weekly')) {
                wp_schedule_event(time(), 'weekly', 'penci_reset_track_data_weekly');
            }

            if (!wp_next_scheduled('penci_reset_track_data_monthly')) {
                wp_schedule_event(time(), 'monthly', 'penci_reset_track_data_monthly');
            }

            if (!wp_next_scheduled('penci_reset_track_data_yearly')) {
                wp_schedule_event(time(), 'yearly', 'penci_reset_track_data_yearly');
            }
        }
    }
}

/**
 * Remove scheduled events when theme deactived
 *
 * @since  2.5.1
 * @return void
 */
add_action('switch_theme', 'penci_remove_schedule_events');
if (!function_exists('penci_remove_schedule_events')) {
    function penci_remove_schedule_events()
    {
        wp_clear_scheduled_hook('penci_reset_track_data_weekly');
        wp_clear_scheduled_hook('penci_reset_track_data_monthly');
        wp_clear_scheduled_hook('penci_reset_track_data_yearly');
    }
}

add_action('penci_reset_track_data_weekly', 'penci_reset_week_view');
if (!function_exists('penci_reset_week_view')) {
    function penci_reset_week_view()
    {
       	penci_cron_reset_view('_count-views_week');
    }
}

add_action('penci_reset_track_data_monthly', 'penci_reset_month_view');
if (!function_exists('penci_reset_month_view')) {
    function penci_reset_month_view()
    {
		penci_cron_reset_view('_count-views_month');
    }
}


add_action('penci_reset_track_data_yearly', 'penci_reset_year_view');
if (!function_exists('penci_reset_year_view')) {
    function penci_reset_year_view()
    {
		penci_cron_reset_view('_count-views_year');
    }
}

if ( ! function_exists('penci_cron_reset_view')) {
	function penci_cron_reset_view($meta_key) {
		global $wpdb;
		$wpdb->query($wpdb->prepare("UPDATE $wpdb->postmeta SET meta_value = '0' WHERE meta_key = %s", $meta_key));
	}
}

if ( ! function_exists('penci_get_schema_markup')) {
	function penci_get_schema_markup( $show = false ) {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$output = '<div class="penci-schema-markup">';
		$output .= '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>';

		$output .= sprintf( $time_string,
			get_the_date( DATE_W3C ),
			get_the_time( get_option('date_format') ),
			get_the_modified_date( DATE_W3C ),
			get_the_modified_date()
		);

		$output .= '</div>';

		if( ! $show ) {
			return ( $output );
		}

		echo ( $output );
	}
}

if( ! function_exists( 'penci_check_lazyload_type' ) ) {
	function penci_check_lazyload_type( $type = 'class', $thumb_url = null, $show = true ){
		$disable_lazyload = penci_get_theme_mod( 'penci_disable_lazyload' );
		$output = '';
		if( $disable_lazyload ) {
			if( 'class' == $type ) {
				$output = ' penci-disable-lazy';
			}elseif ( 'src' == $type && $thumb_url ) {
				$output = ' style="background-image: url(' . $thumb_url . ');"';
			}
		}else{
			if( 'class' == $type ) {
				$output = ' penci-lazy';
			}elseif ( 'src' == $type ) {
				$output = ' data-src="' . $thumb_url . '"';
			}
		}

		if( ! $show ){
			return $output;
		}

		echo ( $output );
	}
}

if( ! function_exists( 'penci_get_multiple_comments' ) ){
	function penci_get_multiple_comments(){
		$multiple_comment = array( );

		$penci_comment_wordpress = penci_get_setting( 'penci_comment_wordpress' );

		if( $penci_comment_wordpress ) {
			$multiple_comment['wordpress'] = esc_html__( 'Comments','pennews' );
		}
		if( penci_get_theme_mod( 'penci_comment_facebook' ) ) {
			$multiple_comment['facebook'] = esc_html__( 'Facebook comments','pennews' );;
		}


		return $multiple_comment;
	}
}

if( ! function_exists( 'penci_get_option_blog_layout' ) ){
	function penci_get_option_blog_layout(){
		return array(
			'blog-default'       => array( 'url' => '%s/images/layout/thumb-text.png', 'label' => esc_html__( 'Default', 'pennews' ) ),
			'blog-grid'          => array( 'url' => '%s/images/layout/2-columns.png', 'label' => esc_html__( 'Grid', 'pennews' ) ),
			'blog-boxed'         => array( 'url' => '%s/images/layout/thumb-text-2.png', 'label' => esc_html__( 'Boxed', 'pennews' ) ),
			'blog-standard'      => array( 'url' => '%s/images/layout/blog-standard.png', 'label' => esc_html__( 'Standard', 'pennews' ) ),
			'blog-classic'       => array( 'url' => '%s/images/layout/blog-classic.png', 'label' => esc_html__( 'Classic', 'pennews' ) ),
			'blog-overlay'       => array( 'url' => '%s/images/layout/blog-overlay.png', 'label' => esc_html__( 'Overlay', 'pennews' ) ),
		);
	}
}

if( ! function_exists( 'penci_get_term_id' ) ){
	function penci_get_term_id(){
		$term = get_queried_object();
		return isset( $term->term_id ) ? $term->term_id : '';
	}
}

if( ! function_exists( 'penci_convert_to_custom_option_tax' ) ){
	function penci_convert_to_custom_option_tax( $key = null, $value ){
		$term_id = penci_get_term_id();

		if( is_category() || is_tag() ) {
			$tax_user_op = get_term_meta( $term_id, 'penci_use_opt_current', true );
			$ct_value  = get_term_meta( $term_id, $key, true );

			if ( $tax_user_op && $ct_value ) {
				$value = $ct_value;
			}
		}

		return $value;
	}
}

if( ! function_exists( 'penci_get_taxomony_layout_style' ) ){
	function penci_get_taxomony_layout_style( $taxomony ){
		$term_id = penci_get_term_id();
		$layout = '';

		if( 'category' == $taxomony ) {
			$layout = penci_get_setting( 'penci_cat_layout_style' );
		}elseif( 'tag' == $taxomony ) {
			$layout = penci_get_setting( 'penci_archive_layout_style' );
		}

		if( 'category' == $taxomony || 'tag' == $taxomony ) {
			$tax_user_op = get_term_meta( $term_id, 'penci_use_opt_current', true );
			$ct_layout  = get_term_meta( $term_id, 'penci_layout_style', true );
			if ( $tax_user_op && $ct_layout ) {
				$layout = $ct_layout;
			}
		}

		return $layout;
	}
}

if( ! function_exists( 'penci_single_optimize_featured_img_size' ) ) {
	function penci_single_optimize_featured_img_size( $style = null , $size = 'penci-thumb-1920-auto' ){

		$post_id            = get_the_ID();
		$sidebar_layout     = penci_get_setting( 'penci_single_sidebar_layout' );
		$use_option_current = get_post_meta( $post_id, 'penci_use_option_current_single', true );
		$pre_sidebar_layout = get_post_meta( $post_id, 'single_sidebar_pos', true );

		if( $use_option_current && $pre_sidebar_layout ) {
			$sidebar_layout = $pre_sidebar_layout;
		}

		if( 'style-1' == $style ) {
			if( 'no-sidebar' != $sidebar_layout ){
				$size = 'penci-thumb-960-auto';
			}
		}elseif( 'style-2' == $style ) {
			if( 'no-sidebar' != $sidebar_layout ){
				$size = 'penci-thumb-960-auto';
			}
		}elseif( 'style-3' == $style ) {
			if( in_array( $style, array( 'no-sidebar-wide', 'sidebar-left','sidebar-right'  ) ) ){
				$size = 'penci-thumb-960-auto';
			}
		}elseif( 'style-4' == $style ) {
			if( 'sidebar-left' == $sidebar_layout || 'sidebar-right' == $sidebar_layout ){
				$size = 'penci-thumb-960-auto';
			}
		}elseif( 'style-7' == $style ) {
			if( 'no-sidebar' != $sidebar_layout ){
				$size = 'penci-thumb-960-auto';
			}
		}elseif( 'style-10' == $style ) {
			$size = 'penci-thumb-960-auto';
		}

		return $size;
	}
}

if( ! function_exists( 'penci_logo_remove_itemprop_url' ) ) {
 function penci_logo_remove_itemprop_url( $output ) {
  $output = str_replace( array( ' itemprop="url"', ' itemprop="image"'), '', $output );

  return $output;
 }
 add_filter( 'get_custom_logo', 'penci_logo_remove_itemprop_url' );
}

if( ! function_exists( 'penci_args_support_polylang' ) ) {
	function penci_args_support_polylang( $args ) {
	if( function_exists( 'pll_current_language' ) ) {
		$args['lang'] = pll_current_language();
	}elseif ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
		global $sitepress;
		$current_lang = $sitepress->get_current_language();
		if( $current_lang ) {
			$args['lang'] = $current_lang;
		}
	}
	return $args;
	}

 add_filter( 'penci_args_support_polylang', 'penci_args_support_polylang' );
}

/**
 * Topbar menu call back
 */

if( ! function_exists( 'penci_topbar_menu_callback' ) ) {
	function penci_topbar_menu_callback() {
		$id_menu = get_theme_mod( 'penci_topbar_menu' );

		if ( ! $id_menu ) {
			echo '<div class="topbar_item topbar__menu"><ul id="menu-top-menu" class="menu"><li class="menu-item"><a href="' . esc_url( home_url('/') ) . 'wp-admin/nav-menus.php?action=locations">Create or select a menu</a></li></ul></div>';
		} else {
			wp_nav_menu( array(
				'menu' => $id_menu,
				'container_class' => 'topbar_item topbar__menu'
			) );
		}
	}
}

if( ! function_exists( 'penci_home_url' ) ) {
	function  penci_home_url(){
		$custom_logo_url = penci_get_theme_mod( 'penci_custom_url_logo' );
		if( $custom_logo_url ) {
			return $custom_logo_url;
		}
		return get_home_url( null, '/' );
	}
}

if( ! function_exists( 'penci_get_rel_noopener' ) ) {
	function  penci_get_rel_noopener(){
		if( ! get_theme_mod( 'penci_dis_noopener' ) ) {
			return ' rel="noopener"';
		}

		return '';
	}
}

if( ! function_exists( 'penci_get_comments_number' ) ){
	add_filter( 'get_comments_number','penci_get_comments_number',10,2 );
	function penci_get_comments_number($count, $post_id ){
		$num_comments = get_comments(
			array(
				'post_id' => $post_id,
				'type__not_in' => 'penci_review',
				'status' => 'approve',
				'count' => true // return only the count

			)
		);

		if( $num_comments  ){
			$count = $num_comments;
		}

		return $count;
	}
}

if( ! function_exists( 'penci_class_pos_sidebar_content' ) ){
	function penci_class_pos_sidebar_content( $echo = true  ){

        $pos_ctsidebar_mb = penci_get_setting( 'penci_general_pos_ctsidebar_mb' );
        $output = ' penci-' . $pos_ctsidebar_mb;

		if( ! $echo ){
			return $output;
		}

		echo $output;
	}
}

if( ! function_exists( 'penci_get_tags_source_via' ) ){
	function penci_get_tags_source_via(){

		if ( 'post' !== get_post_type( ) ) {
			return;
		}

        $hide_tags         = penci_get_setting( 'penci_hide_single_tag' );
		$hide_source      = penci_get_setting( 'penci_single_hide_source' );
		$hide_source_meta = get_post_meta( get_the_ID(), 'penci_single_hide_source', true );
		if ( 'yes' == $hide_source_meta ) {
			$hide_source = true;
		} elseif ( 'no' == $hide_source_meta ) {
			$hide_source = false;
		}

		$hide_via    = penci_get_setting( 'penci_single_hide_via' );
		$hide_via_meta = get_post_meta( get_the_ID(), 'penci_single_hide_via', true );
		if ( 'yes' == $hide_via_meta ) {
			$hide_via = true;
		} elseif ( 'no' == $hide_via_meta ) {
			$hide_via = false;
		}

		$source_name      = get_post_meta( get_the_ID(), 'penci_single_source', true );
		$source_url       = get_post_meta( get_the_ID(), 'penci_single_source_url', true );
		$via_name         = get_post_meta( get_the_ID(), 'penci_single_vianame', true );
		$via_url          = get_post_meta( get_the_ID(), 'penci_single_viaurl', true );

		$is_source_via = false;

		if( ! $hide_via && ! $hide_source && ! $hide_tags ){
			echo '<div class="penci-source-via-tags-wrap">';
		}


		if( ! $hide_via && $via_name ) {
			echo '<div class="penci-source-via-wrap">';
			echo '<span class="penci-source-via-label">' . penci_get_tran_setting( 'penci_single_via_text' ) . '</span>';
			echo '<a rel="nofollow" href="' . esc_url( $via_url ) . '">' . esc_html( $via_name ) . '</a>';
			echo '</div>';

			$is_source_via = true;
		}

		if( ! $hide_source && $source_name ) {
			echo '<div class="penci-source-via-wrap">';
			echo '<span class="penci-source-via-label">' . penci_get_tran_setting( 'penci_single_source_text' ) . '</span>';
			echo '<a rel="nofollow" href="' . esc_url( $source_url ) . '">' . esc_html( $source_name ) . '</a>';
			echo '</div>';

			$is_source_via = true;
		}

		if ( ! $hide_tags ) {
			 if( $is_source_via == true ){
			 	$tags_list = get_the_tag_list();
				if ( $tags_list ) {
					echo '<div class="tags-links-wrap">';
					echo '<span class="tags-links-label">' . penci_get_tran_setting( 'penci_single_tags_text' ) . '</span>';
					penci_get_tags();
					echo '</div>';
				}
			 }else{
			 	 penci_get_tags();
			 }

		}

		if( ! $hide_via && ! $hide_source && ! $hide_tags ){
			echo '</div>';
		}

	}
}

/**
 * Get image sizes.
 *
 * Retrieve available image sizes after filtering `include` and `exclude` arguments.
 */
if ( ! function_exists( 'penci_pennews_theme_list_image_sizes' ) ) {
	function penci_pennews_theme_list_image_sizes( ) {
		$wp_image_sizes = penci_pennews_get_all_image_sizes();

		$image_sizes = array( '' => esc_html__( 'Default', 'penci-framework' ) );

		foreach ( $wp_image_sizes as $size_key => $size_attributes ) {
			$control_title = ucwords( str_replace( '_', ' ', $size_key ) );
			if ( is_array( $size_attributes ) ) {
				$control_title .= sprintf( ' - %d x %d', $size_attributes['width'], $size_attributes['height'] );
			}

			$image_sizes[ $size_key ] = $control_title;
		}

		$image_sizes[ 'full' ] =  esc_html__( 'Full', 'penci-framework' );

		return $image_sizes;
	}
}

if ( ! function_exists( 'penci_pennews_get_all_image_sizes' ) ):
	function penci_pennews_get_all_image_sizes() {
		global $_wp_additional_image_sizes;

		$default_image_sizes = [ 'thumbnail', 'medium', 'medium_large', 'large' ];

		$image_sizes = [];

		foreach ( $default_image_sizes as $size ) {
			$image_sizes[ $size ] = [
				'width'  => (int) get_option( $size . '_size_w' ),
				'height' => (int) get_option( $size . '_size_h' ),
				'crop'   => (bool) get_option( $size . '_crop' ),
			];
		}

		if ( $_wp_additional_image_sizes ) {
			$image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
		}

		return $image_sizes;
	}
endif;