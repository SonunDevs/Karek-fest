<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PenNews
 */

?>
	</div><!-- #content -->
<?php

$pennews_hide_footer = false;
if ( is_page() ) {
	$pennews_hide_footer = get_post_meta( get_the_ID(), 'penci_hide_page_footer', true );
}
if( ! $pennews_hide_footer ){

if ( is_active_sidebar( 'footer-signup-form' ) ){
	dynamic_sidebar( 'footer-signup-form' );
}
?>
<?php penci_render_google_adsense( 'penci_general_ad_above_footer' ); ?>
	<footer id="colophon" class="site-footer" itemscope itemtype="http://schema.org/WPFooter">
		<meta itemprop="name" content="Webpage footer for <?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"/>
		<meta itemprop="description" content="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>"/>
		<meta itemprop="keywords" content="Data Protection, Copyright Data"/>
		<meta itemprop="copyrightYear" content="<?php echo date("Y"); ?>"/>
		<meta itemprop="copyrightHolder" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"/>
		<?php
		if( class_exists( 'Penci_Global_Blocks' ) ) {
			Penci_Global_Blocks::set_is_row( false );
		}
		?>
		<?php get_template_part( 'template-parts/footer/footer-sidebars' ); ?>
		<?php get_sidebar( 'instagram' ); ?>
		<?php get_template_part( 'template-parts/footer/footer-bottom' ); ?>
		<?php get_template_part( 'template-parts/footer/footer-copyright' ); ?>
	</footer><!-- #colophon -->
<?php } ?>
</div><!-- #page -->

<?php
get_template_part( 'template-parts/footer/mobile-sidebar' );
$nav_show = penci_get_theme_mod( 'penci_verttical_nav_show' );
if( ! $nav_show ) {
	get_template_part( 'template-parts/footer/menu-hamburger' );
}
?>
<?php if ( ! penci_get_theme_mod( 'penci_go_to_top' ) ) : ?>
	<a href="#" id="scroll-to-top"><i class="fa fa-angle-up"></i></a>
<?php endif; ?>
<?php
$gprd_desc       = penci_get_setting( 'penci_gprd_desc' );
$gprd_accept     = penci_get_setting( 'penci_gprd_btn_accept' );
$gprd_rmore      = penci_get_setting( 'penci_gprd_rmore' );
$gprd_rmore_link = penci_get_setting( 'penci_gprd_rmore_link' );
$penci_gprd_text = penci_get_setting( 'penci_gprd_policy_text' );
if( penci_get_theme_mod( 'penci_enable_cookie_law' ) && $gprd_desc && $gprd_accept && $gprd_rmore ) :
?>
	<div class="penci-wrap-gprd-law penci-wrap-gprd-law-close">
		<div class="penci-gprd-law">
			<p>
				<?php if( $gprd_desc ): echo ( $gprd_desc ); endif; ?>
				<?php if( $gprd_accept ): echo '<a class="penci-gprd-accept" href="#">'. $gprd_accept .'</a>'; endif; ?>
				<?php if( $gprd_rmore ): echo '<a class="penci-gprd-more" href="'. $gprd_rmore_link .'">'. $gprd_rmore .'</a>'; endif; ?>
			</p>
		</div>
		<?php if( ! penci_get_theme_mod( 'penci_show_cookie_law' ) ): ?>
		<a class="penci-gdrd-show" href="#"><?php echo ( $penci_gprd_text ); ?></a>
		<?php endif; ?>
	</div>

<?php endif; ?>
<?php wp_footer(); ?>
<?php
if( penci_get_theme_mod('penci_footer_analytics') ){
	echo penci_get_theme_mod('penci_footer_analytics');
}
?>
</body>
</html>
