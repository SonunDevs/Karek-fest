<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'Penci_Shortcode_Managment' ) ):
	class Penci_Shortcode_Managment{
		public function __construct() {
			if( !class_exists( 'Penci_Framework' ) ){
				return;
			}

			add_filter( 'mb_settings_pages', array( $this, 'options_page' ),999 );
			add_filter( 'rwmb_meta_boxes', array( $this,'options_meta_boxes' ) ,999 );
		}
		public function options_page( $settings_pages ) {
			$settings_pages[] = array(
				'id'          => 'pennews_page_shortcode_manage',
				'option_name' => 'theme_mods_' . get_stylesheet(),
				'menu_title'  => esc_html__( 'Shortcode Manage', 'pennews' ),
				'parent'      => 'pennews_dashboard_welcome',
				'columns'       => 1,
			);
			return $settings_pages;
		}

		public function options_meta_boxes( $meta_boxes ) {
			$shortcode_manage = array(
				'about_us'                 => 'about us',
				'ad_box'                   => 'ad box',
				'advanced_carousel'        => 'advanced carousel',
				'authors_box'              => 'authors box',
				'authors_box_2'            => 'authors box 2',
				'block_1'                  => 'block 1',
				'block_10'                 => 'block 10',
				'block_11'                 => 'block 11',
				'block_12'                 => 'block 12',
				'block_13'                 => 'block 13',
				'block_14'                 => 'block 14',
				'block_15'                 => 'block 15',
				'block_16'                 => 'block 16',
				'block_17'                 => 'block 17',
				'block_18'                 => 'block 18',
				'block_19'                 => 'block 19',
				'block_2'                  => 'block 2',
				'block_20'                 => 'block 20',
				'block_21'                 => 'block 21',
				'block_22'                 => 'block 22',
				'block_23'                 => 'block 23',
				'block_24'                 => 'block 24',
				'block_25'                 => 'block 25',
				'block_26'                 => 'block 26',
				'block_27'                 => 'block 27',
				'block_28'                 => 'block 28',
				'block_29'                 => 'block 29',
				'block_3'                  => 'block 3',
				'block_30'                 => 'block 30',
				'block_31'                 => 'block 31',
				'block_32'                 => 'block 32',
				'block_33'                 => 'block 33',
				'block_34'                 => 'block 34',
				'block_35'                 => 'block 35',
				'block_36'                 => 'block 36',
				'block_37'                 => 'block 37',
				'block_38'                 => 'block 38',
				'block_4'                  => 'block 4',
				'block_5'                  => 'block 5',
				'block_6'                  => 'block 6',
				'block_7'                  => 'block 7',
				'block_8'                  => 'block 8',
				'block_9'                  => 'block 9',
				'block_video'              => 'block video',
				'blog_list'                => 'blog list',
				'bos_searchbox'            => 'bos searchbox',
				'count_down'               => 'count down',
				'counter_up'               => 'counter up',
				'facebook_page'            => 'facebook page',
				'fancy_heading'            => 'fancy heading',
				'grid_1'                   => 'big grid 1',
				'grid_10'                  => 'big grid 10',
				'grid_11'                  => 'big grid 11',
				'grid_2'                   => 'big grid 2',
				'grid_3'                   => 'big grid 3',
				'grid_4'                   => 'big grid 4',
				'grid_5'                   => 'big grid 5',
				'grid_6'                   => 'big grid 6',
				'grid_7'                   => 'big grid 7',
				'grid_8'                   => 'big grid 8',
				'grid_9'                   => 'big grid 9',
				'image_box'                => 'image box',
				'image_gallery'            => 'image gallery',
				'info_box'                 => 'info box',
				'instagram'                => 'instagram',
				'latest_tweets'            => 'latest tweets',
				'login_form'               => 'login form',
				'mailchimp'                => 'mailchimp',
				'map'                      => 'google map',
				'news_ticker'              => 'news ticker',
				'opening_hours'            => 'opening hours',
				'pinterest'                => 'pinterest',
				'popular_category'         => 'popular category',
				'pricing_item'             => 'pricing item',
				'progress_bar'             => 'progress bar',
				'recent_review'            => 'recent review',
				'register_form'            => 'register form',
				'single_video'             => 'single video',
				'sliders'                  => 'featured sliders',
				'social_counter'           => 'social counter',
				'social_media'             => 'social media',
				'team_members'             => 'team members',
				'testimonail'              => 'testimonail',
				'testimonails'             => 'testimonails',
				'text_block'               => 'text block',
				'vc_button'                => 'vc button',
				'videos_playlist'          => 'videos playlist',
				'weather'                  => 'weather',
				'wp_widget_archives'       => 'widget archives',
				'wp_widget_calendar'       => 'widget calendar',
				'wp_widget_custommenu'     => 'widget custommenu',
				'wp_widget_posts'          => 'widget posts',
				'wp_widget_recentcomments' => 'widget recentcomments',
				'wp_widget_search'         => 'widget search',
				'wp_widget_tagcolud'       => 'widget tagcolud'
			);

			$meta_boxes[] = array(
				'id'             => 'pennews_shortcode_manage_id',
				'title'          => esc_html__( 'Shortcode Management', 'pennews' ),
				'settings_pages' => 'pennews_page_shortcode_manage',
				'fields'         => array(
					array(
						'type' => 'custom_html',
						'std'  => '<div class="alert alert-warning">Check to disable shortcodes you do not want for use. It will make your site performance better</div>',
					),
					array(
						'name'    => 'Disable shortcode',
						'id'      => 'pennews_shortcode_manage',
						'type'    => 'checkbox_list',
						'options' => $shortcode_manage,
						'select_all_none' => true,
					)
				),
			);
			return $meta_boxes;
		}
	}

	new Penci_Shortcode_Managment;
endif;

