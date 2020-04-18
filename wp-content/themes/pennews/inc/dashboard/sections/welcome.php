<?php
/**
 * Welcome section.
 *
 * @package pennews
 */

$pennews_theme = wp_get_theme();
?>
<h1>
	<?php
	// Translators: %1$s - Theme name, %2$s - Theme version.
	echo esc_html( sprintf( __( 'Welcome to %1$s - Version %2$s', 'pennews' ), $pennews_theme->name, $pennews_theme->version ) );
	?>
</h1>
<div class="about-text"><?php echo esc_html( "Thank you for purchasing our theme!
Interested in keeping up to date with PenciDesign's future projects and releases.
Thanks so much!" ); ?>
	
<?php
$admin_wel_page_text = penci_get_theme_mod( 'admin_wel_page_text' );
if( $admin_wel_page_text ) {
	echo do_shortcode( wpautop( $admin_wel_page_text ) );
}
?>	
</div>
<a target="_blank" href="<?php echo esc_url( 'http://pennews.pencidesign.com/' ); ?>" class="wp-badge">PenciDesign</a>
