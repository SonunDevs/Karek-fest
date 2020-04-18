<?php
$show_trending = penci_get_setting( 'penci_topbar_show_trending' );
if( empty( $show_trending ) ) {
	return;
}

$text_trending = penci_get_setting( 'penci_topbar_trending_text' );
$show_trending = penci_get_setting( 'penci_topbar_show_trending' );
$amount        = penci_get_setting( 'penci_topbar_trending_amount' );
$cat           = penci_get_setting( 'penci_topbar_trending_cat' );
$data_auto     = penci_get_setting( 'penci_topbar_trending_dis_auto' );
$data_speed    = penci_get_setting( 'penci_topbar_trending_speed' );
$data_autotime = penci_get_setting( 'penci_topbar_trending_autotime' );
$length        = penci_get_setting( 'penci_topbar_trending_num_words' );

$trending_order = penci_get_theme_mod( 'penci_topbar_trending_order' );

$args = array(
	'ignore_sticky_posts' => 1,
	'post_status'         => 'publish',
	'posts_per_page'      => $amount ? $amount : 7
);

if ( $trending_order ) {
	if ( 'popular' == $trending_order ) {
		$args['meta_key'] = '_count-views_all';
	} elseif ( 'popular7' == $trending_order ) {
		$args['meta_key'] = '_count-views_week';
	} elseif ( 'popular_month' == $trending_order ) {
		$args['meta_key'] = '_count-views_month';
	}

	$args['orderby'] = 'meta_value_num';
	$args['order']   = 'DESC';
}


if( $cat ) {
	$args['cat'] = $cat;
}
$args = apply_filters( 'penci_args_support_polylang', $args );
$query_trending = new WP_Query( $args );
if ( ! $query_trending->have_posts() ) {
	return;
}

$count_post_trending = $query_trending->post_count;

echo '<div class="topbar_item topbar__trending penci-block-vc">';
echo '<span class="headline-title">' . wp_kses_post( $text_trending ) . '</span>';
?>
	<span class="penci-trending-nav <?php echo( $count_post_trending < 2 ? 'penci-pag-disabled' : '' ); ?>">
		<a class="penci-slider-prev" href="#"><i class="fa fa-angle-left"></i></a>
		<a class="penci-slider-next" href="#"><i class="fa fa-angle-right"></i></a>
	</span>
<?php
printf( '<div class="penci-owl-carousel-slider" data-items="1" data-auto="%s" data-autotime="%s" data-speed="%s" data-loop="0" data-dots="0" data-nav="0" data-autowidth="0" data-vertical="1">',
	empty( $data_auto  ) ? 1 : 0,
	$data_autotime ? $data_autotime : 4000,
	$data_speed ? $data_speed : 800
	);

while ( $query_trending->have_posts() ) {
	$query_trending->the_post();
	echo '<h3 class="penci__post-title entry-title"><a href="' . get_the_permalink() . '">' . wp_trim_words( get_the_title( $id ), $length ) . '</a></h3>';
}
wp_reset_postdata();
echo '</div></div>';
