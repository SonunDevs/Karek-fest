<?php
/**
 * Get theme default settings.
 *
 * @param string $name
 *
 * @return mixed
 */
function penci_default_setting( $name ) {

	$color__dark  = '#111111';
	$color__black = '#000000';
	$color__blue  = '#3f51b5';
	$color__white = '#ffffff';

	$font_roboto      = 'Roboto, 100:100italic:300:300italic:regular:italic:500:500italic:700:700italic:900:900italic, sans-serif';
	$font_oswald      = 'Oswald, 200:300:regular:500:600:700, sans-serif';
	$font_teko        = 'Teko, 300:regular:500:600:700, sans-serif';
	$font_mukta_vaani = 'Mukta Vaani, 200:300:400:regular:500:600:700:800, sans-serif';
	$home_url = str_replace( array( 'http://', 'https://' ), '', esc_url( home_url() ) );

	$defaults = array(
		// General
		'penci_font_for_title'           => $font_mukta_vaani,
		'penci_font_block_heading_title' => $font_oswald,
		'penci_font_for_body'            => $font_roboto,

		'penci_font_blocktitle'          => $font_oswald,
		'penci_style_block_title'        => 'style-title-1',
		'penci_align_blocktitle'         => 'style-title-left',
		'penci_map_api_key'              => 'AIzaSyCEZTQfOheut35E8UZBj6Cz1antun6Z-7k',
		'penci_general_pos_ctsidebar_mb' => 'con_sb2_sb1',

		// Topbar
		'penci_topbar_layout'        => 'style-1',
		'penci_topbar_weather_units' => 'metric',
		'penci_topbar_show_socials'  => 1,

		'penci_topbar_show_trending'      => 1,
		'penci_topbar_trending_dis_auto'  => 1,
		'penci_topbar_trending_amount'    => 10,
		'penci_topbar_trending_speed'     => '400',
		'penci_topbar_trending_autotime'  => '4000',
		'penci_topbar_trending_num_words' => '7',
		'penci_topbar_trending_width'     => '500',
		'penci_topbar_trending_text'      => esc_html__( 'Trending now', 'pennews' ),

		'penci_color_body'          => '#666666',
		'penci_block_bgcolor'       => $color__white,
		'penci_color_accent'        => $color__blue,
		'penci_color_heading'       => $color__dark,
		'penci_color_meta'          => '#999999',
		'penci_color_border'        => '#dedede',
		'penci_color_archive_title' => $color__dark,

		// Main header
		'penci_header_layout'         => 'header_s1',
		'penci_header_width'          => 'default',
		'penci_header_img'            => get_template_directory_uri() . '/images/banner.jpg',

		// Logo
		'penci_use_textlogo'             => 1,
		'penci_text_logo'                => esc_html( 'PenNews' ),
		'penci_font_textlogo'            => $font_teko,
		'penci_font_textlogo_on_mobile'  => $font_teko,
		'penci_text_logo_mobile_nav'     => esc_html( 'PenNews' ),
		'penci_font_textlogo_mobile_nav' => $font_teko,
		'penci_font_slogan'        => $font_roboto,

		'penci_font_main_menu_item'       => $font_roboto,
		'penci_font_size_menu_lever1'     => '14',
		'penci_font_size_menu_dropdown'   => '13',
		'penci_font_size_child_cat_mega'  => '13',
		'penci_font_size_ptitle_cat_mega' => '13',
		'penci_font_size__social_icon'    => '16',
		'penci_dropdown_menu_style'       => 'slide_down',
		'penci_mega_child_cat_style'      => 'style-1',


		//Social
		'penci_facebook'                  => '#',
		'penci_twitter'                   => '#',
		'penci_youtube'                   => '#',

		// Page
		'penci_page_sidebar_layout'       => 'sidebar-right',
		'penci_page_template'             => 'style-1',
		'penci_hide_page_socail_share_top' => '1',

		//Archive
		'penci_archive_sidebar_layout'  => 'sidebar-right',
		'penci_archive_layout_style'    => 'blog-default',
		'penci_cat_layout_style'        => 'blog-default',
		'penci_home_layout_style'       => 'blog-default',

		'penci_block_pag_sidebar_layout' => 'sidebar-right',
		'penci_block_pag_layout_style'   => 'blog-default',

		'penci_block_pag_content_limit'     => '25',
		'penci_archive_image_type'          => 'landscape',
		'penci_arch_rmore_font'             => $font_mukta_vaani,
		'penci_block_pag_rmore_font'        => $font_mukta_vaani,

		// Single
		'penci_single_sidebar_layout'        => 'two-sidebar',
		'penci_single_template'              => 'style-1',
		'penci_single_related_text'          => esc_html__( 'Related posts', 'pennews' ),
		'penci_single_related_amount'        => '3',
		'penci_single_related_height_img'    => '151',
		'penci_related_by'                   => 'categories',
		'penci_related_orderby'              => 'rand',
		'penci_single_size_post_title'       => '30',

		'penci_comment_wordpress'    => '1',
		'penci_autoload_prev_number' => '1',

		// Custom sidebar
		'penci_archive_custom_sidebar_left'    => 'sidebar-2',
		'penci_archive_custom_sidebar_right'   => 'sidebar-1',
		'penci_page_custom_sidebar_left'       => 'sidebar-2',
		'penci_page_custom_sidebar_right'      => 'sidebar-1',
		'penci_single_custom_sidebar_left'     => 'sidebar-2',
		'penci_single_custom_sidebar_right'    => 'sidebar-1',
		'penci_block_pag_custom_sidebar_left'  => 'sidebar-2',
		'penci_block_pag_custom_sidebar_right' => 'sidebar-1',

		// Page 404
		'penci_404_heading'         => esc_html__( "404 PAGE NOT FOUND", 'pennews' ),
		'penci_404_sub_heading'     => wp_kses_post( sprintf( 'This page couldn\'t be found! Back to <a href="%s"> home page</a> if you like. Please use search for help!', esc_url( home_url( '/' ) ) ) ),

		// Footer
		'penci_footer_col'                => 'style-4',
		'penci_footer_style'              => 'style-1',
		'penci_fwidget_block_title_style' => 'style-title-1',
		'penci_footer_email'              => 'contact@yoursite.com',
		'penci_footer_copyright'          => sprintf( '@%s - %s. All Right Reserved. Designed and Developed by <a href="%s" target="_blank" rel="nofollow">PenciDesign</a>',
			date( "Y" ), $home_url, esc_url( 'https://themeforest.net/item/pennew-multiconcept-newsmagazine-amp-wordpress-theme/20822517?ref=PenciDesign' ) ),
		'penci_menu_hbg_footer_text'      => sprintf( '@%s - %s. All Right Reserved. Designed and Developed by <a href="%s" target="_blank" rel="nofollow">PenciDesign</a>',
			date( "Y" ), $home_url, esc_url( 'https://themeforest.net/item/pennew-multiconcept-newsmagazine-amp-wordpress-theme/20822517?ref=PenciDesign' ) ),

		'penci_fwidget_align_blocktitle' => 'style-title-left',

		// Login popup
		'penci_plogin_title_login'    => esc_html__( 'Login', 'pennews' ),
		'penci_plogin_title_register' => esc_html__( 'Register', 'pennews' ),

		// Shop
		'penci_woo_post_per_page'           => '24',
		'penci_woo_number_related_products' => '4',
		'penci_woo_paging_align'            => 'center',
		'penci_woo_sidebar_shop'            => 'sidebar-right',
		'penci_woo_sidebar_product'         => 'no-sidebar',
		'penci_bbpress_sidebar'             => 'sidebar-right',
		'penci_buddypress_sidebar'          => 'sidebar-right',

		'penci_portfolio_sidebar'          => 'no-sidebar-1080',
		'penci_pfl_archive_sidebar'        => 'no-sidebar',
		'penci_portfolio_title_color'      => '#ffffff',
		'penci_portfolio_cate_color'       => '#888888',
		'penci_portfolio_title_hcolor'     => '#ffffff',
		'penci_portfolio_cate_hcolor'      => '#adadad',
		'penci_portfolio_overlay_color'    => '#111111',

		// Ajax search
		'penci_enable_ajaxsearch'    => 1,
		'penci_del_pages_fsearch'    => 1,
		'penci_ajaxsearch_amount'    => 4,
		'penci_ajaxsearch_minlength' => 0,

		//In-feed ads option
		'penci_archive_infeedad_order' => 3,

		// Event
		'penci_event_sidebar'        => 'no-sidebar',
		'penci_event_single_sidebar' => 'sidebar-right',

		'penci_hide_block_share_linkedin'    => 1,
		'penci_hide_block_share_tumblr'      => 1,
		'penci_hide_block_share_reddit'      => 1,
		'penci_hide_block_share_stumbleupon' => 1,
		'penci_hide_block_share_whatsapp'    => 1,
		'penci_hide_block_share_telegram'    => 1,
		'penci_hide_block_share_line'        => 1,
		'penci_hide_block_share_viber'       => 1,
		'penci_hide_block_share_digg'        => 1,
		'penci_hide_block_share_vk'          => 1,

		'penci_hide_single_share_stumbleupon' => 1,
		'penci_hide_single_share_whatsapp'    => 1,
		'penci_hide_single_share_line'        => 1,
		'penci_hide_single_share_viber'       => 1,
		'penci_hide_single_share_digg'        => 1,
		'penci_hide_single_share_vk'          => 1,

		'penci_gprd_desc'        => esc_html__( "This website uses cookies to improve your experience. We'll assume you're ok with this, but you can opt-out if you wish.", 'pennews' ),
		'penci_gprd_rmore'       => esc_html__( "Read More", 'pennews' ),
		'penci_gprd_btn_accept'  => esc_html__( "Accept", 'pennews' ),
		'penci_gprd_policy_text' => esc_html__( "Privacy & Cookies Policy", 'pennews' ),
		'penci_gprd_rmore_link'  => '#',

		'penci_menu_hbg_width'  => '340',

	);

	return isset( $defaults[ $name ] ) ? $defaults[ $name ] : '';
}

if( ! function_exists( 'penci_colors_default_setting' ) ) {
	function penci_colors_default_setting( $name ) {

		$color__dark  = '#111111';
		$color__black = '#000000';
		$color__blue  = '#3f51b5';
		$color__white = '#ffffff';

		$defaults = array(
			'pcolor_single_cat_accent'      => $color__white,
			'pcolor_single_cat_accentbg'    => $color__black,
			'pcolor_single_cat_haccent'     => $color__white,
			'pcolor_single_cat_haccentbg'   => $color__blue,

			'pcolor_single_but_share_like_color'        => $color__dark,
			'pcolor_single_but_share_like_bgcolor'      => $color__white,
			'pcolor_single_but_share_face_color'        => $color__white,
			'pcolor_single_but_share_face_bgcolor'      => '#0d47a1',
			'pcolor_single_but_share_twitter_color'     => $color__white,
			'pcolor_single_but_share_twitter_bgcolor'   => '#40c4ff',
			'pcolor_single_but_share_google_color'      => $color__white,
			'pcolor_single_but_share_google_bgcolor'    => '#eb4026',
			'pcolor_single_but_share_pinterest_color'   => $color__white,
			'pcolor_single_but_share_pinterest_bgcolor' => '#C92228',

			'pcolor_single_but_share_linkedin_color'      => $color__white,
			'pcolor_single_but_share_linkedin_bgcolor'    => '#0077B5',
			'pcolor_single_but_share_tumblr_color'        => $color__white,
			'pcolor_single_but_share_tumblr_bgcolor'      => '#34465d',
			'pcolor_single_but_share_reddit_color'        => $color__white,
			'pcolor_single_but_share_reddit_bgcolor'      => '#ff4500',
			'pcolor_single_but_share_stumbleupon_color'   => $color__white,
			'pcolor_single_but_share_stumbleupon_bgcolor' => '#ee4813',
			'pcolor_single_but_share_whatsapp_color'      => $color__white,
			'pcolor_single_but_share_whatsapp_bgcolor'    => '#00c853',
			'pcolor_single_but_share_telegram_color'      => $color__white,
			'pcolor_single_but_share_telegram_bgcolor'    => '#179cde',

			'pcolor_single_but_share_email_color'       => $color__white,
			'pcolor_single_but_share_email_bgcolor'     => '#a7a7a7',
		);

		return isset( $defaults[ $name ] ) ? $defaults[ $name ] : '';
	}
}

/**
 * Get theme settings.
 *
 * @param string $name
 *
 * @return mixed
 */
if ( ! function_exists( 'penci_get_setting' ) ):
	function penci_get_setting( $name , $type = '' ) {

		if( 'color' == $type ){
			$value = penci_get_theme_mod( $name, penci_colors_default_setting( $name ) );
		}else{
			$value = penci_get_theme_mod( $name, penci_default_setting( $name ) );
		}



		return do_shortcode( $value );

	}
endif;
