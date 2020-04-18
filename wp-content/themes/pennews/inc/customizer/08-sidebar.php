<?php

$wp_customize->add_section( 'penci_sidebar', array(
	'title'    => esc_html__( 'Sidebar', 'pennews' ),
	'priority' => 8,
) );

// Font size
$wp_customize->add_setting( 'penci_sidebar_widget_margin_bottom', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_sidebar_widget_margin_bottom', array(
	'label'    => esc_html__( 'Custom Margin Bottom Widget', 'pennews' ),
	'section'  => 'penci_sidebar',
	'settings' => 'penci_sidebar_widget_margin_bottom',
	'type'     => 'font_size',
) ) );

// ------ block header
$wp_customize->add_setting( 'penci_general_block_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_general_block_heading', array(
	'label'    => esc_html__( 'Block Title And Widget Title', 'pennews' ),
	'section'  => 'penci_sidebar',
	'settings' => 'penci_general_block_heading',
	'type'     => 'heading',
) ) );

$wp_customize->add_setting( 'penci_style_block_title', array(
	'default'           => 'style-title-1',
	'sanitize_callback' => array( $sanitizer, 'select' ),
	'transport'         => 'postMessage',
) );
$wp_customize->add_control( 'penci_style_block_title', array(
	'label'    => esc_html__( 'Style Title', 'pennews' ),
	'section'  => 'penci_sidebar',
	'settings' => 'penci_style_block_title',
	'type'     => 'select',
	'choices'  => array(
		'style-title-1'  => esc_html__( 'Style 1', 'pennews' ),
		'style-title-2'  => esc_html__( 'Style 2', 'pennews' ),
		'style-title-3'  => esc_html__( 'Style 3', 'pennews' ),
		'style-title-4'  => esc_html__( 'Style 4', 'pennews' ),
		'style-title-5'  => esc_html__( 'Style 5', 'pennews' ),
		'style-title-6'  => esc_html__( 'Style 6', 'pennews' ),
		'style-title-7'  => esc_html__( 'Style 7', 'pennews' ),
		'style-title-8'  => esc_html__( 'Style 8', 'pennews' ),
		'style-title-9'  => esc_html__( 'Style 9', 'pennews' ),
		'style-title-10' => esc_html__( 'Style 10', 'pennews' ),
		'style-title-11' => esc_html__( 'Style 11', 'pennews' ),
		'style-title-12' => esc_html__( 'Style 12', 'pennews' ),
		'style-title-13' => esc_html__( 'Style 13', 'pennews' ),
	)
) );


$general_extra_check = array(
	'penci_off_uppearcase_block_title' => esc_html__( 'Turn off Uppercase Block Title.', 'pennews' ),
);

foreach ( $general_extra_check as $id_option => $label_option ) {
	$wp_customize->add_setting( $id_option, array(
		'sanitize_callback' => array( $sanitizer, 'checkbox' ),
	) );

	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		$id_option,
		array(
			'label'    => $label_option,
			'section'  => 'penci_sidebar',
			'type'     => 'checkbox',
			'settings' => $id_option,
		)
	) );
}


$wp_customize->add_setting( 'penci_align_blocktitle', array(
	'default'           => 'style-title-left',
	'sanitize_callback' => array( $sanitizer, 'select' ),
	'transport'         => 'postMessage',
) );
$wp_customize->add_control( 'penci_align_blocktitle', array(
	'label'    => esc_html__( 'Align Title', 'pennews' ),
	'section'  => 'penci_sidebar',
	'settings' => 'penci_align_blocktitle',
	'type'     => 'select',
	'choices'  => array(
		'style-title-left'  => esc_html__( 'Left', 'pennews' ),
		'style-title-center'  => esc_html__( 'Center', 'pennews' ),
		'style-title-right'  => esc_html__( 'Right', 'pennews' ),
	)
) );

$wp_customize->add_setting( 'penci_font_blocktitle', array(
	'default'           => penci_default_setting( 'penci_font_blocktitle' ),
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_font_blocktitle', array(
	'label'       => esc_html__( 'Font Family', 'pennews' ),
	'section'     => 'penci_sidebar',
	'settings'    => 'penci_font_blocktitle',
	'description' => 'Default font is "Oswald"',
	'type'        => 'select',
	'choices'     => penci_all_fonts()
) );

$wp_customize->add_setting( 'penci_font_weight_blocktitle', array(
	'default'           => '600',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_font_weight_blocktitle', array(
	'label'    => esc_html__( 'Font Weight', 'pennews' ),
	'section'  => 'penci_sidebar',
	'settings' => 'penci_font_weight_blocktitle',
	'type'     => 'select',
	'choices'  => array(
		'normal'  => 'Normal',
		'bold'    => 'Bold',
		'bolder'  => 'Bolder',
		'lighter' => 'Lighter',
		'100'     => '100',
		'200'     => '200',
		'300'     => '300',
		'400'     => '400',
		'500'     => '500',
		'600'     => '600',
		'700'     => '700',
		'800'     => '800',
		'900'     => '900'
	)
) );

// Font size
$wp_customize->add_setting( 'penci_font_for_size_blocktitle', array(
	'default'           => '18',
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_font_for_size_blocktitle', array(
	'label'    => esc_html__( 'Custom Font Size', 'pennews' ),
	'section'  => 'penci_sidebar',
	'settings' => 'penci_font_for_size_blocktitle',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_height_line_top_blocktitle', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_height_line_top_blocktitle', array(
	'label'    => esc_html__( 'Border Top Width For Header Style 1', 'pennews' ),
	'section'  => 'penci_sidebar',
	'settings' => 'penci_height_line_top_blocktitle',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_height_line_bottom_blocktitle', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_height_line_bottom_blocktitle', array(
	'label'    => esc_html__( 'Custom Border Bottom Width', 'pennews' ),
	'section'  => 'penci_sidebar',
	'settings' => 'penci_height_line_bottom_blocktitle',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_height_line_blocktitle11_12', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_height_line_blocktitle11_12', array(
	'label'    => esc_html__( 'Custom Border Width For For Header Style 11 & 12', 'pennews' ),
	'section'  => 'penci_sidebar',
	'settings' => 'penci_height_line_blocktitle11_12',
	'type'     => 'font_size',
) ) );