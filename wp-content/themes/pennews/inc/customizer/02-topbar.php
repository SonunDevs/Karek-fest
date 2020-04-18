<?php
$section_topbar  = 'penci_topbar';
$wp_customize->add_section( $section_topbar, array(
	'title'       => esc_html__( 'Topbar Options', 'pennews' ),
	'description' => esc_html__( 'The top bar is the black top menu. It is very useful when you want to add a login option, social icons and pages like About us, Contact us etc... ','pennews' ),
	'priority'    => 2,
) );

// Enable Top Bar
$wp_customize->add_setting( 'penci_topbar_show', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_topbar_show',
	array(
		'label'    => esc_html__( 'Enable Top Bar', 'pennews' ),
		'section'  => $section_topbar,
		'type'     => 'checkbox',
		'settings' => 'penci_topbar_show',
	)
) );

$wp_customize->add_setting( 'penci_topbar_font_size', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );

$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_topbar_font_size', array(
	'label'    => esc_html__( 'Custom Font Size For Top Bar', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_topbar_font_size',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_topbar_turn_off_upearcase', array(
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize,
	'penci_topbar_turn_off_upearcase',
	array(
		'label'    => esc_html__( 'Turn Off Uppercase for Topbar Menu on Header Style 7', 'pennews' ),
		'section'  => $section_topbar,
		'type'     => 'checkbox',
		'settings' => 'penci_topbar_turn_off_upearcase',
	)
) );

$wp_customize->add_setting( 'penci_topbar_width', array(
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );

$wp_customize->add_control( 'penci_topbar_width', array(
	'label'    => esc_html__( 'Topbar Container Width', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_topbar_width',
	'type'     => 'select',
	'choices'  => array(
		''                          => esc_html__( 'Default', 'pennews' ),
		'penci-container-fullwidth' => esc_html__( 'FullWidth', 'pennews' ),
		'penci-container-fluid'     => esc_html__( 'Width: 1400px', 'pennews' ),
		'penci-container-1170'     => esc_html__( 'Width: 1170px', 'pennews' ),
		'penci-container-1080'      => esc_html__( 'Width: 1080px', 'pennews' )
	)
) );


// Top bar Layout
$wp_customize->add_setting( 'penci_topbar_layout', array(
	'default'           => 'style-1',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( new Penci_Customize_Control_Radio_Image(
	$wp_customize, 'penci_topbar_layout',
	array(
		'label'    =>esc_html__( 'Top bar Layout', 'pennews' ),
		'section'  => $section_topbar,
		'type'     => 'radio-image',
		'choices'  => array(
			'style-1' => array( 'url' => '%s/images/topbar/style-1.png', 'label' => esc_html__( 'Style 1', 'pennews' ) ),
			'style-2' => array( 'url' => '%s/images/topbar/style-2.png', 'label' => esc_html__( 'Style 2', 'pennews' ) ),
			'style-3' => array( 'url' => '%s/images/topbar/style-3.png', 'label' => esc_html__( 'Style 3', 'pennews' ) ),
			'style-4' => array( 'url' => '%s/images/topbar/style-4.png', 'label' => esc_html__( 'Style 4', 'pennews' ) ),

		),
		'settings' => 'penci_topbar_layout',
	)
) );
// Show trending
$wp_customize->add_setting( 'penci_topbar_trending_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_topbar_trending_heading', array(
	'label'    => esc_html__( 'Trending', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_topbar_trending_heading',
	'type'     => 'heading',
) ) );

$wp_customize->add_setting( 'penci_topbar_show_trending', array(
	'default'           => 1,
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize, 'penci_topbar_show_trending',
	array(
		'label'    => esc_html__( 'Show trending', 'pennews' ),
		'section'  => $section_topbar,
		'type'     => 'checkbox',
		'settings' => 'penci_topbar_show_trending',
		'description' => ''
	)
) );

$wp_customize->add_setting( 'penci_topbar_trending_text', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => penci_default_setting( 'penci_topbar_trending_text' ),
) );
$wp_customize->add_control( 'penci_topbar_trending_text', array(
	'label'    => esc_html__( 'Custom "Trending now" Text', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_topbar_trending_text',
	'description' => esc_html__( 'If you want to hide "Trending now" Text, Empty This Field', 'pennews' )
) );

$wp_customize->add_setting( 'penci_topbar_trending_text_fsize', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );

$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_topbar_trending_text_fsize', array(
	'label'    => esc_html__( 'Custom Font Size For "Trending now" Text', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_topbar_trending_text_fsize',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_topbar_trending_cat', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_topbar_trending_cat', array(
	'label'    => esc_html__( 'Select "Trending now" Category', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_topbar_trending_cat',
	'type'     => 'select',
	'choices'  => penci_get_category()
) );

$wp_customize->add_setting( 'penci_topbar_trending_order', array(
	'default'           => 'latest-posts',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_topbar_trending_order', array(
	'label'    => esc_html__( 'Select Type', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_topbar_trending_order',
	'type'     => 'select',
	'choices' => array(
		'popular7'      => esc_html__( 'Show Popular Posts in Once Week', 'pennews' ),
		'popular_month' => esc_html__( 'Show Popular Posts in Once Month', 'pennews' ),
		'popular'       => esc_html__( 'Show Popular Posts in All Times', 'pennews' ),
		'latest-posts'  => esc_html__( 'Show Latest Posts', 'pennews' )
	)
) );

$wp_customize->add_setting( 'penci_topbar_trending_dis_auto', array(
	'default'           => 1,
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize, 'penci_topbar_trending_dis_auto',
	array(
		'label'    => esc_html__( 'Disable Auto Play Posts on Top Bar', 'pennews' ),
		'section'  => $section_topbar,
		'type'     => 'checkbox',
		'settings' => 'penci_topbar_trending_dis_auto',
		'description' => ''
	)
) );

$wp_customize->add_setting( 'penci_topbar_trending_autotime', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => '4000',
) );

$wp_customize->add_control( new Penci_Customize_Number_Control( $wp_customize, 'penci_topbar_trending_autotime', array(
	'label'    => esc_html__( 'Custom Auto Time Play Posts', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_topbar_trending_autotime',
	'type'     => 'number',
) ) );

$wp_customize->add_setting( 'penci_topbar_trending_speed', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => '400',
) );

$wp_customize->add_control( new Penci_Customize_Number_Control( $wp_customize, 'penci_topbar_trending_speed', array(
	'label'    => esc_html__( 'Custom Auto Time Auto Speed', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_topbar_trending_speed',
	'type'     => 'number',
) ) );

$wp_customize->add_setting( 'penci_topbar_trending_amount', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => '10',
) );

$wp_customize->add_control( new Penci_Customize_Number_Control( $wp_customize, 'penci_topbar_trending_amount', array(
	'label'    => esc_html__( 'Amount of Posts Display on Top Bar', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_topbar_trending_amount',
	'type'     => 'number',
) ) );

$wp_customize->add_setting( 'penci_topbar_trending_num_words', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           =>7,
) );

$wp_customize->add_control( new Penci_Customize_Number_Control( $wp_customize, 'penci_topbar_trending_num_words', array(
	'label'    => esc_html__( 'Amount Of Words For Post Title Display on Top Bar', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_topbar_trending_num_words',
	'type'     => 'number',
) ) );

$wp_customize->add_setting( 'penci_topbar_trending_ptitle_fsize', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );

$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_topbar_trending_ptitle_fsize', array(
	'label'    => esc_html__( 'Custom Font Size  Post Title Display on Top Bar', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_topbar_trending_ptitle_fsize',
	'type'     => 'font_size',
) ) );

$wp_customize->add_setting( 'penci_topbar_trending_width', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
	'default'           => '500',
) );

$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_topbar_trending_width', array(
	'label'    => esc_html__( 'Width ( minimum width 300px )', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_topbar_trending_width',
	'type'     => 'font_size',
) ) );


// Show menu
$wp_customize->add_setting( 'penci_topbar_menu_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_topbar_menu_heading', array(
	'label'    => esc_html__( 'Menu', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_topbar_menu_heading',
	'type'     => 'heading',
) ) );
$wp_customize->add_setting( 'penci_topbar_show_menu', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize, 'penci_topbar_show_menu',
	array(
		'label'    => esc_html__( 'Show the topbar menu', 'pennews' ),
		'section'  => $section_topbar,
		'type'     => 'checkbox',
		'settings' => 'penci_topbar_show_menu',
		'description' => 'If you want to assign a menu for your topbar menu, please go to Appearance > Menus > create a new menu > scroll down and check to <strong>Topbar Menu</strong>'
	)
) );

// Show socials
$wp_customize->add_setting( 'penci_topbar_socials_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_topbar_socials_heading', array(
	'label'    => esc_html__( 'Social icons', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_topbar_socials_heading',
	'type'     => 'heading',
) ) );
$wp_customize->add_setting( 'penci_topbar_show_socials', array(
	'default'           => 1,
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize, 'penci_topbar_show_socials',
	array(
		'label'    => esc_html__( 'Show Social Icons', 'pennews' ),
		'section'  => $section_topbar,
		'type'     => 'checkbox',
		'settings' => 'penci_topbar_show_socials',
		'description' => ''
	)
) );

$wp_customize->add_setting( 'penci_topbar_socials_fsize', array(
	'sanitize_callback' => array( $sanitizer, 'html' ),
) );

$wp_customize->add_control( new Penci_Customize_Font_Size_Control( $wp_customize, 'penci_topbar_socials_fsize', array(
	'label'    => esc_html__( 'Custom Font Size For Social Icons', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_topbar_socials_fsize',
	'type'     => 'font_size',
) ) );

// Show login and register
$wp_customize->add_setting( 'penci_topbar_login_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_topbar_login_heading', array(
	'label'    => esc_html__( 'Login & Register', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_topbar_login_heading',
	'type'     => 'heading',
) ) );

$wp_customize->add_setting( 'penci_topbar_show_signin', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize, 'penci_topbar_show_signin',
	array(
		'label'       => esc_html__( 'Show Sign In / Join', 'pennews' ),
		'section'     => $section_topbar,
		'type'        => 'checkbox',
		'settings'    => 'penci_topbar_show_signin',
		'description' => esc_html__( 'By default, wordpress disable register user, if you want to make register form appears, please enable it via admin page > Settings > General > Membership > Anyone can register', 'pennews' )
	)
) );

$wp_customize->add_setting( 'penci_topbar_use_myaccount_url', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize, 'penci_topbar_use_myaccount_url',
	array(
		'label'       => esc_html__( 'Enable my account page link Replace with URL of the author page', 'pennews' ),
		'section'     => $section_topbar,
		'type'        => 'checkbox',
		'settings'    => 'penci_topbar_use_myaccount_url',
		'description' => esc_html__( 'If it\'s enabled the option and woocommerce plugin is activated, the author link will show my account page link', 'pennews' )
	)
) );

$wp_customize->add_setting( 'penci_plogin_title_login', array(
	'sanitize_callback' => array( $sanitizer, 'text' ),
	'default'           => penci_default_setting( 'penci_plogin_title_login' ),
) );
$wp_customize->add_control( 'penci_plogin_title_login', array(
	'label'    => esc_html__( 'Text for title login', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_plogin_title_login',
) );
$wp_customize->add_setting( 'penci_plogin_title_register', array(
	'sanitize_callback' => array( $sanitizer, 'text' ),
	'default'           => penci_default_setting( 'penci_plogin_title_register' ),
) );
$wp_customize->add_control( 'penci_plogin_title_register', array(
	'label'    => esc_html__( 'Text for title register', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_plogin_title_register',
) );

// Show date
$wp_customize->add_setting( 'penci_topbar_date_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_topbar_date_heading', array(
	'label'    => esc_html__( 'Date', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_topbar_date_heading',
	'type'     => 'heading',
) ) );
$wp_customize->add_setting( 'penci_topbar_show_date', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize, 'penci_topbar_show_date',
	array(
		'label'    => esc_html__( 'Show date', 'pennews' ),
		'section'  => $section_topbar,
		'type'     => 'checkbox',
		'settings' => 'penci_topbar_show_date',
		'description' => ''
	)
) );

$wp_customize->add_setting( 'penci_topbar_date_format', array(
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_topbar_date_format', array(
	'label'    => esc_html__( 'Date format', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_topbar_date_format',
	'description' => sprintf( 'Default value: %s. %s about the date format (it\'s the same with the php date function)',
		get_option( 'date_format' ),
		'<a href="' . esc_url( 'https://codex.wordpress.org/Formatting_Date_and_Time' ) . '">' . esc_html__( 'Read more','pennews' ) . '</a>'
	)
) );


// Show weather
$wp_customize->add_setting( 'penci_topbar_weather_heading', array(
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_topbar_weather_heading', array(
	'label'    => esc_html__( 'Weather', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_topbar_weather_heading',
	'type'     => 'heading',
) ) );
$wp_customize->add_setting( 'penci_topbar_show_weather', array(
	'default'           => '',
	'sanitize_callback' => array( $sanitizer, 'checkbox' ),
) );

$wp_customize->add_control( new WP_Customize_Control(
	$wp_customize, 'penci_topbar_show_weather',
	array(
		'label'    => esc_html__( 'Show Weather', 'pennews' ),
		'section'  => $section_topbar,
		'type'     => 'checkbox',
		'settings' => 'penci_topbar_show_weather',
		'description' => ''
	)
) );

$wp_customize->add_setting( 'penci_topbar_location_weather', array(
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_topbar_location_weather', array(
	'label'    => esc_html__( 'Location', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_topbar_location_weather',
	'description' => sprintf( '%s - You can use "city name" (ex: London) or "city name,country code" (ex: London,uk)%s',
		'<a href="' . esc_url( 'http://openweathermap.org/find' ) . '">' . esc_html__( 'Find your location','pennews' ) . '</a>',
		'</br><a target="_bank" href="' . esc_url( 'https://image.prntscr.com/image/7WsPGQsATS6yT6TF1Bt8gQ.png' ) . '"><img alt="Location" src="' . esc_url( 'https://image.prntscr.com/image/7WsPGQsATS6yT6TF1Bt8gQ.png' ) . '"/></a>'
	)
) );
$wp_customize->add_setting( 'penci_topbar_weather_display', array(
	'sanitize_callback' => array( $sanitizer, 'text' ),
) );
$wp_customize->add_control( 'penci_topbar_weather_display', array(
	'label'    => esc_html__( 'Location Display', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_topbar_weather_display',
	'description' => esc_html__( 'If the option is empty,will display results from ', 'pennews' ) . '<a href="' . esc_url( 'http://openweathermap.org/find' ) . '">openweathermap.org</a>',
) );

$wp_customize->add_setting( 'penci_topbar_weather_units', array(
	'default'           => 'metric',
	'sanitize_callback' => array( $sanitizer, 'select' ),
) );
$wp_customize->add_control( 'penci_topbar_weather_units', array(
	'label'    => esc_html__( 'Units', 'pennews' ),
	'section'  => $section_topbar,
	'settings' => 'penci_topbar_weather_units',
	'type'     => 'select',
	'choices'  => array(
		'metric' => esc_html__( 'Celsius','pennews' ),
		'imperial' => esc_html__( 'Fahrenheit','pennews' ),
	)
) );
