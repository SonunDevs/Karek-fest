<?php
/**
 * Post navigation in single post
 * Create next and prev button to next and prev posts
 *
 * @since 1.0
 */

if ( penci_get_setting( 'penci_hide_single_post_nav' ) ) {
	return;
}

$thumb = penci_get_setting( 'penci_show_single_post_nav_thumbnail' );

$prev_post = get_previous_post();
$next_post = get_next_post();
?>
<?php if ( ! empty( $prev_post ) || ! empty( $next_post ) ) : ?>
	<div class="penci-post-pagination">
		<?php if ( ! empty( $prev_post ) ) : ?>
			<div class="prev-post">
				<?php if ( has_post_thumbnail( $prev_post->ID ) && $thumb ): ?>
				<div class="penci_media_object">
					<a class="post-nav-thumb penci_mobj__img" href="<?php echo esc_url( get_the_permalink( $prev_post->ID ) ); ?>">
						<?php echo wp_kses_post( get_the_post_thumbnail( $prev_post->ID, 'thumbnail' ) ); ?>
					</a>
					<?php endif; ?>
					<div class="prev-post-inner penci_mobj__body">
						<div class="prev-post-title">
							<span><i class="fa fa-angle-left"></i><?php echo esc_html( penci_get_tran_setting( 'penci_content_pre_text' ) ); ?></span>
						</div>
						<div class="pagi-text">
							<h5 class="prev-title"><a href="<?php echo esc_url( get_the_permalink( $prev_post->ID ) ); ?>"><?php echo sanitize_text_field( get_the_title( $prev_post->ID ) ); ?></a></h5>
						</div>
					</div>
				<?php if ( has_post_thumbnail( $prev_post->ID ) && $thumb ): ?></div><?php endif; ?>

			</div>
		<?php endif; ?>

		<?php if ( ! empty( $next_post ) ) : ?>
			<div class="next-post ">
				<?php if ( has_post_thumbnail( $next_post->ID ) && $thumb ): ?>
				<div class="penci_media_object penci_mobj-image-right">
					<a class="post-nav-thumb penci_mobj__img" href="<?php echo esc_url( get_the_permalink( $next_post->ID ) ); ?>">
						<?php echo wp_kses_post( get_the_post_thumbnail( $next_post->ID, 'thumbnail' ) ); ?>
					</a>
					<?php endif; ?>
					<div class="next-post-inner">
						<div class="prev-post-title next-post-title">
							<span><?php echo esc_html( penci_get_tran_setting( 'penci_content_next_text' ) ); ?><i class="fa fa-angle-right"></i></span>
						</div>
						<div class="pagi-text">
							<h5 class="next-title"><a href="<?php echo esc_url( get_the_permalink( $next_post->ID ) ); ?>"><?php echo sanitize_text_field( get_the_title( $next_post->ID ) ); ?></a></h5>
						</div>
					</div>
				<?php if ( has_post_thumbnail( $next_post->ID ) && $thumb ): ?></div><?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>