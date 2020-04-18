<?php
// Footer option
$wp_customize->add_section( 'penci_signup_footer', array(
	'title'    => esc_html__( 'Footer Sign-Up Form Options', 'pennews' ),
	'priority' => 8,
) );


$wp_customize->add_setting( 'penci_footer_signup_ptop', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => '50',
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_footer_signup_ptop', array(
	'label'    => esc_html__( 'Header Sign-Up Form Padding Top', 'pennews' ),
	'section'  => 'penci_signup_footer',
	'settings' => 'penci_footer_signup_ptop',
	'type'     => 'number',
) ) );

$wp_customize->add_setting( 'penci_footer_signup_pbottom', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => '40',
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_footer_signup_pbottom', array(
	'label'    => esc_html__( 'Header Sign-Up Form Padding Bottom', 'pennews' ),
	'section'  => 'penci_signup_footer',
	'settings' => 'penci_footer_signup_pbottom',
	'type'     => 'number',
) ) );

$wp_customize->add_setting( 'penci_footer_signup_mar_bottom', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_footer_signup_mar_bottom', array(
	'label'    => esc_html__( 'Header Sign-Up Form Margin Bottom', 'pennews' ),
	'section'  => 'penci_signup_footer',
	'settings' => 'penci_footer_signup_mar_bottom',
	'type'     => 'number',
) ) );


$options_color_archive = array(
	'penci_footer_signup_bg'            => esc_html__( 'Footer Sign-Up Form Area Background Color', 'pennews' ),
	'penci_footer_signup_color'         => esc_html__( 'Text Color', 'pennews' ),
	'penci_footer_signup_heading_color' => esc_html__( 'Heading Text Color', 'pennews' ),
	'penci_footer_signup_input_border'  => esc_html__( 'Input Border Color', 'pennews' ),
	'penci_footer_signup_input_color'   => esc_html__( 'Input Text Color', 'pennews' ),
	'penci_footer_signup_iplace_color'  => esc_html__( 'Input Placeholder Color', 'pennews' ),
	'penci_footer_signup_submit_bg'     => esc_html__( 'Submit Button Background Color', 'pennews' ),
	'penci_footer_signup_submit_color'  => esc_html__( 'Submit Button Text Color', 'pennews' ),
	'penci_footer_signup_submit_hbg'    => esc_html__( 'Submit Button Hover Background Color', 'pennews' ),
	'penci_footer_signup_submit_hcolor' => esc_html__( 'Submit Button Hover Text Color', 'pennews' ),
);

foreach ( $options_color_archive as $key => $label ) {

	$wp_customize->add_setting( $key, array(
		'default'           => penci_default_setting( $key ),
		'sanitize_callback' => array( $sanitizer, 'hex_color' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
		'label'       => $label,
		'section'     => 'penci_signup_footer',
		'settings'    => $key,
	) ) );
}
