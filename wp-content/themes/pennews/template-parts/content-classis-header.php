<header class="entry-header">
	<?php
	if ( ! penci_get_setting( 'archive_hide_post_cat' ) ) {
		penci_get_categories();
	}
	$sticky = is_sticky() ? '<span class="sticky-label"><i class="fa fa-thumb-tack"></i><span class="screen-reader-text">' . penci_get_tran_setting( 'penci_get_tran_setting' ) . '</span></span>  ' : '';
	the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $sticky, '</a></h2>' );
	penci_get_schema_markup( true );
	if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php penci_posted_on_archive(); ?>
		</div><!-- .entry-meta -->
		<?php
	endif; ?>
</header>
