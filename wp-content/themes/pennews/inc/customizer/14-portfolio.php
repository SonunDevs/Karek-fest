<?php

$wp_customize->add_section( 'penci-portfolio', array(
	'title'    => esc_html__( 'Portfolio Options', 'pennews' ),
	'priority' => 31,
	'description' => esc_html__( 'If have any options here does not work, please update plugin Penci Portfolio to latest version by go to Plugins > All Plugins > Remove plugin Penci Portfolio and go to Appearance > Install Plugins to re-installation this plugin','pennews' )
) );

$wp_customize->add_setting( 'penci_portfolio_archive_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_portfolio_archive_heading', array(
	'label'    => esc_html__( 'Portfolio archive', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_portfolio_archive_heading',
	'type'     => 'heading',
) ) );

$wp_customize->add_setting( 'penci_pfl_archive_sidebar', array(
	'default'           => 'no-sidebar',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( new Penci_Customize_Control_Radio_Image(
	$wp_customize,
	'penci_pfl_archive_sidebar',
	array(
		'label'    => esc_html__( 'Archive Sidebar Layout', 'pennews' ),
		'section'  => 'penci-portfolio',
		'type'     => 'radio-image',
		'choices'  => array(
			'no-sidebar-wide' => array( 'url' => '%s/images/layout/wide-content.png', 'label' => esc_html__( 'Wide content', 'pennews' ) ),
			'no-sidebar-1080' => array( 'url' => '%s/images/layout/wide-content-1080.png', 'label' => esc_html__( 'Wide content 1080', 'pennews' ) ),
			'no-sidebar'    => array( 'url' => '%s/images/layout/no-sidebar.png', 'label' => __( 'No Sidebar', 'pennews' ) ),
			'sidebar-left'  => array( 'url' => '%s/images/layout/sidebar-left.png', 'label' => __( 'Sidebar Left', 'pennews' ) ),
			'sidebar-right' => array( 'url' => '%s/images/layout/sidebar-right.png', 'label' => __( 'Sidebar Right', 'pennews' ) ),
			'two-sidebar'     => array( 'url' => '%s/images/layout/3cm.png', 'label' => esc_html__( 'Two Sidebar', 'pennews' ) ),
		),
		'settings' => 'penci_pfl_archive_sidebar',
	)
) );

$wp_customize->add_setting( 'penci_pflarchive_w_container', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_pflarchive_w_container', array(
	'label'    => esc_html__( 'Custom Width Container', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_pflarchive_w_container',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_portfolio_layout', array(
	'default'           => 'masonry',
	'sanitize_callback' => array( $sanitizer, 'select' ),

) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'portfolio_layout', array(
	'label'    => esc_html__( 'Portfolio Category Layout', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_portfolio_layout',
	'type'     => 'radio',
	'choices'  => array(
		'masonry' => esc_html__( 'Masonry Layout', 'pennews' ),
		'grid'    => esc_html__( 'Grid Layout', 'pennews' )
	)
) ) );

$wp_customize->add_setting( 'penci_portfolio_item_style', array(
	'default'           => 'slidenfade-one',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_portfolio_item_style', array(
	'label'    => esc_html__( 'Portfolio Item Style', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_portfolio_item_style',
	'type'     => 'radio',
	'choices'  => array(
		'none'          => esc_html__( 'None', 'pennews' ),
		'fade'          => esc_html__( 'Fade', 'pennews' ),
		'slidenfade'    => esc_html__( 'Slide and Fade', 'pennews' ),
		'zoom'          => esc_html__( 'Zoom In', 'pennews' ),
		'fade-one'      => esc_html__( 'Fade (one by one)', 'pennews' ),
		'slidenfade-one'=> esc_html__( 'Slide and Fade (one by one)', 'pennews' ),
		'zoom-one'      => esc_html__( 'Zoom In (one by one)', 'pennews' )
	)
) ) );

$wp_customize->add_setting( 'penci_portfolio_column', array(
	'default'           => '3',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_portfolio_column', array(
	'label'    => esc_html__( 'Columns count for the current view type', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_portfolio_column',
	'type'     => 'radio',
	'choices'  => array(
		'1' => esc_html__( '1 Item per Row', 'pennews' ),
		'2' => esc_html__( '2 Items per Row', 'pennews' ),
		'3' => esc_html__( '3 Items per Row', 'pennews' ),
		'4' => esc_html__( '4 Items per Row', 'pennews' ),
		'5' => esc_html__( '5 Items per Row', 'pennews' ),
		'6' => esc_html__( '6 Items per Row', 'pennews' ),
	)
) ) );


$wp_customize->add_setting( 'penci_portfolio_effect', array(
	'default'           => 'text_overlay',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_portfolio_effect', array(
	'label'    => esc_html__( 'Effect portfolio items', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_portfolio_effect',
	'type'     => 'radio',
	'choices'  => array(
		'text_overlay' => esc_html__( 'Text Overlay', 'pennews' ),
		'below_img'    => esc_html__( 'Text Below Image', 'pennews' )
	)
) ) );

$wp_customize->add_setting( 'penci_portfolio_cat_showposts', array(
	'default'           => '12',
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( new Penci_Customize_Number_Control( $wp_customize, 'penci_portfolio_cat_showposts', array(
	'label'    => esc_html__( 'Portfolio Categories Show At Most', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_portfolio_cat_showposts',
	'type'     => 'number',
) ) );

$wp_customize->add_setting( 'penci_pfl_spacing_item', array(
	'sanitize_callback' => array( $sanitizer, 'html' )
) );

$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_pfl_spacing_item', array(
	'label'    => esc_html__( 'Custom spacing between portfolio item', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_pfl_spacing_item',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_portfolio_style_pag', array(
	'default'           => 'load_more',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_portfolio_style_pag', array(
	'label'    => esc_html__( 'Pagination', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_portfolio_style_pag',
	'type'     => 'select',
	'choices'  => array(
		''          => esc_html__( '- No pagination -', 'pennews' ),
		'load_more' => esc_html__( 'Load More Button', 'pennews' ),
		'infinite'  => esc_html__( 'Infinite Load', 'pennews' )
	)
) );

$wp_customize->add_setting( 'penci_portfolio_numbermore', array(
	'default'           => 6,
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( new Penci_Customize_Number_Control( $wp_customize, 'penci_portfolio_numbermore', array(
	'label'    => esc_html__( 'Custom Number Posts for Each Time Load More Posts', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_portfolio_numbermore',
	'type'     => 'number',
) ) );

$wp_customize->add_setting( 'penci_portfolio_pag_pos', array(
	'default'           => 'center',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_portfolio_pag_pos', array(
	'label'    => esc_html__( 'Page Navigation Align', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_portfolio_pag_pos',
	'type'     => 'select',
	'choices'  => array(
		'left'   => esc_html__( 'Left', 'pennews' ),
		'center' => esc_html__( 'Center', 'pennews' ),
		'right'  => esc_html__( 'Right', 'pennews' )
	)
) );

$wp_customize->add_setting( 'penci_portfolio_item_title_size', array(
	'sanitize_callback' => array( $sanitizer, 'html' )
) );

$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_portfolio_item_title_size', array(
	'label'    => esc_html__( 'Custom Font Size For Portfolio Title', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_portfolio_item_title_size',
	'type'     => 'font_size',
) ) );


$wp_customize->add_setting( 'penci_portfolio_item_cat_size', array(
	'sanitize_callback' => array( $sanitizer, 'html' )
) );

$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_portfolio_item_cat_size', array(
	'label'    => esc_html__( 'Custom Font Size For Portfolio Categories', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_portfolio_item_cat_size',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_pfl_readmore_margin_top', array(
	'sanitize_callback' => array( $sanitizer, 'html' )
) );

$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_pfl_readmore_margin_top', array(
	'label'    => esc_html__( 'Custom margin top for read more button', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_pfl_readmore_margin_top',
	'type'     => 'font_size',
) ) );


$wp_customize->add_setting( 'penci_portfolio_single_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_portfolio_single_heading', array(
	'label'    => esc_html__( 'Portfolio detail', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_portfolio_single_heading',
	'type'     => 'heading',
) ) );
$wp_customize->add_setting( 'penci_portfolio_sidebar', array(
	'default'           => 'no-sidebar-1080',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( new Penci_Customize_Control_Radio_Image(
	$wp_customize,
	'penci_portfolio_sidebar',
	array(
		'label'    => esc_html__( 'Single Sidebar Layout', 'pennews' ),
		'section'  => 'penci-portfolio',
		'type'     => 'radio-image',
		'choices'  => array(
			'no-sidebar-wide' => array( 'url' => '%s/images/layout/wide-content.png', 'label' => esc_html__( 'Wide content', 'pennews' ) ),
			'no-sidebar-1080' => array( 'url' => '%s/images/layout/wide-content-1080.png', 'label' => esc_html__( 'Wide content 1080', 'pennews' ) ),
			'no-sidebar'    => array( 'url' => '%s/images/layout/no-sidebar.png', 'label' => __( 'No Sidebar', 'pennews' ) ),
			'sidebar-left'  => array( 'url' => '%s/images/layout/sidebar-left.png', 'label' => __( 'Sidebar Left', 'pennews' ) ),
			'sidebar-right' => array( 'url' => '%s/images/layout/sidebar-right.png', 'label' => __( 'Sidebar Right', 'pennews' ) ),
			'two-sidebar'     => array( 'url' => '%s/images/layout/3cm.png', 'label' => esc_html__( 'Two Sidebar', 'pennews' ) ),
		),
		'settings' => 'penci_portfolio_sidebar',
	)
) );

$wp_customize->add_setting( 'penci_pflsingle_w_container', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new Penci_Customize_Font_size_Control( $wp_customize, 'penci_pflsingle_w_container', array(
	'label'    => esc_html__( 'Custom Width Container', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_pflsingle_w_container',
	'type'     => 'font_size',
) ) );


$wp_customize->add_setting( 'penci_portfolio_align_post_title', array(
	'default'           => 'center',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_portfolio_align_post_title', array(
	'label'    => esc_html__( 'Portfolio Title Align', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_portfolio_align_post_title',
	'type'     => 'select',
	'choices'  => array(
		'left'   => esc_html__( 'Left', 'pennews' ),
		'center' => esc_html__( 'Center', 'pennews' ),
		'right'  => esc_html__( 'Right', 'pennews' )
	)
) );

$single_list_check = array(
	'penci_hide_portfolio_breadcrumb'   => esc_html__( 'Hide Breadcrumbs', 'pennews' ),
	'penci_hide_portfolio_featured_img' => esc_html__( 'Hide Featured Image', 'pennews' ),
	'penci_show_portfolio_comments'     => esc_html__( 'Show Comments', 'pennews' ),
	'penci_pfl_properties_block'        => esc_html__( 'Move project properties below project description', 'pennews' ),
	'penci_portfolio_next_prev_project' => esc_html__( 'Hide Next / Prev', 'pennews' ),
	'penci_portfolio_related_project'   => esc_html__( 'Hide Related Project', 'pennews' ),
);

foreach ( $single_list_check as $id_option => $label_option ) {
	$wp_customize->add_setting( $id_option, array(
		'sanitize_callback' => array( $sanitizer, 'checkbox' ),
	) );

	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		$id_option,
		array(
			'label'    => $label_option,
			'section'  => 'penci-portfolio',
			'type'     => 'checkbox',
			'settings' => $id_option,
		)
	) );
}



// Related Posts Custom Text
$wp_customize->add_setting( 'penci_portfolio_related_text', array(
	'default'           => penci_tran_default_setting( 'penci_portfolio_related_text' ),
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_portfolio_related_text', array(
	'label'    => esc_html__( 'Text for "Related Projects"', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_portfolio_related_text',
) );

$wp_customize->add_setting( 'penci_pfl_next_text', array(
	'default'           => penci_tran_default_setting( 'penci_pfl_next_text' ),
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_pfl_next_text', array(
	'label'    => esc_html__( 'Text for "Next project"', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_pfl_next_text',
) );

$wp_customize->add_setting( 'penci_pfl_prev_text', array(
	'default'           => penci_tran_default_setting( 'penci_pfl_prev_text' ),
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_pfl_prev_text', array(
	'label'    => esc_html__( 'Text for "Previous project"', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_pfl_prev_text',
) );

// Amount of Related Posts
$wp_customize->add_setting( 'penci_portfolio_related_amount', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => 3,
) );
$wp_customize->add_control( new Penci_Customize_Number_Control( $wp_customize, 'penci_portfolio_related_amount', array(
	'label'    => esc_html__( 'Amount of Related Portfolio', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_portfolio_related_amount',
	'type'     => 'number',
) ) );

$wp_customize->add_setting( 'penci_portfolio_related_col', array(
	'default'           => 3,
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_portfolio_related_col', array(
	'label'    => esc_html__( 'Columns For Related Portfolio', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_portfolio_related_col',
	'type'     => 'select',
	'choices'  => array(
		'2'  => esc_html__( '2 Columns', 'pennews' ),
		'3'  => esc_html__( '3 Columns', 'pennews' ),
	)
) ) );


$wp_customize->add_setting( 'penci_hide_portfolio_socail_share', array(
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_hide_portfolio_socail_share',
	array(
		'label'    => esc_html__( 'Hide Social Share', 'pennews' ),
		'section'  => 'penci-portfolio',
		'type'     => 'checkbox',
		'settings' => 'penci_hide_portfolio_socail_share',
	)
) );

$wp_customize->add_setting( 'penci_portfolio_colors_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_portfolio_colors_heading', array(
	'label'    => esc_html__( 'Colors', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_portfolio_colors_heading',
	'type'     => 'heading',
) ) );

$options_color_portfolio = array(
	'penci_portfolio_title_color'   => esc_html__( 'Portfolio Title Color', 'pennews' ),
	'penci_portfolio_title_hcolor'  => esc_html__( 'Portfolio Title Hover Color', 'pennews' ),
	'penci_portfolio_cate_color'    => esc_html__( 'Portfolio Categories Color', 'pennews' ),
	'penci_portfolio_cate_hcolor'   => esc_html__( 'Portfolio Categories Hover Color', 'pennews' ),
	'penci_portfolio_overlay_color' => esc_html__( 'Portfolio Overlay Hover Color', 'pennews' ),
);

foreach ( $options_color_portfolio as $key => $label ) {
	$wp_customize->add_setting( $key, array(
		'default'           => penci_default_setting( $key ),
		'sanitize_callback' => array( $sanitizer, 'hex_color' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
		'label'    => $label,
		'section'  => 'penci-portfolio',
		'settings' => $key,
	) ) );
}
$wp_customize->add_setting( 'penci_portfolio_overlay_opacity', array(
	'default'           => '0.85',
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );
$wp_customize->add_control( 'penci_portfolio_overlay_opacity', array(
	'label'    => esc_html__( 'Portfolio Overlay Hover Opacity', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_portfolio_overlay_opacity',
	'type'     => 'select',
	'choices'  => array(
		'0.05' => '0.05',
		'0.1'  => '0.1',
		'0.15' => '0.15',
		'0.2'  => '0.2',
		'0.25' => '0.25',
		'0.3'  => '0.3',
		'0.35' => '0.35',
		'0.4'  => '0.4',
		'0.45' => '0.45',
		'0.5'  => '0.5',
		'0.55' => '0.55',
		'0.6'  => '0.6',
		'0.65' => '0.65',
		'0.7'  => '0.7',
		'0.75' => '0.75',
		'0.8'  => '0.8',
		'0.85' => '0.85',
		'0.9'  => '0.9',
		'0.95' => '0.95',
		'1'    => '1',
	)
) );


$options_color_portfolio_2 = array(
	'penci_pft_loadmore_color'           => esc_html__( 'Button Load More Text Color', 'pennews' ),
	'penci_pft_loadmore_bcolor'          => esc_html__( 'Button Load More Border Color', 'pennews' ),
	'penci_pft_loadmore_bgcolor'         => esc_html__( 'Button Load More Background Color', 'pennews' ),
	'penci_pft_loadmore_hcolor'          => esc_html__( 'Button Load More Text Hover Color', 'pennews' ),
	'penci_pft_loadmore_hbcolor'         => esc_html__( 'Button Load More Border Hover Color', 'pennews' ),
	'penci_pft_loadmore_hbgcolor'        => esc_html__( 'Button Load More Background Hover Color', 'pennews' ),
	'penci_pft_loadmore_animation_color' => esc_html__( 'Load More Amimation Color', 'pennews' ),
);

foreach ( $options_color_portfolio_2 as $key => $label ) {
	$wp_customize->add_setting( $key, array(
		'default'           => penci_default_setting( $key ),
		'sanitize_callback' => array( $sanitizer, 'hex_color' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
		'label'    => $label,
		'section'  => 'penci-portfolio',
		'settings' => $key,
	) ) );
}
$wp_customize->add_setting( 'penci_pft_loadmore_bordsize', array(
	'sanitize_callback' => array( $sanitizer, 'html' )
) );

$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_pft_loadmore_bordsize', array(
	'label'    => esc_html__( 'Custom Border Width For Load More Button', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_pft_loadmore_bordsize',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_portfolio_extra_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_portfolio_extra_heading', array(
	'label'    => esc_html__( 'Extra', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_portfolio_extra_heading',
	'type'     => 'heading',
) ) );

$wp_customize->add_setting( 'penci_pfl_custom_slug', array(
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_pfl_custom_slug', array(
	'label'    => esc_html__( 'Custom portfolio item URL prefix', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_pfl_custom_slug',
	'description' => sprintf( __('When you change this setting you need to %s flush rewrite rules. %s', 'pennews' ),'<a href="' . admin_url( 'options-permalink.php' ) . '" target="_bank">','</a>' ),
	'input_attrs' => array(
            'placeholder' => __( 'Current portfolio slug: portfolio', 'pennews' ),
        )
) );
$wp_customize->add_setting( 'penci_pfl_custom_catslug', array(
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_pfl_custom_catslug', array(
	'label'    => esc_html__( 'Custom portfolio category URL prefix', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_pfl_custom_catslug',
	'description' => sprintf( __('When you change this setting you need to %s flush rewrite rules.%s', 'pennews' ),'<a href="' . admin_url( 'options-permalink.php' ) . '" target="_bank">','</a>' ),
	'input_attrs' => array(
            'placeholder' => __( 'Current category slug: portfolio-category', 'pennews' ),
        )
) );

$wp_customize->add_setting( 'penci_pfl_custom_link_page', array(
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_pfl_custom_link_page', array(
	'label'    => esc_html__( 'Custom URL for Portfolio Page', 'pennews' ),
	'section'  => 'penci-portfolio',
	'settings' => 'penci_pfl_custom_link_page',
	'description' => esc_html__('By default, this theme auto regenerate a portfolio archive page, this option to help you override the URL for that portfolio page', 'pennews' ),
) );

