<?php

$wp_customize->add_section( 'penci-bbpress', array(
	'title'    => esc_html__( 'Bbpress Options', 'pennews' ),
	'priority' => 31,
) );


$wp_customize->add_setting( 'penci_bbpress_single_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_bbpress_single_heading', array(
	'label'    => esc_html__( 'bbpress detail', 'pennews' ),
	'section'  => 'penci-bbpress',
	'settings' => 'penci_bbpress_single_heading',
	'type'     => 'heading',
) ) );
$wp_customize->add_setting( 'penci_bbpress_sidebar', array(
	'default'           => 'sidebar-right',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( new Penci_Customize_Control_Radio_Image(
	$wp_customize,
	'penci_bbpress_sidebar',
	array(
		'label'    => esc_html__( 'Single Sidebar Layout', 'pennews' ),
		'section'  => 'penci-bbpress',
		'type'     => 'radio-image',
		'choices'  => array(
			'no-sidebar'      => array( 'url' => '%s/images/layout/no-sidebar.png', 'label' => esc_html__( 'No Sidebar', 'pennews' ) ),
			'sidebar-left'    => array( 'url' => '%s/images/layout/sidebar-left.png', 'label' => esc_html__( 'Sidebar Left', 'pennews' ) ),
			'sidebar-right'   => array( 'url' => '%s/images/layout/sidebar-right.png', 'label' => esc_html__( 'Sidebar Right', 'pennews' ) ),
		),
		'settings' => 'penci_bbpress_sidebar',
	)
) );

$wp_customize->add_setting( 'penci_bbpress_align_post_title', array(
	'default'           => 'left',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_bbpress_align_post_title', array(
	'label'    => esc_html__( 'Post Title Align', 'pennews' ),
	'section'  => 'penci-bbpress',
	'settings' => 'penci_bbpress_align_post_title',
	'type'     => 'select',
	'choices'  => array(
		'left'   => esc_html__( 'Left', 'pennews' ),
		'center' => esc_html__( 'Center', 'pennews' ),
		'right'  => esc_html__( 'Right', 'pennews' )
	)
) );

