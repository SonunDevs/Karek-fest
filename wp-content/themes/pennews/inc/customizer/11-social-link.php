<?php
$wp_customize->add_section( 'social_media', array(
	'title'       => esc_html__( 'Social Media Options', 'pennews' ),
	'description' => esc_html__( 'Enter full your social link ( include http:// or https:// on your link ), Icons will not show if left blank.', 'pennews' ),
	'priority'    => 10,
) );

$list_socails  = penci_get_list_social_media();

foreach( $list_socails as $id => $list_socail ) {

	$desc = '';
	if( 'email_me' == $id ) {
		$desc = esc_html__( 'If you want to click email icon to link to your mail, please fill: mailto:yourmail@hostmail. Change yourmail@hostmail.com to your mail. You also can fill your contact link page here', 'pennews' );
	}

	$default = '';

	if( in_array( $id, array( 'facebook', 'twitter', 'youtube' ) ) ) {
		$default = '#';
	}

	$id = 'penci_' . $id;
	$wp_customize->add_setting( $id, array(
		'sanitize_callback' => array( $sanitizer, 'text' ),
		'default'           => $default
	) );

	$wp_customize->add_control( $id, array(
		'label'    => $list_socail,
		'section'  => 'social_media',
		'settings' => $id,
		'description' => $desc
	) );
}
