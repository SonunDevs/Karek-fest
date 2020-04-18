<?php
$section_color_topbar = 'penci_section_color_signup';

$wp_customize->add_section( $section_color_topbar, array(
	'title'    => esc_html__( 'Color for Login & Register Popup', 'pennews' ),
	'priority' => 10,
) );

$wp_customize->add_setting( 'penci_topbar_login_colors_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_topbar_login_colors_heading', array(
	'label'    => esc_html__( 'Login and Register Colors', 'pennews' ),
	'section'  => $section_color_topbar,
	'settings' => 'penci_topbar_login_colors_heading',
	'type'     => 'heading',
) ) );

$wp_customize->add_setting( 'penci_login_bg_img', array(
	'sanitize_callback' => 'esc_url_raw',
	'default'           => '',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'penci_login_bg_img', array(
	'label'    => esc_html__( 'Background image', 'pennews' ),
	'section'  => $section_color_topbar,
	'settings' => 'penci_login_bg_img',
) ) );
// Body bg repeat
$wp_customize->add_setting( 'penci_login_bg_repeat', array(
	'default'           => 'repeat',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_login_bg_repeat', array(
	'label'    => esc_html__( 'Background Repeat', 'pennews' ),
	'section'  => $section_color_topbar,
	'settings' => 'penci_login_bg_repeat',
	'type'     => 'select',
	'choices'  => array(
		'no-repeat' => 'No Repeat',
		'repeat'    => 'Repeat'
	)
) );

$wp_customize->add_setting( 'penci_login_bg_pos', array(
	'default'           => 'top',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_login_bg_pos', array(
	'label'    => esc_html__( 'Position your background image', 'pennews' ),
	'section'  => $section_color_topbar,
	'settings' => 'penci_login_bg_pos',
	'type'     => 'select',
	'choices'  => array(
		'top'    => 'Top',
		'center' => 'Center',
		'bottom' => 'Bottom'
	)
) );

$wp_customize->add_setting( 'penci_login_bg_size', array(
	'default'           => 'cover',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_login_bg_size', array(
	'label'    => esc_html__( 'Set the background image size', 'pennews' ),
	'section'  => $section_color_topbar,
	'settings' => 'penci_login_bg_size',
	'type'     => 'select',
	'choices'  => array(
		'cover'   => 'Cover',
		'contain' => 'Contain',
		'auto'    => 'Auto',
	)
) );

$options_color_topbar = array(
	'penci_login_register_bg_color'          => esc_html__( 'Background Color', 'pennews' ),
	'penci_login_register_title_color'       => esc_html__( 'Title Color', 'pennews' ),
	'penci_login_register_text_color'        => esc_html__( 'Text Color', 'pennews' ),
	'penci_login_register_input_color'       => esc_html__( 'Input Text Color', 'pennews' ),
	'penci_login_register_input_placeholder' => esc_html__( 'Input Placeholder Color', 'pennews' ),
	'penci_login_register_input_brcolor'     => esc_html__( 'Input Border Color', 'pennews' ),
	'penci_login_register_link_color'        => esc_html__( 'Link Color', 'pennews' ),
	'penci_login_register_link_hcolor'       => esc_html__( 'Link Hover Color', 'pennews' ),

	'penci_login_register_button_color'    => esc_html__( 'Button Color', 'pennews' ),
	'penci_login_register_button_bgcolor'  => esc_html__( 'Button Background Color', 'pennews' ),
	'penci_login_register_button_hcolor'   => esc_html__( 'Button Hover Color', 'pennews' ),
	'penci_login_register_button_hbgcolor' => esc_html__( 'Button Hover Background Color', 'pennews' ),
);

foreach ( $options_color_topbar as $key => $label ) {

	$wp_customize->add_setting( $key, array(
		'default'           => penci_default_setting( $key ),
		'sanitize_callback' => array( $sanitizer, 'hex_color' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
		'label'       => $label,
		'section'     => $section_color_topbar,
		'settings'    => $key,
		'description' => ''
	) ) );
}