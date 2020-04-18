<?php
/**
 * System status section.
 *
 * @package pennews
 */

?>
<h2 class="nav-tab-wrapper">
	<a href="<?php echo admin_url( 'admin.php?page=pennews_dashboard_welcome' ) ?>" class="nav-tab"><?php esc_html_e( 'Getting started', 'pennews' ); ?></a>
	<a href="<?php echo admin_url( 'customize.php' ) ?>" class="nav-tab"><?php esc_html_e( 'Customize Style', 'pennews' ); ?></a>
	<?php if ( !defined('ENVATO_HOSTED_SITE') ): ?>
	<a href="<?php echo admin_url( 'admin.php?page=pennews_system_status' ) ?>" class="nav-tab nav-tab-active"><?php esc_html_e( 'System status', 'pennews' ); ?></a>
	<?php endif; ?>
	<a href="<?php echo admin_url( 'admin.php?page=pennews_custom_fonts' ) ?>" class="nav-tab"><?php esc_html_e( 'Fonts options', 'pennews' ); ?></a>
	<a href="<?php echo admin_url( 'admin.php?page=pennews_migrator' ) ?>" class="nav-tab"><?php esc_html_e( 'Migrator Data', 'pennews' ); ?></a>
	<?php if( ! penci_pennews_is_activated() ): ?>
    <a href="<?php echo admin_url( 'admin.php?page=pennews_active_theme' ) ?>" class="nav-tab"><?php esc_html_e( 'Active theme', 'pennews' ); ?></a>
    <?php endif; ?>
</h2>

<div id="system_status" class="gt-tab-pane">
	<h3><?php esc_html_e( 'PenNews system status', 'pennews' ); ?></h3>
		<p><?php esc_html_e( 'Here you can check the system status. Yellow status means that the site will work as expected on the front end but it may cause problems in wp-admin.', 'pennews' ); ?></p>
	<div class="feature-section">

		<?php foreach ( $this->system_status as $section_name => $section_statuses): ?>
            <table class="widefat" cellspacing="0">
                <thead>
                    <tr>
                       <th colspan="4"><?php echo ( $section_name ); ?></th>
                    </tr>
                </thead>
                <tbody>
           		<?php foreach ($section_statuses as $status_params) : ?>
                    <tr>
                        <td class="system-status-name"><?php echo ( $status_params['check_name'] ); ?></td>

                        <td class="system-status-status">
                            <?php
                                switch ($status_params['status']) {
                                    case 'green':
                                        echo '<div class="system-status-green penci-tooltip" data-position="right"></div>';
                                        break;
                                    case 'yellow':
                                        echo '<div class="system-status-yellow penci-tooltip" data-position="right"></div>';
                                        break;
                                    case 'red' :
                                        echo '<div class="system-status-red penci-tooltip" data-position="right"></div>';
                                        break;
                                    case 'info':
                                        echo '<div class="system-status-info penci-tooltip" data-position="right">i</div>';
                                        break;
                                }
                            ?>
                        </td>
                        <td class="system-status-value"><?php echo ( $status_params['value'] ) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endforeach; ?>
	</div>
</div>
