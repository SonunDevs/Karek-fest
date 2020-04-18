<?php
$class_menu = penci_get_setting( 'penci_disable_padding_menu_lever1' ) ? ' penci_disable_padding_menu' : '';
$class_menu .= penci_get_setting( 'penci_enable_line_menu_lever1' ) ? ' penci_enable_line_menu' : '';
$class_menu .= penci_get_theme_mod( 'penci_dropdown_menu_style' ) ? ' pencimn-' . penci_get_theme_mod( 'penci_dropdown_menu_style' ) : ' pencimn-slide_down';
?>
<nav id="site-navigation" class="main-navigation<?php echo esc_attr( $class_menu ); ?>" itemscope itemtype="http://schema.org/SiteNavigationElement">
	<?php
	wp_nav_menu( array(
		'container'      => '',
		'theme_location' => 'menu-1',
		'fallback_cb'    => 'penci_menu_fallback',
		'walker'         => class_exists( 'Penci_Walker_Nav_Menu' ) ? new Penci_Walker_Nav_Menu() : ''
	) );
	?>

</nav><!-- #site-navigation -->
