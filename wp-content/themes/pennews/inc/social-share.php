<?php

if ( !class_exists( 'Penci_Social_Share' ) ):
	class Penci_Social_Share {
		/**
		 * @param $list_social array( 'total_share','facebook','twitter','google_plus','pinterest','linkedin','tumblr','reddit' ,'stumbleupon','email'  )
		 * @param bool $echo
		 *
		 * @return string
		 */
		public static function get_social_share( $list_social, $echo = true, $show_count = true ) {
			$output      = '';
			$total_share = 0;

			$icon_line_svg = '<svg aria-hidden="true" data-prefix="fab" data-icon="line" class="svg-inline--fa fa-line fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M272.1 204.2v71.1c0 1.8-1.4 3.2-3.2 3.2h-11.4c-1.1 0-2.1-.6-2.6-1.3l-32.6-44v42.2c0 1.8-1.4 3.2-3.2 3.2h-11.4c-1.8 0-3.2-1.4-3.2-3.2v-71.1c0-1.8 1.4-3.2 3.2-3.2H219c1 0 2.1.5 2.6 1.4l32.6 44v-42.2c0-1.8 1.4-3.2 3.2-3.2h11.4c1.8-.1 3.3 1.4 3.3 3.1zm-82-3.2h-11.4c-1.8 0-3.2 1.4-3.2 3.2v71.1c0 1.8 1.4 3.2 3.2 3.2h11.4c1.8 0 3.2-1.4 3.2-3.2v-71.1c0-1.7-1.4-3.2-3.2-3.2zm-27.5 59.6h-31.1v-56.4c0-1.8-1.4-3.2-3.2-3.2h-11.4c-1.8 0-3.2 1.4-3.2 3.2v71.1c0 .9.3 1.6.9 2.2.6.5 1.3.9 2.2.9h45.7c1.8 0 3.2-1.4 3.2-3.2v-11.4c0-1.7-1.4-3.2-3.1-3.2zM332.1 201h-45.7c-1.7 0-3.2 1.4-3.2 3.2v71.1c0 1.7 1.4 3.2 3.2 3.2h45.7c1.8 0 3.2-1.4 3.2-3.2v-11.4c0-1.8-1.4-3.2-3.2-3.2H301v-12h31.1c1.8 0 3.2-1.4 3.2-3.2V234c0-1.8-1.4-3.2-3.2-3.2H301v-12h31.1c1.8 0 3.2-1.4 3.2-3.2v-11.4c-.1-1.7-1.5-3.2-3.2-3.2zM448 113.7V399c-.1 44.8-36.8 81.1-81.7 81H81c-44.8-.1-81.1-36.9-81-81.7V113c.1-44.8 36.9-81.1 81.7-81H367c44.8.1 81.1 36.8 81 81.7zm-61.6 122.6c0-73-73.2-132.4-163.1-132.4-89.9 0-163.1 59.4-163.1 132.4 0 65.4 58 120.2 136.4 130.6 19.1 4.1 16.9 11.1 12.6 36.8-.7 4.1-3.3 16.1 14.1 8.8 17.4-7.3 93.9-55.3 128.2-94.7 23.6-26 34.9-52.3 34.9-81.5z"></path></svg>';
			$icon_viber_svg = '<svg aria-hidden="true" data-prefix="fab" data-icon="viber" class="svg-inline--fa fa-viber fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M444 49.9C431.3 38.2 379.9.9 265.3.4c0 0-135.1-8.1-200.9 52.3C27.8 89.3 14.9 143 13.5 209.5c-1.4 66.5-3.1 191.1 117 224.9h.1l-.1 51.6s-.8 20.9 13 25.1c16.6 5.2 26.4-10.7 42.3-27.8 8.7-9.4 20.7-23.2 29.8-33.7 82.2 6.9 145.3-8.9 152.5-11.2 16.6-5.4 110.5-17.4 125.7-142 15.8-128.6-7.6-209.8-49.8-246.5zM457.9 287c-12.9 104-89 110.6-103 115.1-6 1.9-61.5 15.7-131.2 11.2 0 0-52 62.7-68.2 79-5.3 5.3-11.1 4.8-11-5.7 0-6.9.4-85.7.4-85.7-.1 0-.1 0 0 0-101.8-28.2-95.8-134.3-94.7-189.8 1.1-55.5 11.6-101 42.6-131.6 55.7-50.5 170.4-43 170.4-43 96.9.4 143.3 29.6 154.1 39.4 35.7 30.6 53.9 103.8 40.6 211.1zm-139-80.8c.4 8.6-12.5 9.2-12.9.6-1.1-22-11.4-32.7-32.6-33.9-8.6-.5-7.8-13.4.7-12.9 27.9 1.5 43.4 17.5 44.8 46.2zm20.3 11.3c1-42.4-25.5-75.6-75.8-79.3-8.5-.6-7.6-13.5.9-12.9 58 4.2 88.9 44.1 87.8 92.5-.1 8.6-13.1 8.2-12.9-.3zm47 13.4c.1 8.6-12.9 8.7-12.9.1-.6-81.5-54.9-125.9-120.8-126.4-8.5-.1-8.5-12.9 0-12.9 73.7.5 133 51.4 133.7 139.2zM374.9 329v.2c-10.8 19-31 40-51.8 33.3l-.2-.3c-21.1-5.9-70.8-31.5-102.2-56.5-16.2-12.8-31-27.9-42.4-42.4-10.3-12.9-20.7-28.2-30.8-46.6-21.3-38.5-26-55.7-26-55.7-6.7-20.8 14.2-41 33.3-51.8h.2c9.2-4.8 18-3.2 23.9 3.9 0 0 12.4 14.8 17.7 22.1 5 6.8 11.7 17.7 15.2 23.8 6.1 10.9 2.3 22-3.7 26.6l-12 9.6c-6.1 4.9-5.3 14-5.3 14s17.8 67.3 84.3 84.3c0 0 9.1.8 14-5.3l9.6-12c4.6-6 15.7-9.8 26.6-3.7 14.7 8.3 33.4 21.2 45.8 32.9 7 5.7 8.6 14.4 3.8 23.6z"></path></svg>';
			$post_id = get_the_ID();
			$expired = get_post_meta( $post_id, 'penci_social_share_interval', true );
			$time_current = time();
			$results = array();
			$update_cache = false;
			if ( $expired < $time_current ) {
				$update_cache = true;
			}
			
			foreach ( ( array ) $list_social as $social ) {

				$link     = get_permalink();
				$text     =  str_replace( '|', '-', get_the_title() );
				$img_link = penci_get_featured_image_size( $post_id, 'post-thumbnail' );

				if( 'total_share' == $social ){
					continue;
				}elseif ( 'email' == $social ) {
					$output .= sprintf(
						'<a class="penci-social-item email" target="_blank"%s href="%s"><i class="fa fa-envelope"></i></a>',
						penci_get_rel_noopener(), self::get_link_share_post( 'email', $link, $text, $img_link = '' )
					);

					continue;
				}elseif ( 'whatsapp' == $social ) {
					$output .= sprintf(
						'<a class="penci-social-item whatsapp"%s data-text="%s" data-link="%s" href="#"><i class="fa fa-whatsapp"></i></a>',
						penci_get_rel_noopener(),
						get_the_title( $post_id ),
						$link
					);

					add_action( 'wp_footer', array( __CLASS__, 'whatsapp_script' ) );
					continue;
				}elseif ( 'line' == $social ) {
					$output .= sprintf(
						'<a class="penci-social-item line" target="_blank"%s href="https://lineit.line.me/share/ui?url=%s&text=%s"><span>%s</span></a>',
						penci_get_rel_noopener(),
						$link,
						get_the_title( $post_id ),
						$icon_line_svg
					);
					continue;
				}

				$link_share  = self::get_link_share_post( $social, $link, $text, $img_link );

				if( 'viber' == $social ) {

					$output .= sprintf(
						'<a class="penci-social-item %s" target="_blank"%s title="%s" href="%s"><span>%s</span></a>',
						esc_attr( $social ),
						penci_get_rel_noopener(),
						penci_get_setting( 'penci_socail_title_' . $social ),
						esc_url( $link_share ),
						$icon_viber_svg
					);

					continue;
				}

				$count_share = 0;
				if( $show_count ){

					if ( ! $update_cache ) {
						$count_shares = get_post_meta( $post_id, 'penci_social_count_shares', true );
						$count_share = isset( $count_shares[ $social ] ) ? intval( $count_shares[ $social ] ) : '';

						if ( empty( $count_share ) && 0 !== $count_share ) {
							$count_share = self::get_social_share_count( $social, $link );
							$results[$social] = $count_share;
						}
					} else {
						$count_share = self::get_social_share_count( $social, $link );
						$results[$social] = $count_share;
					}
				}

				if ( $update_cache && $results ) {
					$cache_time = apply_filters( 'penci_social_share_cachetime', MINUTE_IN_SECONDS * 240, $post_id );
					update_post_meta( $post_id, 'penci_social_share_interval', time() + $cache_time );
					update_post_meta( $post_id, 'penci_social_count_shares', $results );
				}

				$total_share += intval( $count_share );

				$output .= sprintf(
					'<a class="penci-social-item %s" target="_blank"%s title="%s" href="%s"><i class="fa fa-%s"></i>%s</a>',
					esc_attr( $social ),
					penci_get_rel_noopener(),
					penci_get_setting( 'penci_socail_title_' . $social ),
					esc_url( $link_share ),
					'google_plus' == $social ? 'google-plus' : esc_attr( $social ),
					$show_count && $count_share ? '<span class="penci-share-number">' . esc_html( $count_share ) . '</span>' : ''

				);
			}

			if ( in_array( 'total_share', $list_social ) ) {
				$total_share = sprintf( '<span class="share-handler penci-social-item"><i class="fa fa-share-alt"></i><span class="penci-share-number">%s</span></span>', esc_html( $total_share ) );
				$output      = $total_share . $output;
			}

			if ( ! $echo ) {
				return $output;
			}

			echo ( $output );
		}

		public static function get_link_share_post( $social_key, $link, $text = '', $img_link = '' ) {
			$text = str_replace( array( '|', '&', '%', '#038;' ), array( '-', '-', '', '' ), $text );

			switch ( $social_key ) {
				case 'facebook':
					$link = add_query_arg( array( 'u' => rawurlencode( $link ), ), 'https://www.facebook.com/sharer/sharer.php' );
					break;
				case 'twitter':


					$link   = 'https://twitter.com/intent/tweet?text=' .  $text . '%20-%20' .$link;
					break;
				case 'pinterest':
					$link = add_query_arg( array(
						'url'         => rawurlencode( $link ),
						'media'       => rawurlencode( $img_link ),
						'description' => rawurlencode( $text ),
					), esc_url( 'http://pinterest.com/pin/create/button' ) );
					break;

				case 'google_plus':
					$link = add_query_arg( array( 'url' => rawurlencode( $link ), ), 'https://plus.google.com/share' );
					break;

				case 'linkedin':
					$link = add_query_arg( array(
						'url'   => rawurlencode( $link ),
						'title' => rawurlencode( $text ),
					), 'https://www.linkedin.com/shareArticle?mini=true' );
					break;

				case 'tumblr':
					$link = add_query_arg( array(
						'url'  => rawurlencode( $link ),
						'name' => rawurlencode( $text ),
					), 'https://www.tumblr.com/share/link' );
					break;
				case 'reddit':
					$link = add_query_arg( array(
						'url'   => rawurlencode( $link ),
						'title' => rawurlencode( $text ),
					), 'https://reddit.com/submit' );
					break;
				case 'stumbleupon':
					$link = add_query_arg( array(
						'url'   => rawurlencode( $link ),
						'title' => rawurlencode( $text ),
					), 'https://www.stumbleupon.com/submit' );
					break;
				case 'email':
					$link = esc_url ( 'mailto:?subject=' . $text . '&BODY=' . $link );
					break;
				case 'telegram':
					$link = add_query_arg( array(
						'url'  => rawurlencode( $link ),
						'text' => rawurlencode( $text ),
					), 'https://telegram.me/share/url' );
					break;

				case 'whatsapp':
					$link = add_query_arg( array(
						'text' => rawurlencode( $text ) . ' %0A%0A ' . rawurlencode( $link ),
					), 'whatsapp://send' );
					break;

				case 'digg':
					$link = add_query_arg( array(
						'url' => rawurlencode( $link ),
					), 'https://www.digg.com/submit' );
					break;
				case 'vk':
					$link = add_query_arg( array(
						'url' => rawurlencode( $link ),
					), 'https://vkontakte.ru/share.php' );
					break;

				case 'line':
					$link = add_query_arg( array(
						'text' => rawurlencode( $text ) . ' %0A%0A ' . rawurlencode( $link ),
					), 'https://line.me/R/msg/text/' );
					break;
				case 'viber':
					$link = '"https://3p3x.adj.st/?adjust_t=u783g1_kw9yml&adjust_fallback=https%3A%2F%2Fwww.viber.com%2F%3Futm_source%3DPartner%26utm_medium%3DSharebutton%26utm_campaign%3DDefualt&adjust_campaign=Sharebutton&adjust_deeplink=" + encodeURIComponent("viber://forward?text=" + encodeURIComponent(' . $text . ' + " " + ' . $link . '))';
					break;
				default:
					return '';
			}

			return $link;
		}

		/**
		 * Create a new function based on jonathanmoore core - source: https://gist.github.com/jonathanmoore/2640302
		 *
		 * @param $social_key
		 * @param $url
		 *
		 * @return int
		 */
		public static function  get_social_share_count( $social_key, $url ) {
			$count        = 0;

			$is_localhost = self::is_localhost();

			if ( $is_localhost ) {
				return 0;
			}

			$remote_args = array(
				'timeout'   => 18,
				'sslverify' => false,
			);

			switch ( $social_key ) {
				case 'facebook':
					$remote = wp_remote_get( "http://graph.facebook.com/?id=" . urlencode( $url ), $remote_args );

					if ( wp_remote_retrieve_response_code( $remote ) == 403 ) {
						$remote = wp_remote_get( 'https://graph.facebook.com/v2.9/?id=' . urlencode( $url ) . '&fields=engagement&access_token=192953638007115|581ce2ecaaa101d4d67a2718ae3a857a', $remote_args );
					}

					if ( ! is_wp_error( $remote ) ) {
						$response = json_decode( wp_remote_retrieve_body( $remote ), true );

						if( isset( $response['share']['share_count'] ) ){
							$count = $response['share']['share_count'];
						}elseif ( isset( $response['engagement']['share_count'] ) ) {
							$count += $response['engagement']['share_count'];
						}

						if ( isset( $response['engagement']['reaction_count'] ) ) {
							$count += $response['engagement']['reaction_count'];
						}

						if ( isset( $response['engagement']['comment_count'] ) ) {
							$count += $response['engagement']['comment_count'];
						}

						if ( isset( $response['engagement']['comment_plugin_count'] ) ) {
							$count += $response['engagement']['comment_plugin_count'];
						}
					}
					break;
				case 'twitter':
					// Create a new function based on newsharecounts core - source: http://newsharecounts.com/done/
					$remote = wp_remote_get( 'http://public.newsharecounts.com/count.json?url=' . urlencode( $url ), $remote_args );
					if ( ! is_wp_error( $remote ) ) {
						$response = json_decode( wp_remote_retrieve_body( $remote ), true );
						$count    = isset( $response['count'] ) ? $response['count'] : 0;
					}

					break;
				case 'pinterest':

					$remote = wp_remote_get( 'http://api.pinterest.com/v1/urls/count.json?callback=callback&url=' . urlencode( $url ), $remote_args );

					if ( ! is_wp_error( $remote ) ) {

						$pattern = '/^\s*callback\s*\((.+)\)\s*$/';
						$subject = wp_remote_retrieve_body( $remote );

						if ( preg_match( $pattern, $subject, $match ) ) {
							$response = json_decode( $match[1], true );

							if ( isset( $response['count'] ) ) {
								$count = $response['count'];
							}
						}
					}
					break;
				case 'google_plus':

					$remote_args['headers'] = 'Content-type: application/json';
					$remote_args['body']    = '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . rawurldecode( $url ) . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]';

					$remote = wp_remote_post( 'https://clients6.google.com/rpc', $remote_args );

					if ( ! is_wp_error( $remote ) ) {
						$response = json_decode( wp_remote_retrieve_body( $remote ), true );
						$count    = isset( $response[0]['result']['metadata']['globalCounts']['count'] ) ? $response[0]['result']['metadata']['globalCounts']['count'] : 0;
					}
					break;
				case 'linkedin':
					$remote = wp_remote_get( 'https://www.linkedin.com/countserv/count/share?format=json&url=' . rawurldecode( $url ), $remote_args );

					if ( ! is_wp_error( $remote ) ) {
						$response = json_decode( wp_remote_retrieve_body( $remote ), true );
						$count    = isset( $response['count'] ) ? $response['count'] : 0;
					}

					break;
				case 'tumblr':
					$remote = wp_remote_get( 'http://api.tumblr.com/v2/share/stats?url=' . rawurldecode( $url ), $remote_args );

					if ( ! is_wp_error( $remote ) ) {
						$response = json_decode( wp_remote_retrieve_body( $remote ), true );
						$count    = isset( $response['response']['note_count'] ) ? $response['response']['note_count'] : 0;
					}

					break;
				case 'reddit':
					$remote = wp_remote_get( 'http://www.reddit.com/api/info.json?url=' . $url, $remote_args );

					if ( ! is_wp_error( $remote ) ) {
						$response = json_decode( $remote['body'], true );
						$count    = isset( $response['data']['children']['0']['data']['score'] ) ? $response['data']['children']['0']['data']['score'] : 0;
					}

					break;
				case 'stumbleupon':
					$remote = wp_remote_get( 'http://www.stumbleupon.com/services/1.01/badge.getinfo?url=' . $url, $remote_args );

					if ( ! is_wp_error( $remote ) ) {
						$response = json_decode( $remote['body'], true );
						$count    = isset( $response['result']['views'] ) ? $response['result']['views'] : 0;
					}

					break;
			}

			return $count;
		}

		public static function whatsapp_script()  {
			?>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery('.penci-social-item.whatsapp').on("click", function(e) {
						if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
							var article = jQuery(this).attr("data-text");
							var weburl = jQuery(this).attr("data-link");
							var whats_app_message = encodeURIComponent(article)+" - "+encodeURIComponent(weburl);
							var whatsapp_url = "whatsapp://send?text="+whats_app_message;
							window.location.href= whatsapp_url;
						}else{
							alert('<?php echo penci_get_tran_setting('penci_mess_whatsapp'); ?>');
						}
					});
				});
			</script>
			<?php
		}

		public static function is_localhost() {
			$whitelist = array( '127.0.0.1', '::1' );

			if ( ! function_exists( 'penci_get_server_value' ) ) {
				return false;
			}
			$REMOTE_ADDR = penci_get_server_value( 'REMOTE_ADDR' );
			if ( in_array( $REMOTE_ADDR, $whitelist ) ) {
				return true;
			}
		}

	}
endif;