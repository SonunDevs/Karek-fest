<?php
// Footer option
$wp_customize->add_section( 'penci_signup_header', array(
	'title'    => esc_html__( 'Header Sign-Up Form Options', 'pennews' ),
	'description' => esc_html__( 'All options here only for MailChimp Sign-Up Form on header. If you do not use MailChimp Sign-Up Form in header let ignore it', 'pennews' ),
	'priority' => 3,
) );


$wp_customize->add_setting( 'penci_signup_header_width', array(
	'sanitize_callback' => array( $sanitizer, 'text' ),
	'default'           => 'fullwidth',
) );

$wp_customize->add_control( 'penci_signup_header_width', array(
	'label'    => esc_html__( 'Header Sign-Up Form Width', 'pennews' ),
	'section'  => 'penci_signup_header',
	'settings' => 'penci_signup_header_width',
	'type'     => 'select',
	'choices'  => array(
		'default'   => esc_html__( 'Default', 'pennews' ),
		'fullwidth' => esc_html__( 'FullWidth', 'pennews' ),
	)
) );

$wp_customize->add_setting( 'penci_signup_h_container_width', array(
	'sanitize_callback' => array( $sanitizer, 'text' ),
	'default'           => 'penci-container-fluid',
) );

$wp_customize->add_control( 'penci_signup_h_container_width', array(
	'label'    => esc_html__( 'Header Sign-Up Form Container Width', 'pennews' ),
	'section'  => 'penci_signup_header',
	'settings' => 'penci_signup_h_container_width',
	'type'     => 'select',
	'choices'  => array(
		'penci-container-fluid' => esc_html__( 'Width: 1400px', 'pennews' ),
		'penci-container'       => esc_html__( 'Width: 1170px', 'pennews' ),
		'penci-container-1080'  => esc_html__( 'Width: 1080px', 'pennews' )
	)
) );

$wp_customize->add_setting( 'penci_header_signup_mtop', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_header_signup_mtop', array(
	'label'    => esc_html__( 'Header Sign-Up Form Margin Top', 'pennews' ),
	'section'  => 'penci_signup_header',
	'settings' => 'penci_header_signup_mtop',
	'type'     => 'number',
) ) );

$wp_customize->add_setting( 'penci_header_signup_padding', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => '20',
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_header_signup_padding', array(
	'label'    => esc_html__( 'Header Sign-Up Form Padding Top & Bottom', 'pennews' ),
	'section'  => 'penci_signup_header',
	'settings' => 'penci_header_signup_padding',
	'type'     => 'number',
) ) );

// Color
$wp_customize->add_setting( 'penci_header_signup_colors_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_header_signup_colors_heading', array(
	'label'    => esc_html__( 'Colors', 'pennews' ),
	'section'  => 'penci_signup_header',
	'settings' => 'penci_header_signup_colors_heading',
	'type'     => 'heading',
) ) );

$options_color_archive = array(
	'penci_header_signup_bg'            => esc_html__( 'Header Sign-Up Form Area Background Color', 'pennews' ),
	'penci_header_signup_color'         => esc_html__( 'Text Color', 'pennews' ),
	'penci_header_signup_heading_color' => esc_html__( 'Heading Text Color', 'pennews' ),
	'penci_header_signup_input_border'  => esc_html__( 'Input Border Color', 'pennews' ),
	'penci_header_signup_input_color'   => esc_html__( 'Input Text Color', 'pennews' ),
	'penci_header_signup_iplace_color'  => esc_html__( 'Input Placeholder Color', 'pennews' ),
	'penci_header_signup_submit_bg'     => esc_html__( 'Submit Button Background Color', 'pennews' ),
	'penci_header_signup_submit_color'  => esc_html__( 'Submit Button Text Color', 'pennews' ),
	'penci_header_signup_submit_hbg'    => esc_html__( 'Submit Button Hover Background Color', 'pennews' ),
	'penci_header_signup_submit_hcolor' => esc_html__( 'Submit Button Hover Text Color', 'pennews' ),
);

foreach ( $options_color_archive as $key => $label ) {

	$wp_customize->add_setting( $key, array(
		'default'           => penci_default_setting( $key ),
		'sanitize_callback' => array( $sanitizer, 'hex_color' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
		'label'       => $label,
		'section'     => 'penci_signup_header',
		'settings'    => $key,
	) ) );
}
