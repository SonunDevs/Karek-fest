<?php
/**
 * the template for displaying all posts.
 */

get_header(); 
get_template_part( 'template-parts/banner/content', 'banner-page' );

?>
<div id="main-content" class="main-container blog-single"  role="main">
    <div class="container">
 
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="content-single">

						<div class="entry-content">
							<?php get_template_part( 'template-parts/blog/contents/content', 'single-speaker' ); ?>
	
						</div> <!-- .entry-content -->

						<footer class="entry-footer clearfix">
							<?php get_template_part( 'template-parts/blog/post-parts/part', 'tags' ); ?>

							<?php if ( is_user_logged_in() ) {  ?>

                                    <p>
										<?php
												edit_post_link( 
														esc_html__( 'Edit', 'exhibz' ), 
														'<span class="meta-edit">', 
														'</span>'
											    );
										?>   
							    	</p>
						    <?php } ?>
						</footer> <!-- .entry-footer -->

						<?php 
							// post navigation, to next post or prev post
							// location:helpers/functions/template.php
							exhibz_post_nav(); 
						?>
					</div>

					<?php comments_template(); ?>
				<?php endwhile; ?>
     
    </div> <!-- .container -->
</div> <!--#main-content -->
<?php get_footer(); ?>