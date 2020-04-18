<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if( ! class_exists( 'Penci_Resizable_Width' ) ):
	class Penci_Resizable_Width {
	    function __construct() {
		    add_action( 'admin_menu', array( $this, 'add_submenu_page' ), 15 );
		    add_action( 'admin_enqueue_scripts', array( $this, 'penci_admin_scripts' ) );
	    }

		public function add_submenu_page() {
			add_submenu_page( 'pennews_dashboard_welcome',
				esc_html__( 'Site Width', 'pennews' ),
				esc_html__( 'Site Width', 'pennews' ),
				'manage_options', 'pennews_resizable_width',
				array( $this, 'resizable_width' )
			);

			add_action( 'admin_init', array( $this, 'update' ) );
		}

		function update(){
			if ( ! empty($_POST) && isset( $_POST['_page'] ) && $_POST['_page'] === 'pennews_custom_width') {

				$list_resizable = array(
					'penci_archive_width_2col',
					'penci_archive_width_3col',
					'penci_single_width_2col',
					'penci_single_width_3col'
				);

				foreach ( $list_resizable as $key ){

					if( isset( $_POST[$key] ) && $_POST[$key] ){
						$pre_val = self::buildDefault( $_POST[$key] );

						if( $pre_val ){
							set_theme_mod($key, $pre_val );
						}
					}
				}

				if( isset( $_POST['penci_archive_columns_gap'] ) ){
					set_theme_mod( 'penci_archive_columns_gap',  $_POST['penci_archive_columns_gap'] );
				}

				if( isset( $_POST['penci_single_columns_gap'] ) ){
					set_theme_mod( 'penci_single_columns_gap', $_POST['penci_single_columns_gap'] );
				}

				wp_safe_redirect(admin_url('admin.php?page=pennews_resizable_width'));
				exit;
			}
		}
		function penci_admin_scripts() {

		}

		function resizable_width(){

			$archive_w2col = get_theme_mod( 'penci_archive_width_2col' );
			$archive_w3col = get_theme_mod( 'penci_archive_width_3col' );

			$single_w2col = get_theme_mod( 'penci_single_width_2col' );
			$single_w3col = get_theme_mod( 'penci_single_width_3col' );

			$arch_w   = get_theme_mod( 'penci_arch_w_container' );
			$single_w = get_theme_mod( 'penci_single_w_container' );

			if ( $arch_w && ! $archive_w2col ) {
				$archive_w2col_total = $arch_w;

				$archive_w2col_main_px  = ceil( $arch_w - 300 );
				$archive_w2col_sbar1_px = '300';

				$archive_w2col_sbar1 = round( ( ( 300 / $arch_w ) * 100 ) , 4 );
				$archive_w2col_main  = 100 - $archive_w2col_sbar1;
			}else{
				$archive_w2col_pre       = $archive_w2col ? $archive_w2col : 'total:1110|main:73|sidebar1:27';
				$archive_w2col_arr       = self::parseData( $archive_w2col_pre );
				$archive_w2col_total     = isset( $archive_w2col_arr['total'] ) ? $archive_w2col_arr['total'] : '1110';
				$archive_w2col_sbar1     = isset( $archive_w2col_arr['sidebar1'] ) ? $archive_w2col_arr['sidebar1'] : '27';
				$archive_w2col_main      = 100 - $archive_w2col_sbar1;

				$archive_w2col_sbar1_px = ceil( $archive_w2col_total * ( $archive_w2col_sbar1 / 100 ) );
				$archive_w2col_main_px  = $archive_w2col_total - $archive_w2col_sbar1_px;
			}

			if ( $arch_w && ! $archive_w3col ) {
				$archive_w3col_total = $arch_w;

				$archive_w3col_sbar1_px = $archive_w3col_sbar2_px = 300;
				$archive_w3col_main_px  = $arch_w - 600;

				$archive_w3col_sbar1 = $archive_w3col_sbar2 = round( ( ( 300 / $arch_w ) * 100 ) , 4 );
				$archive_w3col_main  = 100 - ( $archive_w2col_sbar1 * 2 );

				
			}else{
				$archive_w3col       = $archive_w3col ? $archive_w3col : 'total:1400|main:57.2|sidebar1:21.4|sidebar2:21.4';
				$archive_w3col_arr   = self::parseData( $archive_w3col );
				$archive_w3col_total = isset( $archive_w3col_arr['total'] ) ? $archive_w3col_arr['total'] : '1400';
				
				$archive_w3col_sbar1 = isset( $archive_w3col_arr['sidebar1'] ) ? $archive_w3col_arr['sidebar1'] : '21';
				$archive_w3col_sbar2 = isset( $archive_w3col_arr['sidebar2'] ) ? $archive_w3col_arr['sidebar2'] : '21';
				$archive_w3col_main  = 100 - ( $archive_w3col_sbar1 + $archive_w3col_sbar2 );

				
				$archive_w3col_sbar1_px = ceil( $archive_w3col_total  * ( $archive_w3col_sbar1 / 100 ) );
				$archive_w3col_sbar2_px = ceil( $archive_w3col_total  * ( $archive_w3col_sbar2 / 100 ) );
				$archive_w3col_main_px  = $archive_w3col_total - (  $archive_w3col_sbar1_px + $archive_w3col_sbar2_px );


			}

			/** Single **/
			if ( $single_w && ! $single_w3col ) {
				$single_w2col_total = $single_w;

				$single_w2col_main_px  = ceil( $single_w - 300 );
				$single_w2col_sbar1_px = '300';

				$single_w2col_sbar1 = round( ( ( 300 / $single_w ) * 100 ) , 4 );
				$single_w2col_main  = 100 - $single_w2col_sbar1;

			}else{
				$single_w2col           = $single_w2col ? $single_w2col : 'total:1110|main:73|sidebar1:27';
				$single_w2col_arr       = self::parseData( $single_w2col );
				$single_w2col_total     = isset( $single_w2col_arr['total'] ) ? $single_w2col_arr['total'] : '1110';
				$single_w2col_sbar1     = isset( $single_w2col_arr['sidebar1'] ) ? $single_w2col_arr['sidebar1'] : '27';
				$single_w2col_main      = 100 - $single_w2col_sbar1;

				
				$single_w2col_sbar1_px = ceil( ( $single_w2col_total * ( $single_w2col_sbar1 / 100 ) ) );
				$single_w2col_main_px  = $single_w2col_total - $single_w2col_sbar1_px;

			}

			if ( $single_w && ! $single_w3col ) {
				$single_w3col_total = $single_w;

				$single_w3col_sbar1_px = $single_w3col_sbar2_px = 300;
				$single_w3col_main_px  = ceil( ( $single_w - 600 ) );

				$single_w3col_sbar1 = $single_w3col_sbar2 = round( ( ( 300 / $single_w ) * 100 ) , 4 );
				$single_w3col_main  = 100 - ( $single_w3col_sbar1 +  $single_w3col_sbar2 );

			}else{
				$single_w3col       = $single_w3col ? $single_w3col : 'total:1400|main:57.2|sidebar1:21.4|sidebar2:21.4';
				$single_w3col_arr   = self::parseData( $single_w3col );
				$single_w3col_total = isset( $single_w3col_arr['total'] ) ? $single_w3col_arr['total'] : '1400';
				
				$single_w3col_sbar1 = isset( $single_w3col_arr['sidebar1'] ) ? $single_w3col_arr['sidebar1'] : '21';
				$single_w3col_sbar2 = isset( $single_w3col_arr['sidebar2'] ) ? $single_w3col_arr['sidebar2'] : '21';
				$single_w3col_main  = 100 - ( $single_w3col_sbar1 + $single_w3col_sbar2 );

				
				$single_w3col_sbar1_px = ceil( $single_w3col_total  * ( $single_w3col_sbar1 / 100 ) );
				$single_w3col_sbar2_px = ceil( $single_w3col_total  * ( $single_w3col_sbar2 / 100 ) );
				$single_w3col_main_px  = $single_w3col_total - ( $single_w3col_sbar1_px + $single_w3col_sbar2_px );
			}
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
					<a href="<?php echo admin_url( 'admin.php?page=pennews_active_theme' ) ?>" class="nav-tab nav-tab-active"><?php esc_html_e( 'Site Width', 'pennews' ); ?></a>
				</h2>
				<div id="penci-custom-fonts" class="gt-tab-pane gt-is-active">
					<form method="post" action="options.php">
						<table class="widefat penci-table-options penci-table-options-resize-width" cellspacing="0">
							<thead>
							<tr>
								<th colspan="4">
									<strong><?php esc_html_e( 'Custom With for Archive, Category, Blog, Tag, Search Pages & Penci Container Element','pennews' );  ?></strong>
									<span class="status-small-text"><?php esc_html_e( 'Note that: The total container width when you select here does not apply for Penci Container Element - This just apply for the width of Sidebars & Content of Penci Container element. If you want to change the width of Penci Container, you can change it on edit that element.','pennews' );  ?></span>
								</th>

							</tr>
							</thead>
							<tbody><tr><td>
							<div class="penci-ctw-wrapper">
								<div class="penci-ctw-col-wrapper penci-ctw-2col">
									<div class="penci-ctw-col-inner">
										<div class="penci-ctw-total-wrapper" data-current_w="<?php echo esc_attr( $archive_w2col_total ); ?>">
											<div class="penci-ctw-total-w">
												<span class="penci-ctw-arrow"></span>
												<span class="penci-ctw-total-val"><?php echo esc_attr( $archive_w2col_total ); ?>px</span>
											</div>
										</div>
										<div class="penci-ctw-resizable ui-resizable" data-columns="2" data-total="<?php echo esc_attr( $archive_w2col_total ); ?>">
											<div class="penci-ctw-resizable-inner">
												<div class="penci-ctw-cols">
													<div class="penci-ctw-col penci-ctw-col-main ui-resizable" style="width: <?php echo esc_attr( $archive_w2col_main ); ?>%;" data-widthprc="<?php echo esc_attr( $archive_w2col_main ); ?>" data-widthpx="<?php echo esc_attr( $archive_w2col_main_px ); ?>" data-index="1">
														<div class="penci-ctw-label">
															<span class="penci-ctw-label-per"><?php echo esc_attr( $archive_w2col_main ); ?>%</span>
															<span class="penci-ctw-label-name"><span><?php esc_html_e( 'Main content','pennews' ); ?></span></span>
															<span class="penci-ctw-label-px"><?php echo esc_attr( $archive_w2col_main_px ); ?>px</span>
														</div>
													</div>
													<div class="penci-ctw-col penci-ctw-col-sidebar1" style="width: <?php echo esc_attr( $archive_w2col_sbar1 ); ?>%;" data-widthprc="<?php echo esc_attr( $archive_w2col_sbar1 ); ?>" data-widthpx="<?php echo esc_attr( $archive_w2col_sbar1_px ); ?>" data-index="2" >
														<div class="penci-ctw-label">
															<span class="penci-ctw-label-per"><?php echo esc_attr( $archive_w2col_sbar1 ); ?>%</span>
															<span class="penci-ctw-label-name"><span><?php esc_html_e( 'Sidebar 1','pennews' ); ?></span></span>
															<span class="penci-ctw-label-px"><?php echo esc_attr( $archive_w2col_sbar1_px ); ?>px</span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<input type="hidden" class="total-width" name="penci_archive_width_2col[total]" value="<?php echo $archive_w2col_total; ?>">
										<input type="hidden" class="col-1-width" name="penci_archive_width_2col[main]" value="<?php echo $archive_w2col_main; ?>">
										<input type="hidden" class="col-2-width" name="penci_archive_width_2col[sidebar1]" value="<?php echo $archive_w2col_sbar1; ?>">
									</div>
									<a href="#" class="penci-resiable-reset button"><?php esc_html_e( 'Reset','pennews' ); ?></a>
								</div><!-- penci-ctw-col -->
								<div class="penci-ctw-col-wrapper penci-ctw-3col">
									<div class="penci-ctw-col-inner">
										<div class="penci-ctw-total-wrapper" data-current_w="<?php echo esc_attr( $archive_w3col_total ); ?>">
											<div class="penci-ctw-total-w">
												<span class="penci-ctw-arrow"></span>
												<span class="penci-ctw-total-val"><?php echo esc_attr( $archive_w3col_total ); ?>px</span>
											</div>
										</div>
										<div class="penci-ctw-resizable ui-resizable" data-columns="3" data-total="<?php echo esc_attr( $archive_w3col_total ); ?>">
											<div class="penci-ctw-resizable-inner">
												<div class="penci-ctw-cols">

													<div class="penci-ctw-col penci-ctw-col-sidebar1" style="width: <?php echo esc_attr( $archive_w3col_sbar1 ); ?>%" data-widthprc="<?php echo esc_attr( $archive_w3col_sbar1 ); ?>" data-widthpx="<?php echo esc_attr( $archive_w3col_sbar1_px ); ?>" data-index="1" >
														<div class="penci-ctw-label">
															<span class="penci-ctw-label-per"><?php echo esc_attr( $archive_w3col_sbar1 ); ?>%</span>
															<span class="penci-ctw-label-name"><span><?php esc_html_e( 'Sidebar 1','pennews' ); ?></span></span>
															<span class="penci-ctw-label-px"><?php echo esc_attr( $archive_w3col_sbar1_px ); ?>px</span>

														</div>
													</div>
													<div class="penci-ctw-col penci-ctw-col-main ui-resizable" style="width: <?php echo esc_attr( $archive_w3col_main ); ?>%" data-widthprc="<?php echo esc_attr( $archive_w3col_main ); ?>" data-widthpx="<?php echo esc_attr( $archive_w3col_main_px ); ?>" data-index="2">
														<div class="penci-ctw-label">
															<span class="penci-ctw-label-per"><?php echo esc_attr( $archive_w3col_main ); ?>%</span>
															<span class="penci-ctw-label-name"><span><?php esc_html_e( 'Main content','pennews' ); ?></span></span>
															<span class="penci-ctw-label-px"><?php echo esc_attr( $archive_w3col_main_px ); ?>px</span>
														</div>
													</div>
													<div class="penci-ctw-col penci-ctw-col-sidebar2" style="width: <?php echo esc_attr( $archive_w3col_sbar2 ); ?>%" data-widthprc="<?php echo esc_attr( $archive_w3col_sbar2 ); ?>" data-widthpx="<?php echo esc_attr( $archive_w3col_sbar2_px ); ?>" data-index="3" >
														<div class="penci-ctw-label">
															<div class="penci-ctw-label-per"><?php echo esc_attr( $archive_w3col_sbar2 ); ?>%</div>
															<div class="penci-ctw-label-name"><span><?php esc_html_e( 'Sidebar 2','pennews' ); ?></span></div>
															<div class="penci-ctw-label-px"><?php echo esc_attr( $archive_w3col_sbar2_px ); ?>px</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<input type="hidden" class="total-width" name="penci_archive_width_3col[total]" value="<?php echo $archive_w3col_total; ?>">
										<input type="hidden" class="col-1-width" name="penci_archive_width_3col[sidebar1]" value="<?php echo $archive_w3col_sbar1; ?>">
										<input type="hidden" class="col-2-width" name="penci_archive_width_3col[main]" value="<?php echo $archive_w3col_main; ?>">
										<input type="hidden" class="col-3-width" name="penci_archive_width_3col[sidebar2]" value="<?php echo $archive_w3col_sbar2; ?>">
									</div>
									<a href="#" class="penci-resiable-reset button"><?php esc_html_e( 'Reset','pennews' ); ?></a>
								</div><!-- penci-ctw-col -->
							</div><!-- wrapper -->
							</td></tr>
							<tr>
								<td>
									<div class="custom-fonts-name" style="float: left;">
									<strong><?php esc_html_e( 'Columns Gap','pennews' ); ?></strong>
									<span class="status-small-text"><?php esc_html_e( 'Enter space between columns.','pennews' ); ?></span>
									</div>
									<div class="penci-upload-font-controls">
										<input type="number" name="penci_archive_columns_gap" value="<?php echo get_theme_mod( 'penci_archive_columns_gap' ); ?>"> px
									</div>
								</td>
							</tr>
							</tbody>
						</table>
						<table class="widefat penci-table-options penci-table-options-resize-width" cellspacing="0">
							<thead>
							<tr>
								<th colspan="4"><strong><?php esc_html_e( 'Custom With for Single Pages','pennews' );  ?></strong></th>
							</tr>
							</thead>
							<tbody><tr><td>
									<div class="penci-ctw-wrapper">
										<div class="penci-ctw-col-wrapper penci-ctw-2col">
											<div class="penci-ctw-col-inner">
												<div class="penci-ctw-total-wrapper" data-current_w="<?php echo esc_attr( $single_w2col_total ); ?>">
													<div class="penci-ctw-total-w">
														<span class="penci-ctw-arrow"></span>
														<span class="penci-ctw-total-val"><?php echo esc_attr( $single_w2col_total ); ?>px</span>
													</div>
												</div>
												<div class="penci-ctw-resizable ui-resizable" data-columns="2" data-total="<?php echo esc_attr( $single_w2col_total ); ?>">
													<div class="penci-ctw-resizable-inner">
														<div class="penci-ctw-cols">
															<div class="penci-ctw-col penci-ctw-col-main ui-resizable" style="width: <?php echo esc_attr( $single_w2col_main ); ?>%;" data-widthprc="<?php echo esc_attr( $single_w2col_main ); ?>" data-widthpx="<?php echo esc_attr( $single_w2col_main_px ); ?>" data-index="1">
																<div class="penci-ctw-label">
																	<span class="penci-ctw-label-per"><?php echo esc_attr( $single_w2col_main ); ?>%</span>
																	<span class="penci-ctw-label-name"><span><?php esc_html_e( 'Main content','pennews' ); ?></span></span>
																	<span class="penci-ctw-label-px"><?php echo esc_attr( $single_w2col_main_px ); ?>px</span>
																</div>
															</div>
															<div class="penci-ctw-col  penci-ctw-col-sidebar1" style="width: <?php echo esc_attr( $single_w2col_sbar1 ); ?>%;" data-widthprc="<?php echo esc_attr( $single_w2col_sbar1 ); ?>" data-widthpx="<?php echo esc_attr( $single_w2col_sbar1_px ); ?>" data-index="2" >
																<div class="penci-ctw-label">
																	<span class="penci-ctw-label-per"><?php echo esc_attr( $single_w2col_sbar1 ); ?>%</span>
																	<span class="penci-ctw-label-name"><span><?php esc_html_e( 'Sidebar 1','pennews' ); ?></span></span>
																	<span class="penci-ctw-label-px"><?php echo esc_attr( $single_w2col_sbar1_px ); ?>px</span>
																</div>
															</div>
														</div>
													</div>
												</div>
												<input type="hidden" class="total-width" name="penci_single_width_2col[total]" value="<?php echo $single_w2col_total; ?>">
												<input type="hidden" class="col-1-width" name="penci_single_width_2col[main]" value="<?php echo $single_w2col_main; ?>">
												<input type="hidden" class="col-2-width" name="penci_single_width_2col[sidebar1]" value="<?php echo $single_w2col_sbar1; ?>">
											</div>
											<a href="#" class="penci-resiable-reset button"><?php esc_html_e( 'Reset','pennews' ); ?></a>
										</div><!-- penci-ctw-col -->
										<div class="penci-ctw-col-wrapper penci-ctw-3col">
											<div class="penci-ctw-col-inner">
												<div class="penci-ctw-total-wrapper" data-current_w="<?php echo esc_attr( $single_w3col_total ); ?>">
													<div class="penci-ctw-total-w">
														<span class="penci-ctw-arrow"></span>
														<span class="penci-ctw-total-val"><?php echo esc_attr( $single_w3col_total ); ?>px</span>
													</div>
												</div>
												<div class="penci-ctw-resizable ui-resizable" data-columns="3" data-total="<?php echo esc_attr( $single_w3col_total ); ?>">
													<div class="penci-ctw-resizable-inner">
														<div class="penci-ctw-cols">

															<div class="penci-ctw-col penci-ctw-col-sidebar1" style="width: <?php echo esc_attr( $single_w3col_sbar1 ); ?>%" data-widthprc="<?php echo esc_attr( $single_w3col_sbar1 ); ?>" data-widthpx="<?php echo esc_attr( $single_w3col_sbar1_px ); ?>" data-index="1" >
																<div class="penci-ctw-label">
																	<span class="penci-ctw-label-per"><?php echo esc_attr( $single_w3col_sbar1 ); ?>%</span>
																	<span class="penci-ctw-label-name"><span><?php esc_html_e( 'Sidebar 1','pennews' ); ?></span></span>
																	<span class="penci-ctw-label-px"><?php echo esc_attr( $single_w3col_sbar1_px ); ?>px</span>

																</div>
															</div>
															<div class="penci-ctw-col penci-ctw-col-main ui-resizable" style="width: <?php echo esc_attr( $single_w3col_main ); ?>%" data-widthprc="<?php echo esc_attr( $single_w3col_main ); ?>" data-widthpx="<?php echo esc_attr( $single_w3col_main_px ); ?>" data-index="2">
																<div class="penci-ctw-label">
																	<span class="penci-ctw-label-per"><?php echo esc_attr( $single_w3col_main ); ?>%</span>
																	<span class="penci-ctw-label-name"><span><?php esc_html_e( 'Main content','pennews' ); ?></span></span>
																	<span class="penci-ctw-label-px"><?php echo esc_attr( $single_w3col_main_px ); ?>px</span>
																</div>
															</div>
															<div class="penci-ctw-col penci-ctw-col-sidebar2" style="width: <?php echo esc_attr( $single_w3col_sbar2 ); ?>%" data-widthprc="<?php echo esc_attr( $single_w3col_sbar2 ); ?>" data-widthpx="<?php echo esc_attr( $single_w3col_sbar2_px ); ?>" data-index="3" >
																<div class="penci-ctw-label">
																	<div class="penci-ctw-label-per"><?php echo esc_attr( $single_w3col_sbar2 ); ?>%</div>
																	<div class="penci-ctw-label-name"><span><?php esc_html_e( 'Sidebar 2','pennews' ); ?></span></div>
																	<div class="penci-ctw-label-px"><?php echo esc_attr( $single_w3col_sbar2_px ); ?>px</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<input type="hidden" class="total-width" name="penci_single_width_3col[total]" value="<?php echo $single_w3col_total; ?>">
												<input type="hidden" class="col-1-width" name="penci_single_width_3col[sidebar1]" value="<?php echo $single_w3col_sbar1; ?>">
												<input type="hidden" class="col-2-width" name="penci_single_width_3col[main]" value="<?php echo $single_w3col_main; ?>">
												<input type="hidden" class="col-3-width" name="penci_single_width_3col[sidebar2]" value="<?php echo $single_w3col_sbar2; ?>">
											</div>
											<a href="#" class="penci-resiable-reset button"><?php esc_html_e( 'Reset','pennews' ); ?></a>
										</div><!-- penci-ctw-col -->
									</div><!-- wrapper -->
								</td></tr>
								<tr>
									<td>
										<div class="custom-fonts-name" style="float: left;">
											<strong><?php esc_html_e( 'Columns Gap','pennews' ); ?></strong>
											<span class="status-small-text"><?php esc_html_e( 'Enter space between columns.','pennews' ); ?></span>
										</div>
										<div class="penci-upload-font-controls">
											<input type="number" name="penci_single_columns_gap" value="<?php echo get_theme_mod( 'penci_single_columns_gap' ); ?>"> px
										</div>
									</td>
								</tr>
							</tbody>
						</table>

						<input type="hidden" name="_page" value="pennews_custom_width">
						<?php submit_button(); ?>

					</form>
				</div>
			</div>
			<?php
		}

		/**
		 * Converts string to array. Filters empty arrays values
		 *
		 * @param $value
		 *
		 * @return array
		 */
		protected static function stringToArray( $value ) {
			$valid_values = array();
			$list         = preg_split( '/\,[\s]*/', $value );
			foreach ( $list as $v ) {
				if ( strlen( $v ) > 0 ) {
					$valid_values[] = $v;
				}
			}

			return $valid_values;
		}

		public static function parseData( $value ) {
			$data         = array();
			$values_pairs = preg_split( '/\|/', $value );
			foreach ( $values_pairs as $pair ) {
				if ( ! empty( $pair ) ) {
					list( $key, $value ) = preg_split( '/\:/', $pair );
					$data[ $key ] = $value;
				}
			}

			return $data;
		}

		/**
		 * @param $settings
		 *
		 * @return string
		 */
		public static function buildDefault( $settings ) {

			if ( ! is_array( $settings ) ) {
				return '';
			}
			$value = '';
			foreach ( $settings as $key => $val ) {
				if ( isset( $val ) ) {
					$value .= ( empty( $value ) ? '' : '|' ) . $key . ':' . $val;
				}
			}

			return $value;
		}
	}
endif;
new Penci_Resizable_Width;