<?php
$footer_copyright    = penci_get_setting( 'penci_footer_copyright' );
?>
<div class="footer__copyright_menu">
	<?php if ( $footer_copyright || has_nav_menu( 'menu-2' )  ): ?>
		<div class="<?php penci_get_class_footer_width(); ?> penci_bottom-sub<?php echo( $footer_copyright ? ' penci_has_copyright' : '' ); ?><?php echo( has_nav_menu( 'menu-2' ) ? ' penci_has_menu' : '' ); ?>">
			<div class="site-info">
				<?php echo do_shortcode( wp_kses_post( $footer_copyright ) ); ?>
			</div><!-- .site-info -->
			<?php
			if ( has_nav_menu( 'menu-2' ) ) {
				wp_nav_menu( array(
					'theme_location'  => 'menu-2',
					'container_class' => 'sub-footer-menu'
				) );
			}
			?>
		</div>
	<?php endif; ?>
</div>