<?php
$wp_customize->add_section( 'penci_panel_header', array(
	'title'    => esc_html__( 'Logo and Header Options', 'pennews' ),
	'priority' => 3,
) );


/******** Logo *********/

$wp_customize->add_setting( 'penci_logo_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_logo_heading', array(
	'label'    => esc_html__( 'Logo settings', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_logo_heading',
	'type'     => 'heading',
	'priority' => 1,
) ) );

/************ Text logo ************/
$wp_customize->add_setting( 'penci_use_textlogo', array(
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
	'default'           => 1,
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_use_textlogo',
	array(
		'label'    => esc_html__( 'Use Text Logo', 'pennews' ),
		'section'  => 'penci_panel_header',
		'type'     => 'checkbox',
		'settings' => 'penci_use_textlogo',
		'priority' => 2,
	)

) );

$wp_customize->add_setting( 'penci_text_logo', array(
	'sanitize_callback' => array( $sanitizer, 'text' ),
	'default'           => esc_html( 'PenNews' ),
	'priority'          => 1,
) );
$wp_customize->add_control( 'peci_text_logo', array(
	'label'    => esc_html__( 'Text Logo', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_text_logo',
	'priority' => 3,
) );

$wp_customize->add_setting( 'penci_font_textlogo', array(
	'default'           => penci_default_setting( 'penci_font_textlogo' ),
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_font_textlogo', array(
	'label'       => esc_html__( 'Font For Text Logo', 'pennews' ),
	'section'     => 'penci_panel_header',
	'settings'    => 'penci_font_textlogo',
	'description' => 'Default font is "Teko"',
	'type'        => 'select',
	'priority' => 4,
	'choices'     => penci_all_fonts()
) );

$wp_customize->add_setting( 'penci_font_weight_textlogo', array(
	'default'           => '700',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_font_weight_textlogo', array(
	'label'    => esc_html__( 'Font Weight For Text Logo', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_font_weight_textlogo',
	'type'     => 'select',
	'priority' => 5,
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
$wp_customize->add_setting( 'penci_fontsize_textlogo', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_fontsize_textlogo', array(
	'label'    => esc_html__( 'Custom Size Of Text Logo', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_fontsize_textlogo',
	'type'     => 'font_size',
	'priority' => 6,
) ) );

// Logo retina
$wp_customize->add_setting( 'penci_logo_retina', array(
	'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'penci_logo_retina', array(
	'label'       => esc_html__( 'Upload Logo (Retina Version)', 'pennews' ),
	'section'     => 'penci_panel_header',
	'settings'    => 'penci_logo_retina',
	'description' => wp_kses_post( __( 'Note: Use the exact same file name as your regular logo file and then just put @2x at the end of the name. For example logo@2x.png', 'pennews' ) ),
) ) );

// Logo retina
$wp_customize->add_setting( 'penci_logo_trans', array(
	'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'penci_logo_trans', array(
	'label'       => esc_html__( 'Upload Logo for Transparent Header )', 'pennews' ),
	'section'     => 'penci_panel_header',
	'settings'    => 'penci_logo_trans',
	'description' => wp_kses_post( __( 'Note Important: This option apply when you use transparent header only & the main menu is not sticky yet. The colors options for header transparent, please check via Customize > Colors for Header ', 'pennews' ) ),
) ) );

// Heading padding
$wp_customize->add_setting( 'penci_logo_padding_top', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_logo_padding_top', array(
	'label'    => esc_html__( 'Logo Header Padding Top', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_logo_padding_top',
	'type'     => 'number',
) ) );

$wp_customize->add_setting( 'penci_logo_padding_bottom', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => '',
) );
$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_logo_padding_bottom', array(
	'label'    => esc_html__( 'Logo Header Padding Bottom', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_logo_padding_bottom',
	'type'     => 'number',
) ) );

// Logo width
$wp_customize->add_setting( 'penci_logo_width', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_logo_width', array(
	'label'    => esc_html__( 'Logo Max Width For Header', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_logo_width',
	'type'     => 'number',
) ) );

// Logo mobile
$wp_customize->add_setting( 'penci_logo_mobile_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_logo_mobile_heading', array(
	'label'    => esc_html__( 'Logo For Mobile Nav Settings', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_logo_mobile_heading',
	'type'     => 'heading',
) ) );

$wp_customize->add_setting( 'hide_logo_header_mobile', array(
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'hide_logo_header_mobile',
	array(
		'label'    => esc_html__( 'Disable Logo on Header Mobile', 'pennews' ),
		'section'  => 'penci_panel_header',
		'type'     => 'checkbox',
		'settings' => 'hide_logo_header_mobile',
	)
) );

/************ Text logo  header mobile ************/

$wp_customize->add_setting( 'penci_text_logo_on_mobile', array(
	'sanitize_callback' => array( $sanitizer, 'text' ),
	'default'           => esc_html( 'PenNews' ),
	'priority'          => 1,
) );
$wp_customize->add_control( 'penci_text_logo_on_mobile', array(
	'label'    => esc_html__( 'Text Logo With Header Mobile', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_text_logo_on_mobile',
) );

$wp_customize->add_setting( 'penci_font_textlogo_on_mobile', array(
	'default'           => penci_default_setting( 'penci_font_textlogo_on_mobile' ),
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_font_textlogo_on_mobile', array(
	'label'       => esc_html__( 'Font For Text Logo With Header Mobile', 'pennews' ),
	'section'     => 'penci_panel_header',
	'settings'    => 'penci_font_textlogo_on_mobile',
	'description' => 'Default font is "Teko"',
	'type'        => 'select',
	'choices'     => penci_all_fonts()
) );

$wp_customize->add_setting( 'penci_font_weight_textlogo_on_mobile', array(
	'default'           => '700',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_font_weight_textlogo_on_mobile', array(
	'label'    => esc_html__( 'Font Weight For Text Logo With Header Mobile', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_font_weight_textlogo_on_mobile',
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
$wp_customize->add_setting( 'penci_fontsize_textlogo_on_mobile', array(
	'default'           => penci_default_setting( 'penci_fontsize_textlogo_on_mobile' ),
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_fontsize_textlogo_on_mobile', array(
	'label'    => esc_html__( 'Custom Size Of Text Logo With Header Mobile', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_fontsize_textlogo_on_mobile',
	'type'     => 'font_size',
) ) );
/* End menu mobile text logo */

$wp_customize->add_setting( 'penci_logo_header_mobile', array(
	'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'penci_logo_header_mobile', array(
	'label'       => esc_html__( 'Logo for Mobile Nav', 'pennews' ),
	'section'     => 'penci_panel_header',
	'settings'    => 'penci_logo_header_mobile',
) ) );

$wp_customize->add_setting( 'penci_logo_header_mobile_retina', array(
	'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'penci_logo_header_mobile_retina', array(
	'label'    => esc_html__( 'Logo for Mobile Nav ( Rentina Version )', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_logo_header_mobile_retina',
) ) );

/************ Slogan ************/
$wp_customize->add_setting( 'penci_text_slogan_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_text_slogan_heading', array(
	'label'    => esc_html__( 'Slogan setting', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_text_slogan_heading',
	'type'     => 'heading',

) ) );

$wp_customize->add_setting( 'penci_header_slogan_text', array(
	'sanitize_callback' => array( $sanitizer, 'textarea' ),
) );

$wp_customize->add_control( 'penci_header_slogan_text', array(
	'label'       => esc_html__( 'Header Slogan Text', 'pennews' ),
	'section'     => 'penci_panel_header',
	'settings'    => 'penci_header_slogan_text',
	'type'        => 'textarea',
	'description' => esc_html__( ' If you want to hide the heading slogan text, empty this. The slogan just appears for header styles: 3, 4, 6, 8 & 9', 'pennews' ),
) );

$wp_customize->add_setting( 'penci_font_slogan', array(
	'default'           => penci_default_setting( 'penci_font_slogan' ),
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_font_slogan', array(
	'label'       => esc_html__( 'Font For Header Slogan', 'pennews' ),
	'section'     => 'penci_panel_header',
	'settings'    => 'penci_font_slogan',
	'description' => 'Default font is "Roboto"',
	'type'        => 'select',
	'choices'     => penci_all_fonts(),

) );



$wp_customize->add_setting( 'penci_font_weight_slogan', array(
	'default'           => '700',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_font_weight_slogan', array(
	'label'    => esc_html__( 'Font Weight For Slogan', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_font_weight_slogan',
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

$wp_customize->add_setting( 'penci_font_style_slogan', array(
	'default'           => 'normal',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_font_style_slogan', array(
	'label'    => esc_html__( 'Font Style For Slogan', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_font_style_slogan',
	'type'     => 'select',
	'choices'  => array(
		'normal' => 'Normal',
		'italic' => 'Italic'
	)
) );


// Font size
$wp_customize->add_setting( 'penci_fontsize_slogan', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_fontsize_slogan', array(
	'label'    => esc_html__( 'Custom Size Of Slogan', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_fontsize_slogan',
	'type'     => 'font_size',
) ) );

// Font size
$wp_customize->add_setting( 'penci_padding_top_slogan', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_padding_top_slogan', array(
	'label'    => esc_html__( 'Slogan Padding Top', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_padding_top_slogan',
	'type'     => 'font_size',
) ) );

/************ Main menu ************/
$wp_customize->add_setting( 'penci_header_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_header_heading', array(
	'label'    => esc_html__( 'Main header setting', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_header_heading',
	'type'     => 'heading',
) ) );

// Header style
$wp_customize->add_setting( 'penci_header_layout', array(
	'default'           => 'header_s1',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( new Penci_Customize_Control_Radio_Image(
	$wp_customize,
	'penci_header_layout',
	array(
		'label'    => __( 'Header Layout', 'pennews' ),
		'section'  => 'penci_panel_header',
		'type'     => 'radio-image',
		'choices' => array(
			'header_s1'  => array( 'url' => '%s/images/headers/header_v1.png', 'label' => __( 'Header style 1', 'pennews' ) ),
			'header_s2'  => array( 'url' => '%s/images/headers/header_v2.png', 'label' => __( 'Header style 2', 'pennews' ) ),
			'header_s3'  => array( 'url' => '%s/images/headers/header_v3.png', 'label' => __( 'Header style 3', 'pennews' ) ),
			'header_s4'  => array( 'url' => '%s/images/headers/header_v4.png', 'label' => __( 'Header style 4', 'pennews' ) ),
			'header_s5'  => array( 'url' => '%s/images/headers/header_v5.png', 'label' => __( 'Header style 5', 'pennews' ) ),
			'header_s6'  => array( 'url' => '%s/images/headers/header_v6.png', 'label' => __( 'Header style 6', 'pennews' ) ),
			'header_s7'  => array( 'url' => '%s/images/headers/header_v7.png', 'label' => __( 'Header style 7', 'pennews' ) ),
			'header_s8'  => array( 'url' => '%s/images/headers/header_v8.png', 'label' => __( 'Header style 8', 'pennews' ) ),
			'header_s9'  => array( 'url' => '%s/images/headers/header_v9.png', 'label' => __( 'Header style 9', 'pennews' ) ),
			'header_s10' => array( 'url' => '%s/images/headers/header_v10.png', 'label' => __( 'Header style 10', 'pennews' ) ),
			'header_s11' => array( 'url' => '%s/images/headers/header_v11.png', 'label' => __( 'Header style 11', 'pennews' ) ),
			'header_s12' => array( 'url' => '%s/images/headers/header_v12.png', 'label' => __( 'Header style 12', 'pennews' ) ),
			'header_s13' => array( 'url' => '%s/images/headers/header_v13.png', 'label' => __( 'Header style 13', 'pennews' ) )
		),
		'settings' => 'penci_header_layout',
	)
) );


$wp_customize->add_setting( 'penci_header_width', array(
	'default'           => 'default',
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_header_width', array(
	'label'    => esc_html__( 'Header Container Width', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_header_width',
	'type'     => 'select',
	'choices'  => array(
		'default'   => esc_html__( '-- Default --', 'pennews' ),
		'1400'      => esc_html__( 'Width: 1400px', 'pennews' ),
		'1170'      => esc_html__( 'Width: 1170px', 'pennews' ),
		'1080'      => esc_html__( 'Width: 1080px', 'pennews' ),
		'fullwidth' => esc_html__( 'Full Width', 'pennews' )
	)
) );

$wp_customize->add_setting( 'penci_main_menu_line_height', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_main_menu_line_height', array(
	'label'    => esc_html__( 'Custom Main Nav Height( minimum height 35px )', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_main_menu_line_height',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_font_main_menu_item', array(
	'default'           => penci_default_setting( 'penci_font_main_menu_item' ),
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_font_main_menu_item', array(
	'label'       => esc_html__( 'Custom Font For Main Menu Items', 'pennews' ),
	'section'     => 'penci_panel_header',
	'settings'    => 'penci_font_main_menu_item',
	'description' => 'Default font is "Roboto"',
	'type'        => 'select',
	'choices'     => penci_all_fonts()
) );

$wp_customize->add_setting( 'penci_font_weight_menu_item', array(
	'default'           => '700',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_font_weight_menu_item', array(
	'label'    => esc_html__( 'Font Weight For Menu Item', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_font_weight_menu_item',
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

$wp_customize->add_setting( 'penci_dropdown_menu_style', array(
	'default'           => 'slide_down',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_dropdown_menu_style', array(
	'label'    => esc_html__( 'Dropdown Menu Animation Style', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_dropdown_menu_style',
	'type'     => 'select',
	'choices'  => array(
		'slide_down'   => esc_html__( 'Slide Down', 'pennews' ),
		'fadein_up'    => esc_html__( 'Fade In Up', 'pennews' ),
		'fadein_down'  => esc_html__( 'Fade In Down', 'pennews' ),
		'fadein_left'  => esc_html__( 'Fade In Left', 'pennews' ),
		'fadein_right' => esc_html__( 'Fade In Right', 'pennews' ),
		'fadein_none'  => esc_html__( 'Fade In', 'pennews' ),
	)
) );

$wp_customize->add_setting( 'penci_mega_child_cat_style', array(
	'default'           => 'style-1',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_mega_child_cat_style', array(
	'label'    => esc_html__( 'Category Mega Menu Style', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_mega_child_cat_style',
	'type'     => 'select',
	'choices'  => array(
		'style-1'   => esc_html__( 'Style 1', 'pennews' ),
		'style-2'   => esc_html__( 'Style 2', 'pennews' )
	)
) );

// Font size
$header_list_font_size = array(
	'penci_font_size_menu_lever1'     => esc_html__( 'Font Size For Menu Items Lever 1', 'pennews' ),
	'penci_font_size__social_icon'    => esc_html__( 'Custom Size for Header Social Icons', 'pennews' ),
	'penci_font_size__search_icon'    => esc_html__( 'Custom Size for Header Search Icons', 'pennews' ),
	'penci_font_size_menu_dropdown'   => esc_html__( 'Font Size For Dropdown Menu Items', 'pennews' ),
	'penci_font_size_child_cat_mega'  => esc_html__( 'Custom Font Size For Child Categories On Category Mega Menu', 'pennews' ),
	'penci_font_size_ptitle_cat_mega' => esc_html__( 'Custom Font Size For Post Title On Category Mega Menu', 'pennews' ),
	'penci_font_size_pdate_cat_mega'  => esc_html__( 'Custom Font Size For Posts Date On Category Mega Menu', 'pennews' ),
);

foreach ( $header_list_font_size as $id_option => $label_option ) {
	$wp_customize->add_setting( $id_option, array(
		'default'           => penci_default_setting( $id_option ),
		'sanitize_callback' => array( $sanitizer, 'html' ),
	) );
	$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, $id_option, array(
		'label'    => $label_option,
		'section'  => 'penci_panel_header',
		'settings' => $id_option,
		'type'     => 'font_size',
	) ) );
}

// Custom Length For Post Title On Category Mega Menu
$wp_customize->add_setting( 'penci_length_ptitle_cat_mega', array(
	'sanitize_callback' => array( $sanitizer, 'text' ),
	'default'           => 8,
) );
$wp_customize->add_control( 'penci_length_ptitle_cat_mega', array(
	'label'    => esc_html__( 'Custom Length For Post Title On Category Mega Menu', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_length_ptitle_cat_mega',
	'type'     => 'number',
) );

$wp_customize->add_setting( 'penci_mega_tax', array(
	'sanitize_callback' => array( $sanitizer, 'textarea' )
) );

$wp_customize->add_control( 'penci_mega_tax', array(
	'label'       => esc_html__( 'Add More Taxonomies Slug for Supports on Category Mega Menu', 'pennews' ),
	'description' => esc_html__( 'By default, this theme supports taxonomies for category mega menu is: category, post_tag, product_tag, product_cat, portfolio-category. If you want to allow more taxonomies for category mega menu, let fill taxonomies slug here. Example: taxonomy-1, taxonomy-2', 'pennews' ),
	'section'     => 'penci_panel_header',
	'settings'    => 'penci_mega_tax',
	'type'        => 'textarea',
) );

// Custom image type
$wp_customize->add_setting( 'penci_megamenu_image_type', array(
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );

$wp_customize->add_control(
	'penci_megamenu_image_type',
	array(
		'label'    => esc_html__( 'Image Type For Category Mega Menu', 'pennews' ),
		'section'  => 'penci_panel_header',
		'type'     => 'select',
		'choices'  => array(
			''          => esc_html__( 'Default', 'pennews' ),
			'square'    => esc_html__( 'Square', 'pennews' ),
			'vertical'  => esc_html__( 'Vertical', 'pennews' ),
			'landscape' => esc_html__( 'Landscape', 'pennews' )
		),
		'settings' => 'penci_megamenu_image_type'
	)
);

$header_list_check = array(
	'penci_hide_uppercase_menu_item'       => esc_html__( 'Turn Off Uppercase on Menu items', 'pennews' ),
	'penci_hide_arrow_down_menu_item'      => esc_html__( 'Remove Arrow Down on Menu Items Level 1', 'pennews' ),
	'penci_hide_arrow_right_menu_item'     => esc_html__( 'Remove Arrow Right on Menu Items for Dropdown Menu', 'pennews' ),
	'penci_hide_line_top_dropdown_menu'    => esc_html__( 'Remove The Line on Top of Dropdown Menu', 'pennews' ),
	'penci_disable_padding_menu_lever1'    => esc_html__( 'Disable Padding on Menu Item Level 1', 'pennews' ),
	'penci_enable_line_menu_lever1'        => esc_html__( 'Enable Lines When Hover on Menu Style 1', 'pennews' ),
	'penci_hide_uppercase_chid_mega_menu'  => esc_html__( 'Turn Off Uppercase For Child Categories On Category Mega Menus', 'pennews' ),
	'penci_align_pdate_mega_menu'          => esc_html( 'Align Center Post Title, Post Date And Price Of Mega Menu', 'pennews' ),
	'penci_hide_icon_postformat_mega_menu' => esc_html( 'Hide Post Format Icons On Mega Menu', 'pennews' ),
	'penci_hide_icon_cat_mega_menu'        => esc_html( 'Hide Post Category On Bottom Left Thumbnail Of Mega Menu', 'pennews' ),
	'penci_hide_post_date_mega_menu'       => esc_html( 'Hide Post Date And Price Of Mega Menu', 'pennews' ),
	'penci_hide_header_sticky'             => esc_html__( 'Disable Header Sticky', 'pennews' ),
	'penci_hide_header_social'             => esc_html__( 'Disable Header Social Icons', 'pennews' ),
	'penci_hide_header_search'             => esc_html__( 'Disable Header Search', 'pennews' ),
	'penci_dis_header_search_bg'           => esc_html__( 'Disable Header Search Icon Background', 'pennews' ),
	'penci_hide_header_cart'               => esc_html__( 'Disable Shopping Cart Icon', 'pennews' )
);

foreach ( $header_list_check as $id_option => $label_option ) {
	$wp_customize->add_setting( $id_option, array(
		'sanitize_callback' => array( $sanitizer, 'checkbox' ),
	) );

	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		$id_option,
		array(
			'label'    => $label_option,
			'section'  => 'penci_panel_header',
			'type'     => 'checkbox',
			'settings' => $id_option,
		)
	) );
}

$wp_customize->add_setting( 'penci_header_img', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => esc_url( get_template_directory_uri() . '/images/banner.jpg' )
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'penci_header_img', array(
	'label'       => esc_html__( 'Banner Header Right For Header 2, 8, 7 & 9', 'pennews' ),
	'section'     => 'penci_panel_header',
	'settings'    => 'penci_header_img',
	'description' => esc_html__( 'You should choose banner with 728px width and 90px - 100px height for the best result.', 'pennews' ),
) ) );
// Link When Click Banner Header Right For Header 2
$wp_customize->add_setting( 'penci_header_img_link', array(
	'sanitize_callback' => array( $sanitizer, 'text' ),
	'default'           => '#'
) );
$wp_customize->add_control( 'penci_header_img_link', array(
	'label'    => esc_html__( 'Link When Click Banner For Header 2, 8, 7 & 9', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_header_img_link',
) );

$wp_customize->add_setting( 'penci_custom_code_banner_header', array(
	'sanitize_callback' => array( $sanitizer, 'textarea' )
) );

$wp_customize->add_control( 'penci_custom_code_banner_header', array(
	'label'    => esc_html__( 'Google Adsense Code To Display For Header 2, 8, 7 & 9', 'pennews' ),
	'section'  => 'penci_panel_header',
	'settings' => 'penci_custom_code_banner_header',
	'type'     => 'textarea',
) );

$wp_customize->add_setting( 'penci_custom_code_inside_head_tag', array(
	'sanitize_callback' => array( $sanitizer, 'textarea' )
) );

$wp_customize->add_control( 'penci_custom_code_inside_head_tag', array(
	'label'       => esc_html__( 'Add Custom Code Inside &lt;head&gt; tag', 'pennews' ),
	'section'     => 'penci_panel_header',
	'settings'    => 'penci_custom_code_inside_head_tag',
	'type'        => 'textarea',
) );

$wp_customize->add_setting( 'penci_after_body_tag', array(
	'sanitize_callback' => array( $sanitizer, 'textarea' )
) );

$wp_customize->add_control( 'penci_after_body_tag', array(
	'label'       => esc_html__( 'Add Custom Code After &lt;body&gt; tag', 'pennews' ),
	'section'     => 'penci_panel_header',
	'settings'    => 'penci_after_body_tag',
	'type'        => 'textarea',
) );