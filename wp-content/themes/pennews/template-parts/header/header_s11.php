<?php
$nav_show           = penci_get_theme_mod( 'penci_verttical_nav_show' );
$class_header_width = penci_get_class_header_width( false );

if ( ! $nav_show ):
	?>
	<header id="masthead" class="site-header header--s11" data-height="<?php echo penci_get_data_height_nav(); ?>" <?php penci_get_schema_header(); ?>>
		<div class="<?php penci_get_class_header_width(); ?>">
			<?php get_template_part( 'template-parts/header/logo' ); ?>
			<?php get_template_part( 'template-parts/header/cart_search_social' ); ?>
			<?php get_template_part( 'template-parts/header/menu' ); ?>
		</div>
	</header><!-- #masthead -->
<?php endif; ?>