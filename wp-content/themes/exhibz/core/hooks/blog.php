<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * hooks for wp blog part
 */

// if there is no excerpt, sets a defult placeholder
// ----------------------------------------------------------------------------------------
function exhibz_excerpt( $words = 20, $more = 'BUTTON' ) {
	if($more == 'BUTTON'){
		$more = '<a class="btn btn-primary">'.esc_html__('read more', 'exhibz').'</a>';
	}
	$excerpt		 = get_the_excerpt();
	$trimmed_content = wp_trim_words( $excerpt, $words, $more );
	echo exhibz_kses( $trimmed_content );
}


// change textarea position in comment form
// ----------------------------------------------------------------------------------------
function exhibz_move_comment_textarea_to_bottom( $fields ) {
	$comment_field		 = $fields[ 'comment' ];
	unset( $fields[ 'comment' ] );
	$fields[ 'comment' ] = $comment_field;
	return $fields;
}
add_filter( 'comment_form_fields', 'exhibz_move_comment_textarea_to_bottom' );


// change textarea position in comment form
// ----------------------------------------------------------------------------------------
function exhibz_search_form( $form ) {
    $form = '
        <form  method="get" action="' . esc_url( home_url( '/' ) ) . '" class="exhibz-serach">
            <div class="input-group">
                <input type="search" class="form-control" name="s" placeholder="' .esc_attr__( 'Search', 'exhibz' ) . '" value="' . get_search_query() . '">
                <button class="input-group-btn"><i class="fa fa-search"></i></button>
            </div>
        </form>';
	return $form;
}
add_filter( 'get_search_form', 'exhibz_search_form' );

// Added sidebar inactive class on body area
// ----------------------------------------------------------------------------------------
function exhibz_body_classes( $classes ) {

    if ( is_active_sidebar( 'sidebar-1' ) || ( class_exists( 'Woocommerce' ) && ! is_woocommerce() ) || class_exists( 'Woocommerce' ) && is_woocommerce() && is_active_sidebar( 'shop-sidebar' ) ) {
        $classes[] = 'sidebar-active';
    }else{
        $classes[] = 'sidebar-inactive';
    }
    return $classes;
}
add_filter( 'body_class','exhibz_body_classes' );

function exhibz_speaker_cat_query( $query ) {
      
    if ( is_tax('ts-speaker_cat') && $query->is_main_query() && !is_admin() ) {
        $cat = get_queried_object();
        if(isset($cat->term_id)){
            $exhibz_speaker_count = exhibz_term_option($cat->term_id,'exhibz_speaker_count',8,'ts-speaker_cat');
            $query->set( 'posts_per_page', $exhibz_speaker_count );
        }
      
    }
}
add_action( 'pre_get_posts', 'exhibz_speaker_cat_query' );
