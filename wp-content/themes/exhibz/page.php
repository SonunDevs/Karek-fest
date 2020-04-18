<?php
/**
 * the template for displaying all pages.
 */


get_header(); 

get_template_part( 'template-parts/banner/content', 'banner-blog' ); 

$blog_sidebar = exhibz_option('blog_sidebar',3); 

$column = ($blog_sidebar == 1 || !is_active_sidebar('sidebar-1')) ? 'col-md-12' : 'col-lg-8 col-md-12';

?>
<div id="main-content" class="main-container"  role="main">
    <div class="container">
        <div class="row">
        <?php if($blog_sidebar == 2){
				get_sidebar();
			  }  ?>
			<div class="<?php echo esc_attr($column);?>">
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="single-content">
					
						<div class="entry-content">
							<?php get_template_part( 'template-parts/blog/contents/content', 'page' ); ?>
						</div> <!-- .entry-content -->

						<footer class="entry-footer">
							<?php
							if ( is_user_logged_in() ) {
								echo '<p>';
								edit_post_link( 
									esc_html__( 'Edit', 'exhibz' ), 
									'<span class="meta-edit">', 
									'</span>'
								);
								echo '</p>';
							}
							?>
						</footer> <!-- .entry-footer -->
					</div>

					<?php comments_template(); ?>
				<?php endwhile; ?>
            </div> <!-- .col-md-8 -->

            <?php if($blog_sidebar == 3){
				get_sidebar();
			  }  ?>
        </div> <!-- .row -->
    </div> <!-- .container -->
</div> <!--#main-content -->
<?php get_footer(); ?>