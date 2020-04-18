<?php
/**
 * Enqueue scripts and styles.
 */
function penci_scripts() {
	wp_enqueue_style( 'penci-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', '', '4.5.2' );

	if ( ! penci_get_theme_mod( 'penci_disable_default_fonts' ) ) {
		wp_enqueue_style( 'penci-fonts', penci_fonts_url(), array(), '1.0' );
		$data_fonts = penci_fonts_url( 'earlyaccess' );
		if ( is_array( $data_fonts ) && ! empty( $data_fonts ) ) {
			foreach ( $data_fonts as $fontname ) {
				wp_enqueue_style( 'penci-font-' . $fontname, '//fonts.googleapis.com/earlyaccess/' . esc_attr( $fontname ) . '.css', array(), PENCI_PENNEWS_VERSION );
			}
		}
	}

	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_style( 'penci-woocommerce', get_template_directory_uri() . '/css/woocommerce.css', '', PENCI_PENNEWS_VERSION );
	}

	if ( class_exists( 'bbPress' ) ) {
		wp_enqueue_style( 'penci-bbpress', get_template_directory_uri() . '/css/pennews-bbpress.css', '', PENCI_PENNEWS_VERSION );
	}

	if ( class_exists( 'BuddyPress' ) ) {
		wp_enqueue_style( 'penci-buddypress', get_template_directory_uri() . '/css/pennews-buddypress.css', '', PENCI_PENNEWS_VERSION );
	}

	if ( class_exists( 'Tribe__Events__Main' ) ) {
		wp_enqueue_style( 'penci-events', get_template_directory_uri() . '/css/events.css', '', PENCI_PENNEWS_VERSION );
	}

	if ( class_exists( 'Penci_Portfolio' ) ) {
		wp_enqueue_style( 'penci-portfolio', get_template_directory_uri() . '/css/portfolio.css', '', PENCI_PENNEWS_VERSION );
	}
	if ( function_exists( 'penci_pennews_recipe_load_textdomain' ) ) {
		wp_enqueue_style( 'penci-recipe', get_template_directory_uri() . '/css/recipe.css', '', PENCI_PENNEWS_VERSION );
	}
	if ( function_exists( 'penci_register_review_scripts' ) ) {
		wp_enqueue_style( 'penci-review', get_template_directory_uri() . '/css/review.css', '', PENCI_PENNEWS_VERSION );
	}

	$nav_show = penci_get_theme_mod( 'penci_verttical_nav_show' );

	if ( $nav_show ) {
		wp_enqueue_style( 'penci-vertical-nav', get_template_directory_uri() . '/css/vertical-nav.css', '', PENCI_PENNEWS_VERSION );
	}

	wp_enqueue_style( 'penci-style', get_stylesheet_uri(), '', PENCI_PENNEWS_VERSION );


	$check_mac = strpos( getenv( "HTTP_USER_AGENT" ), 'Mac' );
	if ( penci_get_setting( 'penci_smooth_scroll' ) && $check_mac == false ) {
		wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/js/smoothscroll.js', array( 'jquery' ), '', true );
	}

	if ( defined( 'PENCI_DEPLOY_MODE' ) && PENCI_DEPLOY_MODE ) {
		wp_register_script( 'fitvids', get_template_directory_uri() . '/js/fitvids.js', array( 'jquery' ), '1.1', true );

		wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/js/theia-sticky-sidebar.js', array( 'jquery' ), '', true );

		if ( ! penci_get_setting( 'penci_hide_header_sticky' ) ) {
			wp_enqueue_script( 'jquery-sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array( 'jquery' ), '1.0', true );
		}

		if ( is_singular() ) {
			wp_enqueue_script( 'infinitescroll', get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', array( 'jquery' ), '', true );
		}

		wp_enqueue_script( 'mousewheel', get_template_directory_uri() . '/js/jquery.mousewheel.min.js', array( 'jquery' ), '3.1.13', true );
		wp_enqueue_script( 'mCustomScrollbar', get_template_directory_uri() . '/js/jquery.mCustomScrollbar.min.js', array( 'jquery','mousewheel' ), '3.1.5', true );
		wp_enqueue_script( 'video', get_template_directory_uri() . '/js/jquery.video.js', array( 'jquery' ), '0.1.3', true );

		wp_enqueue_script( 'TweenMax', get_template_directory_uri() . '/js/TweenMax.min.js', array( 'jquery' ), '1.20.4', true );
		wp_enqueue_script( 'wow', get_template_directory_uri() . '/js/wow.min.js', array( 'jquery' ), '1.1.3', true );
		wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'flexmenu', get_template_directory_uri() . '/js/flexmenu.min.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'inview', get_template_directory_uri() . '/js/jquery.inview.min.js', array( 'jquery' ), '1.1.0', true );

		wp_register_script( 'velocity', get_template_directory_uri() . '/js/velocity.min.js', array( 'jquery' ), '1.5.0', true );
		wp_register_script( 'imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', '', '4.1.0', true );
		wp_register_script( 'magnific-popup', get_template_directory_uri() . '/js/magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );
		wp_register_script( 'lazy', get_template_directory_uri() . '/js/jquery.lazy.min.js', array( 'jquery' ), '1.8.2', true );

		wp_register_script( 'jquery.isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array( 'jquery' ), '3.0.4', true );
		wp_register_script( 'jquery.justifiedGallery', get_template_directory_uri() . '/js/jquery.justifiedGallery.min.js', array( 'jquery' ), '3.6.3', true );

		wp_enqueue_script('jarallax', get_template_directory_uri() . '/js/jarallax.min.js', array('jquery'), '1.9.0', true );
		wp_enqueue_script('jarallax-video', get_template_directory_uri() . '/js/jarallax-video.min.js', array('jarallax'), '1.9.0', true );

		wp_enqueue_script('on-screen', get_template_directory_uri() . '/js/on-screen.umd.min.js', array('jquery'), '1.3.2', true );

		wp_enqueue_script( 'penci', get_template_directory_uri() . '/js/script.js', array(
			'fitvids',
			'velocity',
			'imagesloaded',
			'owl.carousel',
			'flexmenu',
			'magnific-popup',
			'lazy',
			'jquery.justifiedGallery',
			'jquery.isotope',
			'mCustomScrollbar',
			'jarallax-video'
		), PENCI_PENNEWS_VERSION );

	} else {
		wp_enqueue_script( 'penci', get_template_directory_uri() . '/js/script.min.js', array( 'jquery' ), PENCI_PENNEWS_VERSION, true );
	}

	$localize_script = array(
		'ajaxUrl'         => admin_url( 'admin-ajax.php' ),
		'nonce'           => wp_create_nonce( 'ajax-nonce' ),
		'errorMsg'        => esc_html__( 'Something wrong happened. Please try again.', 'pennews' ),
		'login'           => penci_get_tran_setting( 'penci_plogin_email_place' ),
		'password'        => penci_get_tran_setting( 'penci_plogin_pass_place' ),
		'errorPass'       => '<p class="message message-error">' . penci_get_tran_setting( 'penci_plogin_mess_error_email_pass' ) . '</p>',
		'prevNumber'      => penci_get_setting( 'penci_autoload_prev_number' ),
		'minlengthSearch' => penci_get_setting( 'penci_ajaxsearch_minlength' ),
		'linkTitle'       => penci_get_tran_setting( 'penci_linkTitle_text' ),
		'linkTextAll'     => penci_get_tran_setting( 'penci_linkTextAll_text' ),
		'linkText'        => penci_get_tran_setting( 'penci_linkText_text' ),
	);
	wp_localize_script( 'penci', 'PENCILOCALIZE', $localize_script );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'penci_scripts' );

if( !function_exists('penci_admin_scripts') ) {
	function penci_admin_scripts( $hook ) {

		if ( $hook == 'widgets.php' ) {
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_media();
			wp_enqueue_script( 'penci-admin-widget', get_template_directory_uri() . '/js/admin-widget.js', array( 'jquery', 'colorpicker' ), PENCI_PENNEWS_VERSION, true );

			wp_localize_script( 'penci-admin-widget', 'Penci', array(
				'WidgetImageTitle'   => esc_html__( 'Select an image', 'pennews' ),
				'WidgetImageButton'  => esc_html__( 'Insert into widget', 'pennews' ),
				'ajaxUrl'            => admin_url( 'admin-ajax.php' ),
				'nonce'              => wp_create_nonce( 'ajax-nonce' ),
				'sidebarAddFails'    => esc_html__( 'Adding custom sidebar fails.', 'pennews' ),
				'sidebarRemoveFails' => esc_html__( 'Removing custom sidebar fails.', 'pennews' ),
				'cfRemovesidebar'    => esc_html__( 'Are you sure you want to remove this custom sidebar?', 'pennews' ),
			) );
		}

		wp_enqueue_style( 'penci-admin', get_template_directory_uri() . '/css/admin.css', '', PENCI_PENNEWS_VERSION );
		if( is_rtl() ){
			wp_enqueue_style( 'penci-admin-rtl.css', get_template_directory_uri() . '/css/admin-rtl.css', '', PENCI_PENNEWS_VERSION );
		}
	}
}
add_action( 'admin_enqueue_scripts', 'penci_admin_scripts' );

/**
 * Get Google fonts URL for the theme.
 *
 * @return string Google fonts URL for the theme.
 */
function penci_fonts_url( $data = 'normal' ) {
	$fonts   = $array_earlyaccess = array();
	$subsets = 'latin,latin-ext';

	$array_fonts = array( 'Roboto', 'Mukta Vaani', 'Oswald', 'Teko' );


	$array_options = $array_get = $earlyaccess = array();

	if ( penci_get_theme_mod( 'penci_font_textlogo' ) ) {
		$array_options[] = penci_get_theme_mod( 'penci_font_textlogo' );
	}
	if ( penci_get_theme_mod( 'penci_font_textlogo_on_mobile' ) ) {
		$array_options[] = penci_get_theme_mod( 'penci_font_textlogo_on_mobile' );
	}
	if ( penci_get_theme_mod( 'penci_fwidget_font_blocktitle' ) ) {
		$array_options[] = penci_get_theme_mod( 'penci_fwidget_font_blocktitle' );
	}
	if ( penci_get_theme_mod( 'penci_font_for_title' ) ) {
		$array_options[] = penci_get_theme_mod( 'penci_font_for_title' );
	}
	if ( penci_get_theme_mod( 'penci_font_for_body' ) ) {
		$array_options[] = penci_get_theme_mod( 'penci_font_for_body' );
	}
	if ( penci_get_theme_mod( 'penci_font_slogan' ) ) {
		$array_options[] = penci_get_theme_mod( 'penci_font_slogan' );
	}
	if ( penci_get_theme_mod( 'penci_font_main_menu_item' ) ) {
		$array_options[] = penci_get_theme_mod( 'penci_font_main_menu_item' );
	}
	if ( penci_get_theme_mod( 'penci_font_blocktitle' ) ) {
		$array_options[] = penci_get_theme_mod( 'penci_font_blocktitle' );
	}
	if ( penci_get_theme_mod( 'penci_footer_font_textlogo' ) ) {
		$array_options[] = penci_get_theme_mod( 'penci_footer_font_textlogo' );
	}

	if ( penci_get_theme_mod( 'penci_block_pag_rmore_font' ) ) {
		$array_options[] = penci_get_theme_mod( 'penci_block_pag_rmore_font' );
	}

	if ( penci_get_theme_mod( 'penci_arch_rmore_font' ) ) {
		$array_options[] = penci_get_theme_mod( 'penci_arch_rmore_font' );
	}

	if ( penci_get_theme_mod( 'penci_font_block_heading_title' ) ) {
		$array_options[] = penci_get_theme_mod( 'penci_font_block_heading_title' );
	}

	if ( penci_get_theme_mod( 'penci_font_textlogo_mobile_nav' ) ) {
		$array_options[] = penci_get_theme_mod( 'penci_font_textlogo_mobile_nav' );
	}

	if( ! empty( $array_options ) ) {

		$font_earlyaccess = penci_font_google_earlyaccess();
		$font_earlyaccess_keys = array_keys( $font_earlyaccess );
		foreach( $array_options as $font ) {

			if( in_array( $font, $font_earlyaccess_keys ) ){

				if( isset( $font_earlyaccess[$font] ) ){
					$font_earlyaccess_name = strtolower( str_replace(' ', '', $font_earlyaccess[$font] ) );
					$array_earlyaccess[] =  $font_earlyaccess_name;
				}
				continue;
			}

			$font_family  = str_replace( '"', '', $font );
			$font_family_explo   = explode( ", ", $font_family );
			$array_get[]         = $font_family_explo[0];
		}

		unset( $font_earlyaccess, $font_earlyaccess_keys );
	}

	$array_end  = array_unique( array_merge( $array_fonts, $array_get ), SORT_REGULAR );

	$string_end = implode( $array_end, ':300,300italic,400,400italic,500,500italic,700,700italic,800,800italic|' );
	$string_end .= ':300,300italic,400,400italic,500,500italic,700,700italic,800,800italic';

	if ( 'off' !== _x( 'on', 'Google font: on or off', 'pennews' ) ) {
		$fonts_url = add_query_arg( 'family', urlencode( $string_end . ':300,300italic,400,400italic,500,500italic,700,700italic,800,800italic&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext' ), "//fonts.googleapis.com/css" );
	}

	if( $data == 'earlyaccess' ) {
		return $array_earlyaccess;
	} else {
		return $fonts_url;
	}
}

if( ! function_exists( 'penci_add_css_ie' ) ) {
	function penci_add_css_ie() {

		if ( ! function_exists( 'penci_get_server_value' ) ) {
			return '';
		}

		$http_user_agent = penci_get_server_value( 'HTTP_USER_AGENT' );
		if ( preg_match( '~MSIE|Internet Explorer~i', $http_user_agent ) || ( strpos( $http_user_agent, 'Trident/7.0; rv:11.0' ) !== false ) ) {
			echo '<st' . 'yle type="text/css">.main-navigation.pencimn-slide_down ul li:hover > ul,.main-navigation.pencimn-slide_down ul ul{-webkit-transform: none;-moz-transform: none; -ms-transform: none; -o-transform: none; transform: none;}</st' . 'yle>';
		}
	}
}

add_action('wp_head', 'penci_add_css_ie', 999 );