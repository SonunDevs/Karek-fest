<?php
/**
 * Add theme dashboard page
 *
 * @package EightyDays
 */

/**
 * Dashboard class.
 */
class Penci_Dashboard {
	/**
	 * Store the theme data.
	 *
	 * @var WP_Theme Theme data.
	 */
	private $theme;

	/**
	 * Theme slug.
	 *
	 * @var string Theme slug.
	 */
	private $slug;
	
	/**
	 * System status.
	 *
	 * @var array System status.
	 */
	private $system_status;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->theme = wp_get_theme();
		$this->slug  = $this->theme->template;
		$this->system_status  = $this->system_status();

		add_action( 'admin_menu', array( $this, 'add_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_init', array( $this, 'redirect' ) );
		add_filter('upload_mimes', array( $this, 'custom_mime_types' ) );

		$this->load_files();
	}

	function load_files(){
		require_once dirname( __FILE__ ) . '/inc/require-activation.php';
		require_once dirname( __FILE__ ) . '/inc/white-label.php';
		require_once dirname( __FILE__ ) . '/inc/adsense.php';
		require_once dirname( __FILE__ ) . '/inc/resizable-width.php';
		require_once dirname( __FILE__ ) . '/inc/shortcode-managment.php';

	}

	public function custom_mime_types( $mime_types ) {
		$mime_types['woff']    = 'application/x-font-woff';
		$mime_types['svg']     = 'image/svg+xml';
		$mime_types['ogx'] = 'application/ogg';
		$mime_types['ogv'] = 'video/ogg';

		return $mime_types;
	}

	public function get_wel_page_title(){
		$wel_page_title = penci_get_theme_mod( 'admin_wel_page_title' );
		return $wel_page_title ? $wel_page_title : 'PenNews';
	}

	/**
	 * Add theme dashboard page.
	 */
	public function add_menu() {

		$wel_page_title = $this->get_wel_page_title();
		add_menu_page( $wel_page_title, $wel_page_title, 'manage_options', 'pennews_dashboard_welcome', array( $this, 'dashboard_welcome' ), null, 3 );

		if ( !defined('ENVATO_HOSTED_SITE') ) {
			add_submenu_page( 'pennews_dashboard_welcome', esc_html__( 'System status', 'pennews' ), esc_html__( 'System status', 'pennews' ), 'manage_options', 'pennews_system_status', array( $this, 'dashboard_system_status' ) );
		}
		add_submenu_page( 'pennews_dashboard_welcome', esc_html__( 'Custom fonts', 'pennews' ), esc_html__( 'Fonts options', 'pennews' ), 'manage_options', 'pennews_custom_fonts', array( $this, 'custom_fonts' ) );

		$this->replace_text_submenu();

		add_action( 'admin_init', array( $this, 'update' ) );
	}

	public function update() {
		if ( ! empty($_POST) && isset( $_POST['_page'] ) && $_POST['_page'] === 'pennews_custom_fonts') {
			$data = $_POST;

			$fonts = array();
		
			foreach ($_POST as $key => $value) {
				if (strpos($key, 'pennews_') !== false) {
					$fonts[$key] = $value;
				}
			}

			penci_update_option($fonts);

			if ( isset( $_POST['pennews_custom_fontgoogle'] ) ) {
				update_option( 'pennews_custom_fontgoogle', $_POST['pennews_custom_fontgoogle'] );
			}

			if ( isset( $_POST['pennews_enable_all_fontgoogle'] ) ) {
				update_option( 'pennews_enable_all_fontgoogle', 1 );
			}else{
				update_option( 'pennews_enable_all_fontgoogle', 0 );
			}

			wp_safe_redirect(admin_url('admin.php?page=pennews_custom_fonts'));
			exit;
		}
	}

	public function register_settings() {
		// register_setting( 'pennews-settings-group', 'penci_pennews_options' );

	}

	public function replace_text_submenu(){
		global $submenu;
		$submenu['pennews_dashboard_welcome'][0][0] = esc_html__( 'Welcome', 'pennews' );
	}

	/**
	 * Show dashboard page.
	 */
	public function dashboard_welcome() {
		?>
		<div class="wrap about-wrap penci-about-wrap">
			<?php include get_template_directory() . '/inc/dashboard/sections/welcome.php'; ?>
			<?php include get_template_directory() . '/inc/dashboard/sections/getting-started.php'; ?>
		</div>
		<?php
	}

	public function dashboard_system_status() {
		?>
		<div class="wrap about-wrap penci-about-wrap">
			<?php include get_template_directory() . '/inc/dashboard/sections/welcome.php'; ?>
			<?php include get_template_directory() . '/inc/dashboard/sections/system-status.php'; ?>
		</div>
		<?php
	}
	public function custom_fonts() {
		?>
		<div class="wrap about-wrap penci-about-wrap">
			<?php include get_template_directory() . '/inc/dashboard/sections/welcome.php'; ?>
			<?php include get_template_directory() . '/inc/dashboard/sections/custom-fonts.php'; ?>
		</div>
		<?php
	}

	public function migrator_panel() {
		?>
		<div class="wrap about-wrap penci-about-wrap">
			<h1><?php esc_html_e( 'PenNews Migrator Data','pennews' ); ?></h1>
			<div class="about-text"><?php esc_html_e( 'Migration plugin from PenciDesign for all your blog data. Switch to PenNews without losing data.','pennews' ); ?></div>
			<a target="_blank" href="<?php echo esc_url( 'http://pennews.pencidesign.com/' ); ?>" class="wp-badge">PenciDesign</a>
			<h2 class="nav-tab-wrapper">
				<a href="<?php echo admin_url( 'admin.php?page=pennews_dashboard_welcome' ) ?>" class="nav-tab"><?php esc_html_e( 'Getting started', 'pennews' ); ?></a>
				<a href="<?php echo admin_url( 'customize.php' ) ?>" class="nav-tab"><?php esc_html_e( 'Customize Style', 'pennews' ); ?></a>
				<?php if ( !defined('ENVATO_HOSTED_SITE') ): ?>
					<a href="<?php echo admin_url( 'admin.php?page=pennews_system_status' ) ?>" class="nav-tab"><?php esc_html_e( 'System status', 'pennews' ); ?></a>
				<?php endif; ?>
				<a href="<?php echo admin_url( 'admin.php?page=pennews_custom_fonts' ) ?>" class="nav-tab"><?php esc_html_e( 'Fonts options', 'pennews' ); ?></a>
				<a href="<?php echo admin_url( 'admin.php?page=pennews_migrator' ) ?>" class="nav-tab nav-tab-active"><?php esc_html_e( 'Migrator Data', 'pennews' ); ?></a>
				<?php if( ! penci_pennews_is_activated() ): ?>
					<a href="<?php echo admin_url( 'admin.php?page=pennews_active_theme' ) ?>" class="nav-tab"><?php esc_html_e( 'Active theme', 'pennews' ); ?></a>
				<?php endif; ?>
			</h2>
			<div class="penci-migrator-panel">
				<?php
				if( class_exists( 'Penci_PenNews_Migrator' ) ){
					do_action( 'penci_migrator_panel' );
				}else{
					echo '<p>';
					esc_html_e( 'Penci PenNews Migrator Plugin is required, click on the button below to go to the plugins page to install it.','pennews' );
					echo '</p>';
					?>
					<a class="button button-primary button-hero" href="<?php echo admin_url( 'plugins.php' ); ?>">Go to the Plugins Page</a>
					<?php
				}

				?>
			</div>
		</div>
		<?php
	}

	/**
	 * Enqueue scripts for dashboard page.
	 *
	 * @param string $hook Page hook.
	 */
	public function enqueue_scripts( $hook ) {
		$wel_page_title = $this->get_wel_page_title();

		$wel_page_title = wp_unslash( $wel_page_title );
		$wel_page_title = strtolower ($wel_page_title);
		$wel_page_title = str_replace(' ', '-', $wel_page_title );

		if( $wel_page_title . '_page_pennews_custom_fonts' == $hook ||
		    $wel_page_title . '_page_pennews_system_status' == $hook ||
		    $wel_page_title . '_page_pennews_dashboard_welcome' == $hook ||
		    $wel_page_title . '_page_pennews_active_theme' == $hook ||
		    $wel_page_title . '_page_pennews_migrator' == $hook ||
		    $wel_page_title . '_page_pennews_resizable_width' == $hook ||
		    $wel_page_title . '_dashboard_welcome' == $hook ){

			wp_enqueue_media();
			wp_enqueue_script( 'jquery-ui-resizable' );
			wp_enqueue_style( "{$this->slug}-semantic", get_template_directory_uri() . '/inc/dashboard/css/semantic.min.css' );
			wp_enqueue_style( "{$this->slug}-dashboard-style", get_template_directory_uri() . '/inc/dashboard/css/dashboard-style.css' );
			wp_enqueue_script( "{$this->slug}-transition", get_template_directory_uri() . '/inc/dashboard/js/transition.min.js', array( 'jquery' ) );
			wp_enqueue_script( "{$this->slug}-dropdown", get_template_directory_uri() . '/inc/dashboard/js/dropdown.min.js', array( 'jquery' ) );
			wp_enqueue_script( "{$this->slug}-dashboard-script", get_template_directory_uri() . '/inc/dashboard/js/script.js', array( 'jquery', "{$this->slug}-dropdown" ) );

			$custom_fontgoogle = get_option( 'pennews_custom_fontgoogle' );
			$custom_fontgoogle = array_filter( explode( '|', $custom_fontgoogle . '|' ) );

			$localize_script = array(
				'setSelected'    => $custom_fontgoogle,
				'ajaxUrl'         => admin_url( 'admin-ajax.php' ),
				'nonce'           => wp_create_nonce( 'ajax-nonce' )
			);
			wp_localize_script( "{$this->slug}-dashboard-script", 'PENCIDASHBOARD', $localize_script );
		}

	}

	/**
	 * Redirect to dashboard page after theme activation.
	 */
	public function redirect() {
		global $pagenow;
		if ( is_admin() && isset( $_GET['activated'] ) && 'themes.php' === $pagenow ) {
			wp_safe_redirect( admin_url( "admin.php?page=pennews_dashboard_welcome" ) );
			exit;
		}
	}

	public function system_status() {
		$system_status = array(
			'Theme config'          => array(
				array(
					'check_name' => esc_html__( 'Registration key', 'pennews' ),
					'value'      => $this->theme->name,
					'status'     => 'info'
				),
				array(
					'check_name' => esc_html__( 'Theme name', 'pennews' ),
					'value'      => $this->theme->name,
					'status'     => 'info'
				),
				array(
					'check_name' => esc_html__( 'Theme version', 'pennews' ),
					'value'      => $this->theme->version,
					'status'     => 'info'
				),
				array(
					'check_name' => esc_html__( 'Theme database version', 'pennews' ),
					'value'      => $this->theme->version,
					'status'     => 'info'
				),
			),
			'Server environment'    => array(
				array(
					'check_name' => esc_html__( 'Server software', 'pennews' ),
					'value'      => function_exists( 'penci_get_server_value' ) ? penci_get_server_value( 'SERVER_SOFTWARE' ) : '',
					'status'     => 'info'
				),
				array(
					'check_name' => esc_html__( 'PHP Version', 'pennews' ),
					'value'      => phpversion(),
					'status'     => 'info'
				),
				array(
					'check_name' => esc_html__( 'post_max_size', 'pennews' ),
					'value'      => sprintf( ini_get( 'post_max_size' ) . '<span class="status-small-text"> - You cannot upload images, themes and plugins that have a size bigger than this value.</span>' ),
					'status'     => 'info'
				),
			),
			'WordPress and plugins' => array(
				array(
					'check_name' => esc_html__( 'WP Home URL', 'pennews' ),
					'value'      => home_url(),
					'status'     => 'info'
				),
				array(
					'check_name' => esc_html__( 'WP Site URL', 'pennews' ),
					'value'      => site_url(),
					'status'     => 'info'
				),
				array(
					'check_name' => esc_html__( 'WP version', 'pennews' ),
					'value'      => get_bloginfo( 'version' ),
					'status'     => 'info'
				),
				array(
					'check_name' => esc_html__( 'WP multisite enabled', 'pennews' ),
					'value'      => is_multisite() ? esc_html__( 'Yes', 'pennews' ) : esc_html__( 'No', 'pennews' ),
					'status'     => 'info'
				),
				array(
					'check_name' => esc_html__( 'WP Language', 'pennews' ),
					'value'      => get_locale(),
					'status'     => 'info'
				),
			)
		);

		$max_input_vars = ini_get( 'max_input_vars' );

		if ( $max_input_vars == 0 or $max_input_vars >= 2000 ) {
			$system_status['Server environment'][] = array(
				'check_name' => esc_html__( 'max_input_vars', 'pennews' ),
				'value'      => $max_input_vars,
				'status'     => 'green'
			);
		} else {
			$system_status['Server environment'][] = array(
				'check_name' => esc_html__( 'max_input_vars', 'pennews' ),
				'value'      => $max_input_vars . '<span class="status-small-text"></span>',
				'status'     => 'green'
			);
		}

		if( extension_loaded('mbstring') ) {
			$system_status['Server environment'][] = array(
				'check_name' => esc_html__( 'mbstring', 'pennews' ),
				'value'      => esc_html__( 'available.', 'pennews' ) .  '<span class="status-small-text">' . esc_html__( 'mbstring extension is loaded.', 'pennews' ) . '</span>',
				'status'     => 'green'
			);
		}else{
			$system_status['Server environment'][] = array(
				'check_name' => esc_html__( 'mbstring', 'pennews' ),
				'value'      => esc_html__( 'not available.', 'pennews' ) .  '<span class="status-small-text">' . esc_html__( 'mbstring extension is not loaded.', 'pennews' ) . '</span>',
				'status'     => 'yellow'
			);
		}

		if( extension_loaded('suhosin') ) {
			$system_status['Server environment'][] = array(
				'check_name' => esc_html__( 'suhosin', 'pennews' ),
				'value'      => esc_html__( 'suhosin is installed.', 'pennews' ),
				'status'     => 'green'
			);
		}else{
			$system_status['Server environment'][] = array(
				'check_name' => esc_html__( 'suhosin', 'pennews' ),
				'value'      => esc_html__( 'suhosin is not installed.', 'pennews' ),
				'status'     => 'yellow'
			);
		}

		// Wp debug
		if ( defined( 'WP_DEBUG' ) and WP_DEBUG === true ) {

			$system_status['WordPress and plugins'][] = array(
				'check_name' => esc_html__( 'WP_DEBUG', 'pennews' ),
				'value'      => 'WP_DEBUG is enabled. <span class="status-small-text">It may display unwanted messages. To see how you can change this please check our guide.</span>',
				'status'     => 'yellow'
			);
		} else {
			$system_status['WordPress and plugins'][] = array(
				'check_name' => esc_html__( 'WP_DEBUG', 'pennews' ),
				'value'      => esc_html__( 'False', 'pennews' ),
				'status'     => 'green'
			);
		}

		return $system_status;

	}
}
