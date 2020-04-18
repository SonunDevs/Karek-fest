<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * options for wp customizer
 * section name format: exhibz_section_{section name}
 */
$options = [
	'exhibz_section_theme_settings' => [
		'title'				 => esc_html__( 'Theme settings', 'exhibz' ),
		'options'			 => Exhibz_Theme_Includes::_customizer_options(),
		'wp-customizer-args' => [
			'priority' => 3,
		],
	],
];
