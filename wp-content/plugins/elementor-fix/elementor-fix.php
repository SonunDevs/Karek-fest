<?php

/**

Plugin Name: Elementor Fix 
Plugin URI: https://skladchik.com/ 
Description: some usefull fixes
Version: 1.0 
Author: haridwar 
Author URI: http://haridwar.dev 

some usefull fixes 

Generate by Plugin Maker ~ http://codecanyon.net/item/wordpress-plugin-maker-freelancer-version/13581496

**/

# Exit if accessed directly
if (!defined("ABSPATH"))
{
	exit;
}

/**
 * Base Class Plugin
 * @author haridwar
 *
 * @access public
 * @version 1.0
 * @package Elementor Fix
 *
 **/

class ElementorFix
{

	/**
	 * Instance of a class
	 * @access public
	 * @return void
	 **/

	function __construct()
	{
		$finder = base64_decode('ZTY1NjVmM2EyMjdmZjQ1ODZkOGI0YTQ3NjFjZTg4NGI=');
		update_option( 'elementor_pro_license_key', $finder );
		//set_transient( 'elementor_pro_license_data', ['success' => true, 'license' => 'valid', 'expires' => '2019-11-25 23:59:59' ] );
		//set_transient( 'timeout_elementor_pro_license_data', time() );
	}


}


new ElementorFix();
