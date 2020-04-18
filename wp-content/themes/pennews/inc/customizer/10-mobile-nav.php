<?php
$section_color_mobile_nav = 'penci_section_color_mobile_nav';
$wp_customize->add_section( $section_color_mobile_nav, array(
	'title'       => esc_html__( 'Vertical Mobile Nav', 'pennews' ),
	'description' => esc_html__( 'Resize browser width smaller to see change.', 'pennews' ),
	'priority'    => 9,

) );

$wp_customize->add_setting( 'penci_mobile_logo_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_mobile_logo_heading', array(
	'label'    => esc_html__( 'Logo setting', 'pennews' ),
	'section'  => $section_color_mobile_nav,
	'settings' => 'penci_mobile_logo_heading',
	'type'     => 'heading',
	'priority' => 1,
) ) );
// Disable Logo on Mobile Nav
$wp_customize->add_setting( 'hide_mobile_nav_logo', array(
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'hide_mobile_nav_logo',
	array(
		'label'    => esc_html__( 'Disable Logo on Mobile Nav', 'pennews' ),
		'section'  => $section_color_mobile_nav,
		'type'     => 'checkbox',
		'settings' => 'hide_mobile_nav_logo',
	)
) );

$wp_customize->add_setting( 'penci_text_logo_mobile_nav', array(
	'sanitize_callback' => array( $sanitizer, 'text' ),
	'default'           => esc_html( 'PenNews' ),
	'priority'          => 1,
) );
$wp_customize->add_control( 'penci_text_logo_mobile_nav', array(
	'label'    => esc_html__( 'Text Logo With Mobile Nav', 'pennews' ),
	'section'  => $section_color_mobile_nav,
	'settings' => 'penci_text_logo_mobile_nav',
) );

$wp_customize->add_setting( 'penci_font_textlogo_mobile_nav', array(
	'default'           => penci_default_setting( 'penci_font_textlogo_mobile_nav' ),
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_font_textlogo_mobile_nav', array(
	'label'       => esc_html__( 'Font For Text Logo With Mobile Nav', 'pennews' ),
	'section'     => $section_color_mobile_nav,
	'settings'    => 'penci_font_textlogo_mobile_nav',
	'description' => 'Default font is "Teko"',
	'type'        => 'select',
	'choices'     => penci_all_fonts()
) );

$wp_customize->add_setting( 'penci_fweight_textlogo_mobile_nav', array(
	'default'           => '700',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );

$wp_customize->add_control( 'penci_fweight_textlogo_mobile_nav', array(
	'label'    => esc_html__( 'Font Weight For Text Logo With Mobile Nav', 'pennews' ),
	'section'  => $section_color_mobile_nav,
	'settings' => 'penci_fweight_textlogo_mobile_nav',
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
$wp_customize->add_setting( 'penci_fsize_textlogo_mobile_nav', array(
	'default'           => penci_default_setting( 'penci_fsize_textlogo_mobile_nav' ),
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_fsize_textlogo_mobile_nav', array(
	'label'    => esc_html__( 'Custom Size Of Text Logo With Mobile Nav', 'pennews' ),
	'section'  => $section_color_mobile_nav,
	'settings' => 'penci_fsize_textlogo_mobile_nav',
	'type'     => 'font_size',
) ) );
/* End menu mobile text logo */

$wp_customize->add_setting( 'mobile_nav_logo', array(
	'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mobile_nav_logo', array(
	'label'    => esc_html__( 'Logo', 'pennews' ),
	'section'  => $section_color_mobile_nav,
	'settings' => 'mobile_nav_logo',
) ) );

$wp_customize->add_setting( 'mobile_nav_logo_retina', array(
	'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mobile_nav_logo_retina', array(
	'label'    => esc_html__( 'Logo (Retina Version)', 'pennews' ),
	'section'  => $section_color_mobile_nav,
	'settings' => 'mobile_nav_logo_retina',
) ) );


$wp_customize->add_setting( 'penci_mobile_custom_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_mobile_custom_heading', array(
	'label'    => esc_html__( 'Custom setting', 'pennews' ),
	'section'  => $section_color_mobile_nav,
	'settings' => 'penci_mobile_custom_heading',
	'type'     => 'heading',
) ) );

$wp_customize->add_setting( 'penci_mobile_style', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_mobile_style', array(
	'label'    => esc_html__( 'Mobile Nav Style', 'pennews' ),
	'section'  => $section_color_mobile_nav,
	'settings' => 'penci_mobile_style',
	'type'     => 'select',
	'choices'  => array(
		''          => esc_html__( 'Default', 'pennews' ),
		'fullwidth' => esc_html__( 'FullWidth', 'pennews' ),
	)
) );

$mmoble_list_check = array(
	'penci_hide_socail_mobile' => esc_html__( 'Disable Social Icons', 'pennews' ),
);

foreach ( $mmoble_list_check as $id_option => $label_option ) {
	$wp_customize->add_setting( $id_option, array(
		'sanitize_callback' => array( $sanitizer, 'checkbox' ),
	) );

	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		$id_option,
		array(
			'label'    => $label_option,
			'section'  => $section_color_mobile_nav,
			'type'     => 'checkbox',
			'settings' => $id_option,
		)
	) );
}

$wp_customize->add_setting( 'penci_mobile_bg', array(
	'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'penci_mobile_bg', array(
	'label'    => esc_html__( 'Mobile Nav Background Image', 'pennews' ),
	'section'  => $section_color_mobile_nav,
	'settings' => 'penci_mobile_bg',
) ) );


$wp_customize->add_setting( 'penci_mobile_nav_textlogo_fsize', array(
	'sanitize_callback' => array( $sanitizer, 'html' )
) );
$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_mobile_nav_textlogo_fsize', array(
	'label'    => esc_html__( 'Custom Font Size For Text Logo', 'pennews' ),
	'section'  => $section_color_mobile_nav,
	'settings' => 'penci_mobile_nav_textlogo_fsize',
	'type'     => 'number',
) ) );


$wp_customize->add_setting( 'penci_mobile_nav_menu_font_size', array(
	'sanitize_callback' => array( $sanitizer, 'html' )
) );
$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_mobile_nav_menu_font_size', array(
	'label'    => esc_html__( 'Custom Font Size For Menu Mobile', 'pennews' ),
	'section'  => $section_color_mobile_nav,
	'settings' => 'penci_mobile_nav_menu_font_size',
	'type'     => 'number',
) ) );

/**
 *  Colors
 */
$wp_customize->add_setting( 'penci_mobile_nav_colors_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_mobile_nav_colors_heading', array(
	'label'    => esc_html__( 'Colors', 'pennews' ),
	'section'  => $section_color_mobile_nav,
	'settings' => 'penci_mobile_nav_colors_heading',
	'type'     => 'heading',
) ) );


$options_color_mobile_nav = array(
	'mobile_nav_bg'             => esc_html__( 'Mobile Nav Background', 'pennews' ),
	'mobile_overlay_color'      => esc_html__( 'Mobile Nav Close Overlay Color', 'pennews' ),
	'mobile_close_bg'           => esc_html__( 'Mobile Nav Close Button Background', 'pennews' ),
	'mobile_close_color'        => esc_html__( 'Mobile Nav Close Button Icon Color', 'pennews' ),
	'mobile_accent_color'       => esc_html__( 'Mobile Nav Accent Color', 'pennews' ),
	'mobile_accent_hover_color' => esc_html__( 'Mobile Nav Accent Hover Color', 'pennews' ),
	'mobile_items_border'       => esc_html__( 'Mobile Nav Menu Items Border Color', 'pennews' ),
);

foreach ( $options_color_mobile_nav as $key => $label ) {
	$wp_customize->add_setting( $key, array(
		'sanitize_callback' => array( $sanitizer, 'hex_color' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
		'label'    => $label,
		'section'  => $section_color_mobile_nav,
		'settings' => $key,
	) ) );
}