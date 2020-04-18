<div class="penci-entry-content entry-content">
	<?php
	penci_render_google_adsense( 'penci_single_ad_before_content' );
	the_content( sprintf(
		wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'pennews' ), array( 'span' => array( 'class' => array() ) ) ),
		the_title( '<span class="screen-reader-text">"', '"</span>', false )
	) );

	wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pennews' ), 'after' => '</div>', ) );
	penci_render_google_adsense( 'penci_single_ad_after_content' );
	?>
</div><!-- .entry-content -->