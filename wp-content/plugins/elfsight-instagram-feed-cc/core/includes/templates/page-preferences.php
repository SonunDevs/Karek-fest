<?php

if (!defined('ABSPATH')) exit;

?><article class="elfsight-admin-page-preferences elfsight-admin-page" data-elfsight-admin-page-id="preferences">
	<div class="elfsight-admin-page-heading">
		<h2><?php esc_html_e('Preferences', $this->textDomain); ?></h2>

		<div class="elfsight-admin-page-heading-subheading">
			<?php esc_html_e('These settings will be applied to each widget of the plugin.', $this->textDomain); ?>
		</div>
    </div>

    <div class="elfsight-admin-divider"></div>

	<div class="elfsight-admin-page-preferences-form" data-nonce="<?php echo wp_create_nonce($this->getOptionName('update_preferences_nonce')); ?>">
        <div class="elfsight-admin-page-preferences-option-css elfsight-admin-page-preferences-option">
            <div class="elfsight-admin-page-preferences-option-info">
                <h4 class="elfsight-admin-page-preferences-option-info-name">
                    <?php esc_html_e('Custom CSS', $this->textDomain); ?>
                </h4>

                <div class="elfsight-admin-caption">
                    <?php esc_html_e('Here you can set the plugin\'s custom styles. The code will be added to each page with the widget.', $this->textDomain); ?>
                </div>
            </div>

            <div class="elfsight-admin-page-preferences-option-input-container">
                <div class="elfsight-admin-page-preferences-option-editor">
                    <div class="elfsight-admin-page-preferences-option-editor-code" id="elfsightPreferencesSnippetCSS"><?php echo htmlspecialchars($preferences_custom_css)?></div>
                </div>

                <div class="elfsight-admin-page-preferences-option-save-container">
                    <a href="#" class="elfsight-admin-page-preferences-option-css-save elfsight-admin-page-preferences-option-save elfsight-admin-button-green elfsight-admin-button">
                        <span class="elfsight-admin-page-preferences-option-save-label"><?php esc_html_e('Save', $this->textDomain); ?></span>

                        <span class="elfsight-admin-page-preferences-option-save-loader"></span>
                    </a>

                    <span class="elfsight-admin-page-preferences-option-save-success">
                        <span class="elfsight-admin-icon-check-green-small elfsight-admin-icon"></span><span class="elfsight-admin-page-preferences-option-save-success-label"><?php esc_html_e('Done!', $this->textDomain); ?></span>
                    </span>

                    <span class="elfsight-admin-page-preferences-option-save-error"></span>
                </div>
            </div>
        </div>

        <div class="elfsight-admin-divider"></div>

        <div class="elfsight-admin-page-preferences-option-js elfsight-admin-page-preferences-option">
            <div class="elfsight-admin-page-preferences-option-info">
                <h4 class="elfsight-admin-page-preferences-option-info-name">
                    <?php esc_html_e('Custom JavaScript', $this->textDomain); ?>
                </h4>

                <div class="elfsight-admin-caption">
                    <?php esc_html_e('Here you can set the plugin\'s custom javascript code. The code will be added to each page with the widget.', $this->textDomain); ?>
                </div>
            </div>
            
            <div class="elfsight-admin-page-preferences-option-input-container">
                <div class="elfsight-admin-page-preferences-option-editor">
                    <div class="elfsight-admin-page-preferences-option-editor-code" id="elfsightPreferencesSnippetJS"><?php echo htmlspecialchars($preferences_custom_js) ?></div>
                </div>

                <div class="elfsight-admin-page-preferences-option-save-container">
                    <a href="#" class="elfsight-admin-page-preferences-option-js-save elfsight-admin-page-preferences-option-save elfsight-admin-button-green elfsight-admin-button">
                        <span class="elfsight-admin-page-preferences-option-save-label"><?php esc_html_e('Save', $this->textDomain); ?></span>

                        <span class="elfsight-admin-page-preferences-option-save-loader"></span>
                    </a>

                    <span class="elfsight-admin-page-preferences-option-save-success">
                        <span class="elfsight-admin-icon-check-green-small elfsight-admin-icon"></span><span class="elfsight-admin-page-preferences-option-save-success-label"><?php esc_html_e('Done!', $this->textDomain); ?></span>
                    </span>

                    <span class="elfsight-admin-page-preferences-option-save-error"></span>
                </div>
            </div>
        </div>

        <?php if(current_user_can('manage_options')) { ?>
            <div class="elfsight-admin-divider"></div>

            <div class="elfsight-admin-page-preferences-option-roles elfsight-admin-page-preferences-option">
                <div class="elfsight-admin-page-preferences-option-info">
                    <h4 class="elfsight-admin-page-preferences-option-info-name">
                        <?php esc_html_e('Who can access the plugin', $this->textDomain); ?>
                    </h4>

                    <div class="elfsight-admin-caption">
                        <?php esc_html_e('Here you can set the minimal permissions role that can access the plugin.', $this->textDomain); ?>
                    </div>
                </div>
                
                <div class="elfsight-admin-page-preferences-option-input-container">
                    <div class="elfsight-admin-page-preferences-option-input-select-container">
                        <select class="elfsight-admin-page-preferences-option-input-select" name="preferences_access_role">
                            <option value="admin" <?php echo ($preferences_access_role === 'admin') ? 'selected' : ''?>><?php esc_html_e('Admin', $this->textDomain); ?></option>
                            <option value="editor" <?php echo ($preferences_access_role === 'editor') ? 'selected' : ''?>><?php esc_html_e('Editor', $this->textDomain); ?></option>
                            <option value="author" <?php echo ($preferences_access_role === 'author') ? 'selected' : ''?>><?php esc_html_e('Author', $this->textDomain); ?></option>
                        </select>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="elfsight-admin-divider"></div>

        <div class="elfsight-admin-page-preferences-option-force-script elfsight-admin-page-preferences-option">
            <div class="elfsight-admin-page-preferences-option-info">
                <h4 class="elfsight-admin-page-preferences-option-info-name">
                    <label for="autoUpgrade"><?php esc_html_e('Automatic updates', $this->textDomain); ?></label>
                </h4>

                <div class="elfsight-admin-caption">
                    <?php esc_html_e('When this option is on (recommended), this plugin\'s released updates with the new features and bug fixes will be installed to your website automatically. When it is off, you\'ll only have the option of updating manually.', $this->textDomain); ?>
                </div>
            </div>

            <div class="elfsight-admin-page-preferences-option-input-container">
                <input type="checkbox" name="preferences_auto_upgrade" value="true" id="autoUpgrade" class="elfsight-admin-page-preferences-option-input-toggle"<?php echo ($preferences_auto_upgrade === 'on') ? ' checked' : ''?>>
                <label for="autoUpgrade"><i></i></label>
            </div>
        </div>

        <div class="elfsight-admin-divider"></div>

        <div class="elfsight-admin-page-preferences-option-force-script elfsight-admin-page-preferences-option">
            <div class="elfsight-admin-page-preferences-option-info">
                <h4 class="elfsight-admin-page-preferences-option-info-name">
                    <label for="forceScriptAdd"><?php esc_html_e('Ajax Loading (activate for AJAX-powered themes)', $this->textDomain); ?></label>
                </h4>

                <div class="elfsight-admin-caption">
                    <?php esc_html_e('By default the plugin script loads only on pages you\'ve added its shortcode to. In case of AJAX-powered themes, you need to activate this option to load the plugin script at the initial site load.', $this->textDomain); ?>
                </div>
            </div>

            <div class="elfsight-admin-page-preferences-option-input-container">
                <input type="checkbox" name="preferences_force_script_add" value="true" id="forceScriptAdd" class="elfsight-admin-page-preferences-option-input-toggle"<?php echo ($preferences_force_script_add === 'on') ? ' checked' : ''?>>
                <label for="forceScriptAdd"><i></i></label>
            </div>
        </div>
    </div>
</article>