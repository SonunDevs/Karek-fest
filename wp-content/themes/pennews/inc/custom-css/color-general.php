<?php
if ( function_exists( 'penci_customizer_color_general' ) ) {
	return;
}
function penci_customizer_color_general() {
	$css = '';

	if( penci_get_theme_mod( 'penci_dis_padding_block_widget' ) ) {
		$css .='body{ background-color: #fff; }';
	}

	if( penci_get_theme_mod( 'background_color' ) ) {
		$css .= sprintf(
		'.penci_dis_padding_bw .penci-block-vc.style-title-11:not(.footer-widget) .penci-block__title a,
		.penci_dis_padding_bw .penci-block-vc.style-title-11:not(.footer-widget) .penci-block__title span, 
		.penci_dis_padding_bw .penci-block-vc.style-title-11:not(.footer-widget) .penci-subcat-filter, 
		.penci_dis_padding_bw .penci-block-vc.style-title-11:not(.footer-widget) .penci-slider-nav{ background-color:#%s; }',  penci_get_theme_mod( 'background_color' ) );
	}

	$color_text_body   = penci_get_theme_mod( 'penci_color_body' );
	$penci_colorscheme = penci_get_theme_mod( 'penci_colorscheme' );


	if( 'dark' == $penci_colorscheme ){
		$css .= '.penci-tags-links a {color: #bbb;background: #212121;}';
	}

	if ( ( $color_text_body && '#666666' !== $color_text_body ) || ( $color_text_body && 'dark' == $penci_colorscheme )  ) {
		$css .= sprintf( 'body, input, select, textarea,
			.widget.widget_display_replies li, .widget.widget_display_topics li,
			.widget ul li,
			.error404 .page-title,
			.entry-content .penci-recipe-heading h2,
			.entry-content .penci-recipe-title,
			#respond h3,.penci-review-text,#respond textarea, .wpcf7 textarea,
			.woocommerce .woocommerce-product-search input[type="search"],
			.woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span,
			.woocommerce table.shop_table th,
			.woocommerce-page form .form-row .input-text,
			.select2-container--default .select2-selection--single .select2-selection__rendered,
			#respond label, .wpcf7 label,
			.mc4wp-form,
			#bbpress-forums li.bbp-body ul.forum li.bbp-forum-topic-count, #bbpress-forums li.bbp-body ul.forum li.bbp-forum-reply-count,
			#bbpress-forums li.bbp-body ul.forum li.bbp-forum-freshness, #bbpress-forums li.bbp-body ul.forum li.bbp-forum-freshness a, 
			#bbpress-forums li.bbp-body ul.topic li.bbp-forum-topic-count, #bbpress-forums li.bbp-body ul.topic li.bbp-topic-voice-count,
			#bbpress-forums li.bbp-body ul.topic li.bbp-forum-reply-count, #bbpress-forums li.bbp-body ul.topic li.bbp-topic-freshness > a,
			#bbpress-forums li.bbp-body ul.topic li.bbp-topic-freshness, #bbpress-forums li.bbp-body ul.topic li.bbp-topic-reply-count,
			div.bbp-template-notice, div.indicator-hint,
			#bbpress-forums fieldset.bbp-form legend,
			.entry-content code, .wpb_text_column code, .entry-content blockquote.wp-block-quote p, .entry-content blockquote.wp-block-quote p,
			.penci_dark_layout blockquote.style-3, .penci_dark_layout blockquote.style-3 p,
			.penci_dark_layout blockquote.style-2,.penci_dark_layout blockquote.style-2 p,
			.wpb_text_column blockquote.wp-block-quote p, .wpb_text_column blockquote.wp-block-quote p,
			.widget.widget_display_views li, .widget.widget_display_forums li, .widget.widget_layered_nav li,
			.widget.widget_product_categories li, .widget.widget_categories li, .widget.widget_archive li,
			.widget.widget_pages li, .widget.widget_meta li, .wp-block-pullquote{ color:%s }', esc_attr( $color_text_body ) );
	}

	$block_bgcolor = penci_get_theme_mod( 'penci_block_bgcolor' );
	if ( $block_bgcolor ) {
		$css .= sprintf( '
		.penci-ajax-search-results .ajax-loading:before,
		.show-search .show-search__content,
		div.bbp-template-notice, div.indicator-hint,	
		.widget select,select, pre,.wpb_text_column,
		.single .penci-content-post, .page .penci-content-post,
		.forum-archive .penci-content-post,
		.penci-block-vc,.penci-archive__content,.error404 .not-found,.ajax-loading:before{ background-color:%s }', esc_attr( $block_bgcolor ) );

		$css .= sprintf( '
		.penci-block-vc.style-title-11:not(.footer-widget) .penci-block__title a,
		.penci-block-vc.style-title-11:not(.footer-widget) .penci-block__title span, 
		.penci-block-vc.style-title-11:not(.footer-widget) .penci-subcat-filter, 
		.penci-block-vc.style-title-11:not(.footer-widget) .penci-slider-nav{ background-color:%s }', esc_attr( $block_bgcolor ) );
	}

	$color_meta = penci_get_theme_mod( 'penci_color_meta' );
	if ( $color_meta ) {
		$css .= sprintf( '.penci-archive .entry-meta,.penci-archive .entry-meta a,

			.penci-inline-related-posts .penci_post-meta, .penci__general-meta .penci_post-meta, 
			.penci-block_video.style-1 .penci_post-meta, .penci-block_video.style-7 .penci_post-meta,
			.penci_breadcrumbs a, .penci_breadcrumbs span,.penci_breadcrumbs i,
			.error404 .page-content,
			.woocommerce .comment-form p.stars a,
			.woocommerce .woocommerce-ordering, .woocommerce .woocommerce-result-count,
			.woocommerce #reviews #comments ol.commentlist li .comment-text .meta,
			.penci-entry-meta,#wp-calendar caption,.penci-post-pagination span,
			.penci-archive .entry-meta span{ color:%s }', esc_attr( $color_meta ) );
	}

	$color_links = penci_get_theme_mod( 'penci_color_links' );

	if ( $color_links ) {
		$css .= sprintf( '
		.site-main .element-media-controls a, .entry-content .element-media-controls a,
		    .penci-portfolio-below_img .inner-item-portfolio .portfolio-desc h3,
			.post-entry .penci-portfolio-filter ul li a, .penci-portfolio-filter ul li a,
			.widget_display_stats dt, .widget_display_stats dd,
			#wp-calendar tbody td a,
			.widget.widget_display_replies a,
			.post-entry .penci-portfolio-filter ul li.active a, .penci-portfolio-filter ul li.active a,
			.woocommerce div.product .woocommerce-tabs ul.tabs li a,
			.woocommerce ul.products li.product h3, .woocommerce ul.products li.product .woocommerce-loop-product__title,
			.woocommerce table.shop_table td.product-name a,
			input[type="text"], input[type="email"], input[type="url"], input[type="password"],
			input[type="search"], input[type="number"], input[type="tel"], input[type="range"], input[type="date"],
			input[type="month"], input[type="week"], input[type="time"], input[type="datetime"], input[type="datetime-local"], input[type="color"], textarea,
			.error404 .page-content .search-form .search-submit,.penci-no-results .search-form .search-submit,.error404 .page-content a,
			a,.widget a,.penci-block-vc .penci-block__title a, .penci-block-vc .penci-block__title span,
			.penci-page-title, .penci-entry-title,.woocommerce .page-title,
			.penci-recipe-index-wrap .penci-recipe-index-title a,
			.penci-social-buttons .penci-social-share-text,
			.woocommerce div.product .product_title,
			.penci-post-pagination h5 a,
			.woocommerce div.product .woocommerce-tabs .panel > h2:first-child, .woocommerce div.product .woocommerce-tabs .panel #reviews #comments h2,
			.woocommerce div.product .woocommerce-tabs .panel #respond .comment-reply-title,
			.woocommerce #reviews #comments ol.commentlist li .comment-text .meta strong,
			.woocommerce div.product .related > h2, .woocommerce div.product .upsells > h2,
			.penci-author-content .author-social,
			.forum-archive .penci-entry-title,
			#bbpress-forums li.bbp-body ul.forum li.bbp-forum-info a,
			.woocommerce div.product .entry-summary div[itemprop="description"] h2, .woocommerce div.product .woocommerce-tabs #tab-description h2,
			.widget.widget_recent_entries li a, .widget.widget_recent_comments li a, .widget.widget_meta li a,
			.penci-pagination:not(.penci-ajax-more) a, .penci-pagination:not(.penci-ajax-more) span{ color:%s }', esc_attr( $color_links ) );

	}

	$color_heading = penci_get_theme_mod( 'penci_color_heading' );
	if ( $color_heading ) {
		$css .= sprintf( '
		h1, h2, h3, h4, h5, h6,.penci-userreview-author,.penci-review-metas .penci-review-meta i,
		.entry-content h1, .entry-content h2, .entry-content h3, .entry-content h4,
		.entry-content h5, .entry-content h6, .comment-content h1, .comment-content h2,
		.comment-content h3, .comment-content h4, .comment-content h5, .comment-content h6,
		.penci-inline-related-posts .penci-irp-heading{ color:%s }', esc_attr( $color_links ) );
	}

	$color_border = penci_get_theme_mod( 'penci_color_border' );
	if ( $color_border ) {

		$css .= '.site-main .frontend-form-container .element-media-file,';
		$css .= '.site-main .frontend-form-container .element-media,';
		$css .= '.site-main .frontend-item-container .select2.select2-container .select2-selection.select-with-search-container,';
		$css .= '.site-main .frontend-item-container input[type="text"],';
		$css .= '.site-main .frontend-item-container input[type="email"],';
		$css .= '.site-main .frontend-item-container input[type="url"],';
		$css .= '.site-main .frontend-item-container textarea,';
		$css .= '.site-main .frontend-item-container select';
		$css .= '{ border-color: ' . esc_attr( $color_border ) . ' }';

		if ( class_exists( 'bbPress' ) || class_exists( 'BuddyPress' ) ) {
			$css .= '.activity-update-form,.activity-list.bp-list .activity-item,
			.rtl .activity-update-form{ 
			 webkit-box-shadow: inset 0 0 6px ' . esc_attr( $color_border ) . ';
		    -moz-box-shadow: inset 0 0 6px ' . esc_attr( $color_border ) . ';
		    box-shadow: inset 0 0 6px ' . esc_attr( $color_border ) . ';}';

			$css .= '.activity-list.bp-list,.activity-list li.bbp_topic_create .activity-content .activity-inner,
				.penci_dark_layout .activity-list li.bbp_reply_create .activity-content .activity-inner {
			        background: ' . penci_convert_hex_rgb( $color_border, '0.2' ) . ';
			}';

			$css .= '@media screen and (min-width: 46.8em){
			.buddypress-wrap.bp-dir-hori-nav:not(.bp-vertical-navs) nav:not(.tabbed-links) {
			 webkit-box-shadow: inset 0 0 6px ' . esc_attr( $color_border ) . ';
		    -moz-box-shadow: inset 0 0 6px ' . esc_attr( $color_border ) . ';
		    box-shadow: inset 0 0 6px ' . esc_attr( $color_border ) . '; border-color:' . esc_attr( $color_border ) . '; } }';

			$css .= '.buddypress-wrap .bp-messages,
				.site-main #buddypress .dir-search input[type=search],
				.site-main #buddypress .dir-search input[type=text], 
				.site-main #buddypress .bp-search input[type=search],
				.site-main #buddypress .bp-search input[type=text], 
				.site-main #buddypress .groups-members-search input[type=search],
				.site-main #buddypress .groups-members-search input[type=text],
				.buddypress-wrap .bp-search form:focus,
				.buddypress-wrap .bp-search form:hover,
				.buddypress-wrap .select-wrap:focus,
				.buddypress-wrap .select-wrap:hover{ border-color: ' . esc_attr( $color_border ) . ' }';
		}
		$css .= sprintf( '
			.site-header,
			.buddypress-wrap .select-wrap,
			.penci-post-blog-classic,
			.activity-list.bp-list,
			.penci-team_memebers .penci-team_item__content,
			.penci-author-box-wrap,
			.about-widget .about-me-heading:before,
			#buddypress .wp-editor-container,
			#bbpress-forums .bbp-forums-list,
			div.bbp-forum-header, div.bbp-topic-header, div.bbp-reply-header,
			.activity-list li.bbp_topic_create .activity-content .activity-inner,
			.rtl .activity-list li.bbp_reply_create .activity-content .activity-inner,
			#drag-drop-area,
			.bp-avatar-nav ul.avatar-nav-items li.current,
			.bp-avatar-nav ul,
			.site-main .bbp-pagination-links a, .site-main .bbp-pagination-links span.current,
			.bbpress  .wp-editor-container,
			.penci-ajax-search-results-wrapper,
			.show-search .search-field,
			.show-search .show-search__content,
			.penci-viewall-results,
			.penci-subcat-list .flexMenu-viewMore .flexMenu-popup,
			.penci-owl-carousel-style .owl-dot span,
			.penci-owl-carousel-slider .owl-dot span,
			.woocommerce-cart table.cart td.actions .coupon .input-text,
			.blog-boxed .penci-archive__content .article_content,
			.penci-block_28 .block28_first_item:not(.hide-border),
			.penci-mul-comments-wrapper .penci-tab-nav,
			.penci-recipe,.penci-recipe-heading,.penci-recipe-ingredients,.penci-recipe-notes,
			.wp-block-yoast-faq-block .schema-faq-section,
			.wp-block-yoast-how-to-block ol.schema-how-to-steps,
			.wp-block-pullquote,
			.wrapper-penci-recipe .penci-recipe-ingredients
			{ border-color:%s }', esc_attr( $color_border ) );

		$css .= sprintf( '
		    blockquote:not(.wp-block-quote):before, q:before,   
		    blockquote:not(.wp-block-quote):after, q:after, blockquote.style-3:before,
			.penci-block-vc.style-title-10:not(.footer-widget) .penci-block-heading:after
			{ background-color:%s }', esc_attr( $color_border ) );

		$css .= sprintf( '
			.penci-block-vc.style-title-10:not(.footer-widget) .penci-block-heading,
			.wrapper-penci-review, .penci-review-container.penci-review-count,.penci-usewr-review,
			.widget .tagcloud a,.widget.widget_recent_entries li, .widget.widget_recent_comments li, .widget.widget_meta li,
		    .penci-inline-related-posts,
		    .penci_dark_layout .site-main #buddypress div.item-list-tabs:not(#subnav),
			code,abbr, acronym,fieldset,hr,#bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content,
			.penci-pagination:not(.penci-ajax-more) a, .penci-pagination:not(.penci-ajax-more) span,
			th,td,#wp-calendar tbody td{ border-color:%s }', esc_attr( $color_border ) );

		if ( class_exists( 'WooCommerce' ) ) {
			$css .= sprintf( '
			.woocommerce ul.cart_list li, .woocommerce ul.product_list_widget li,
			.woocommerce .woocommerce-product-search input[type="search"],
			.woocommerce .widget_shopping_cart .total, .woocommerce.widget_shopping_cart .total,
			.woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span,
			.woocommerce div.product .entry-summary div[itemprop="description"] hr, 
			.woocommerce div.product .woocommerce-tabs #tab-description hr,
			.woocommerce div.product .product_meta,
			.woocommerce div.product .woocommerce-tabs ul.tabs,
			.woocommerce div.product .woocommerce-tabs ul.tabs::before,
			.woocommerce #reviews #comments ol.commentlist li .comment-text,
			.woocommerce div.product .related > h2, .woocommerce div.product .upsells > h2,
			.woocommerce .woocommerce-error, .woocommerce .woocommerce-info, .woocommerce .woocommerce-message,
			.woocommerce table.shop_table td,
			.woocommerce table.shop_table a.remove,
			.woocommerce-cart .cart-collaterals .cart_totals table,
			.woocommerce form.checkout_coupon, .woocommerce form.login, .woocommerce form.register,
			.woocommerce form .form-row .input-text,
			.woocommerce form.checkout table.shop_table,
			.woocommerce-checkout #payment ul.payment_methods{ border-color:%s }', esc_attr( $color_border ) );

			$css .= '.site-main #buddypress table.notifications tr td.label, #buddypress table.notifications-settings tr td.label,';
			$css .= '#add_payment_method .cart-collaterals .cart_totals tr td, #add_payment_method .cart-collaterals .cart_totals tr th,';
			$css .= '.woocommerce-cart .cart-collaterals .cart_totals tr td, .woocommerce-cart .cart-collaterals .cart_totals tr th,';
			$css .= '.woocommerce-checkout .cart-collaterals .cart_totals tr td, .woocommerce-checkout .cart-collaterals .cart_totals tr th';
			$css .= '#add_payment_method table.cart td.actions .coupon .input-text, .woocommerce-cart table.cart td.actions .coupon .input-text,';
			$css .= '.woocommerce table.shop_table,.select2-container--default .select2-selection--single,';
			$css .= '.woocommerce .woocommerce-customer-details address,';
			$css .= '.woocommerce-checkout table.cart td.actions .coupon .input-text';
			$css .= '{ border-color: ' . esc_attr( $color_border ) . '; }';
		}

		$css .= sprintf( '
			.site-main #bbpress-forums li.bbp-body ul.forum,
			.site-main #bbpress-forums li.bbp-body ul.topic,#bbpress-forums li.bbp-footer,
			#bbpress-forums div.bbp-template-notice.info,
			.bbp-pagination-links a, .bbp-pagination-links span.current,
			.site-main #buddypress .standard-form textarea,
			.site-main #buddypress .standard-form input[type=text], .site-main #buddypress .standard-form input[type=color], 
			.site-main #buddypress .standard-form input[type=date], .site-main #buddypress .standard-form input[type=datetime],
			.site-main #buddypress .standard-form input[type=datetime-local], .site-main #buddypress .standard-form input[type=email],
			.site-main #buddypress .standard-form input[type=month], .site-main #buddypress .standard-form input[type=number], 
			.site-main #buddypress .standard-form input[type=range], .site-main #buddypress .standard-form input[type=search], 
			.site-main #buddypress .standard-form input[type=tel], .site-main #buddypress .standard-form input[type=time],
		    .site-main #buddypress .standard-form input[type=url], .site-main #buddypress .standard-form input[type=week],
		    .site-main #buddypress .standard-form select,.site-main #buddypress .standard-form input[type=password],
	        .site-main #buddypress .dir-search input[type=search], .site-main #buddypress .dir-search input[type=text],
	        .site-main #buddypress .groups-members-search input[type=search], .site-main #buddypress .groups-members-search input[type=text],
	        .site-main #buddypress button, .site-main #buddypress a.button,
	        .site-main #buddypress input[type=button], .site-main #buddypress input[type=reset],
	        .site-main #buddypress ul.button-nav li a,.site-main #buddypress div.generic-button a,.site-main #buddypress .comment-reply-link, 
	        a.bp-title-button,.site-main #buddypress button:hover,.site-main #buddypress a.button:hover, .site-main #buddypress a.button:focus,
	        .site-main #buddypress input[type=button]:hover, .site-main #buddypress input[type=reset]:hover, 
	        .site-main #buddypress ul.button-nav li a:hover, .site-main #buddypress ul.button-nav li.current a,
	        .site-main #buddypress div.generic-button a:hover,.site-main #buddypress .comment-reply-link:hover,
	        .site-main #buddypress input[type=submit]:hover,.site-main #buddypress select,.site-main #buddypress ul.item-list,
			.site-main #buddypress .profile[role=main],.site-main #buddypress ul.item-list li,.site-main #buddypress div.pagination .pag-count ,
			.site-main #buddypress div.pagination .pagination-links span,.site-main #buddypress div.pagination .pagination-links a,
			body.activity-permalink .site-main #buddypress div.activity-comments, .site-main #buddypress div.activity-comments form .ac-textarea,
			.site-main #buddypress table.profile-fields, .site-main #buddypress table.profile-fields:last-child{ border-color:%s }', esc_attr( $color_border ) );

		$css .= '.site-main #buddypress table.notifications tr td.label, #buddypress table.notifications-settings tr td.label,';
		$css .= '.site-main #buddypress table.profile-fields tr td.label, #buddypress table.wp-profile-fields tr td.label,';
		$css .= '.site-main #buddypress table.messages-notices tr td.label, #buddypress table.forum tr td.label';
		$css .= '{ border-color: ' . esc_attr( $color_border ) . ' !important; }';

		$css .= sprintf( '
			.penci-block-vc,
			.penci-block_1 .block1_first_item,
			.penci-block_1 .block1_first_item .penci_post-meta,
			.penci-block_1 .block1_items .penci_media_object,
			.penci-block_4 .penci-small-thumb:after,
			.penci-recent-rv,
			.penci-block_6 .penci-post-item,
			.penci-block_9 .block9_first_item,.penci-block_9 .penci-post-item,
			.penci-block_9 .block9_items .block9_item_loadmore:first-of-type,
			.penci-block_11 .block11_first_item,.penci-block_11 .penci-post-item,
			.penci-block_11 .block11_items .block11_item_loadmore:first-of-type,
			.penci-block_15 .penci-post-item,.penci-block_15 .penci-block__title,
			.penci-block_20 .penci_media_object,
			.penci-block_20 .penci_media_object.penci_mobj-image-right .penci_post_content,
			.penci-block_26 .block26_items .penci-post-item,
			.penci-block_28 .block28_first_item,
			.penci-block_28 .block28_first_item .penci_post-meta,
			.penci-block_29 .block_29_items .penci-post-item,
			.penci-block_30 .block30_items .penci_media_object,
			.penci-block_33 .block33_big_item .penci_post-meta,
			.penci-block_36 .penci-post-item, .penci-block_36 .penci-block__title,
			.penci-block_6 .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:first-child,
			.penci-block_video.style-7 .penci-owl-carousel-slider .owl-dots span,
			.penci-owl-featured-area.style-12 .penci-small_items .owl-item.active .penci-item-mag,
			.penci-videos-playlist .penci-video-nav .penci-video-playlist-nav:not(.playlist-has-title) .penci-video-playlist-item:first-child,
			.penci-videos-playlist .penci-video-nav .penci-video-playlist-nav:not(.playlist-has-title) .penci-video-playlist-item:last-child,
			.penci-videos-playlist .penci-video-nav .penci-video-playlist-item,
			.penci-archive__content .penci-entry-header,
			.page-template-full-width.penci-block-pagination .penci_breadcrumbs,
			.penci-post-pagination,.penci-pfl-social_share,.penci-post-author,
			.penci-social-buttons.penci-social-share-footer,
			.penci-pagination:not(.penci-ajax-more) a,
			.penci-social-buttons .penci-social-item.like{ border-color:%s }', esc_attr( $color_border ) );

		$css .= '.penci-container-width-1080 .penci-content-main.penci-col-4 .penci-block_1 .block1_items .penci-post-item:nth-child(2) .penci_media_object,';
		$css .= '.penci-container-width-1400 .penci-content-main.penci-col-4 .penci-block_1 .block1_items .penci-post-item:nth-child(2) .penci_media_object,';
		$css .= '.wpb_wrapper > .penci-block_1.penci-vc-column-1 .block1_items .penci-post-item:nth-child(2) .penci_media_object,';
		$css .= '.widget-area .penci-block_1 .block1_items .penci-post-item:nth-child(2) .penci_media_object';
		$css .= '{ border-color:' . esc_attr( $color_border ) . ' }';

		$css .= sprintf( '
			.penci-block_6.penci-vc-column-2.penci-block-load_more .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(1),
			.penci-block_6.penci-vc-column-2.penci-block-load_more .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(2),
			.penci-block_6.penci-vc-column-2.penci-block-infinite .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(1),
			.penci-block_6.penci-vc-column-2.penci-block-infinite .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(2),
			.penci-block_36.penci-block-load_more .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:first-child,
		    .penci-block_36.penci-block-infinite .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:first-child,
			.penci-block_36.penci-vc-column-2.penci-block-load_more .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(1),
			.penci-block_36.penci-vc-column-2.penci-block-load_more .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(2),
			.penci-block_36.penci-vc-column-2.penci-block-infinite .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(1),
			.penci-block_36.penci-vc-column-2.penci-block-infinite .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(2),
			.penci-block_6.penci-vc-column-3.penci-block-load_more .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(1),
			.penci-block_6.penci-vc-column-3.penci-block-load_more .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(2),
			.penci-block_6.penci-vc-column-3.penci-block-load_more .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(3),
			.penci-block_6.penci-vc-column-3.penci-block-infinite .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(1),
			.penci-block_6.penci-vc-column-3.penci-block-infinite .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(2),
			.penci-block_6.penci-vc-column-3.penci-block-infinite .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(3),
			.penci-block_36.penci-vc-column-3.penci-block-load_more .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(1),
			.penci-block_36.penci-vc-column-3.penci-block-load_more .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(2), 
			.penci-block_36.penci-vc-column-3.penci-block-load_more .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(3), 
			.penci-block_36.penci-vc-column-3.penci-block-infinite .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(1),
			.penci-block_36.penci-vc-column-3.penci-block-infinite .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(2),
			.penci-block_36.penci-vc-column-3.penci-block-infinite .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(3),
			.penci-block_15.penci-vc-column-2.penci-block-load_more .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(1), 
			.penci-block_15.penci-vc-column-2.penci-block-load_more .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(2),
			.penci-block_15.penci-vc-column-2.penci-block-infinite .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(1),
			.penci-block_15.penci-vc-column-2.penci-block-infinite .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(2),
			.penci-block_15.penci-vc-column-3.penci-block-load_more .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(1),
			.penci-block_15.penci-vc-column-3.penci-block-load_more .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(2),
			.penci-block_15.penci-vc-column-3.penci-block-load_more .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(3),
			.penci-block_15.penci-vc-column-3.penci-block-infinite .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(1),
			.penci-block_15.penci-vc-column-3.penci-block-infinite .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(2),
			.penci-block_15.penci-vc-column-3.penci-block-infinite .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(3){ border-color:%s }', esc_attr( $color_border ) );

		$css .= sprintf( '
			select,input[type="text"], input[type="email"], input[type="url"], input[type="password"], 
			input[type="search"], input[type="number"], input[type="tel"], input[type="range"],
			input[type="date"], input[type="month"], input[type="week"], input[type="time"], 
			input[type="datetime"], input[type="datetime-local"], input[type="color"], textarea,
			.single-portfolio .penci-social-buttons + .post-comments,
			#respond textarea, .wpcf7 textarea,
			.post-comments .post-title-box,.penci-comments-button,
			.penci-comments-button + .post-comments .comment-reply-title,
			.penci-post-related + .post-comments .comment-reply-title,
			.penci-post-related + .post-comments .post-title-box,
			.comments .comment ,.comments .comment, .comments .comment .comment,
			#respond input,.wpcf7 input,.widget_wysija input,
			#bbpress-forums #bbp-search-form .button,
			.site-main #buddypress div.item-list-tabs:not( #subnav ),
			.site-main #buddypress div.item-list-tabs:not(#subnav) ul li a,
			.site-main #buddypress div.item-list-tabs:not(#subnav) ul li > span,
			.site-main #buddypress .dir-search input[type=submit], .site-main #buddypress .groups-members-search input[type=submit],
			#respond textarea,.wpcf7 textarea { border-color:%s } ', esc_attr( $color_border ) );

		$css .= sprintf( '
		    .penci-owl-featured-area.style-13 .penci-small_items .owl-item.active .penci-item-mag:before,
			.site-header.header--s2:before, .site-header.header--s3:not(.header--s4):before, .site-header.header--s6:before,
			.penci_gallery.style-1 .penci-small-thumb:after,
			.penci-videos-playlist .penci-video-nav .penci-video-playlist-item.is-playing,
			.penci-videos-playlist .penci-video-nav .penci-video-playlist-item:hover, 		
			blockquote:before, q:before,blockquote:after, q:after{ background-color:%s }', esc_attr( $color_border ) );

		$css .= sprintf( '.site-main #buddypress .dir-search input[type=submit], .site-main #buddypress .groups-members-search input[type=submit],
			input[type="button"], input[type="reset"], input[type="submit"]{ border-color:%s }', esc_attr( $color_border ) );

		$css .= sprintf( '@media (max-width: 768px) {.penci-post-pagination .prev-post + .next-post {border-color :%s; }}', esc_attr( $color_border ) );
		$css .= sprintf( '@media (max-width: 650px) {.penci-block_1 .block1_items .penci-post-item:nth-child(2) .penci_media_object {border-color :%s; }}', esc_attr( $color_border ) );

		if( is_rtl() ){
			$css .='.rtl .penci-block_1 .block1_first_item .penci_post-meta,';
			$css .='.rtl .penci-block_28 .block28_first_item .penci_post-meta,';
			$css .='.rtl .penci-block_33 .block33_big_item .penci_post-meta';
			$css .='{ border-color: ' .  esc_attr( $color_border ) . ' }';
		}
	}

	if( class_exists( 'Frontend_Publishing_Pro' ) && penci_get_theme_mod( 'background_color' ) ) {
		$css .= '.site-main .wpfepp-posts ul.wpfepp-tabs a.active{ border-bottom-color: #' . penci_get_theme_mod( 'background_color' ) . '; }';
	}

	$color_accent = penci_get_theme_mod( 'penci_color_accent' );

	if ( $color_accent ) {

		$css .= '.buy-button{ background-color:' . $color_accent . ' !important; }';

		// Menu Hum
		$css .= '.penci-menuhbg-toggle:hover .lines-button:after,';
		$css .= '.penci-menuhbg-toggle:hover .penci-lines:before,';
		$css .= '.penci-menuhbg-toggle:hover .penci-lines:after';

		// Login
		$css .= '.penci-login-container a,.penci_list_shortcode li:before,';
		$css .= '.footer__sidebars .penci-block-vc .penci__post-title a:hover,';

		$css .= '.penci-viewall-results a:hover,.post-entry .penci-portfolio-filter ul li.active a, .penci-portfolio-filter ul li.active a,';
		$css .= '.penci-ajax-search-results-wrapper .penci__post-title a:hover';
		$css .= '{ color: ' . esc_attr( $color_accent ) . '; }';

		$css .= '.penci-tweets-widget-content .icon-tweets,';
		$css .= '.penci-tweets-widget-content .tweet-intents a,';
		$css .= '.penci-tweets-widget-content .tweet-intents span:after,';

		$css .= '.woocommerce .star-rating span,.woocommerce .comment-form p.stars a:hover,';
		$css .= '.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,';
		$css .= '.penci-subcat-list .flexMenu-viewMore:hover a, .penci-subcat-list .flexMenu-viewMore:focus a,';
		$css .= '.penci-subcat-list .flexMenu-viewMore .flexMenu-popup .penci-subcat-item a:hover,';
		$css .= '.penci-owl-carousel-style .owl-dot.active span, .penci-owl-carousel-style .owl-dot:hover span,';
		$css .= '.penci-owl-carousel-slider .owl-dot.active span,';
		$css .= '.penci-owl-carousel-slider .owl-dot:hover span';
		$css .= '{ color: ' . esc_attr( $color_accent ) . '; }';

		$css .= '.penci-owl-carousel-slider .owl-dot.active span,';
		$css .= '.penci-owl-carousel-slider .owl-dot:hover span';
		$css .= '{ background-color: ' . esc_attr( $color_accent ) . '; }';

		$css .= 'blockquote, q,.penci-post-pagination a:hover,';
		$css .= 'a:hover,.penci-entry-meta a:hover,.penci-portfolio-below_img .inner-item-portfolio .portfolio-desc a:hover h3,';
		$css .= '.main-navigation.penci_disable_padding_menu > ul:not(.children) > li:hover > a,';
		$css .= '.main-navigation.penci_disable_padding_menu > ul:not(.children) > li:active > a,';
		$css .= '.main-navigation.penci_disable_padding_menu > ul:not(.children) > li.current-menu-item > a,';
		$css .= '.main-navigation.penci_disable_padding_menu > ul:not(.children) > li.current-menu-ancestor > a,';
		$css .= '.main-navigation.penci_disable_padding_menu > ul:not(.children) > li.current-category-ancestor > a,';

		$css .='.site-header.header--s11 .main-navigation.penci_enable_line_menu .menu > li:hover > a,';
		$css .='.site-header.header--s11 .main-navigation.penci_enable_line_menu .menu > li:active > a,';
		$css .='.site-header.header--s11 .main-navigation.penci_enable_line_menu .menu > li.current-menu-item > a,';
		$css .= '.main-navigation.penci_disable_padding_menu ul.menu > li > a:hover,';
		$css .= '.main-navigation ul li:hover > a,.main-navigation ul li:active > a,';
		$css .= '.main-navigation li.current-menu-item > a,';
		$css .= '#site-navigation .penci-megamenu .penci-mega-child-categories a.cat-active,';
		$css .= '#site-navigation .penci-megamenu .penci-content-megamenu .penci-mega-latest-posts .penci-mega-post a:not(.mega-cat-name):hover,';
		$css .= '.penci-post-pagination h5 a:hover';
		$css .= '{ color: ' . esc_attr( $color_accent ) . '; }';

		if( penci_get_theme_mod( 'penci_disable_padding_menu_lever1' ) ){
			$css .= '.main-navigation.penci_disable_padding_menu > ul:not(.children) > li.highlight-button > a{ color: ' . esc_attr( $color_accent ) . ';border-color: ' . esc_attr( $color_accent ) . '; }';

			$css .= '.main-navigation.penci_disable_padding_menu > ul:not(.children) > li.highlight-button:hover > a,' .
			        '.main-navigation.penci_disable_padding_menu > ul:not(.children) > li.highlight-button:active > a,' .
			        '.main-navigation.penci_disable_padding_menu > ul:not(.children) > li.highlight-button.current-category-ancestor > a,' .
			        '.main-navigation.penci_disable_padding_menu > ul:not(.children) > li.highlight-button.current-category-ancestor > a,' .
			        '.main-navigation.penci_disable_padding_menu > ul:not(.children) > li.highlight-button.current-menu-ancestor > a,' .
			        '.main-navigation.penci_disable_padding_menu > ul:not(.children) > li.highlight-button.current-menu-item > a{ border-color: ' . esc_attr( $color_accent ) . '; }';
		}

		$css .= '.penci-menu-hbg .primary-menu-mobile li a:hover,';
		$css .= '.penci-menu-hbg .primary-menu-mobile li.toggled-on > a,';
		$css .= '.penci-menu-hbg .primary-menu-mobile li.toggled-on > .dropdown-toggle,';
		$css .= '.penci-menu-hbg .primary-menu-mobile li.current-menu-item > a,';
		$css .= '.penci-menu-hbg .primary-menu-mobile li.current-menu-item > .dropdown-toggle,';

		$css .= '.mobile-sidebar .primary-menu-mobile li a:hover,';
		$css .= '.mobile-sidebar .primary-menu-mobile li.toggled-on-first > a,';
		$css .= '.mobile-sidebar .primary-menu-mobile li.toggled-on > a,';
		$css .= '.mobile-sidebar .primary-menu-mobile li.toggled-on > .dropdown-toggle,';
		$css .= '.mobile-sidebar .primary-menu-mobile li.current-menu-item > a,';
		$css .= '.mobile-sidebar .primary-menu-mobile li.current-menu-item > .dropdown-toggle,';
		$css .= '.mobile-sidebar #sidebar-nav-logo a,.mobile-sidebar #sidebar-nav-logo a:hover';
		$css .= '.mobile-sidebar #sidebar-nav-logo:before,';
		$css .= '.penci-recipe-heading a.penci-recipe-print,';
		$css .= '.widget a:hover,';
		$css .= '.widget.widget_recent_entries li a:hover, .widget.widget_recent_comments li a:hover, .widget.widget_meta li a:hover,';
		$css .= '.penci-topbar a:hover,';
		$css .= '.penci-topbar ul li:hover,';
		$css .= '.penci-topbar ul li a:hover,';
		$css .= '.penci-topbar ul.menu li ul.sub-menu li a:hover,';
		$css .= '.site-branding a, ';
		$css .= '.site-branding .site-title';
		$css .= '{ color: ' . esc_attr( $color_accent ) . '; }';

		$css .= '.penci-viewall-results a:hover,';
		$css .= '.penci-ajax-search-results-wrapper .penci__post-title a:hover,';
		$css .= '.header__search_dis_bg .search-click:hover,';
		$css .= '.header__social-media a:hover,';
		$css .= '.penci-login-container .link-bottom a,';
		$css .= '.error404 .page-content a,';
		$css .= '.penci-no-results .search-form .search-submit:hover,.error404 .page-content .search-form .search-submit:hover,';
		$css .= '.penci_breadcrumbs a:hover, .penci_breadcrumbs a:hover span,';
		$css .= '.penci-archive .entry-meta a:hover,';
		$css .= '.penci-caption-above-img .wp-caption a:hover,';
		$css .= '.penci-author-content .author-social:hover,';
		$css .= '.entry-content a,.comment-content a,';
		$css .= '.penci-page-style-5 .penci-active-thumb .penci-entry-meta a:hover,';
		$css .= '.penci-single-style-5 .penci-active-thumb .penci-entry-meta a:hover';
		$css .= '{ color: ' . esc_attr( $color_accent ) . '; }';

		$css .= 'blockquote:not(.wp-block-quote).style-2:before{ background-color: transparent; }';
		$css .= 'blockquote.style-2:before,blockquote:not(.wp-block-quote),';
		$css .= 'blockquote.style-2 cite, blockquote.style-2 .author,blockquote.style-3 cite, blockquote.style-3 .author,';
		$css .= '.woocommerce ul.products li.product .price,';
		$css .= '.woocommerce ul.products li.product .price ins,';
		$css .= '.woocommerce div.product p.price ins,';
		$css .= '.woocommerce div.product span.price ins, .woocommerce div.product p.price, .woocommerce div.product span.price,';
		$css .= '.woocommerce div.product .entry-summary div[itemprop="description"] blockquote:before, .woocommerce div.product .woocommerce-tabs #tab-description blockquote:before,';
		$css .= '.woocommerce-product-details__short-description blockquote:before,';
		$css .= '.woocommerce div.product .entry-summary div[itemprop="description"] blockquote cite, .woocommerce div.product .entry-summary div[itemprop="description"] blockquote .author,';
		$css .= '.woocommerce div.product .woocommerce-tabs #tab-description blockquote cite, .woocommerce div.product .woocommerce-tabs #tab-description blockquote .author,';
		$css .= '.woocommerce div.product .product_meta > span a:hover,';
		$css .= '.woocommerce div.product .woocommerce-tabs ul.tabs li.active';
		$css .= '{ color: ' . esc_attr( $color_accent ) . '; }';

		$css .= '.woocommerce #respond input#submit.alt.disabled:hover,';
		$css .= '.woocommerce #respond input#submit.alt:disabled:hover,';
		$css .= '.woocommerce #respond input#submit.alt:disabled[disabled]:hover,';
		$css .= '.woocommerce a.button.alt.disabled,';
		$css .= '.woocommerce a.button.alt.disabled:hover,';
		$css .= '.woocommerce a.button.alt:disabled,';
		$css .= '.woocommerce a.button.alt:disabled:hover,';
		$css .= '.woocommerce a.button.alt:disabled[disabled],';
		$css .= '.woocommerce a.button.alt:disabled[disabled]:hover,';
		$css .= '.woocommerce button.button.alt.disabled,';
		$css .= '.woocommerce button.button.alt.disabled:hover,';
		$css .= '.woocommerce button.button.alt:disabled,';
		$css .= '.woocommerce button.button.alt:disabled:hover,';
		$css .= '.woocommerce button.button.alt:disabled[disabled],';
		$css .= '.woocommerce button.button.alt:disabled[disabled]:hover,';
		$css .= '.woocommerce input.button.alt.disabled,';
		$css .= '.woocommerce input.button.alt.disabled:hover,';
		$css .= '.woocommerce input.button.alt:disabled,';
		$css .= '.woocommerce input.button.alt:disabled:hover,';
		$css .= '.woocommerce input.button.alt:disabled[disabled],';
		$css .= '.woocommerce input.button.alt:disabled[disabled]:hover';
		$css .= '{ background-color: ' . esc_attr( $color_accent ) . '; }';

		$css .= '.woocommerce ul.cart_list li .amount, .woocommerce ul.product_list_widget li .amount,';
		$css .= '.woocommerce table.shop_table td.product-name a:hover,';
		$css .= '.woocommerce-cart .cart-collaterals .cart_totals table td .amount,';
		$css .= '.woocommerce .woocommerce-info:before,';
		$css .= '.woocommerce form.checkout table.shop_table .order-total .amount,';
		$css .= '.post-entry .penci-portfolio-filter ul li a:hover,';
		$css .= '.post-entry .penci-portfolio-filter ul li.active a,';
		$css .= '.penci-portfolio-filter ul li a:hover,';
		$css .= '.penci-portfolio-filter ul li.active a,';
		$css .= '#bbpress-forums li.bbp-body ul.forum li.bbp-forum-info a:hover,#bbpress-forums li.bbp-body ul.topic li.bbp-topic-title a:hover,';
		$css .= '#bbpress-forums li.bbp-body ul.forum li.bbp-forum-info .bbp-forum-content a,#bbpress-forums li.bbp-body ul.topic p.bbp-topic-meta a,';
		$css .= '#bbpress-forums .bbp-breadcrumb a:hover, #bbpress-forums .bbp-breadcrumb .bbp-breadcrumb-current:hover,';
		$css .= '#bbpress-forums .bbp-forum-freshness a:hover,#bbpress-forums .bbp-topic-freshness a:hover';
		$css .= '{ color: ' . esc_attr( $color_accent ) . '; }';

		$css .= '.footer__bottom a,.footer__logo a, .footer__logo a:hover,.site-info a,.site-info a:hover,.sub-footer-menu li a:hover,';
		$css .= '.footer__sidebars a:hover,';
		$css .= '.penci-block-vc .social-buttons a:hover,';
		$css .= '.penci-inline-related-posts .penci_post-meta a:hover,.penci__general-meta .penci_post-meta a:hover,';
		$css .= '.penci-block_video.style-1 .penci_post-meta a:hover,.penci-block_video.style-7 .penci_post-meta a:hover,';
		$css .= '.penci-block-vc .penci-block__title a:hover,.penci-block-vc.style-title-2 .penci-block__title a:hover,.penci-block-vc.style-title-2:not(.footer-widget) .penci-block__title a:hover,';
		$css .= '.penci-block-vc.style-title-4 .penci-block__title a:hover,.penci-block-vc.style-title-4:not(.footer-widget) .penci-block__title a:hover,';
		$css .= '.penci-block-vc .penci-subcat-filter .penci-subcat-item a.active, .penci-block-vc .penci-subcat-filter .penci-subcat-item a:hover ,';
		$css .= '.penci-block_1 .penci_post-meta a:hover,';
		$css .= '.penci-inline-related-posts.penci-irp-type-grid .penci__post-title:hover';
		$css .= '{ color: ' . esc_attr( $color_accent ) . '; }';

		$css .= '.penci-block_10 .penci-posted-on a,.penci-block_10 .penci-block__title a:hover,.penci-block_10 .penci__post-title a:hover,';
		$css .= '.penci-block_26 .block26_first_item .penci__post-title:hover,';
		$css .= '.penci-block_30 .penci_post-meta a:hover,';
		$css .= '.penci-block_33 .block33_big_item .penci_post-meta a:hover,';
		$css .= '.penci-block_36 .penci-chart-text,';
		$css .= '.penci-block_video.style-1 .block_video_first_item.penci-title-ab-img .penci_post_content a:hover,';
		$css .= '.penci-block_video.style-1 .block_video_first_item.penci-title-ab-img .penci_post-meta a:hover,';
		$css .= '.penci-block_video.style-6 .penci__post-title:hover,';
		$css .= '.penci-block_video.style-7 .penci__post-title:hover,';
		$css .= '.penci-owl-featured-area.style-12 .penci-small_items h3 a:hover,';
		$css .= '.penci-owl-featured-area.style-12 .penci-small_items .penci-slider__meta a:hover ,';
		$css .= '.penci-owl-featured-area.style-12 .penci-small_items .owl-item.current h3 a,';
		$css .= '.penci-owl-featured-area.style-13 .penci-small_items h3 a:hover,';
		$css .= '.penci-owl-featured-area.style-13 .penci-small_items .penci-slider__meta a:hover,';
		$css .= '.penci-owl-featured-area.style-13 .penci-small_items .owl-item.current h3 a,';
		$css .= '.penci-owl-featured-area.style-14 .penci-small_items h3 a:hover,';
		$css .= '.penci-owl-featured-area.style-14 .penci-small_items .penci-slider__meta a:hover ,';
		$css .= '.penci-owl-featured-area.style-14 .penci-small_items .owl-item.current h3 a,';
		$css .= '.penci-owl-featured-area.style-17 h3 a:hover,';
		$css .= '.penci-owl-featured-area.style-17 .penci-slider__meta a:hover,';
		$css .= '.penci-fslider28-wrapper.penci-block-vc .penci-slider-nav a:hover,';
		$css .= '.penci-videos-playlist .penci-video-nav .penci-video-playlist-item .penci-video-play-icon,';
		$css .= '.penci-videos-playlist .penci-video-nav .penci-video-playlist-item.is-playing ';
		$css .= '{ color: ' . esc_attr( $color_accent ) . '; }';


		$css .= '.penci-block_video.style-7 .penci_post-meta a:hover,';
		$css .= '.penci-ajax-more.disable_bg_load_more .penci-ajax-more-button:hover, .penci-ajax-more.disable_bg_load_more .penci-block-ajax-more-button:hover';
		$css .= '{ color: ' . esc_attr( $color_accent ) . '; }';


		$css .= '.site-main #buddypress input[type=submit]:hover,';
		$css .= '.site-main #buddypress div.generic-button a:hover,.site-main #buddypress .comment-reply-link:hover,';
		$css .= '.site-main #buddypress a.button:hover,.site-main #buddypress a.button:focus,';
		$css .= '.site-main #buddypress ul.button-nav li a:hover,.site-main #buddypress ul.button-nav li.current a,';
		$css .= '.site-main #buddypress .dir-search input[type=submit]:hover, .site-main #buddypress .groups-members-search input[type=submit]:hover,';
		$css .= '.site-main #buddypress div.item-list-tabs ul li.selected a,.site-main #buddypress div.item-list-tabs ul li.current a,.site-main #buddypress div.item-list-tabs ul li a:hover';
		$css .= '{ border-color: ' . esc_attr( $color_accent ) . ';background-color: ' . esc_attr( $color_accent ) . '; }';

		$css .= '.site-main #buddypress table.notifications thead tr, .site-main #buddypress table.notifications-settings thead tr,';
		$css .= '.site-main #buddypress table.profile-settings thead tr, .site-main #buddypress table.profile-fields thead tr,';
		$css .= '.site-main #buddypress table.profile-settings thead tr, .site-main #buddypress table.profile-fields thead tr,';
		$css .= '.site-main #buddypress table.wp-profile-fields thead tr, .site-main #buddypress table.messages-notices thead tr,';
		$css .= '.site-main #buddypress table.forum thead tr';
		$css .= '{ border-color: ' . esc_attr( $color_accent ) . ';background-color: ' . esc_attr( $color_accent ) . '; }';

		$css .= '.site-main .bbp-pagination-links a:hover, .site-main .bbp-pagination-links span.current,';
		$css .= '#buddypress div.item-list-tabs:not(#subnav) ul li.selected a, #buddypress div.item-list-tabs:not(#subnav) ul li.current a, #buddypress div.item-list-tabs:not(#subnav) ul li a:hover,';
		$css .= '#buddypress ul.item-list li div.item-title a, #buddypress ul.item-list li h4 a,div.bbp-template-notice a,';
		$css .= '#bbpress-forums li.bbp-body ul.topic li.bbp-topic-title a,#bbpress-forums li.bbp-body .bbp-forums-list li,';
		$css .= '.site-main #buddypress .activity-header a:first-child, #buddypress .comment-meta a:first-child, #buddypress .acomment-meta a:first-child';
		$css .= '{ color: ' . esc_attr( $color_accent ) . ' !important; }';



		// Background

		// Evvent
		$css .= '.single-tribe_events .tribe-events-schedule .tribe-events-cost';
		$css .= '{ color: ' . esc_attr( $color_accent ) . '; }';

		$css .= '.tribe-events-list .tribe-events-loop .tribe-event-featured,';
		$css .= '#tribe-events .tribe-events-button,#tribe-events .tribe-events-button:hover,';
		$css .= '#tribe_events_filters_wrapper input[type=submit],';
		$css .= '.tribe-events-button, .tribe-events-button.tribe-active:hover,';
		$css .= '.tribe-events-button.tribe-inactive,';
		$css .= '.tribe-events-button:hover,';
		$css .= '.tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-],';
		$css .= '.tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-]>a,';
		$css .= '#tribe-bar-form .tribe-bar-submit input[type=submit]:hover';
		$css .= '{ background-color: ' . esc_attr( $color_accent ) . '; }';

		$css .= '.woocommerce span.onsale,.show-search:after,';
		$css .= 'select option:focus,';
		$css .= '.woocommerce .widget_shopping_cart p.buttons a:hover, .woocommerce.widget_shopping_cart p.buttons a:hover, .woocommerce .widget_price_filter .price_slider_amount .button:hover, .woocommerce div.product form.cart .button:hover,';
		$css .= '.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,';
		$css .= '.penci-block-vc.style-title-2:not(.footer-widget) .penci-block__title a, .penci-block-vc.style-title-2:not(.footer-widget) .penci-block__title span,';
		$css .= '.penci-block-vc.style-title-3:not(.footer-widget) .penci-block-heading:after,';
		$css .= '.penci-block-vc.style-title-4:not(.footer-widget) .penci-block__title a, .penci-block-vc.style-title-4:not(.footer-widget) .penci-block__title span,';
		$css .= '.penci-archive .penci-archive__content .penci-cat-links a:hover,';
		$css .= '.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,';
		$css .= '.penci-block-vc .penci-cat-name:hover,';
		$css .= '#buddypress .activity-list li.load-more, #buddypress .activity-list li.load-newest,';
		$css .= '#buddypress .activity-list li.load-more:hover, #buddypress .activity-list li.load-newest:hover,';
		$css .= '.site-main #buddypress button:hover, .site-main #buddypress a.button:hover, .site-main #buddypress input[type=button]:hover, .site-main #buddypress input[type=reset]:hover';
		$css .= '{ background-color: ' . esc_attr( $color_accent ) . '; }';

		$css .= '.penci-block-vc.style-title-grid:not(.footer-widget) .penci-block__title span, .penci-block-vc.style-title-grid:not(.footer-widget) .penci-block__title a,';
		$css .= '.penci-block-vc .penci_post_thumb:hover .penci-cat-name,';
		$css .= '.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar,.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar,';

		$css .= '.main-navigation > ul:not(.children) > li:hover > a,';
		$css .= '.main-navigation > ul:not(.children) > li:active > a,';
		$css .= '.main-navigation > ul:not(.children) > li.current-menu-item > a,';
		$css .= '.main-navigation.penci_enable_line_menu > ul:not(.children) > li > a:before,';
		$css .= '.main-navigation a:hover,';
		$css .= '#site-navigation .penci-megamenu .penci-mega-thumbnail .mega-cat-name:hover,';
		$css .= '#site-navigation .penci-megamenu .penci-mega-thumbnail:hover .mega-cat-name,';
		$css .= '.penci-review-process span,';
		$css .= '.penci-review-score-total,';
		$css .= '.topbar__trending .headline-title,';
		$css .= '.header__search:not(.header__search_dis_bg) .search-click,';
		$css .= '.cart-icon span.items-number';
		$css .= '{ background-color: ' . esc_attr( $color_accent ) . '; }';

		if( ! penci_get_theme_mod( 'penci_disable_padding_menu_lever1' ) ) {

			$css .= '.main-navigation > ul:not(.children) > li.highlight-button > a{ background-color: ' . esc_attr( $color_accent ) . '; }';

			$css .= '.main-navigation > ul:not(.children) > li.highlight-button:hover > a,' .
			        '.main-navigation > ul:not(.children) > li.highlight-button:active > a,' .
			        '.main-navigation > ul:not(.children) > li.highlight-button.current-category-ancestor > a,' .
			        '.main-navigation > ul:not(.children) > li.highlight-button.current-menu-ancestor > a,' .
			        '.main-navigation > ul:not(.children) > li.highlight-button.current-menu-item > a{ border-color: ' . esc_attr( $color_accent ) . '; }';
		}

		$css .= '.login__form .login__form__login-submit input:hover,';
		$css .= '.penci-login-container .penci-login input[type="submit"]:hover,';
		$css .= '.penci-archive .penci-entry-categories a:hover,';
		$css .= '.single .penci-cat-links a:hover,.page .penci-cat-links a:hover,';
		$css .= '.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,';
		$css .= '.woocommerce div.product .entry-summary div[itemprop="description"]:before,';
		$css .= '.woocommerce div.product .entry-summary div[itemprop="description"] blockquote .author span:after, .woocommerce div.product .woocommerce-tabs #tab-description blockquote .author span:after,';
		$css .= '.woocommerce-product-details__short-description blockquote .author span:after,';
		$css .= '.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,';
		$css .= '#scroll-to-top:hover,';
		$css .= '#respond #submit:hover,.wpcf7 input[type="submit"]:hover,.widget_wysija input[type="submit"]:hover';
		$css .= '{ background-color: ' . esc_attr( $color_accent ) . '; }';

		$css .= '.penci-block_video .penci-close-video:hover,';
		$css .= '.penci-block_5 .penci_post_thumb:hover .penci-cat-name,.penci-block_25 .penci_post_thumb:hover .penci-cat-name,';
		$css .= '.penci-block_8 .penci_post_thumb:hover .penci-cat-name,.penci-block_14 .penci_post_thumb:hover .penci-cat-name,';
		$css .= '.penci-block-vc.style-title-grid .penci-block__title span, .penci-block-vc.style-title-grid .penci-block__title a,';
		$css .= '.penci-block_7 .penci_post_thumb:hover .penci-order-number,';
		$css .= '.penci-block_15 .penci-post-order,';
		$css .= '.penci-news_ticker .penci-news_ticker__title';
		$css .= '{ background-color: ' . esc_attr( $color_accent ) . '; }';

		$css .= '.penci-owl-featured-area .penci-item-mag:hover .penci-slider__cat .penci-cat-name,';
		$css .= '.penci-owl-featured-area .penci-slider__cat .penci-cat-name:hover,';
		$css .= '.penci-owl-featured-area.style-12 .penci-small_items .owl-item.current .penci-cat-name,';
		$css .= '.penci-owl-featured-area.style-13 .penci-big_items .penci-slider__cat .penci-cat-name,';
		$css .= '.penci-owl-featured-area.style-13 .button-read-more:hover,';
		$css .= '.penci-owl-featured-area.style-13 .penci-small_items .owl-item.current .penci-cat-name,';
		$css .= '.penci-owl-featured-area.style-14 .penci-small_items .owl-item.current .penci-cat-name,';
		$css .= '.penci-owl-featured-area.style-18 .penci-slider__cat .penci-cat-name';
		$css .= '{ background-color: ' . esc_attr( $color_accent ) . '; }';

		$css .= '.show-search .show-search__content:after,';
		$css .= '.penci-wide-content .penci-owl-featured-area.style-23 .penci-slider__text,';
		$css .= '.penci-grid_2 .grid2_first_item:hover .penci-cat-name,.penci-grid_2 .penci-post-item:hover .penci-cat-name,';
		$css .= '.penci-grid_3 .penci-post-item:hover .penci-cat-name,';
		$css .= '.penci-grid_1 .penci-post-item:hover .penci-cat-name,';
		$css .= '.penci-videos-playlist .penci-video-nav .penci-playlist-title,';
		$css .= '.widget-area .penci-videos-playlist .penci-video-nav .penci-video-playlist-item .penci-video-number,';
		$css .= '.widget-area .penci-videos-playlist .penci-video-nav .penci-video-playlist-item .penci-video-play-icon,';
		$css .= '.widget-area .penci-videos-playlist .penci-video-nav .penci-video-playlist-item .penci-video-paused-icon,';
		$css .= '.penci-owl-featured-area.style-17 .penci-slider__text::after,';
		$css .= '#scroll-to-top:hover';
		$css .= '{ background-color: ' . esc_attr( $color_accent ) . '; }';

		// Border
		$css .= '.featured-area-custom-slider .penci-owl-carousel-slider .owl-dot span,';
		$css .= '.main-navigation > ul:not(.children) > li ul.sub-menu,';
		$css .= '.error404 .not-found,.error404 .penci-block-vc,';
		$css .= '.woocommerce .woocommerce-error, .woocommerce .woocommerce-info, .woocommerce .woocommerce-message,';
		$css .= '.penci-owl-featured-area.style-12 .penci-small_items,';
		$css .= '.penci-owl-featured-area.style-12 .penci-small_items .owl-item.current .penci_post_thumb,';
		$css .= '.penci-owl-featured-area.style-13 .button-read-more:hover';
		$css .= '{ border-color: ' . esc_attr( $color_accent ) . '; }';

		// Border + Background
		$css .= sprintf(
			'.widget .tagcloud a:hover,' .
			'.penci-social-buttons .penci-social-item.like.liked,' .
			'.site-footer .widget .tagcloud a:hover,' .
			'.penci-recipe-heading a.penci-recipe-print:hover,' .
			'.penci-custom-slider-container .pencislider-content .pencislider-btn-trans:hover,' .
			'button:hover,.button:hover, .entry-content a.button:hover,.penci-vc-btn-wapper .penci-vc-btn.penci-vcbtn-trans:hover, input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover,' .
			'.penci-ajax-more .penci-ajax-more-button:hover,.penci-ajax-more .penci-portfolio-more-button:hover,' .
			'.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover,' .
			'.woocommerce nav.woocommerce-pagination ul li span.current,' .
			'.penci-block_10 .penci-more-post:hover,' .
			'.penci-block_15 .penci-more-post:hover,' .
			'.penci-block_36 .penci-more-post:hover,' .
			'.penci-block_video.style-7 .penci-owl-carousel-slider .owl-dot.active span,' .
			'.penci-block_video.style-7 .penci-owl-carousel-slider .owl-dot:hover span ,' .
			'.penci-block_video.style-7 .penci-owl-carousel-slider .owl-dot:hover span ,' .
			'.penci-ajax-more .penci-ajax-more-button:hover,.penci-ajax-more .penci-block-ajax-more-button:hover,' .
			'.penci-ajax-more .penci-ajax-more-button.loading-posts:hover, .penci-ajax-more .penci-block-ajax-more-button.loading-posts:hover,' .
			'.site-main #buddypress .activity-list li.load-more a:hover, .site-main #buddypress .activity-list li.load-newest a,'.
			'.penci-owl-carousel-slider.penci-tweets-slider .owl-dots .owl-dot.active span, .penci-owl-carousel-slider.penci-tweets-slider .owl-dots .owl-dot:hover span,' .
			'.penci-pagination:not(.penci-ajax-more) span.current, .penci-pagination:not(.penci-ajax-more) a:hover{border-color:%s;background-color: %s;}',
			esc_attr( $color_accent ), esc_attr( $color_accent ) );

		$css .= ".penci-owl-featured-area.style-23 .penci-slider-overlay{ 
		background: -moz-linear-gradient(left, transparent 26%, " .  esc_attr( $color_accent ) .  "  65%);
	    background: -webkit-gradient(linear, left top, right top, color-stop(26%, " . esc_attr( $color_accent ).  " ), color-stop(65%, transparent));
	    background: -webkit-linear-gradient(left, transparent 26%, " .  esc_attr( $color_accent ) .  " 65%);
	    background: -o-linear-gradient(left, transparent 26%, " .  esc_attr( $color_accent ) .  " 65%);
	    background: -ms-linear-gradient(left, transparent 26%, " .  esc_attr( $color_accent ) .  " 65%);
	    background: linear-gradient(to right, transparent 26%, " .  esc_attr( $color_accent ) .  " 65%);
	    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='" .  esc_attr( $color_accent ) .  "', endColorstr='" .  esc_attr( $color_accent ) .  "', GradientType=1);
		 }";

		if( class_exists( 'WooCommerce' ) ){
			$css .= '.site-content .woocommerce #respond input#submit.alt:hover,.site-content .woocommerce a.button.alt:hover,';
			$css .= '.site-content .woocommerce button.button.alt:hover,.site-content .woocommerce input.button.alt:hover,';
			$css .= '.woocommerce-cart table.cart input[type="submit"]:hover';
			$css .= '{ background-color: ' . esc_attr( $color_accent ) . ' !important; }';
		}

		// Opacity button hover
		$css .= '.site-main #buddypress .activity-list li.load-more a, .site-main #buddypress .activity-list li.load-newest a,';
		$css .= '.header__search:not(.header__search_dis_bg) .search-click:hover,';
		$css .= '.tagcloud a:hover,.site-footer .widget .tagcloud a:hover';
		$css .= '{ transition: all 0.3s; opacity: 0.8; }';

		// Loading
		$css .= '.penci-loading-animation-1 .penci-loading-animation,';
		$css .= '.penci-loading-animation-1 .penci-loading-animation:before,';
		$css .= '.penci-loading-animation-1 .penci-loading-animation:after,';
		$css .= '.penci-loading-animation-5 .penci-loading-animation,';
		$css .= '.penci-loading-animation-6 .penci-loading-animation:before,';
		$css .= '.penci-loading-animation-7 .penci-loading-animation,';
		$css .= '.penci-loading-animation-8 .penci-loading-animation,';
		$css .= '.penci-loading-animation-9 .penci-loading-circle-inner:before,';
		$css .= '.penci-load-thecube .penci-load-cube:before,';
		$css .= '.penci-three-bounce .one,.penci-three-bounce .two,.penci-three-bounce .three';
		$css .= '{ background-color: ' . esc_attr( $color_accent ) . '; }';

		$style_animation = penci_get_theme_mod( 'penci_general_loader_effect' ) ? penci_get_theme_mod( 'penci_general_loader_effect' ) : 9;
		if ( 1 == $style_animation ) {

			$css .= ' .penci-loading-animation-1 > div { background-color: ' . esc_attr( $color_accent ) . '; }';

		} elseif ( 2 == $style_animation ) {
			$css .= '@keyframes loader-2 {
			    0%,100% {  box-shadow: 0 -3em 0 .2em ' . esc_attr( $color_accent ) . ',2em -2em 0 0 ' . esc_attr( $color_accent ) . ',3em 0 0 -1em ' . esc_attr( $color_accent ) . ',2em 2em 0 -1em ' . esc_attr( $color_accent ) . ',0 3em 0 -1em ' . esc_attr( $color_accent ) . ',-2em 2em 0 -1em ' . esc_attr( $color_accent ) . ',-3em 0 0 -1em ' . esc_attr( $color_accent ) . ',-2em -2em 0 0 ' . esc_attr( $color_accent ) . '}
			    12.5% {
			        box-shadow: 0 -3em 0 0 ' . esc_attr( $color_accent ) . ',2em -2em 0 .2em ' . esc_attr( $color_accent ) . ',3em 0 0 0 ' . esc_attr( $color_accent ) . ',2em 2em 0 -1em ' . esc_attr( $color_accent ) . ',0 3em 0 -1em ' . esc_attr( $color_accent ) . ',-2em 2em 0 -1em ' . esc_attr( $color_accent ) . ',-3em 0 0 -1em ' . esc_attr( $color_accent ) . ',-2em -2em 0 -1em ' . esc_attr( $color_accent ) . '}
			    25% {
			        box-shadow: 0 -3em 0 -0.5em ' . esc_attr( $color_accent ) . ',2em -2em 0 0 ' . esc_attr( $color_accent ) . ',3em 0 0 .2em ' . esc_attr( $color_accent ) . ',2em 2em 0 0 ' . esc_attr( $color_accent ) . ',0 3em 0 -1em ' . esc_attr( $color_accent ) . ',-2em 2em 0 -1em ' . esc_attr( $color_accent ) . ',-3em 0 0 -1em ' . esc_attr( $color_accent ) . ',-2em -2em 0 -1em ' . esc_attr( $color_accent ) . '}
			    37.5% {
			        box-shadow: 0 -3em 0 -1em ' . esc_attr( $color_accent ) . ',2em -2em 0 -1em ' . esc_attr( $color_accent ) . ',3em 0 0 0 ' . esc_attr( $color_accent ) . ',2em 2em 0 .2em ' . esc_attr( $color_accent ) . ',0 3em 0 0 ' . esc_attr( $color_accent ) . ',-2em 2em 0 -1em ' . esc_attr( $color_accent ) . ',-3em 0 0 -1em ' . esc_attr( $color_accent ) . ',-2em -2em 0 -1em ' . esc_attr( $color_accent ) . ' }
			    50% {
			        box-shadow: 0 -3em 0 -1em ' . esc_attr( $color_accent ) . ',2em -2em 0 -1em ' . esc_attr( $color_accent ) . ',3em 0 0 -1em ' . esc_attr( $color_accent ) . ',2em 2em 0 0 ' . esc_attr( $color_accent ) . ',0 3em 0 .2em ' . esc_attr( $color_accent ) . ',-2em 2em 0 0 ' . esc_attr( $color_accent ) . ',-3em 0 0 -1em ' . esc_attr( $color_accent ) . ',-2em -2em 0 -1em ' . esc_attr( $color_accent ) . '}
			    62.5% {
			        box-shadow: 0 -3em 0 -1em ' . esc_attr( $color_accent ) . ',2em -2em 0 -1em ' . esc_attr( $color_accent ) . ',3em 0 0 -1em ' . esc_attr( $color_accent ) . ',2em 2em 0 -1em ' . esc_attr( $color_accent ) . ',0 3em 0 0 ' . esc_attr( $color_accent ) . ',-2em 2em 0 .2em ' . esc_attr( $color_accent ) . ',-3em 0 0 0 ' . esc_attr( $color_accent ) . ',-2em -2em 0 -1em ' . esc_attr( $color_accent ) . '}
			    75% {
			        box-shadow: 0 -3em 0 -1em ' . esc_attr( $color_accent ) . ',2em -2em 0 -1em ' . esc_attr( $color_accent ) . ',3em 0 0 -1em ' . esc_attr( $color_accent ) . ',2em 2em 0 -1em ' . esc_attr( $color_accent ) . ',0 3em 0 -1em ' . esc_attr( $color_accent ) . ',-2em 2em 0 0 ' . esc_attr( $color_accent ) . ',-3em 0 0 .2em ' . esc_attr( $color_accent ) . ',-2em -2em 0 0 ' . esc_attr( $color_accent ) . '}
			    87.5% {
			        box-shadow: 0 -3em 0 0 ' . esc_attr( $color_accent ) . ',2em -2em 0 -1em ' . esc_attr( $color_accent ) . ',3em 0 0 -1em ' . esc_attr( $color_accent ) . ',2em 2em 0 -1em ' . esc_attr( $color_accent ) . ',0 3em 0 -1em ' . esc_attr( $color_accent ) . ',-2em 2em 0 0 ' . esc_attr( $color_accent ) . ',-3em 0 0 0 ' . esc_attr( $color_accent ) . ',-2em -2em 0 .2em ' . esc_attr( $color_accent ) . '}
			}';

			$css .= '@-webkit-keyframes loader-2 {
			    0%,100% {  box-shadow: 0 -3em 0 .2em ' . esc_attr( $color_accent ) . ',2em -2em 0 0 ' . esc_attr( $color_accent ) . ',3em 0 0 -1em ' . esc_attr( $color_accent ) . ',2em 2em 0 -1em ' . esc_attr( $color_accent ) . ',0 3em 0 -1em ' . esc_attr( $color_accent ) . ',-2em 2em 0 -1em ' . esc_attr( $color_accent ) . ',-3em 0 0 -1em ' . esc_attr( $color_accent ) . ',-2em -2em 0 0 ' . esc_attr( $color_accent ) . '}
			    12.5% {
			        box-shadow: 0 -3em 0 0 ' . esc_attr( $color_accent ) . ',2em -2em 0 .2em ' . esc_attr( $color_accent ) . ',3em 0 0 0 ' . esc_attr( $color_accent ) . ',2em 2em 0 -1em ' . esc_attr( $color_accent ) . ',0 3em 0 -1em ' . esc_attr( $color_accent ) . ',-2em 2em 0 -1em ' . esc_attr( $color_accent ) . ',-3em 0 0 -1em ' . esc_attr( $color_accent ) . ',-2em -2em 0 -1em ' . esc_attr( $color_accent ) . '}
			    25% {
			        box-shadow: 0 -3em 0 -0.5em ' . esc_attr( $color_accent ) . ',2em -2em 0 0 ' . esc_attr( $color_accent ) . ',3em 0 0 .2em ' . esc_attr( $color_accent ) . ',2em 2em 0 0 ' . esc_attr( $color_accent ) . ',0 3em 0 -1em ' . esc_attr( $color_accent ) . ',-2em 2em 0 -1em ' . esc_attr( $color_accent ) . ',-3em 0 0 -1em ' . esc_attr( $color_accent ) . ',-2em -2em 0 -1em ' . esc_attr( $color_accent ) . '}
			    37.5% {
			        box-shadow: 0 -3em 0 -1em ' . esc_attr( $color_accent ) . ',2em -2em 0 -1em ' . esc_attr( $color_accent ) . ',3em 0 0 0 ' . esc_attr( $color_accent ) . ',2em 2em 0 .2em ' . esc_attr( $color_accent ) . ',0 3em 0 0 ' . esc_attr( $color_accent ) . ',-2em 2em 0 -1em ' . esc_attr( $color_accent ) . ',-3em 0 0 -1em ' . esc_attr( $color_accent ) . ',-2em -2em 0 -1em ' . esc_attr( $color_accent ) . ' }
			    50% {
			        box-shadow: 0 -3em 0 -1em ' . esc_attr( $color_accent ) . ',2em -2em 0 -1em ' . esc_attr( $color_accent ) . ',3em 0 0 -1em ' . esc_attr( $color_accent ) . ',2em 2em 0 0 ' . esc_attr( $color_accent ) . ',0 3em 0 .2em ' . esc_attr( $color_accent ) . ',-2em 2em 0 0 ' . esc_attr( $color_accent ) . ',-3em 0 0 -1em ' . esc_attr( $color_accent ) . ',-2em -2em 0 -1em ' . esc_attr( $color_accent ) . '}
			    62.5% {
			        box-shadow: 0 -3em 0 -1em ' . esc_attr( $color_accent ) . ',2em -2em 0 -1em ' . esc_attr( $color_accent ) . ',3em 0 0 -1em ' . esc_attr( $color_accent ) . ',2em 2em 0 -1em ' . esc_attr( $color_accent ) . ',0 3em 0 0 ' . esc_attr( $color_accent ) . ',-2em 2em 0 .2em ' . esc_attr( $color_accent ) . ',-3em 0 0 0 ' . esc_attr( $color_accent ) . ',-2em -2em 0 -1em ' . esc_attr( $color_accent ) . '}
			    75% {
			        box-shadow: 0 -3em 0 -1em ' . esc_attr( $color_accent ) . ',2em -2em 0 -1em ' . esc_attr( $color_accent ) . ',3em 0 0 -1em ' . esc_attr( $color_accent ) . ',2em 2em 0 -1em ' . esc_attr( $color_accent ) . ',0 3em 0 -1em ' . esc_attr( $color_accent ) . ',-2em 2em 0 0 ' . esc_attr( $color_accent ) . ',-3em 0 0 .2em ' . esc_attr( $color_accent ) . ',-2em -2em 0 0 ' . esc_attr( $color_accent ) . '}
			    87.5% {
			        box-shadow: 0 -3em 0 0 ' . esc_attr( $color_accent ) . ',2em -2em 0 -1em ' . esc_attr( $color_accent ) . ',3em 0 0 -1em ' . esc_attr( $color_accent ) . ',2em 2em 0 -1em ' . esc_attr( $color_accent ) . ',0 3em 0 -1em ' . esc_attr( $color_accent ) . ',-2em 2em 0 0 ' . esc_attr( $color_accent ) . ',-3em 0 0 0 ' . esc_attr( $color_accent ) . ',-2em -2em 0 .2em ' . esc_attr( $color_accent ) . '}
			}';
		} elseif ( 3 == $style_animation ) {

			$color_accent_02 = penci_convert_hex_rgb( $color_accent, 0.2 );
			$color_accent_05 = penci_convert_hex_rgb( $color_accent, 0.5 );
			$color_accent_07 = penci_convert_hex_rgb( $color_accent, 0.7 );

			$css .= '@-webkit-keyframes loader-3 {
			    0%,100% {
			        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $color_accent ) . ',1.8em -1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ',2.5em 0 0 0 ' . esc_attr( $color_accent_02 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $color_accent_02 ) . ',0 2.5em 0 0 ' . esc_attr( $color_accent_02 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ',-2.6em 0 0 0 ' . esc_attr( $color_accent_05 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $color_accent_07 ) . ';}
			    12.5% {
			        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $color_accent_07 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $color_accent ) . ',2.5em 0 0 0 ' . esc_attr( $color_accent_02 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $color_accent_02 ) . ',0 2.5em 0 0 ' . esc_attr( $color_accent_02 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ',-2.6em 0 0 0 ' . esc_attr( $color_accent_02 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $color_accent_05 ) . '; }
			
			    25% {
			        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $color_accent_05 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $color_accent_07 ) . ',2.5em 0 0 0 ' . esc_attr( $color_accent ) . ',1.75em 1.75em 0 0 ' . esc_attr( $color_accent_02 ) . ',0 2.5em 0 0 ' . esc_attr( $color_accent_02 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ',-2.6em 0 0 0 ' . esc_attr( $color_accent_02 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $color_accent_02 ) . '; }
			
			    37.5% {
			        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $color_accent_02 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $color_accent_05 ) . ',2.5em 0 0 0 ' . esc_attr( $color_accent_07 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $color_accent_02 ) . ',0 2.5em 0 0 ' . esc_attr( $color_accent_02 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ',-2.6em 0 0 0 ' . esc_attr( $color_accent_02 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ';}
			
			    50% {
			        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $color_accent_02 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ',2.5em 0 0 0 ' . esc_attr( $color_accent_05 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $color_accent_07 ) . ',0 2.5em 0 0 ' . esc_attr( $color_accent ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ',-2.6em 0 0 0 ' . esc_attr( $color_accent_02 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ';}
			
			    62.5% {
			        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $color_accent_02 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ',2.5em 0 0 0 ' . esc_attr( $color_accent_02 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $color_accent_05 ) . ',0 2.5em 0 0 ' . esc_attr( $color_accent_07 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $color_accent ) . ',-2.6em 0 0 0 ' . esc_attr( $color_accent_02 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $color_accent_02 ) . '; }
			
			    75% {
			        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $color_accent_02 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ',2.5em 0 0 0 ' . esc_attr( $color_accent_02 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $color_accent_02 ) . ',0 2.5em 0 0 ' . esc_attr( $color_accent_05 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $color_accent_07 ) . ',-2.6em 0 0 0 ' . esc_attr( $color_accent ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ';}
			
			    87.5% {
			        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $color_accent_02 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ',2.5em 0 0 0 ' . esc_attr( $color_accent_02 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $color_accent_02 ) . ',0 2.5em 0 0 ' . esc_attr( $color_accent_02 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $color_accent_05 ) . ',-2.6em 0 0 0 ' . esc_attr( $color_accent_07 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $color_accent ) . ';}
			}';

			$css .= '@keyframes loader-3 {
			    0%,100% {
			        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $color_accent ) . ',1.8em -1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ',2.5em 0 0 0 ' . esc_attr( $color_accent_02 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $color_accent_02 ) . ',0 2.5em 0 0 ' . esc_attr( $color_accent_02 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ',-2.6em 0 0 0 ' . esc_attr( $color_accent_05 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $color_accent_07 ) . ';}
			    12.5% {
			        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $color_accent_07 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $color_accent ) . ',2.5em 0 0 0 ' . esc_attr( $color_accent_02 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $color_accent_02 ) . ',0 2.5em 0 0 ' . esc_attr( $color_accent_02 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ',-2.6em 0 0 0 ' . esc_attr( $color_accent_02 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $color_accent_05 ) . '; }
			
			    25% {
			        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $color_accent_05 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $color_accent_07 ) . ',2.5em 0 0 0 ' . esc_attr( $color_accent ) . ',1.75em 1.75em 0 0 ' . esc_attr( $color_accent_02 ) . ',0 2.5em 0 0 ' . esc_attr( $color_accent_02 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ',-2.6em 0 0 0 ' . esc_attr( $color_accent_02 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $color_accent_02 ) . '; }
			
			    37.5% {
			        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $color_accent_02 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $color_accent_05 ) . ',2.5em 0 0 0 ' . esc_attr( $color_accent_07 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $color_accent_02 ) . ',0 2.5em 0 0 ' . esc_attr( $color_accent_02 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ',-2.6em 0 0 0 ' . esc_attr( $color_accent_02 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ';}
			
			    50% {
			        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $color_accent_02 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ',2.5em 0 0 0 ' . esc_attr( $color_accent_05 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $color_accent_07 ) . ',0 2.5em 0 0 ' . esc_attr( $color_accent ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ',-2.6em 0 0 0 ' . esc_attr( $color_accent_02 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ';}
			
			    62.5% {
			        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $color_accent_02 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ',2.5em 0 0 0 ' . esc_attr( $color_accent_02 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $color_accent_05 ) . ',0 2.5em 0 0 ' . esc_attr( $color_accent_07 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $color_accent ) . ',-2.6em 0 0 0 ' . esc_attr( $color_accent_02 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $color_accent_02 ) . '; }
			
			    75% {
			        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $color_accent_02 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ',2.5em 0 0 0 ' . esc_attr( $color_accent_02 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $color_accent_02 ) . ',0 2.5em 0 0 ' . esc_attr( $color_accent_05 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $color_accent_07 ) . ',-2.6em 0 0 0 ' . esc_attr( $color_accent ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ';}
			
			    87.5% {
			        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $color_accent_02 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $color_accent_02 ) . ',2.5em 0 0 0 ' . esc_attr( $color_accent_02 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $color_accent_02 ) . ',0 2.5em 0 0 ' . esc_attr( $color_accent_02 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $color_accent_05 ) . ',-2.6em 0 0 0 ' . esc_attr( $color_accent_07 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $color_accent ) . ';}
			}';

		} elseif ( 4 == $style_animation ) {
			$css .= '@keyframes loader-4 {
				0% {
					-webkit-transform: rotate(0);
					transform: rotate(0);
					box-shadow: 0 -0.83em 0 -0.4em ' . esc_attr( $color_accent ) . ',0 -0.83em 0 -0.42em ' . esc_attr( $color_accent ) . ',0 -0.83em 0 -0.44em ' . esc_attr( $color_accent ) . ',0 -0.83em 0 -0.46em ' . esc_attr( $color_accent ) . ',0 -0.83em 0 -0.477em ' . esc_attr( $color_accent ) . ';
				}
			
				5%,95% {
					box-shadow: 0 -0.83em 0 -0.4em ' . esc_attr( $color_accent ) . ',0 -0.83em 0 -0.42em ' . esc_attr( $color_accent ) . ',0 -0.83em 0 -0.44em ' . esc_attr( $color_accent ) . ',0 -0.83em 0 -0.46em ' . esc_attr( $color_accent ) . ',0 -0.83em 0 -0.477em ' . esc_attr( $color_accent ) . ';
				}
			
				10%,59% {
					box-shadow: 0 -0.83em 0 -0.4em ' . esc_attr( $color_accent ) . ',-0.087em -0.825em 0 -0.42em ' . esc_attr( $color_accent ) . ',-0.173em -0.812em 0 -0.44em ' . esc_attr( $color_accent ) . ',-0.256em -0.789em 0 -0.46em ' . esc_attr( $color_accent ) . ',-0.297em -0.775em 0 -0.477em ' . esc_attr( $color_accent ) . ';
				}
			
				20% {
					box-shadow: 0 -0.83em 0 -0.4em ' . esc_attr( $color_accent ) . ',-0.338em -0.758em 0 -0.42em ' . esc_attr( $color_accent ) . ',-0.555em -0.617em 0 -0.44em ' . esc_attr( $color_accent ) . ',-0.671em -0.488em 0 -0.46em ' . esc_attr( $color_accent ) . ',-0.749em -0.34em 0 -0.477em ' . esc_attr( $color_accent ) . ';
				}
			
				38% {
					box-shadow: 0 -0.83em 0 -0.4em ' . esc_attr( $color_accent ) . ',-0.377em -0.74em 0 -0.42em ' . esc_attr( $color_accent ) . ',-0.645em -0.522em 0 -0.44em ' . esc_attr( $color_accent ) . ',-0.775em -0.297em 0 -0.46em ' . esc_attr( $color_accent ) . ',-0.82em -0.09em 0 -0.477em ' . esc_attr( $color_accent ) . ';
				}
			
				100% {
					-webkit-transform: rotate(360deg);
					transform: rotate(360deg);
					box-shadow: 0 -0.83em 0 -0.4em ' . esc_attr( $color_accent ) . ',0 -0.83em 0 -0.42em ' . esc_attr( $color_accent ) . ',0 -0.83em 0 -0.44em ' . esc_attr( $color_accent ) . ',0 -0.83em 0 -0.46em ' . esc_attr( $color_accent ) . ',0 -0.83em 0 -0.477em ' . esc_attr( $color_accent ) . ';
				}
			}';

			$css .= '@-webkit-keyframes loader-4 {
				0% {
					-webkit-transform: rotate(0);
					transform: rotate(0);
					box-shadow: 0 -0.83em 0 -0.4em ' . esc_attr( $color_accent ) . ',0 -0.83em 0 -0.42em ' . esc_attr( $color_accent ) . ',0 -0.83em 0 -0.44em ' . esc_attr( $color_accent ) . ',0 -0.83em 0 -0.46em ' . esc_attr( $color_accent ) . ',0 -0.83em 0 -0.477em ' . esc_attr( $color_accent ) . ';
				}
			
				5%,95% {
					box-shadow: 0 -0.83em 0 -0.4em ' . esc_attr( $color_accent ) . ',0 -0.83em 0 -0.42em ' . esc_attr( $color_accent ) . ',0 -0.83em 0 -0.44em ' . esc_attr( $color_accent ) . ',0 -0.83em 0 -0.46em ' . esc_attr( $color_accent ) . ',0 -0.83em 0 -0.477em ' . esc_attr( $color_accent ) . ';
				}
			
				10%,59% {
					box-shadow: 0 -0.83em 0 -0.4em ' . esc_attr( $color_accent ) . ',-0.087em -0.825em 0 -0.42em ' . esc_attr( $color_accent ) . ',-0.173em -0.812em 0 -0.44em ' . esc_attr( $color_accent ) . ',-0.256em -0.789em 0 -0.46em ' . esc_attr( $color_accent ) . ',-0.297em -0.775em 0 -0.477em ' . esc_attr( $color_accent ) . ';
				}
			
				20% {
					box-shadow: 0 -0.83em 0 -0.4em ' . esc_attr( $color_accent ) . ',-0.338em -0.758em 0 -0.42em ' . esc_attr( $color_accent ) . ',-0.555em -0.617em 0 -0.44em ' . esc_attr( $color_accent ) . ',-0.671em -0.488em 0 -0.46em ' . esc_attr( $color_accent ) . ',-0.749em -0.34em 0 -0.477em ' . esc_attr( $color_accent ) . ';
				}
			
				38% {
					box-shadow: 0 -0.83em 0 -0.4em ' . esc_attr( $color_accent ) . ',-0.377em -0.74em 0 -0.42em ' . esc_attr( $color_accent ) . ',-0.645em -0.522em 0 -0.44em ' . esc_attr( $color_accent ) . ',-0.775em -0.297em 0 -0.46em ' . esc_attr( $color_accent ) . ',-0.82em -0.09em 0 -0.477em ' . esc_attr( $color_accent ) . ';
				}
			
				100% {
					-webkit-transform: rotate(360deg);
					transform: rotate(360deg);
					box-shadow: 0 -0.83em 0 -0.4em ' . esc_attr( $color_accent ) . ',0 -0.83em 0 -0.42em ' . esc_attr( $color_accent ) . ',0 -0.83em 0 -0.44em ' . esc_attr( $color_accent ) . ',0 -0.83em 0 -0.46em ' . esc_attr( $color_accent ) . ',0 -0.83em 0 -0.477em ' . esc_attr( $color_accent ) . ';
				}
			}';
		}
	}

	return $css;
}