<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PenNews
 */

if ( ! class_exists( 'Tribe__Events__Main' ) ) {
	return;
}

if ( is_singular( 'tribe_events' ) ) {
	$sidebar_layout = penci_get_setting( 'penci_event_single_sidebar' );
} elseif ( is_post_type_archive( 'tribe_events' ) ) {
	$sidebar_layout = penci_get_setting( 'penci_event_sidebar' );
}


if ( ! in_array( $sidebar_layout,  array( 'sidebar-right','sidebar-left' ) ) ){
	return;
}

if ( ! is_active_sidebar( 'penci-event' ) ){

	// Load sidebar primary
	if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<aside class="widget-area widget-area-1 penci-sticky-sidebar penci-sidebar-widgets">
		<div class="theiaStickySidebar">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>
	</aside><!-- #secondary -->
	<?php return; endif;

	return;
}
?>

<aside class="widget-area widget-area-1 penci-sticky-sidebar penci-sidebar-widgets">
	<div class="theiaStickySidebar">
	<?php dynamic_sidebar( 'penci-event' ); ?>
	</div>
</aside><!-- #secondary -->
