<?php

$section_menu_hbg  = 'penci_menu_hbg';
// Menu hbg
$wp_customize->add_section( 'penci_menu_hbg', array(
	'title'    => esc_html__( 'Vertical Nav & Menu Hamburger Options', 'pennews' ),
	'priority' => 3,
	'description' => esc_html__( 'Most of the options here apply for both Vertical Navigation & Hamburger Menu. When you enable Vertical Navigation - of course, the Hamburger Menu will does not display.','pennews' )
) );

//Enable Menu hbg
$wp_customize->add_setting( 'penci_menu_hbg_show', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_menu_hbg_show',
	array(
		'label'    => esc_html__( 'Enable Menu Hamburger', 'pennews' ),
		'section'  => $section_menu_hbg,
		'type'     => 'checkbox',
		'settings' => 'penci_menu_hbg_show',
		'description' => esc_html__( ' If you want to show the Menu Hamburger, empty this. The Menu Hamburger just appears for header styles: 1,2,3,4,5,6,7,8,9,10 & 11', 'pennews' ),
	)
) );
 // Enable Vertical Navigation
$wp_customize->add_setting( 'penci_verttical_nav_show', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_verttical_nav_show',
	array(
		'label'    => esc_html__( 'Enable Vertical Navigation', 'pennews' ),
		'section'  => $section_menu_hbg,
		'type'     => 'checkbox',
		'settings' => 'penci_verttical_nav_show'
	)
) );

$wp_customize->add_setting( 'penci_vertical_nav_remove_header', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_vertical_nav_remove_header',
	array(
		'label'    => esc_html__( 'Completely Delete The Header When Enable Vertical Navigation', 'pennews' ),
		'section'  => $section_menu_hbg,
		'type'     => 'checkbox',
		'settings' => 'penci_vertical_nav_remove_header'
	)
) );

$wp_customize->add_setting( 'penci_menu_hbg_pos', array(
	'default'           => 'left',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_menu_hbg_pos', array(
	'label'    => esc_html__( 'Position in Page', 'pennews' ),
	'section'  => $section_menu_hbg,
	'settings' => 'penci_menu_hbg_pos',
	'type'     => 'select',
	'choices'  => array(
		'left'  => esc_html__( 'Left', 'pennews' ),
		'right' => esc_html__( 'Right', 'pennews' )
	)
) );

// Font size
$wp_customize->add_setting( 'penci_menu_hbg_width', array(
	'default'           => penci_default_setting( 'penci_menu_hbg_width' ),
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_menu_hbg_width', array(
	'label'    => esc_html__( 'Custom Width for Vertical Nav & Menu Hamburger ( Min is 270 - Max is 500 )', 'pennews' ),
	'section'  => $section_menu_hbg,
	'settings' => 'penci_menu_hbg_width',
	'type'     => 'font_size',
) ) );


// Enable Menu hbg
$wp_customize->add_setting( 'penci_menu_hbg_show_logo', array(
	'default'           => '1',
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_menu_hbg_show_logo',
	array(
		'label'    => esc_html__( 'Show site Branding', 'pennews' ),
		'section'  => $section_menu_hbg,
		'type'     => 'checkbox',
		'settings' => 'penci_menu_hbg_show_logo',
	)
) );

$wp_customize->add_setting( 'penci_menu_hbg_logo', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'penci_menu_hbg_logo', array(
	'label'    => esc_html__( 'Logo', 'pennews'),
	'section'  => $section_menu_hbg,
	'settings' => 'penci_menu_hbg_logo',
) ) );

// Font size
$wp_customize->add_setting( 'penci_menu_hbg_fontsize_textlogo', array(
	'default'           => penci_default_setting( 'penci_menu_hbg_fontsize_textlogo' ),
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_menu_hbg_fontsize_textlogo', array(
	'label'    => esc_html__( 'Custom Size of Text Logo', 'pennews' ),
	'section'  => $section_menu_hbg,
	'settings' => 'penci_menu_hbg_fontsize_textlogo',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_menu_hbg_sitetitle', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_menu_hbg_sitetitle', array(
	'label'    => esc_html__( 'Site Title', 'pennews' ),
	'section'  => $section_menu_hbg,
	'settings' => 'penci_menu_hbg_sitetitle',
) ) );

// Font size
$wp_customize->add_setting( 'penci_menu_hbg_fontsize_sitetitle', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_menu_hbg_fontsize_sitetitle', array(
	'label'    => esc_html__( 'Custom Size of Site Title', 'pennews' ),
	'section'  => $section_menu_hbg,
	'settings' => 'penci_menu_hbg_fontsize_sitetitle',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_menu_hbg_desc', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'textarea' ),
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_menu_hbg_desc', array(
	'label'    => esc_html__( 'Site Description', 'pennews' ),
	'section'  => $section_menu_hbg,
	'settings' => 'penci_menu_hbg_desc',
	'type'     => 'textarea',
) ) );

// Font size
$wp_customize->add_setting( 'penci_menu_hbg_fontsize_desc', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_menu_hbg_fontsize_desc', array(
	'label'    => esc_html__( 'Custom Size of Site Description', 'pennews' ),
	'section'  => $section_menu_hbg,
	'settings' => 'penci_menu_hbg_fontsize_desc',
	'type'     => 'font_size',
) ) );

// Enable Menu hbg
$wp_customize->add_setting( 'penci_menu_hbg_menuoff_upper', array(
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_menu_hbg_menuoff_upper',
	array(
		'label'    => esc_html__( 'Turn Off Uppearcase for Menu Item', 'pennews' ),
		'section'  => $section_menu_hbg,
		'type'     => 'checkbox',
		'settings' => 'penci_menu_hbg_menuoff_upper',
	)
) );

// Font size
$wp_customize->add_setting( 'penci_menu_hbg_fsize_menu', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_menu_hbg_fsize_menu', array(
	'label'    => esc_html__( 'Custom Font Size of Menu Item', 'pennews' ),
	'section'  => $section_menu_hbg,
	'settings' => 'penci_menu_hbg_fsize_menu',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_menu_hbg_footer_text', array(
	'default'           => penci_default_setting( 'penci_menu_hbg_footer_text' ),
	'sanitize_callback' => array( $sanitizer, 'textarea' ),
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_menu_hbg_footer_text', array(
	'label'    => esc_html__( 'Footer Text', 'pennews' ),
	'section'  => $section_menu_hbg,
	'settings' => 'penci_menu_hbg_footer_text',
	'type'     => 'textarea',
) ) );

// Font size
$wp_customize->add_setting( 'penci_menu_hbg_fontsize_ftext', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_menu_hbg_fontsize_ftext', array(
	'label'    => esc_html__( 'Custom Size of Footer Text', 'pennews' ),
	'section'  => $section_menu_hbg,
	'settings' => 'penci_menu_hbg_fontsize_ftext',
	'type'     => 'font_size',
) ) );

// Widget
$wp_customize->add_setting( 'penci_menu_hbgwidget_align', array(
	'default'           => 'center',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_menu_hbgwidget_align', array(
	'label'    => esc_html__( 'Widget Align Title', 'pennews' ),
	'section'  => $section_menu_hbg,
	'settings' => 'penci_menu_hbgwidget_align',
	'type'     => 'select',
	'choices'  => array(
		'left'   => esc_html__( 'Left', 'pennews' ),
		'center' => esc_html__( 'Center', 'pennews' ),
		'right'  => esc_html__( 'Right', 'pennews' ),
	)
) );

// Font size
$wp_customize->add_setting( 'penci_menu_hbgfsize_wtitle', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_menu_hbgfsize_wtitle', array(
	'label'    => esc_html__( 'Custom Size of Widget Title', 'pennews' ),
	'section'  => $section_menu_hbg,
	'settings' => 'penci_menu_hbgfsize_wtitle',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_menu_hbgfweight_wtitle', array(
	'default'           => 'normal',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_menu_hbgfweight_wtitle', array(
	'label'    => esc_html__( 'Font Weight For Widget Title', 'pennews' ),
	'section'  => $section_menu_hbg,
	'settings' => 'penci_menu_hbgfweight_wtitle',
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

$wp_customize->add_setting( 'penci_menu_hbg_showsocial', array(
	'default'           => '1',
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_menu_hbg_showsocial',
	array(
		'label'    => esc_html__( 'Show Social Icons', 'pennews' ),
		'section'  => $section_menu_hbg,
		'type'     => 'checkbox',
		'settings' => 'penci_menu_hbg_showsocial',
	)
) );

$wp_customize->add_setting( 'penci_menu_hbgfsize_social', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => '',
) );

$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_menu_hbgfsize_social', array(
	'label'    => esc_html__( 'Custom Font Size Social Media Icons', 'pennews' ),
	'section'  => $section_menu_hbg,
	'settings' => 'penci_menu_hbgfsize_social',
	'type'     => 'number',
) ) );

$wp_customize->add_setting( 'penci_menu_hbg_wh_social', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );

$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_menu_hbg_wh_social', array(
	'label'    => esc_html__( 'Custom Size ( Width / Height ) Social Media Icons', 'pennews' ),
	'section'  => $section_menu_hbg,
	'settings' => 'penci_menu_hbg_wh_social',
	'type'     => 'number',
) ) );

$wp_customize->add_setting( 'penci_menu_hbg_bgimg', array(
	'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'penci_menu_hbg_bgimg', array(
	'label'    => esc_html__( 'Menu Hamburger Background Image', 'pennews' ),
	'section'  => $section_menu_hbg,
	'settings' => 'penci_menu_hbg_bgimg',
) ) );

$wp_customize->add_setting( 'penci_menu_hbg_colors_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_menu_hbg_colors_heading', array(
	'label'    => esc_html__( 'Colors', 'pennews' ),
	'section'  => $section_menu_hbg,
	'settings' => 'penci_menu_hbg_colors_heading',
	'type'     => 'heading',
) ) );

$options_color_portfolio = array(
	'penci_menu_hbg_bgcolor'            => esc_html__( 'Menu Hamburger Background Color', 'pennews' ),
	'penci_menu_hbgtitle_color'         => esc_html__( 'Site Title Color', 'pennews' ),
	'penci_menu_hbgdesc_hcolor'         => esc_html__( 'Site Description Color', 'pennews' ),
	'penci_menu_hbgaccent_color'        => esc_html__( 'Accent Color', 'pennews' ),
	'penci_menu_hbgaccent_hover_color'  => esc_html__( 'Accent Hover Color', 'pennews' ),
	'penci_menu_hbgitems_border'        => esc_html__( 'Menu Items Border Color', 'pennews' ),
	'penci_menu_hbgfooter_color'        => esc_html__( 'Footer Text Color', 'pennews' ),
	'penci_menu_hbgicon_color'          => esc_html__( 'Social Icons Color', 'pennews' ),
	'penci_menu_hbgicon_bg_color'       => esc_html__( 'Social Icons Background Color', 'pennews' ),
	'penci_menu_hbgicon_hover_color'    => esc_html__( 'Social Icons Hover Color', 'pennews' ),
	'penci_menu_hbgicon_bg_hover_color' => esc_html__( 'Social Icons Background Hover Color', 'pennews' ),

	'penci_mhbg_widget_title_color' => esc_html__( 'Widget Heading Title Color', 'pennews' ),
	'penci_mhbg_widget_line_color'  => esc_html__( 'Widget Heading Line Color', 'pennews' ),
);

foreach ( $options_color_portfolio as $key => $label ) {
	$wp_customize->add_setting( $key, array(
		'sanitize_callback' => array( $sanitizer, 'hex_color' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
		'label'    => $label,
		'section'  => $section_menu_hbg,
		'settings' => $key,
	) ) );
}
