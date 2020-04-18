<?php
// 404 Page Settings
$wp_customize->add_section( 'page404', array(
	'title'    => esc_html__( '404 Page Options', 'pennews' ),
	'priority' => 15,
) );

$wp_customize->add_setting( 'penci_404_image', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'penci_404_image', array(
	'label'    => esc_html__( '404 Custom Main Image', 'pennews'),
	'section'  => 'page404',
	'settings' => 'penci_404_image',
	'priority' => 5
) ) );

$wp_customize->add_setting( 'penci_404_heading', array(
	'default'           => penci_default_setting( 'penci_404_heading' ),
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_404_heading', array(
	'label'    => esc_html__( '404 Custom Heading Text', 'pennews' ),
	'section'  => 'page404',
	'settings' => 'penci_404_heading',
	'priority' => 10
) ) );

$wp_customize->add_setting( 'penci_404_sub_heading', array(
	'default'           => penci_default_setting( 'penci_404_sub_heading' ),
	'sanitize_callback' => array( $sanitizer, 'textarea' ),
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_404_sub_heading', array(
	'label'    => esc_html__( '404 Custom Message Text', 'pennews' ),
	'section'  => 'page404',
	'settings' => 'penci_404_sub_heading',
	'type'     => 'textarea',
	'priority' => 15
) ) );

$wp_customize->add_setting( 'penci_404_heading_lnews', array(
	'default'           => esc_html__( 'Latest News', 'pennews' ),
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_404_heading_lnews', array(
	'label'    => esc_html__( '404 Custom Latest News Text', 'pennews' ),
	'section'  => 'page404',
	'settings' => 'penci_404_heading_lnews',
	'priority' => 20
) ) );

$page404_author = array(
	'penci_404_hide_latest_news' => esc_html__( 'Disable Latest News.', 'pennews' ),
	'penci_404_hide_search'      => esc_html__( 'Disable Search Form', 'pennews' ),
);

foreach ( $page404_author as $id_option => $label_option ) {
	$wp_customize->add_setting( $id_option, array(
		'sanitize_callback' => array( $sanitizer, 'checkbox' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		$id_option,
		array(
			'label'    => $label_option,
			'section'  => 'page404',
			'type'     => 'checkbox',
			'settings' => $id_option,
			'priority' => 20
		)
	) );
}