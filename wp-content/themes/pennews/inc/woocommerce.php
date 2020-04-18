<?php
if ( ! class_exists( 'Penci_WooCommerce' ) ) :
	class Penci_WooCommerce {

		/**
		 * Construction
		 */
		public function __construct() {
			// Check if Woocomerce plugin is actived
			if ( ! class_exists( 'WooCommerce' ) ) {
				return false;
			}

			add_action( 'after_setup_theme', array( $this, 'declare_woocommerce_support' ) );

			add_filter( 'body_class', array( $this, 'add_body_classes' ) );

			// Need an early hook to ajaxify update mini shop cart
			add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'add_to_cart_fragments' ) );

			add_action( 'template_redirect', array( $this, 'hooks' ) );

			add_action( 'init', array( $this, 'change_placeholder_thumbnail' ) );
			add_action( 'init', array( $this, 'custom_remove_wc_breadcrumbs' ) );

			add_action( 'after_switch_theme', array( $this, 'image_dimensions' ), 1 );
		}

		/**
		 * Add hooks for the frontend.
		 */
		public function hooks() {
			// Upsell
			remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
			remove_action( 'woocommerce_after_single_product_summary','woocommerce_upsell_display',20 );
			remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
			remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

			add_filter( 'woocommerce_breadcrumb_defaults', array( $this, 'custom_woocommerce_breadcrumbs' ) );

			add_filter( 'woocommerce_output_related_products_args', array( $this, 'custom_number_related_products_args' ) );

			$disable_breadcrumb = penci_get_setting( 'penci_woo_disable_breadcrumb' );
			if ( $disable_breadcrumb ) {
				remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
			}
		}

		/**
		 *  Adds custom css  to the array of body classes.
		 *
		 * @param $classes
		 *
		 * @return array
		 */
		public function add_body_classes( $classes ) {

			if ( ! is_shop() ) {
				return $classes;
			}

			$number_column = get_option( 'woocommerce_catalog_columns', 4 );;
			$classes[]     = 'penci-loop-shop-column-' . $number_column;


			return $classes;
		}

		function custom_number_related_products_args( $args ) {
			$number = 4;

			$option_number_related     = penci_get_setting( 'penci_woo_number_related_products' );
			$sidebar_product = penci_get_setting( 'penci_woo_sidebar_product' );

			if ( $option_number_related ){
				$number = absint( $option_number_related );
			}

			if( 'no-sidebar' != $sidebar_product  ) {
				$number = 3;
			}

			$args['posts_per_page'] = $number; // 4 related products

			return $args;
		}

		function custom_remove_wc_breadcrumbs() {
			if ( penci_get_setting( 'penci_woo_disable_breadcrumb' ) ):
				remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
			endif;
		}

		public function custom_woocommerce_breadcrumbs() {

			$home = penci_get_tran_setting( 'penci_breadcrumb_home_label' );

			return array(
				'delimiter'   => '<i class="fa fa-angle-right"></i>',
				'wrap_before' => '<div class="penci_breadcrumbs penci-woo-breadcrumb">',
				'wrap_after'  => '</div>',
				'before'      => '<span>',
				'after'       => '</span>',
				'home'        => $home,
			);
		}

		/**
		 * Define image sizes for woocommerce
		 *
		 */
		function image_dimensions() {
			global $pagenow;

			if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
				return;
			}
			$catalog   = array(
				'width'  => '600',    // px
				'height' => '732',    // px
				'crop'   => 1        // true
			);
			$single    = array(
				'width'  => '600',    // px
				'height' => '732',    // px
				'crop'   => 1        // true
			);
			$thumbnail = array(
				'width'  => '150',    // px
				'height' => '183',    // px
				'crop'   => 1        // false
			);

			// Image sizes
			update_option( 'shop_catalog_image_size', $catalog );        // Product category thumbs
			update_option( 'shop_single_image_size', $single );        // Single product image
			update_option( 'shop_thumbnail_image_size', $thumbnail );    // Image gallery thumbs
		}

		function change_placeholder_thumbnail() {
			if ( ! function_exists( 'penci_custom_woocommerce_placeholder_img_src' ) ) {
				add_filter( 'woocommerce_placeholder_img_src', 'penci_custom_woocommerce_placeholder_img_src' );
				function penci_custom_woocommerce_placeholder_img_src( $src ) {
					$src = get_template_directory_uri() . '/images/no-image-product.jpg';

					return $src;
				}
			}
		}

		/**
		 * Declare WooCommerce support
		 */
		public function declare_woocommerce_support() {
			add_theme_support( 'woocommerce' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			if ( ! penci_get_theme_mod( 'penci_woo_disable_zoom' ) ):
				add_theme_support( 'wc-product-gallery-zoom' );
			endif;
		}

		/**
		 * Ajaxify update cart viewer
		 *
		 * @param array $fragments
		 *
		 * @return array
		 */
		public function add_to_cart_fragments( $fragments ) {
			$count = WC()->cart->get_cart_contents_count();

			$fragments['a.cart-contents'] = sprintf(
				'<a href="%s" class="social-media-item cart-contents cart-icon %s"><span class="cart-contents_wraper"><i class="fa fa-shopping-cart"></i><span class="items-number">%s</span></span></a>',
				wc_get_cart_url(),
				esc_attr( $count > 0 ? 'has-item' : '' ),
				esc_html( $count )
			);

			return $fragments;
		}

	}
endif;

new Penci_WooCommerce;