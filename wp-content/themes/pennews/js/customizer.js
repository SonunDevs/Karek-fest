/* global PenNewsCustomizer, Color */
/**
 * Script for customizer controls.
 */
(function ( $, api )
{
	// View documentation
	$( '<a  class="penci-docs" href="http://pennews.pencidesign.com/pennews-document" target="_blank"></a>' )
		.text( PenNewsCustomizer.docs )
		.appendTo( '.preview-notice' );

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
			$( '#penci-widget-sidebar' )
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

	wp.customize( 'penci_fwidget_block_title_style', function( value ) {
		value.bind( function( to ) {
			$( '#penci-widget-sidebar' )
				.removeClass( 'style-title-1' )
				.removeClass( 'style-title-2' )
				.removeClass( 'style-title-3' )
				.removeClass( 'style-title-4' )
				.addClass( to );
		});
	});

	wp.customize( 'penci_align_blocktitle', function( value ) {
		value.bind( function( to ) {
			$( '#penci-widget-sidebar' )
				.removeClass( 'style-title-left' )
				.removeClass( 'style-title-center' )
				.removeClass( 'style-title-right' )
				.addClass( to );
		});
	});

	// Radio image control.
	api.controlConstructor['radio-image'] = api.Control.extend( {
		ready: function ()
		{
			var control = this;
			$( 'input:radio', control.container ).change( function ()
			{
				control.setting.set( $( this ).val() );
			} );
		}
	} );

	api.controlConstructor['radio-html'] = api.Control.extend( {
		ready: function ()
		{
			var control = this;
			$( 'input:radio', control.container ).change( function ()
			{
				control.setting.set( $( this ).val() );

				var $parent = $( this ).closest( '.customize-control-content-html' );
				$parent.find( '.penci-radio-html' ).removeClass( 'selected' );
				$( this ).parent().addClass('selected');
			} );
		}
	} );

})( jQuery, wp.customize );

(function ( api )
{
	var colorSettings = [
			'background_color',
			'penci_color_body',
			'penci_block_bgcolor',
			'penci_color_accent',
			'penci_color_heading',
			'penci_color_links',
			'penci_color_meta',
			'penci_color_border'

		];

	/**
	 * Update list of colors when select a color scheme.
	 * @param scheme Color scheme
	 */
	function updateColors( scheme )
	{
		scheme = scheme || 'light';
		var colors = PenNewsCustomizer[scheme].colors;

		_.each( colorSettings, function ( key, index )
		{
			var color = colors[index];
			api( key ).set( color );
			api.control( key ).container.find( '.color-picker-hex' )
			   .data( 'data-default-color', color )
			   .wpColorPicker( 'defaultColor', color );
		} );
	}
	api.controlConstructor.radio = api.Control.extend( {
		ready: function ()
		{
			if ( 'penci_colorscheme' === this.id )
			{
				this.setting.bind( 'change', updateColors );
			}
		}
	} );
})( wp.customize );