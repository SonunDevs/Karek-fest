<?php
if ( ! class_exists( 'Penci_Facebook_Comments' ) ) {
	class Penci_Facebook_Comments {

		function __construct() {
			add_action( 'wp_ajax_nopriv_penci_multiple_comments', array( __CLASS__, 'get_template' ) );
			add_action( 'wp_ajax_penci_multiple_comments', array( __CLASS__, 'get_template' ) );
			add_action( 'wp_ajax_penci_clear_fbcomments', array( $this, 'penci_clear_fbcomments' ) );
			add_action( 'wp_ajax_penci_clear_fbcomments', array( $this, 'penci_clear_fbcomments' ) );

			add_action( 'wp_head', array( $this, 'wp_head' ) );
			add_action( 'wp_footer', array( $this, 'wp_footer' ) );
		}


		public static function get_comments_number( $post_id = 0 ) {
			$count_comment = 0;
			$post_id       = $post_id ? $post_id : get_the_ID();
			$transient_key = 'penci_facebook_comments_number_' . $post_id;

			$_count = get_transient( $transient_key );
			if ( false === $_count ) {
				$get_request = wp_remote_get( 'https://graph.facebook.com/v2.1/?fields=share{comment_count}&id=' . esc_url( get_permalink( $post_id ) ) );

				if ( ! is_wp_error( $get_request ) ) {

					$response = json_decode( wp_remote_retrieve_body( $get_request ), true );

					if ( ! empty( $response['share']['comment_count'] ) ) {
						$count_comment = $response['share']['comment_count'];
						set_transient( $transient_key, $count_comment, MINUTE_IN_SECONDS * 2 );
						update_post_meta( $post_id, 'penci_facebook_comments_number', $count_comment, true );
					} elseif ( isset( $request['error'] ) ) {
						$count_comment = 0;
						set_transient( $transient_key, $count_comment, MINUTE_IN_SECONDS * 10 );
					}
				}

			} else {

				$post_meta_comments_number = get_post_meta( $post_id, 'penci_facebook_comments_number', true );
				if ( $post_meta_comments_number ) {
					$count_comment = $post_meta_comments_number;
				}
			}

			return $count_comment;
		}

		public static function get_template() {


			$nonce = isset( $_POST['nonce'] ) ? $_POST['nonce'] : '';
			if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
				die ( 'Nope!' );
			}

			$postid = isset( $_POST['postid'] ) ? $_POST['postid'] : '';
			$type   = isset( $_POST['type'] ) ? $_POST['type'] : '';

			ob_start();
			if( 'facebook' == $type ){
				$numposts    = penci_get_theme_mod( 'penci_comment_face_number' );
				$colorscheme = penci_get_theme_mod( 'penci_comment_face_color' );
				$order_by    = penci_get_theme_mod( 'penci_comment_face_ordery' );
				$loading     = penci_get_theme_mod( 'penci_comment_face_loading' );
				?>
				<div id="penci-facebook-comments" class="penci-facebook-comments">
					<div class="fb-comments" data-href="<?php the_permalink( $postid ); ?>"
					     data-numposts="<?php echo( $numposts ? $numposts : 5 ); ?>"
					     data-colorscheme="<?php echo( $colorscheme ? $colorscheme : 'light' ); ?>"
					     data-order-by="<?php echo( $order_by ? $order_by : 'social' ); ?>" data-width="100%"
					     data-mobile="false"><?php echo ( $loading ); ?></div>

					<?php if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { ?>
						<script> FB.XFBML.parse();</script>
					<?php } ?>
				</div>
				<?php
			}

			wp_send_json_success( ob_get_clean() );
		}

		public function wp_footer() {
			if ( penci_get_theme_mod( 'penci_comment_facebook' ) && is_single() ) {

				$AppID = penci_get_theme_mod( 'penci_comment_face_AppID' );
				$AppID = $AppID ? $AppID : '348280475330978';

				$locale = penci_get_theme_mod( 'penci_comment_face_language' );
				$locale = $locale ? $locale : 'en_US';
				?>
				<div id="fb-root"></div>
				<script>
					window.fbAsyncInit = function() {
						FB.init({
							appId            : '<?php echo ( $AppID ); ?>',
							autoLogAppEvents : true,
							xfbml            : true,
							version          : 'v3.0'
						});

						var penciCommentCallback = function ( response ) {
							jQuery.ajax( {
									type: 'GET',
									dataType: 'json',
									url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
									data: {
										action: 'penci_clear_fbcomments',
										post_id: '<?php get_the_ID(); ?>'
									}
								}
							)
						};

						FB.Event.subscribe( 'comment.create', penciCommentCallback );
						FB.Event.subscribe( 'comment.remove', penciCommentCallback );
					};
					(function ( d, s, id ) {
							var js, fjs = d.getElementsByTagName( s )[0];
							if ( d.getElementById( id ) ) {
								return;
							}
							js = d.createElement( s );
							js.id = id;
							js.src = 'https://connect.facebook.net/<?php echo ( $locale ); ?>/sdk.js#xfbml=1&version=v3.0&appId=<?php echo ( $AppID ); ?>&autoLogAppEvents=1';
							fjs.parentNode.insertBefore( js, fjs );

							window.fbAsyncInit = function () {
								FB.init( {
									appId: '<?php echo ( $AppID ); ?>',
									autoLogAppEvents: true,
									xfbml: true,
									version: 'v3.0'
								} );
							};

						}( document, 'script', 'facebook-jssdk' ));
				</script>
				<?php
			}
		}

		public function penci_clear_fbcomments() {
			$post_id = isset( $_POST['postid'] ) ? $_POST['postid'] : '';

			if ( $post_id ) {
				delete_transient( 'penci_facebook_comments_number_' . $post_id );
			}

		}

		public function wp_head() {
			$AppID = penci_get_theme_mod( 'penci_comment_face_AppID' );
			$AppID = $AppID ? $AppID : '348280475330978';
			echo '<meta property="fb:app_id" content="' . $AppID . '">';
		}
	}
}

new Penci_Facebook_Comments;
