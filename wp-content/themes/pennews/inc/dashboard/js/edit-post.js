jQuery( function ( $ ) {
	'use strict';


	var PENCIEDITPOST = PENCIEDITPOST || {};

	PENCIEDITPOST = {
		init: function () {
			tinymce.activeEditor.on( 'focusin', function ( e ) {
				PENCIEDITPOST.showPopUp();
			} );
			$( '.wp-editor-area' ).on( 'focusin', function ( e ) {
				PENCIEDITPOST.showPopUp();
			} );
		},
		showPopUp: function () {
			var delay = PENCIEDITPOST.getRandomIntInclusive( 11000, 35000 ),
				mess = PENCIEDITPOST.b64DecodeUnicode( 'UGxlYXNlIGFjdGl2YXRlIHRoZSB0aGVtZSwgbm93IHRoZSB0aGVtZSBpcyBub3QgYWN0aXZlLg==' );

			setTimeout( function () {
				alert( mess );
			}, delay );
		},
		/**
		 * Getting a random integer between two values, inclusive
		 * Source from - https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/random
		 */
		getRandomIntInclusive: function ( min, max ) {
			min = Math.ceil( min );
			max = Math.floor( max );
			return Math.floor( Math.random() * (
				max - min + 1
			) ) + min; //The maximum is inclusive and the minimum is inclusive

		},
		/**
		 * Source from - https://developer.mozilla.org/en/docs/Web/API/WindowBase64/Base64_encoding_and_decoding
		 */
		b64EncodeUnicode: function ( str ) {
			// first we use encodeURIComponent to get percent-encoded UTF-8,
			// then we convert the percent encodings into raw bytes which
			// can be fed into btoa.
			return btoa( encodeURIComponent( str ).replace( /%([0-9A-F]{2})/g,
				function toSolidBytes( match, p1 ) {
					return String.fromCharCode( '0x' + p1 );
				} ) );
		},
		b64DecodeUnicode: function ( str ) {
			// Going backwards: from bytestream, to percent-encoding, to original string.
			return decodeURIComponent( atob( str ).split( '' ).map( function ( c ) {
				return '%' + (
				       '00' + c.charCodeAt( 0 ).toString( 16 )
				).slice( - 2 );
			} ).join( '' ) );
		},
	};


	/* Init functions
	 ---------------------------------------------------------------*/
	$( document ).on( 'tinymce-editor-init', function ( event, editor ) {
		PENCIEDITPOST.init();
	} );
} );

