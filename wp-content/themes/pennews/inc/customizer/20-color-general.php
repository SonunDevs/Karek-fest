<?php

$wp_customize->add_section( 'penci_section_color_general', array(
	'title'    => esc_html__( 'Colors General', 'pennews' ),
	'priority' => 10,
) );

$wp_customize->add_setting( 'penci_colorscheme', array(
	'default'           => 'light',
	'transport'         => 'postMessage',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );

$wp_customize->add_control( 'penci_colorscheme', array(
	'type'    => 'radio',
	'label'    => __( 'Color Scheme', 'pennews' ),
	'choices'  => array(
		'light'  => __( 'Light', 'pennews' ),
		'dark'   => __( 'Dark', 'pennews' ),
	),
	'section'  => 'penci_section_color_general',
	'priority' => 1,
) );

$options_color_header = array(
	'penci_color_body'          => esc_html__( 'Body Text Colors', 'pennews' ),
	'penci_block_bgcolor'       => esc_html__( 'Block and Widget Background Colors', 'pennews' ),
	'penci_color_accent'        => esc_html__( 'Accent Colors', 'pennews' ),
	'penci_color_links'         => esc_html__( 'Link Colors', 'pennews' ),
	'penci_color_heading'       => esc_html__( 'Heading Colors', 'pennews' ),
	'penci_color_meta'          => esc_html__( 'Meta Colors', 'pennews' ),
	'penci_color_border'        => esc_html__( 'Border Colors', 'pennews' ),
);

foreach ( $options_color_header as $key => $label ) {
	$wp_customize->add_setting( $key, array(
		'default'           => penci_default_setting( $key ),
		'sanitize_callback' => array( $sanitizer, 'hex_color' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
		'label'    => $label,
		'section'  => 'penci_section_color_general',
		'settings' => $key,
	) ) );
}