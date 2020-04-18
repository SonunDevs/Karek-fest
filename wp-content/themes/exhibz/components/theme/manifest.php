<?php if (!defined('ABSPATH')) die('Direct access forbidden.');

$manifest = array();

$manifest[ 'name' ]			 = esc_html__( 'exhibz', 'exhibz' );
$manifest[ 'uri' ]			 = esc_url( 'https://themeforest.net/user/tripples' );
$manifest[ 'description' ]	 = esc_html__( 'Event WordPress Theme', 'exhibz' );
$manifest[ 'version' ]		 = '1.0';
$manifest[ 'author' ]			 = 'Tripples';
$manifest[ 'author_uri' ]		 = esc_url( 'https://themeforest.net/user/tripples' );
$manifest[ 'requirements' ]	 = array(
	'wordpress' => array(
		'min_version' => EXHIBZ_MINWP_VERSION,
	),
);

$manifest[ 'id' ] = 'scratch';

$manifest[ 'supported_extensions' ] = array(
	'backups'		 => array(),
);


?>
