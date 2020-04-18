<?php
if( ! class_exists( 'Penci_JSON_Schema_Validator' ) ) {

	/**
	 * JSON Schema object
	 *
	 * Class Penci_JSON_Schema_Validator
	 */
	class Penci_JSON_Schema_Validator{

		function __construct() {
			$dis_schema_markup = get_theme_mod( 'penci_dis_schema_markup' );
			if ( $dis_schema_markup ) {
				return;
			}

			add_action( 'wp_head', array( $this, 'output_schema' ) );
			add_action( 'penci_amp_post_template_head', array( $this, 'output_schema' ) );
		}

		public static function pre_data_schema() {
			$data = array(
				'organization' => self::generate_data(),
				'website'      => self::website_data()
			);

			$data = self::add_sidebar_data( $data );

			if ( is_singular() && ! is_front_page() ) {

				if ( is_page() ) {
					$data['page'] = self::page_data();
				} else if ( function_exists( 'is_product' ) && is_product() ) {
					$data['product'] = self::product_data();
				} else {
					$data['single'] = self::single_data();
				}
			}

			return $data;
		}

		/**
		 * Outut schema with data each element
		 */
		public static function output_schema() {

			$pre_data_schema = self::pre_data_schema();

			foreach ( $pre_data_schema as $json ) {

				echo '<script type="application/ld+json">' . wp_json_encode( $json, JSON_PRETTY_PRINT ) . '</script>';
			}
		}

		/**
		 * Organization Schema
		 *
		 * @return array
		 */
		public static function generate_data(){
			
			$data_logo = '';	
			$url_logo  = self::get_url_logo();
			if ( $url_logo ){
				$data_logo = array(
					'@type' => 'ImageObject',
					'url'   => $url_logo,
				);
			}

			return array(
				"@context"    => "http://schema.org/",
				'@type'       => 'organization',
				'@id'         => '#organization',
				'logo'        => $data_logo,
				'url'         => home_url( '/' ),
				'name'        => get_bloginfo( 'name' ),
				'description' => esc_attr( get_bloginfo( 'description' ) )
			);
		}

		/**
		 * WebSite schema
		 *
		 * @return array
		 */
		public static function website_data(){
			$data = array(
				"@context"      => "http://schema.org/",
				'@type'         => 'WebSite',
				'name'          => esc_attr( get_bloginfo( 'name' ) ),
				'alternateName' => esc_attr( get_bloginfo( 'description' ) ),
				'url'           => home_url( '/' ),
			);

			if ( is_home() || is_front_page() ) {
				$data['potentialAction'] = array(
					'@type'       => 'SearchAction',
					'target'      => get_search_link() . '{search_term}',
					'query-input' => 'required name=search_term'
				);
			}

			return $data;
		}

		/**
		 * WPSideBar schema
		 *
		 * @param $data
		 *
		 * @return mixed
		 */
		public static function add_sidebar_data( $data ){
			$sidebars_widgets = get_option('sidebars_widgets');

			if( ! $sidebars_widgets ) {
				return $data;
			}

			foreach ( $sidebars_widgets as $id_sidebar => $widget_items ) {
				if( ! is_active_sidebar( $id_sidebar ) ) {
					continue;
				}

				$data_sidebar = self::sidebar_data( $id_sidebar );

				if( $data_sidebar )	{
					$data['WPSideBar' . $id_sidebar ]	= $data_sidebar;
				}
			}

			return $data;
		}

		/**
		 * Get data schema each active sidebar  on the current page
		 * @param $id_sidebar
		 *
		 * @return array
		 */
		public static function sidebar_data( $id_sidebar ){
			global $wp_registered_sidebars, $wp;

			if( isset( $wp_registered_sidebars[$id_sidebar] ) && $wp_registered_sidebars[$id_sidebar] ) {
				
				$sidebar  = $wp_registered_sidebars[$id_sidebar];

				return array(
					"@context"      => "http://schema.org/",
					'@type'         => 'WPSideBar',
					'name'          => isset( $sidebar['name'] ) ? $sidebar['name'] : '',
					'alternateName' => isset( $sidebar['description'] ) ? $sidebar['description'] : '',
					'url'           => home_url(add_query_arg(array(),$wp->request))
				);
			}
			
			

			return array();
		}



		public static function single_data( ){
			return self::singular_data( );
		}

		public static function page_data( ){
			return self::singular_data( 'WebPage' );
		}

		public static function product_data( ){
			$product = wc_get_product();
			$schema_markup  = self::singular_data( 'Product' );

			$schema_markup['name']           = isset( $schema_markup['headline'] ) ? $schema_markup['headline'] : '';
			$schema_markup['brand']          = isset( $schema_markup['publisher'] ) ? $schema_markup['publisher'] : '';
			$schema_markup['productionDate'] = isset( $schema_markup['datePublished'] ) ? $schema_markup['datePublished'] : '';

			$rating = $product->get_rating_count();

			if( $rating ){
				$schema_markup['aggregateRating'] = array(
					'@type'       => 'AggregateRating',
					'ratingValue' => wc_format_decimal( $product->get_average_rating(), 2 ),
					'reviewCount' => intval( $rating ),
				);
			}

			$schema_markup['offers'] = array(
				'@type'         => 'Offer',
				'priceCurrency' => get_woocommerce_currency(),
				'price'         => $product->get_price(),
				'availability'  => 'http://schema.org/' . ( $product->is_in_stock() ? 'InStock' : 'OutOfStock' ),
			);

			unset( $schema_markup['headline'] );
			unset( $schema_markup['datePublished'] );
			unset( $schema_markup['datemodified'] );
			unset( $schema_markup['publisher'] );
			unset( $schema_markup['author'] );

			return $schema_markup;
		}
		public static function singular_data( $type = '', $args = array() ){
			global $post;

			if( ! $type ){
				$type = 'BlogPosting';
			}

			$post_id    = isset( $post->ID ) ? $post->ID  : '';
			$permalink  = get_permalink( $post_id );

			$post_title   = isset( $post->post_title ) ? $post->post_title : '';
			$post_excerpt = $post->post_excerpt ? $post->post_excerpt : '';
			$post_type    = isset( $post->post_type ) ? $post->post_type : '';

			$datePublished = get_the_date( 'Y-m-d' );
			$datemodified = get_post_modified_time( 'Y-m-d' );

			$schema_markup = array(
				"@context"         => "http://schema.org/",
				'@type'            => $type,
				'headline'         => $post_title,
				'description'      => $post_excerpt,
				'datePublished'    => $datePublished ? $datePublished : $datemodified,
				'datemodified'     => $datemodified,
				'mainEntityOfPage' => $permalink
			);


			// Featured img
			$url_logo  = self::get_url_logo();
			$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
			
			if( isset( $featured_image[0] ) && $featured_image[0] ) {
				$schema_markup['image'] = array(
						'@type' => 'ImageObject',
						'url'   => $featured_image[0],
				);

				$featured_image_width  = isset( $featured_image[1] ) ? $featured_image[1]  : '';
				$featured_image_height = isset( $featured_image[2] ) ? $featured_image[2]  : '';

				if( $featured_image_width && $featured_image_height ){
					$schema_markup['image']['width']  = $featured_image_width;
					$schema_markup['image']['height'] = $featured_image_height;
				}
			}else {
				$schema_markup['image'] = array(
					'@type' => 'ImageObject',
					'url'   => $url_logo,
				);
			}

			// publisher
			$schema_markup['publisher'] = array(
				'@type' => 'Organization',
				'name'  => esc_attr( get_bloginfo( 'name' ) ),
			);

			if ( $url_logo ){
				$schema_markup['publisher']['logo'] = array(
					'@type' => 'ImageObject',
					'url'   => $url_logo,
				);
			}


			// Author
			$post_author = isset( $post->post_author ) ? $post->post_author : '';
			$author      = get_the_author_meta( 'display_name', $post_author );
			if( $author ) {
				$schema_markup['author'] = array(
					'@type' => 'Person',
					'@id'   => '#person-' . sanitize_html_class( $author ),
					'name'  => $author,
				);
			}	

			// Post format
			if( 'post' == $post_type ) {
				$format = get_post_format();

				if( 'video' == $format ){
					$schema_markup['@type'] = 'VideoObject';



					$video = get_post_meta( $post_id, '_format_video_embed', true );

					if ( ! wp_oembed_get( $video ) ) {
						$schema_markup['contentUrl'] = $video;
					}

					$schema_markup['name']         = isset( $schema_markup['headline'] ) ? $schema_markup['headline'] : '';
					$schema_markup['thumbnailUrl'] = isset( $schema_markup['image']['url'] ) ? $schema_markup['image']['url'] : '';
					$schema_markup['uploadDate']   = isset( $schema_markup['datePublished'] ) ? $schema_markup['datePublished'] : '';

					unset( $schema_markup['headline'] );
					unset( $schema_markup['datePublished'] );
					unset( $schema_markup['dateModified'] );
					unset( $schema_markup['image'] );

				}elseif( 'audio' == $format ){
					$schema_markup['@type'] = 'AudioObject';
					$audio = get_post_meta( $post_id, '_format_audio_embed', true );
					$audio_str = substr( $audio, -4 );

					if ( wp_oembed_get( $audio ) ) {
						
					}elseif( $audio_str == '.mp3' ) {
						$schema_markup['contentUrl'] = esc_url( $audio );
					}else {
						$schema_markup['contentUrl'] = sanitize_text_field( $audio );
					}

				}elseif( 'image' == $format ){
					$schema_markup['@type'] = 'ImageObject';	
				}elseif( 'gallery' == $format ){
					$schema_markup['@type'] = 'ImageObject';
				}
			}

			//$schema_markup['articleBody'] = penci_content_limit( '300', '', false );

			return $schema_markup;
		}

		public static function get_url_logo(){
			$custom_logo_id = penci_get_theme_mod( 'custom_logo' );
			$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			
			return  isset( $image[0] ) ? $image[0] : '';
		}


	}
}

new Penci_JSON_Schema_Validator;