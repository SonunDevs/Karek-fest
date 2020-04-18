<?php
// Footer option
$wp_customize->add_section( 'footer', array(
	'title'    => esc_html__( 'Footer Options', 'pennews' ),
	'priority' => 8,
) );

$wp_customize->add_setting( 'penci_hide_footer_widget', array(
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_hide_footer_widget',
	array(
		'label'    => esc_html__( 'Disable Footer Widget Area', 'pennews' ),
		'section'  => 'footer',
		'type'     => 'checkbox',
		'settings' => 'penci_hide_footer_widget',
	)
) );
$wp_customize->add_setting( 'penci_footer_width', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_footer_width', array(
	'label'    => esc_html__( 'Footer Container Width', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_footer_width',
	'type'     => 'select',
	'choices'  => array(
		''          => esc_html__( 'Width: 1400px', 'pennews' ),
		'1170'      => esc_html__( 'Width: 1170px', 'pennews' ),
		'1080'      => esc_html__( 'Width: 1080px', 'pennews' ),
		'fullwidth' => esc_html__( 'Full Width', 'pennews' )
	)
) );

$wp_customize->add_setting( 'penci_footer_w_padding_top', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => '47',
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_footer_w_padding_top', array(
	'label'    => esc_html__( ' Footer Widget Padding Top', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_footer_w_padding_top',
	'type'     => 'number',
) ) );
$wp_customize->add_setting( 'penci_footer_w_padding_bottom', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => '26',
) );

$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_footer_w_padding_bottom', array(
	'label'    => esc_html__( 'Footer Widget Padding Bottom', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_footer_w_padding_bottom',
	'type'     => 'number',
) ) );


// footer sidebar layout
$wp_customize->add_setting( 'penci_footer_col', array(
	'default'           => 'style-4',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( new Penci_Customize_Control_Radio_Image(
	$wp_customize,
	'penci_footer_col',
	array(
		'label'    => __( 'Footer widget layout', 'pennews' ),
		'section'  => 'footer',
		'type'     => 'radio-image',
		'choices'  => array(
			'style-1'  => array( 'url' => '%s/images/footer/footer-1.png', 'label' => __( 'One column', 'pennews' ) ),
			'style-2'  => array( 'url' => '%s/images/footer/footer-2.png', 'label' => __( '1/2 +1/2', 'pennews' ) ),
			'style-3'  => array( 'url' => '%s/images/footer/footer-3.png', 'label' => __( '1/3 + 1/3 + 1/3', 'pennews' ) ),
			'style-4'  => array( 'url' => '%s/images/footer/footer-4.png', 'label' => __( '1/4 + 1/4 + 1/4 + 1/4', 'pennews' ) ),
			'style-5'  => array( 'url' => '%s/images/footer/footer-5.png', 'label' => __( '1/3 + 2/3', 'pennews' ) ),
			'style-6'  => array( 'url' => '%s/images/footer/footer-6.png', 'label' => __( '2/3 + 1/3', 'pennews' ) ),
			'style-7'  => array( 'url' => '%s/images/footer/footer-7.png', 'label' => __( '3/4 + 1/4', 'pennews' ) ),
			'style-8'  => array( 'url' => '%s/images/footer/footer-8.png', 'label' => __( '1/4 + 3/4', 'pennews' ) ),
			'style-9'  => array( 'url' => '%s/images/footer/footer-9.png', 'label' => __( '1/2 + 1/4 + 1/4', 'pennews' ) ),
			'style-10' => array( 'url' => '%s/images/footer/footer-10.png', 'label' => __( '1/4 + 1/4 + 2/4', 'pennews' ) ),
			'style-11' => array( 'url' => '%s/images/footer/footer-11.png', 'label' => __( '1/4 + 2/4 + 1/4', 'pennews' ) ),

		),
		'settings' => 'penci_footer_col',
	)
) );

$wp_customize->add_setting( 'penci_hide_footer_content', array(
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_hide_footer_content',
	array(
		'label'    => esc_html__( 'Disable Footer content', 'pennews' ),
		'section'  => 'footer',
		'type'     => 'checkbox',
		'settings' => 'penci_hide_footer_content',
	)
) );

$wp_customize->add_setting( 'penci_footer_style', array(
	'default'           => 'style-1',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( new Penci_Customize_Control_Radio_Image(
	$wp_customize,
	'penci_footer_style',
	array(
		'label'    => __( 'Footer style', 'pennews' ),
		'section'  => 'footer',
		'type'     => 'radio-image',
		'choices'  => array(
			'style-1'  => array( 'url' => '%s/images/footer/footer-s1.png', 'label' => __( 'Style 1', 'pennews' ) ),
			'style-2'  => array( 'url' => '%s/images/footer/footer-s2.png', 'label' => __( 'Style 2', 'pennews' ) ),
		),
		'settings' => 'penci_footer_style',
	)
) );


// Penci footer widget heading

$wp_customize->add_setting( 'penci_footer_widget_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_footer_widget_heading', array(
	'label'    => esc_html__( 'Block Title And Widget Title', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_footer_widget_heading',
	'type'     => 'heading',
) ) );

$wp_customize->add_setting( 'penci_fwidget_block_title_style', array(
	'default'           => 'style-title-1',
	'sanitize_callback' => array( $sanitizer, 'select' ),
	'transport'         => 'postMessage',
) );
$wp_customize->add_control( 'penci_fwidget_block_title_style', array(
	'label'    => esc_html__( 'Style Title', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_fwidget_block_title_style',
	'type'     => 'select',
	'choices'  => array(
		'style-title-1'  => esc_html__( 'Style 1', 'pennews' ),
		'style-title-2'  => esc_html__( 'Style 2', 'pennews' ),
		'style-title-3'  => esc_html__( 'Style 3', 'pennews' ),
		'style-title-4'  => esc_html__( 'Style 4', 'pennews' )
	)
) );

$wp_customize->add_setting( 'penci_fwidget_align_blocktitle', array(
	'default'           => 'style-title-left',
	'sanitize_callback' => array( $sanitizer, 'select' ),
	'transport'         => 'postMessage',
) );
$wp_customize->add_control( 'penci_fwidget_align_blocktitle', array(
	'label'    => esc_html__( 'Align Title', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_fwidget_align_blocktitle',
	'type'     => 'select',
	'choices'  => array(
		'style-title-left'  => esc_html__( 'Left', 'pennews' ),
		'style-title-center'  => esc_html__( 'Center', 'pennews' ),
		'style-title-right'  => esc_html__( 'Right', 'pennews' ),
	)
) );

$wp_customize->add_setting( 'penci_fwidget_font_blocktitle', array(
	'default'           => 'Oswald, 200:300:regular:500:600:700, sans-serif',
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_fwidget_font_blocktitle', array(
	'label'       => esc_html__( 'Font Family', 'pennews' ),
	'section'     => 'footer',
	'settings'    => 'penci_fwidget_font_blocktitle',
	'description' => 'Default font is "Oswald"',
	'type'        => 'select',
	'choices'     => penci_all_fonts()
) );

$wp_customize->add_setting( 'penci_fwidget_weight_blocktitle', array(
	'default'           => '600',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_fwidget_weight_blocktitle', array(
	'label'    => esc_html__( 'Font Weight', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_fwidget_weight_blocktitle',
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
$wp_customize->add_setting( 'penci_fwidget_fontsize_blocktitle', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_fwidget_fontsize_blocktitle', array(
	'label'    => esc_html__( 'Custom Size', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_fwidget_fontsize_blocktitle',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_fwidget_lineheight_blocktitle', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_fwidget_lineheight_blocktitle', array(
	'label'    => esc_html__( 'Custom Border Bottom Width', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_fwidget_lineheight_blocktitle',
	'type'     => 'font_size',
) ) );


$fwidget_checklist = array(
	'penci_fwidget_upper_blocktitle'  => esc_html__( 'Disable Uppercase on Footer Widget Title', 'pennews' ),
	'penci_fwidget_border_blocktitle' => esc_html__( 'Disable Border Bottom Footer Widget Title', 'pennews' ),
	'penci_fwidget_border_bottom'     => esc_html__( 'Disable Border Bottom Footer Widget', 'pennews' ),
);

foreach ( $fwidget_checklist as $id_option => $label_option ) {
	$wp_customize->add_setting( $id_option, array(
		'sanitize_callback' => array( $sanitizer, 'checkbox' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		$id_option,
		array(
			'label'    => $label_option,
			'section'  => 'footer',
			'type'     => 'checkbox',
			'settings' => $id_option,
		)
	) );
}

// Footer bottom
$wp_customize->add_setting( 'penci_footer_bottom_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_footer_bottom_heading', array(
	'label'    => esc_html__( 'Footer bottom', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_footer_bottom_heading',
	'type'     => 'heading',
) ) );

// Heading padding
$wp_customize->add_setting( 'penci_footer_bottom_padding_top', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => '50',
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_footer_bottom_padding_top', array(
	'label'    => esc_html__( 'Footer Bottom Padding Top', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_footer_bottom_padding_top',
	'type'     => 'number',
) ) );
$wp_customize->add_setting( 'penci_footer_bottom_padding_bottom', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => '40',
) );

$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_footer_bottom_padding_bottom', array(
	'label'    => esc_html__( 'Footer Bottom Padding Bottom', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_footer_bottom_padding_bottom',
	'type'     => 'number',
) ) );

$wp_customize->add_setting( 'penci_footer_fsize_title_cr', array(
	'default'           => '18',
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );

$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_footer_fsize_title_cr', array(
	'label'    => esc_html__( 'Custom Size for Follow us or About US', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_footer_fsize_title_cr',
	'type'     => 'font_size',
) ) );


$wp_customize->add_setting( 'penci_footer_text', array(
	'sanitize_callback' => array( $sanitizer, 'textarea' ),
	'default' => ''
) );

$wp_customize->add_control( 'penci_footer_text', array(
	'label'       => esc_html__( 'Footer Text', 'pennews' ),
	'section'     => 'footer',
	'settings'    => 'penci_footer_text',
	'type'        => 'textarea',
) );

$wp_customize->add_setting( 'penci_footer_fsize_copyright', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_footer_fsize_copyright', array(
	'label'    => esc_html__( 'Custom Size for Footer Text', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_footer_fsize_copyright',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_footer_email', array(
	'default'           => 'contact@yoursite.com',
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_footer_email', array(
	'label'    => esc_html__( 'Your email address', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_footer_email',

) ) );

$wp_customize->add_setting( 'penci_footer_copyright', array(
	'sanitize_callback' => array( $sanitizer, 'textarea' ),
	'default' => penci_default_setting( 'penci_footer_copyright' )
) );

$wp_customize->add_control( 'penci_footer_copyright', array(
	'label'       => esc_html__( 'Footer Copyright Text', 'pennews' ),
	'section'     => 'footer',
	'settings'    => 'penci_footer_copyright',
	'type'        => 'textarea',
) );

$wp_customize->add_setting( 'penci_footer_fsize_copyright2', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_footer_fsize_copyright2', array(
	'label'    => esc_html__( 'Custom Size for Footer Copyright Text', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_footer_fsize_copyright2',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_footer_copyright_ptb', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => '',
) );

$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_footer_copyright_ptb', array(
	'label'    => esc_html__( 'Custom Padding Top/Bottom for Footer Copyright', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_footer_copyright_ptb',
	'type'     => 'number',
) ) );

$wp_customize->add_setting( 'penci_footer_fontsize_social', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => '',
) );

$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_footer_fontsize_social', array(
	'label'    => esc_html__( 'Custom Font Size Social Media Icons', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_footer_fontsize_social',
	'type'     => 'number',
) ) );

$wp_customize->add_setting( 'penci_footer_wh_social', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => '44',
) );

$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_footer_wh_social', array(
	'label'    => esc_html__( 'Custom Size ( Width / Height ) Social Media Icons', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_footer_wh_social',
	'type'     => 'number',
) ) );

/************  Footer Text logo ************/
$wp_customize->add_setting( 'penci_footer_text_logo_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_footer_text_logo_heading', array(
	'label'    => esc_html__( 'Footer Logo Setting', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_footer_text_logo_heading',
	'type'     => 'heading',
) ) );

$wp_customize->add_setting( 'penci_footer_logo', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'penci_footer_logo', array(
	'label'       => esc_html__( 'Footer Logo', 'pennews' ),
	'section'     => 'footer',
	'settings'    => 'penci_footer_logo',
) ) );

$wp_customize->add_setting( 'penci_footer_use_textlogo', array(
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
	'default'           => '',
	'priority'          => 1,
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_footer_use_textlogo',
	array(
		'label'    => esc_html__( 'Use Footer Text Logo', 'pennews' ),
		'section'  => 'footer',
		'type'     => 'checkbox',
		'settings' => 'penci_footer_use_textlogo',
	)
) );

$wp_customize->add_setting( 'penci_footer_text_logo', array(
	'sanitize_callback' => array( $sanitizer, 'text' ),
	'default'           => '',
	'priority'          => 1,
) );
$wp_customize->add_control( 'penci_footer_text_logo', array(
	'label'    => esc_html__( 'Footer Text Logo', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_footer_text_logo',
) );

$wp_customize->add_setting( 'penci_footer_font_textlogo', array(
	'default'           => 'Teko, 300:regular:500:600:700, sans-serif',
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_footer_font_textlogo', array(
	'label'       => esc_html__( 'Font For Footer Text Logo', 'pennews' ),
	'section'     => 'footer',
	'settings'    => 'penci_footer_font_textlogo',
	'description' => 'Default font is "Teko"',
	'type'        => 'select',
	'choices'     => penci_all_fonts()
) );

$wp_customize->add_setting( 'penci_footer_fweight_textlogo', array(
	'default'           => '700',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_footer_fweight_textlogo', array(
	'label'    => esc_html__( 'Font Weight For Footer Text Logo', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_footer_fweight_textlogo',
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
$wp_customize->add_setting( 'penci_footer_fsize_textlogo', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_footer_fsize_textlogo', array(
	'label'    => esc_html__( 'Custom Size Of Footer Text Logo', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_footer_fsize_textlogo',
	'type'     => 'font_size',
) ) );


$wp_customize->add_setting( 'penci_footer_bottom_padding_logo', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => '',
) );

$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_footer_bottom_padding_logo', array(
	'label'    => esc_html__( 'Footer Logo Padding Bottom', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_footer_bottom_padding_logo',
	'type'     => 'number',
) ) );

$wp_customize->add_setting( 'penci_footer_maxwidth_logo', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => '',
) );

$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_footer_maxwidth_logo', array(
	'label'    => esc_html__( 'Footer Logo Max Width', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_footer_maxwidth_logo',
	'type'     => 'number',
) ) );

// Footer extra
$wp_customize->add_setting( 'penci_footer_bottom_extra', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_footer_bottom_extra', array(
	'label'    => esc_html__( 'Extra', 'pennews' ),
	'section'  => 'footer',
	'settings' => 'penci_footer_bottom_extra',
	'type'     => 'heading',
) ) );

$footer_checklist = array(
	'penci_hide_footer_logo'           => esc_html__( 'Disable Footer Logo', 'pennews' ),
	'penci_hide_footer_socails'        => esc_html__( 'Disable Footer Socials', 'pennews' ),
	'penci_go_to_top'                  => esc_html__( 'Disable Go to top button', 'pennews' ),
);

foreach ( $footer_checklist as $id_option => $label_option ) {
	$wp_customize->add_setting( $id_option, array(
		'sanitize_callback' => array( $sanitizer, 'checkbox' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		$id_option,
		array(
			'label'    => $label_option,
			'section'  => 'footer',
			'type'     => 'checkbox',
			'settings' => $id_option,
		)
	) );
}

$wp_customize->add_setting( 'penci_footer_analytics', array(
	'sanitize_callback' => array( $sanitizer, 'textarea' )
) );

$wp_customize->add_control( 'penci_footer_analytics', array(
	'label'       => esc_html__( 'Google Analytics Code', 'pennews' ),
	'section'     => 'footer',
	'settings'    => 'penci_footer_analytics',
	'type'        => 'textarea',
) );