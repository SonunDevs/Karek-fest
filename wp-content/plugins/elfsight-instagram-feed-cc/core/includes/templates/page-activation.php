<?php

if (!defined('ABSPATH')) exit;

?><article class="elfsight-admin-page-activation elfsight-admin-page" data-elfsight-admin-page-id="activation">
    <div class="elfsight-admin-page-heading">
        <h2><?php esc_html_e('Activation', $this->textDomain); ?></h2>
    </div>

    <div class="elfsight-admin-page-activation-content">
        <div class="elfsight-admin-page-activation-form-container">
            <form class="elfsight-admin-page-activation-form" data-nonce="<?php echo wp_create_nonce($this->getOptionName('update_activation_data_nonce')); ?>" data-activation-url="<?php echo esc_html($this->updateUrl); ?>" data-activation-version="<?php echo esc_html($this->version); ?>">
                <div class="elfsight-admin-page-activation-form-header">
                    <h4><?php esc_html_e('CodeCanyon License', $this->textDomain); ?></h4>

                    <div class="elfsight-admin-page-activation-status">
                        <span class="elfsight-admin-page-activation-status-activated"></span>
                        <span class="elfsight-admin-page-activation-status-not-activated"></span>
                    </div>
                </div>

                <div class="elfsight-admin-page-activation-form-field">
                    <label>
                        <span class="elfsight-admin-page-activation-form-field-label"><?php esc_html_e('Please, enter your plugin\'s CodeCanyon purchase code', $this->textDomain); ?></span>
                        <input class="elfsight-admin-page-activation-form-activated-input" type="hidden" name="activated" value="<?php echo esc_html($activated); ?>">
                        <input class="elfsight-admin-page-activation-form-supported-until-input" type="hidden" name="supported_until" value="<?php echo esc_html($supported_until); ?>">
                        <input class="elfsight-admin-page-activation-form-host-input" type="hidden" name="host" value="<?php echo esc_html($host); ?>">
                        <input class="elfsight-admin-page-activation-form-purchase-code-input" type="text" placeholder="<?php esc_html_e('Purchase code', $this->textDomain); ?>" name="purchase_code" value="<?php echo esc_html($purchase_code); ?>" class="regular-text" spellcheck="false" autocomplete="off"<?php echo 
                        ($activated ? ' readonly="readonly"' : ''); ?>>
                    </label>
                </div>

                <div class="elfsight-admin-page-activation-form-action elfsight-admin-page-activation-form-field">
                    <div class="elfsight-admin-page-activation-form-submit elfsight-admin-button-green elfsight-admin-button-large elfsight-admin-button"><?php esc_html_e('Activate License', $this->textDomain); ?></div>

                    <div class="elfsight-admin-page-activation-form-deactivation">
                        <div class="elfsight-admin-page-activation-form-deactivation-button elfsight-admin-button-gray elfsight-admin-button-large elfsight-admin-button"><?php esc_html_e('Deactivate License', $this->textDomain); ?></div>

                        <div class="elfsight-admin-page-activation-form-deactivation-confirm">
                            <div class="elfsight-admin-page-activation-form-deactivation-confirm-caption"><?php esc_html_e('Are you sure you want to deactivate the plugin?', $this->textDomain); ?></div>

                            <div class="elfsight-admin-page-activation-form-deactivation-confirm-no elfsight-admin-button-gray elfsight-admin-button-large elfsight-admin-button"><?php esc_html_e('No', $this->textDomain); ?></div>

                            <div class="elfsight-admin-page-activation-form-deactivation-confirm-yes elfsight-admin-button-red elfsight-admin-button-large elfsight-admin-button"><?php esc_html_e('Yes', $this->textDomain); ?></div>
                        </div>
                    </div>

                    <div class="elfsight-admin-page-activation-form-message-container">
                        <div class="elfsight-admin-page-activation-form-message-success elfsight-admin-page-activation-form-message"><?php esc_html_e('The plugin is successfuly activated', $this->textDomain); ?></div>
                        <div class="elfsight-admin-page-activation-form-message-error elfsight-admin-page-activation-form-message"><?php esc_html_e('Your purchase code is not valid', $this->textDomain); ?></div>
                        <div class="elfsight-admin-page-activation-form-message-fail elfsight-admin-page-activation-form-message"><?php esc_html_e('Error occurred while checking your purchase code. Please, contact our support team via <a href="mailto:support@elfsight.com">support@elfsight.com</a>. We apologize for inconveniences.', $this->textDomain); ?></div>
                    </div>
                </div>
            </form>
        </div>

        <div class="elfsight-admin-page-activation-faq">
            <h4><?php esc_html_e('FAQ', $this->textDomain); ?></h4>

            <div class="elfsight-admin-page-activation-faq-list">
                <div class="elfsight-admin-page-activation-faq-list-item">
                    <div class="elfsight-admin-page-activation-faq-list-item-question"><?php esc_html_e('How do I benefit from activating the license in the plugin?', $this->textDomain); ?></div>

                    <div class="elfsight-admin-page-activation-faq-list-item-answer">
                        <?php
                            printf(
                                /* translators: %1$s: link */
                                esc_html__('Activating the %1$s will give you access to the in-plugin support and automatic plugin updates. Now bug fixes and new features will be automatically implemented in your plugin.', $this->textDomain),
                                sprintf(
                                    '<a href="%s" target="_blank">%s</a>',
                                    $this->productUrl,
                                    /* translators: Activating the [plugin] will give .. */
                                    esc_html__('plugin', $this->textDomain)
                                )
                            );
                        ?>
                    </div>
                </div>

                <div class="elfsight-admin-page-activation-faq-list-item">
                    <div class="elfsight-admin-page-activation-faq-list-item-question"><?php esc_html_e('What is CodeCanyon purchase code?', $this->textDomain); ?></div>
                    <div class="elfsight-admin-page-activation-faq-list-item-answer">
                        <?php
                            printf(
                                /* translators: %1$s: link */
                                esc_html__('Purchase code is a license key, that you get after buying the plugin on %1$s. It looks like this: 13fc2617-5d1d-4127-873a-feb85d27a012.', $this->textDomain),
                                sprintf(
                                    '<a href="%s" target="_blank">%s</a>',
                                    $this->productUrl, 'CodeCanyon'
                                )
                            );
                        ?>
                        <div class="elfsight-admin-page-activation-faq-list-item-answer-image">
                            <img src="<?php echo plugins_url('assets/img/faq-what-is-purchase-code.jpg', $this->pluginFile); ?>">
                        </div>
                    </div>
                </div>

                <div class="elfsight-admin-page-activation-faq-list-item">
                    <div class="elfsight-admin-page-activation-faq-list-item-question"><?php esc_html_e('How do I get my purchase code?', $this->textDomain); ?></div>
                    <div class="elfsight-admin-page-activation-faq-list-item-answer">
                        <?php
                            printf(
                                /* translators: %1$s: product link, %2$s: download link, %3$s: help link */
                                esc_html__('After purchasing the %1$s, go to %2$s, click "Download" and select “License Certificate & Purchase Code”. You’ll find your purchase code in the downloaded file. To find out more, read: %3$s', $this->textDomain),
                                sprintf(
                                    '<a href="%s" target="_blank">%s</a>',
                                    $this->productUrl,
                                    /* translators: After purchasing the [item], go to .. */
                                    esc_html__('item', $this->textDomain)
                                ),
                                '<a href="http://codecanyon.net/downloads" target="_blank">http://codecanyon.net/downloads</a>',
                                sprintf(
                                    '<a href="%s" target="_blank">%s</a>',
                                    'https://elfsight.com/blog/2016/04/where-to-find-your-envato-purchase-code/',
                                    esc_html__('Where to find your Envato purchase code?', $this->textDomain)
                                )
                            );
                        ?>
                        <div class="elfsight-admin-page-activation-faq-list-item-answer-image">
                            <img src="<?php echo plugins_url('assets/img/faq-how-to-get.jpg', $this->pluginFile); ?>">
                        </div>
                    </div>
                </div>

                <div class="elfsight-admin-page-activation-faq-list-item">
                    <div class="elfsight-admin-page-activation-faq-list-item-question"><?php esc_html_e('How do I activate a CodeCanyon license?', $this->textDomain); ?></div>
                    <div class="elfsight-admin-page-activation-faq-list-item-answer">
                        <?php esc_html_e('To activate your license in the plugin insert you purchase code into the CodeCanyon License form above and press “Activate License” button. After the successful activation, you will see the corresponding notification.', $this->textDomain); ?>

                        <div class="elfsight-admin-page-activation-faq-list-item-answer-image">
                            <img src="<?php echo plugins_url('assets/img/faq-how-to-activate.jpg', $this->pluginFile); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</article>