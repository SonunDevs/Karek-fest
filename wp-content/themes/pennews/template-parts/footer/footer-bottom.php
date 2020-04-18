<?php
$hide_footer_content = penci_get_theme_mod( 'penci_hide_footer_content' );

if( $hide_footer_content ) {
	return;
}

$footer_bottom_style = penci_get_setting( 'penci_footer_style' );
$footer_email        = penci_get_setting( 'penci_footer_email' );
$footer_hide_socials = penci_get_theme_mod( 'penci_hide_footer_socails' );
$footer_text         = penci_get_theme_mod( 'penci_footer_text' );
$footer_hide_logo    = penci_get_theme_mod( 'penci_hide_footer_logo' );
$footer_logo         = penci_get_theme_mod( 'penci_footer_logo' );

if ( $footer_hide_logo && $footer_hide_socials && ! $footer_text ) {
	return;
}
?>
<div class="footer__bottom <?php echo esc_attr( $footer_bottom_style ); ?>">
	<?php if ( 'style-1' == $footer_bottom_style ): ?>
		<div class="footer__bottom_container <?php penci_get_class_footer_width(); ?>">
			<?php if ( ! $footer_hide_logo ): ?>
				<div class="footer__logo">
					<?php
					if ( penci_get_theme_mod( 'penci_footer_use_textlogo' ) && penci_get_theme_mod( 'penci_footer_text_logo' ) ) {
						echo '<a href="' . esc_url( penci_home_url() ) . '" rel="home">';
						echo penci_get_theme_mod( 'penci_footer_text_logo' );
						echo '</a>';
					} elseif ( $footer_logo ) {
						echo '<a href="' . esc_url( penci_home_url() ) . '" rel="home">';
						echo '<img  src="' . esc_attr( $footer_logo ) . '" alt="logo "/>';
						echo '</a>';
					} elseif ( penci_get_setting( 'penci_use_textlogo' ) && penci_get_setting( 'penci_text_logo' ) ) {
						echo '<a href="' . esc_url( penci_home_url() ) . '" rel="home">';
						echo penci_get_setting( 'penci_text_logo' );
						echo '</a>';
					} elseif ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
						the_custom_logo();
					}
					?>
				</div>
			<?php endif; ?>
			<?php
			if ( $footer_text ) {
				echo '<div class="penci-footer-text-wrap ">';
				echo do_shortcode( wp_kses_post( $footer_text ) );

				if ( $footer_email ) {
					printf( '<div class="footer-email-wrap">%s <a href="mailto:%s">%s</a></div>',
						penci_get_tran_setting( 'penci_pfl_contactus_text' ),
						esc_attr( $footer_email ),
						esc_attr( $footer_email )
					);
				}
				echo '</div>';
			}
			?>
			<?php if ( ! $footer_hide_socials ): ?>
				<div class="footer__social-media">
					<?php penci_list_socail_media(); ?>
				</div>
			<?php endif; ?>
		</div>
	<?php else: ?>
		<?php
		$width_logo = $width_social = 'penci-col-3';
		$width_text = 'penci-col-6';


		if ( ( $footer_hide_logo && $footer_hide_socials ) ||
		     ( $footer_hide_logo && ! $footer_text ) ||
		     ( $footer_hide_socials && ! $footer_text ) ) {
			$width_text = $width_logo = $width_social = 'penci-col-12';
		} elseif ( $footer_hide_logo ) {
			$width_text   = 'penci-col-8';
			$width_social = 'penci-col-4';
		} elseif ( $footer_hide_socials ) {
			$width_logo = 'penci-col-4';
			$width_text = 'penci-col-8';
		} elseif ( ! $footer_text ) {
			$width_logo = $width_social = 'penci-col-6';
		}
		?>
		<?php if ( ! $footer_hide_logo || ! $footer_hide_socials || $footer_text ): ?>
			<div class="footer__bottom_container <?php penci_get_class_footer_width(); ?>">
					<div class="row">
						<?php if ( ! $footer_hide_logo ): ?>
							<div class="footer__bottom-item footer__logo <?php echo esc_attr( $width_logo ); ?>">
								<?php
								if ( penci_get_theme_mod( 'penci_footer_use_textlogo' ) && penci_get_theme_mod( 'penci_footer_text_logo' ) ) {
									echo '<a href="' . esc_url( penci_home_url() ) . '" rel="home">';
									echo penci_get_theme_mod( 'penci_footer_text_logo' );
									echo '</a>';
								} elseif ( $footer_logo ) {
									echo '<a href="' . esc_url( penci_home_url() ) . '" rel="home">';
									echo '<img  src="' . esc_attr( $footer_logo ) . '" alt="logo "/>';
									echo '</a>';
								} elseif ( penci_get_setting( 'penci_use_textlogo' ) && penci_get_setting( 'penci_text_logo' ) ) {
									echo '<a href="' . esc_url( penci_home_url() ) . '" rel="home">';
									echo penci_get_setting( 'penci_text_logo' );
									echo '</a>';
								} elseif ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
									the_custom_logo();
								}
								?>
							</div>
						<?php endif; ?>
						<?php if ( $footer_text ): ?>
							<div class="footer__bottom-item penci-footer-text-wrap <?php echo esc_attr( $width_text ); ?>">
								<div class="block-title"><span><?php echo penci_get_tran_setting( 'penci_footer_text_aboutus' ); ?></span></div>

								<?php
								echo '<span class="penci-footer-text-content">';
								echo do_shortcode( wp_kses_post( $footer_text ) );
								echo '</span>';

								if ( $footer_email ) {
									printf( '<div class="footer-email-wrap">%s <a href="mailto:%s">%s</a></div>',
										penci_get_tran_setting( 'penci_pfl_contactus_text' ),
										esc_attr( $footer_email ),
										esc_attr( $footer_email )
									);
								}
								?>

							</div>
						<?php endif; ?>
						<?php if ( ! $footer_hide_socials ): ?>
							<div class="footer__bottom-item footer__social-media <?php echo esc_attr( $width_social ); ?>">
								<div class="block-title"><span><?php echo penci_get_tran_setting( 'penci_footer_text_follow_us' ); ?></span></div>
								<?php penci_list_socail_media(); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
		<?php endif; ?>
	<?php endif; ?>
</div>