<?php
$section_color_topbar = 'penci_section_color_topbar';

$wp_customize->add_section( $section_color_topbar, array(
	'title'       => esc_html__( 'Color for Topbar', 'pennews' ),
	'priority'    => 11,
) );

$options_color_topbar = array(
	'penci_topbar_bgcolor'     => esc_html__( 'Background Color', 'pennews' ),
	'penci_topbar_color'       => esc_html__( 'Text Color', 'pennews' ),
	'penci_topbar_hover_color' => esc_html__( 'Text Hover Color', 'pennews' ),

	'penci_topbar_tren_bgcolor' => esc_html__( '"Trending now" Background Color', 'pennews' ),
	'penci_topbar_tren_color'   => esc_html__( '"Trending now" Text Color', 'pennews' ),

	'penci_topbar_icon_color'  => esc_html__( 'Icon Color', 'pennews' ),
	'penci_topbar_icon_hcolor' => esc_html__( 'Icon Hover Color', 'pennews' ),

	'penci_topbar_submenu_bgcolor' => esc_html__( 'Background Color', 'pennews' ),
	'penci_topbar_submenu_color'   => esc_html__( 'Text Color', 'pennews' ),
	'penci_topbar_submenu_hcolor'  => esc_html__( 'Text Hover Color', 'pennews' ),
	'penci_topbar_border_items'    => esc_html__( 'Border Color', 'pennews' ),
);

foreach ( $options_color_topbar as $key => $label ) {

	if( 'penci_topbar_submenu_bgcolor' == $key ) {
		$wp_customize->add_setting( 'penci_topbar_submenu_colors_heading', array(
			'sanitize_callback' => 'esc_url_raw'
		) );
		$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_topbar_submenu_colors_heading', array(
			'label'    => esc_html__( 'Submenu Colors', 'pennews' ),
			'section'  => $section_color_topbar,
			'settings' => 'penci_topbar_submenu_colors_heading',
			'type'     => 'heading',
		) ) );
	}

	$wp_customize->add_setting( $key, array(
		'default'           => penci_default_setting( $key ),
		'sanitize_callback' => array( $sanitizer, 'hex_color' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
		'label'    => $label,
		'section'  => $section_color_topbar,
		'settings' => $key,
		'description' => ''
	) ) );
}