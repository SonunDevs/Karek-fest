<?php
$wp_customize->add_section( 'penci-event', array(
	'title'    => esc_html__( 'Layout Options', 'pennews' ),
	'panel' =>  'tribe_customizer',
	'priority' => 1,
) );

$wp_customize->add_setting( 'penci_event_sidebar', array(
	'default'           => 'no-sidebar',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( new Penci_Customize_Control_Radio_Image(
	$wp_customize,
	'penci_event_sidebar',
	array(
		'label'    => esc_html__( 'Archive Sidebar Layout', 'pennews' ),
		'section'  => 'penci-event',
		'type'     => 'radio-image',
		'choices'  => array(
			'no-sidebar'      => array( 'url' => '%s/images/layout/no-sidebar.png', 'label' => esc_html__( 'No Sidebar', 'pennews' ) ),
			'sidebar-left'    => array( 'url' => '%s/images/layout/sidebar-left.png', 'label' => esc_html__( 'Sidebar Left', 'pennews' ) ),
			'sidebar-right'   => array( 'url' => '%s/images/layout/sidebar-right.png', 'label' => esc_html__( 'Sidebar Right', 'pennews' ) ),
		),
		'settings' => 'penci_event_sidebar',
	)
) );

$wp_customize->add_setting( 'penci_event_single_sidebar', array(
	'default'           => 'sidebar-right',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( new Penci_Customize_Control_Radio_Image(
	$wp_customize,
	'penci_event_single_sidebar',
	array(
		'label'    => esc_html__( 'Single Sidebar Layout', 'pennews' ),
		'section'  => 'penci-event',
		'type'     => 'radio-image',
		'choices'  => array(
			'no-sidebar'      => array( 'url' => '%s/images/layout/no-sidebar.png', 'label' => esc_html__( 'No Sidebar', 'pennews' ) ),
			'sidebar-left'    => array( 'url' => '%s/images/layout/sidebar-left.png', 'label' => esc_html__( 'Sidebar Left', 'pennews' ) ),
			'sidebar-right'   => array( 'url' => '%s/images/layout/sidebar-right.png', 'label' => esc_html__( 'Sidebar Right', 'pennews' ) ),
		),
		'settings' => 'penci_event_single_sidebar',
	)
) );

