<?php
/**
 * Get theme transition text default settings.
 *
 * @param string $name
 *
 * @return mixed
 */
function penci_tran_default_setting( $name ) {
	$defaults = array(
		// Transition Topbar

		'penci_topbar_logout'                    => esc_html__( 'Logout', 'pennews' ),
		'penci_topbar_signin'                    => esc_html__( 'Sign in / Join', 'pennews' ),

        // Transition comment
		'penci_comment_text'                     => esc_html__( 'Comments', 'pennews' ),
		'penci_fbcomment_text'                   => esc_html__( 'Facebook comments', 'pennews' ),
		'penci_comment_zero'                     => esc_html__( '0 comment', 'pennews' ),
		'penci_comment_one'                      => esc_html__( '1 comment', 'pennews' ),
		'penci_comment_more'                     => esc_html__( 'comments', 'pennews' ),
		'penci_comment_clickto'                  => esc_html__( 'Click to comment', 'pennews' ),
		'penci_comment_author_placeholder'       => esc_html__( 'Name*', 'pennews' ),
		'penci_comment_author_email_placeholder' => esc_html__( 'Email*', 'pennews' ),
		'penci_comment_author_url_placeholder'   => esc_html__( 'Website', 'pennews' ),
		'penci_comment_field_placeholder'        => esc_html__( 'Your Comment', 'pennews' ),
		'penci_comment_title_reply'              => esc_html__( 'Leave a Comment', 'pennews' ),
		'penci_comment_title_reply_to'           => esc_html__( 'Leave a Reply to', 'pennews' ),
		'penci_comment_cancel_reply_link'        => esc_html__( 'Cancel Reply', 'pennews' ),
		'penci_comment_label_submit'             => esc_html__( 'Submit', 'pennews' ),
		'penci_comment_awaiting_approval'        => esc_html__( 'Your comment awaiting approval', 'pennews' ),
		'penci_comment_reply_text'               => esc_html__( 'Reply', 'pennews' ),
		'penci_comment_edit_comment'             => esc_html__( 'Edit', 'pennews' ),
		'penci_comment_close'                    => esc_html__( 'Comments are closed.', 'pennews' ),
		'penci_comment_save_field_text'          => esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'pennews' ),

		// Transition review
		'penci_reviewct_text'                    => esc_html__( 'Review', 'pennews' ),
		'penci_rv_form_title_text'               => esc_html__( 'Leave a review', 'pennews' ),
		'penci_rv_textarea_title_text'           => esc_html__( 'Your Review', 'pennews' ),
		'penci_review_zero'                      => esc_html__( '0 review', 'pennews' ),
		'penci_review_one'                       => esc_html__( '1 review', 'pennews' ),
		'penci_review_more'                      => esc_html__( 'reviews', 'pennews' ),
		'penci_review_duplicate'                 => esc_html__('Duplicate review detected; it looks as though you&#8217;ve already review that!','pennews'),

		'penci_search_title'                     => esc_html__( 'Search Results for:', 'pennews' ),
		'penci_search_enter_keyword'              => esc_html__( 'Enter keyword...', 'pennews' ),
		'penci_ajaxsearch_viewmore_text'         => esc_html__( 'View More Search Results', 'pennews' ),
		'penci_ajaxsearch_no_post'               => esc_html__( 'No Post Found!', 'pennews' ),
		'penci_breadcrumb_home_label'            => esc_html__( 'Home', 'pennews' ),
		'penci_breadcrumb_page_404'              => esc_html__( 'Not Found', 'pennews' ),
		'penci_breadcrumb_author_archive'        => esc_html__( 'Author', 'pennews' ),
		'penci_breadcrumb_day_archive'           => esc_html__( 'Day Archives:', 'pennews' ),
		'penci_breadcrumb_monthly_archives'      => esc_html__( 'Monthly Archives:', 'pennews' ),
		'penci_breadcrumb_yearly_archives'       => esc_html__( 'Yearly Archives:', 'pennews' ),
		'penci_breadcrumb_archives'              => esc_html__( 'Archives:', 'pennews' ),
		'penci_plogin_wrong'                     => esc_html__( 'Wrong username or password', 'pennews' ),
		'penci_plogin_success'                   => esc_html__( 'Login successful, redirecting...', 'pennews' ),
		'penci_plogin_email_place'               => esc_html__( 'Email Address', 'pennews' ),
		'penci_plogin_pass_place'                => esc_html__( 'Password', 'pennews' ),
		'penci_plogin_label_remember'            => esc_html__( 'Keep me signed in until I sign out', 'pennews' ),
		'penci_plogin_label_log_in'              => esc_html__( 'Login to your account', 'pennews' ),
		'penci_plogin_label_lostpassword'        => esc_html__( 'Forgot your password?', 'pennews' ),
		'penci_plogin_text_has_account'          => esc_html__( 'Do not have an account ?', 'pennews' ),
		'penci_plogin_label_registration'        => esc_html__( 'Register here', 'pennews' ),

		'penci_pregister_first_name'             => esc_html__( 'First Name', 'pennews' ),
		'penci_pregister_last_name'              => esc_html__( 'Last Name', 'pennews' ),
		'penci_pregister_user_name'              => esc_html__( 'Username', 'pennews' ),
		'penci_pregister_user_email'             => esc_html__( 'Email address', 'pennews' ),
		'penci_pregister_user_pass'              => esc_html__( 'Password', 'pennews' ),
		'penci_pregister_pass_confirm'           => esc_html__( 'Confirm Password', 'pennews' ),
		'penci_pregister_button_submit'          => esc_html__( 'Sign up new account', 'pennews' ),
		'penci_pregister_has_account'            => esc_html__( 'Have an account?', 'pennews' ),
		'penci_pregister_label_registration'     => esc_html__( 'Login here', 'pennews' ),

		'penci_plogin_mess_invalid_email'        => esc_html__( 'Invalid email.', 'pennews' ),
		'penci_plogin_mess_error_email_pass'     => esc_html__( 'Password does not match the confirm password', 'pennews' ),
		'penci_plogin_mess_username_reg'         => esc_html__( 'This username is already registered.', 'pennews' ),
		'penci_plogin_mess_email_reg'            => esc_html__( 'This email address is already registered.', 'pennews' ),
		'penci_plogin_mess_wrong_email_pass'     => esc_html__( 'Wrong username or password.', 'pennews' ),
		'penci_plogin_mess_reg_succ'             => esc_html__( 'Registered successful, redirecting...', 'pennews' ),

		'penci_posts_text'                       => esc_html__( 'Posts', 'pennews' ),
		'penci_content_not_found_text'           => esc_html__( 'Not found', 'pennews' ),
		'penci_content_pre_text'                 => esc_html__( 'previous post', 'pennews' ),
		'penci_content_next_text'                => esc_html__( 'next post', 'pennews' ),
		'penci_content_no_more_post_text'        => esc_html__( 'Sorry, No more posts', 'pennews' ),
		'penci_no_results_text'                  => esc_html__( 'Sorry, we can&rsquo;t find what you&rsquo;re looking for. Please try search.', 'pennews' ),
		'penci_homepage_no_results_text'         => sprintf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'pennews' ), esc_url( admin_url( 'post-new.php' ) ) ),
		'penci_blog_more_text'                   => esc_html__( 'Read more', 'pennews' ),
		'penci-social-share-text'                => esc_html__( 'Share', 'pennews' ),

		'penci_single_tags_text'   => esc_html__( 'Tags', 'snorlax' ),
		'penci_single_via_text'    => esc_html__( 'Via', 'snorlax' ),
		'penci_single_source_text' => esc_html__( 'Source', 'snorlax' ),

		'penci_prefix_ar_title_archive' => esc_html__( 'Archives :', 'pennews' ),
		'penci_prefix_ar_title_cat'     => esc_html__( 'Category :', 'pennews' ),
		'penci_prefix_ar_title_tag'     => esc_html__( 'Tag :', 'pennews' ),
		'penci_prefix_ar_title_auhor'   => esc_html__( 'Author :', 'pennews' ),
		'penci_prefix_ar_title_year'    => esc_html__( 'Year :', 'pennews' ),
		'penci_prefix_ar_title_month'   => esc_html__( 'Month :', 'pennews' ),
		'penci_prefix_ar_title_day'     => esc_html__( 'Day :', 'pennews' ),

		'penci_footer_text_aboutus'              => esc_html__( "About US", 'pennews' ),
		'penci_footer_text_follow_us'            => esc_html__( "Follow us", 'pennews' ),
		'penci_click_handle_text'                => esc_html__( 'Load more posts', 'pennews' ),
		'penci_loadmore__text'                   => esc_html__( 'Load more', 'pennews' ),
		'penci_linkTitle_text'                   => esc_html__( 'View More', 'pennews' ),
		'penci_linkTextAll_text'                 => esc_html__( 'Menu', 'pennews' ),
		'penci_linkText_text'                    => esc_html__( 'More', 'pennews' ),
		'penci_translation_text_by'              => esc_html__( 'by', 'pennews' ),
		'penci_tran_text_viewallp'               => esc_html__( 'View all posts', 'pennews' ),
		'penci_login_hello'                      => esc_html__( 'Hello', 'pennews' ),
		'penci_text_profile'                     => esc_html__( 'Profile', 'pennews' ),
		'penci_text_logout'                      => esc_html__( 'Logout', 'pennews' ),
		'penci_mess_whatsapp'                    => esc_html__( 'Sharing on whatsapp will does not work on PC.', 'pennews' ),
		'penci_tran_text_all'                    => esc_html__( 'All', 'pennews' ),

		'penci_portfolio_related_text' => esc_html__( 'Related Projects', 'pennews' ),
		'penci_pfl_prev_text'          => esc_html__( 'Previous project', 'pennews' ),
		'penci_pfl_next_text'          => esc_html__( 'Next project', 'pennews' ),
		'penci_pfl_contactus_text'     => esc_html__( 'Contact us:', 'pennews' ),
		'penci_comment_face_loading'   => esc_html__( 'Loading....', 'pennews' ),

		'penci_weather_sun_text' => esc_html__( 'Sun', 'pennews' ),
		'penci_weather_mon_text' => esc_html__( 'Mon', 'pennews' ),
		'penci_weather_tue_text' => esc_html__( 'Tue', 'pennews' ),
		'penci_weather_wed_text' => esc_html__( 'Wed', 'pennews' ),
		'penci_weather_thu_text' => esc_html__( 'Thu', 'pennews' ),
		'penci_weather_fri_text' => esc_html__( 'Fri', 'pennews' ),
		'penci_weather_sat_text' => esc_html__( 'Sat', 'pennews' ),

		'penci_social_fan_text'       => esc_html__( 'Fans', 'pennews' ),
		'penci_social_followers_text' => esc_html__( 'Followers', 'pennews' ),
		'penci_social_like_text'      => esc_html__( 'Like', 'pennews' ),
		'penci_social_follow_text'    => esc_html__( 'Follow', 'pennews' ),
		'penci_social_subscribe_text' => esc_html__( 'Subscribe', 'pennews' ),
		'penci_social_patron_text'    => esc_html__( 'Become a patron', 'pennews' ),
		'penci_get_tran_setting'    => esc_html__( 'Featured', 'pennews' ),
		'penci_social_video_text'     => esc_html__( 'Videos', 'pennews' ),
	);


	return isset( $defaults[ $name ] ) ? $defaults[ $name ] : '';
}

/**
 * Get theme settings.
 *
 * @param string $name
 *
 * @return mixed
 */
if ( ! function_exists( 'penci_get_tran_setting' ) ):
	function penci_get_tran_setting( $name ) {
		$value = penci_get_theme_mod( $name, penci_tran_default_setting( $name ) );

		return do_shortcode( $value );
	}
endif;