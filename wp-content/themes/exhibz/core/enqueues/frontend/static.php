<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * enqueue all theme scripts and styles
 */


// stylesheets
// ----------------------------------------------------------------------------------------
if ( !is_admin() ) {
	// wp_enqueue_style() $handle, $src, $deps, $version

	// 3rd party css
	wp_enqueue_style( 'exhibz-fonts', exhibz_google_fonts_url(['Raleway:400,500,600,700,800,900', 'Roboto:400,700']), null, EXHIBZ_VERSION );
	wp_enqueue_style( 'bootstrap', EXHIBZ_CSS . '/bootstrap.min.css', null, EXHIBZ_VERSION );
	wp_enqueue_style( 'font-awesome', EXHIBZ_CSS . '/font-awesome.css', null, EXHIBZ_VERSION );
	wp_enqueue_style( 'icofont', EXHIBZ_CSS . '/icofont.css', null, EXHIBZ_VERSION );
	wp_enqueue_style( 'magnific-popup', EXHIBZ_CSS . '/magnific-popup.css', null, EXHIBZ_VERSION );
	wp_enqueue_style( 'owl-carousel', EXHIBZ_CSS . '/owl.carousel.min.css', null, EXHIBZ_VERSION );
	wp_enqueue_style( 'exhibz-woocommerce', EXHIBZ_CSS . '/woocommerce.css', null, EXHIBZ_VERSION );
	//Enqueue gutenberg front block styles
	wp_enqueue_style( 'exhibz-gutenberg-custom', EXHIBZ_CSS . '/gutenberg-custom.css', null, EXHIBZ_VERSION );

	// theme css
	wp_enqueue_style( 'exhibz-style', EXHIBZ_CSS . '/master.css', null, EXHIBZ_VERSION );

}

// javascripts
// ----------------------------------------------------------------------------------------
if ( !is_admin() ) {

	// 3rd party scripts
	wp_enqueue_script( 'bootstrap', EXHIBZ_JS . '/bootstrap.min.js', array( 'jquery' ), EXHIBZ_VERSION, true );
	wp_enqueue_script( 'popper', EXHIBZ_JS . '/popper.min.js', array( 'jquery' ), EXHIBZ_VERSION, true );
	wp_enqueue_script( 'magnific-popup', EXHIBZ_JS . '/jquery.magnific-popup.min.js', array( 'jquery' ), EXHIBZ_VERSION, true );
	wp_enqueue_script( 'jcounter', EXHIBZ_JS . '/jquery.jCounter.js', array( 'jquery' ), EXHIBZ_VERSION, true );
	wp_enqueue_script( 'owl-carousel', EXHIBZ_JS . '/owl.carousel.min.js', array( 'jquery' ), EXHIBZ_VERSION, true );

	// theme scripts
	wp_enqueue_script( 'exhibz-script', EXHIBZ_JS . '/script.js', array( 'jquery' ), EXHIBZ_VERSION, true );
	

	// Load WordPress Comment js
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}