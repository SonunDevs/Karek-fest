jQuery( function ( $ ) {
	'use strict';

	var $body = $( 'body' );

	function penciAddAds() {
		var $listAds = $( '#pennews-list-ads' );
		var adsIndex = PENCIADS.Index;
		
		$body.on( 'click', '#pennews-add-ads', function ( e ) {
			e.preventDefault();

			var $html = '<li class="penci-ad-item penci-ad-item-' + adsIndex + ' ui-sortable-handle">' +
			            '<div class="penci-ads-row">' +
			            '<div class="penci-ads-label">' +
			            '<span class="penci-ads-title">' + PENCIADS.ADCodeTitle + '</span>' +
			            '<span class="penci-ads-desc">' + PENCIADS.ADCodedesc + ' </span>' +
			            '</div>' +
			            '<div class="penci-ads-control">' +
			            '<textarea name="penci_ads[' + adsIndex + '][ad_code]"></textarea>' +
			            '</div>' +
			            '</div>' +
			            '<div class="penci-ads-row">' +
			            '<div class="penci-ads-label">' +
			            '<span class="penci-ads-title">' + PENCIADS.ADTitle + '</span>' +
			            '</div>' +
			            '<div class="penci-ads-control">' +
			            '<input type="text" name="penci_ads[' + adsIndex + '][ad_title]" value="Pennews Ad ' + adsIndex + '">' +
			            '</div>' +
			            '</div>' +
			            '<div class="penci-ads-row">' +
			            '<div class="penci-ads-label">' +
			            '<span class="penci-ads-title">' + PENCIADS.textShortcode + '</span>' +
			            '</div>' +
			            '<div class="penci-ads-control">' +
			            '<span class="penci-ads-shortcode">[penci_ads id="penci_ads_' + adsIndex + '"]</span>' +
			            '<input type="hidden" name="penci_ads[' + adsIndex + '][ad_id]" value="penci_ads_' + adsIndex + '">' +
			            '<a class="button penci-btn-remove-ad"><span class="dashicons dashicons-trash"></span>' + PENCIADS.textDelete + '</a>' +
			            '</div>' +
			            '</div>' +
			            '</li>';

			$listAds.append( $html );

			$( '#penci_ads_index' ).val( adsIndex );
			adsIndex ++;
		} );

		$body.on( 'click', '.penci-btn-remove-ad', function ( e ) {
			e.preventDefault();

			$( this ).closest( '.penci-ad-item' ).fadeOut( function () {
				$( this ).remove();
			} );
		} );
	}

	$( document ).ready( function () {
		penciAddAds();
	} );
} );