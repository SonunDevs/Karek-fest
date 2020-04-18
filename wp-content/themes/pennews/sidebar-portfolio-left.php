<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PenNews
 */

if ( function_exists( 'WC' ) && ( is_cart() || is_checkout() || is_account_page() ) ) {
	return;
}

if ( is_singular( 'portfolio' ) ) {

	$sidebar_layout = penci_get_setting( 'penci_portfolio_sidebar' );
	$pfl_single_use_option_current  = get_post_meta( get_the_ID(), 'penci_pfl_use_opt_current_page', true );
	$pre_portfolio_sidebar_layout   = get_post_meta( get_the_ID(), 'penci_pfl_sidebar_pos', true );
	if( $pfl_single_use_option_current ){
		$sidebar_layout = $pre_portfolio_sidebar_layout;
	}
}else {
	$sidebar_layout = penci_get_setting( 'penci_pfl_archive_sidebar' );
}


if ( in_array( $sidebar_layout,  array('no-sidebar','no-sidebar-wide','no-sidebar-1080','sidebar-right' ) ) ){
	return;
}

if ( ! is_active_sidebar( 'penci-portfolio-sidebar-left' ) ){

	// Load sidebar primary
	if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<aside class="widget-area widget-area-2 penci-sticky-sidebar penci-sidebar-widgets">
		<div class="theiaStickySidebar">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>
	</aside><!-- #secondary -->
	<?php return; endif;

	return;
}
?>

<aside class="widget-area widget-area-2 penci-sticky-sidebar penci-sidebar-widgets">
	<div class="theiaStickySidebar">
	<?php dynamic_sidebar( 'penci-portfolio-sidebar-left' ); ?>
	</div>
</aside><!-- #secondary -->
