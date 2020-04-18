<?php
if(  penci_get_theme_mod( 'penci_hide_footer_widget' ) ) {
	return;
}
/**
 * Display footer sidebars
 */
$columns = penci_count_footer_col();

$has_widget       = false;
$sidebars_widgets = wp_get_sidebars_widgets();

for ( $i = 1; $i <= $columns; $i ++ ) {
	if ( ! empty( $sidebars_widgets["footer-$i"] ) ) {
		$has_widget = true;
	}
}

if ( ! $has_widget ) {
	return;
}

$footer_col =  penci_get_setting( 'penci_footer_col' );
$width_cols = array();

if ( 'style-2' == $footer_col ) {
	$width_cols = array( 6, 6 );
} elseif ( 'style-3' == $footer_col ) {
	$width_cols = array( 4, 4, 4 );
} elseif ( 'style-4' == $footer_col ) {
	$width_cols = array( 3, 3, 3, 3 );
} elseif ( 'style-5' == $footer_col ) {
	$width_cols = array( 4, 8 );
} elseif ( 'style-6' == $footer_col ) {
	$width_cols = array( 8, 4 );
} elseif ( 'style-7' == $footer_col ) {
	$width_cols = array( 3, 9 );
} elseif ( 'style-8' == $footer_col ) {
	$width_cols = array( 9, 3 );
} elseif ( 'style-9' == $footer_col ) {
	$width_cols = array( 3, 3, 6 );
} elseif ( 'style-10' == $footer_col ) {
	$width_cols = array( 6, 3, 3 );
} elseif ( 'style-11' == $footer_col ) {
	$width_cols = array( 3, 6, 3 );
} else {
	$width_cols = array( 12 );
}

?>
<div id="footer__sidebars" class="footer__sidebars footer__sidebar-col-<?php echo esc_attr( $columns ); ?> <?php echo 'footer__sidebars-' . esc_attr( $footer_col );  ?>">
	<div class="<?php penci_get_class_footer_width(); ?>">
		<div class="row">
			<?php
			foreach($width_cols as $key => $width_cols ) :

				$widget_id = $key + 1;
				$class = 'penci-col-' . $width_cols;
				?>
				<div id="footer-<?php echo esc_attr( $widget_id  ); ?>" class="footer-sidebar-item footer-<?php echo esc_attr( $widget_id ); ?> <?php echo esc_attr( $class ); ?>">
					<?php dynamic_sidebar( "footer-$widget_id" ) ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
