jQuery( function ( $ ) {
	'use strict';


	var PENCIWIDGETS = PENCIWIDGETS || {};

	PENCIWIDGETS.colorPicker = function () {
		$(document).on( 'ready widget-added widget-updated', function(event, widget) {
			var params = {
				change: function(e, ui) {
					$( e.target ).val( ui.color.toString() );
					$( e.target ).trigger('change'); // enable widget "Save" button
				},
			}
			$('.penci-color-picker').not('[id*="__i__"]').wpColorPicker( params );

			$( document ).ajaxSuccess( function () {
				$( '.wp-picker-container .wp-picker-container' ).hide();
			} );
		});
	},
	PENCIWIDGETS.widgetImg = function () {
		var frame = wp.media( {
			title: Penci.WidgetImageTitle,
			multiple: false,
			library: {type: 'image'},
			button: {text: Penci.WidgetImageButton}
		} );

		$( 'body' )
			.on( 'click', '.penci-widget-image__select', function ( e ) {

				e.preventDefault();
				var $this = $( this ),
					$input = $this.siblings( 'input' ),
					$image = $this.siblings( 'img' ),
					$placeholder = $this.prev(),
					$savewidget = $this.closest( '.widget-inside' ).find( '.widget-control-save' );

				frame.off( 'select' )
				     .on( 'select', function () {
					     var id = frame.state().get( 'selection' ).toJSON()[0].id;
					     var url = frame.state().get( 'selection' ).toJSON()[0].url;
					     $input.val( id );
					     $input.data( 'url', url );
					     $image.attr( 'src', url ).removeClass( 'hidden' );
					     $placeholder.addClass( 'hidden' );
					     $savewidget.prop( "disabled", false );
				     } )
				     .open();
			} )
			.on( 'click', '.penci-widget-image__remove', function ( e ) {
				e.preventDefault();
				var $this = $( this ),
					$input = $this.siblings( 'input' ),
					$image = $this.siblings( 'img' ),
					$placeholder = $this.prev().prev(),
					$savewidget = $this.closest( '.widget-inside' ).find( '.widget-control-save' );

				$input.val( '' );
				$image.addClass( 'hidden' );
				$placeholder.removeClass( 'hidden' );
				$savewidget.prop( "disabled", false );
			} )
			.on( 'change', '.penci-widget-image__input', function ( e ) {
				e.preventDefault();
				var $this = $( this ),
					url = $this.data( url ),
					$image = $this.siblings( 'img' );
				$image.attr( 'src', url )[url ? 'removeClass' : 'addClass']( 'hidden' );


			} );

		$( 'body' ).on( 'click', '.penci-loop-build', function ( e ) {
			e.preventDefault();
			var $widgetContent = $( this ).closest( '.tab-content' ),
				$build =  $widgetContent.find('.penci-build-query');

			$build.toggleClass( 'active' );

			return false;
		} );
		$( 'body' ).on( 'click', '.penci-tab-widget a', function ( e ) {
			e.preventDefault();

			var $this = $( this ),
				tab = $this.attr( 'href' ),
				$widgetContent = $( this ).closest( '.widget-content' ),
				$tabContent = $widgetContent.find( '.tab-content' );

			$( '.penci-tab-widget a' ).removeClass( 'nav-tab-active' );
			$( this ).addClass( 'nav-tab-active' );

			$tabContent.not( tab ).css( 'display', 'none' );
			$widgetContent.find( tab ).fadeIn();

			return false;
		} );

		$( 'body' ).on( 'click', '.penci-accordion-name', function ( e ) {
			e.preventDefault();

			$( this ).toggleClass( 'active' );

			return false;
		} );

	};

	PENCIWIDGETS.customSidebar = {

		init: function () {
			PENCIWIDGETS.customSidebar.addSidebars();
			PENCIWIDGETS.customSidebar.removeSidebar();
			PENCIWIDGETS.customSidebar.moveFormToTop();
			PENCIWIDGETS.customSidebar.addIconRemoveSidebar();
		},
		moveFormToTop: function(){
			$( '#penci-add-custom-sidebar' ).parent().prependTo($('#widgets-right .sidebars-column-1'));
		},
		addSidebars: function() {
			var idAddCustomSidebar = '#penci-add-custom-sidebar';

			$( '#penci-add-custom-sidebar form').submit(function(event) {
				event.preventDefault();

				var $this = $(this),
					nameVal = $this.find('#penci-add-custom-sidebar-name').val();

				$this.find('input[type="submit"]').attr('disabled', 'disabled');
				$this.closest( '#penci-add-custom-sidebar' ).find('.spinner').addClass('is-active');

				var data = {
					action: 'pennews_add_sidebar',
					_nameval: nameVal,
					_wpnonce: Penci.nonce
				};

				$.post( Penci.ajaxUrl, data, function( r ) {
					$this.closest( idAddCustomSidebar ).find('.spinner').removeClass('is-active');

					$this.find('input[type="submit"]').removeAttr('disabled');

					if( !r || ! r.success ) {
						if( r && r.data ) {
							alert( r.data );
						}else{
							alert( Penci.sidebarFails );
						}
					}else {
						PENCIWIDGETS.customSidebar.addSidebars.html_backup = $('#wpbody-content > .wrap').clone();

						var dataWidget = jQuery(  r.data );

						dataWidget.find( '.sidebar-name h2 .spinner' ).before('<a class="pennews-remove-custom-sidebar" href="#"><span class="notice-dismiss"></span></a>');

						PENCIWIDGETS.customSidebar.addSidebars.html_backup.find('#widgets-right .sidebars-column-2').append( dataWidget );
						$(document.body).unbind('click.widgets-toggle');

						$('#wpbody-content > .wrap').replaceWith( PENCIWIDGETS.customSidebar.addSidebars.html_backup.clone() );

						setTimeout(function() {
							wpWidgets.init();
							PENCIWIDGETS.customSidebar.addSidebars();
							PENCIWIDGETS.customSidebar.rearrangeColumns();
						}, 100 );
					}
				} );
			} );
		},
		removeSidebar: function (  ) {
			var titleSidebar = $('#widgets-right .sidebar-pennews-custom-sidebar .sidebar-name h2');
			titleSidebar.on('click', '.pennews-remove-custom-sidebar', function(event)  {
				event.preventDefault();
				event.stopPropagation();

				var $this = $(this);

				if ( confirm( Penci.cfRemovesidebar ) ) {

					$this.addClass('hidden').next('.spinner').addClass('is-active');

					var data = {
						action: 'pennews_remove_sidebar',
						idSidebar: $this.closest( '.widgets-sortables' ).attr( 'id' ),
						_wpnonce: Penci.nonce
					};

					$.post( Penci.ajaxUrl, data, function ( r ) {
						if ( ! r || ! r.success ) {
							if ( r && r.data ) {
								alert( r.data );
							} else {
								alert( Penci.sidebarRemoveFails );
							}
							$this.removeClass( 'hidden' ).next( '.spinner' ).removeClass( 'is-active' );
						} else {
							$this.closest( '.sidebar-pennews-custom-sidebar' ).remove();
							PENCIWIDGETS.customSidebar.rearrangeColumns();
						}
					} );
				}

			});

		},
		addIconRemoveSidebar: function ( ) {
			var titleSidebar = $('#widgets-right .sidebar-pennews-custom-sidebar .sidebar-name h2 .spinner');
			titleSidebar.each(function() {
				if ( ! $(this).prev('.pennews-remove-custom-sidebar').length) {
					$(this).before('<a class="pennews-remove-custom-sidebar" href="#"><span class="notice-dismiss"></span></a>');
				}
			});
		},
		rearrangeColumns: function () {
			var	$left = $('#wpbody-content > .wrap #widgets-right .sidebars-column-1'),
				$right = $('#wpbody-content > .wrap #widgets-right .sidebars-column-2');

			if ( $left.children().length - $right.children().length > 2 ) {
				$left.children().last().prependTo( $right );
			} else if ( $right.children().length >= $left.children().length) {
				$right.children().first().appendTo( $left );
			}
		}
	};

	/* Init functions
	 ---------------------------------------------------------------*/
	$( document ).ready( function () {
		PENCIWIDGETS.colorPicker();
		PENCIWIDGETS.widgetImg();
		PENCIWIDGETS.customSidebar.init();
	});
} );

