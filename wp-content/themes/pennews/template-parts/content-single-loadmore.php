<?php
$single_style    = penci_get_setting( 'penci_single_template' );
$single_hide_img = penci_get_setting( 'penci_hide_single_featured_img' );
$align_title     = 'penci-title-' . penci_get_setting( 'penci_single_align_post_title' );
global $post;
$post_id = isset( $post->ID ) ? $post->ID : 0;

$post_format = get_post_format( $post_id );
$pcurrent_hide_img = get_post_meta( $post_id, 'penci_hide_featured_img', true );
$single_hide_img = ( penci_get_setting( 'penci_hide_single_featured_img' ) || $pcurrent_hide_img ) && ! in_array( $post_format, array( 'video','gallery' ) ) ? true :  false;


?>
<?php
if( 'style-6' == $single_style || 'style-7' == $single_style ) {
if ( ! $single_hide_img && penci_post_formats() ){ ?>
	<div class="entry-media penci-entry-media penci-entry-media-top penci-entry-media-loaded">
		<?php
		$thumbnail_id   = get_post_thumbnail_id( $post_id );
		$get_image_info = wp_get_attachment_image_src( $thumbnail_id, 'penci-thumb-960-auto' );
		if( isset( $get_image_info[0] ) ) {
			echo '<div class="penci-post-bg-image penci-image-holder" style="background-image: url( ' . esc_url( $get_image_info[0] ) . ' );"></div>';
		}
		?>
		<div class="entry-media__content ">
			<div class="entry-header penci-entry-header <?php echo esc_attr( $align_title ); ?>">
				<?php
				if ( ! penci_get_setting( 'penci_hide_single_category' ) ) {
					echo '<div class="penci-entry-categories">';
					penci_get_categories();
					echo '</div>';
				}
				the_title( '<h1 class="entry-title penci-entry-title">', '</h1>' );
				penci_get_schema_markup( true );
				?>

				<div class="entry-meta penci-entry-meta">
					<?php penci_posted_on(); ?>
				</div><!-- .entry-meta -->
			</div>
		</div>
	</div>
<?php }} ?>
<div class="penci-content-post penci-content-post-loaded noloaddisqus <?php echo esc_attr( ! $single_hide_img && penci_post_formats() ? '' : 'hide_featured_image' ); ?>" data-url="<?php the_permalink() ?>" data-id="<?php the_ID(); ?>" data-title="<?php get_the_guid(); ?>">
	<article <?php post_class( 'penci-single-artcontent' ); ?>>
		<?php if( 'style-6' != $single_style & 'style-7' != $single_style ): ?>
		<header class="entry-header penci-entry-header <?php echo esc_attr( $align_title ); ?>">
			<?php
			if ( ! penci_get_setting( 'penci_hide_single_category' ) ) {
				echo '<div class="penci-entry-categories">';
				penci_get_categories();
				echo '</div>';
			}
			the_title( '<h1 class="entry-title penci-entry-title ' . $align_title . '">', '</h1>' );
			penci_get_schema_markup( true );
			?>

			<div class="entry-meta penci-entry-meta">
				<?php penci_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php
			if ( ! penci_get_setting( 'penci_hide_single_social_share_top' ) ) {
				get_template_part( 'template-parts/social-share' );
			}
			?>
		</header><!-- .entry-header -->
		<?php
		if ( ! $single_hide_img && has_post_thumbnail() ) {
			echo '<div class="entry-media penci-entry-media">';
			the_post_thumbnail( 'penci-thumb-960-auto', true );
			echo '</div>';
		}
		?>
		<?php else:
			if ( ! penci_get_setting( 'penci_hide_single_social_share_top' ) ) {
				get_template_part( 'template-parts/social-share' );
			}
		endif;?>


		<div class="penci-entry-content entry-content">
			<?php
			Penci_Auto_Load_Previous_Post::the_content( sprintf(
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'pennews' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pennews' ), 'after' => '</div>', ) );
			?>
		</div><!-- .entry-content -->

		<footer class="penci-entry-footer">
			<?php
			penci_entry_footer();
			if ( ! penci_get_setting( 'penci_hide_single_tag' ) ): penci_get_tags( $post_id ); endif;

			if ( ! penci_get_setting( 'penci_hide_single_social_share_bottom' ) ) {
				get_template_part( 'template-parts/social-share' );
			}
			?>
		</footer><!-- .entry-footer -->
	</article>
	<?php
	get_template_part( 'template-parts/author-box' );
	get_template_part( 'template-parts/related_posts' );

	// If comments are open or we have at least one comment, load up the comment template.
	if ( ( comments_open() || penci_get_theme_mod( 'penci_comment_facebook' ) ) && ! penci_get_setting( 'penci_hide_single_comments' ) ) {

		$qry_current_posts = new WP_Query( array( 'p' => $post_id ) );
		while ( $qry_current_posts->have_posts() ) {
			$qry_current_posts->the_post();
		}
		wp_reset_postdata();

		$post_id = get_the_ID();
		$multiple_comment = array( );
		$has_comment_facebook = penci_get_theme_mod( 'penci_comment_facebook' );

		$penci_comment_wordpress = penci_get_setting( 'penci_comment_wordpress' );

		if( $penci_comment_wordpress && comments_open() ) {
			$multiple_comment['wordpress'] = penci_get_tran_setting( 'penci_comment_text' );
		}
		if( $has_comment_facebook ) {
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
					echo '<div class="penci-disqus"></div>';
				}else{
					Penci_Auto_Load_Previous_Post::comments_template( );
				}
				$tab_nav_content .= ob_get_clean();
			}elseif( 'facebook' == $comment_item && class_exists( 'Penci_Helper_Shortcode' ) ) {
				$tab_nav_content .= Penci_Helper_Shortcode::get_html_animation_loading();
			}

			$tab_nav_content .= '</div>';
		}

		$tab_nav_comment .= '</ul>';

		$remove_btncomment = penci_get_theme_mod( 'penci_aload_remove_btncomment' );
		if( ! $remove_btncomment ) {
			if( 1 == $count_mul_comment && $has_comment_facebook ){
				printf( '<div id="penci-comments-button-%s" class="penci-comments-button" >
					<a href="#facebook-' . $post_id . '-comment" class="button comment-but-text comment-but-text-showface" data-postid="%s"  data-type="facebook" data-postID="' . $post_id . '">%s</a>
				</div>',
					$post_id,
					$post_id,
					penci_get_tran_setting( 'penci_comment_clickto' )
				);
			}else{
				printf( '<div id="penci-comments-button-%s" class="penci-comments-button" >
					<a href="#" class="button comment-but-text" data-postid="%s">%s</a>
				</div>',
					$post_id,
					$post_id,
					penci_get_tran_setting( 'penci_comment_clickto' )
				);
			}
		}

		if( $count_mul_comment > 1 ) {
			echo '<div class="penci-mul-comments-wrapper penci-mul-comments-wrapper' . $post_id . '">';
			echo ( $tab_nav_comment );
			echo '<div class="penci-tab-content">';
		}

		echo ( $tab_nav_content );
		if( $count_mul_comment > 1 ) {
			echo '</div></div>';
		}
	}
	?>
</div>


