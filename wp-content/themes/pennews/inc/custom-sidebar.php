<?php
/**
 * Additional sidebars
 */

class Penci_Custom_Sidebar{

	protected static $initialized = false;

	public static function initialize() {
		if ( self::$initialized ) {
			return;
		}

		add_action( 'wp_ajax_pennews_add_sidebar'   , array( __CLASS__, 'add_sidebar'    ) );
		add_action( 'wp_ajax_pennews_remove_sidebar', array( __CLASS__, 'remove_sidebar' ) );

		add_action( 'init'              , array( __CLASS__, 'register_sidebars'    ) );
		add_action( 'sidebar_admin_page', array( __CLASS__, 'admin_page'  ) );

		self::$initialized = true;
	}

	/**
	 * Register sidebars
	 */
	public static function register_sidebars() {

		if( is_page_template( 'page-templates/full-width.php' ) ) {
			return;
		}

		$sidebars = get_option( 'pennews_custom_sidebars' );

		if( empty( $sidebars ) ) {
			return;
		}

		foreach ( ( array )$sidebars as $id => $sidebar ) {
			if ( ! isset( $sidebar['id'] ) ) {
				$sidebar['id'] = $id;
			}

			$sidebar['before_widget'] = self::get_before_widget();

			register_sidebar( $sidebar );
		}
	}

	public static function get_before_widget(){
		$class_before_widget = ' penci-block-vc penci-widget-sidebar';
		$class_before_widget .= ' ' . penci_get_setting( 'penci_style_block_title' );
		$class_before_widget .= ' ' . penci_get_setting( 'penci_align_blocktitle' );
		$before_widget = '<div id="%1$s" class="widget ' . $class_before_widget . ' %2$s">';

		return $before_widget;
	}

	/**
	 * Add sidebar
	 */
	public static function add_sidebar() {

		$name  = isset( $_POST['_nameval'] ) ? $_POST['_nameval'] : '';
		$nonce = isset( $_POST['_wpnonce'] ) ? $_POST['_wpnonce'] : '';

		if ( empty( $nonce ) ) {
			wp_send_json_error( esc_html__( 'Invalid request.', 'pennews' ) );
		} elseif ( empty( $name ) ) {
			wp_send_json_error( esc_html__( 'Missing sidebar name.', 'pennews' ) );
		}

		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
			wp_send_json_error( esc_html__( 'Nonce verification fails.', 'pennews' ) );
		}

		// Get  custom sidebars.
		$sidebars    = get_option( 'pennews_custom_sidebars', array() );
		$sidebar_num = get_option( 'pennews_custom_sidebars_lastid', - 1 );

		if ( $sidebar_num < 0 ) {
			$sidebar_num = 0;
			if ( is_array( $sidebars ) ) {
				$key_sidebars = explode( '-', end( array_keys( $sidebars ) ) );
				$sidebar_num  = ( int ) end( $key_sidebars );
			}
		}

		update_option( 'pennews_custom_sidebars_lastid', ++ $sidebar_num );

		$before_title  = '<div class="penci-block-heading"><h4 class="widget-title penci-block__title"><span>';
		$after_title   = '</span></h4></div>';


		$sidebars[ 'pennews-custom-sidebar-' . $sidebar_num ] = array(
			'class'         => 'pennews-custom-sidebar',
			'id'            => 'pennews-custom-sidebar-' . $sidebar_num,
			'name'          => stripcslashes( $name ),
			'description'   => '',
			'before_widget' => self::get_before_widget(),
			'after_widget'  => '</div>',
			'before_title'  => $before_title,
			'after_title'   => $after_title
		);

		update_option( 'pennews_custom_sidebars', $sidebars );

		if ( ! function_exists( 'wp_list_widget_controls' ) ) {
			include_once ABSPATH . 'wp-admin/includes/widgets.php';
		}

		ob_start();
		?>
		<div class="widgets-holder-wrap pennews-custom-sidebar closed">
			<?php wp_list_widget_controls( 'pennews-custom-sidebar-' . $sidebar_num, stripcslashes( $name ) ); ?>
		</div>
		<?php
		$output = ob_get_clean();

		wp_send_json_success( $output );
	}

	/**
	 * Remove sidebar
	 */
	public static function remove_sidebar(){

		$idSidebar = isset( $_POST['idSidebar'] ) ? $_POST['idSidebar'] : '';
		$nonce     = isset( $_POST['_wpnonce'] ) ? $_POST['_wpnonce'] : '';

		if ( empty( $nonce ) ) {
			wp_send_json_error( esc_html__( 'Invalid request.', 'pennews' ) );
		} elseif ( empty( $idSidebar ) ) {
			wp_send_json_error( esc_html__( 'Missing sidebar ID', 'pennews' ) );
		}

		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
			wp_send_json_error( esc_html__( 'Nonce verification fails.', 'pennews' ) );
		}

		$custom_sidebars = get_option( 'pennews_custom_sidebars', array() );

		unset( $custom_sidebars[ $idSidebar ] );

		update_option( 'pennews_custom_sidebars', $custom_sidebars );

		wp_send_json_success();
	}

	/**
	 * Print HTML code to manage custom sidebar
	 */
	public static function admin_page() {
		global $wp_registered_sidebars;
		?>
		<div class="widgets-holder-wrap">
			<div id="penci-add-custom-sidebar" class="widgets-sortables">
				<div class="sidebar-name">
					<div class="sidebar-name-arrow"><br></div>
					<h2>
						<?php esc_html_e( 'Add New Sidebar', 'pennews' ); ?>
						<span class="spinner"></span>
					</h2>
				</div>
				<div class="sidebar-description">
					<form class="description" method="POST" action="">
						<?php wp_nonce_field( 'pennews_add_sidebar' ); ?>
						<table class="form-table">
							<tr valign="top">
								<td>
									<input id="penci-add-custom-sidebar-name" style="width: 100%;" type="text" class="text" name="name" value="" placeholder="<?php esc_attr_e( 'Enter sidebar name', 'pennews' ) ?>">
								</td>
								<td>
									<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Add', 'pennews' ) ?>">
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
		<style type="text/css" media="screen">
			.pennews-remove-custom-sidebar .notice-dismiss {
				right: 30px;
				top: 3px;
			}
		</style>			
	<?php
	}

	public static function get_list_sidebar( $pos = 'left' ) {
		$custom_sidebars = get_option( 'pennews_custom_sidebars' );

		$list_sidebar = array(
			'sidebar-1' => esc_html__( 'Sidebar Right', 'pennews' ),
			'sidebar-2' => esc_html__( 'Sidebar Left', 'pennews' ),
			'footer-1'  => esc_html__( 'Footer Column #1', 'pennews' ),
			'footer-2'  => esc_html__( 'Footer Column #2', 'pennews' ),
			'footer-3'  => esc_html__( 'Footer Column #3', 'pennews' ),
			'footer-4'  => esc_html__( 'Footer Column #4', 'pennews' ),
		);

		if ( class_exists( 'WooCommerce' ) ) {
			$list_sidebar['penci-shop-sidebar'] = esc_html__( 'Sidebar For Shop', 'pennews' );
		}

		if ( class_exists( 'Penci_Portfolio' ) ) {
			$list_sidebar['penci-portfolio-sidebar-left']  = esc_html__( 'Portfolio Sidebar Left', 'pennews' );
			$list_sidebar['penci-portfolio-sidebar-right'] = esc_html__( 'Portfolio Sidebar Right', 'pennews' );
		}

		if ( class_exists( 'bbPress' ) ) {
			$list_sidebar['penci-bbpress'] = esc_html__( 'Sidebar bbPress', 'pennews' );
		}

		if ( class_exists( 'BuddyPress' ) ) {
			$list_sidebar['penci-buddypress'] = esc_html__( 'Sidebar BuddyPress', 'pennews' );
		}

		if ( class_exists( 'Tribe__Events__Main' ) ) {
			$list_sidebar['penci-event'] = esc_html__( 'Sidebar Events', 'pennews' );
		}

		if ( class_exists( 'Penci_Instagram' ) ) {
			$list_sidebar['footer-instagram'] = esc_html__( 'Footer Instagram', 'pennews' );
		}

		if ( empty( $custom_sidebars ) || ! is_array( $custom_sidebars ) ) {
			return $list_sidebar;
		}

		foreach ( $custom_sidebars as $sidebar_id => $custom_sidebar ) {

			if ( empty( $custom_sidebar['name'] ) ) {
				continue;
			}
			$list_sidebar[ $sidebar_id ] = $custom_sidebar['name'];
		}

		return $list_sidebar;
	}
}