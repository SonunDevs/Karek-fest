<?php

if (!defined('ABSPATH')) exit;

?>
<article class="elfsight-admin-page-support elfsight-admin-page" data-elfsight-admin-page-id="support">
    <div class="elfsight-admin-page-support-blocked">
        <div class="elfsight-admin-page-heading elfsight-admin-page-support-heading">
            <h2><?php esc_html_e('Support', $this->textDomain); ?></h2>

            <svg class="elfsight-admin-page-support-blocked-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="12" height="15" viewBox="0 0 12 15"><defs><path id="bikla" d="M7.55 8.73h.63v-.91a3.82 3.82 0 1 1 7.63 0v.9h.65c1.05 0 1.9 1.07 1.9 2.38v5.53c0 1.3-.85 2.37-1.9 2.37H7.55c-1.06 0-1.91-1.06-1.91-2.37V11.1c0-1.31.85-2.37 1.9-2.37zm7-.91a2.54 2.54 0 1 0-5.1 0v.9h5.1zM12 14.86a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></defs><g><g transform="translate(-5.64 -4)"><use xlink:href="#bikla"/></g></g></svg>
        </div>

        <div class="elfsight-admin-page-support-blocked-message">
            <div class="elfsight-admin-page-support-blocked-message-content">
                <div class="elfsight-admin-page-support-blocked-message-badge"><?php esc_html_e('Unlock', $this->textDomain); ?></div>

                <h3 class="elfsight-admin-page-support-blocked-message-title"><?php esc_html_e('Support section is only available for CodeCanyon clients with activated license', $this->textDomain); ?></h3>

                <div class="elfsight-admin-page-support-blocked-message-text">
                    <?php
                        printf(
                            /* translators: %1$s: link */
                            esc_html__('To unlock the in-plugin support, please, activate your license by entering CodeCanyon purchase code of the %1$s.', $this->textDomain),
                            sprintf(
                                '<a href="%s" target="_blank">%s</a>',
                                $this->productUrl,
                                esc_html__('plugin', $this->textDomain)
                            )
                        );
                    ?>
                </div>

                <div class="elfsight-admin-page-support-blocked-message-action">
                    <a class="elfsight-admin-button-large elfsight-admin-button-black elfsight-admin-button" href="#/activation/" data-elfsight-admin-page="activation"><?php esc_html_e('Activate License', $this->textDomain); ?></a>
                </div>
            </div>

            <div class="elfsight-admin-page-support-blocked-message-image">
                <img src="<?php echo plugins_url('assets/img/support-blocked.jpg', $this->pluginFile); ?>">
            </div>
        </div>
    </div>

    <div class="elfsight-admin-page-support-unblocked">
        <div class="elfsight-admin-page-heading">
            <h2><?php esc_html_e('Support', $this->textDomain); ?></h2>

            <div class="elfsight-admin-page-heading-subheading">
                <?php esc_html_e('We understand all the importance of product support for our customers. That’s why we are ready to solve all your issues and answer any questions related to our plugin.', $this->textDomain); ?>
            </div>
        </div>

        <div class="elfsight-admin-divider"></div>

        <div class="elfsight-admin-page-support-ticket">
            <h4><?php esc_html_e('Before submitting a ticket, make sure that', $this->textDomain); ?></h4>

            <ul class="elfsight-admin-page-support-ticket-steps">
                <li class="elfsight-admin-page-support-ticket-steps-item-latest-version elfsight-admin-page-support-ticket-steps-item">
                    <span class="elfsight-admin-page-support-ticket-steps-item-icon">
                        <span class="elfsight-admin-icon-support-latest-version elfsight-admin-icon"></span>
                    </span>

                    <span class="elfsight-admin-page-support-ticket-steps-item-label"><?php esc_html_e('You use the latest version.', $this->textDomain); ?></span>
                </li>

                <li class="elfsight-admin-page-support-ticket-steps-item-javascript-errors elfsight-admin-page-support-ticket-steps-item">
                    <span class="elfsight-admin-page-support-ticket-steps-item-icon">
                        <span class="elfsight-admin-icon-support-javascript-errors elfsight-admin-icon"></span>
                    </span>

                    <span class="elfsight-admin-page-support-ticket-steps-item-label"><?php esc_html_e('There are no javascript errors on your website.', $this->textDomain); ?></span>
                </li>

                <li class="elfsight-admin-page-support-ticket-steps-item-documentation elfsight-admin-page-support-ticket-steps-item">
                    <span class="elfsight-admin-page-support-ticket-steps-item-icon">
                        <span class="elfsight-admin-icon-support-documentation elfsight-admin-icon"></span>
                    </span>

                    <span class="elfsight-admin-page-support-ticket-steps-item-label"><?php esc_html_e('The documentation doesn\'t help.', $this->textDomain); ?></span>
                </li>
            </ul>

            <h4><?php esc_html_e('Didn\'t help? Open a ticket at our Support Center', $this->textDomain); ?></h4>

            <div class="elfsight-admin-page-support-ticket-iframe-container">
                <iframe class="elfsight-admin-page-support-ticket-iframe" src="<?php echo esc_html($supportEmbedUrl); ?>"></iframe>
            </div>
        </div>

        <div class="elfsight-admin-page-support-includes-container">
            <div class="elfsight-admin-page-support-includes">
                <h4><?php esc_html_e('Our Support Includes', $this->textDomain); ?></h4>

                <ul class="elfsight-admin-page-support-includes-list">
                    <li class="elfsight-admin-page-support-includes-list-item">
                        <div class="elfsight-admin-page-support-includes-list-item-title"><?php esc_html_e('Fixing product bugs', $this->textDomain); ?></div>

                        <p class="elfsight-admin-page-support-includes-list-item-description"><?php esc_html_e('Our product doesn’t work properly on your website? Report your issue or bug by describing it in detail and providing us with a link to your website. We will do our best to find a solution.', $this->textDomain); ?></p>
                    </li>

                    <li class="elfsight-admin-page-support-includes-list-item">
                        <div class="elfsight-admin-page-support-includes-list-item-title"><?php esc_html_e('Life-time updates', $this->textDomain); ?></div>

                        <p class="elfsight-admin-page-support-includes-list-item-description"><?php esc_html_e('We release new updates and features on a regular basis. Just don’t forget to check for the latest version in your WordPress admin panel.', $this->textDomain); ?></p>
                    </li>

                    <li class="elfsight-admin-page-support-includes-list-item">
                        <div class="elfsight-admin-page-support-includes-list-item-title"><?php esc_html_e('Customer-friendly development', $this->textDomain); ?></div>

                        <p class="elfsight-admin-page-support-includes-list-item-description"><?php esc_html_e('We are open to your ideas. If you need some specific features, that might also improve our products, then just drop us a line. We will consider implementing them in our future updates.', $this->textDomain); ?></p>
                    </li>
                </ul>
            </div>

            <div class="elfsight-admin-page-support-not-includes">
                <h4><?php esc_html_e('Our Support Doesn’t Include', $this->textDomain); ?></h4>

                <ul class="elfsight-admin-page-support-not-includes-list">
                    <li class="elfsight-admin-page-support-not-includes-list-item">
                        <div class="elfsight-admin-page-support-not-includes-list-item-title"><?php esc_html_e('Plugin installation', $this->textDomain); ?></div>

                        <p class="elfsight-admin-page-support-not-includes-list-item-description"><?php esc_html_e('We don’t provide installation services for our plugins. However, we\'re happy to provide you with installation tutorials. And if any errors come up during installation, feel free to contact us.', $this->textDomain); ?></p>
                    </li>

                    <li class="elfsight-admin-page-support-not-includes-list-item">
                        <div class="elfsight-admin-page-support-not-includes-list-item-title"><?php esc_html_e('Plugin customization', $this->textDomain); ?></div>

                        <p class="elfsight-admin-page-support-not-includes-list-item-description"><?php esc_html_e('We don’t provide plugin customization services. If you need to modify the way some features work, share your ideas with us, and we will consider them for future updates.', $this->textDomain); ?></p>
                    </li>

                    <li class="elfsight-admin-page-support-not-includes-list-item">
                        <div class="elfsight-admin-page-support-not-includes-list-item-title"><?php esc_html_e('3rd-party issues', $this->textDomain); ?></div>

                        <p class="elfsight-admin-page-support-not-includes-list-item-description"><?php esc_html_e('We don’t fix bugs or issues related to other plugins and themes, created by 3rd-party developers. Also we don’t provide integration services for 3rd-party plugins and themes.', $this->textDomain); ?></p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</article>