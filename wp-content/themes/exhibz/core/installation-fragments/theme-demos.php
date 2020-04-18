<?php

function exhibz_fw_ext_backups_demos( $demos ) {
	$demo_content_installer	 = 'https://demo.themewinter.com/wp/demo-content/exhibz';
	$demos_array			 = array(
		'default'			 => array(
			'title'			 => esc_html__( 'Main Demo', 'exhibz' ),
			'screenshot'	 => esc_url( $demo_content_installer ) . '/default/screenshot.png',
			'preview_link'	 => esc_url( 'http://themeforest.net/user/tripples/portfolio' ),
		),
		'onepage'			 => array(
			'title'			 => esc_html__( 'One Page', 'exhibz' ),
			'screenshot'	 => esc_url( $demo_content_installer ) . '/onepage/screenshot.png',
			'preview_link'	 => esc_url( 'http://themeforest.net/user/tripples/portfolio' ),
		),
		'foodfestival'			 => array(
			'title'			 => esc_html__( 'Food Festival Home', 'exhibz' ),
			'screenshot'	 => esc_url( $demo_content_installer ) . '/foodfestival/screenshot.png',
			'preview_link'	 => esc_url( 'http://themeforest.net/user/tripples/portfolio' ),
		),
		'education'			 => array(
			'title'			 => esc_html__( 'Education Home', 'exhibz' ),
			'screenshot'	 => esc_url( $demo_content_installer ) . '/education/screenshot.png',
			'preview_link'	 => esc_url( 'http://themeforest.net/user/tripples/portfolio' ),
		),
		
	);

	$download_url			 = esc_url( $demo_content_installer ) . '/manifest.php';
	foreach ( $demos_array as $id => $data ) {
		$demo						 = new FW_Ext_Backups_Demo( $id, 'piecemeal', array(
			'url'		 => $download_url,
			'file_id'	 => $id,
		) );
		$demo->set_title( $data[ 'title' ] );
		$demo->set_screenshot( $data[ 'screenshot' ] );
		$demo->set_preview_link( $data[ 'preview_link' ] );
		$demos[ $demo->get_id() ]	 = $demo;
		unset( $demo );
	}
	return $demos;
}

add_filter( 'fw:ext:backups-demo:demos', 'exhibz_fw_ext_backups_demos' );