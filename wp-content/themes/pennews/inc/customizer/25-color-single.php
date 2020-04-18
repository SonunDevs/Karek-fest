<?php
$section_color_sidebar = 'penci_section_color_single';

$wp_customize->add_section( $section_color_sidebar, array(
	'title'    => esc_html__( 'Color for Single', 'pennews' ),
	'priority' => 13,
) );

$options_color_sidebar = array(
	'pcolor_single_title'           => esc_html__( 'Single Title Color', 'pennews' ),
	'pcolor_single_accent'          => esc_html__( 'Accent Color', 'pennews' ),
	'pcolor_single_links'           => esc_html__( 'Color for Links', 'pennews' ),
	'pcolor_single_gdpr_fsize'      => esc_html__( 'Color GDPR Message on Comment Form', 'pennews' ),

	'pcolor_single_heading_cat'     => esc_html__( 'Single Categories Accent Colors', 'pennews' ),
	'pcolor_single_cat_accent'      => esc_html__( 'Single Categories Accent Color', 'pennews' ),
	'pcolor_single_cat_accentbg'    => esc_html__( 'Single Categories Accent Background Color', 'pennews' ),
	'pcolor_single_cat_haccent'     => esc_html__( 'Single Categories Accent Hover Color', 'pennews' ),
	'pcolor_single_cat_haccentbg'   => esc_html__( 'Single Categories Accent Hover Background Color', 'pennews' ),


	'pcolor_single_heading_pmeta' => esc_html__( 'Single Post Meta Colors', 'pennews' ),
	'pcolor_single_post_meta'     => esc_html__( 'Single Post Meta Color', 'pennews' ),
	'pcolor_single_post_metah'    => esc_html__( 'Single Post Meta Hover Color', 'pennews' ),

	'pcolor_single_heading_tag'      => esc_html__( 'Tags, Via, source Colors', 'pennews' ),
	'pcolor_single_taglabel_color'   => esc_html__( 'Label Text Color', 'pennews' ),
	'pcolor_single_taglabel_bgcolor' => esc_html__( 'Label Background Color', 'pennews' ),
	'pcolor_single_taglink_color'    => esc_html__( 'Link Color', 'pennews' ),
	'pcolor_single_taglink_bgcolor'  => esc_html__( 'Link Background Color', 'pennews' ),
	'pcolor_single_taglink_hcolor'   => esc_html__( 'Link Hover Color', 'pennews' ),
	'pcolor_single_taglink_hbgcolor' => esc_html__( 'Link Hover Background Color', 'pennews' ),

	'pcolor_single_heading_socail_share'          => esc_html__( 'Box Social Share Colors', 'pennews' ),
	'pcolor_single_border_boxshare'               => esc_html__( 'Border Color Box Social Share', 'pennews' ),
	'pcolor_single_title_boxshare'                => esc_html__( 'Title Share Color of Box Social Share', 'pennews' ),
	'pcolor_single_but_share_like_color'          => esc_html__( 'Button Like Text Color', 'pennews' ),
	'pcolor_single_but_share_like_bgcolor'        => esc_html__( 'Button Like Background Color', 'pennews' ),
	'pcolor_single_but_share_face_color'          => esc_html__( 'Button Facebook Text Color', 'pennews' ),
	'pcolor_single_but_share_face_bgcolor'        => esc_html__( 'Button Facebook Background Color', 'pennews' ),
	'pcolor_single_but_share_twitter_color'       => esc_html__( 'Button Twitter Text Color', 'pennews' ),
	'pcolor_single_but_share_twitter_bgcolor'     => esc_html__( 'Button Twitter Background Color', 'pennews' ),
	'pcolor_single_but_share_google_color'        => esc_html__( 'Button Google Text Color', 'pennews' ),
	'pcolor_single_but_share_google_bgcolor'      => esc_html__( 'Button Google Background Color', 'pennews' ),
	'pcolor_single_but_share_pinterest_color'     => esc_html__( 'Button Pinterest Text Color', 'pennews' ),
	'pcolor_single_but_share_pinterest_bgcolor'   => esc_html__( 'Button Pinterest Background Color', 'pennews' ),
	'pcolor_single_but_share_linkedin_color'      => esc_html__( 'Button Linkedin Text Color', 'pennews' ),
	'pcolor_single_but_share_linkedin_bgcolor'    => esc_html__( 'Button Linkedin Background Color', 'pennews' ),
	'pcolor_single_but_share_tumblr_color'        => esc_html__( 'Button Tumblr Text Color', 'pennews' ),
	'pcolor_single_but_share_tumblr_bgcolor'      => esc_html__( 'Button Tumblr Background Color', 'pennews' ),
	'pcolor_single_but_share_reddit_color'        => esc_html__( 'Button Reddit Text Color', 'pennews' ),
	'pcolor_single_but_share_reddit_bgcolor'      => esc_html__( 'Button Reddit Background Color', 'pennews' ),
	'pcolor_single_but_share_stumbleupon_color'   => esc_html__( 'Button Stumbleupon Text Color', 'pennews' ),
	'pcolor_single_but_share_stumbleupon_bgcolor' => esc_html__( 'Button Stumbleupon Background Color', 'pennews' ),
	'pcolor_single_but_share_whatsapp_color'      => esc_html__( 'Button Whatsapp Text Color', 'pennews' ),
	'pcolor_single_but_share_whatsapp_bgcolor'    => esc_html__( 'Button Whatsapp Background Color', 'pennews' ),
	'pcolor_single_but_share_telegram_color'      => esc_html__( 'Button Telegram Text Color', 'pennews' ),
	'pcolor_single_but_share_telegram_bgcolor'    => esc_html__( 'Button Telegram Background Color', 'pennews' ),
	'pcolor_single_but_share_email_color'         => esc_html__( 'Button Email Text Color', 'pennews' ),
	'pcolor_single_but_share_email_bgcolor'       => esc_html__( 'Button Email Background Color', 'pennews' ),
	'pcolor_single_but_share_digg_color'          => esc_html__( 'Button Digg Text Color', 'pennews' ),
	'pcolor_single_but_share_digg_bgcolor'        => esc_html__( 'Button Digg Background Color', 'pennews' ),
	'pcolor_single_but_share_vk_color'            => esc_html__( 'Button Vk Text Color', 'pennews' ),
	'pcolor_single_but_share_vk_bgcolor'          => esc_html__( 'Button Vk Background Color', 'pennews' ),
	'pcolor_single_but_share_line_bgcolor'        => esc_html__( 'Button Line Background Color', 'pennews' ),
	'pcolor_single_but_share_viber_color'         => esc_html__( 'Button Viber Text Color', 'pennews' ),
	'pcolor_single_but_share_viber_bgcolor'       => esc_html__( 'Button Viber Background Color', 'pennews' ),

	'pcolor_single_heading_blockquote' => esc_html__( 'Blockquote Colors', 'pennews' ),
	'pcolor_single_blockquote_text'    => esc_html__( 'Blockquote Text Colors', 'pennews' ),
	'pcolor_single_blockquote_border'  => esc_html__( 'Blockquote Border Colors', 'pennews' ),

	'pcolor_single_heading_pag'     => esc_html__( 'Previous Post / Next Post Colors', 'pennews' ),
	'pcolor_single_title_boxpag'    => esc_html__( 'Text "Previous Post / Next Post" Colors', 'pennews' ),
	'pcolor_single_pag_post_title'  => esc_html__( 'Previous Post / Next Post Title Colors', 'pennews' ),
	'pcolor_single_pag_post_titleh' => esc_html__( 'Previous Post / Next Post Title Hover Colors', 'pennews' ),

	'pcolor_single_heading_authorbox'    => esc_html__( 'Author box Colors', 'pennews' ),
	'pcolor_single_title_author'         => esc_html__( 'Name Author Color', 'pennews' ),
	'pcolor_single_title_hover_author'   => esc_html__( 'Name Author Hover Color', 'pennews' ),
	'pcolor_single_author_contact'       => esc_html__( 'Icon Contact Info Color', 'pennews' ),
	'pcolor_single_author_hover_contact' => esc_html__( 'Icon Contact Info Hover Color', 'pennews' ),

	'pcolor_single_heading_related_post' => esc_html__( 'Related Posts Colors', 'pennews' ),
	'pcolor_single_related_post_title'   => esc_html__( 'Post Title Color', 'pennews' ),
	'pcolor_single_related_post_titleh'  => esc_html__( 'Post Title Hover Color', 'pennews' ),

);

foreach ( $options_color_sidebar as $key => $label ) {

	if ( false !== strpos( $key, 'pcolor_single_heading' ) ) {

		$wp_customize->add_setting( $key, array(
			'sanitize_callback' => 'esc_url_raw'
		) );
		$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, $key, array(
			'label'    => $label,
			'section'  => $section_color_sidebar,
			'settings' => $key,
			'type'     => 'heading',
		) ) );

		continue;
	}

	$wp_customize->add_setting( $key, array(
		'default'           => penci_colors_default_setting( $key ),
		'sanitize_callback' => array( $sanitizer, 'hex_color' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
		'label'       => $label,
		'section'     => $section_color_sidebar,
		'settings'    => $key,
		'description' => ''
	) ) );
}