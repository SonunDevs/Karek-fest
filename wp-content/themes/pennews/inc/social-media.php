<?php
/**
 * Get list social media
 * @return array
 */
function penci_get_list_social_media() {
	return array(
		'facebook'   => esc_html__( 'Facebook', 'pennews' ),
		'twitter'    => esc_html__( 'Twitter', 'pennews' ),
		'instagram'  => esc_html__( 'Instagram', 'pennews' ),
		'pinterest'  => esc_html__( 'Pinterest', 'pennews' ),
		'google'     => esc_html__( 'Google', 'pennews' ),
		'linkedin'   => esc_html__( 'Linkedin', 'pennews' ),
		'flickr'     => esc_html__( 'Flickr', 'pennews' ),
		'behance'    => esc_html__( 'Behance', 'pennews' ),
		'tumblr'     => esc_html__( 'Tumblr', 'pennews' ),
		'youtube'    => esc_html__( 'Youtube', 'pennews' ),
		'email_me'   => esc_html__( 'Email', 'pennews' ),
		'bloglovin'  => esc_html__( 'Bloglovin', 'pennews' ),
		'vk'         => esc_html__( 'Vk', 'pennews' ),
		'vine'       => esc_html__( 'Vine', 'pennews' ),
		'soundcloud' => esc_html__( 'Soundcloud', 'pennews' ),
		'vimeo'      => esc_html__( 'Vimeo', 'pennews' ),
		'rss'        => esc_html__( 'Rss', 'pennews' ),

		'snapchat'       => esc_html__( 'Snapchat', 'pennews' ),
		'spotify'        => esc_html__( 'Spotify', 'pennews' ),
		'github'         => esc_html__( 'Github', 'pennews' ),
		'stack-overflow' => esc_html__( 'Stack Overflow', 'pennews' ),
		'twitch'         => esc_html__( 'Twitch', 'pennews' ),
		'steam'          => esc_html__( 'Steam', 'pennews' ),
		'xing'           => esc_html__( 'Xing', 'pennews' ),
		'telegram'       => esc_html__( 'Telegram', 'pennews' ),
		'whatsapp'       => esc_html__( 'Whatsapp', 'pennews' ),
		'odnoklassniki'  => esc_html__( 'OK', 'pennews' ),
		'500px'          => esc_html__( '500px', 'pennews' ),
		'line'          => esc_html__( 'Line', 'pennews' ),
		'patreon'       => esc_html__( 'Patreon', 'pennews' ),
	);
}



/**
 * List social media
 *
 * @param bool $show
 *
 * @return string
 */
function penci_list_socail_media( $show = true ) {
	$socials = penci_get_list_social_media();

	$output = '';
	foreach ( $socials as $id => $social ) {
		$url = penci_get_setting( 'penci_' . $id );
		if ( empty( $url ) ) {
			continue;
		}

		$icon = $id;
		if ( 'email_me' == $id ) {
			$icon = 'envelope';
		} elseif ( 'bloglovin' == $id ) {
			$icon = 'heart';
		} elseif ( 'youtube' == $id ) {
			$icon = 'youtube-play';
		} elseif ( 'google' == $id ) {
			$icon = 'google-plus';
		}

		if( 'line' == $id ) {
			$output .= sprintf( '<a class="social-media-item socail_media__%s" target="_blank" href="%s" title="%s"%s><span class="socail-media-item__content"><i class="fa fab fa-line"></i></a>',
				$id, $url,$social, penci_get_rel_noopener() );
		}elseif( 'patreon' == $id ) {
			$output .= sprintf( '<a class="social-media-item socail_media__%s" target="_blank" href="%s" title="%s"%s><span class="socail-media-item__content"><i class="fa fab fa-patreon"></i></a>',
				$id, $url,$social, penci_get_rel_noopener() );
		}else{
			$output .= sprintf( '<a class="social-media-item socail_media__%s" target="_blank" href="%s" title="%s"%s><span class="socail-media-item__content"><i class="fa fa-%s"></i><span class="social_title screen-reader-text">%s</span></span></a>',
				$id, $url,$social, penci_get_rel_noopener(), $icon, $social );
		}
	}

	if ( ! $show ) {
		return $output;
	}

	echo ( $output );

}
