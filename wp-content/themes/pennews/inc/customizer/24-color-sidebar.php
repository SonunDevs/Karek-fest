<?php
$section_color_sidebar = 'penci_section_color_sidebar';

$wp_customize->add_section( $section_color_sidebar, array(
	'title'    => esc_html__( 'Color for Sidebar', 'pennews' ),
	'priority' => 13,
) );

$options_color_sidebar = array(
	'pcolor_sidebar_heading_blocktitle' => esc_html__( 'Widget Heading block colors', 'pennews' ),
	'pcolor_sidebar_bgtitle'            => esc_html__( 'Background Heading Text Color', 'pennews' ),
	'pcolor_sidebar_title'              => esc_html__( 'Title Color', 'pennews' ),
	'pcolor_sidebar_htitle'             => esc_html__( 'Title Hover Color', 'pennews' ),

	'pcolor_sidebar_bordertop'     => esc_html__( 'Border Top Color', 'pennews' ),
	'pcolor_sidebar_border_bottom' => esc_html__( 'Border Bottom Color', 'pennews' ),
	'pcolor_sidebar_border_left'   => esc_html__( 'Border Left Color', 'pennews' ),
	'pcolor_sidebar_border_right'  => esc_html__( 'Border Right Color', 'pennews' ),

	'pcolor_sidebar_border_line'  => esc_html__( 'Custom Line Color For Style 6, 11', 'pennews' ),

	'pcolor_sidebar_heading_normal' => esc_html__( 'Widget colors', 'pennews' ),
	'pcolor_sidebar_link'           => esc_html__( 'Link Colors', 'pennews' ),
	'pcolor_sidebar_hlink'          => esc_html__( 'Link Hover Colors', 'pennews' ),
	'pcolor_sidebar_text_color'     => esc_html__( 'Custom Text Colors', 'pennews' ),
	'pcolor_sidebar_meta_color'     => esc_html__( 'Custom Post Meta Colors', 'pennews' ),
	'pcolor_sidebar_backg_color'    => esc_html__( 'Custom Background Colors', 'pennews' ),

	'pcolor_sidebar_heading_tagcolud' => esc_html__( 'Tag Could colors', 'pennews' ),
	'pcolor_sb_tagcolud_color'        => esc_html__( 'Tag Could Text Color', 'pennews' ),
	'pcolor_sb_tagcolud_borcolor'     => esc_html__( 'Tag Could Border Color', 'pennews' ),
	'pcolor_sb_tagcolud_bgcolor'      => esc_html__( 'Tag Could Background Color', 'pennews' ),
	'pcolor_sb_tagcolud_hcolor'        => esc_html__( 'Tag Could Text Hover Color', 'pennews' ),
	'pcolor_sb_tagcolud_hborcolor'     => esc_html__( 'Tag Could Border Hover Color', 'pennews' ),
	'pcolor_sb_tagcolud_hbgcolor'      => esc_html__( 'Tag Could Background Hover Color', 'pennews' )
);

foreach ( $options_color_sidebar as $key => $label ) {

	if ( false !== strpos( $key, 'pcolor_sidebar_heading' ) ) {

		$wp_customize->add_setting( $key, array(
			'sanitize_callback' => 'esc_url_raw'
		) );
		$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, $key, array(
			'label'    => $label,
			'section'  => $section_color_sidebar,
			'settings' => $key,
			'type'     => 'heading',
		) ) );

		continue;
	}

	$wp_customize->add_setting( $key, array(
		'default'           => penci_default_setting( $key ),
		'sanitize_callback' => array( $sanitizer, 'hex_color' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
		'label'       => $label,
		'section'     => $section_color_sidebar,
		'settings'    => $key,
		'description' => ''
	) ) );
}