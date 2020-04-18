<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package PenNews
 */

$archive_layout = penci_get_setting( 'penci_block_pag_layout_style' );
$img_size       = penci_get_archive_image_type( 'penci-thumb-480-320' );
$post_class = 'penci-imgtype-' . penci_get_setting( 'penci_archive_image_type' );

$class_article_content = $entry_text =  $show_cat = '';
if ( 'blog-default' == $archive_layout || 'blog-boxed' == $archive_layout ) {
	$class_article_content = 'penci_media_object';
	$entry_text            = 'penci_mobj__body';
	$show_cat = true;
}

$post_thumb_url = penci_get_featured_image_size( get_the_ID(), $img_size );
?>

<article <?php post_class( $post_class ); ?>>

	<div class="article_content <?php echo esc_attr( $class_article_content ); ?>">
		<?php if( has_post_thumbnail() && get_the_post_thumbnail() ): ?>
		<div class="entry-media penci_mobj__img">
			<a class="penci-link-post penci-image-holder<?php penci_check_lazyload_type(); ?>" href="<?php the_permalink(); ?>"<?php penci_check_lazyload_type( 'src', $post_thumb_url ); ?>></a>
			<?php penci_icon_post_format( true,'medium-size-icon' ); ?>
			<?php
			if ( ! penci_get_setting( 'penci_block_pag_hide_post_cat' ) && 'blog-grid' == $archive_layout ) {
				penci_get_categories();
			}

			if ( ! penci_get_setting( 'penci_block_pag_hide_post_review' ) && function_exists( 'penci_display_piechart_review_html' ) ) {
				penci_display_piechart_review_html( get_the_ID(), 'normal' );
			}
			?>
		</div>
		<?php endif; ?>
		<div class="entry-text <?php echo esc_attr( $entry_text ); ?>">
			<header class="entry-header">
				<?php
				if ( ! penci_get_setting( 'penci_block_pag_hide_post_cat' ) && in_array( $archive_layout, array( 'blog-default' , 'blog-boxed' ) ) ) {
					penci_get_categories();
				}
				$sticky = is_sticky() ? '<span class="sticky-label"><i class="fa fa-thumb-tack"></i><span class="screen-reader-text">' . penci_get_tran_setting( 'penci_get_tran_setting' ) . '</span></span>  ' : '';
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $sticky, '</a></h2>' );
				penci_get_schema_markup( true );
				if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php penci_posted_on_archive( 'block_pagination' ); ?>
					</div><!-- .entry-meta -->
					<?php
				endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
				if( ! penci_get_setting( 'penci_block_pag_hide_post_description' ) ) {
					$display       = penci_get_theme_mod( 'penci_block_pag_display' );
					$content_limit = penci_get_setting( 'penci_block_pag_content_limit' );

					// Excerpt
					if ( 'more' == $display ) {
						the_content();
					} elseif ( 'content' == $display ) {
						penci_content_limit( $content_limit, '' );

						$content   = apply_filters( 'the_content', get_the_content() );
						$content   = wp_trim_words( $content, $content_limit, '' );
						echo wp_kses_post( $content );
					} else {
						penci_content_limit( $content_limit, '' );
					}
				}

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pennews' ),
					'after'  => '</div>',
				) );
				?>
			</div><!-- .entry-content -->
			<?php
			if( penci_get_theme_mod( 'penci_bpag_show_rmore_post' ) ) {
				echo penci_more_link();
			}
			?>

			<footer class="entry-footer">
				<?php penci_get_tags(); ?>
			</footer><!-- .entry-footer -->
		</div>
	</div>
</article><!-- #post-## -->
