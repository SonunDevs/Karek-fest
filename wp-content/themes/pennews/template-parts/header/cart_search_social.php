<?php

$header_social = penci_get_setting( 'penci_hide_header_social' );
$header_search = penci_get_setting( 'penci_hide_header_search' );
$header_cart   = penci_get_setting( 'penci_hide_header_cart' );
$dis_search_bg   = penci_get_setting( 'penci_dis_header_search_bg' );

if ( $header_social && $header_search ) {
	$header_layout = penci_get_setting( 'penci_header_layout' );
	if( 'header_s12' == $header_layout ){
		echo '<div class="header__social-search"></div>';
	}
	return;
}
?>
<div class="header__social-search">
	<?php
	$header_layout = penci_get_setting( 'penci_header_layout' );
	if( 'header_s12' != $header_layout ){
		get_template_part( 'template-parts/header/icon-menu-hg' );
	}
	 ?>
	<?php if ( ! $header_search ): ?>
		<div class="header__search<?php  echo esc_attr( $dis_search_bg ? ' header__search_dis_bg': '' ); ?>" id="top-search">
			<a class="search-click"><i class="fa fa-search"></i></a>
			<?php get_template_part( 'template-parts/header/search-form' ); ?>
		</div>
	<?php endif; ?>

	<?php if ( ! $header_social || ! $header_cart ): ?>
		<div class="header__social-media">
			<div class="header__content-social-media">

			<?php if ( ! $header_social) : penci_list_socail_media(); endif; ?>
			<?php if ( function_exists( 'WC' ) && ! $header_cart ) : ?>
				<?php $count = WC()->cart->get_cart_contents_count(); ?>
				<a href="<?php echo wc_get_cart_url(); ?>"
				   class="social-media-item cart-contents cart-icon <?php echo esc_attr( $count > 0 ? 'has-item' : '' ); ?>">
					<span class="cart-contents_wraper"><i class="fa fa-shopping-cart"></i>
						<span class="items-number"><?php echo esc_html( $count ) ?></span></span>
				</a>
			<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>

</div>

