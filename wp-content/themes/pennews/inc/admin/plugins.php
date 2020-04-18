<?php
add_action( 'tgmpa_register', 'penci_register_required_plugins' );

/**
 * Register required plugins
 */
function penci_register_required_plugins() {

	$link_server = 'https://s3.amazonaws.com/pennews-plugins/';
	$plugins = array(
		array(
			'name'     => esc_attr__( 'WPBakery Visual Composer', 'pennews' ),
			'slug'     => 'js_composer',
			'source'   => $link_server . 'js_composer.zip',
			'required' => true,
			'version'  => '6.0.1',
		),
		array(
			'name'     => esc_attr__( 'Penci Framework', 'pennews' ),
			'slug'     => 'penci-framework',
			'source'   => $link_server . 'penci-framework.zip',
			'required' => true,
			'version'  => PENCI_PENNEWS_VERSION,
		),
		array(
			'name'     => 'Vafpress Post Formats UI',
			'slug'     => 'vafpress-post-formats-ui-develop',
			'source'   => $link_server . 'vafpress-post-formats-ui-develop.zip',
			'required' => false,
			'version'  => '1.6',
		),
		array(
			'name'     => esc_html__( 'Penci PenNews Slider', 'pennews' ),
			'slug'     => 'penci-pennew-slider',
			'source'   => $link_server . 'penci-pennew-slider.zip',
			'required' => false,
			'version'  => '2.1',
		),
		array(
			'name'     => esc_html__( 'Penci Pennews Portfolio', 'pennews' ),
			'slug'     => 'penci-pennews-portfolio',
			'source'   => $link_server . 'penci-pennews-portfolio.zip',
			'required' => false,
			'version'  => '2.2.2',
		),
		array(
			'name'     => esc_html__( 'Penci Pennews Review', 'pennews' ),
			'slug'     => 'penci-pennews-review',
			'source'   => $link_server . 'penci-pennews-review.zip',
			'required' => false,
			'version'  => '4.3.3',
		),
		array(
			'name'     => esc_html__( 'Penci Pennews Recipe', 'pennews' ),
			'slug'     => 'penci-pennews-recipe',
			'source'   => $link_server . 'penci-pennews-recipe.zip',
			'required' => false,
			'version'  => '2.5.3',
		),
		array(
			'name'     => esc_html__( 'PenNews Demo Importer', 'pennews' ),
			'slug'     => 'penci-pennews-demo-importer',
			'source'   => $link_server . 'penci-pennews-demo-importer.zip',
			'required' => false,
			'version'  => '6.0',
		),
		array(
			'name'     => esc_html__( 'Penci PenNews Migrator', 'pennews' ),
			'slug'     => 'penci-pennews-migrator',
			'source'   => $link_server . 'penci-pennews-migrator.zip',
			'required' => false,
			'version'  => '1.1',
		),
		array(
			'name'     => 'Yoast SEO',
			'slug'     => 'wordpress-seo',
			'required' => false
		),array(
			'name'     => 'MailChimp for WordPress',
			'slug'     => 'mailchimp-for-wp',
			'required' => false
		),
		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => false
		)
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'pennews',
		// Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',
		// Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins',
		// Menu slug.
		'has_notices'  => true,
		// Show admin notices or not.
		'dismissable'  => true,
		// If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',
		// If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,
		// Automatically activate plugins after installation or not.
		'message'      => '',
		// Message to output right before the plugins table.
		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'pennews' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'pennews' ),
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'pennews' ),
			'updating'                        => esc_html__( 'Updating Plugin: %s', 'pennews' ),
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'pennews' ),
			'notice_can_install_required'     => _n_noop(
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'pennews'
			),
			'notice_can_install_recommended'  => _n_noop(
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'pennews'
			),
			'notice_ask_to_update'            => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'pennews'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'pennews'
			),
			'notice_can_activate_required'    => _n_noop(
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'pennews'
			),
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'pennews'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'pennews'
			),
			'update_link'                     => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'pennews'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'pennews'
			),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'pennews' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'pennews' ),
			'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'pennews' ),
			'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'pennews' ),
			'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'pennews' ),
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'pennews' ),
			'dismiss'                         => esc_html__( 'Dismiss this notice', 'pennews' ),
			'notice_cannot_install_activate'  => esc_html__( 'There are one or more required or recommended plugins to install, update or activate.', 'pennews' ),
			'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'pennews' ),
			'nag_type'                        => '',
			// Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
	);

	tgmpa( $plugins, $config );
}
