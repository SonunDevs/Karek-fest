<?php
/**
 * Template Name: woocommerce Template
 *
 * The template for displaying all pages.
 */
?>

<?php get_header();

  get_template_part( 'template-parts/banner/content', 'banner-shop' ); 

?>

<div class="woo-xs-content"  role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<!-- Article content -->
						<div class="entry-content">
							<?php the_content(); ?>
						</div> <!-- end entry-content -->

						
					</article>


				<?php endwhile; ?>
            </div> <!-- end main-content -->
        </div>
    </div>
</div> 
<?php get_footer(); ?>