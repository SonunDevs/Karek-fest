<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PenNews
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php if( ! penci_get_theme_mod( 'penci_disable_reponsive' ) ): ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php endif; ?>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<style>
		a.custom-button.pencisc-button {
			background: transparent;
			color: #D3347B;
			border: 2px solid #D3347B;
			line-height: 36px;
			padding: 0 20px;
			font-size: 14px;
			font-weight: bold;
		}
		a.custom-button.pencisc-button:hover {
			background: #D3347B;
			color: #fff;
			border: 2px solid #D3347B;
		}
		a.custom-button.pencisc-button.pencisc-small {
			line-height: 28px;
			font-size: 12px;
		}
		a.custom-button.pencisc-button.pencisc-large {
			line-height: 46px;
			font-size: 18px;
		}
	</style>
</head>

<body <?php body_class(); ?>>

<?php
if ( penci_get_theme_mod( 'penci_after_body_tag' ) ) {
	echo do_shortcode( penci_get_theme_mod( 'penci_after_body_tag' ) );
}




$class_boxed = '';
if( is_page_template( 'page-templates/layout-boxed.php' ) ) {
	$class_boxed = ' penci-enable-boxed';
}elseif( ! is_page_template( 'page-templates/full-width.php' ) ) {
	if ( get_theme_mod( 'penci_body_boxed_layout' ) ) {
		$class_boxed = ' penci-enable-boxed';
	}
}
$nav_show = penci_get_theme_mod( 'penci_verttical_nav_show' );
if( $nav_show ) {
	get_template_part( 'template-parts/menu-nav' );

	 $class_boxed .= ' penci-wrapper-boxed';
}

?>
<div id="page" class="site<?php echo ( $class_boxed ); ?>">
	<?php
	$pennews_hide_header = false;
	if ( is_page() ) {
		$pennews_hide_header = get_post_meta( get_the_ID(), 'penci_hide_page_header', true );
	}

	if( ! $pennews_hide_header ):
		do_action( 'penci_header_top' );

		$header_layout = penci_get_setting( 'penci_header_layout' );
		if( 'header_s7' != $header_layout ){
			get_template_part( 'template-parts/topbar/topbar' );
		}

		$class_trans_nav = '';

		if( penci__header_tran() ){
			$class_trans_nav = ' penci-trans-nav';
		}

		echo '<div class="site-header-wrapper' . $class_trans_nav . '">';
		get_template_part( 'template-parts/header/' . penci_get_setting( 'penci_header_layout' ) );
		echo '</div>';

		if( ! $nav_show ) {
			get_template_part( 'template-parts/header/header_mobile' );
		}
		penci_render_google_adsense( 'penci_archive_ad_below_header' );
		get_template_part( 'template-parts/header/header-signup-form' );
	endif;

	get_template_part( 'template-parts/header/page-header' );
	?>
	<div id="content" class="site-content">
