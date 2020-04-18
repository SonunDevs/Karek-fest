<?php

if ( ! class_exists( 'Penci_Require_AdSense' ) ) {
	class Penci_Require_AdSense {
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'add_submenu_page' ), 15 );
			add_action( 'admin_enqueue_scripts', array( $this, 'penci_admin_scripts' ) );

			add_shortcode( 'penci_ads', array( $this, 'func_ads_callback' ) );
		}

		function func_ads_callback( $atts, $content ) {
			$atts = shortcode_atts( array(
				'id' => ''
			), $atts );

			return $atts['id'] ? $this->func_ad_show( $atts['id'] ) : '';
		}

		function func_ad_show( $id_ads ) {
			$ads_manage = get_option( 'penci_ads_manage' );

			if ( isset( $ads_manage[ $id_ads ]['code'] ) && $ads_manage[ $id_ads ]['code'] ) {
				return '<div class="penci-google-adsense ' . $id_ads . '">' . do_shortcode( stripslashes( $ads_manage[ $id_ads ]['code'] ) ) . '</div>';
			}

			return '';
		}

		function penci_admin_scripts() {
			wp_enqueue_script( 'penci-admin-ads', get_template_directory_uri() . '/js/admin-ads.js', array( 'jquery', 'jquery-ui-sortable' ), PENCI_PENNEWS_VERSION, true );


			$localize_script = array(
				'Index'         => $this->get_index(),
				'ajaxUrl'       => admin_url( 'admin-ajax.php' ),
				'nonce'         => wp_create_nonce( 'ajax-nonce' ),
				'ADCodeTitle'   => esc_html__( 'Your Ad code', 'pennews' ),
				'ADCodedesc'    => esc_html__( 'Paste your Google AdSense code here.', 'pennews' ),
				'ADTitle'       => esc_html__( 'Ad title', 'pennews' ),
				'textShortcode' => esc_html__( 'Shortcode', 'pennews' ),
				'textDelete'    => esc_html__( 'Delete', 'pennews' )
			);
			wp_localize_script( 'penci-admin-ads', 'PENCIADS', $localize_script );
		}

		public function add_submenu_page() {
			add_submenu_page( 'pennews_dashboard_welcome',
				esc_html__( 'Ads Manage', 'pennews' ),
				esc_html__( 'Ads Manage', 'pennews' ),
				'manage_options', 'pennews_adsense',
				array( $this, 'adsense_page' )
			);

			add_action( 'admin_init', array( $this, 'update' ) );
		}

		public function update() {
			if ( ! empty( $_POST ) && isset( $_POST['_page'] ) && $_POST['_page'] === 'pennews_custom_adsense' ) {

				$ads = array();

				if ( isset( $_POST['penci_ads'] ) ) {
					$post_ads = $_POST['penci_ads'];

					foreach ( (array) $post_ads as $penci_ad ) {
						$ad_title = isset( $penci_ad['ad_title'] ) ? $penci_ad['ad_title'] : '';
						$ad_code  = isset( $penci_ad['ad_code'] ) ? $penci_ad['ad_code'] : '';
						$ad_id    = isset( $penci_ad['ad_id'] ) ? $penci_ad['ad_id'] : '';

						if ( ! $ad_title && ! $ad_code && ! $ad_id ) {
							continue;
						}

						$ads[ $ad_id ] = array( 'title' => $ad_title, 'code' => $ad_code );
					}

					update_option( 'penci_ads_manage', $ads );
				}

				if ( isset( $_POST['penci_ads_index'] ) ) {
					update_option( 'penci_ads_manage_index', $_POST['penci_ads_index'] );
				}

				wp_safe_redirect( admin_url( 'admin.php?page=pennews_adsense' ) );
				exit;
			}
		}

		public function adsense_page() {
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
					<a href="<?php echo admin_url( 'admin.php?page=pennews_active_theme' ) ?>" class="nav-tab nav-tab-active"><?php esc_html_e( 'Ads Manage', 'pennews' ); ?></a>
				</h2>
				<div id="penci-custom-fonts" class="gt-tab-pane gt-is-active">

					<form method="post" action="options.php">
						<table class="widefat penci-table-options penci-table-options-ads" cellspacing="0">
							<tbody>
							<tr class="<?php echo get_option( 'pennews_enable_all_fontgoogle' ) ? "penmews-hide-option" : "" ?>">
								<td>
									<ul id="pennews-list-ads">
										<input type="hidden" name="penci_ads[0][ad_id]" value="">
										<?php
										$ads_manage = get_option( 'penci_ads_manage' );
										if ( $ads_manage ) {
											$i = 1;
											foreach ( $ads_manage as $ad_id => $ad_info ) {
												$ad_title = isset( $ad_info['title'] ) ? $ad_info['title'] : '';
												$ad_code  = isset( $ad_info['code'] ) ? $ad_info['code'] : '';
												?>
												<li class="penci-ad-item penci-ad-item-<?php echo esc_attr( $i ); ?> ui-sortable-handle">
													<div class="penci-ads-row">
														<div class="penci-ads-label">
															<span class="penci-ads-title"><?php esc_html_e( 'Your Ad code', 'pennews' ); ?></span>
															<span class="penci-ads-desc"><?php esc_html_e( 'Paste your Google AdSense code here.', 'pennews' ); ?> </span>
														</div>
														<div class="penci-ads-control">
															<textarea name="penci_ads[<?php echo $i; ?>][ad_code]"><?php echo stripslashes( $ad_code ); ?></textarea>
														</div>
													</div>
													<div class="penci-ads-row">
														<div class="penci-ads-label">
															<span class="penci-ads-title"><?php esc_html_e( 'Ad title', 'pennews' ); ?></span>
														</div>
														<div class="penci-ads-control">
															<input type="text" name="penci_ads[<?php echo $i; ?>][ad_title]" value="<?php echo $ad_title; ?>">
														</div>
													</div>
													<div class="penci-ads-row">
														<div class="penci-ads-label">
															<span class="penci-ads-title"><?php esc_html_e( 'Shortcode', 'pennews' ); ?></span>
														</div>
														<div class="penci-ads-control">
															<span class="penci-ads-shortcode">[penci_ads id="<?php echo esc_attr( $ad_id ); ?>"]</span>
															<input type="hidden" name="penci_ads[<?php echo $i; ?>][ad_id]" value="<?php echo esc_attr( $ad_id ); ?>">
															<a class="button penci-btn-remove-ad"><span class="dashicons dashicons-trash"></span> <?php esc_html_e( 'Delete', 'pennews' ); ?></a>
														</div>
													</div>
												</li>
												<?php
												$i ++;
											}
										} else { ?>
											<li class="penci-ad-item penci-ad-item-1 ui-sortable-handle">
												<div class="penci-ads-row">
													<div class="penci-ads-label">
														<span class="penci-ads-title"><?php esc_html_e( 'Your Ad code', 'pennews' ); ?></span>
														<span class="penci-ads-desc"><?php esc_html_e( 'Paste your Google AdSense code here.', 'pennews' ); ?> </span>
													</div>
													<div class="penci-ads-control">
														<textarea name="penci_ads[1][ad_code]"></textarea>
													</div>
												</div>
												<div class="penci-ads-row">
													<div class="penci-ads-label">
														<span class="penci-ads-title"><?php esc_html_e( 'Ad title', 'pennews' ); ?></span>
													</div>
													<div class="penci-ads-control">
														<input type="text" name="penci_ads[1][ad_title]" value="<?php esc_html_e( 'Pennews Ad 1', 'pennews' ); ?>">
													</div>
												</div>
												<div class="penci-ads-row">
													<div class="penci-ads-label">
														<span class="penci-ads-title"><?php esc_html_e( 'Shortcode', 'pennews' ); ?></span>
													</div>
													<div class="penci-ads-control">
														<span class="penci-ads-shortcode">[penci_ads id="penci_ads_1"]</span>
														<input type="hidden" name="penci_ads[1][ad_id]" value="penci_ads_1">
														<a class="button penci-btn-remove-ad"><span class="dashicons dashicons-trash"></span> <?php esc_html_e( 'Delete', 'pennews' ); ?></a>
													</div>
												</div>
											</li>
										<?php } ?>
									</ul>
									<a id="pennews-add-ads" class="button" href="#"><?php esc_html_e( 'Add New AdSense', 'pennews' ); ?></a>
									<input type="hidden" name="penci_ads_index" id="penci_ads_index" value="<?php echo esc_attr( $this->get_index() ); ?>">
								</td>
							</tr>
							</tbody>
						</table>
						<input type="hidden" name="_page" value="pennews_custom_adsense">
						<?php submit_button(); ?>

					</form>

				</div>
			</div>
			<?php
		}

		public function get_index() {
			$opt_ads_index = get_option( 'penci_ads_manage_index' );
			$ads_index     = 2;
			if ( $opt_ads_index ) {
				$ads_index = $opt_ads_index + 1;
			}

			return $ads_index;
		}
	}
}

new Penci_Require_AdSense;