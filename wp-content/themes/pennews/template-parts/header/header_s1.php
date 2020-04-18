<?php
$nav_show = penci_get_theme_mod( 'penci_verttical_nav_show' );
if( $nav_show ) {
	return;
}
?>
<?php $class_header_width = penci_get_class_header_width( false ); ?>
<header id="masthead" class="site-header header--s1" data-height="<?php echo penci_get_data_height_nav(); ?>" <?php penci_get_schema_header(); ?>>
	<div class="<?php echo penci_get_class_header_width(); ?> header-content__container">
	<?php get_template_part( 'template-parts/header/logo' ); ?>
	<?php get_template_part( 'template-parts/header/menu' ); ?>
	<?php get_template_part( 'template-parts/header/cart_search_social' ); ?>
	</div>
</header><!-- #masthead -->
