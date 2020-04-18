<?php

if (!defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN')) exit();

define('PLUGIN_SLUG', 'elfsight-instagram-feed');

$deleted_options = array(
	'purchase_code', 'activated', 'supported_until', 'other_products_hidden', 'latest_version', 'last_check_datetime'
);

function get_option_name($name) {
	return str_replace('-', '_', PLUGIN_SLUG) . '_' . $name;
}

if (get_option(get_option_name('activated')) || get_option(get_option_name('purchase_code'))) {
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://a.elfsight.com/updates/v1/?action=deactivate&slug=' . PLUGIN_SLUG . '-cc&host=' . parse_url(site_url(), PHP_URL_HOST) . '&version=3.8.2&purchase_code=' . get_option(get_option_name('purchase_code')));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	curl_exec($ch);
}

foreach ($deleted_options as $option) {
	delete_option(get_option_name($option));
}

?>