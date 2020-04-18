<?php
$nav_show          = penci_get_theme_mod( 'penci_verttical_nav_show' );
$nav_remove_header = penci_get_theme_mod( 'penci_vertical_nav_remove_header' );

if( ! $nav_show ): ?>
<header id="masthead" class="site-header header--s3 header--s4" data-height="<?php echo penci_get_data_height_nav(); ?>" <?php penci_get_schema_header(); ?>>
	<div class="<?php penci_get_class_header_width( ); ?>">
		<?php get_template_part( 'template-parts/header/menu' ); ?>
		<?php get_template_part( 'template-parts/header/cart_search_social' ); ?>
	</div>
</header><!-- #masthead -->
<?php
endif;
if ( ! ( $nav_show && $nav_remove_header ) ):
?>
<div class="header__top header--s3">
	<div class="<?php penci_get_class_header_width( ); ?> header-content__container">
		<?php get_template_part( 'template-parts/header/logo' ); ?>
	</div>
</div>
<?php endif; ?>