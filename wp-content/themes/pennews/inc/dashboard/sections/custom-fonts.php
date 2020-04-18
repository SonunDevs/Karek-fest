<?php
/**
 * Getting started section.
 *
 * @package pennews
 */

?>
<h2 class="nav-tab-wrapper">
	<a href="<?php echo admin_url( 'admin.php?page=pennews_dashboard_welcome' ) ?>" class="nav-tab"><?php esc_html_e( 'Getting started', 'pennews' ); ?></a>
	<a href="<?php echo admin_url( 'customize.php' ) ?>" class="nav-tab"><?php esc_html_e( 'Customize Style', 'pennews' ); ?></a>
	<?php if ( !defined('ENVATO_HOSTED_SITE') ): ?>
		<a href="<?php echo admin_url( 'admin.php?page=pennews_system_status' ) ?>" class="nav-tab"><?php esc_html_e( 'System status', 'pennews' ); ?></a>
	<?php endif; ?>
	<a href="<?php echo admin_url( 'admin.php?page=pennews_custom_fonts' ) ?>" class="nav-tab nav-tab-active"><?php esc_html_e( 'Fonts options', 'pennews' ); ?></a>
	<a href="<?php echo admin_url( 'admin.php?page=pennews_migrator' ) ?>" class="nav-tab"><?php esc_html_e( 'Migrator Data', 'pennews' ); ?></a>
	<?php if( ! penci_pennews_is_activated() ): ?>
	<a href="<?php echo admin_url( 'admin.php?page=pennews_active_theme' ) ?>" class="nav-tab"><?php esc_html_e( 'Active theme', 'pennews' ); ?></a>
	<?php endif; ?>
</h2>

<div id="penci-custom-fonts" class="gt-tab-pane gt-is-active">

	<form method="post" action="options.php">
		<table class="widefat penci-table-options penci-table-options-fontgoogle" cellspacing="0">
			<thead>
			<tr><th colspan="4">
					<h4 style="margin: 6px 0 15px 0; font-weight: bold; font-size: 20px;"><?php esc_html_e( 'Add More Google Fonts To Select Options of Fonts','pennews' ); ?></h4>
				</th></tr>
			</thead>
			<tbody>
			<tr class="<?php echo get_option('pennews_enable_all_fontgoogle') ? "penmews-hide-option" : ""?>">
				<td class="custom-fonts-name">
					<strong><?php esc_html_e( 'Select Multiple Fonts To Add','pennews' ); ?></strong>
					</td>
				<td class="custom-fonts-value">
					<div class="penci-upload-font-controls">
						<?php
						$all_fonts  = array_merge( penci_list_google_fonts_array(), penci_font_browser() );
						?>
						<div class="ui fluid multiple search selection dropdown">
							<input name="pennews_custom_fontgoogle" type="hidden" value="<?php esc_attr( get_option('pennews_custom_fontgoogle') ); ?>">
							<i class="dropdown icon"></i>
							<div class="default text"></div>
							<div class="menu">
								<?php
								foreach ( $all_fonts as $font_id => $font_name ){
									printf( '<div class="item" data-value="%s">%s</div>', esc_attr( $font_id ), esc_html( $font_name ) );
								}
								?>
							</div>
						</div>
						<div class="penci-clear-font button" style="margin-top: 5px;"><?php esc_html_e( 'Clear','pennews' ); ?></div>
						<span class="status-small-text"><?php echo 'By default, this theme supports you some fonts on the fonts select options ( check <a target="_blank" href="https://image.prntscr.com/image/w5yfNtgcSLa2HEwbNEqRpA.png"> this image</a> to know what is fonts select options ), It helps you can easy to select the fonts you picked. This option will help you add more fonts to that select options'; ?></span>
					</div>
				</td>
			</tr>
			<tr>
				<td class="custom-fonts-name">
					<strong><?php esc_html_e( 'Enable all fonts google','pennews' ); ?></strong>
					</td>
				<td class="custom-fonts-value">
					<div class="penci-upload-font-controls">
						<input type="checkbox" id="pennews_enable_all_fontgoogle" name="pennews_enable_all_fontgoogle" value="true" class="depth-1" <?php echo (  get_option( 'pennews_enable_all_fontgoogle' ) ?  " checked='checked' " : "" )  ?>>
						<span class="status-small-text"><?php esc_html_e( 'This option will enable all google fonts for fonts select options, but It will make your Visual Composer elements load slower. We do not recommend you do this', 'pennews' ); ?></span>
					</div>
				</td>
			</tr>
			</tbody>
		</table>

		<table class="widefat penci-table-options" cellspacing="0">
			<thead>
			<tr><th colspan="4">
					<h4 style="margin: 6px 0 15px 0; font-weight: bold; font-size: 20px;"><?php esc_html_e( 'Custom font files','pennews' ); ?></h4>
					<p class="description">
						<?php esc_html_e( 'You can generate your font file and format into .woff using','pennews' ); ?>
						<a href="<?php echo esc_url( 'http://www.fontsquirrel.com/tools/webfont-generator' ); ?>"><?php esc_html_e( 'fontsquirrel','pennews' ); ?></a>
						<?php esc_html_e( '(free tool)','pennews' ); ?>
						<br>
						<?php esc_html_e( 'You will need to refresh your customizer to see your font on the font list.','pennews' ); ?>
					</p>
				</th></tr>
			</thead>
			<tbody>
			<tr>
				<td class="custom-fonts-name">
					<strong><?php esc_html_e( 'Custom font file 1','pennews' ); ?></strong>
					<span class="status-small-text"><?php esc_html_e( 'Upload the link to the file ( .woff format )','pennews' ); ?></span>
				</td>
				<td class="custom-fonts-value">
					<div class="penci-upload-font-controls">
						<?php
						$unique_id_1 = 'pennews-cf1';
						?>
						<input id="<?php echo esc_attr( $unique_id_1 ); ?>" style="width: 100%" type="text" class="penci-upload-link-font" name="pennews_custom_font1" value="<?php echo esc_attr( penci_get_option('pennews_custom_font1') ); ?>" />
						<div class="penci-upload-font-actions">
							<a id="<?php echo esc_attr( $unique_id_1 ); ?>-button-upload" class="button button-upload"><?php esc_html_e( 'Upload','pennews' ); ?></a>
							<a id="<?php echo esc_attr( $unique_id_1 ); ?>-button-delete" class="button button-remove <?php echo ( ! penci_get_option('pennews_custom_font1') ? 'button-hide' : '' ); ?>"><?php esc_html_e( 'Remove','pennews' ); ?></a>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td class="custom-fonts-name">
					<?php esc_html_e( 'Custom font family 1','pennews' ); ?>
					<span class="status-small-text"><?php esc_html_e( 'The font name you can find','pennews' ); ?></span>
				</td>
				<td class="custom-fonts-value">
					<input id="<?php echo esc_attr( $unique_id_1 ); ?>family" style="width: 50%" type="text" class="penci-upload-link-font" name="pennews_custom_fontfamily1" value="<?php echo esc_attr( penci_get_option('pennews_custom_fontfamily1') ); ?>" />

				</td>
			</tr>
			<tr>
				<td class="custom-fonts-name">
					<?php esc_html_e( 'Custom font file 2','pennews' ); ?>
					<span class="status-small-text"><?php esc_html_e( 'Upload the link to the file ( .woff format )','pennews' ); ?></span>
				</td>
				<td class="custom-fonts-value">
					<div class="penci-upload-font-controls">
						<?php
						$unique_id_2 = 'pennews-cf2';
						?>
						<input id="<?php echo esc_attr( $unique_id_2 ); ?>" style="width: 100%" type="text" class="penci-upload-link-font" name="pennews_custom_font2" value="<?php echo esc_attr( penci_get_option('pennews_custom_font2') ); ?>" />
						<div class="penci-upload-font-actions">
							<a id="<?php echo esc_attr( $unique_id_2 ); ?>-button-upload" class="button button-upload"><?php esc_html_e( 'Upload','pennews' ); ?></a>
							<a id="<?php echo esc_attr( $unique_id_2 ); ?>-button-delete" class="button button-remove <?php echo ( ! penci_get_option('pennews_custom_font2') ? 'button-hide' : '' ); ?>"><?php esc_html_e( 'Remove','pennews' ); ?></a>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td class="custom-fonts-name">
					<?php esc_html_e( 'Custom font family 2','pennews' ); ?>
					<span class="status-small-text"><?php esc_html_e( 'The font name you can find','pennews' ); ?></span>
				</td>
				<td class="custom-fonts-value">
					<input id="<?php echo esc_attr( $unique_id_2 ); ?>family" style="width: 50%" type="text" class="penci-upload-link-font" name="pennews_custom_fontfamily2" value="<?php echo esc_attr( penci_get_option('pennews_custom_fontfamily2') ); ?>" />

				</td>
			</tr>
			<tr>
				<td class="custom-fonts-name">
					<?php esc_html_e( 'Custom font file 3','pennews' ); ?>
					<span class="status-small-text"><?php esc_html_e( 'Upload the link to the file ( .woff format )','pennews' ); ?></span>
				</td>
				<td class="custom-fonts-value">
					<div class="penci-upload-font-controls">
						<?php
						$unique_id_3 = 'pennews-cf3';
						?>
						<input id="<?php echo esc_attr( $unique_id_3 ); ?>" style="width: 100%" type="text" class="penci-upload-link-font" name="pennews_custom_font3" value="<?php echo esc_attr( penci_get_option('pennews_custom_font3') ); ?>" />
						<div class="penci-upload-font-actions">
							<a id="<?php echo esc_attr( $unique_id_3 ); ?>-button-upload" class="button button-upload"><?php esc_html_e( 'Upload','pennews' ); ?></a>
							<a id="<?php echo esc_attr( $unique_id_3 ); ?>-button-delete" class="button button-remove <?php echo ( ! penci_get_option('pennews_custom_font3') ? 'button-hide' : '' ); ?>"><?php esc_html_e( 'Remove','pennews' ); ?></a>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td class="custom-fonts-name">
					<?php esc_html_e( 'Custom font family 3','pennews' ); ?>
					<span class="status-small-text"><?php esc_html_e( 'The font name you can find','pennews' ); ?></span>
				</td>
				<td class="custom-fonts-value">
					<input id="<?php echo esc_attr( $unique_id_3 ); ?>family" style="width: 50%" type="text" class="penci-upload-link-font" name="pennews_custom_fontfamily3" value="<?php echo esc_attr( penci_get_option('pennews_custom_fontfamily3') ); ?>" />

				</td>
			</tr>
			<!-- 4 -->
			<tr>
				<td class="custom-fonts-name">
					<?php esc_html_e( 'Custom font file 4','pennews' ); ?>
					<span class="status-small-text"><?php esc_html_e( 'Upload the link to the file ( .woff format )','pennews' ); ?></span>
				</td>
				<td class="custom-fonts-value">
					<div class="penci-upload-font-controls">
						<?php
						$unique_id_4 = 'pennews-cf4';
						?>
						<input id="<?php echo esc_attr( $unique_id_4 ); ?>" style="width: 100%" type="text" class="penci-upload-link-font" name="pennews_custom_font4" value="<?php echo esc_attr( penci_get_option('pennews_custom_font4') ); ?>" />
						<div class="penci-upload-font-actions">
							<a id="<?php echo esc_attr( $unique_id_4 ); ?>-button-upload" class="button button-upload"><?php esc_html_e( 'Upload','pennews' ); ?></a>
							<a id="<?php echo esc_attr( $unique_id_4 ); ?>-button-delete" class="button button-remove <?php echo ( ! penci_get_option('pennews_custom_font4') ? 'button-hide' : '' ); ?>"><?php esc_html_e( 'Remove','pennews' ); ?></a>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td class="custom-fonts-name">
					<?php esc_html_e( 'Custom font family 4','pennews' ); ?>
					<span class="status-small-text"><?php esc_html_e( 'The font name you can find','pennews' ); ?></span>
				</td>
				<td class="custom-fonts-value">
					<input id="<?php echo esc_attr( $unique_id_4 ); ?>family" style="width: 50%" type="text" class="penci-upload-link-font" name="pennews_custom_fontfamily4" value="<?php echo esc_attr( penci_get_option('pennews_custom_fontfamily4') ); ?>" />

				</td>
			</tr>
			<!-- 5 -->
			<tr>
				<td class="custom-fonts-name">
					<?php esc_html_e( 'Custom font file 5','pennews' ); ?>
					<span class="status-small-text"><?php esc_html_e( 'Upload the link to the file ( .woff format )','pennews' ); ?></span>
				</td>
				<td class="custom-fonts-value">
					<div class="penci-upload-font-controls">
						<?php
						$unique_id_5 = 'pennews-cf5';
						?>
						<input id="<?php echo esc_attr( $unique_id_5 ); ?>" style="width: 100%" type="text" class="penci-upload-link-font" name="pennews_custom_font5" value="<?php echo esc_attr( penci_get_option('pennews_custom_font5') ); ?>" />
						<div class="penci-upload-font-actions">
							<a id="<?php echo esc_attr( $unique_id_5 ); ?>-button-upload" class="button button-upload"><?php esc_html_e( 'Upload','pennews' ); ?></a>
							<a id="<?php echo esc_attr( $unique_id_5 ); ?>-button-delete" class="button button-remove <?php echo ( ! penci_get_option('pennews_custom_font5') ? 'button-hide' : '' ); ?>"><?php esc_html_e( 'Remove','pennews' ); ?></a>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td class="custom-fonts-name">
					<?php esc_html_e( 'Custom font family 5','pennews' ); ?>
					<span class="status-small-text"><?php esc_html_e( 'The font name you can find','pennews' ); ?></span>
				</td>
				<td class="custom-fonts-value">
					<input id="<?php echo esc_attr( $unique_id_5 ); ?>family" style="width: 50%" type="text" class="penci-upload-link-font" name="pennews_custom_fontfamily5" value="<?php echo esc_attr( penci_get_option('pennews_custom_fontfamily5') ); ?>" />

				</td>
			</tr>
			<!-- 6 -->
			<tr>
				<td class="custom-fonts-name">
					<?php esc_html_e( 'Custom font file 6','pennews' ); ?>
					<span class="status-small-text"><?php esc_html_e( 'Upload the link to the file ( .woff format )','pennews' ); ?></span>
				</td>
				<td class="custom-fonts-value">
					<div class="penci-upload-font-controls">
						<?php
						$unique_id_6 = 'pennews-cf6';
						?>
						<input id="<?php echo esc_attr( $unique_id_6 ); ?>" style="width: 100%" type="text" class="penci-upload-link-font" name="pennews_custom_font6" value="<?php echo esc_attr( penci_get_option('pennews_custom_font6') ); ?>" />
						<div class="penci-upload-font-actions">
							<a id="<?php echo esc_attr( $unique_id_6 ); ?>-button-upload" class="button button-upload"><?php esc_html_e( 'Upload','pennews' ); ?></a>
							<a id="<?php echo esc_attr( $unique_id_6 ); ?>-button-delete" class="button button-remove <?php echo ( ! penci_get_option('pennews_custom_font6') ? 'button-hide' : '' ); ?>"><?php esc_html_e( 'Remove','pennews' ); ?></a>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td class="custom-fonts-name">
					<?php esc_html_e( 'Custom font family 6','pennews' ); ?>
					<span class="status-small-text"><?php esc_html_e( 'The font name you can find','pennews' ); ?></span>
				</td>
				<td class="custom-fonts-value">
					<input id="<?php echo esc_attr( $unique_id_6 ); ?>family" style="width: 50%" type="text" class="penci-upload-link-font" name="pennews_custom_fontfamily6" value="<?php echo esc_attr( penci_get_option('pennews_custom_fontfamily6') ); ?>" />

				</td>
			</tr>
			<!-- 7 -->
			<tr>
				<td class="custom-fonts-name">
					<?php esc_html_e( 'Custom font file 7','pennews' ); ?>
					<span class="status-small-text"><?php esc_html_e( 'Upload the link to the file ( .woff format )','pennews' ); ?></span>
				</td>
				<td class="custom-fonts-value">
					<div class="penci-upload-font-controls">
						<?php
						$unique_id_7 = 'pennews-cf7';
						?>
						<input id="<?php echo esc_attr( $unique_id_7 ); ?>" style="width: 100%" type="text" class="penci-upload-link-font" name="pennews_custom_font7" value="<?php echo esc_attr( penci_get_option('pennews_custom_font7') ); ?>" />
						<div class="penci-upload-font-actions">
							<a id="<?php echo esc_attr( $unique_id_7 ); ?>-button-upload" class="button button-upload"><?php esc_html_e( 'Upload','pennews' ); ?></a>
							<a id="<?php echo esc_attr( $unique_id_7 ); ?>-button-delete" class="button button-remove <?php echo ( ! penci_get_option('pennews_custom_font7') ? 'button-hide' : '' ); ?>"><?php esc_html_e( 'Remove','pennews' ); ?></a>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td class="custom-fonts-name">
					<?php esc_html_e( 'Custom font family 7','pennews' ); ?>
					<span class="status-small-text"><?php esc_html_e( 'The font name you can find','pennews' ); ?></span>
				</td>
				<td class="custom-fonts-value">
					<input id="<?php echo esc_attr( $unique_id_7 ); ?>family" style="width: 50%" type="text" class="penci-upload-link-font" name="pennews_custom_fontfamily7" value="<?php echo esc_attr( penci_get_option('pennews_custom_fontfamily7') ); ?>" />

				</td>
			</tr>
			<!-- 8 -->
			<tr>
				<td class="custom-fonts-name">
					<?php esc_html_e( 'Custom font file 8','pennews' ); ?>
					<span class="status-small-text"><?php esc_html_e( 'Upload the link to the file ( .woff format )','pennews' ); ?></span>
				</td>
				<td class="custom-fonts-value">
					<div class="penci-upload-font-controls">
						<?php
						$unique_id_8 = 'pennews-cf8';
						?>
						<input id="<?php echo esc_attr( $unique_id_8 ); ?>" style="width: 100%" type="text" class="penci-upload-link-font" name="pennews_custom_font8" value="<?php echo esc_attr( penci_get_option('pennews_custom_font8') ); ?>" />
						<div class="penci-upload-font-actions">
							<a id="<?php echo esc_attr( $unique_id_8 ); ?>-button-upload" class="button button-upload"><?php esc_html_e( 'Upload','pennews' ); ?></a>
							<a id="<?php echo esc_attr( $unique_id_8 ); ?>-button-delete" class="button button-remove <?php echo ( ! penci_get_option('pennews_custom_font8') ? 'button-hide' : '' ); ?>"><?php esc_html_e( 'Remove','pennews' ); ?></a>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td class="custom-fonts-name">
					<?php esc_html_e( 'Custom font family 8','pennews' ); ?>
					<span class="status-small-text"><?php esc_html_e( 'The font name you can find','pennews' ); ?></span>
				</td>
				<td class="custom-fonts-value">
					<input id="<?php echo esc_attr( $unique_id_8 ); ?>family" style="width: 50%" type="text" class="penci-upload-link-font" name="pennews_custom_fontfamily8" value="<?php echo esc_attr( penci_get_option('pennews_custom_fontfamily8') ); ?>" />

				</td>
			</tr>
			<!-- 9 -->
			<tr>
				<td class="custom-fonts-name">
					<?php esc_html_e( 'Custom font file 9','pennews' ); ?>
					<span class="status-small-text"><?php esc_html_e( 'Upload the link to the file ( .woff format )','pennews' ); ?></span>
				</td>
				<td class="custom-fonts-value">
					<div class="penci-upload-font-controls">
						<?php
						$unique_id_9 = 'pennews-cf9';
						?>
						<input id="<?php echo esc_attr( $unique_id_9 ); ?>" style="width: 100%" type="text" class="penci-upload-link-font" name="pennews_custom_font9" value="<?php echo esc_attr( penci_get_option('pennews_custom_font9') ); ?>" />
						<div class="penci-upload-font-actions">
							<a id="<?php echo esc_attr( $unique_id_9 ); ?>-button-upload" class="button button-upload"><?php esc_html_e( 'Upload','pennews' ); ?></a>
							<a id="<?php echo esc_attr( $unique_id_9 ); ?>-button-delete" class="button button-remove <?php echo ( ! penci_get_option('pennews_custom_font9') ? 'button-hide' : '' ); ?>"><?php esc_html_e( 'Remove','pennews' ); ?></a>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td class="custom-fonts-name">
					<?php esc_html_e( 'Custom font family 9','pennews' ); ?>
					<span class="status-small-text"><?php esc_html_e( 'The font name you can find','pennews' ); ?></span>
				</td>
				<td class="custom-fonts-value">
					<input id="<?php echo esc_attr( $unique_id_9 ); ?>family" style="width: 50%" type="text" class="penci-upload-link-font" name="pennews_custom_fontfamily9" value="<?php echo esc_attr( penci_get_option('pennews_custom_fontfamily9') ); ?>" />

				</td>
			</tr>
			<!-- 10 -->
			<tr>
				<td class="custom-fonts-name">
					<?php esc_html_e( 'Custom font file 10','pennews' ); ?>
					<span class="status-small-text"><?php esc_html_e( 'Upload the link to the file ( .woff format )','pennews' ); ?></span>
				</td>
				<td class="custom-fonts-value">
					<div class="penci-upload-font-controls">
						<?php
						$unique_id_10 = 'pennews-cf10';
						?>
						<input id="<?php echo esc_attr( $unique_id_10 ); ?>" style="width: 100%" type="text" class="penci-upload-link-font" name="pennews_custom_font10" value="<?php echo esc_attr( penci_get_option('pennews_custom_font10') ); ?>" />
						<div class="penci-upload-font-actions">
							<a id="<?php echo esc_attr( $unique_id_10 ); ?>-button-upload" class="button button-upload"><?php esc_html_e( 'Upload','pennews' ); ?></a>
							<a id="<?php echo esc_attr( $unique_id_10 ); ?>-button-delete" class="button button-remove <?php echo ( ! penci_get_option('pennews_custom_font10') ? 'button-hide' : '' ); ?>"><?php esc_html_e( 'Remove','pennews' ); ?></a>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td class="custom-fonts-name">
					<?php esc_html_e( 'Custom font family 10','pennews' ); ?>
					<span class="status-small-text"><?php esc_html_e( 'The font name you can find','pennews' ); ?></span>
				</td>
				<td class="custom-fonts-value">
					<input id="<?php echo esc_attr( $unique_id_10 ); ?>family" style="width: 50%" type="text" class="penci-upload-link-font" name="pennews_custom_fontfamily10" value="<?php echo esc_attr( penci_get_option('pennews_custom_fontfamily10') ); ?>" />

				</td>
			</tr>
			</tbody>
		</table>
		
		<input type="hidden" name="_page" value="pennews_custom_fonts">

		<?php submit_button(); ?>

	</form>

</div>
