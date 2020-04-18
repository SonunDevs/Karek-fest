<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package PenNews
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" >
			<?php
			if ( have_posts() ) :
			
				if ( defined( 'WC_VERSION' ) && ( is_cart() || is_checkout() || is_account_page() ) ) {
					get_template_part( 'template-parts/content', 'woo-page' );
				} elseif ( defined( 'TRIBE_EVENTS_FILE' ) && tribe_is_event_query() ) {
					get_template_part( 'template-parts/content', 'event-page' );
				} else {
					get_template_part( 'template-parts/content', 'page' );
				}
			
			else :
			get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
