<?php
$show_topbar = penci_get_setting( 'penci_topbar_show' );

if ( empty( $show_topbar ) ) {
	return;
}

$topbar_layout = penci_get_setting( 'penci_topbar_layout' );
$topbar_width  = penci_get_setting( 'penci_topbar_width' );
$topbar_width = empty( $topbar_width ) ? 'topbar-width-default' : $topbar_width;

?>
<div class="penci-topbar clearfix <?php echo esc_attr( $topbar_layout ); ?>">
	<div class="penci-topbar_container <?php echo esc_attr( $topbar_width ); ?>">

		<?php if ( 'style-3' == $topbar_layout || 'style-1' == $topbar_layout ): ?>
			<div class="penci-topbar__left">
				<?php
				get_template_part( 'template-parts/topbar/weather' );
				get_template_part( 'template-parts/topbar/date' );
				get_template_part( 'template-parts/topbar/login' );
				get_template_part( 'template-parts/topbar/menu' );
				get_template_part( 'template-parts/topbar/trending' );
				?>
			</div>
			<div class="penci-topbar__right">
				<?php get_template_part( 'template-parts/topbar/socials' ); ?>

			</div>
		<?php else: ?>
			<div class="penci-topbar__left">
				<?php get_template_part( 'template-parts/topbar/socials' ); ?>
			</div>
			<div class="penci-topbar__right">
				<?php
				get_template_part( 'template-parts/topbar/weather' );
				get_template_part( 'template-parts/topbar/date' );
				get_template_part( 'template-parts/topbar/login' );
				get_template_part( 'template-parts/topbar/menu' );
				get_template_part( 'template-parts/topbar/trending' );
				?>
			</div>
		<?php endif; ?>
	</div>
</div>
