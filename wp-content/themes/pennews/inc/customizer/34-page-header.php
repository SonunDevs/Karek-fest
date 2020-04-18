<?php
$section_page_header  = 'penci_page_header';
// Menu hbg
$wp_customize->add_section( $section_page_header, array(
	'title'    => esc_html__( 'Page Header Options', 'pennews' ),
	'priority' => 4,
) );

// Enable Menu hbg
$wp_customize->add_setting( 'penci_pheader_show', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_pheader_show',
	array(
		'label'    => esc_html__( 'Enable Page Header for Pages', 'pennews' ),
		'section'  => $section_page_header,
		'type'     => 'checkbox',
		'settings' => 'penci_pheader_show',
	)
) );

$wp_customize->add_setting( 'penci_pheader_single_show', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_pheader_single_show',
	array(
		'label'    => esc_html__( 'Enable Page Header for Singe Posts', 'pennews' ),
		'section'  => $section_page_header,
		'type'     => 'checkbox',
		'settings' => 'penci_pheader_single_show',
	)
) );

$wp_customize->add_setting( 'penci_pheader_hideline', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_pheader_hideline',
	array(
		'label'    => esc_html__( 'Hide Line Below Title', 'pennews' ),
		'section'  => $section_page_header,
		'type'     => 'checkbox',
		'settings' => 'penci_pheader_hideline',
	)
) );

$wp_customize->add_setting( 'penci_pheader_hidebead', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_pheader_hidebead',
	array(
		'label'    => esc_html__( 'Hide Breadcrumbs', 'pennews' ),
		'section'  => $section_page_header,
		'type'     => 'checkbox',
		'settings' => 'penci_pheader_hidebead',
	)
) );

$wp_customize->add_setting( 'penci_pheader_align', array(
	'default' => 'center',
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );

$wp_customize->add_control( 'penci_pheader_align', array(
	'label'    => esc_html__( 'Text Align', 'pennews' ),
	'section'  => $section_page_header,
	'settings' => 'penci_pheader_align',
	'type'     => 'select',
	'choices'  => array(
		'left'    => esc_html__( 'Left', 'pennews' ),
		'center'  => esc_html__( 'Center', 'pennews' ),
		'right'   => esc_html__( 'Right', 'pennews' ),
	)
) );

$wp_customize->add_setting( 'penci_pheader_width', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );

$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_pheader_width', array(
	'label'    => esc_html__( 'Custom Container Width for Page Header', 'pennews' ),
	'section'  => $section_page_header,
	'settings' => 'penci_pheader_width',
	'type'     => 'font_size',
	'description' => esc_html__( 'By default, container width for page header will follow the container width for header','pennews' )
) ) );

$wp_customize->add_setting( 'penci_pheader_ptop', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );

$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_pheader_ptop', array(
	'label'    => esc_html__( 'Padding top', 'pennews' ),
	'section'  => $section_page_header,
	'settings' => 'penci_pheader_ptop',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_pheader_pbottom', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );

$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_pheader_pbottom', array(
	'label'    => esc_html__( 'Padding bottom', 'pennews' ),
	'section'  => $section_page_header,
	'settings' => 'penci_pheader_pbottom',
	'type'     => 'font_size',
) ) );


$wp_customize->add_setting( 'penci_pheader_turn_offup', array(
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_pheader_turn_offup',
	array(
		'label'    => esc_html__( 'Turn Off Uppercase for Title', 'pennews' ),
		'section'  => $section_page_header,
		'type'     => 'checkbox',
		'settings' => 'penci_pheader_turn_offup',
	)
) );

$wp_customize->add_setting( 'penci_pheader_title_pbottom', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );

$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_pheader_title_pbottom', array(
	'label'    => esc_html__( 'Custom Padding Bottom for Title', 'pennews' ),
	'section'  => $section_page_header,
	'settings' => 'penci_pheader_title_pbottom',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_pheader_title_mbottom', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );

$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_pheader_title_mbottom', array(
	'label'    => esc_html__( 'Custom Margin Bottom for Title', 'pennews' ),
	'section'  => $section_page_header,
	'settings' => 'penci_pheader_title_mbottom',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_pheader_title_fsize', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );

$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_pheader_title_fsize', array(
	'label'    => esc_html__( 'Custom Font Size for Title', 'pennews' ),
	'section'  => $section_page_header,
	'settings' => 'penci_pheader_title_fsize',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_pheader_fonttitle', array(
	'default'           => penci_default_setting( 'penci_pheader_fonttitle' ),
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_pheader_fonttitle', array(
	'label'       => esc_html__( 'Font For Title', 'pennews' ),
	'section'     => $section_page_header,
	'settings'    => 'penci_pheader_fonttitle',
	'description' => 'Default font is "Mukta Vaani"',
	'type'        => 'select',
	'choices'     => penci_all_fonts()
) );

$wp_customize->add_setting( 'penci_pheader_fwtitle', array(
	'default'           => '600',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_pheader_fwtitle', array(
	'label'    => esc_html__( 'Font Weight For Title', 'pennews' ),
	'section'  => $section_page_header,
	'settings' => 'penci_pheader_fwtitle',
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

$wp_customize->add_setting( 'penci_pheader_bread_fsize', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );

$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_pheader_bread_fsize', array(
	'label'    => esc_html__( 'Custom Font Size for Breadcrumb', 'pennews' ),
	'section'  => $section_page_header,
	'settings' => 'penci_pheader_bread_fsize',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_pheader_colors_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_pheader_colors_heading', array(
	'label'    => esc_html__( 'Colors', 'pennews' ),
	'section'  =>  $section_page_header,
	'settings' => 'penci_pheader_colors_heading',
	'type'     => 'heading',
) ) );

$wp_customize->add_setting( 'penci_pheader_bgimg', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'penci_pheader_bgimg', array(
	'label'    => esc_html__( 'Background Image', 'pennews'),
	'section'  => $section_page_header,
	'settings' => 'penci_pheader_bgimg',
) ) );

$pheader_colors = array(
	'penci_pheader_bgcolor'   => esc_html__( 'Background Color', 'pennews' ),
	'penci_pheader_title_color'   => esc_html__( 'Title Color', 'pennews' ),
	'penci_pheader_bread_color'   => esc_html__( 'Breadcrumbs Text Color', 'pennews' ),
	'penci_pheader_bread_hcolor'  => esc_html__( 'Breadcrumbs Hover Text Color', 'pennews' ),
);

foreach ( $pheader_colors as $key => $label ) {
	$wp_customize->add_setting( $key, array(
		'sanitize_callback' => array( $sanitizer, 'hex_color' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
		'label'    => $label,
		'section'  => $section_page_header,
		'settings' => $key,
	) ) );
}