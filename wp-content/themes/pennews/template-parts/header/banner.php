<?php
$adsense_code  = penci_get_theme_mod( 'penci_custom_code_banner_header' );


$header_img = penci_get_setting( 'penci_header_img' );
$header_img_link = penci_get_setting( 'penci_header_img_link' );

if( $adsense_code ): ?>
	<div class="header__banner">
		<?php echo do_shortcode( $adsense_code ); ?>
	</div>
<?php elseif( $header_img ) : ?>
	<div class="header__banner" itemscope="" itemtype="https://schema.org/WPAdBlock" data-type="image">
		<a href="<?php echo ( $header_img_link ? esc_url( $header_img_link ) : '#' ); ?>" target="_blank" itemprop="url">
			<img src="<?php echo esc_url( $header_img ); ?>" alt="<?php esc_html_e( 'Banner','pennews' ); ?>">
		</a>
	</div>
<?php endif; ?>

