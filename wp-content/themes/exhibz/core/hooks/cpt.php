<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
//die('cpt found');
/**
 * hooks for wp blog part
 */

// if there is no excerpt, sets a defult placeholder
// ----------------------------------------------------------------------------------------

if ( class_exists( 'ExhibzCustomPost\Exhibz_CustomPost' ) ) {
    //schedule 
	$schedule = new ExhibzCustomPost\Exhibz_CustomPost( 'exhibz' );
	$schedule->xs_init( 'ts-schedule', 'Schedule', 'Schedules', array( 'menu_icon' => 'dashicons-calendar-alt',
		'supports'	 => array( 'title'),
		'rewrite'	 => array( 'slug' => 'schedule' ) ) );
	$schedule_tax = new  ExhibzCustomPost\Exhibz_Taxonomies('exhibz');
	$schedule_tax->xs_init('ts-schedule_cat', 'Schedule Category', 'Schedule Categories', 'ts-schedule');

	//speaker
	$speaker = new ExhibzCustomPost\Exhibz_CustomPost( 'exhibz' );
	$speaker->xs_init( 'ts-speaker', 'Speaker', 'Speakers', array( 'menu_icon' => 'dashicons-admin-users',
		'supports'	 => array( 'title'),
		'rewrite'	 => array( 'slug' => 'speaker' ) ) );
	
	$speaker_tax = new  ExhibzCustomPost\Exhibz_Taxonomies('exhibz');
	$schedule_tax->xs_init('ts-speaker_cat', 'Speaker Category', 'Speaker Categories', 'ts-speaker');	



}