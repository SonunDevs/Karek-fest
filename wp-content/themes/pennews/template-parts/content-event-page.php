<div class="penci-container">
	<div class="penci-container__content penci-archive-event__content">
		<div class="penci-wide-content penci-content-novc penci-sticky-content">
			<div class="theiaStickySidebar">
			<?php
			while ( have_posts() ) : the_post();
				?>
				<div class="penci-content-post">
					<div class="penci-entry-content entry-content">
						<?php the_content(); ?>
					</div>
				</div>
				<?php
			endwhile;
			?>
			</div>
		</div>
		<?php get_sidebar( 'event' ); ?>
	</div>
</div>