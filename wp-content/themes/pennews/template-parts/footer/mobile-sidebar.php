<aside class="mobile-sidebar <?php echo penci_get_theme_mod( 'penci_mobile_style' ); ?>">

	<?php if ( ! penci_get_theme_mod( 'hide_mobile_nav_logo' ) ) : ?>
		<div id="sidebar-nav-logo">
			<?php if ( penci_get_setting( 'penci_use_textlogo' ) && penci_get_setting( 'penci_text_logo_mobile_nav' ) ) {
				?>
				<a href="<?php echo esc_url( penci_home_url() ); ?>" rel="home"><?php echo penci_get_setting( 'penci_text_logo_mobile_nav' ); ?></a>
				<?php
			} elseif ( penci_get_setting( 'penci_use_textlogo' ) && penci_get_setting( 'penci_text_logo' ) ) {
				?>
				<a href="<?php echo esc_url( penci_home_url() ); ?>" rel="home"><?php echo penci_get_setting( 'penci_text_logo' ); ?></a>
				<?php
			} else {
				if ( penci_get_theme_mod( 'mobile_nav_logo' ) ) : ?>
					<a href="<?php echo esc_url( penci_home_url() ); ?>"><img src="<?php echo esc_url( penci_get_setting( 'mobile_nav_logo' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
				<?php elseif ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php endif;
			}
			?>
		</div>
	<?php endif; ?>
	<?php if( ! penci_get_theme_mod( 'penci_hide_socail_mobile' ) ): ?>
		<div class="header-social sidebar-nav-social">
			<div class="inner-header-social">
				<?php penci_list_socail_media(); ?>
			</div>
		</div>
	<?php endif; ?>
	<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
		<nav class="mobile-navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
			<?php
			// Menu id use check on mega menu
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'container'      => '',
				'menu_id'        => 'primary-menu-mobile',
				'menu_class'     => 'primary-menu-mobile',
			) );
			?>
		</nav>
	<?php endif; ?>
</aside>
<a id="close-sidebar-nav" class="header-1"><i class="fa fa-close"></i></a>
