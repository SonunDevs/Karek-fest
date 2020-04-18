<?php

if ( ! class_exists( 'Mega_Menu' ) ) {
	return;
}

$saved_settings = get_option( 'megamenu_settings' );

//  CSS will not be output.
if ( ! isset( $saved_settings['css'] ) ) {
	$saved_settings['css'] = 'disabled';
	update_option( 'megamenu_settings', $saved_settings );
}

// Change class megamenu
add_filter( 'megamenu_nav_menu_args', 'penci_megamenu_nav_menu_args', 10, 3 );
function penci_megamenu_nav_menu_args( $defaults, $menu_id, $current_theme_location ) {

	$saved_settings = get_option( 'megamenu_settings' );
	if ( isset( $saved_settings['css'] ) && 'disabled' != $saved_settings['css'] ) {
		return $defaults;
	}

	$defaults['container']    = '';
	$defaults['container_id'] = '';
	$defaults['menu_class']   = 'menu penci-max-megamenu';
	$defaults['menu_id']      = '';
	$defaults['walker']       = new Penci_Mega_Menu_Walker();

	return $defaults;
}

class penci_Mega_Menu_Walker extends Mega_Menu_Walker {

	function start_lvl( &$output, $depth = 0, $args = array() ) {

		$indent = str_repeat( "\t", $depth );

		$class = '0' == $depth ? 'mega-sub-menu-lever-1' : '';

		$output .= "\n$indent<ul class=\"mega-sub-menu $class\"><div class=\"mega-sub-menu_content\"> \n";
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker::end_lvl()
	 *
	 * @since 1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</div></ul>\n";
	}

	/**
	 * Custom walker. Add the widgets into the menu.
	 *
	 * @see Walker::start_el()
	 *
	 * @since 1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param array $args An array of arguments. @see wp_nav_menu()
	 * @param int $id Current item ID.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		if ( property_exists( $item, 'megamenu_settings' ) ) {
			$settings = $item->megamenu_settings;
		} else {
			$settings = Mega_Menu_Nav_Menus::get_menu_item_defaults();
		}

		// Item Class
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$classes[] = 'menu-item-' . $item->ID;

		$class = join( ' ', apply_filters( 'megamenu_nav_menu_css_class', array_filter( $classes ), $item, $args ) );

		// strip widget classes back to how they're intended to be output
		$class = str_replace( "mega-menu-widget-class-", "", $class );

		// Item ID
		$id = esc_attr( apply_filters( 'megamenu_nav_menu_item_id', "mega-menu-item-{$item->ID}", $item, $args ) );

		$output .= "<li class='{$class}' id='{$id}'>";

		// output the widgets
		if ( $item->type == 'widget' && $item->content ) {

			$item_output = $item->content;

		} else {

			$atts = array();

			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target ) ? $item->target : '';
			$atts['class']  = '';
			$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';


			if ( $settings['disable_link'] != 'true' ) {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			}

			if ( isset( $settings['icon'] ) && $settings['icon'] != 'disabled' ) {
				$atts['class'] = $settings['icon'];
			}

			$atts = apply_filters( 'megamenu_nav_menu_link_attributes', $atts, $item, $args );

			if ( strlen( $atts['class'] ) ) {
				$atts['class'] = $atts['class'] . ' mega-menu-link';
			} else {
				$atts['class'] = 'mega-menu-link';
			}

			// required for Surface/Win10/Edge
			if ( in_array( 'menu-item-has-children', $classes ) ) {
				$atts['aria-haspopup'] = "true";
			}

			if ( $depth == 0 ) {
				$atts['tabindex'] = "0";
			}

			$attributes = '';

			foreach ( $atts as $attr => $value ) {

				if ( strlen( $value ) ) {
					$value      = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}

			}

			$item_output = $args->before;

			$penci_megamenu_enabled = get_post_meta( $item->menu_item_parent, 'penci_megamenu_enabled', true );
			$max_megamenu           = get_post_meta( $item->menu_item_parent, '_megamenu', true );
			$max_megamenu_type      = isset( $max_megamenu['type'] ) ? $max_megamenu['type'] : '';

			$item_output .= ( 'on' == $penci_megamenu_enabled && 'megamenu' != $max_megamenu_type ) ? '' : '<a' . $attributes . '>';


			if ( in_array( 'icon-top', $classes ) ) {
				$item_output .= "<span class='mega-title-below'>";
			}

			if ( $settings['hide_text'] == 'true' ) {
				/** This filter is documented in wp-includes/post-template.php */
			} else if ( property_exists( $item, 'mega_description' ) && strlen( $item->mega_description ) ) {
				$item_output .= '<span class="mega-description-group"><span class="mega-menu-title">' . $args->link_before . apply_filters( 'megamenu_the_title', $item->title, $item->ID ) . $args->link_after . '</span><span class="mega-menu-description">' . $item->description . '</span></span>';
			} else {
				$item_output .= $args->link_before . apply_filters( 'megamenu_the_title', $item->title, $item->ID ) . $args->link_after;
			}

			if ( in_array( 'icon-top', $classes ) ) {
				$item_output .= "</span>";
			}

			$item_output .= ( 'on' == $penci_megamenu_enabled && 'megamenu' != $max_megamenu_type ) ? '' : '</a>';

			$item_output .= $args->after;

		}

		$output .= apply_filters( 'megamenu_walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

// custom max megamenu
function penci_megamenu_add_theme_default( $themes ) {
	$themes["default_1485155997"] = array(
		'title'                                    => 'Default',
		'container_background_from'                => 'rgba(34, 34, 34, 0)',
		'container_background_to'                  => 'rgba(34, 34, 34, 0)',
		'arrow_up'                                 => 'dash-f343',
		'arrow_down'                               => 'dash-f347',
		'arrow_left'                               => 'dash-f341',
		'arrow_right'                              => 'dash-f345',
		'menu_item_align'                          => 'center',
		'menu_item_background_from'                => 'rgba(33, 33, 33, 0)',
		'menu_item_background_to'                  => 'rgba(33, 33, 33, 0)',
		'menu_item_background_hover_from'          => 'rgba(124, 179, 66, 0)',
		'menu_item_background_hover_to'            => 'rgba(124, 179, 66, 0)',
		'menu_item_link_font_size'                 => '15px',
		'menu_item_link_height'                    => '90px',
		'menu_item_link_color'                     => 'rgb(33, 33, 33)',
		'menu_item_link_weight'                    => 'bold',
		'menu_item_link_text_transform'            => 'uppercase',
		'menu_item_link_text_align'                => 'center',
		'menu_item_link_color_hover'               => 'rgb(124, 179, 66)',
		'menu_item_link_weight_hover'              => 'bold',
		'menu_item_link_padding_left'              => '20px',
		'menu_item_link_padding_right'             => '20px',
		'menu_item_border_color_hover'             => 'rgba(255, 255, 255, 0)',
		'panel_background_from'                    => 'rgb(255, 255, 255)',
		'panel_background_to'                      => 'rgb(255, 255, 255)',
		'panel_border_color'                       => 'rgb(241, 241, 241)',
		'panel_header_color'                       => 'rgb(33, 33, 33)',
		'panel_header_border_color'                => 'rgb(241, 241, 241)',
		'panel_font_size'                          => '14px',
		'panel_font_color'                         => 'rgb(33, 33, 33)',
		'panel_font_family'                        => 'inherit',
		'panel_second_level_font_color'            => '#555',
		'panel_second_level_font_color_hover'      => 'rgb(124, 179, 66)',
		'panel_second_level_text_transform'        => 'uppercase',
		'panel_second_level_font'                  => 'inherit',
		'panel_second_level_font_size'             => '16px',
		'panel_second_level_font_weight'           => 'bold',
		'panel_second_level_font_weight_hover'     => 'bold',
		'panel_second_level_text_decoration'       => 'none',
		'panel_second_level_text_decoration_hover' => 'none',
		'panel_second_level_border_color'          => 'rgb(33, 33, 33)',
		'panel_third_level_font_color'             => 'rgb(33, 33, 33)',
		'panel_third_level_font_color_hover'       => 'rgb(124, 179, 66)',
		'panel_third_level_font'                   => 'inherit',
		'panel_third_level_font_size'              => '14px',
		'flyout_width'                             => '200px',
		'flyout_menu_background_from'              => 'rgb(255, 255, 255)',
		'flyout_menu_background_to'                => 'rgb(255, 255, 255)',
		'flyout_border_color'                      => 'rgb(241, 241, 241)',
		'flyout_border_left'                       => '1px',
		'flyout_border_right'                      => '1px',
		'flyout_border_top'                        => '1px',
		'flyout_border_bottom'                     => '1px',
		'flyout_menu_item_divider'                 => 'on',
		'flyout_menu_item_divider_color'           => 'rgb(241, 241, 241)',
		'flyout_padding_top'                       => '10px',
		'flyout_padding_bottom'                    => '10px',
		'flyout_background_from'                   => 'rgb(255, 255, 255)',
		'flyout_background_to'                     => 'rgb(255, 255, 255)',
		'flyout_background_hover_from'             => 'rgba(221, 221, 221, 0)',
		'flyout_background_hover_to'               => 'rgba(221, 221, 221, 0)',
		'flyout_link_size'                         => '13px',
		'flyout_link_color'                        => 'rgb(33, 33, 33)',
		'flyout_link_color_hover'                  => 'rgb(124, 179, 66)',
		'flyout_link_family'                       => 'inherit',
		'flyout_link_text_transform'               => 'uppercase',
		'responsive_breakpoint'                    => '1024px',
		'shadow_color'                             => 'rgba(0, 0, 0, 0)',
		'toggle_background_from'                   => 'rgba(255, 255, 255, 0)',
		'toggle_background_to'                     => 'rgba(255, 255, 255, 0)',
		'toggle_font_color'                        => 'rgb(33, 33, 33)',
		'toggle_bar_height'                        => '0px',
		'mobile_menu_item_height'                  => '50px',
		'mobile_background_from'                   => 'rgb(255, 255, 255)',
		'mobile_background_to'                     => 'rgb(255, 255, 255)',
		'custom_css'                               => '/** Push menu onto new line **/
#{$wrap} {
    clear: both;
}',
	);

	return $themes;
}

add_filter( 'megamenu_themes', 'penci_megamenu_add_theme_default' );


