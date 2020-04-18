<?php
$show_menu = penci_get_setting( 'penci_topbar_show_menu' );
if ( ! $show_menu ) {
	return;
}

wp_nav_menu( array(
	'theme_location' => 'menu-3',
	'container_class' => 'topbar_item topbar__menu',
	'fallback_cb' => 'penci_topbar_menu_callback'
) );