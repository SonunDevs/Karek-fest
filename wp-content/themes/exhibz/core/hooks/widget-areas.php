<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * register widget area
 */

function exhibz_widget_init()
{
    if (function_exists('register_sidebar')) {
        register_sidebar(
            array(
                'name' => esc_html__('Blog widget area', 'exhibz'),
                'id' => 'sidebar-1',
                'description' => esc_html__('Appears on posts.', 'exhibz'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>',
            )
        );
    }
}

add_action('widgets_init', 'exhibz_widget_init');


function footer_right_widgets_init(){
    if ( function_exists('register_sidebar') )
    register_sidebar(array(
      'name' => 'Footer Right',
      'id' => 'footer_right',
      'before_widget' => '<div class="text-right">',
      'after_widget' => '</div>',
      'before_title' => '<h3>',
      'after_title' => '</h3>',
    )
  );
}
add_action( 'widgets_init', 'footer_right_widgets_init' );