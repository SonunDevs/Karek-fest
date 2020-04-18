<?php
/**
 * Template Name: Boxed Layout
 * Description: Display content for the boxed layout.
 *
 */
get_header();
$paged = class_exists( 'Penci_Pagination' ) ? Penci_Pagination::get_current_paged() : 1;
if ( $paged <= 1 ) {
	?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php
			while ( have_posts() ) : the_post();

				the_content();

			endwhile; // End of the loop.
			?></main><!-- #main -->
	</div><!-- #primary -->
	<?php
} else {
	get_template_part( 'template-parts/block-pagination' );
}
?>
<?php get_footer(); ?>
