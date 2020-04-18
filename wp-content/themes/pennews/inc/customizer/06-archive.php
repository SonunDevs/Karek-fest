<?php
$option_blog_layout = penci_get_option_blog_layout();

$wp_customize->add_section( 'penci_archive', array(
	'title' => esc_html__( 'Archive, Category, Blog, Tag, Search Pages Options', 'pennews' ),
	'priority' => 5,
) );

$wp_customize->add_setting( 'penci_archive_sidebar_layout', array(
	'default'           => 'sidebar-right',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( new Penci_Customize_Control_Radio_Image(
	$wp_customize,
	'penci_archive_sidebar_layout',
	array(
		'label'    => __( 'Archive Page Sidebar Layout', 'pennews' ),
		'section'  => 'penci_archive',
		'type'     => 'radio-image',
		'choices'  => array(
			'no-sidebar-wide' => array( 'url' => '%s/images/layout/wide-content.png', 'label' => esc_html__( 'Wide content', 'pennews' ) ),
			'no-sidebar'      => array( 'url' => '%s/images/layout/no-sidebar.png', 'label' => esc_html__( 'No Sidebar', 'pennews' ) ),
			'sidebar-left'    => array( 'url' => '%s/images/layout/sidebar-left.png', 'label' => esc_html__( 'Sidebar Left', 'pennews' ) ),
			'sidebar-right'   => array( 'url' => '%s/images/layout/sidebar-right.png', 'label' => esc_html__( 'Sidebar Right', 'pennews' ) ),
			'two-sidebar'     => array( 'url' => '%s/images/layout/3cm.png', 'label' => esc_html__( 'Two Sidebar', 'pennews' ) ),
		),
		'settings' => 'penci_archive_sidebar_layout',
	)
) );

// Blog layout
$wp_customize->add_setting( 'penci_home_layout_style', array(
	'default'           => 'blog-default',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( new Penci_Customize_Control_Radio_Image(
	$wp_customize,
	'penci_home_layout_style',
	array(
		'label'    => esc_html__( 'Blog Layout Style', 'pennews' ),
		'section'  => 'penci_archive',
		'type'     => 'radio-image',
		'choices'  => $option_blog_layout,
		'settings' => 'penci_home_layout_style',
	)
) );
$wp_customize->add_setting( 'penci_home_img_size', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control(
	'penci_home_img_size',
	array(
		'label'    => esc_html__( 'Image Size for Blog Page Layout', 'pennews' ),
		'section'  => 'penci_archive',
		'type'     => 'select',
		'choices'  => penci_pennews_theme_list_image_sizes(),
		'settings' => 'penci_home_img_size',
	)
);

// Cat layout
$wp_customize->add_setting( 'penci_cat_layout_style', array(
	'default'           => 'blog-default',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );

$wp_customize->add_control( new Penci_Customize_Control_Radio_Image(
	$wp_customize,
	'penci_cat_layout_style',
	array(
		'label'    => esc_html__( 'Category Layout Style', 'pennews' ),
		'section'  => 'penci_archive',
		'type'     => 'radio-image',
		'choices'  => $option_blog_layout,
		'settings' => 'penci_cat_layout_style',
	)
) );

$wp_customize->add_setting( 'penci_cat_img_size', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control(
	'penci_cat_img_size',
	array(
		'label'    => esc_html__( 'Image Size for Category Page Layout', 'pennews' ),
		'section'  => 'penci_archive',
		'type'     => 'select',
		'choices'  => penci_pennews_theme_list_image_sizes(),
		'settings' => 'penci_cat_img_size',
	)
);

// Archive page layout style
$wp_customize->add_setting( 'penci_archive_layout_style', array(
	'default'           => 'blog-default',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( new Penci_Customize_Control_Radio_Image(
	$wp_customize,
	'penci_archive_layout_style',
	array(
		'label'    => esc_html__( 'Archive Layout Style', 'pennews' ),
		'section'  => 'penci_archive',
		'type'     => 'radio-image',
		'choices'  => $option_blog_layout,
		'settings' => 'penci_archive_layout_style',
	)
) );

$wp_customize->add_setting( 'penci_archive_img_size', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control(
	'penci_archive_img_size',
	array(
		'label'    => esc_html__( 'Image Size for Archive Page Layout', 'pennews' ),
		'section'  => 'penci_archive',
		'type'     => 'select',
		'choices'  => penci_pennews_theme_list_image_sizes(),
		'settings' => 'penci_archive_img_size',
	)
);

// Custom sidebar left
$wp_customize->add_setting( 'penci_archive_custom_sidebar_left', array(
	'default'           => 'sidebar-2',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control(
	'penci_archive_custom_sidebar_left',
	array(
		'label'    => esc_html__( 'Custom Sidebar Left', 'pennews' ),
		'section'  => 'penci_archive',
		'type'     => 'select',
		'choices'  => Penci_Custom_Sidebar::get_list_sidebar( ),
		'settings' => 'penci_archive_custom_sidebar_left',
	)
);

// Custom sidebar right
$wp_customize->add_setting( 'penci_archive_custom_sidebar_right', array(
	'default'           => 'sidebar-1',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control(
	'penci_archive_custom_sidebar_right',
	array(
		'label'    => esc_html__( 'Custom Sidebar right', 'pennews' ),
		'section'  => 'penci_archive',
		'type'     => 'select',
		'choices'  => Penci_Custom_Sidebar::get_list_sidebar( 'right' ),
		'settings' => 'penci_archive_custom_sidebar_right',
	)
);

// Blog display
$wp_customize->add_setting( 'penci_blog_display', array(
	'default'           => 'excerpt',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control(
	'penci_blog_display',
	array(
		'label'    => esc_html__( 'Content Display On Blog Archive Page', 'pennews' ),
		'section'  => 'penci_archive',
		'type'     => 'select',
		'choices'  => array(
			'excerpt' => esc_html__( 'Post excerpt', 'pennews' ),
			'content' => esc_html__( 'Post content', 'pennews' ),
			'more'    => esc_html__( 'Post content before more tag', 'pennews' ),
		),
		'settings' => 'penci_blog_display',
	)
);

// Post content limit (words)
$wp_customize->add_setting( 'penci_blog_content_limit', array(
	'default'           => '25',
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( new Penci_Customize_Number_Control( $wp_customize,  'penci_blog_content_limit', array(
	'label'    => esc_html__( 'Post Content Limit (words)', 'pennews' ),
	'section'  => 'penci_archive',
	'settings' => 'penci_blog_content_limit',
	'type'     => 'number',
) ) );
/**
 * Button readmore
 */

$wp_customize->add_setting( 'penci_show_read_more_post', array(
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_show_read_more_post',
	array(
		'label'    => esc_html__( 'Show Read More Button', 'pennews' ),
		'section'  => 'penci_archive',
		'type'     => 'checkbox',
		'settings' => 'penci_show_read_more_post',
	)
) );

$wp_customize->add_setting( 'penci_arch_rmore_fsize', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_arch_rmore_fsize', array(
	'label'    => esc_html__( 'Custom Font Size For Button Read More', 'pennews' ),
	'section'  => 'penci_archive',
	'settings' => 'penci_arch_rmore_fsize',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_arch_rmore_font', array(
	'default'           => penci_default_setting( 'penci_arch_rmore_font' ),
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_arch_rmore_font', array(
	'label'       => esc_html__( 'Custom Font Family For Button Read More', 'pennews' ),
	'section'     => 'penci_archive',
	'settings'    => 'penci_arch_rmore_font',
	'description' => 'Default font is "Mukta Vaani"',
	'type'        => 'select',
	'choices'     => penci_all_fonts()
) );

$wp_customize->add_setting( 'penci_arch_rmore_fweight', array(
	'default'           => '500',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_arch_rmore_fweight', array(
	'label'    => esc_html__( 'Custom Font Weight For Button Read More', 'pennews' ),
	'section'  => 'penci_archive',
	'settings' => 'penci_arch_rmore_fweight',
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

/**
 * Archive header setting
 */
$wp_customize->add_setting( 'penci_archive_header_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_archive_header_heading', array(
	'label'    => esc_html__( 'Archive header setting', 'pennews' ),
	'section'  => 'penci_archive',
	'settings' => 'penci_archive_header_heading',
	'type'     => 'heading',
) ) );

$page_list_check = array(
	'penci_hide_archive_title'      => esc_html__( 'Hide Archive Title & Description', 'pennews' ),
	'penci_enable_blogpage_title'   => esc_html__( 'Enable Page Title for Blog Page', 'pennews' ),
	'penci_hide_archive_breadcrumb' => esc_html__( 'Hide Breadcrumbs', 'pennews' ),
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
			'section'  => 'penci_archive',
			'type'     => 'checkbox',
			'settings' => $id_option,
		)
	) );
}

$wp_customize->add_setting( 'penci_archive_size_post_title', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => '30',
) );

$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_archive_size_post_title', array(
	'label'    => esc_html__( 'Custom Font Size For Title Archive', 'pennews' ),
	'section'  => 'penci_archive',
	'settings' => 'penci_archive_size_post_title',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_archive_align_post_title', array(
	'default'           => 'left',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_archive_align_post_title', array(
	'label'    => esc_html__( 'Align Center Archive Title', 'pennews' ),
	'section'  => 'penci_archive',
	'settings' => 'penci_archive_align_post_title',
	'type'     => 'select',
	'choices'  => array(
		'left' 		=> esc_html__( 'Left', 'pennews' ),
		'center'    => esc_html__( 'Center', 'pennews' ),
		'right'    => esc_html__( 'Right', 'pennews' )
	)
) );

$wp_customize->add_setting( 'penci_archive_size_item_post_title', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => '',
) );

$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_archive_size_item_post_title', array(
	'label'    => esc_html__( 'Custom Font Size For Post Title', 'pennews' ),
	'section'  => 'penci_archive',
	'settings' => 'penci_archive_size_item_post_title',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_arch_fweight_item_ptitle', array(
	'default'           => '600',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_arch_fweight_item_ptitle', array(
	'label'    => esc_html__( 'Custom Font Weight For Post Title', 'pennews' ),
	'section'  => 'penci_archive',
	'settings' => 'penci_arch_fweight_item_ptitle',
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

$wp_customize->add_setting( 'penci_archive_size_item_post_meta', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => '',
) );

$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_archive_size_item_post_meta', array(
	'label'    => esc_html__( 'Custom Font Size For Post Meta', 'pennews' ),
	'section'  => 'penci_archive',
	'settings' => 'penci_archive_size_item_post_meta',
	'type'     => 'font_size',
) ) );


$wp_customize->add_setting( 'penci_archive_size_item_post_desc', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => '',
) );

$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_archive_size_item_post_desc', array(
	'label'    => esc_html__( 'Custom Font Size For Post Description', 'pennews' ),
	'section'  => 'penci_archive',
	'settings' => 'penci_archive_size_item_post_desc',
	'type'     => 'font_size',
) ) );

// Pagination style
$wp_customize->add_setting( 'penci_archive_pag_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_archive_pag_heading', array(
	'label'    => esc_html__( 'Pagination setting', 'pennews' ),
	'section'  => 'penci_archive',
	'settings' => 'penci_archive_pag_heading',
	'type'     => 'heading',
) ) );

$wp_customize->add_setting( 'penci_blog_pagination', array(
	'default'           => 'default',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_blog_pagination', array(
		'label'    => esc_html__( 'Pagination Style', 'pennews' ),
		'section'  => 'penci_archive',
		'type'     => 'select',
		'choices'  => array(
			'default'         => esc_html__( 'Default', 'pennews' ),
			'load_more'       => esc_html__( 'Load more button', 'pennews' ),
			'infinite_scroll' => esc_html__( 'Infinite scroll', 'pennews' ),

		),
		'settings' => 'penci_blog_pagination',
	)
);

$wp_customize->add_setting( 'penci_blog_pag_pos', array(
	'default'           => 'left',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_blog_pag_pos', array(
		'label'    => esc_html__( 'Page Navigation Alignment', 'pennews' ),
		'section'  => 'penci_archive',
		'type'     => 'select',
		'choices'  => array(
			'left'   => esc_html__( 'left', 'pennews' ),
			'center' => esc_html__( 'Center', 'pennews' ),
			'right'  => esc_html__( 'Right', 'pennews' ),
		),
		'settings' => 'penci_blog_pag_pos',
	)
);



// Button click handle text

$wp_customize->add_setting( 'penci_number_load_more', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => 6,
) );

$wp_customize->add_control( new Penci_Customize_Number_Control( $wp_customize, 'penci_number_load_more', array(
	'label'    => esc_html__( 'Custom Number Posts for Each Time Load More Posts', 'pennews' ),
	'section'  => 'penci_archive',
	'settings' => 'penci_number_load_more',
	'type'     => 'number',
) ) );

/**
 * In-feed ads option
 */
$wp_customize->add_setting( 'penci_archive_infeedad_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_archive_infeedad_heading', array(
	'label'    => esc_html__( 'In-feed ads setting', 'pennews' ),
	'section'  => 'penci_archive',
	'settings' => 'penci_archive_infeedad_heading',
	'type'     => 'heading',
) ) );

$wp_customize->add_setting( 'penci_archive_infeedad_order', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => 3,
) );

$wp_customize->add_control( new Penci_Customize_Number_Control( $wp_customize, 'penci_archive_infeedad_order', array(
	'label'    => esc_html__( 'Insert In-feed Ad code after post:', 'pennews' ),
	'section'  => 'penci_archive',
	'settings' => 'penci_archive_infeedad_order',
	'type'     => 'number',
) ) );

$wp_customize->add_setting( 'penci_archive_infeedad_code', array(
	'sanitize_callback' => array( $sanitizer, 'textarea' ),
) );

$wp_customize->add_control( 'penci_archive_infeedad_code', array(
	'label'    => esc_html__( 'In-feed Ad Code', 'pennews' ),
	'section'  => 'penci_archive',
	'settings' => 'penci_archive_infeedad_code',
	'type'     => 'textarea',
) );

/**
 * Google Adsense option
 */
$wp_customize->add_setting( 'penci_archive_google_ad_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_archive_google_ad_heading', array(
	'label'    => esc_html__( 'Google Adsense Setting', 'pennews' ),
	'section'  => 'penci_archive',
	'settings' => 'penci_archive_google_ad_heading',
	'type'     => 'heading',
) ) );

$wp_customize->add_setting( 'penci_archive_ad_above', array(
	'sanitize_callback' => array( $sanitizer, 'textarea' ),
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_archive_ad_above', array(
	'label'       => esc_html__('Google Adsense Code to Display Above Posts Layout for Archive Pages', 'pennews' ),
	'section'     => 'penci_archive',
	'settings'    => 'penci_archive_ad_above',
	'description' => esc_html__('You can display google adsense code above posts on category, tags, search, archive page by use this option', 'pennews' ),
	'type'        => 'textarea',
) ) );

$wp_customize->add_setting( 'penci_archive_ad_below', array(
	'sanitize_callback' => array( $sanitizer, 'textarea' ),
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_archive_ad_below', array(
	'label'       => esc_html__('Google Adsense Code to Display Below Posts Layout for Archive Pages', 'pennews' ),
	'section'     => 'penci_archive',
	'settings'    => 'penci_archive_ad_below',
	'description' => esc_html__('You can display google adsense code below posts on category, tags, search, archive page by use this option', 'pennews' ),
	'type'        => 'textarea',
) ) );

/**
 * Extra option
 */
$wp_customize->add_setting( 'penci_archive_extra_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_archive_extra_heading', array(
	'label'    => esc_html__( 'Extra setting', 'pennews' ),
	'section'  => 'penci_archive',
	'settings' => 'penci_archive_extra_heading',
	'type'     => 'heading',
) ) );


$archive_list_check = array(
	'archive_hide_prefix_page_title' => esc_html__( 'Hide "Category:" and "Tag:" words on category & tag page', 'pennews' ),
	'archive_show_pri_cat'           => esc_html__( 'Display Only Primary Category', 'pennews' ),
	'archive_hide_post_cat'          => esc_html__( 'Hide Post Category', 'pennews' ),
	'archive_hide_post_review'       => esc_html__( 'Hide Post Review Pie Chart', 'pennews' ),
	'archive_hide_post_description'  => esc_html__( 'Hide Post Description', 'pennews' ),
	'archive_hide_post_author'       => esc_html__( 'Hide Post Author', 'pennews' ),
	'archive_hide_date'              => esc_html__( 'Hide Post Date', 'pennews' ),
	'archive_hide_view'              => esc_html__( 'Hide Post Count View', 'pennews' ),
	'archive_hide_post_comment'      => esc_html__( 'Hide Post Comment', 'pennews' ),
);
foreach ( $archive_list_check as $id_option => $label_option ) {

	$desc = '';

	if( 'archive_show_pri_cat' == $id_option ) {
		$desc = esc_html__( 'You need to use Primary Category feature from Yoast SEO plugin to use this option','pennews' );
	}

	$wp_customize->add_setting( $id_option, array(
		'sanitize_callback' => array( $sanitizer, 'checkbox' ),
	) );

	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		$id_option,
		array(
			'label'       => $label_option,
			'section'     => 'penci_archive',
			'type'        => 'checkbox',
			'settings'    => $id_option,
			'description' => $desc
		)
	) );
}

// Color
$wp_customize->add_setting( 'penci_archive_colors_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_archive_colors_heading', array(
	'label'    => esc_html__( 'Colors', 'pennews' ),
	'section'  => 'penci_archive',
	'settings' => 'penci_archive_colors_heading',
	'type'     => 'heading',
) ) );

$options_color_archive = array(
	'penci_archive_title_color'               => esc_html__( 'Archive Title Color', 'pennews' ),
	'penci_archive_title_border_bottom_color' => esc_html__( 'Archive Border Bottom Title Color', 'pennews' ),
	'penci_archive_breadcrumbs_color'         => esc_html__( 'Breadcrumbs Color', 'pennews' ),

	'penci_archive_list_post_title_color' => esc_html__( 'Post title color', 'pennews' ),
	'penci_archive_list_post_meta_color'  => esc_html__( 'Post Meta Color', 'pennews' ),
	'penci_archive_list_post_des_color'   => esc_html__( 'Post Description Color', 'pennews' ),

	'penci_penci_arch_rmore_color'    => esc_html__( 'Read More Button Text Color', 'pennews' ),
	'penci_penci_arch_rmore_bgcolor'  => esc_html__( 'Read More Button Background Color', 'pennews' ),
	'penci_penci_arch_rmore_hcolor'   => esc_html__( 'Read More Button Hover Text Color', 'pennews' ),
	'penci_penci_arch_rmore_hbgcolor' => esc_html__( 'Read More Button Hover Background Color', 'pennews' ),

	'penci_archive_list_post_cat_color'   => esc_html__( 'Post Categories Text Color', 'pennews' ),
	'penci_archive_list_post_cat_bgcolor' => esc_html__( 'Post Categories Background Color', 'pennews' ),
	'penci_archive_list_post_cat_hcolor'   => esc_html__( 'Post Categories Hover Text Color', 'pennews' ),
	'penci_archive_list_post_cat_hbgcolor' => esc_html__( 'Post Categories Hover Background Color', 'pennews' ),

);

foreach ( $options_color_archive as $key => $label ) {

	$wp_customize->add_setting( $key, array(
		'default'           => penci_default_setting( $key ),
		'sanitize_callback' => array( $sanitizer, 'hex_color' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
		'label'       => $label,
		'section'     => 'penci_archive',
		'settings'    => $key,
		'description' => ''
	) ) );
}
