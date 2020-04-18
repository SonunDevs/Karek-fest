<?php
$nav_show          = penci_get_theme_mod( 'penci_verttical_nav_show' );
$nav_remove_header = penci_get_theme_mod( 'penci_vertical_nav_remove_header' );

if ( ! $nav_show ) { ?>
	<header id="masthead" class="site-header header--s7" data-height="<?php echo penci_get_data_height_nav(); ?>" <?php penci_get_schema_header(); ?>>
		<div class="<?php penci_get_class_header_width(); ?> header-content__container">
			<?php get_template_part( 'template-parts/header/logo' ); ?>
			<?php get_template_part( 'template-parts/header/menu' ); ?>
			<?php get_template_part( 'template-parts/header/cart_search_social' ); ?>
		</div>
	</header>
	<?php
}

if ( ! ( $nav_show && $nav_remove_header ) ) {

	$show_topbar = penci_get_setting( 'penci_topbar_show' );
	if ( $show_topbar ) {

		$topbar_layout = penci_get_setting( 'penci_topbar_layout' );
		$topbar_width  = penci_get_setting( 'penci_topbar_width' );
		?>
		<div class="penci-topbar header--s7 clearfix <?php echo esc_attr( $topbar_layout ); ?>">
			<div class="penci-topbar_container <?php if ( $topbar_width ) {
				echo esc_attr( $topbar_width );
			} else {
				penci_get_class_header_width();
			} ?>">

				<?php if ( 'style-3' == $topbar_layout || 'style-1' == $topbar_layout ): ?>
					<div class="penci-topbar__left">
						<?php
						get_template_part( 'template-parts/topbar/weather' );
						get_template_part( 'template-parts/topbar/date' );
						get_template_part( 'template-parts/topbar/login' );
						get_template_part( 'template-parts/topbar/menu' );
						get_template_part( 'template-parts/topbar/trending' );
						?>
					</div>
					<div class="penci-topbar__right">
						<?php get_template_part( 'template-parts/topbar/socials' ); ?>

					</div>
				<?php else: ?>
					<div class="penci-topbar__left">
						<?php get_template_part( 'template-parts/topbar/socials' ); ?>
					</div>
					<div class="penci-topbar__right">
						<?php
						get_template_part( 'template-parts/topbar/weather' );
						get_template_part( 'template-parts/topbar/date' );
						get_template_part( 'template-parts/topbar/login' );
						get_template_part( 'template-parts/topbar/menu' );
						get_template_part( 'template-parts/topbar/trending' );
						?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php } ?>
	<div class="header__bottom header--s7">
		<div class="<?php echo penci_get_class_header_width(); ?>">
			<?php get_template_part( 'template-parts/header/banner' ); ?>
		</div>
	</div>
<?php } ?>