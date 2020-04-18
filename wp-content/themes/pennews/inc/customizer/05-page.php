<?php
$wp_customize->add_section( 'penci_page', array(
	'title'    => esc_html__( 'Page Options', 'pennews' ),
	'priority' => 4,
) );
$wp_customize->add_setting( 'penci_page_sidebar_layout', array(
	'default'           => 'sidebar-right',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( new Penci_Customize_Control_Radio_Image(
	$wp_customize,
	'penci_page_sidebar_layout',
	array(
		'label'    => __( 'Archive Page Sidebar Layout', 'pennews' ),
		'section'  => 'penci_page',
		'type'     => 'radio-image',
		'choices'  => array(
			'no-sidebar-wide' => array( 'url' => '%s/images/layout/wide-content.png', 'label' => esc_html__( 'Wide content', 'pennews' ) ),
			'no-sidebar-1080' => array( 'url' => '%s/images/layout/wide-content-1080.png', 'label' => esc_html__( 'Wide content 1080', 'pennews' ) ),
			'no-sidebar'    => array( 'url' => '%s/images/layout/no-sidebar.png', 'label' => __( 'No Sidebar', 'pennews' ) ),
			'sidebar-left'  => array( 'url' => '%s/images/layout/sidebar-left.png', 'label' => __( 'Sidebar Left', 'pennews' ) ),
			'sidebar-right' => array( 'url' => '%s/images/layout/sidebar-right.png', 'label' => __( 'Sidebar Right', 'pennews' ) ),
			'two-sidebar'   => array( 'url' => '%s/images/layout/3cm.png', 'label' => __( 'Two Sidebar', 'pennews' ) ),
		),
		'settings' => 'penci_page_sidebar_layout',
	)
) );

$wp_customize->add_setting( 'penci_page_template', array(
	'default'           => 'style-1',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( new Penci_Customize_Control_Radio_Image(
	$wp_customize,
	'penci_page_template',
	array(
		'label'    => esc_html__( 'Page template', 'pennews' ),
		'section'  => 'penci_page',
		'type'     => 'radio-image',
		'choices'  => array(
			'style-1' => array( 'url' => '%s/images/single/style_1.png', 'label' => esc_html__( 'Style 1', 'pennews' ) ),
			'style-2' => array( 'url' => '%s/images/single/style_2.png', 'label' => esc_html__( 'Style 2', 'pennews' ) ),
			'style-3' => array( 'url' => '%s/images/single/style_3.png', 'label' => esc_html__( 'Style 3', 'pennews' ) ),
			'style-4' => array( 'url' => '%s/images/single/style_4.png', 'label' => esc_html__( 'Style 4', 'pennews' ) ),
		),
		'settings' => 'penci_page_template',
	)
) );

//$wp_customize->add_setting( 'penci_page_w_container', array(
//	'sanitize_callback' => array( $sanitizer, 'html' ),
//) );
//$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_page_w_container', array(
//	'label'    => esc_html__( 'Custom Width Container', 'pennews' ),
//	'section'  => 'penci_page',
//	'settings' => 'penci_page_w_container',
//	'type'     => 'font_size',
//) ) );

// Custom sidebar left
$wp_customize->add_setting( 'penci_page_custom_sidebar_left', array(
	'default'           => 'sidebar-2',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control(
	'penci_page_custom_sidebar_left',
	array(
		'label'    => esc_html__( 'Custom Sidebar Left', 'pennews' ),
		'section'  => 'penci_page',
		'type'     => 'select',
		'choices'  => Penci_Custom_Sidebar::get_list_sidebar( ),
		'settings' => 'penci_page_custom_sidebar_left',
	)
);

// Custom sidebar right
$wp_customize->add_setting( 'penci_page_custom_sidebar_right', array(
	'default'           => 'sidebar-1',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control(
	'penci_page_custom_sidebar_right',
	array(
		'label'    => esc_html__( 'Custom Sidebar right', 'pennews' ),
		'section'  => 'penci_page',
		'type'     => 'select',
		'choices'  => Penci_Custom_Sidebar::get_list_sidebar( 'right' ),
		'settings' => 'penci_page_custom_sidebar_right',
	)
);

$wp_customize->add_setting( 'penci_page_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_page_heading', array(
	'label'    => esc_html__( 'Custom Page','pennews' ),
	'section'  => 'penci_page',
	'settings' => 'penci_page_heading',
	'type'     => 'heading',
) ) );


$wp_customize->add_setting( 'penci_hide_page_title', array(
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_hide_page_title',
	array(
		'label'    => esc_html__( 'Hide page title', 'pennews' ),
		'section'  => 'penci_page',
		'type'     => 'checkbox',
		'settings' => 'penci_hide_page_title',
	)
) );
$wp_customize->add_setting( 'penci_page_size_post_title', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => 30,
) );

$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_page_size_post_title', array(
	'label'    => esc_html__( 'Custom font size Title', 'pennews' ),
	'section'  => 'penci_page',
	'settings' => 'penci_page_size_post_title',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_page_align_post_title', array(
	'default'           => 'left',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_page_align_post_title', array(
	'label'    => esc_html__( 'Page Title Align', 'pennews' ),
	'section'  => 'penci_page',
	'settings' => 'penci_page_align_post_title',
	'type'     => 'select',
	'choices'  => array(
		'left' 		=> esc_html__( 'Left', 'pennews' ),
		'center'    => esc_html__( 'Center', 'pennews' ),
		'right'     => esc_html__( 'Right', 'pennews' )
	)
) );


$page_list_check = array(
	'penci_hide_page_breadcrumb'          => esc_html__( 'Hide Breadcrumbs', 'pennews' ),
	'penci_show_page_featured_img'        => esc_html__( 'Make Featured Image Auto Appears on Pages', 'pennews' ),
	'penci_show_page_comments'            => esc_html__( 'Show Comments', 'pennews' ),
);

foreach ( $page_list_check as $id_option => $label_option ) {
	$wp_customize->add_setting( $id_option, array(
		'sanitize_callback' => array( $sanitizer, 'checkbox' ),
	) );

	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		$id_option,
		array(
			'label'    => $label_option,
			'section'  => 'penci_page',
			'type'     => 'checkbox',
			'settings' => $id_option,
		)
	) );
}

// ------ Social Share Box

$wp_customize->add_setting( 'penci_page_social_share_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_page_social_share_heading', array(
	'label'    => esc_html__( 'Social Share Box', 'pennews' ),
	'section'  => 'penci_page',
	'settings' => 'penci_page_social_share_heading',
	'type'     => 'heading',
) ) );

$page_social_share = array(
	'penci_hide_page_socail_share_top'    => array( 'default' => '1', 'label' => esc_html__( 'Hide Social Share on Top', 'pennews' ) ),
	'penci_hide_page_socail_share_bottom' => array( 'default' => '', 'label' => esc_html__( 'Hide Social Share on Bottom', 'pennews' ) ),
	'penci_page_soshare_center'           => array( 'default' => '', 'label' => esc_html__( 'Enable Center Social Sharing', 'pennews' ) ),
);

foreach ( $page_social_share as $id_option => $label_option ) {
	$wp_customize->add_setting( $id_option, array(
		'sanitize_callback' => array( $sanitizer, 'checkbox' ),
		'default'           => $label_option['default'],
	) );
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		$id_option,
		array(
			'label'    => $label_option['label'],
			'section'  => 'penci_page',
			'type'     => 'checkbox',
			'settings' => $id_option,
		)
	) );
}

// ------ Google Adsense
$wp_customize->add_setting( 'penci_page_google_ad_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_page_google_ad_heading', array(
	'label'    => esc_html__( 'Google Adsense Setting', 'pennews' ),
	'section'  => 'penci_page',
	'settings' => 'penci_page_google_ad_heading',
	'type'     => 'heading',
) ) );

$wp_customize->add_setting( 'penci_page_ad_before_content', array(
	'sanitize_callback' => array( $sanitizer, 'textarea' ),
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_page_ad_before_content', array(
	'label'       => esc_html__('Google Adsense Code to Display Before Content Page for Default Template', 'pennews' ),
	'section'     => 'penci_page',
	'settings'    => 'penci_page_ad_before_content',
	'description' => esc_html__('You can display google adsense code before content page for default template by use this option', 'pennews' ),
	'type'        => 'textarea',
) ) );

$wp_customize->add_setting( 'penci_page_ad_after_content', array(
	'sanitize_callback' => array( $sanitizer, 'textarea' ),
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_page_ad_after_content', array(
	'label'       => esc_html__('Google Adsense Code to Display In The End of Content Page for Default Template', 'pennews' ),
	'section'     => 'penci_page',
	'settings'    => 'penci_page_ad_after_content',
	'description' => esc_html__('You can display google adsense code in the end of content page for default template by use this option', 'pennews' ),
	'type'        => 'textarea',
) ) );
