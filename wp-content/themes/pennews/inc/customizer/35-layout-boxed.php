<?php
$section_boxed  = 'penci_boxed';
$wp_customize->add_section( $section_boxed, array(
	'title'    => esc_html__( 'Layout Boxed', 'pennews' ),
	'priority' => 4,
) );

$wp_customize->add_setting( 'penci_body_boxed_layout', array(
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_body_boxed_layout',
	array(
		'label'    => esc_html__( 'Enable Body Boxed Layout', 'pennews' ),
		'section'  => $section_boxed,
		'type'     => 'checkbox',
		'settings' => 'penci_body_boxed_layout',
	)
) );
$wp_customize->add_setting( 'penci_layout_boxed_width', array(
	'default'           => 'default',
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_layout_boxed_width', array(
	'label'    => esc_html__( 'Container Width', 'pennews' ),
	'section'  => $section_boxed,
	'settings' => 'penci_layout_boxed_width',
	'type'     => 'select',
	'choices'  => array(
		''     => esc_html__( 'Width: 1400px', 'pennews' ),
		'1170' => esc_html__( 'Width: 1170px', 'pennews' ),
		'1080' => esc_html__( 'Width: 1080px', 'pennews' ),
	)
) );

$wp_customize->add_setting( 'penci_boxbody_heading1', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_boxbody_heading1', array(
	'label'    => esc_html__( 'Body Colors', 'pennews' ),
	'section'  => $section_boxed,
	'settings' => 'penci_boxbody_heading1',
	'type'     => 'heading',
) ) );

$wp_customize->add_setting( 'penci_boxed_body_bgcolor', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'hex_color' ),
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'penci_boxed_body_bgcolor', array(
	'label'       => esc_html__( 'Background Color for Body Boxed', 'pennews' ),
	'section'     => $section_boxed,
	'settings'    => 'penci_boxed_body_bgcolor',
	'description' => ''
) ) );

$wp_customize->add_setting( 'penci_boxed_body_bgimg', array(
	'sanitize_callback' => array( $sanitizer, 'html' )
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'penci_boxed_body_bgimg', array(
	'label'       => esc_html__( 'Background Image for Body Boxed', 'pennews' ),
	'section'     => $section_boxed,
	'settings'    => 'penci_boxed_body_bgimg'
) ) );

$wp_customize->add_setting( 'penci_boxed_body_repeat', array(
	'default'           => 'no-repeat',
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_boxed_body_repeat', array(
	'label'    => esc_html__( 'Background Body Boxed Repeat', 'pennews' ),
	'section'  => $section_boxed,
	'settings' => 'penci_boxed_body_repeat',
	'type'     => 'select',
	'choices'  => array(
		'no-repeat' => esc_html__( 'No repeat', 'pennews' ),
		'repeat'    => esc_html__( 'Repeat', 'pennews' ),
	)
) );

$wp_customize->add_setting( 'penci_boxed_body_attachment', array(
	'default'           => 'fixed',
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_boxed_body_attachment', array(
	'label'    => esc_html__( 'Background Body Boxed Attachment', 'pennews' ),
	'section'  => $section_boxed,
	'settings' => 'penci_boxed_body_attachment',
	'type'     => 'select',
	'choices'  => array(
		'fixed'  => esc_html__( 'Fixed', 'pennews' ),
		'local'  => esc_html__( 'Local', 'pennews' ),
		'scroll' => esc_html__( 'Scroll', 'pennews' ),
	)
) );

$wp_customize->add_setting( 'penci_boxed_body_size', array(
	'default'           => 'cover',
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_boxed_body_size', array(
	'label'    => esc_html__( 'Background Body Boxed Size', 'pennews' ),
	'section'  => $section_boxed,
	'settings' => 'penci_boxed_body_size',
	'type'     => 'select',
	'choices'  => array(
		'cover'   => esc_html__( 'Cover', 'pennews' ),
		'auto'    => esc_html__( 'Auto', 'pennews' ),
		'contain' => esc_html__( 'Contain', 'pennews' ),
	)
) );

$wp_customize->add_setting( 'penci_boxbody_heading2', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_boxbody_heading2', array(
	'label'    => esc_html__( 'Container Boxed Colors', 'pennews' ),
	'section'  => $section_boxed,
	'settings' => 'penci_boxbody_heading2',
	'type'     => 'heading',
) ) );

$wp_customize->add_setting( 'penci_boxed_container_bgcolor', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'hex_color' ),
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'penci_boxed_container_bgcolor', array(
	'label'       => esc_html__( 'Background Color for Body Boxed', 'pennews' ),
	'section'     => $section_boxed,
	'settings'    => 'penci_boxed_container_bgcolor',
	'description' => ''
) ) );

$wp_customize->add_setting( 'penci_boxed_container_bgimg', array(
	'sanitize_callback' => array( $sanitizer, 'html' )
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'penci_boxed_container_bgimg', array(
	'label'       => esc_html__( 'Background Image for Body Boxed', 'pennews' ),
	'section'     => $section_boxed,
	'settings'    => 'penci_boxed_container_bgimg'
) ) );

$wp_customize->add_setting( 'penci_boxed_container_repeat', array(
	'default'           => 'no-repeat',
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_boxed_container_repeat', array(
	'label'    => esc_html__( 'Background Body Boxed Repeat', 'pennews' ),
	'section'  => $section_boxed,
	'settings' => 'penci_boxed_container_repeat',
	'type'     => 'select',
	'choices'  => array(
		'no-repeat' => esc_html__( 'No repeat', 'pennews' ),
		'repeat'    => esc_html__( 'Repeat', 'pennews' ),
	)
) );

$wp_customize->add_setting( 'penci_boxed_container_attachment', array(
	'default'           => 'fixed',
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_boxed_container_attachment', array(
	'label'    => esc_html__( 'Background Body Boxed Attachment', 'pennews' ),
	'section'  => $section_boxed,
	'settings' => 'penci_boxed_container_attachment',
	'type'     => 'select',
	'choices'  => array(
		'fixed'  => esc_html__( 'Fixed', 'pennews' ),
		'local'  => esc_html__( 'Local', 'pennews' ),
		'scroll' => esc_html__( 'Scroll', 'pennews' ),
	)
) );

$wp_customize->add_setting( 'penci_boxed_container_size', array(
	'default'           => 'cover',
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_boxed_container_size', array(
	'label'    => esc_html__( 'Background Body Boxed Size', 'pennews' ),
	'section'  => $section_boxed,
	'settings' => 'penci_boxed_container_size',
	'type'     => 'select',
	'choices'  => array(
		'cover'   => esc_html__( 'Cover', 'pennews' ),
		'auto'    => esc_html__( 'Auto', 'pennews' ),
		'contain' => esc_html__( 'Contain', 'pennews' ),
	)
) );