<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * helper functions
 */

// simply echo the variable
// ----------------------------------------------------------------------------------------
function exhibz_return( $s ) {
	return $s;
}

function exhibz_get_all_schedule(){
	global $wpdb;

    $scheduled = $wpdb->get_results( "SELECT {$wpdb->prefix}postmeta.*,{$wpdb->prefix}posts.post_title as post_title FROM {$wpdb->prefix}posts INNER JOIN {$wpdb->prefix}postmeta ON ( {$wpdb->prefix}posts.ID = {$wpdb->prefix}postmeta.post_id ) WHERE 1=1 AND ( {$wpdb->prefix}postmeta.meta_key = 'fw_options' ) AND {$wpdb->prefix}posts.post_type = 'ts-schedule' AND ({$wpdb->prefix}posts.post_status = 'publish') GROUP BY {$wpdb->prefix}posts.ID ORDER BY {$wpdb->prefix}posts.post_date DESC", OBJECT );
    return $scheduled;		
}
function exhibz_schedule_find_speaker($search_id,$item){
  $all_schedule = []; 
  $data  = unserialize($item->meta_value);
  $schedule_day =  $data['schedule_day'];
   
  $data_arr = $data['exhibz_schedule_pop_up'];
   // find speaker here   
   foreach($data_arr as $value){
		
	   if($is_multi_speaker=exhibz_is_multi_speaker($search_id,$value)){
		  
 		   $multi_sd = $is_multi_speaker;
		   $multi_sd['schedule_day'] = $schedule_day;
		   $multi_sd['post_title'] = $item->post_title;
		   $all_schedule[] = $multi_sd;	
		   
		  
	   }else{
		   
		 if($value['speakers']==$search_id){
			$sd = $value;
			$sd['schedule_day'] = $schedule_day;
			$sd['post_title'] = $item->post_title;
		    $all_schedule[] = $sd;	
		   
		}  
	   }
		
	}
	
   return $all_schedule;
  
}

function exhibz_is_multi_speaker($search_id=null,$value=[]){
	 
	if(!is_array($value)){
        return false; 		
	}
	
	if(isset($value['multi_speaker_choose'])){
	      $style = isset($value['multi_speaker_choose']['style'])?$value['multi_speaker_choose']['style']:'no';
		  if($style=='yes'){
			 $yes = isset($value['multi_speaker_choose']['yes'])?$value['multi_speaker_choose']['yes']:[]; 
              if(isset($yes['multi_speakers'])){
				  
				  if(in_array($search_id,$yes['multi_speakers'])){
					 
					return $value;  
				  } 
				 
			  } 			 
			 
			
		  }
	}
	return false;
}
function exhibz_get_speaker_schedule_array_reduced($speaker_id=null,$schedule=null){
	$sorted_data = [];
	$data = exhibz_get_speaker_schedule(get_the_id(),$schedule); 
	foreach($data as $value){
		foreach($value as $item){
		$sorted_data[] = $item;		
		}
	  
	}
	return $sorted_data;
    
}
function exhibz_get_speaker_schedule($speaker_id=null,$schedule=null){
	if(is_null($speaker_id) || is_null($schedule)){
	  return false;	
	}
	
	$schedule_map = [];
	$search_id = $speaker_id;
    foreach($schedule as $single_schedule) {
	
		 if(exhibz_schedule_find_speaker($search_id,$single_schedule)){
				$schedule_map[] = exhibz_schedule_find_speaker($search_id,$single_schedule); 
		 }
	 
	}
	
	
	return $schedule_map;
	
}



// return the specific value from theme options/ customizer/ etc
// ----------------------------------------------------------------------------------------
function exhibz_option( $key, $default_value = '', $method = 'customizer' ) {
	if ( defined( 'FW' ) ) {
		switch ( $method ) {
			case 'theme-settings':
				$value = fw_get_db_settings_option( $key );
				break;
			case 'customizer':
				$value = fw_get_db_customizer_option( $key );
				break;
			default:
				$value = '';
				break;
		}
		return (!isset($value) || $value == '') ? $default_value :  $value;
	}
	return $default_value;
}

// return the specific value from term/ taxomony metabox
// ----------------------------------------------------------------------------------------
function exhibz_term_option( $termid, $key, $default_value = '', $taxomony = 'category' ) {
	if ( defined( 'FW' ) ) {
		
		$value = fw_get_db_term_option($termid, $taxomony, $key);
	
	}
	return (!isset($value) || $value == '') ? $default_value :  $value;
}


// return the specific value from metabox
// ----------------------------------------------------------------------------------------
function exhibz_meta_option( $postid, $key, $default_value = '' ) {
	if ( defined( 'FW' ) ) {
		$value = fw_get_db_post_option($postid, $key, $default_value);
	}
	return (!isset($value) || $value == '') ? $default_value :  $value;
}


// unyson based image resizer
// ----------------------------------------------------------------------------------------
function exhibz_resize( $url, $width = false, $height = false, $crop = false ) {
	if ( function_exists( 'fw_resize' ) ) {
		$fw_resize	 = FW_Resize::getInstance();
		$response	 = $fw_resize->process( $url, $width, $height, $crop );
		return (!is_wp_error( $response ) && !empty( $response[ 'src' ] ) ) ? $response[ 'src' ] : $url;
	} else {
		$response = wp_get_attachment_image_src( $url, array( $width, $height ) );
		if ( !empty( $response ) ) {
			return $response[ 0 ];
		}
	}
}


// extract unyson image data from option value in a much simple way
// ----------------------------------------------------------------------------------------
function exhibz_src( $key, $default_value = '', $input_as_attachment = false ) { // for src
	if ( $input_as_attachment == true ) {
		$attachment = $key;
	} else {
		$attachment = exhibz_option( $key );
	}

	if ( isset( $attachment[ 'url' ] ) && !empty( $attachment ) ) {
		return $attachment[ 'url' ];
	}

	return $default_value;
}


// return attachment alt in safe mode
// ----------------------------------------------------------------------------------------
function exhibz_alt( $id ) {
	if ( !empty( $id ) ) {
		$alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
		if ( !empty( $alt ) ) {
			$alt = $alt;
		} else {
			$alt = get_the_title( $id );
		}
		return $alt;
	}
}


// get original id in WPML enabled WP
// ----------------------------------------------------------------------------------------
function exhibz_org_id( $id, $name = true ) {
	if ( function_exists( 'icl_object_id' ) ) {
		$id = icl_object_id( $id, 'page', true, 'en' );
	}

	if ( $name === true ) {
		$post = get_post( $id );
		return $post->post_name;
	} else {
		return $id;
	}
}


// converts rgb color code to hex format
// ----------------------------------------------------------------------------------------
function exhibz_rgb2hex( $hex ) {
	$hex		 = preg_replace( "/^#(.*)$/", "$1", $hex );
	$rgb		 = array();
	$rgb[ 'r' ]	 = hexdec( substr( $hex, 0, 2 ) );
	$rgb[ 'g' ]	 = hexdec( substr( $hex, 2, 2 ) );
	$rgb[ 'b' ]	 = hexdec( substr( $hex, 4, 2 ) );

	$color_hex = $rgb[ "r" ] . ", " . $rgb[ "g" ] . ", " . $rgb[ "b" ];
	return $color_hex;
}


// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function exhibz_kses( $raw ) {

	$allowed_tags = array(
		'a'								 => array(
			'class'	 => array(),
			'href'	 => array(),
			'rel'	 => array(),
			'title'	 => array(),
			'target' => array()
		),
		'abbr'							 => array(
			'title' => array(),
		),
		'b'								 => array(),
		'blockquote'					 => array(
			'cite' => array(),
		),
		'cite'							 => array(
			'title' => array(),
		),
		'code'							 => array(),
		'del'							 => array(
			'datetime'	 => array(),
			'title'		 => array(),
		),
		'dd'							 => array(),
		'div'							 => array(
			'class'	 => array(),
			'title'	 => array(),
			'style'	 => array(),
		),
		'dl'							 => array(),
		'dt'							 => array(),
		'em'							 => array(),
		'h1'							 => array(),
		'h2'							 => array(),
		'h3'							 => array(),
		'h4'							 => array(),
		'h5'							 => array(),
		'h6'							 => array(),
		'i'								 => array(
			'class' => array(),
		),
		'img'							 => array(
			'alt'	 => array(),
			'class'	 => array(),
			'height' => array(),
			'src'	 => array(),
			'width'	 => array(),
		),
		'li'							 => array(
			'class' => array(),
		),
		'ol'							 => array(
			'class' => array(),
		),
		'p'								 => array(
			'class' => array(),
		),
		'q'								 => array(
			'cite'	 => array(),
			'title'	 => array(),
		),
		'span'							 => array(
			'class'	 => array(),
			'title'	 => array(),
			'style'	 => array(),
		),
		'iframe'						 => array(
			'width'			 => array(),
			'height'		 => array(),
			'scrolling'		 => array(),
			'frameborder'	 => array(),
			'allow'			 => array(),
			'src'			 => array(),
		),
		'strike'						 => array(),
		'br'							 => array(),
		'strong'						 => array(),
		'data-wow-duration'				 => array(),
		'data-wow-delay'				 => array(),
		'data-wallpaper-options'		 => array(),
		'data-stellar-background-ratio'	 => array(),
		'ul'							 => array(
			'class' => array(),
		),
	);

	if ( function_exists( 'wp_kses' ) ) { // WP is here
		$allowed = wp_kses( $raw, $allowed_tags );
	} else {
		$allowed = $raw;
	}


	return $allowed;
}


// build google font url
// ----------------------------------------------------------------------------------------
function exhibz_google_fonts_url($font_families	 = []) {
	$fonts_url		 = '';
	if ( $font_families ) {
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) )
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}


function exhibz_main( $id, $name = true ) {
	if ( function_exists( 'icl_object_id' ) ) {
		$id = icl_object_id( $id, 'page', true, 'en' );
	}

	if ( $name === true ) {
		$post = get_post( $id );
		return $post->post_name;
	} else {
		return $id;
	}
}

if ( !function_exists( 'exhibz_edit_section' ) ) {

	function exhibz_edit_section() {
		if ( is_user_logged_in() ) {
			?>
			<div class="section-edit">
				<div class="container relative">
					<?php
					edit_post_link( esc_html__( 'Edit', 'exhibz' ), '', '' );
					?>
					<span class="section-abc"><?php echo esc_html( get_the_title() ); ?> <?php echo esc_attr_e( 'Or', 'exhibz' ) ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>/wp-admin/post.php?post=<?php the_ID(); ?>&action=elementor" target="_blank"><?php echo esc_attr_e( 'Edit with elementor', 'exhibz' ) ?></a></span> 

				</div>
			</div>
			<?php
		}
	}

}


function exhibz_get_post_meta( $id, $needle ) {
	$data = get_post_meta( $id, 'fw_options' );
	if ( is_array( $data ) && isset( $data[ 0 ][ 'page_sections' ] ) ) {
		$data = $data[ 0 ][ 'page_sections' ];

		if ( is_array( $data ) ) {
			return exhibz_seekKey( $data, $needle );
		}
	}
}

function exhibz_seekKey( $haystack, $needle ) {
	foreach ( $haystack as $key => $value ) {

		if ( $key == $needle ) {
			return $value;
		} elseif ( is_array( $value ) ) {
			return exhibz_seekKey( $value, $needle );
		}
	}
}

// Creates SEO friendly section ID from page ID. Returns page ID directly if $return = true
// since 2.0
function exhibz_sectionID( $id, $returnID = false ) {

	if ( $returnID == false ) {

		$str		 = get_the_title( $id );
		$patterns	 = array(
			"/[:#+*+&+!+@+!+\.+?+%+$+\"+'+^+\[+<+{+\(+\)}+>+\]+,+`+;+,+=+\\\\]/", // match unwanted special characters
			"@<(script|style)[^>]*?>.*?</\\1>@si", // match <script>, <style> tags
			"/[~\r\n\t \/_|+ -]+/" // match newline, tab and more unwanted characters
		);

		$replacements = array(
			"", // for 1st match
			"", // for 2nd match
			"-" // for 3rd match
		);

		$str = preg_replace( $patterns, $replacements, strip_tags( $str ) );
		return strtolower( trim( $str, '-' ) );
	} else {

		return "section-$id";
	}
}

// return megamenu child item's slug
// ----------------------------------------------------------------------------------------
function exhibz_get_mega_item_child_slug( $location, $option_id ) {
	$mega_item	 = '';
	$locations	 = get_nav_menu_locations();
	$menu		 = wp_get_nav_menu_object( $locations[ $location ] );
	$menuitems	 = wp_get_nav_menu_items( $menu->term_id );

	foreach ( $menuitems as $menuitem ) {

		$id			 = $menuitem->ID;
		$mega_item	 = fw_ext_mega_menu_get_db_item_option( $id, $option_id );
	}
	return $mega_item;
}


// return cover image from an youtube video url
// ----------------------------------------------------------------------------------------
function exhibz_youtube_cover( $e ) {
	$src = null;
	//get the url
	if ( $e != '' ){
		$url = $e;
		$queryString = parse_url( $url, PHP_URL_QUERY );
		parse_str( $queryString, $params );
		$v = $params[ 'v' ];
		//generate the src
		if ( strlen( $v ) > 0 ) {
			$src = "http://i3.ytimg.com/vi/$v/default.jpg";
		}
	}

	return $src;
}


// return embed code for sound cloud
// ----------------------------------------------------------------------------------------
function exhibz_soundcloud_embed( $url ) {
	return 'https://w.soundcloud.com/player/?url=' . urlencode($url) . '&auto_play=false&color=915f33&theme_color=00FF00';
}


// return embed code video url
// ----------------------------------------------------------------------------------------
function exhibz_video_embed($url){
    //This is a general function for generating an embed link of an FB/Vimeo/Youtube Video.
	$embed_url = '';
    if(strpos($url, 'facebook.com/') !== false) {
        //it is FB video
        $embed_url ='https://www.facebook.com/plugins/video.php?href='.rawurlencode($url).'&show_text=1&width=200';
    }else if(strpos($url, 'vimeo.com/') !== false) {
        //it is Vimeo video
        $video_id = explode("vimeo.com/",$url)[1];
        if(strpos($video_id, '&') !== false){
            $video_id = explode("&",$video_id)[0];
        }
        $embed_url ='https://player.vimeo.com/video/'.$video_id;
    }else if(strpos($url, 'youtube.com/') !== false) {
        //it is Youtube video
        $video_id = explode("v=",$url)[1];
        if(strpos($video_id, '&') !== false){
            $video_id = explode("&",$video_id)[0];
        }
		$embed_url ='https://www.youtube.com/embed/'.$video_id;
    }else if(strpos($url, 'youtu.be/') !== false){
        //it is Youtube video
        $video_id = explode("youtu.be/",$url)[1];
        if(strpos($video_id, '&') !== false){
            $video_id = explode("&",$video_id)[0];
        }
        $embed_url ='https://www.youtube.com/embed/'.$video_id;
    }else{
        //for new valid video URL
    }
    return $embed_url;
}

if ( !function_exists( 'exhibz_advanced_font_styles' ) ) :

	/**
	 * Get shortcode advanced Font styles
	 *
	 */
	function exhibz_advanced_font_styles( $style ) {

		$font_styles = $font_weight = '';

		$font_weight = (isset( $style[ 'font-weight' ] ) && $style[ 'font-weight' ]) ? 'font-weight:' . esc_attr( $style[ 'font-weight' ] ) . ';' : '';
		$font_weight = (isset( $style[ 'variation' ] ) && $style[ 'variation' ]) ? 'font-weight:' . esc_attr( $style[ 'variation' ] ) . ';' : $font_weight;

		$font_styles .= isset( $style[ 'family' ] ) ? 'font-family:"' . $style[ 'family' ] . '";' : '';
		$font_styles .= isset($style[ 'style' ] ) && $style[ 'style' ] ? 'font-style:' . esc_attr( $style[ 'style' ] ) . ';' : '';
		
		$font_styles .= isset( $style[ 'color' ] ) && !empty( $style[ 'color' ] ) ? 'color:' . esc_attr( $style[ 'color' ] ) . ';' : '';
		$font_styles .= isset( $style[ 'line-height' ] ) && !empty( $style[ 'line-height' ] ) ? 'line-height:' . esc_attr( $style[ 'line-height' ] ) . 'px;' : '';
		$font_styles .= isset( $style[ 'letter-spacing' ] ) && !empty( $style[ 'letter-spacing' ] ) ? 'letter-spacing:' . esc_attr( $style[ 'letter-spacing' ] ) . 'px;' : '';
		$font_styles .= isset( $style[ 'size' ] ) && !empty( $style[ 'size' ] ) ? 'font-size:' . esc_attr( $style[ 'size' ] ) . 'px;' : '';
		
		$font_styles .= !empty( $font_weight ) ? $font_weight : '';

		return !empty( $font_styles ) ? $font_styles : '';
	}

endif;

function exhibz_text_logo(){
	$general_text_logo = exhibz_option('general_text_logo');
	if($general_text_logo=='yes'){
	   $general_text_logo_settings = exhibz_option('general_text_logo_settings');
	   if(isset($general_text_logo_settings['yes'])){
			 $yes = $general_text_logo_settings['yes'];
			 if($yes['general_text_logo_title']){
 
				$general_text_logo_title = $yes['general_text_logo_title'];
				return $general_text_logo_title;
			 
			 }
	   }
	}
	return false;
 }