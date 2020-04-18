<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package PenNews
 */

get_header(); ?>
<?php $cat_layout_style = penci_get_setting( 'penci_archive_layout_style' ); ?>
	<div id="primary" class="content-area penci-archive">
		<main id="main" class="site-main" >
			<div class="penci-container">
				<div class="penci-container__content<?php penci_class_pos_sidebar_content(); ?>">
					<div class="penci-wide-content penci-sticky-content">
						<div class="theiaStickySidebar">
						<div id="penci-archive__content" class="penci-archive__content penci-layout-<?php echo esc_attr( $cat_layout_style ); ?>">
							<?php
							$hide_title      = penci_get_setting( 'penci_hide_archive_title' );
							$align_title     = penci_get_setting( 'penci_archive_align_post_title' );
							$hide_breadcrumb = penci_get_setting( 'penci_hide_archive_breadcrumb' );
							?>
							<?php if( ! $hide_breadcrumb ) : penci_breadcrumbs( $args = '' );  endif; ?>
							<?php if( ! $hide_title ) : ?>
								<header class="entry-header penci-entry-header penci-archive-entry-header">
									<h1 class="page-title penci-page-title penci-title-<?php echo esc_attr( $align_title ); ?>">
										<?php echo penci_get_tran_setting( 'penci_search_title' );  ?><span> <?php echo get_search_query() ?></span>
									</h1>
								</header>
							<?php endif; ?>
							<?php penci_render_google_adsense( 'penci_archive_ad_above' ); ?>
							<div class="penci-archive__list_posts">
							<?php
							if ( have_posts() ) :
								$post_i = 1;

								while ( have_posts() ) : the_post();
									if ( in_array( $cat_layout_style, array( 'blog-standard', 'blog-classic', 'blog-overlay' ) ) ) {
										set_query_var( 'penci_acsb_layout_style', $cat_layout_style );
										get_template_part( 'template-parts/content', 'classis' );
									}else {
										get_template_part( 'template-parts/content', get_post_format() );
									}

									penci_get_markup_infeed_ad( array(
										'order_ad'   => penci_get_setting( 'penci_archive_infeedad_order' ),
										'order_post' => $post_i,
										'code'       => penci_get_setting( 'penci_archive_infeedad_code' ),
										'echo'       => true
									) );

									$post_i ++;
								endwhile;
							else :
								get_template_part( 'template-parts/content', 'none' );
							endif;
							?>
							</div>
							<?php
							penci_posts_pagination();
							penci_render_google_adsense( 'penci_archive_ad_below' );
							?>
						</div>
						</div>
					</div>
					<?php get_sidebar( 'second' ); ?>
					<?php get_sidebar(); ?>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

