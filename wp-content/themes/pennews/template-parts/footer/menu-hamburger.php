<?php
$header_layout = penci_get_theme_mod( 'penci_header_layout' );
if ( ! in_array( $header_layout, array( 'header_s12', 'header_s13' ) ) && ! penci_get_theme_mod( 'penci_menu_hbg_show' ) ) {
	return;
}

$pos = penci_get_theme_mod( 'penci_menu_hbg_pos' );
$pos = $pos ? $pos : 'left';

$show_logo = penci_get_theme_mod( 'penci_menu_hbg_show_logo' );
$show_logo = $show_logo ? $show_logo : 1;

$showsocial = penci_get_theme_mod( 'penci_menu_hbg_showsocial' );
$showsocial = $showsocial ? $showsocial : 1;

$footer_text = penci_get_theme_mod( 'penci_menu_hbg_footer_text' );

?>
<div class="penci-menu-hbg-overlay"></div>
<div class="penci-menu-hbg penci-menu-hbg-<?php echo esc_attr( $pos ); ?>">
	<div class="penci-menu-hbg-inner">
		<a id="penci-close-hbg"><i class="fa fa-close"></i></a>
		<div class="penci-hbg-header">
			<?php
			if ( $show_logo ) {
				$logo_img      = penci_get_theme_mod( 'penci_menu_hbg_logo' );
				$hbg_sitetitle = penci_get_theme_mod( 'penci_menu_hbg_sitetitle' );
				$hbg_desc      = penci_get_theme_mod( 'penci_menu_hbg_desc' );

				echo '<div class="penci-hbg-logo site-branding">';
				if ( $logo_img ) {
					echo '<a href="' . esc_url( penci_home_url() ) . '" rel="home">';
					echo '<img  src="' . esc_attr( $logo_img ) . '" alt="logo "/>';
					echo '</a>';
				} elseif ( penci_get_setting( 'penci_use_textlogo' ) && penci_get_setting( 'penci_text_logo' ) ) {
					echo '<h2 class="site-title"><a href="' . esc_url( penci_home_url() ) . '" rel="home">';
					echo penci_get_setting( 'penci_text_logo' );
					echo '</a></h2>';
				} elseif ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
					the_custom_logo();
				}
				echo '</div>';
				if ( $hbg_sitetitle ) {
					echo '<div class="penci-hbg_sitetitle">' . do_shortcode( $hbg_sitetitle ) . '</div>';
				}
				if ( $hbg_desc ) {
					echo '<div class="penci-hbg_desc">' . do_shortcode( $hbg_desc ) . '</div>';
				}
			}
			?>
		</div>
		<div class="penci-hbg-content">
			<div class="penci-menu-hbg-widgets1">
				<?php
				if ( is_active_sidebar( 'menu_hamburger_1' ) ) {
					dynamic_sidebar( 'menu_hamburger_1' );
				}
				?>
			</div>
			<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
				<nav class="menu-hamburger-navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
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
			<div class="penci-menu-hbg-widgets2">
				<?php
				if ( is_active_sidebar( 'menu_hamburger_2' ) ) {
					dynamic_sidebar( 'menu_hamburger_2' );
				}
				?>
			</div>
		</div>
		<div class="penci-hbg-footer">
			<?php
			$footer_text = penci_get_setting( 'penci_menu_hbg_footer_text' );
			if( $footer_text ){
				echo '<div class="penci_menu_hbg_ftext">';
				echo  $footer_text;
				echo '</div>';
			}
			?>
			<?php if ( $showsocial ): ?>
				<div class="penci-menu-hbg-socials">
					<?php penci_list_socail_media(); ?>
				</div>
			<?php endif; ?>

		</div>
	</div>
</div>