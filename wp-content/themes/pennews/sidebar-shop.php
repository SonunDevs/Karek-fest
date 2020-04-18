<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PenNews
 */

if ( ! is_active_sidebar( 'penci-shop-sidebar' ) ) {
	return;
}
if ( function_exists( 'WC' ) && ( is_cart() || is_checkout() || is_account_page() ) ) {
	return;
}
$sidebar_layout = penci_get_setting( is_singular() ? 'penci_woo_sidebar_product' : 'penci_woo_sidebar_shop' );
if (  'no-sidebar' == $sidebar_layout ) {
	return;
}
?>
<aside class="widget-area widget-area-1 penci-sticky-sidebar penci-sidebar-widgets">
	<div class="theiaStickySidebar">
	<?php dynamic_sidebar( 'penci-shop-sidebar' ); ?>
	</div>
</aside><!-- #secondary -->
