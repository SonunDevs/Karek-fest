<?php
if( penci_get_setting( 'penci_hide_single_comments' ) ) {
	return;
}

if ( ( comments_open() || get_comments_number() ) ) {

	$show_comments_button = false;
	$dis_auto_load_prev =  get_post_meta( get_the_ID(), 'penci_dis_auto_load_prev', true );
	if( ! $dis_auto_load_prev ){
		$single_loadmore     = penci_get_theme_mod( 'penci_auto_load_prev_post' );
		$dis_loadmore_mobile = penci_get_theme_mod( 'penci_dis_auto_load_prev_mobile' );

		if( class_exists( 'Mobile_Detect' ) && $dis_loadmore_mobile ) {
			$penci_detect = new Mobile_Detect;
			if ( $penci_detect->isMobile() ) {
				$single_loadmore = false;
			}
		}

		if ( $single_loadmore ) {
			$show_comments_button = true;
		}
	}
	$remove_btncomment = penci_get_theme_mod( 'penci_aload_remove_btncomment' );
	if ( $show_comments_button && ! $remove_btncomment ) {
		printf( '<div id="penci-comments-button-%s" class="penci-comments-button">
					<a href="#" class="button comment-but-text" data-postid="%s">%s</a>
				</div>',
			get_the_ID(),
			get_the_ID(),
			penci_get_tran_setting( 'penci_comment_clickto' )
		);
	}
}

$post_id = get_the_ID();
$multiple_comment = array();

$penci_comment_wordpress = penci_get_setting( 'penci_comment_wordpress' );

if( $penci_comment_wordpress && ( comments_open() || get_comments_number() ) ) {
	$multiple_comment['wordpress'] = penci_get_tran_setting( 'penci_comment_text' );
}
$ur_enable     = penci_get_theme_mod( 'penci_user_review_enable' );
$penci_review  = get_post_meta( $post_id, 'penci_review', true );

$ctp_ur_enable = isset( $penci_review['penci_user_review_enable'] ) ? $penci_review['penci_user_review_enable'] : '';
if ( 'enable' == $ctp_ur_enable ) {
	$ur_enable = true;
} elseif ( 'disable' == $ctp_ur_enable ) {
	$ur_enable = false;
}

if ( $ur_enable ) {
	$multiple_comment['review'] = penci_get_tran_setting( 'penci_review_more' );
}

if( penci_get_theme_mod( 'penci_comment_facebook' ) ) {
	$multiple_comment['facebook'] = penci_get_tran_setting( 'penci_fbcomment_text' );
}

$count_mul_comment = count( (array)$multiple_comment );

$tab_nav_content = '';
$i  = 0;
$tab_nav_comment =  '<ul class="penci-tab-nav clearfix">';
foreach ( $multiple_comment as $comment_item => $comment_lable  ) {
	$i ++;
	$active_class = $i == 1 ? 'active ' : '';
	$section_load = $i == 1 ? '' : 'section_load ';

	$tab_nav_comment .= '<li class="' . $active_class . $comment_item . '-comment">';
	$tab_nav_comment .= '<a data-toggle="tab" class="penci-mcomments-label-ss" data-type="' . $comment_item . '" data-postID="' . $post_id . '" href="#' . $comment_item . '-' . $post_id . '-comment">';
	$tab_nav_comment .= $comment_lable;
	$tab_nav_comment .= '</a>';
	$tab_nav_comment .= '</li>';


	$tab_nav_content .= '<div id="' . $comment_item . '-' . $post_id . '-comment" class="' . $active_class . $section_load . 'multi-' . $comment_item . '-comment penci-tab-pane" >';


	if( 'wordpress' == $comment_item ) {
		ob_start();
		if ( class_exists( 'Disqus_Public' ) && get_option( 'disqus_render_js' ) ) {
			echo '<div class="penci-disqus">';
		}
		comments_template();
		if ( class_exists( 'Disqus_Public' ) && get_option( 'disqus_render_js' ) ) {
			echo '</div>';
		}
		$tab_nav_content .= ob_get_clean();
	}

	if( 'review' == $comment_item ) {
		ob_start();
		do_action( 'penci_pennew_review_hook' );
		$tab_nav_content .= ob_get_clean();
	}

	if( 'facebook' == $comment_item ) {

		if( $count_mul_comment == 1 ) {
			$numposts    = penci_get_theme_mod( 'penci_comment_face_number' );
			$colorscheme = penci_get_theme_mod( 'penci_comment_face_color' );
			$order_by    = penci_get_theme_mod( 'penci_comment_face_ordery' );
			$loading     = penci_get_theme_mod( 'penci_comment_face_loading' );
			?>
			<div id="penci-facebook-comments" class="penci-facebook-comments">
				<div class="fb-comments" data-href="<?php the_permalink( $post_id ); ?>"
				     data-numposts="<?php echo( $numposts ? $numposts : 5 ); ?>"
				     data-colorscheme="<?php echo( $colorscheme ? $colorscheme : 'light' ); ?>"
				     data-order-by="<?php echo( $order_by ? $order_by : 'social' ); ?>" data-width="100%"
				     data-mobile="false"><?php echo ( $loading ); ?></div>

				<?php if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { ?>
					<script> FB.XFBML.parse();</script>
				<?php } ?>
			</div>
			<?php
		}elseif( class_exists( 'Penci_Helper_Shortcode' ) ){
			$tab_nav_content .= Penci_Helper_Shortcode::get_html_animation_loading();
		}
	}

	$tab_nav_content .= '</div>';
}

$tab_nav_comment .= '</ul>';

if( $count_mul_comment > 1 ) {
	echo '<div class="penci-mul-comments-wrapper">';
	echo ( $tab_nav_comment );
	echo '<div class="penci-tab-content">';
}

echo ( $tab_nav_content );
if( $count_mul_comment > 1 ) {
	echo '</div></div>';
}
