<?php
$show_weather = penci_get_setting( 'penci_topbar_show_weather' );
if ( empty( $show_weather )  || ! class_exists( 'Penci_Weather' ) ) {
	return;
}

$location = penci_get_setting( 'penci_topbar_location_weather' );
if( !$location ) {
	return;
}
Penci_Weather::get_top_bar_template( array(
	'location'      => $location,
	'units'         => penci_get_setting( 'penci_topbar_weather_units' ),
	'location_show' => penci_get_setting( 'penci_topbar_weather_display' ),
) );