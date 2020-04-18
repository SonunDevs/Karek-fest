<?php
$nav_show          = penci_get_theme_mod( 'penci_verttical_nav_show' );
$nav_remove_header = penci_get_theme_mod( 'penci_vertical_nav_remove_header' );

if ( ! ( $nav_show && $nav_remove_header ) ):?>
<div class="header__top header--s6">
	<div class="<?php penci_get_class_header_width( ); ?>">
		<?php get_template_part( 'template-parts/header/logo' ); ?>
	</div>
</div>
	<?php
endif;
if( ! $nav_show ): ?>
<header id="masthead" class="site-header site-header__main header--s6" data-height="<?php echo penci_get_data_height_nav(); ?>" <?php penci_get_schema_header(); ?>>
	<div class="<?php penci_get_class_header_width( ); ?> header-content__container">
		<?php get_template_part( 'template-parts/header/menu' ); ?>
		<div class="header__social-search">
			<?php if ( ! penci_get_setting( 'penci_hide_header_search' ) ): ?>

				<div class="header__search header__search_dis_bg" id="top-search">
					<a class="search-click"><i class="fa fa-search"></i></a>
					<?php get_template_part( 'template-parts/header/search-form' ); ?>
				</div>

			<?php endif; ?>
			<?php $header_cart   = penci_get_setting( 'penci_hide_header_cart' ); ?>
			<?php if ( ! $header_cart ): ?>
				<div class="header__social-media">
					<div class="header__content-social-media">
						<?php if ( function_exists( 'WC' ) && ! $header_cart ) : ?>
							<?php $count = WC()->cart->get_cart_contents_count(); ?>
							<a href="<?php echo wc_get_cart_url(); ?>" class="social-media-item cart-contents cart-icon <?php echo esc_attr( $count > 0 ? 'has-item' : '' ); ?>">
								<span class="cart-contents_wraper"><i class="fa fa-shopping-cart"></i>
								<span class="items-number"><?php echo esc_html( $count ) ?></span></span>
							</a>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>

		</div>
</header><!-- #masthead -->
<?php endif; ?>