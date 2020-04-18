<?php if ( penci_get_setting( 'penci_auto_load_prev_post' ) ): ?>
	<div id="penci-infinite-handle" data-offset="0" data-postidCurrent="<?php the_ID(); ?>" data-postidLoaded="<?php the_ID(); ?>" class="penci-single-loadmore">
		<span class="penci-three-bounce">
			<span class="one"></span>
			<span class="two"></span>
			<span class="three"></span>
		</span>
	</div>
<?php endif; ?>