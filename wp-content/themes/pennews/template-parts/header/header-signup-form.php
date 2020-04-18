<?php
/**
 * Display sign-up mailchimp form below the header
 * Check if 'header-signup-form' has widget, if true display it
 *
 * @since 2.0
 */
if ( is_active_sidebar( 'header-signup-form' ) ): ?>
	<?php
	$signup_header_width      = penci_get_theme_mod( 'penci_signup_header_width' );
	$signup_header_width      = $signup_header_width ? $signup_header_width : 'fullwidth';
	$signup_h_container_width = penci_get_theme_mod( 'penci_signup_h_container_width' );
	$signup_h_container_width = $signup_h_container_width ? $signup_h_container_width : 'penci-container-fluid';
	?>
	<div class="penci-header-signup-form penci-header-signup-form-<?php echo esc_attr( $signup_header_width ); ?>">
		<div class="penci-header-signup-inner <?php echo esc_attr( $signup_h_container_width ); ?>">
			<?php dynamic_sidebar( 'header-signup-form' ); ?>
		</div>
	</div>
<?php
endif;