<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package PenNews
 */

?>
<section class="penci-no-results not-found">
	<header class="page-header">
		<h1 class="penci-page-title"><span><?php echo ( penci_get_tran_setting( 'penci_content_not_found_text' ) ); ?></span></h1>
		<div class="penci-entry-content">
			<?php
			if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
				<p><?php echo ( penci_get_tran_setting( 'penci_homepage_no_results_text' ) ); ?></p>
			<?php else : ?>

				<p><?php echo ( penci_get_tran_setting( 'penci_no_results_text' ) ); ?></p>
				<?php
				get_search_form();
			endif; ?>
		</div>
	</header><!-- .page-header -->
</section><!-- .no-results -->
