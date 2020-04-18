<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link    https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package PenNews
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" >
			<div class="penci-container-fluid">
				<section class="error-404 not-found">
					<header class="page-header">
						<div class="error-404__image">
							<?php
							if ( $error_img = penci_get_setting( 'penci_404_image' ) ) {
								printf( '<img src="%s" alt="error-404"/>', esc_url( $error_img ) );
							}
							?>
						</div>
						<h1 class="page-title"><?php echo wp_kses_post( penci_get_setting( 'penci_404_heading' ) ); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">
						<p><?php echo wp_kses_post( penci_get_setting( 'penci_404_sub_heading' ) ); ?></p>

						<?php
						if ( ! penci_get_setting( 'penci_404_hide_search' ) ) {
							get_search_form();
						}
						?>
					</div><!-- .page-content -->
				</section><!-- .error-404 -->
				
				<?php do_action( 'penci_page_404_after' ); ?>
				
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
