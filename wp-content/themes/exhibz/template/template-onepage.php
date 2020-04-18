<?php
/**
 * Template Name: OnePage Home Template
 * 
 * The template used for displaying Home Page
 *
 * @package _xs
 */
$frontpage_id	 = exhibz_option( get_option( 'page_on_front' ), false );
$self_id		 = exhibz_main( get_the_ID(), false );

get_header();


?>
<?php while ( have_posts() ) : the_post(); ?>
	<!-- Intro Content begns -->
	<div id="<?php echo esc_attr( exhibz_sectionID( exhibz_main( $post->ID, false ) ) ); ?>" class="onepage-home ">
		<?php the_content(); ?>
	</div>
	<!-- Intro Content ends -->
<?php endwhile; // end of the loop.  ?>


<?php
$menu_locations = get_nav_menu_locations();

if ( isset( $menu_locations[ 'primary' ] ) ) :

	$menu				 = wp_get_nav_menu_object( $menu_locations[ 'primary' ] );
	$menu_items			 = wp_get_nav_menu_items( $menu->term_id );
	$menu_items_include	 = array();
	foreach ( $menu_items as $item ) {
		if ( ($item->object == 'page') && (exhibz_get_post_meta( exhibz_main( $item->object_id, false ), 'xs_page_section' ) == "on") && ($item->object_id != $self_id) )
			$menu_items_include[]	 = $item->object_id;
		$menu_items				 = count( $menu_items_include );
	}

	$query = new WP_Query( array( 'post_type' => 'page', 'post__in' => $menu_items_include, 'posts_per_page' => $menu_items, 'orderby' => 'post__in' ) );
	if ( $menu_items != 0 && $query->have_posts() ):
		while ( $query->have_posts() ):
			$query->the_post();
			$section_id = exhibz_sectionID( exhibz_main( $post->ID, false ) );
			?>
			<div id="<?php echo esc_attr( $section_id ); ?>" class="section-wraper">
				<?php echo exhibz_edit_section(); ?>

				<?php the_content(); ?>

				<!-- Footer edit section -->
			</div>

			<?php
		endwhile;
	endif;
	wp_reset_postdata();
endif;
?>
<?php get_footer(); ?>