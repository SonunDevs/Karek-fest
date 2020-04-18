/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

(function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		});
	});
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});

	wp.customize( 'penci_style_block_title', function( value ) {
		value.bind( function( to ) {
			$( '.penci-widget-sidebar' )
				.removeClass( 'style-title-1' )
				.removeClass( 'style-title-2' )
				.removeClass( 'style-title-3' )
				.removeClass( 'style-title-4' )
				.removeClass( 'style-title-5' )
				.removeClass( 'style-title-6' )
				.removeClass( 'style-title-7' )
				.removeClass( 'style-title-8' )
				.removeClass( 'style-title-9' )
				.removeClass( 'style-title-10' )
				.removeClass( 'style-title-11' )
				.removeClass( 'style-title-12' )
				.removeClass( 'style-title-13' )
				.addClass( to );
		});
	});

	wp.customize( 'penci_align_blocktitle', function( value ) {
		value.bind( function( to ) {
			$( '#main .widget.penci-block-vc' )
				.removeClass( 'style-title-left' )
				.removeClass( 'style-title-center' )
				.removeClass( 'style-title-right' )
				.addClass( to );
		});
	});

	wp.customize( 'penci_fwidget_block_title_style', function( value ) {
		value.bind( function( to ) {
			$( '.penci-fwidget-sidebar' )
				.removeClass( 'style-title-1' )
				.removeClass( 'style-title-2' )
				.removeClass( 'style-title-3' )
				.removeClass( 'style-title-4' )
				.addClass( to );
		});
	});

	wp.customize( 'penci_fwidget_align_blocktitle', function( value ) {
		value.bind( function( to ) {
			$( '.penci-fwidget-sidebar' )
				.removeClass( 'style-title-left' )
				.removeClass( 'style-title-center' )
				.removeClass( 'style-title-right' )
				.addClass( to );
		});
	});

} )( jQuery );
