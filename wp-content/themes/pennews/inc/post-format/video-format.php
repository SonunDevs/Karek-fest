<?php
if ( ! function_exists( 'penci_set_video_featured_image' ) ) {
	function penci_set_video_featured_image( $post_id ) {
		$post_format = get_post_format( $post_id );
		if ( 'video' != $post_format ) {
			return;
		}

		Penci_Video_Format::set_featured_image( $post_id );
	}
}
add_action( 'save_post', 'penci_set_video_featured_image', 12 );

if ( ! class_exists( 'Penci_Video_Format' ) ) {
	class Penci_Video_Format {

		private static $fb_access_token = 'EAAE8wl4DqaIBANhjhZALuSuAzDRmFgcSfRbdp0RMj1rVcCAt6ciwUqlUyWDCteXZAx2Jr0CZBYnCu0OLC87a9lb7Qf5V9XIyDZBbtQAbM7qhYqXCZBRRC2OpCrIyKzczxS7WxUoab6gKsIdFxjSW0ZBbRor9CON25ZB1pg7nW68Unt1NZBZAcbtWbdvhBTmx5dkUmIZCqyoyfC4wZDZD';

		private static $save_post_id;

		public function __construct() {

		}

		static function get_http() {
			if ( is_ssl() ) {
				return 'https';
			}

			return 'http';
		}

		public static function get_class_type_video( $post_id ) {
			$post_format = get_post_format( $post_id );
			if ( 'video' != $post_format ) {
				return '';
			}
			$video      = get_post_meta( $post_id, '_format_video_embed', true );
			$type_video = self::get_type_video( $video );

			echo ' penci-video-format-' . $type_video;
		}


		public static function get_type_video( $video_embed ) {
			if ( ! $video_embed ) {
				return '';
			}

			$video_embed = strtolower( $video_embed );

			if ( false !== strpos( $video_embed, 'facebook.com' ) || false !== strpos( $video_embed, 'fb-root' ) ) {
				return 'facebook';
			}

			if ( false !== strpos( $video_embed, 'vimeo.com' ) ) {
				return 'vimeo';
			}

			if ( false !== strpos( $video_embed, 'youtu.be' ) ||
			     false !== strpos( $video_embed, 'youtube-nocookie.com' ) ||
			     false !== strpos( $video_embed, 'youtube.com' ) ) {
				return 'youtube';
			}

			if ( false !== strpos( $video_embed, 'twitter.com' ) ) {
				return 'twitter';
			}

			if ( false !== strpos( $video_embed, 'dailymotion.com' ) ) {
				return 'dailymotion';
			}

			preg_match( '#^(http|https)://.+\.(mp4|m4v|webm|ogv|wmv|flv)$#i', $video_embed, $matches );
			if ( ! empty( $matches[0] ) ) {
				return 'selfhosted';
			}

			return '';
		}

		public static function show_video_embed( $video_embed, $parallax ) {

			$type_video = self::get_type_video( $video_embed );


			$output = '';
			if ( 'youtube' == $type_video ) {
				$video = penci_pennews_get_youtube_link( $video_embed );

				if ( $parallax ) {
					if ( false !== strpos( $video, 'iframe' ) ) {
						$output .= '<div class="penci-jarallax" data-video-src="' . penci_get_url_video_embed_code( $video ) . '"></div>';
					} else {
						$output .= '<div class="penci-jarallax" data-video-src="' . esc_url( $video ) . '"></div>';
					}
				} else {

					if ( false !== strpos( $video_embed, '<iframe' ) && false !== strpos( $video_embed, 'autoplay=1' ) ) {
						$output .= $video_embed;
					} elseif ( false !== strpos( $video_embed, '?t=' ) ) {
						$embed_current_time = self::get_embed_current_time( $video_embed );

						if( $embed_current_time ){
							$output .= $embed_current_time;
						} else if ( wp_oembed_get( $video_embed ) ) {
							$output .= wp_oembed_get( $video_embed );
						} else {
							$output .= do_shortcode( $video_embed );
						}

					} elseif ( wp_oembed_get( $video_embed ) ) {
						$output .= wp_oembed_get( $video_embed );
					} else {
						$output .= do_shortcode( $video_embed );
					}
				}
			} elseif ( 'vimeo' == $type_video ) {
				if ( $parallax ) {
					if ( false !== strpos( $video_embed, 'iframe' ) ) {
						$output .= $video_embed;
					} else {
						$output .= '<div class="penci-jarallax" data-video-src="' . esc_url( $video_embed ) . '"></div>';
					}
				} else {
					if ( wp_oembed_get( $video_embed ) ) {
						$output .= wp_oembed_get( $video_embed );
					} else {
						$output .= do_shortcode( $video_embed );
					}
				}
			} elseif ( 'facebook' == $type_video ) {

				$facebook_video_id = basename( $video_embed );

				if ( false !== strpos( $facebook_video_id, 'video.php?v=' ) ) {
					$parse_url = parse_url( $video_embed, PHP_URL_QUERY );
					parse_str( $parse_url, $vars );

					if ( isset( $vars['v'] ) ) {
						$facebook_video_id = $vars['v'];
					}
				} elseif ( preg_match( '/data-href=["\']?([^"\'>]+)["\']?/', $video_embed, $matches ) ) {
					if ( isset( $matches['1'] ) ) {
						$facebook_video_id = basename( $matches['1'] );

						if ( false !== strpos( $facebook_video_id, 'video.php?v=' ) ) {
							$parse_url = parse_url( $video_embed, PHP_URL_QUERY );
							parse_str( $parse_url, $vars );

							if ( isset( $vars['v'] ) ) {
								$facebook_video_id = $vars['v'];
							}
						}
					}
				}

				$cache_fb_video = get_transient( $facebook_video_id );

				if ( ! $cache_fb_video ) {
					$params   = array( 'sslverify' => false, 'timeout' => 60 );
					$response = wp_remote_get( 'https://www.facebook.com/plugins/video/oembed.json/?url=' . urlencode( $video_embed ), $params );

					if ( ! is_wp_error( $response ) ) {
						$penci_request_result = wp_remote_retrieve_body( $response );
						$penci_request_result = json_decode( $penci_request_result );

						if ( is_object( $penci_request_result ) and ! empty( $penci_request_result->html ) ) {

							$output .= $penci_request_result->html;

							set_transient( $facebook_video_id, $penci_request_result->html, '10800' );
						}else if ( false !== strpos( $video_embed, 'fb-root' ) || false !== strpos( $video_embed, 'iframe' ) ) {
							$output .= $video_embed;
						}
					}
				} else {
					$output .= $cache_fb_video;
				}

			} elseif ( 'twitter' == $type_video ) {
				$twitter_video_id    = basename( $video_embed );
				$cache_twitter_video = get_transient( $twitter_video_id );

				if ( ! $cache_twitter_video ) {
					$params   = array( 'sslverify' => false, 'timeout' => 60 );
					$response = wp_remote_get( 'https://publish.twitter.com/oembed?url=' . urlencode( $video_embed ) . '&widget_type=video&align=center', $params );

					if ( ! is_wp_error( $response ) ) {
						$twitter_result = wp_remote_retrieve_body( $response );
						$twitter_result = json_decode( $twitter_result );

						if ( is_object( $twitter_result ) and ! empty( $twitter_result->html ) ) {

							$output .= $twitter_result->html;

							set_transient( $twitter_video_id, $twitter_result->html, '10800' );
						}
					}
				} else {
					$output .= $cache_twitter_video;
				}

			} elseif ( 'dailymotion' == $type_video ) {

				$dailymotion_video_id = strtok( basename( $video_embed ), '_' );
				if ( false !== strpos( $dailymotion_video_id, '#video=' ) ) {
					$videoexplode = explode( '#video=', $dailymotion_video_id );
					if ( isset( $videoexplode[1] ) && ! empty( $videoexplode[1] ) ) {
						$dailymotion_video_id = $videoexplode[1];
					}
				}

				$output .= '<iframe frameborder="0" width="100%" height="560" src="' . self::get_http() . '://www.dailymotion.com/embed/video/' . $dailymotion_video_id . '"></iframe>';
			} elseif ( 'selfhosted' == $type_video ) {
				$output .= do_shortcode( '[video src="' . $video_embed . '"]' );
			} else {
				$output .= do_shortcode( $video_embed );
			}

			return $output;
		}

		public static function get_thumb_url( $video_embed, $size = '' ) {
			$type_video = self::get_type_video( $video_embed );
			$src        = '';

			if ( 'youtube' == $type_video ) {
				$video     = penci_pennews_get_youtube_link( $video_embed );
				$urlArr    = explode( "/", $video );
				$urlArrNum = count( (array)$urlArr );

				$youtubeVideoId = isset( $urlArr[ $urlArrNum - 1 ] ) ? $urlArr[ $urlArrNum - 1 ] : '';
				$youtubeVideoId = str_replace( 'watch?v=', '', $youtubeVideoId );


				$maxresdefault = self::get_http() . '://img.youtube.com/vi/' . $youtubeVideoId . '/maxresdefault.jpg';
				$sddefault     = self::get_http() . '://img.youtube.com/vi/' . $youtubeVideoId . '/sddefault.jpg';
				$hqdefault     = self::get_http() . '://img.youtube.com/vi/' . $youtubeVideoId . '/hqdefault.jpg';

				if ( ! self::check_isset_image( $maxresdefault ) ) {
					$src = $maxresdefault;
				} elseif ( ! self::check_isset_image( $sddefault ) ) {
					$src = $sddefault;
				} elseif ( ! self::check_isset_image( $hqdefault ) ) {
					$src = $hqdefault;
				}

			} elseif ( 'vimeo' == $type_video ) {
				$vimeo_video_id = '';
				$video_id       = (int) substr( parse_url( $video_embed, PHP_URL_PATH ), 1 );

				if ( $video_id ) {
					$vimeo_video_id = $video_id;
				} elseif ( preg_match( '%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $video_embed, $regs ) ) {
					$vimeo_video_id = $regs[3];
				}
				if ( $vimeo_video_id && function_exists( 'penci_file_get_contents' ) ) {
					$hash = unserialize( file_get_contents( "http://vimeo.com/api/v2/video/$vimeo_video_id.php" ) );
					$src  = isset( $hash[0]['thumbnail_large'] ) ? $hash[0]['thumbnail_large'] : '';
				}
			} elseif ( 'dailymotion' == $type_video ) {
				$dailymotion_video_id = strtok( basename( $video_embed ), '_' );
				if ( false !== strpos( $dailymotion_video_id, '#video=' ) ) {
					$videoexplode = explode( '#video=', $dailymotion_video_id );
					if ( isset( $videoexplode[1] ) && ! empty( $videoexplode[1] ) ) {
						$dailymotion_video_id = $videoexplode[1];
					}
				}
				$cache_dailymotion_video = get_transient( $dailymotion_video_id );

				if ( ! $cache_dailymotion_video ) {
					$params   = array( 'sslverify' => false, 'timeout' => 60 );
					$response = wp_remote_get( 'https://api.dailymotion.com/video/' . $dailymotion_video_id . '?fields=thumbnail_url', $params );

					if ( ! is_wp_error( $response ) ) {
						$dailymotion_result = wp_remote_retrieve_body( $response );
						$dailymotion_result = json_decode( $dailymotion_result );

						if ( $dailymotion_result and ! empty( $dailymotion_result->thumbnail_url ) ) {

							$src .= $dailymotion_result->thumbnail_url;

							set_transient( $dailymotion_video_id, $dailymotion_result->thumbnail_url, '10800' );
						}
					}
				} else {
					$src .= $cache_dailymotion_video;
				}
			} elseif ( 'facebook' == $type_video ) {
				$facebook_video_id = basename( $video_embed );

				if ( false !== strpos( $facebook_video_id, 'video.php?v=' ) ) {
					$parse_url = parse_url( $video_embed, PHP_URL_QUERY );
					parse_str( $parse_url, $vars );

					if ( isset( $vars['v'] ) ) {
						$facebook_video_id = $vars['v'];
					}
				} elseif ( preg_match( '/data-href=["\']?([^"\'>]+)["\']?/', $video_embed, $matches ) ) {
					if ( isset( $matches['1'] ) ) {
						$facebook_video_id = basename( $matches['1'] );

						if ( false !== strpos( $facebook_video_id, 'video.php?v=' ) ) {
							$parse_url = parse_url( $video_embed, PHP_URL_QUERY );
							parse_str( $parse_url, $vars );

							if ( isset( $vars['v'] ) ) {
								$facebook_video_id = $vars['v'];
							}
						}
					}
				}

				$params   = array( 'sslverify' => false, 'timeout' => 60 );

				$fb__access_token = penci_get_theme_mod( 'penci_fb_access_token' );
				if( ! $fb__access_token )  {
					$fb__access_token = self::$fb_access_token;
				}

				$response = wp_remote_get( 'https://graph.facebook.com/v3.2/' . $facebook_video_id . '/thumbnails?access_token=' . $fb__access_token, $params );

				if ( ! is_wp_error( $response ) ) {

					$penci_request_result = wp_remote_retrieve_body( $response );
					$penci_request_result = json_decode( $penci_request_result );


					$src_face = '';
					if ( isset( $penci_request_result->data ) and ! empty( $penci_request_result->data ) ) {
						foreach ( (array) $penci_request_result->data as $data ) {
							if ( isset( $data->uri ) && $data->uri && isset( $data->is_preferred ) && $data->is_preferred !== false ) {
								$src_face = $data->uri;
							}
						}
					}

					if( ! $src_face ) {
						$src_face = self::get_thumbnail_face_notoken( $facebook_video_id );
					}

					$src .= $src_face;
				}else{
					$src .= self::get_thumbnail_face_notoken( $facebook_video_id );
				}

			} elseif ( 'twitter' == $type_video ) {
				if ( ! class_exists('TwitterApiClient') && defined( 'PENCI_ADDONS_DIR' ) ) {

					require_once PENCI_ADDONS_DIR . 'inc/social-counter/twitter-client.php';
					$Client = new TwitterApiClient;
					$Client->set_oauth (YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, SOME_ACCESS_KEY, SOME_ACCESS_SECRET);
					try {

						$path = 'statuses/show';
						$args = array (
							'id' => basename( $video_embed ),
							'include_entities' => true
						);

						$data = @$Client->call( $path, $args, 'GET' );

						if ($data !== null) {
							if ( isset( $data['entities']['media'][0]['media_url'] ) && ! empty( $data['entities']['media'][0]['media_url'] ) ) {
								$src .= $data['entities']['media'][0]['media_url'] . ':large';
							}
						}
					} catch ( TwitterApiException $Ex ) {

					}
				}
			}

			return $src;
		}

		public static function  get_thumbnail_face_notoken( $face_id ){
			$src = '';

			$face_id = str_replace( '?v=' , '', $face_id );

			$response = wp_remote_get( 'https://graph.facebook.com/' . $face_id . '/picture?width=1920&height=1000&redirect=false' );

			if ( ! is_wp_error( $response ) ) {
				$penci_request_result = wp_remote_retrieve_body( $response );
				$penci_request_result = json_decode( $penci_request_result );

				if ( isset( $penci_request_result->data ) and ! empty( $penci_request_result->data ) ) {

					$data = (array)$penci_request_result->data;
					if ( isset( $data['url'] ) && $data['url'] ) {
						$src = $data['url'];
					}
				}
			}
			return $src;
		}

		public static function set_featured_image( $post_id ) {

			if ( wp_is_post_revision( $post_id ) || ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) ) {
				return;
			}
			self::$save_post_id = $post_id;

			$video_embed    = get_post_meta( $post_id, '_format_video_embed', true );
			$featured_image = self::get_thumb_url( $video_embed );

			if ( ! $featured_image ) {
				return;
			}

			$_thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );

			if ( $_thumbnail_id || ! function_exists( 'media_sideload_image' ) ) {
				return;
			}

			add_action( 'add_attachment', array( __CLASS__, 'update_featured_image' ) );
			media_sideload_image( $featured_image, $post_id, $post_id );
			remove_action( 'add_attachment', array( __CLASS__, 'update_featured_image' ) );
		}

		public static function update_featured_image( $att_id ) {
			update_post_meta( self::$save_post_id, '_thumbnail_id', $att_id );
			update_post_meta( self::$save_post_id, '_video_thumb_id', 1 );
		}

		public static function check_isset_image( $link ) {
			$headers = @get_headers( $link );
			$status  = false;

			if ( isset( $headers[0] ) && ! empty( $headers[0] ) && false !== strpos( $headers[0], '404' ) ) {
				$status = true;
			}

			return $status;
		}

		public static function get_embed_current_time( $video_embed ) {
			$time = $video_id = '';

			$parse_video_embed = parse_url( $video_embed );
			if ( isset( $parse_video_embed['query'] ) ) {
				parse_str( $parse_video_embed['query'], $video_param );

				if ( isset( $video_param['t'] ) && $video_param['t'] ) {
					$time = $video_param['t'];
				}
			}

			if ( preg_match( '/youtube\.com\/watch\?v=([^\&\?\/]+)/', $video_embed, $id ) ) {
				$video_id = $id[1];
			} else if ( preg_match( '/youtube\.com\/embed\/([^"]+)\?/', $video_embed, $id ) ) {
				$video_id = $id[1];
			} else if ( preg_match( '/youtube\.com\/embed\/([^"]+)"/', $video_embed, $id ) ) {
				$video_id = $id[1];
			} else if ( preg_match( '/youtube\.com\/v\/([^\&\?\/]+)/', $video_embed, $id ) ) {
				$video_id = $id[1];
			} else if ( preg_match( '/youtu\.be\/([^\&\?\/]+)/', $video_embed, $id ) ) {
				$video_id = $id[1];
			} else if ( preg_match( '/youtube\.com\/verify_age\?next_url=\/watch%3Fv%3D([^\&\?\/]+)/', $video_embed, $id ) ) {
				$video_id = $id[1];
			} elseif ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_embed, $id ) ) {
				$video_id = $id[1];
			}

			if ( $video_id && $time ) {
				return '<iframe width="720" height="405" src="https://www.youtube.com/embed/' . $video_id . '?start=' . $time . '&amp;feature=oembed" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>';
			}

			return '';
		}
	}
}

