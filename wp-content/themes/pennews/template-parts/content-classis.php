<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package PenNews
 */

$archive_layout = get_query_var( 'penci_acsb_layout_style' );

if ( ! $archive_layout ) {
	$archive_layout = penci_get_taxomony_layout_style( 'tag' );
}
$img_size   = 'penci-thumb-1920-auto';
if ( ( is_home() || is_front_page() ) && get_theme_mod( 'penci_home_img_size' ) ) {
	$img_size = get_theme_mod( 'penci_home_img_size' );
} elseif ( is_category() && get_theme_mod( 'penci_cat_img_size' ) ) {
	$img_size = get_theme_mod( 'penci_cat_img_size' );
} elseif ( is_archive() && get_theme_mod( 'penci_archive_img_size' ) ) {
	$img_size = get_theme_mod( 'penci_archive_img_size' );
}

$img_size   = penci_get_archive_image_type( $img_size );
$post_class = 'penci-imgtype-' . penci_get_setting( 'penci_archive_image_type' );
$post_class .= ' penci-post-' . $archive_layout;

$class_article_content = $entry_text = '';

?>
<article <?php post_class( $post_class ); ?>>

	<div class="article_content">
		<?php if ( 'blog-classic' == $archive_layout ){
			get_template_part( 'template-parts/content', 'classis-header' );
		} ?>
		<?php if ( has_post_thumbnail() ): ?>
			<?php if( 'blog-overlay' == $archive_layout ): ?>  <div class="penci-entry-media-header"> <?php  endif; ?>
			<div class="entry-media classic-post-image classic-post-hasimage">
				<a class="penci-link-post" href="<?php the_permalink(); ?>">
				<?php
				penci_icon_post_format( true, 'medium-size-icon' );
				if ( ! penci_get_setting( 'archive_hide_post_review' ) && function_exists( 'penci_display_piechart_review_html' ) ) {
					penci_display_piechart_review_html( get_the_ID(), 'normal' );
				}
				the_post_thumbnail( $img_size );
				?>
				</a>
			</div>
			<?php
			if ( 'blog-overlay' == $archive_layout ){
				get_template_part( 'template-parts/content', 'classis-header' );
			}
			?>
			<?php if( 'blog-overlay' == $archive_layout ): ?>  </div> <?php  endif; ?>
		<?php elseif( 'blog-overlay' == $archive_layout ): ?>
			<?php get_template_part( 'template-parts/content', 'classis-header' ); ?>
		<?php endif; ?>

		<div class="entry-text">
			<?php if ( 'blog-standard' == $archive_layout ){
				get_template_part( 'template-parts/content', 'classis-header' );
			} ?>

			<?php
			$content = penci_entry_content( false );
			if ( ! penci_get_setting( 'archive_hide_post_description' ) && $content ) {
				echo '<div class="entry-content">' . $content . '</div>';
			}

			$show_bt_rmore = penci_get_theme_mod( 'penci_show_read_more_post' );
			$show_bt_rmore = penci_convert_to_custom_option_tax( 'penci_show_rmorep', $show_bt_rmore );

			if( $show_bt_rmore ) {
				echo penci_more_link();
			}
			?>
			<footer class="entry-footer">
				<?php penci_get_tags(); ?>
			</footer><!-- .entry-footer -->
		</div>
	</div>
</article><!-- #post-## -->
