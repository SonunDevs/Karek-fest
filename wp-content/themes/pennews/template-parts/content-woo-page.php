<div class="penci-container">
	<div class="penci-content-post ">
		<?php

		$page_hide_title         = penci_get_setting( 'penci_hide_page_title' );
		$page_align_title        = penci_get_setting( 'penci_page_align_post_title' );
		$page_hide_breadcrumb    = penci_get_setting( 'penci_hide_page_breadcrumb' );

		$page_id                       = get_the_ID();
		$page_use_option_current       = get_post_meta( $page_id, 'penci_use_option_current_page', true );
		$page_hide_title_pre           = get_post_meta( $page_id, 'penci_hide_page_title', true );
		$page_align_title_pre          = get_post_meta( $page_id, 'penci_page_align_post_title', true );
		$page_hide_page_breadcrumb_pre = get_post_meta( $page_id, 'penci_hide_page_breadcrumb', true );

		if ( ! empty( $page_use_option_current ) ) {

			$page_hide_title         = $page_hide_title_pre;
			$page_hide_breadcrumb    = $page_hide_page_breadcrumb_pre;
			$page_align_title        = $page_align_title_pre;
		}

		while ( have_posts() ) : the_post();

			if ( ! $page_hide_breadcrumb ) : penci_breadcrumbs( $args = '' ); endif;
			?>
			<header class="entry-header penci-entry-header">
				<?php
				if( ! $page_hide_title ) {
					the_title( '<h1 class="entry-title penci-entry-title penci-title-' . $page_align_title . '">', '</h1>' );
				}
				penci_get_schema_markup( true );
				?>
			</header><!-- .entry-header -->
			<div class="penci-entry-content entry-content">
				<?php the_content( ); ?>
			</div>
			<?php

		endwhile; // End of the loop.
		?>
	</div>
</div>



