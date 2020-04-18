<?php
/**
 * the template for displaying archive pages.
 */

get_header(); 
get_template_part( 'template-parts/banner/content', 'banner-blog' );

?>

<section id="main-content" class="blog main-container" role="main">
	<div class="container">
		<div class="row">
    
			<div class="col-md-12">
				<?php if ( have_posts() ) : ?>
				    <div class="row">        
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'template-parts/blog/contents/content', 'speakers' ); ?>
                        <?php endwhile; ?>
                    </div>
					<?php get_template_part( 'template-parts/blog/paginations/pagination', 'style1' ); ?>
				<?php else : ?>
					<?php get_template_part( 'template-parts/blog/contents/content', 'none' ); ?>
				<?php endif; ?>
			</div><!-- .col-md-8 -->
		
		</div><!-- .row -->
	</div><!-- .container -->
</section><!-- #main-content -->

<?php get_footer(); ?>