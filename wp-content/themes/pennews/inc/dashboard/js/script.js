( function ( $ ) {
	'use strict';

	// Upload
	function pennews_upload_image_font( ) {
		pennews_upload_font( 'pennews-cf1' );
		pennews_upload_font( 'pennews-cf2' );
		pennews_upload_font( 'pennews-cf3' );
		pennews_upload_font( 'pennews-cf4' );
		pennews_upload_font( 'pennews-cf5' );
		pennews_upload_font( 'pennews-cf6' );
		pennews_upload_font( 'pennews-cf7' );
		pennews_upload_font( 'pennews-cf8' );
		pennews_upload_font( 'pennews-cf9' );
		pennews_upload_font( 'pennews-cf10' );

		pennews_delete_font( 'pennews-cf1' );
		pennews_delete_font( 'pennews-cf2' );
		pennews_delete_font( 'pennews-cf3' );
		pennews_delete_font( 'pennews-cf4' );
		pennews_delete_font( 'pennews-cf5' );
		pennews_delete_font( 'pennews-cf6' );
		pennews_delete_font( 'pennews-cf7' );
		pennews_delete_font( 'pennews-cf8' );
		pennews_delete_font( 'pennews-cf9' );
		pennews_delete_font( 'pennews-cf10' );

		custom_google_fonts();
	}

	function pennews_upload_font( id_field ) {
		$( '#' + id_field + '-button-upload' ).click( function ( e ) {
			e.preventDefault();

			window.original_send_to_editor = window.send_to_editor;
			wp.media.editor.open( jQuery( this ) );

			// Hide Gallery, Audio, Video
			var _id_hide = '.media-menu .media-menu-item:nth-of-type';
			$( _id_hide + '(2)' ).addClass( 'hidden' );
			$( _id_hide + '(3)' ).addClass( 'hidden' );
			$( _id_hide + '(4)' ).addClass( 'hidden' );

			window.send_to_editor = function ( html ) {
				var link = $( 'img', html ).attr( 'src' );

				if ( typeof link == 'undefined' ) {
					link = $( html ).attr( 'href' );
				}

				$( '#' + id_field ).val( link );
				$( '#' + id_field + '-button-delete' ).removeClass( 'button-hide' );

				var splitLink = link.split( '/' );
				var fileName = splitLink[splitLink.length - 1].split( '.' );
				$( '#' + id_field + 'family' ).val( fileName[0] );

				tb_remove();

				window.send_to_editor = window.original_send_to_editor;
			};

			return false;

		} );
	}

	function pennews_delete_font( id_field ) {
		$( '#' + id_field + '-button-delete' ).click( function ( e ) {
			e.preventDefault();

			var result = window.confirm('Are you sure you want to delete this font?');
			if ( result == true ) {

				$( this ).addClass('button-hide');

				$( '#' + id_field ).val('');
				$( '#' + id_field + 'family' ).val('');

				tb_remove();
			}
		});
	}

	function custom_google_fonts() {
		$( 'body' ).on( 'change', '.penci-table-options [id$="pennews_enable_all_fontgoogle"]:checkbox', function ( e ) {
			var allFont = $( this );

			if ( this.checked ) {
				allFont.closest( 'tr' ).prev( 'tr' ).animate( {opacity: 'hide', height: 'hide'}, 200 );
			} else {
				allFont.closest( 'tr' ).prev( 'tr' ).animate( {opacity: 'show', height: 'show'}, 200 );
			}
		} );


		$( '.dropdown' ).dropdown({
			allowAdditions: true,
			allowReselection: true,
			delimiter : '|',
		} );

		$( '.dropdown' ).dropdown('set selected',PENCIDASHBOARD.setSelected);

		$( '.penci-clear-font' ).on( 'click', function () {
			$( '.dropdown' ).dropdown( 'clear' );
		} );
	}

	function pennewsEnvatoCodeCheck( ) {
		var $checkLicense = jQuery( '#penci-check-license' ),
			$spinner = $checkLicense.find( '.spinner' ),
			$activateButton = $checkLicense.find( '.pennews-activate-button' ),
			$missing = $checkLicense.find( '.penci-err-missing' ),
			$length = $checkLicense.find( '.penci-err-length' ),
			$invalid = $checkLicense.find( '.penci-err-invalid' ),
			$checkError = $checkLicense.find( '.penci-err-check-error' ),
			$evatoCode = $checkLicense.find( '.evato-code' ),
			$nottoken = $checkLicense.find( '.penci-err-nottoken' );

		$checkLicense.on( 'submit', function ( e ) {
			e.preventDefault();

			var evatoCode = $evatoCode.val(),
				serverId = $checkLicense.find( '.server-id' ).val();

			$spinner.addClass( 'active' );
			$missing.removeClass( 'penci-err-show' );
			$length.removeClass( 'penci-err-show' );
			$invalid.removeClass( 'penci-err-show' );
			$checkError.removeClass( 'penci-err-show' );
			$nottoken.removeClass( 'penci-err-show' );

			if ( ! serverId ) {
				return false;
			}

			if( ! evatoCode ) {
				$missing.addClass( 'penci-err-show' );
				$spinner.removeClass( 'active' );
				return false;
			}

			if( evatoCode.length < 6 ) {
				$length.addClass( 'penci-err-show' );
				$spinner.removeClass( 'active' );
				return false;
			}

			$activateButton.prop('disabled', true);
			$evatoCode.prop('disabled', true);

			var data = {
				action: 'penci_check_envato_code',
				envato_code: evatoCode,
				serverId: serverId
			};

			$.post( PENCIDASHBOARD.ajaxUrl, data, function ( response ) {
				if ( ! response.success ) {
					$spinner.removeClass( 'active' );
					$activateButton.prop( 'disabled', false );
					$evatoCode.prop( 'disabled', false );

					if( response.data.is_wp_error ){
						$checkError.addClass( 'penci-err-show' );
					}else{
						if( response.data.is_purchase_code ) {
							$nottoken.addClass( 'penci-err-show' );
						}else{
							$invalid.addClass( 'penci-err-show' );
						}
					}
				}else{

					$( '.penci-activate-desc' ).html('Theme successfully activated. Thanks for buying our product.');
					$('#penci-check-license').hide();
					
					setTimeout(function(){ 
						window.location.replace('?page=pennews_dashboard_welcome');
					},3000);
					
				}
			} );
		});
	}

	// Auto activate tabs when DOM ready.
	$( pennews_upload_image_font  );

	$( pennewsEnvatoCodeCheck );

	var PENCIDASHBOARDWidth = PENCIDASHBOARDWidth || {};

	PENCIDASHBOARDWidth.ctWidth = {
		colMinW : 150,
		container2colMinW : 600,
		container3colMinW : 1000,
		containerMaxW : 1650,
		transformPxRatio : 10,
		borderSpacing : 4,
		init: function () {
			this.ctWidthContainer();
			this.resetOption();
		},
		ctWidthContainer: function ( ) {
			var $ctwColWrapper = $( '.penci-ctw-col-wrapper' );

			if( ! $ctwColWrapper.length ) {
				return false;
			}
			var self = this;

			$ctwColWrapper.each(function () {
				var $this = $( this ),
					$ctwResizable = $this.find( '.penci-ctw-resizable' ),
					totalCol = 	$ctwResizable.data( 'columns' ),
					totalWidth = $ctwResizable.data( 'total' ),
					minWidth =  totalCol * 100,
					containerMinW = self.container2colMinW;

				if( 3 === totalCol ){
					containerMinW = self.container3colMinW;
				}

				var maxWidth = (( self.containerMaxW - containerMinW ) / ( self.transformPxRatio / 2)) + minWidth,
					initWidth = (( totalWidth - containerMinW ) / ( self.transformPxRatio / 2)) + minWidth;

				$this.width( initWidth );

				$ctwResizable.resizable({
					handles: 'e,w',
					minHeight: 280,
					maxHeight: 280,
					minWidth: minWidth,
					maxWidth: maxWidth,
					resize: function( event, ui ) {
						var uiSizeWidth = ui.size.width;
						if ( uiSizeWidth % 2) {
							return false;
						}

						var $uiWrapper = ui.element.closest('.penci-ctw-col-wrapper'),
						$main = $uiWrapper.find( '.penci-ctw-col-main' ),
						$sidebar1 = $uiWrapper.find( '.penci-ctw-col-sidebar1' ),
						$sidebar2 = $uiWrapper.find( '.penci-ctw-col-sidebar2' ),
						calcTotal = ( containerMinW + ( self.transformPxRatio * ( ( uiSizeWidth - minWidth ) / 2 ) ) );

						ui.element.css('left', ui.position.left);
						$uiWrapper.outerWidth( ui.size.width );
						$uiWrapper.find( '.penci-ctw-total-wrapper' ).outerWidth( ui.size.width ).css('left', ui.position.left);
						$uiWrapper.find( '.penci-ctw-total-val' ).text( Math.ceil(calcTotal ) + 'px');
						$uiWrapper.find( '.penci-ctw-resizable' ).attr( 'data-total', Math.ceil(calcTotal ));
						$uiWrapper.find( 'input.total-width' ).val(calcTotal);

						if( 2 == totalCol ){
							var sidebar1Wpx =  parseFloat( $sidebar1.attr('data-widthpx') ),
							    sidebar1Wprc =  Math.round( ( ( sidebar1Wpx / calcTotal ) * 100 ) * 100)/100,
								mainWpx = Math.ceil( calcTotal - sidebar1Wpx ),
								mainWprc = Math.round( ( 100 - sidebar1Wprc ) * 100 )/ 100;

							$sidebar1.attr( 'data-widthprc', sidebar1Wprc ).find('.penci-ctw-label-per').text( sidebar1Wprc + '%');
							$main.attr( 'data-widthpx', mainWpx ).attr( 'data-widthprc', sidebar1Wprc );
							$main.find('.penci-ctw-label-per').text( mainWprc + '%');
							$main.find('.penci-ctw-label-px').text( mainWpx + 'px');

							$uiWrapper.find( 'input.col-1-width' ).val(mainWprc);
							$uiWrapper.find( 'input.col-2-width' ).val(sidebar1Wprc);

						}else if( 3 == totalCol ){
							var sidebar1Wpx =  parseFloat( $sidebar1.attr('data-widthpx') ),
								sidebar1Wprc =  Math.round( ( ( sidebar1Wpx / calcTotal ) * 100 ) * 100)/100,
								sidebar2Wpx =  parseFloat( $sidebar2.attr('data-widthpx') ),
								sidebar2Wprc =  Math.round( ( ( sidebar2Wpx / calcTotal ) * 100 ) * 100)/100,
								mainWpx = Math.ceil( calcTotal - ( sidebar1Wpx + sidebar2Wpx ) ),
								mainWprc = Math.round( ( 100 - ( sidebar1Wprc + sidebar2Wprc ) ) * 100 )/ 100;
							
							$sidebar1.attr( 'data-widthprc', sidebar1Wprc ).find('.penci-ctw-label-per').text( sidebar1Wprc + '%');
							$sidebar2.attr( 'data-widthprc', sidebar2Wprc ).find('.penci-ctw-label-per').text( sidebar2Wprc + '%');
							$main.attr( 'data-widthpx', mainWpx ).attr( 'data-widthprc', sidebar1Wprc );
							$main.find('.penci-ctw-label-per').text( mainWprc + '%');
							$main.find('.penci-ctw-label-px').text( mainWpx + 'px');

							$uiWrapper.find( 'input.col-1-width' ).val( sidebar1Wprc );
							$uiWrapper.find( 'input.col-2-width' ).val( mainWprc );
							$uiWrapper.find( 'input.col-3-width' ).val( sidebar2Wprc );
						}
					},
					start: function( event, ui ) {
						ui.element.find('.penci-ctw-col').css({'min-width': '', 'max-width': ''});
						var $uiWrapper = ui.element.closest('.penci-ctw-col-wrapper');

						$uiWrapper.find( '.penci-ctw-col' ).each( function(){
							var $this = $( this ),
								widthper =  $this.find( '.penci-ctw-label-per' ).text();
							$this.outerWidth( widthper );
						} );
					}
				});
				$ctwResizable.data('resize-options', {maxWidth: maxWidth});

				$(".penci-ctw-cols").each(function () {
					$( this ).find( '.penci-ctw-col:not(:last)' ).resizable({
						handles: 'e',
						minHeight: 250,
						maxHeight: 250,
						resize: function (e, ui) {
							var uiSizeWidth = ui.size.width;

							if ( uiSizeWidth % 2) {
								return false;
							}
							var $colsChange = [ui.element,ui.element.next('.penci-ctw-col')],
						 	$uiWrapper = ui.element.closest( '.penci-ctw-col-wrapper' ),
							$resizableCols = $uiWrapper.find( '.penci-ctw-col' ),
							$colsnoChange  = $resizableCols,
							$resizableColNext = ui.element.next( '.penci-ctw-col' );

							$colsChange.forEach(function (el) {
			                    $colsnoChange = $colsnoChange.not(el);
			                });

			                var totalPx = 0,
				                totalPer = 100,
			                	prcnoChange = 0,
			                	pxnoChange = 0;

			                if( $colsnoChange ){
			                	$resizableCols = $resizableCols.not( $colsnoChange );
			                	prcnoChange =  parseFloat( $colsnoChange.attr('data-widthprc') );
			                	pxnoChange = parseFloat( $colsnoChange.attr('data-widthpx') );
			                }

			                if( prcnoChange ){
			                	totalPer = 100 - prcnoChange;
			                }

			                $resizableCols.each(function () {
			                    var $this = $(this);
			                    totalPx += parseFloat( $this.attr('data-widthpx') );
			                });

			                if( ! totalPx ){
			                	return false;
			                }

							$resizableCols.filter(':not(:last)').each( function () {

								var $this = $( this ),
									colIndex = $this.data( 'index' ),
									totalWidth = $uiWrapper.find( 'input.total-width' ).val(),
									uiWrapperWidth = $uiWrapper.outerWidth();

								var prc = Math.round(parseFloat( ( $this.outerWidth() * 100 )  / uiWrapperWidth ) * 100)/100,
									px = Math.ceil(prc / 100 * totalWidth);

								$this.attr( 'data-widthprc', prc ).attr( 'data-widthpx', px );
								$this.find( '.penci-ctw-label-per' ).text( prc + '%' );
								$this.find( '.penci-ctw-label-px' ).text( px + 'px' );

								$uiWrapper.find( 'input.col-' + colIndex + '-width' ).val( prc );

								totalPer -= prc;
								totalPx -= px;
							} );

							totalPer = Math.round(parseFloat( totalPer ) * 100)/100;
							totalPx  = Math.ceil( totalPx );

							var $lastColChange = $resizableCols.filter(':last'),
								indexlastCol = $lastColChange.attr( 'data-index' );

							$lastColChange.attr( 'data-widthprc', totalPer ).attr( 'data-widthpx', totalPx );
							$lastColChange.find( '.penci-ctw-label-per' ).text( totalPer + '%' );
							$lastColChange.find( '.penci-ctw-label-px' ).text( totalPx + 'px' );
							$uiWrapper.find( 'input.col-' + indexlastCol + '-width' ).val( totalPer );
						},
						start: function (e, ui) {
							var $uiWrapper = ui.element.closest('.penci-ctw-col-wrapper'),
							$ctwResizable = $uiWrapper.find( '.penci-ctw-resizable' ),
							totalWidth = $uiWrapper.find( 'input.total-width' ).val(),
							columns = 	$ctwResizable.data('columns'),
							calcBorderSpacing = Math.max(2, ( columns - 1)) * self.borderSpacing,
							wrapperWidth = $ctwResizable.width(),
							minWidth = Math.floor( self.colMinW * wrapperWidth / totalWidth );

							ui.originalElement.resizable('option', 'minWidth', minWidth);

							var bothColumnWidth = ui.originalElement.next('.penci-ctw-col').width() + ui.originalElement.width() + calcBorderSpacing,
								maxWidth = bothColumnWidth - minWidth;

							ui.originalElement.resizable('option', 'maxWidth', maxWidth);

							ui.element.attr('style', '');
							ui.element.next('.penci-ctw-col').attr('style', '');
						},
						stop: function (event, ui) {
							var totalWidth = 0,
								widthStatus = [];

							$(".penci-ctw-col", ui.element.parent()).each(function () {
								var $this = $(this),
									cellWidth = $this.outerWidth();

								totalWidth += cellWidth;
								widthStatus.push([$this, cellWidth]);
							}).promise().done(function () {
								totalWidth /= 100;

								for (var i = 0; i < widthStatus.length; i++) {
									var $el = widthStatus[i][0];

									$el.width((widthStatus[i][1] / totalWidth) + '%');
								}
							});

						},
					});
				});
			} );
		},
		resetOption: function(){
			$( '.penci-resiable-reset' ).on( 'click', function () {
				var $this = $( this ),
					$uiWrapper = $this.closest( '.penci-ctw-col-wrapper' ),
					$ctwResizable = $uiWrapper.find( '.penci-ctw-resizable' ),
					totalCol = 	$ctwResizable.data( 'columns' );


				$uiWrapper.attr('style', '');
				$ctwResizable.attr('style', '');

				if ( 2 === totalCol ) {
					$uiWrapper.find( 'input.total-width' ).val( '1100' );
					$uiWrapper.find( '.penci-ctw-total-val' ).text( '1100px' );

					$ctwResizable.attr( 'data-total', 1100 ).css( 'width','302px' );

					$uiWrapper.find( 'input.col-1-width' ).val( '73' );
					var $colMain = $uiWrapper.find( '.penci-ctw-col-main' );
					$colMain.css( 'width', '73%' ).attr( 'data-widthprc', 73 ).attr( 'data-widthpx', 800 );
					$colMain.find( '.penci-ctw-label-per' ).text( '73%' );
					$colMain.find( '.penci-ctw-label-px' ).text( '800px' );

					$uiWrapper.find( 'input.col-2-width' ).val( '27' );
					var $colSidebar1 = $uiWrapper.find( '.penci-ctw-col-sidebar1' );
					$colSidebar1.css( 'width', '27%' ).attr( 'data-widthprc', 27 ).attr( 'data-widthpx', 300 );
					$colSidebar1.find( '.penci-ctw-label-per' ).text( '27%' );
					$colSidebar1.find( '.penci-ctw-label-px' ).text( '300px' );

				} else {

					$uiWrapper.find( 'input.total-width' ).val( '1400' );
					$uiWrapper.find( '.penci-ctw-total-val' ).text( '1400px' );
					$ctwResizable.attr( 'data-total', 1400 );

					$uiWrapper.find( 'input.col-2-width' ).val( '57.2' ).css( 'width','460px' );
					var $colMain = $uiWrapper.find( '.penci-ctw-col-main' );
					$colMain.css( 'width', '57.2%' ).attr( 'data-widthprc', 57.2 ).attr( 'data-widthpx', 800 );
					$colMain.find( '.penci-ctw-label-per' ).text( '57.2%' );
					$colMain.find( '.penci-ctw-label-px' ).text( '800px' );


					$uiWrapper.find( 'input.col-1-width' ).val( '21.4' );
					var $colSidebar1 = $uiWrapper.find( '.penci-ctw-col-sidebar1' );
					$colSidebar1.css( 'width', '21%' ).attr( 'data-widthprc', 21.4 ).attr( 'data-widthpx', 300 );
					$colSidebar1.find( '.penci-ctw-label-per' ).text( '21.4%' );
					$colSidebar1.find( '.penci-ctw-label-px' ).text( '300px' );

					$uiWrapper.find( 'input.col-3-width' ).val( '21.4' );
					var $colSidebar2 = $uiWrapper.find( '.penci-ctw-col-sidebar2' );
					$colSidebar2.css( 'width', '21%' ).attr( 'data-widthprc', 21.4 ).attr( 'data-widthpx', 300 );
					$colSidebar2.find( '.penci-ctw-label-per' ).text( '21.4%' );
					$colSidebar2.find( '.penci-ctw-label-px' ).text( '300px' );
				}

				$uiWrapper.find( '.penci-ctw-total-wrapper' ).attr('style', $ctwResizable.attr( 'style' ) );

				return false;
			} );
		}
	};

	$( document ).ready( function () {
		PENCIDASHBOARDWidth.ctWidth.init();
	});

} ( jQuery ) );
