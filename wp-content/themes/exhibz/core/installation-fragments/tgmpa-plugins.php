<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * register required plugins
 */

function exhibz_register_required_plugins() {
	$plugins	 = array(
		array(
			'name'		 => esc_html__( 'Unyson', 'exhibz' ),
			'slug'		 => 'unyson',
			'required'	 => true,
		), 
		array(
			'name'		 => esc_html__( 'Elementor', 'exhibz' ),
			'slug'		 => 'elementor',
			'required'	 => true,
      	),
      	array(
			'name'		 => esc_html__( 'Mailchimp', 'exhibz' ),
			'slug'		 => 'mailchimp-for-wp',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( ' Contact form 7', 'exhibz' ),
			'slug'		 => 'contact-form-7',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'Exhibz Essentials', 'exhibz' ),
			'slug'		 => 'exhibz-essential',
			'required'	 => true,
			'version'	 => '1.1',
			'source'     => get_template_directory() . '/core/installation-fragments/plugins/exhibz-essential.zip', // The plugin source.
		),	
	);


	$config = array(
		'id'			 => 'exhibz', // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path'	 => '', // Default absolute path to bundled plugins.
		'menu'			 => 'exhibz-install-plugins', // Menu slug.
		'parent_slug'	 => 'themes.php', // Parent menu slug.
		'capability'	 => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'	 => true, // Show admin notices or not.
		'dismissable'	 => true, // If false, a user cannot dismiss the nag message.
		'dismiss_msg'	 => '', // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic'	 => true, // Automatically activate plugins after installation or not.
		'message'		 => '', // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'exhibz_register_required_plugins' );