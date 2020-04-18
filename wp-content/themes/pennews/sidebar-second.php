<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PenNews
 */

$post_id = get_the_ID();

$id_sidebar = 'sidebar-2';
if ( is_page() ) {
	$use_option_current = get_post_meta( $post_id, 'penci_use_option_current_page', true );
	$post_sidebar       = get_post_meta( $post_id, 'page_sidebar_left', true );
	if( $post_sidebar && $use_option_current ) {
		$id_sidebar = $post_sidebar;
	}else{
		$id_sidebar = penci_get_setting( 'penci_page_custom_sidebar_left' );
	}

} elseif ( is_archive() || is_home() || is_search() ) {
	$id_sidebar = penci_get_setting( 'penci_archive_custom_sidebar_left' );

	if( is_category() || is_tag() ){
		$term_id = penci_get_term_id();
		$tax_user_op = get_term_meta( $term_id, 'penci_use_opt_current', true );
		$ct_sidebar  = get_term_meta( $term_id, 'penci_ct_sidebar_left', true );
		if ( $tax_user_op && $ct_sidebar ) {
			$id_sidebar = $ct_sidebar;
		}
	}

} elseif ( is_singular() ) {
	$use_option_current = get_post_meta( $post_id, 'penci_use_option_current_single', true );
	$post_sidebar       = get_post_meta( $post_id, 'single_sidebar_left', true );

	if ( $post_sidebar && $use_option_current ) {
		$id_sidebar = $post_sidebar;
	} else {
		$id_sidebar = penci_get_setting( 'penci_single_custom_sidebar_left' );
	}
}

if ( ! penci_check_active_sidebar( 'left' ) ) {
	return;
}


$sidebars_widgets = wp_get_sidebars_widgets();

if ( ! is_active_sidebar( $id_sidebar ) ){

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
	<?php dynamic_sidebar( $id_sidebar ); ?>
	</div>
</aside><!-- #secondary -->
