<?php

/**
 *
 * Custom Post Type And Taxonomies Class
 *
 */

namespace ExhibzCustomPost;

if ( ! defined( 'ABSPATH' ) ) exit;

class Exhibz_CustomPost {

  private $textdomain;
  private $xs_posts;

    public function __construct( $textdomain){
        $this->textdomain = $textdomain;
        $this->xs_posts = array();
        add_action('init', array($this, 'register_custom_post'));
    }

    public function xs_init( $type, $singular_label, $plural_label, $settings = array() ){
        
        $default_settings = array(
            'labels' => array(
                'name' => __($plural_label, $this->textdomain),
                'singular_name' => __($singular_label, $this->textdomain),
                'add_new_item' => __('Add New '.$singular_label, $this->textdomain),
                'edit_item'=> __('Edit '.$singular_label, $this->textdomain),
                'new_item'=>__('New '.$singular_label, $this->textdomain),
                'view_item'=>__('View '.$singular_label, $this->textdomain),
                'search_items'=>__('Search '.$plural_label, $this->textdomain),
                'not_found'=>__('No '.$plural_label.' found', $this->textdomain),
                'not_found_in_trash'=>__('No '.$plural_label.' found in trash', $this->textdomain),
                'parent_item_colon'=>__('Parent '.$singular_label, $this->textdomain),
                'menu_name' => __($plural_label,$this->textdomain)
            ),
            'public'=>true,
            'has_archive' => true,
            'menu_icon' => '',
            'menu_position'=>20,
            'supports'=>array(
                'title',
                'editor',
                'thumbnail'
            ),
            'rewrite' => array(
                'slug' => sanitize_title_with_dashes($plural_label)
            )
        );
        $this->xs_posts[$type] = array_merge($default_settings, $settings);
    }

    public function register_custom_post(){
        foreach($this->xs_posts as $key=>$value) {
            register_post_type($key, $value);
            flush_rewrite_rules( false );
        }
    }
    
}

class Exhibz_Taxonomies {
    protected $textdomain;
    protected $taxonomies;

    public function __construct ( $textdomain ){
        $this->textdomain = $textdomain;
        $this->taxonomies = array();
        add_action('init', array($this, 'register_taxonomy'));
    }

    public function xs_init( $type, $singular_label, $plural_label, $post_types, $settings = array() ){
        $default_settings = array(
            'labels' => array(
                'name' => __($plural_label, $this->textdomain),
                'singular_name' => __($singular_label, $this->textdomain),
                'add_new_item' => __('New '.$singular_label.' Name', $this->textdomain),
                'new_item_name' => __('Add New '.$singular_label, $this->textdomain),
                'edit_item'=> __('Edit '.$singular_label, $this->textdomain),
                'update_item'=> __('Update '.$singular_label, $this->textdomain),
                'add_or_remove_items'=> __('Add or remove '.strtolower($plural_label), $this->textdomain),
                'search_items'=>__('Search '.$plural_label, $this->textdomain),
                'popular_items'=>__('Popular '.$plural_label, $this->textdomain),
                'all_items'=>__('All '.$plural_label, $this->textdomain),
                'parent_item'=>__('Parent '.$singular_label, $this->textdomain),
                'choose_from_most_used'=> __('Choose from the most used '.strtolower($plural_label), $this->textdomain),
                'parent_item_colon'=>__('Parent '.$singular_label, $this->textdomain),
                'menu_name'=>__($singular_label, $this->textdomain),
            ),

            'public'=>true,
            'show_in_nav_menus' => true,
            'show_admin_column' => false,
            'hierarchical'      => true,
            'show_tagcloud'     => false,
            'show_ui'           => true,
            'rewrite' => array(
                'slug' => sanitize_title_with_dashes($plural_label)
            )
        );

        $this->taxonomies[$type]['post_types'] = $post_types;
        $this->taxonomies[$type]['args'] = array_merge($default_settings, $settings);       
    }

    public function register_taxonomy(){
        foreach($this->taxonomies as $key => $value) {
            register_taxonomy($key, $value['post_types'], $value['args']);
        }
    }

}