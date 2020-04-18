<?php
/**
 * Getting started section.
 *
 * @package pennews
 */

?>
<h2 class="nav-tab-wrapper">
	<a href="<?php echo admin_url( 'admin.php?page=pennews_dashboard_welcome' ) ?>" class="nav-tab nav-tab-active"><?php esc_html_e( 'Getting started', 'pennews' ); ?></a>
	<a href="<?php echo admin_url( 'customize.php' ) ?>" class="nav-tab"><?php esc_html_e( 'Customize Style', 'pennews' ); ?></a>
	<?php if ( !defined('ENVATO_HOSTED_SITE') ): ?>
		<a href="<?php echo admin_url( 'admin.php?page=pennews_system_status' ) ?>" class="nav-tab"><?php esc_html_e( 'System status', 'pennews' ); ?></a>
	<?php endif; ?>
	<a href="<?php echo admin_url( 'admin.php?page=pennews_custom_fonts' ) ?>" class="nav-tab"><?php esc_html_e( 'Fonts options', 'pennews' ); ?></a>
	<a href="<?php echo admin_url( 'admin.php?page=pennews_migrator' ) ?>" class="nav-tab"><?php esc_html_e( 'Migrator Data', 'pennews' ); ?></a>
	<?php if( ! penci_pennews_is_activated() ): ?>
	<a href="<?php echo admin_url( 'admin.php?page=pennews_active_theme' ) ?>" class="nav-tab"><?php esc_html_e( 'Active theme', 'pennews' ); ?></a>
	<?php endif; ?>
</h2>

<div id="getting-started" class="gt-tab-pane gt-is-active">
	<div class="feature-section two-col">
		<div class="col">
			<h3><?php esc_html_e( 'Step 1 - Install The Required Plugins', 'pennews' ); ?></h3>
			<p>
				<?php
				/* translators: theme name. */
				echo esc_html( sprintf( __( '%s needs some plugins to working properly. Please install and activate our required plugins.', 'pennews' ), $this->theme->name ) );
				?>
			</p>
			<a class="button button-primary" href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins&plugin_status=install' ) ) ?>" target="_blank"><?php esc_html_e( 'Install Plugins', 'pennews' ); ?></a>

			<h3><?php esc_html_e( 'Step 2 - Import Demo Data (Optional)', 'pennews' ); ?></h3>
			<p><?php _e( 'Based on your site, have 2 ways to help you can import demo data for the site. 
If your site has old data, please do only <strong>Way 2: Import Only customizer data</strong> like the guide <a href="http://pennews.pencidesign.com/pennews-document/#import-demo" target="_blank">here</a>. If not, click to button bellow to import full a demo.', 'pennews' );
			?></p>
			<a class="button button-primary" href="<?php echo esc_url( admin_url( 'admin.php?page=import-demo-content' ) ) ?>" target="_blank"><?php esc_html_e( 'Import Demo Now', 'pennews' ); ?></a>
			<h3><?php esc_html_e( 'Video tutorials', 'pennews' ); ?></h3>
			<p><?php echo wp_kses_post( 'We believe that the easiest way to learn is watching a video tutorial. We have a growing library of narrated video tutorials to help you do just that.' ); ?></p>
			<a class="button button-primary" href="https://www.youtube.com/watch?v=-YKgBcXE1IA&index=2&list=PL1PBMejQ2VTwTTycCaTHQ2UTLjL9V_7ZG" target="_blank"><?php esc_html_e( 'View tutorials', 'pennews' ); ?></a>

		</div>
		<div class="col">
			<h3><?php esc_html_e( 'Customize The Theme', 'pennews' ); ?></h3>
			<p><?php esc_html_e( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'pennews' ); ?></p>
			<p>
				<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Start Customize', 'pennews' ); ?></a>
			</p>
			<h3><?php esc_html_e( 'Read Full Documentation', 'pennews' ); ?></h3>
			<p class="about"><?php esc_html_e( 'Need any helps to setup and configure the theme? Please check our full documentation for detailed information on how to use it first.', 'pennews' ); ?></p>
			<p>
				<a href="<?php echo esc_url( 'http://pennews.pencidesign.com/pennews-document/' ); ?>" target="_blank" class="button button-secondary"><?php esc_html_e( 'Read Documentation', 'pennews' ); ?></a>
			</p>
		</div>
	</div>
	<hr>
	<h3 class="title-more-items"><?php esc_html_e( 'More items by PenciDesign', 'pennews' ) ?></h3>
	<div class="feature-section products three-col">
		<div class="col product">
			<a target="_blank" rel="nofollow href="<?php echo esc_url( "https://themeforest.net/item/soledad-multiconcept-blogmagazine-wp-theme/12945398?ref=PenciDesign" ) ?>" title="<?php echo esc_attr( 'Soledad' ) ?>">
				<img class="product__image" src="<?php echo esc_url( get_template_directory_uri() . '/inc/dashboard/images/soledad.jpg' ) ?>" alt="soledad" width="300" height="150">
			</a>
			<div class="product__body">
				<h3 class="product__title">
					<a target="_blank" rel="nofollow href="<?php echo esc_url( "https://themeforest.net/item/soledad-multiconcept-blogmagazine-wp-theme/12945398?ref=PenciDesign/" ) ?>" title="<?php echo esc_attr( 'Soledad' ) ?>">Soledad - Multi-Concept Blog/Magazine AMP WordPress Theme</a>
				</h3>
			</div>
		</div>
		<div class="col product">
			<a target="_blank" rel="nofollow href="<?php echo esc_url( "https://themeforest.net/item/penshop-multipurpose-ecommerce-wordpress-theme/20469533?ref=PenciDesign" ) ?>" title="<?php echo esc_attr( 'PenShop' ) ?>">
				<img class="product__image" src="<?php echo esc_url( get_template_directory_uri() . '/inc/dashboard/images/penshop.jpg' ) ?>" alt="penshop" width="300" height="150">
			</a>
			<div class="product__body">
				<h3 class="product__title">
					<a target="_blank" rel="nofollow href="<?php echo esc_url( "https://themeforest.net/item/penshop-multipurpose-ecommerce-wordpress-theme/20469533?ref=PenciDesign" ) ?>" title="<?php echo esc_attr( 'PenShop - Multi-Purpose eCommerce WordPress Theme' ) ?>">PenShop - Multi-Purpose eCommerce WordPress Theme</a>
				</h3>
			</div>
		</div>
		<div class="col product">
			<a target="_blank" rel="nofollow href="<?php echo esc_url( "https://themeforest.net/item/vancouver-multiple-layouts-wordpress-blog-theme/12180181?ref=PenciDesign" ) ?>" title="<?php echo esc_attr( 'Vancouver' ) ?>">
				<img class="product__image" src="<?php echo esc_url( get_template_directory_uri() . '/inc/dashboard/images/vancouver.jpg' ) ?>" alt="vancouver" width="300" height="150">
			</a>
			<div class="product__body">
				<h3 class="product__title">
					<a target="_blank" rel="nofollow href="<?php echo esc_url( "https://themeforest.net/item/vancouver-multiple-layouts-wordpress-blog-theme/12180181?ref=PenciDesign" ) ?>" title="<?php echo esc_attr( 'Vancouver' ) ?>">Vancouver - Multiple Layouts WordPress Blog Theme</a>
				</h3>
			</div>
		</div>

	</div>
</div>
