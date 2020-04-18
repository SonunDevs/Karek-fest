<?php
$wp_customize->add_section( 'penci_section_transition_text', array(
	'title'       => esc_html__( 'Quick Text Translation', 'pennews' ),
	'description' => sprintf(
		esc_html__( 'Use shortcode [pencilang] with multiple languages site (ex: [pencilang en_US=\'Share\' fr_FR=\'Partager\' language_code=\'Your language text\' /]). You can check language code %s', 'pennews' ),
		'<a href="' . esc_url( 'http://www.aurodigo.com/2015/02/wordpress-locale-codes-complete-list.html' ) . '" target="_blank">' . esc_html__( 'here', 'pennews' ) . '</a>'
	),
	'priority'    => 30,
) );

$options_transition = array(

	// Topbar
	'penci_heading_tran_topbar'              => esc_html__( 'Topbar', 'pennews' ),
	'penci_topbar_logout'                    => esc_html__( 'Text for "Logout"', 'pennews' ),
	'penci_topbar_signin'                    => esc_html__( 'Text for "Sign in / Join"', 'pennews' ),

	// Comment
	'penci_heading_tran_comment'             => esc_html__( 'Comment', 'pennews' ),
	'penci_comment_text'                     => esc_html__( 'Text for "Comments"', 'pennews' ),
	'penci_fbcomment_text'                   => esc_html__( 'Text for "Facebook comments"', 'pennews' ),
	'penci_comment_zero'                     => esc_html__( 'Text for "0 comment"', 'pennews' ),
	'penci_comment_one'                      => esc_html__( 'Text for "1 comment"', 'pennews' ),
	'penci_comment_more'                     => esc_html__( 'Text for "comments"', 'pennews' ),
	'penci_comment_clickto'                  => esc_html__( 'Text for "Click to comment"', 'pennews' ),
	'penci_comment_author_placeholder'       => esc_html__( 'Text for "Name*"', 'pennews' ),
	'penci_comment_author_email_placeholder' => esc_html__( 'Text for "Email*"', 'pennews' ),
	'penci_comment_author_url_placeholder'   => esc_html__( 'Text for "Website"', 'pennews' ),
	'penci_comment_field_placeholder'        => esc_html__( 'Text for "Your Comment"', 'pennews' ),
	'penci_comment_title_reply'              => esc_html__( 'Text for "Leave a Comment"', 'pennews' ),
	'penci_comment_title_reply_to'           => esc_html__( 'Text for "Leave a Reply to"', 'pennews' ),
	'penci_comment_cancel_reply_link'        => esc_html__( 'Text for "Cancel Reply"', 'pennews' ),
	'penci_comment_awaiting_approval'        => esc_html__( 'Text for "Your comment awaiting approval"', 'pennews' ),
	'penci_comment_reply_text'               => esc_html__( 'Text for "Reply"', 'pennews' ),
	'penci_comment_edit_comment'             => esc_html__( 'Text for "Edit"', 'pennews' ),
	'penci_comment_label_submit'             => esc_html__( 'Text for "Submit"', 'pennews' ),
	'penci_comment_close'                    => esc_html__( 'Text for "Comments are closed."', 'pennews' ),
	'penci_comment_save_field_text'          => esc_html__( 'Text for "Save my name, email, and website in this browser for the next time I comment."', 'pennews' ),

	// Search
	'penci_heading_tran_search'              => esc_html__( 'Search', 'pennews' ),
	'penci_search_enter_keyword'             => esc_html__( 'Text for "Enter keyword..."', 'pennews' ),
	'penci_search_title'                     => esc_html__( 'Text for "Search Results for"', 'pennews' ),
	'penci_ajaxsearch_viewmore_text'         => esc_html__( 'Text "View More Search Results"', 'pennews' ),
	'penci_ajaxsearch_no_post'               => esc_html__( 'Text "No Post Found!"', 'pennews' ),

	// Breadcrumbs
	'penci_heading_tran_breadcrumbs'         => esc_html__( 'Breadcrumbs', 'pennews' ),
	'penci_breadcrumb_home_label'            => esc_html__( 'Text for "Home"', 'pennews' ),
	'penci_breadcrumb_page_404'              => esc_html__( 'Text for "Not Found"', 'pennews' ),
	'penci_breadcrumb_author_archive'        => esc_html__( 'Text for "Author"', 'pennews' ),
	'penci_breadcrumb_day_archive'           => esc_html__( 'Text for "Day Archives:"', 'pennews' ),
	'penci_breadcrumb_monthly_archives'      => esc_html__( 'Text for "Monthly Archives:"', 'pennews' ),
	'penci_breadcrumb_yearly_archives'       => esc_html__( 'Text for "Yearly Archives:"', 'pennews' ),
	'penci_breadcrumb_archives'              => esc_html__( 'Text for "Archives:"', 'pennews' ),

	// Popuplogin
	'penci_heading_tran_popuplogin'          => esc_html__( 'Popup login', 'pennews' ),
	'penci_plogin_wrong'                     => esc_html__( 'Text for "Wrong username or password"', 'pennews' ),
	'penci_plogin_success'                   => esc_html__( 'Text for "Login successful, redirecting..."', 'pennews' ),
	'penci_plogin_email_place'               => esc_html__( 'Text for "Email Address"', 'pennews' ),
	'penci_plogin_pass_place'                => esc_html__( 'Text for "Password"', 'pennews' ),
	'penci_plogin_label_remember'            => esc_html__( 'Text for "Keep me signed in until I sign out"', 'pennews' ),
	'penci_plogin_label_log_in'              => esc_html__( 'Text for "Login to your account"', 'pennews' ),
	'penci_plogin_label_lostpassword'        => esc_html__( 'Text for "Forgot your password?"', 'pennews' ),
	'penci_plogin_text_has_account'          => esc_html__( 'Text for "Do not have an account ?"', 'pennews' ),
	'penci_plogin_label_registration'        => esc_html__( 'Text for "Register here"', 'pennews' ),

	// Register login
	'penci_heading_tran_registerlogin'       => esc_html__( 'Register login', 'pennews' ),
	'penci_pregister_first_name'             => esc_html__( 'Text for "First Name"', 'pennews' ),
	'penci_pregister_last_name'              => esc_html__( 'Text for "Last Name"', 'pennews' ),
	'penci_pregister_user_name'              => esc_html__( 'Text for "Username"', 'pennews' ),
	'penci_pregister_user_email'             => esc_html__( 'Text for "Email address"', 'pennews' ),
	'penci_pregister_user_pass'              => esc_html__( 'Text for "Password"', 'pennews' ),
	'penci_pregister_pass_confirm'           => esc_html__( 'Text for "Confirm Password"', 'pennews' ),
	'penci_pregister_button_submit'          => esc_html__( 'Text for "Sign up new account"', 'pennews' ),
	'penci_pregister_has_account'            => esc_html__( 'Text for "Have an account?"', 'pennews' ),
	'penci_pregister_label_registration'     => esc_html__( 'Text for "Login here"', 'pennews' ),

	'penci_plogin_mess_invalid_email'    => esc_html__( 'Text: "Invalid email"', 'pennews' ),
	'penci_plogin_mess_error_email_pass' => esc_html__( 'Text: "Password does not match the confirm password"', 'pennews' ),
	'penci_plogin_mess_username_reg'     => esc_html__( 'Text: "This username is already registered"', 'pennews' ),
	'penci_plogin_mess_email_reg'        => esc_html__( 'Text: "This email address is already registered"', 'pennews' ),
	'penci_plogin_mess_wrong_email_pass' => esc_html__( 'Text: "Wrong username or password"', 'pennews' ),
	'penci_plogin_mess_reg_succ'         => esc_html__( 'Text: "Registered successful, redirecting..."', 'pennews' ),

	// Content
	'penci_heading_tran_content'         => esc_html__( 'Content', 'pennews' ),
	'penci_posts_text'                   => esc_html__( 'Text: "Posts"', 'pennews' ),
	'penci_content_not_found_text'       => esc_html__( 'Text: "Not found"', 'pennews' ),
	'penci_content_pre_text'             => esc_html__( 'Text: "previous post"', 'pennews' ),
	'penci_content_next_text'            => esc_html__( 'Text: "next post"', 'pennews' ),
	'penci_content_no_more_post_text'    => esc_html__( 'Text: "Sorry, No more posts"', 'pennews' ),
	'penci_no_results_text'              => esc_html__( 'Text: "No Results"', 'pennews' ),
	'penci_homepage_no_results_text'     => esc_html__( 'Text: "No Results For Home Page"', 'pennews' ),
	'penci_blog_more_text'               => esc_html__( 'Text: "Read more"', 'pennews' ),

	// Archive
	'penci_heading_tran_prefix_ar_title' => esc_html__( 'Archive Prefix Title', 'pennews' ),
	'penci_prefix_ar_title_archive'      => esc_html__( 'Text: "Archives :"', 'pennews' ),
	'penci_prefix_ar_title_cat'          => esc_html__( 'Text: "Category :"', 'pennews' ),
	'penci_prefix_ar_title_tag'          => esc_html__( 'Text: "Tag :"', 'pennews' ),
	'penci_prefix_ar_title_auhor'        => esc_html__( 'Text: "Author :"', 'pennews' ),
	'penci_prefix_ar_title_year'         => esc_html__( 'Text: "Year :"', 'pennews' ),
	'penci_prefix_ar_title_month'        => esc_html__( 'Text: "Month :"', 'pennews' ),
	'penci_prefix_ar_title_day'          => esc_html__( 'Text: "Day :"', 'pennews' ),

	// Social share
	'penci_heading_tran_title_social'    => esc_html__( 'Social share', 'pennews' ),
	'penci-social-share-text'            => esc_html__( 'Text: "Share"', 'pennews' ),




	// Weather
	'penci_heading_tran_weather_heading' => esc_html__( 'Weather', 'pennews' ),
	'penci_weather_mon_text'             => esc_html__( 'Text: "Mon"', 'pennews' ),
	'penci_weather_tue_text'             => esc_html__( 'Text: "Tue"', 'pennews' ),
	'penci_weather_wed_text'             => esc_html__( 'Text: "Wed"', 'pennews' ),
	'penci_weather_thu_text'             => esc_html__( 'Text: "Thu"', 'pennews' ),
	'penci_weather_fri_text'             => esc_html__( 'Text: "Fri"', 'pennews' ),
	'penci_weather_sat_text'             => esc_html__( 'Text: "Sat"', 'pennews' ),
	'penci_weather_sun_text'             => esc_html__( 'Text: "Sun"', 'pennews' ),

	// Footer
	'penci_heading_tran_title_footer'    => esc_html__( 'Footer', 'pennews' ),
	'penci_footer_text_aboutus'          => esc_html__( 'Text: "About US"', 'pennews' ),
	'penci_footer_text_follow_us'        => esc_html__( 'Text: "Follow us"', 'pennews' ),

	// Extra
	'penci_heading_tran_title_extra'     => esc_html__( 'Extra', 'pennews' ),
	'penci_single_tags_text'             => esc_html__( 'Text: "Tags"', 'pennews' ),
	'penci_single_via_text'              => esc_html__( 'Text: "Via"', 'pennews' ),
	'penci_single_source_text'           => esc_html__( 'Text: "Source"', 'pennews' ),
	'penci_get_tran_setting'             => esc_html__( 'Text: "Featured"', 'pennews' ),
	'penci_click_handle_text'            => esc_html__( 'Text: "Load more posts"', 'pennews' ),
	'penci_loadmore__text'               => esc_html__( 'Text: "Load more"', 'pennews' ),
	'penci_linkTitle_text'               => esc_html__( 'Text: "View More"', 'pennews' ),
	'penci_linkTextAll_text'             => esc_html__( 'Text: "Menu"', 'pennews' ),
	'penci_linkText_text'                => esc_html__( 'Text: "More"', 'pennews' ),
	'penci_translation_text_by'          => esc_html__( 'Text: "by"', 'pennews' ),
	'penci_tran_text_viewallp'           => esc_html__( 'Text: "View all posts"', 'pennews' ),
	'penci_login_hello'                  => esc_html__( 'Text: "Hello"', 'pennews' ),
	'penci_text_profile'                 => esc_html__( 'Text: "Profile"', 'pennews' ),
	'penci_text_logout'                  => esc_html__( 'Text: "Logout"', 'pennews' ),
	'penci_pfl_contactus_text'           => esc_html__( 'Text: "Contact us:"', 'pennews' ),
	'penci_mess_whatsapp'                => esc_html__( 'Text: "Sharing on whatsapp will does not work on PC."', 'pennews' ),
	'penci_comment_face_loading'         => esc_html__( 'Text: "Loading....."', 'pennews' ),
	'penci_tran_text_all'                => esc_html__( 'Text: "All"', 'pennews' ),
	'penci_social_fan_text'              => esc_html__( 'Text: "Fans"', 'pennews' ),
	'penci_social_followers_text'        => esc_html__( 'Text: "Followers"', 'pennews' ),
	'penci_social_like_text'             => esc_html__( 'Text: "Like"', 'pennews' ),
	'penci_social_follow_text'           => esc_html__( 'Text: "Follow"', 'pennews' ),
	'penci_social_subscribe_text'        => esc_html__( 'Text: "Subscribe"', 'pennews' ),
	'penci_social_patron_text'           => esc_html__( 'Text: "Become a patron"', 'pennews' ),
	'penci_social_video_text'            => esc_html__( 'Text: "Videos"', 'pennews' ),

);
foreach ( $options_transition as $key => $label ) {

	if ( false === strpos( $key, 'penci_heading_tran' ) ) {

		$type = 'text';
		if ( 'penci_comment_save_field_text' == $key ) {
			$type = 'textarea';
		}

		$wp_customize->add_setting( $key, array(
			'sanitize_callback' => array( $sanitizer, 'html' ),
			'default'           => penci_tran_default_setting( $key ),
		) );
		$wp_customize->add_control( $key, array(
			'label'    => $label,
			'section'  => 'penci_section_transition_text',
			'settings' => $key,
			'type'     => $type,
		) );

		continue;
	}

	$wp_customize->add_setting( $key, array(
		'sanitize_callback' => 'esc_url_raw'
	) );
	$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, $key, array(
		'label'    => $label,
		'section'  => 'penci_section_transition_text',
		'settings' => $key,
		'type'     => 'heading',
	) ) );
}