<?php

$wp_customize->add_setting( 'penci_woo_sidebar_shop', array(
	'default'           => 'sidebar-right',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( new Penci_Customize_Control_Radio_Image(
	$wp_customize,
	'penci_woo_sidebar_shop',
	array(
		'label'    => __( 'Sidebar On Shop Page', 'pennews' ),
		'section'  => 'woocommerce_product_catalog',
		'type'     => 'radio-image',
		'priority' => 1,
		'choices'  => array(
			'no-sidebar'    => array( 'url' => '%s/images/layout/no-sidebar.png', 'label' => esc_html__( 'No Sidebar', 'pennews' ) ),
			'sidebar-left'  => array( 'url' => '%s/images/layout/sidebar-left.png', 'label' => esc_html__( 'Sidebar Left', 'pennews' ) ),
			'sidebar-right' => array( 'url' => '%s/images/layout/sidebar-right.png', 'label' => esc_html__( 'Sidebar Right', 'pennews' ) ),
		),
		'settings' => 'penci_woo_sidebar_shop',
	)
) );

$wp_customize->add_setting( 'penci_woo_disable_breadcrumb', array(
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_woo_disable_breadcrumb',
	array(
		'label'    => esc_html__( 'Disable Breadcrumb', 'pennews' ),
		'section'  => 'woocommerce_product_catalog',
		'type'     => 'checkbox',
		'settings' => 'penci_woo_disable_breadcrumb',
	)
) );

$wp_customize->add_setting( 'penci_woo_paging_align', array(
	'default'           => 'center',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_woo_paging_align', array(
	'label'    => esc_html__( 'Page Navigation Alignment', 'pennews' ),
	'section'  => 'woocommerce_product_catalog',
	'settings' => 'penci_woo_paging_align',
	'type'     => 'select',
	'choices'  => array(
		'left'   => esc_html__( 'Left', 'pennews' ),
		'center' => esc_html__( 'Center', 'pennews' ),
		'right'  => esc_html__( 'Right', 'pennews' )
	)
) );


// Product
$wp_customize->add_section( 'penci-woo-product', array(
	'title'    => esc_html__( 'Product Detail', 'pennews' ),
	'priority' => 11,
	'panel'    => 'woocommerce',
) );
$wp_customize->add_setting( 'penci_woo_sidebar_product', array(
	'default'           => 'no-sidebar',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( new Penci_Customize_Control_Radio_Image(
	$wp_customize,
	'penci_woo_sidebar_product',
	array(
		'label'    => __( 'Sidebar On Product Detail', 'pennews' ),
		'section'  => 'penci-woo-product',
		'type'     => 'radio-image',
		'choices'  => array(
			'no-sidebar'    => array( 'url' => '%s/images/layout/no-sidebar.png', 'label' => esc_html__( 'No Sidebar', 'pennews' ) ),
			'sidebar-left'  => array( 'url' => '%s/images/layout/sidebar-left.png', 'label' => esc_html__( 'Sidebar Left', 'pennews' ) ),
			'sidebar-right' => array( 'url' => '%s/images/layout/sidebar-right.png', 'label' => esc_html__( 'Sidebar Right', 'pennews' ) ),
		),
		'settings' => 'penci_woo_sidebar_product',
	)
) );
$wp_customize->add_setting( 'penci_woo_disable_zoom', array(
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_woo_disable_zoom',
	array(
		'label'    => esc_html__( 'Disable Zoom on Gallery Product', 'pennews' ),
		'section'  => 'penci-woo-product',
		'type'     => 'checkbox',
		'settings' => 'penci_woo_disable_zoom',
	)
) );

$wp_customize->add_setting( 'penci_woo_number_related_products', array(
	'default'           => '4',
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Number_Control( $wp_customize, 'penci_woo_number_related_products', array(
	'label'    => esc_html__( 'Custom Amount of Related Products', 'pennews' ),
	'section'  => 'penci-woo-product',
	'settings' => 'penci_woo_number_related_products',
	'type'     => 'number',
) ) );

// Color
$wp_customize->add_section( 'penci-woo-color', array(
	'title' => esc_html__( 'Colors', 'pennews' ),
	'panel' => 'woocommerce',
) );

$wp_customize->add_setting( 'penci_woo_shortcode_dis_bg', array(
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_woo_shortcode_dis_bg',
	array(
		'label'    => esc_html__( 'Disable Background For Shortcode', 'pennews' ),
		'section'  => 'penci-woo-color',
		'type'     => 'checkbox',
		'settings' => 'penci_woo_shortcode_dis_bg',
	)
) );

$wp_customize->add_setting( 'penci_woo_shortcode_bg', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'hex_color' ),
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'penci_woo_shortcode_bg', array(
	'label'       => esc_html__( 'Background Color For Shortcode', 'pennews' ),
	'section'     => 'penci-woo-color',
	'settings'    => 'penci_woo_shortcode_bg',
	'description' => ''
) ) );