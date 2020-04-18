<?php

if (!defined('ABSPATH')) exit;

?><div class="elfsight-admin-menu-actions">
	<div class="elfsight-admin-menu-actions-activation-container">
		<span class="elfsight-admin-menu-actions-activation-label"><?php esc_html_e('CodeCanyon License:', $this->textDomain); ?></span>
		<a class="elfsight-admin-menu-actions-activation-status" href="#/activation/" data-elfsight-admin-page="activation"><?php esc_html_e('Not Activated', $this->textDomain); ?></span>

    	<a class="elfsight-admin-menu-actions-activation-button elfsight-admin-button-black elfsight-admin-button-border elfsight-admin-button" href="#/activation/" data-elfsight-admin-page="activation"><?php esc_html_e('Activate License', $this->textDomain); ?></a>
	</div>

    <?php if ($has_new_version) {?>
        <span class="elfsight-admin-menu-actions-update-container">
        	<span class="elfsight-admin-menu-actions-update-label"><?php esc_html_e('A new version is available', $this->textDomain); ?></span>

        	<a class="elfsight-admin-menu-actions-update elfsight-admin-button-green elfsight-admin-button" href="<?php echo is_multisite() ? network_admin_url('update-core.php') : admin_url('update-core.php'); ?>"><?php esc_html_e('Update to', $this->textDomain); ?> <?php echo esc_html($latest_version); ?></a>
    	</span>
    <?php }?>
</div>