<?php
$wp_customize->add_section( 'penci_panel_ajaxsearch', array(
	'title'    => esc_html__( 'Ajax Search Options', 'pennews' ),
	'priority' => 3,
) );

// Enable Top Bar
$wp_customize->add_setting( 'penci_enable_ajaxsearch', array(
	'default'           => 1,
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_enable_ajaxsearch',
	array(
		'label'    => esc_html__( 'Enable Ajax Search', 'pennews' ),
		'section'  => 'penci_panel_ajaxsearch',
		'type'     => 'checkbox',
		'settings' => 'penci_enable_ajaxsearch',
	)
) );

$wp_customize->add_setting( 'penci_del_pages_fsearch', array(
	'default'           => 1,
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_del_pages_fsearch',
	array(
		'label'    => esc_html__( 'Exclude Pages From Search Results', 'pennews' ),
		'section'  => 'penci_panel_ajaxsearch',
		'type'     => 'checkbox',
		'settings' => 'penci_del_pages_fsearch',
	)
) );

// Amount
$wp_customize->add_setting( 'penci_ajaxsearch_amount', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => 4,
) );
$wp_customize->add_control( new Penci_Customize_Number_Control( $wp_customize, 'penci_ajaxsearch_amount', array(
	'label'    => esc_html__( 'Amount of Posts Display', 'pennews' ),
	'section'  => 'penci_panel_ajaxsearch',
	'settings' => 'penci_ajaxsearch_amount',
	'type'     => 'number',
) ) );

$ajaxsearch = array(
	'penci_ajaxsearch_hide_date'       => esc_html__( 'Hide Post date', 'pennews' ),
	'penci_ajaxsearch_hide_comment'    => esc_html__( 'Hide Post Comment', 'pennews' ),
	'penci_ajaxsearch_hide_postformat' => esc_html__( 'Hide Icon Post Format', 'pennews' ),
);

foreach ( $ajaxsearch as $id_option => $label_option ) {
	$wp_customize->add_setting( $id_option, array(
		'sanitize_callback' => array( $sanitizer, 'checkbox' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		$id_option,
		array(
			'label'    => $label_option,
			'section'  => 'penci_panel_ajaxsearch',
			'type'     => 'checkbox',
			'settings' => $id_option,
		)
	) );
}

$wp_customize->add_setting( 'penci_ajaxsearch_colors_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_ajaxsearch_colors_heading', array(
	'label'    => esc_html__( 'Custom Colors', 'pennews' ),
	'section'  => 'penci_panel_ajaxsearch',
	'settings' => 'penci_ajaxsearch_colors_heading',
	'type'     => 'heading',
) ) );

$ajaxsearch_color = array(
	'penci_ajaxsearch_bg_color'         => esc_html__( 'Background Color', 'pennews' ),
	'penci_ajaxsearch_title_color'      => esc_html__( 'Posts Title Color', 'pennews' ),
	'penci_ajaxsearch_title_hcolor'     => esc_html__( 'Posts Title Hover Color', 'pennews' ),
	'penci_ajaxsearch_postmeta_color'   => esc_html__( 'Posts Meta Color', 'pennews' ),
	'penci_ajaxsearch_border_top_color' => esc_html__( 'Border Top Color', 'pennews' ),
	'penci_ajaxsearch_border_color'     => esc_html__( 'Border Color', 'pennews' ),
);

foreach ( $ajaxsearch_color as $key => $label ) {

	$wp_customize->add_setting( $key, array(
		'default'           => penci_default_setting( $key ),
		'sanitize_callback' => array( $sanitizer, 'hex_color' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
		'label'       => $label,
		'section'     => 'penci_panel_ajaxsearch',
		'settings'    => $key,
		'description' => ''
	) ) );
}