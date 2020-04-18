<?php
$section_color_footer = 'penci_section_color_footer';

$wp_customize->add_section( $section_color_footer, array(
	'title'    => esc_html__( 'Color for Footer', 'pennews' ),
	'priority' => 14,
) );


$wp_customize->add_setting( 'penci_footer_background_img', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'penci_footer_background_img', array(
	'label'    => esc_html__( 'Footer Background Image', 'pennews' ),
	'section'  => $section_color_footer,
	'settings' => 'penci_footer_background_img',
) ) );

$options_color_footer = array(
	'penci_footer_bg'         => esc_html__( 'Footer Background Color', 'pennews' ),
	'penci_footer_border_top' => esc_html__( 'Footer Border Top Color', 'pennews' ),
	'penci_footer_logo_color' => esc_html__( 'Footer Logo Color', 'pennews' ),

	'penci_footer_heading_widget'            => esc_html__( 'Footer Widget Area', 'pennews' ),
	'penci_footer_widget_area_bg'            => esc_html__( 'Footer Widget Background Color', 'pennews' ),
	'penci_footer_widget_area_border_bottom' => esc_html__( 'Footer Widget Area Border Bottom Color', 'pennews' ),
	'penci_footer_widget_area_title_color'   => esc_html__( 'Footer Widget Heading Titles Color', 'pennews' ),
	'penci_footer_widget_title_border_color' => esc_html__( 'Footer Widget Heading Titles Border Color', 'pennews' ),
	'penci_footer_widget_title_bg_color'     => esc_html__( 'Footer Widget Heading Titles Background Color For Style 2,4', 'pennews' ),
	'penci_footer_widget_list_border_color'  => esc_html__( 'Footer Widget Area Border Color for List', 'pennews' ),
	'penci_footer_widget_color'              => esc_html__( 'Footer Widget Text Color', 'pennews' ),
	'penci_footer_widget_accent_color'       => esc_html__( 'Footer Widget Accent Color', 'pennews' ),
	'penci_footer_widget_accent_hover_color' => esc_html__( 'Footer Widget Accent Hover Color', 'pennews' ),

	'penci_footer_heading_fbottom'       => esc_html__( 'Footer Bottom', 'pennews' ),
	'penci_footer_bottom_bg'             => esc_html__( 'Footer Bottom Background Color', 'pennews' ),
	'penci_footer_bottom_text_color'     => esc_html__( 'Footer Bottom Text Color', 'pennews' ),
	'penci_footer_bottom_title_cr_color' => esc_html__( 'Custom Color For Follow us or About US Text With Footer Bottom Style 2', 'pennews' ),
	'penci_footer_bottom_link_color'     => esc_html__( 'Footer Bottom Link Color', 'pennews' ),
	'penci_footer_bottom_link_hcolor'    => esc_html__( 'Footer Bottom Link Hover Color', 'pennews' ),

	// Social style
	'penci_footer_heading_social_media'      => esc_html__( 'Footer Social Media', 'pennews' ),
	'penci_footer_icon_color'                => esc_html__( 'Footer Social Icons Color', 'pennews' ),
	'penci_footer_icon_bg_color'             => esc_html__( 'Footer Social Icons Background Color', 'pennews' ),
	'penci_footer_icon_hover_color'          => esc_html__( 'Footer Social Icons Hover Color', 'pennews' ),
	'penci_footer_icon_bg_hover_color'       => esc_html__( 'Footer Social Icons Background Hover Color', 'pennews' ),

	// COPYRIGHT TEXT
	'penci_footer_heading_copyright_text'    => esc_html__( 'Footer CopyRight Text', 'pennews' ),
	'penci_footer_copyright_bg_color'        => esc_html__( 'Footer Copyright & Menu Background Color', 'pennews' ),
	'penci_footer_copyright_text_color'      => esc_html__( 'Footer Copyright Text Color', 'pennews' ),
	'penci_footer_copyright_link_color'      => esc_html__( 'Footer Copyright Links Color', 'pennews' ),
	'penci_footer_heading_menu_color'        => esc_html__( 'Footer Menu', 'pennews' ),
	'penci_footer_menu_link_color'           => esc_html__( 'Footer Menu Color', 'pennews' ),
	'penci_footer_menu_link_hcolor'          => esc_html__( 'Footer Menu Hover Color', 'pennews' ),

	'penci_footer_heading_gototop' => esc_html__( 'Footer Go To Top', 'pennews' ),
	'penci_gototop_color'          => esc_html__( 'Go To Top Color', 'pennews' ),
	'penci_gototop_bgcolor'        => esc_html__( 'Go To Top Background Color', 'pennews' ),
	'penci_gototop_hover_color'    => esc_html__( 'Go To Top Hover Color', 'pennews' ),
	'penci_gototop_hover_bgcolor'  => esc_html__( 'Go To Top Hover Background Color', 'pennews' ),

);

foreach ( $options_color_footer as $key => $label ) {

	if ( false === strpos( $key, 'penci_footer_heading_' ) ) {

		$wp_customize->add_setting( $key, array(
			'sanitize_callback' => array( $sanitizer, 'hex_color' ),
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
			'label'    => $label,
			'section'  => $section_color_footer,
			'settings' => $key,
			'description' => ''
		) ) );

		continue;
	}

	$wp_customize->add_setting( $key, array(
		'sanitize_callback' => 'esc_url_raw'
	) );
	$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, $key, array(
		'label'    => $label,
		'section'  => $section_color_footer,
		'settings' => $key,
		'type'     => 'heading',
	) ) );

}