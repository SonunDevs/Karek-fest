<?php
$paged = class_exists( 'Penci_Pagination' ) ? Penci_Pagination::get_current_paged() : 1;
$cat_layout_style = penci_get_setting( 'penci_block_pag_layout_style' );
?>
<div id="primary" class="content-area penci-archive penci-block-vc-pag">
	<main id="main" class="site-main">
		<div class="penci-container">
			<div class="penci-container__content<?php penci_class_pos_sidebar_content(); ?>">
				<div class="penci-wide-content penci-sticky-content">
					<div class="theiaStickySidebar">
					<div id="penci-archive__content" class="penci-archive__content penci-layout-<?php echo esc_attr( $cat_layout_style ); ?>">

						<?php if( ! penci_get_setting( 'penci_block_pag_hide_breadcrumb' ) ): ?>
						<div class="penci_breadcrumbs">
							<span><a class="home" href="<?php echo esc_url( home_url() ); ?>"><span><?php echo penci_get_tran_setting( 'penci_breadcrumb_home_label' ); ?></span></a></span>
							<i class="fa fa-angle-right"></i>
							<span><span><?php esc_html_e( 'Page ', 'pennews' ); ?><?php echo esc_html( $paged ); ?></span></span>
						</div>
						<?php endif; ?>
						<div class="penci-archive__list_posts">
						<?php
						$content_limit = penci_get_setting( 'penci_block_pag_content_limit' );
						$default_ppp   = get_option( 'posts_per_page' );
						$option_ppp    = penci_get_theme_mod( 'penci_block_pag_post_per_page' );
						$option_ppp    = $option_ppp ? $option_ppp : $default_ppp;

						query_posts(
							array(
								'penci_vc_block_pag'  => 1,
								'ignore_sticky_posts' => 0,
								'post_status'         => 'publish',
								'paged'               => $paged,
								'posts_per_page'      => $option_ppp
							)
						);
						if ( have_posts() ) :
							while ( have_posts() ) : the_post();
								if ( in_array( $cat_layout_style, array( 'blog-standard', 'blog-classic', 'blog-overlay' ) ) ) {
									set_query_var( 'penci_acsb_layout_style', $cat_layout_style );
									get_template_part( 'template-parts/content', 'classis' );
								}else {
									get_template_part( 'template-parts/content', 'block-pagination' );
								}
							endwhile;
							penci_posts_pagination( 'block_pagination' );
						endif; ?>
						</div>
					</div>
					</div>
				</div>
				<?php
				$sidebar_right = penci_get_setting( 'penci_block_pag_custom_sidebar_right' );
				$sidebar_right = $sidebar_right ? $sidebar_right : 'sidebar-2';
				$sidebar_left  = penci_get_setting( 'penci_block_pag_custom_sidebar_left' );
				$sidebar_left  = $sidebar_left ? $sidebar_left : 'sidebar-1';

				if ( ! is_active_sidebar( $sidebar_left ) ) {
					$sidebar_left = 'sidebar-1';
				}

				if ( ! is_active_sidebar( $sidebar_right ) ) {
					$sidebar_right = 'sidebar-1';
				}

				if ( is_active_sidebar( $sidebar_left ) && penci_block_pag_check_active_sidebar( 'left' ) ) {
					echo '<aside class="widget-area widget-area-2 penci-sticky-sidebar penci-sidebar-widgets"><div class="theiaStickySidebar">';
					dynamic_sidebar( $sidebar_left );
					echo '</div></aside>';
				}

				if ( is_active_sidebar( $sidebar_right ) && penci_block_pag_check_active_sidebar( 'right' ) ) {
					echo '<aside class="widget-area widget-area-1 penci-sticky-sidebar penci-sidebar-widgets"><div class="theiaStickySidebar">';
					dynamic_sidebar( $sidebar_right );
					echo '</div></aside>';
				}
				?>
			</div>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->