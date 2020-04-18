<?php

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" >
			<div class="penci-container">
				<div class="penci-container__content<?php penci_class_pos_sidebar_content(); ?>">
					<div class="penci-wide-content penci-content-novc penci-sticky-content">
						<div class="theiaStickySidebar">
						<div class="penci-content-post">
							<?php
							while ( have_posts() ) : the_post();
								?>
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<header class="entry-header penci-entry-header">
										<?php
										$bbalign_title   = 'penci-title-' . penci_get_setting( 'penci_bbpress_align_post_title' );
										the_title( '<h1 class="entry-title penci-entry-title ' . $bbalign_title . '">', '</h1>' );
										penci_get_schema_markup( true );
										?>
									</header><!-- .entry-header -->
									<div class="penci-entry-content entry-content">
										<?php
										the_content( sprintf(
											wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'pennews' ), array( 'span' => array( 'class' => array() ) ) ),
											the_title( '<span class="screen-reader-text">"', '"</span>', false )
										) );

										wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pennews' ), 'after' => '</div>', ) );
										?>
									</div><!-- .entry-content -->
								</article>
							<?php endwhile; ?>
						</div>
						</div>
					</div>
					<?php get_sidebar( 'bbpress' ); ?>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();