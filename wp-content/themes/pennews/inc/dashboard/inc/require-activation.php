<?php
if ( ! function_exists( 'penci_pennews_is_activated' ) ) {
	function penci_pennews_is_activated() {
		if ( defined( 'ENVATO_HOSTED_SITE' ) ) {
			return true;
		}

		return get_option( 'penci_pennews_is_activated' );
	}
}

if ( ! class_exists( 'Penci_Require_Active' ) ) {
	class Penci_Require_Active {
		protected $time_max = 2592000; // 30 days
		protected $theme_info;

		public function __construct() {
			// Not run code require active theme on the admin
			if ( ! is_admin() ) {
				return;
			}

			$this->theme_info = wp_get_theme();
			$this->main();

			add_action( 'wp_ajax_nopriv_penci_check_envato_code', array( $this, 'do_check_envato_code' ) );
			add_action( 'wp_ajax_penci_check_envato_code', array( $this, 'do_check_envato_code' ) );

			add_action( 'admin_enqueue_scripts', array( $this, 'add_admin_scripts' ), 10, 1 );
		}

		public function main() {

			$curent_time             = time();
			$active_status_last_time = get_option( 'pennews_active_status_last_time' );

			add_action( 'admin_menu', array( $this, 'add_submenu_page' ), 15 );

			if ( empty( $active_status_last_time ) ) {
				update_option( 'pennews_active_status_last_time', $curent_time );
			} else {

				if ( penci_pennews_is_activated() ) {
					return;
				}
				add_action( 'admin_notices', array( $this, 'validation_notice' ) );
			}
		}

		public function add_admin_scripts( $hook ) {
			if ( penci_pennews_is_activated() ) {
				return;
			}

			$active_status_last_time = get_option( 'pennews_active_status_last_time' );
			$time_delta              = time() - $active_status_last_time;
			$time_max                = $this->time_max;

			if ( $time_delta < $time_max ) {
				return;
			}

			if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
				wp_enqueue_script( "pennews-editor-script", get_template_directory_uri() . '/inc/dashboard/js/edit-post.js', array( 'jquery' ) );
			}
		}

		function add_submenu_page() {
			if ( penci_pennews_is_activated() ) {
				return;
			}

			add_submenu_page( 'pennews_dashboard_welcome',
				esc_html__( 'Active theme', 'pennews' ),
				esc_html__( 'Active theme', 'pennews' ),
				'manage_options', 'pennews_active_theme',
				array( $this, 'require_active_page' )
			);
		}

		public function get_server_id() {
			ob_start();
			phpinfo( INFO_GENERAL );
			echo( $this->theme_info->name );

			return md5( ob_get_clean() );
		}

		/**
		 * Show notice active theme
		 */
		function validation_notice() {
			$pennews_theme    = wp_get_theme();
			$link_page_active = admin_url( 'admin.php?page=pennews_active_theme' );
			?>
			<div class="notice notice-success is-dismissible">
				<p>
					<a class="penci-notice-logo" href="<?php echo esc_url( 'http://pencidesign.com/' ); ?>" target="_blank"><?php $this->get_icon_penci(); ?></a>
					<?php echo esc_html( sprintf( __( 'Please activate PenNews to use full features of the theme. We\'re sorry about this but we built the activation system to prevent piracy of our themes in the internet, we can do better serve our paying customers.', 'pennews' ), $pennews_theme->name ) ); ?>
				</p>
				<p>
					<strong style="color:red"><?php esc_html_e( 'Please activate the theme!', 'pennews' ); ?></strong> -
					<a href="<?php echo( $link_page_active ); ?>"><?php esc_html_e( 'Click here to enter your code', 'pennews' ); ?></a>
					- <?php _e( 'if you have issues with this please contact us via <a href="http://pencidesign.ticksy.com/" target="_blank">our support forum</a> or <a href="https://themeforest.net/user/pencidesign#contact" target="_blank">our contact form</a>', 'pennews' ); ?> -
					<a href="<?php echo( $link_page_active ); ?>"><?php esc_html_e( 'Active theme page here', 'pennews' ); ?></a></p>
			</div>
			<?php
		}

		/**
		 * Get icon penci
		 */
		function get_icon_penci() {
			?>
			<svg style="position: relative; top:4px;margin-right: 5px;" version="1.0" xmlns="http://www.w3.org/2000/svg"
			     width="18px" height="18px" viewBox="0 0 26.000000 26.000000"
			     preserveAspectRatio="xMidYMid meet">
				<g transform="translate(0.000000,26.000000) scale(0.100000,-0.100000)"
				   fill="#000000" stroke="none">
					<path d="M72 202 l-62 -60 0 -66 0 -66 125 0 125 0 0 61 0 61 -63 65 -62 64
				-63 -59z m73 28 c3 -5 -3 -10 -15 -10 -12 0 -18 5 -15 10 3 6 10 10 15 10 5 0
				12 -4 15 -10z m57 -57 c34 -33 36 -38 20 -49 -14 -10 -21 -8 -45 12 -36 31
				-62 30 -93 -1 -21 -21 -28 -23 -44 -13 -19 12 -18 14 17 50 51 52 92 52 145 1z
				m-77 -93 c0 -59 -1 -60 -27 -60 -26 0 -28 3 -28 42 0 24 7 49 17 60 28 32 38
				21 38 -42z m49 44 c10 -9 16 -33 16 -60 0 -40 -2 -44 -25 -44 -24 0 -25 3 -25
				60 0 62 7 71 34 44z m-130 -20 c9 -8 16 -31 16 -50 0 -27 -4 -34 -20 -34 -17
				0 -20 7 -20 50 0 28 2 50 4 50 3 0 12 -7 20 -16z m201 -34 c0 -44 -3 -50 -20
				-50 -18 0 -20 5 -17 38 4 35 17 62 31 62 3 0 6 -22 6 -50z"/>
					<path d="M90 70 c0 -5 5 -10 10 -10 6 0 10 5 10 10 0 6 -4 10 -10 10 -5 0 -10
				-4 -10 -10z"/>
				</g>
			</svg>
			<?php
		}

		public function require_active_page() {
			$pennews_theme = wp_get_theme();
			?>
			<div class="wrap about-wrap penci-about-wrap penci-active-theme">
				<?php include get_template_directory() . '/inc/dashboard/sections/welcome.php'; ?>
				<h2 class="nav-tab-wrapper">
					<a href="<?php echo admin_url( 'admin.php?page=pennews_dashboard_welcome' ) ?>" class="nav-tab"><?php esc_html_e( 'Getting started', 'pennews' ); ?></a>
					<a href="<?php echo admin_url( 'customize.php' ) ?>" class="nav-tab"><?php esc_html_e( 'Customize Style', 'pennews' ); ?></a>
					<?php if ( ! defined( 'ENVATO_HOSTED_SITE' ) ): ?>
						<a href="<?php echo admin_url( 'admin.php?page=pennews_system_status' ) ?>" class="nav-tab"><?php esc_html_e( 'System status', 'pennews' ); ?></a>
					<?php endif; ?>
					<a href="<?php echo admin_url( 'admin.php?page=pennews_custom_fonts' ) ?>" class="nav-tab"><?php esc_html_e( 'Fonts options', 'pennews' ); ?></a>
					<a href="<?php echo admin_url( 'admin.php?page=pennews_migrator' ) ?>" class="nav-tab"><?php esc_html_e( 'Migrator Data', 'pennews' ); ?></a>
					<a href="<?php echo admin_url( 'admin.php?page=pennews_active_theme' ) ?>" class="nav-tab nav-tab-active"><?php esc_html_e( 'Active theme', 'pennews' ); ?></a>
				</h2>
				<div class="penci-activate-wrap gt-tab-pane gt-is-active">
					<div class="penci-activate-envato-code">
						<div class="penci-activate-code-title"><?php echo esc_html( sprintf( __( 'Active %s', 'pennews' ), $pennews_theme->name ) ); ?></div>
						<p class="penci-activate-desc">
							<?php echo esc_html( sprintf( __( 'Please activate %s to use full features of the theme. We\'re sorry about this but we built the activation system to prevent piracy of our themes in the internet,
							 we can do better serve our paying customers.', 'pennews' ), $pennews_theme->name ) ); ?>
							<br>
							<?php echo __( 'And please note that: With each license - you just can use for one website.<br>If you want to use this theme for multiple sites, please buy more licenses for it.<br>Example: 2 licenses can use for 2 websites, 4 licenses can use for 4 websites, 7 licenses can use for 7 websites,...', 'pennews' ); ?>
						</p>
						<form id="penci-check-license" action="<?php echo admin_url( 'admin.php?page=pennews_active_theme' ); ?>">
							<div class="penci-activate-inputs">
								<input name="evato-code" class="penci-form-control evato-code" type="text" placeholder="<?php esc_html_e( 'Your Envato Token', 'pennews' ); ?>" value="">
								<input type="hidden" name="server-id" class="server-id" value="<?php echo( $this->get_server_id() ); ?>" readonly/>
								<span class="penci-form-control-bar"></span>
								<div class="penci-activate-err">
									<span class="penci-err-missing"><?php esc_html_e( 'Code is required', 'pennews' ); ?></span>
									<span class="penci-err-length"><?php esc_html_e( 'Code is too short', 'pennews' ); ?></span>
									<span class="penci-err-nottoken"><?php esc_html_e( 'Registration could not be completed because the value entered above is a purchase code. A Envato Token key is needed to register. Please check the guide below for more.', 'pennews' ); ?></span>
									<span class="penci-err-invalid"><?php esc_html_e( 'Invalid token, or corresponding this Envato account does not purchased PenNews.', 'pennews' ); ?></span>
									<span class="penci-err-check-error"><?php esc_html_e( 'Envato API error, please try again later', 'pennews' ) ?></span>
								</div>
							</div>
							<button class="pennews-activate-button"><?php esc_html_e( 'Activate theme', 'pennews' ); ?></button>
							<div class="spinner"></div>
							<div class="pennews-find-code">
								<a href="<?php echo esc_url( 'https://build.envato.com/create-token/?user:username=t&purchase:download=t&purchase:verify=t&purchase:list=t' ); ?>" target="_blank">
									<?php esc_html_e( 'Find your Envato token', 'pennews' ); ?>
								</a>
							</div>
						</form>
						<div class="penci-activate-desc2">
							<hr>
							<h3>How to Generating A Envato Token?</h3>
							<ol>
								<li>Click on <a href="https://build.envato.com/create-token/?user:username=t&purchase:download=t&purchase:verify=t&purchase:list=t" target="_blank">this page</a> to generate a Envato Token.<br><strong>NOTE IMPORTANT:</strong> You must be logged into the same Themeforest account that purchased PenNews. If you are logged in already, look in the top menu bar to ensure it is the right account. If you are not logged in, you will be directed to login then directed back to the Create A Token Page.</li>
								<li>Enter a name for your token, and make sure you check to the boxes for <strong>View Your Envato Account Username</strong>, <strong>Download Your Purchased Items</strong>, <strong>List Purchases You've Made</strong> and <strong>Verify Purchases You've Made</strong> from the permissions needed section. Check to agree to the terms and conditions, and click the Create Token button</li>
								<li>A new page will load with a token number in a box. Copy the token number then come back to this registration page and paste it into the field above and click the <strong>Activate Theme</strong> button.</li>
								<li>Please make sure you followed all the steps as above - if you did it and still can't activate the theme - please create a new ticket on <a href="https://pencidesign.ticksy.com/" target="_blank">our support forum</a> or <a href="https://themeforest.net/user/pencidesign#contact" target="_blank">our contact form</a> and we will help you with this.</li>
							</ol>
						</div>
					</div>

				</div>
			</div>
			<?php
		}

		public function do_check_envato_code() {

			$envato_code = isset( $_POST['envato_code'] ) ? $_POST['envato_code'] : '';


			if ( empty( $envato_code ) ) {
				return;
			}

			$envato_code = preg_replace( '/\s+/', '', $envato_code );

			$theme_exists = $this->theme_purchase_exists( $envato_code );

			if ( $theme_exists ) {
				update_option( 'penci_pennews_is_activated', 1 );
				wp_send_json_success( array( 'success' => true ) );
			} else {

				$is_purchase_code = '';
				if ( 36 === strlen( $envato_code ) && 4 === substr_count( $envato_code, '-' ) ) {
					$is_purchase_code = 'true';
				}

				wp_send_json_error( array( 'is_wp_error' => 0, 'is_purchase_code' => $is_purchase_code  ) );
			}
		}

		public function theme_purchase_exists( $token, $page = '' ) {
			$list_themes = $this->get_list_theme_purchase( $token );

			if ( ! $list_themes ) {
				return false;
			}

			foreach ( $list_themes as $theme ) {

				if ( isset( $theme['id'] ) && '12945398' == $theme['id'] ) {
					return true;
				}
			}

			if ( 100 === count( $list_themes ) ) {

				if ( ! $page ) {
					$page = 2;
				} else {
					$page = $page + 1;
				}

				$page = ( ! $page ) ? 2 : $page + 1;

				return $this->theme_purchase_exists( $token, $page );
			}

			return false;
		}

		public function get_list_theme_purchase( $token, $page = '' ) {
			$themes = array();
			$url    = 'https://api.envato.com/v3/market/buyer/list-purchases?filter_by=wordpress-themes' . ( $page ? '&page=' . $page : '' );

			$response_themes = wp_remote_get( $url, array(
				'headers'      => array(
					'Authorization' => 'Bearer ' . $token,
					'User-Agent'    => 'Purchase code verification script',
				),
				'timeout'      => 20,
				'headers_data' => false,
			) );
			$response_themes = json_decode( wp_remote_retrieve_body( $response_themes ), true );

			if ( ! is_wp_error( $response_themes ) && isset( $response_themes['results'] ) ) {
				foreach ( (array) $response_themes['results'] as $theme ) {
					$themes[] = array(
						'id'         => isset( $theme['item']['id'] ) ? $theme['item']['id'] : '',
						'name'       => isset( $theme['item']['wordpress_theme_metadata']['theme_name'] ) ? $theme['item']['wordpress_theme_metadata']['theme_name'] : '',
						'author'     => isset( $theme['item']['wordpress_theme_metadata']['author_name'] ) ? $theme['item']['wordpress_theme_metadata']['author_name'] : '',
						'url'        => isset( $theme['item']['url'] ) ? $theme['item']['url'] : '',
						'author_url' => isset( $theme['item']['author_url'] ) ? $theme['item']['author_url'] : ''
					);
				}
			}

			return $themes;
		}
	}
}

new Penci_Require_Active;
