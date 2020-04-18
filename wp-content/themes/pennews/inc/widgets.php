<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function penci_widgets_init() {
	$sidebars = array(
		'sidebar-1' => esc_html__( 'Sidebar Right', 'pennews' ),
		'sidebar-2' => esc_html__( 'Sidebar Left', 'pennews' ),
	);

	$sidebars_footer = array(
		'footer-1' => esc_html__( 'Footer Column #1', 'pennews' ),
		'footer-2' => esc_html__( 'Footer Column #2', 'pennews' ),
		'footer-3' => esc_html__( 'Footer Column #3', 'pennews' ),
		'footer-4' => esc_html__( 'Footer Column #4', 'pennews' ),
	);

	$description = array(
		'sidebar-1' => esc_html__( 'Add widgets here to display them on blog and single', 'pennews' ),
		'sidebar-2' => esc_html__( 'Add widgets here to display them on page', 'pennews' ),
		'footer-1'  => esc_html__( 'Add widgets here to display them in the first column of the footer', 'pennews' ),
		'footer-2'  => esc_html__( 'Add widgets here to display them in the second column of the footer', 'pennews' ),
		'footer-3'  => esc_html__( 'Add widgets here to display them in the third column of the footer', 'pennews' ),
		'footer-4'  => esc_html__( 'Add widgets here to display them in the fourth column of the footer', 'pennews' ),
	);

	$class_before_widget = ' penci-block-vc penci-widget-sidebar';
	$class_before_widget .= ' ' . penci_get_setting( 'penci_style_block_title' );
	$class_before_widget .= ' ' . penci_get_setting( 'penci_align_blocktitle' );

	$before_widget = '<div id="%1$s" class="widget ' . $class_before_widget . ' %2$s">';
	$before_title  = '<div class="penci-block-heading"><h4 class="widget-title penci-block__title"><span>';
	$after_title   = '</span></h4></div>';


	foreach ( $sidebars as $sidebar => $name ) {
		register_sidebar( array(
			'name'          => $name,
			'id'            => $sidebar,
			'description'   => $description[ $sidebar ],
			'before_widget' => $before_widget,
			'after_widget'  => '</div>',
			'before_title'  => $before_title,
			'after_title'   => $after_title
		) );
	}

	register_sidebar( array(
		'name'          => esc_html__( 'Header Signup Form', 'pennews' ),
		'id'            => 'header-signup-form',
		'before_widget' => '<div id="%1$s" class="penci-block-vc penci-mailchimp mailchimp_style-3 %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="header-signup-form">',
		'after_title'   => '</h4>',
		'description'   => esc_html__( 'Only use for MailChimp Sign-Up Form widget. Display your Sign-Up Form widget below the header. Please use markup we provide here: http://soledad.pencidesign.com/soledad-document/#widgets to display exact', 'pennews' ),
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Signup Form', 'pennews' ),
		'id'            => 'footer-signup-form',
		'before_widget' => '<div id="%1$s" class="footer-subscribe penci-mailchimp mailchimp_style-2 %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="footer-subscribe-title">',
		'after_title'   => '</h4>',
		'description'   => esc_html__( 'Only use for MailChimp Sign-Up Form widget. Display your Sign-Up Form widget below on the footer. Please use markup we provide here: http://soledad.pencidesign.com/soledad-document/#widgets to display exact', 'pennews' ),
	) );


	$footer_col  = 4;
	$footer_class_before = penci_get_setting( 'penci_fwidget_block_title_style' );
	$footer_class_before .= ' ' . penci_get_setting( 'penci_fwidget_align_blocktitle' );

	$i = 1;
	foreach ( $sidebars_footer as $sidebar => $name ) {


	register_sidebar( array(
		'name'          => $footer_col > 1 ? $name : esc_html__( 'Footer Sidebar', 'pennews' ),
		'id'            => $sidebar,
		'description'   => $description[ $sidebar ],
		'before_widget' => '<div id="%1$s" class="widget footer-widget penci-block-vc penci-fwidget-sidebar ' . $footer_class_before . ' %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => $before_title,
		'after_title'   => $after_title
	) );

	$i ++;
	}

	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar For Shop', 'pennews' ),
			'id'            => 'penci-shop-sidebar',
			'before_widget' => $before_widget,
			'after_widget'  => '</div>',
			'before_title'  => $before_title,
			'after_title'   => $after_title,
			'description'   => esc_html__( 'This sidebar for Shop Page & Shop Archive, if this sidebar is empty, will display Main Sidebar', 'pennews' ),
		) );
	}

	if ( class_exists( 'Penci_Portfolio' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Portfolio Sidebar Left', 'pennews' ),
			'id'            => 'penci-portfolio-sidebar-left',
			'before_widget' => $before_widget,
			'after_widget'  => '</div>',
			'before_title'  => $before_title,
			'after_title'   => $after_title,
			'description'   => esc_html__( 'This sidebar for Portfolio Detail, if this sidebar is empty, will display Main Sidebar', 'pennews' ),
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Portfolio Sidebar Right', 'pennews' ),
			'id'            => 'penci-portfolio-sidebar-right',
			'before_widget' => $before_widget,
			'after_widget'  => '</div>',
			'before_title'  => $before_title,
			'after_title'   => $after_title,
			'description'   => esc_html__( 'This sidebar for Portfolio Detail, if this sidebar is empty, will display Main Sidebar', 'pennews' ),
		) );
	}

	if ( class_exists( 'bbPress' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar bbPress', 'pennews' ),
			'id'            => 'penci-bbpress',
			'description'   => esc_html__( 'Add widgets here.', 'pennews' ),
			'before_widget' => $before_widget,
			'after_widget'  => '</div>',
			'before_title'  => $before_title,
			'after_title'   => $after_title
		) );
	}

	if ( class_exists( 'BuddyPress' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar BuddyPress', 'pennews' ),
			'id'            => 'penci-buddypress',
			'description'   => esc_html__( 'Add widgets here.', 'pennews' ),
			'before_widget' => $before_widget,
			'after_widget'  => '</div>',
			'before_title'  => $before_title,
			'after_title'   => $after_title
		) );
	}

	if ( class_exists( 'Tribe__Events__Main' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar Events', 'pennews' ),
			'id'            => 'penci-event',
			'description'   => esc_html__( 'Add widgets here.', 'pennews' ),
			'before_widget' => $before_widget,
			'after_widget'  => '</div>',
			'before_title'  => $before_title,
			'after_title'   => $after_title
		) );
	}

	if ( class_exists( 'Penci_Instagram' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Instagram', 'pennews' ),
			'id'            => 'footer-instagram',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="footer-instagram-title"><span><span class="title">',
			'after_title'   => '</span></span></h4>',
			'description'   => esc_html__( 'Only use for Instagram Slider widget. Display instagram images on your website footer', 'pennews' ),
		) );
	}

	register_sidebar( array(
		'name'          => esc_html__( 'Hamburger Widget Above', 'pennews' ),
		'id'            => 'menu_hamburger_1',
		'before_widget' => '<div id="%1$s" class="penci-menu-hbg-widgets widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="menu-hbg-title"><span>',
		'after_title'   => '</span></h4>',
		'description'   => esc_html__( 'Display widgets on above menu on menu hamburger', 'pennews' ),
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Hamburger Widget Below', 'pennews' ),
		'id'            => 'menu_hamburger_2',
		'before_widget' => '<div id="%1$s" class="penci-menu-hbg-widgets widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="menu-hbg-title"><span>',
		'after_title'   => '</span></h4>',
		'description'   =>esc_html__( 'Display widgets on below menu on menu hamburger', 'pennews' ),
	) );
}

add_action( 'widgets_init', 'penci_widgets_init',0 );
