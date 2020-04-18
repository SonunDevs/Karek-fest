<?php
$flag = false;
if( penci_get_theme_mod( 'penci_logo_trans' ) && penci__header_tran() ) {
	$flag = true;
}
?>

<div class="site-branding<?php if( $flag ): echo ' penci-logo-tenable'; endif; ?>">
	<?php if( penci_get_setting( 'penci_use_textlogo' ) && penci_get_setting( 'penci_text_logo' ) ) : ?>
		<?php if ( is_front_page() ) : ?>
			<h1 class="site-title"><a href="<?php echo esc_url( penci_home_url() ); ?>" rel="home"><?php echo penci_get_setting( 'penci_text_logo' ); ?></a></h1>
		<?php else : ?>
			<h2 class="site-title"><a href="<?php echo esc_url( penci_home_url() ); ?>" rel="home"><?php echo penci_get_setting( 'penci_text_logo' ); ?></a></h2>
		<?php endif; ?>
	<?php elseif ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>

	<?php
	$tag_h1 = 'h2';
	if ( is_front_page() || is_home() ) {
		$tag_h1 = 'h1';
	}
	?>
	<<?php echo ( $tag_h1 ); ?>><?php the_custom_logo(); ?></<?php echo ( $tag_h1 ); ?>>
		<?php
		if( $flag ) {
			echo '<a href="' . esc_url( penci_home_url() ) . '" class="penci-trans-logo">
			<img src="'. penci_get_theme_mod( 'penci_logo_trans' ) .'" class="custom-logo" alt="'. get_bloginfo( 'name' ) .'">
			</a>';
		}
		?>
	<?php endif; ?>
	<?php
	$description = penci_get_setting( 'penci_header_slogan_text' );
	if ( $description ) : ?>
		<span class="site-description"><?php echo esc_html( $description ); ?></span>
	<?php endif; ?>
</div><!-- .site-branding -->
