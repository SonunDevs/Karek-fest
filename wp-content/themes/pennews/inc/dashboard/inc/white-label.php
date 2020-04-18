<?php
if( ! class_exists( 'Penci_White_Lable' ) ) {
	class Penci_White_Lable {
		public function __construct() {

			if( $this->is_show_white_label_panel() ){
				add_filter( 'mb_settings_pages', array( $this, 'options_page' ),999 );
				add_filter( 'rwmb_meta_boxes', array( $this,'options_meta_boxes' ) ,999 );
			}

			add_filter( 'admin_body_class',  array( $this, 'add_admin_body_class' ) );
			add_action( 'login_enqueue_scripts', array( $this,'login_scripts' ) );
		}

		public function  add_admin_body_class( $class ){
			$icon = penci_get_theme_mod( 'admin_wel_page_icon' );
			if( $icon ) {
				$icon = str_replace( 'fa ', '', $icon );
				$class .= $icon;
			}
			return $class;
		}


        public function login_scripts(){

            if( ! penci_get_theme_mod( 'activate_white_label' ) ) {
                return;
            }
            
           $custom_css = '';

            $logo    = penci_get_theme_mod( 'admin_login_logo' );
            $logo = isset( $logo[0] ) ? $logo[0] : '';

            $bgimage = penci_get_theme_mod( 'admin_login_bgimage' );
            $bgimage = isset(  $bgimage[0] ) ?  $bgimage[0] : '';

            $bgcolor = penci_get_theme_mod( 'admin_login_bgcolor' );

            if( $logo ) {
                $logo_img = wp_get_attachment_image_src( $logo, 'full' );

                $logo_img_url = isset( $logo_img[0] ) ? $logo_img[0] : ''; 
                $logo_img_w   = $logo_img_h = '';

                $login_logow = penci_get_theme_mod( 'admin_login_logow' );
                $login_logoh = penci_get_theme_mod( 'admin_login_logoh' );

                if( $login_logow ) {
                    $logo_img_w = $login_logow;
                }elseif( isset( $logo_img[1] ) ) {
                    $logo_img_w = $logo_img[1];
                }

                if( $login_logoh ) {
                    $logo_img_h = $login_logoh;
                }elseif( isset( $logo_img[2] ) ) {
                    $logo_img_h = $logo_img[2];
                }

                $custom_css .= '#login h1 a, .login h1 a {';
                $custom_css .= 'background-image: url(' . esc_url( $logo_img_url ) . ');';
                $custom_css .= $logo_img_w ? 'width: '. esc_attr( $logo_img_w ) .'px;' : '';
                $custom_css .= $logo_img_h ? 'height: '. esc_attr( $logo_img_h ) .'px;' : '';
                $custom_css .= 'background-size: '. esc_attr( $logo_img_w ) .'px '. esc_attr( $logo_img_h ) .'px;';

                if( $logo_img_w > 320 ) {
                    $custom_css .='margin-left:-' . intval( ( $logo_img_w - 320 ) / 2 ) . 'px;';
                }

                $custom_css .='}';
            }

            if( $bgimage ) {
                $bgimage_img = wp_get_attachment_image_src( $bgimage, 'full' );
                if(  isset( $bgimage_img[0] ) && $bgimage_img[0] ) {
                    $custom_css .= 'body{  background-image: url(' . esc_url( $bgimage_img[0] ) . ') !important;
                    background-size: cover !important;background-position: center center !important;background-repeat: no-repeat !important;background-attachment: fixed !important; }';
                }
            }

            if( $bgcolor ) {
                $custom_css .= 'body{ background-color:' .  $bgcolor . ' !important; }';
            }

            if( $custom_css ) {
                echo '<style type="text/css">' . $custom_css . '</style>';
            }
        }

        public function options_page( $settings_pages ) {
            $settings_pages[] = array(
                'id'          => 'pennews_white_label',
                'option_name' => 'theme_mods_' . get_stylesheet(),
                'menu_title'  => esc_html__( 'White Label ', 'pennews' ),
                'parent'      => 'pennews_dashboard_welcome',
                'columns'       => 1,
            );
            return $settings_pages;
        }

        public function options_meta_boxes( $meta_boxes ) {

	        $white_label_filed = array(
		        array(
			        'id'   => 'activate_white_label',
			        'name' => __( 'Activate White Label?', 'pennews' ),
			        'type' => 'checkbox',
		        ),
		        array(
			        'name' => esc_html__( 'Custom Logo for Login Page', 'pennews' ),
			        'id'   => 'admin_login_logo',
			        'type' => 'image_advanced',
			        'max_file_uploads' => 1,
			        'max_status'       => 'false',
		        ),
		        array(
			        'name'   => esc_html__( 'Custom Logo Width on Login Page', 'pennews' ),
			        'desc'   => esc_html__( 'Numeric value only, unit is pixel', 'pennews' ),
			        'id'     => 'admin_login_logow',
			        'type'   => 'number',
			        'std'    => '',
			        'hidden' => array( 'button2_type', '=', 'simple' )
		        ),
		        array(
			        'name'   => esc_html__( 'Custom Logo Height on Login Page', 'pennews' ),
			        'desc'   => esc_html__( 'Numeric value only, unit is pixel', 'pennews' ),
			        'id'     => 'admin_login_logoh',
			        'type'   => 'number',
			        'std'    => '',
			        'hidden' => array( 'button2_type', '=', 'simple' )
		        ),
		        array('type' => 'divider' ),
		        array(
			        'name' => esc_html__( 'Custom Background Image for Login Page', 'pennews' ),
			        'id'   => 'admin_login_bgimage',
			        'type'  => 'image_advanced',
			        'max_file_uploads' => 1,
			        'max_status'       => 'false',
		        ),
		        array(
			        'name' => esc_html__( 'Custom Background Color for Login Page', 'pennews' ),
			        'id'   => 'admin_login_bgcolor',
			        'type' => 'color',
		        ),
		        array('type' => 'divider' ),
		        array(
			        'id' => 'admin_wel_page_icon',
			        'type' => 'text',
			        'name' => esc_html__( 'Theme Icon', 'pennews' ),
			        'desc' => __( 'Fill the icon class you want to display here. Check list icons <a href="https://fontawesome.com/v4.7.0/icons/" target="_blank">here</a>. Example fill: <strong>fa-book</strong>', 'pennews' ),
		        ),array(
			        'id' => 'admin_wel_page_title',
			        'type' => 'text',
			        'name' => esc_html__( 'Theme Name', 'pennews' ),
		        ),
		        array(
			        'name'    => esc_html__( 'Custom Text for Welcome Page','pennews' ),
			        'id'      => 'admin_wel_page_text',
			        'type'    => 'wysiwyg',
			        'raw'     => false,
			        'options' => array(
				        'textarea_rows' => 4,
				        'teeny'         => true,
			        ),
		        )
	        );

	       $list_administrator =  $this->get_list_users();

	        if ( $list_administrator ) {
		        $white_label_filed[] = array( 'type' => 'divider' );
		        $white_label_filed[] = array(
			        'name'            => esc_html__( 'Show White Label Panel for?', 'pennews' ),
			        'id'              => 'show_white_lable_user',
			        'type'            => 'select',
			        'options'         => $list_administrator,
		        );
	        }

            $meta_boxes[] = array(
                'id'             => 'pennews_wp_banding',
                'title'          => esc_html__( 'WordPress Branding', 'pennews' ),
                'settings_pages' => 'pennews_white_label',
                'fields'         => $white_label_filed
            );
            return $meta_boxes;
        }

		public function get_list_users() {
			$current_user = wp_get_current_user();

			$user_query = new WP_User_Query( array(
				'number'  => 100,
				'orderby' => 'registered',
				'order'   => 'ASC',
				'role'    => 'Administrator',
			) );

			$output = array( '' => esc_html__( 'Administrator Users', 'pennews' ) );

			$get_results = $user_query->get_results();

			if ( ! empty( $get_results ) ) {
				foreach ( $get_results as $user ) {

					$display_name = isset( $user->data->display_name ) ? $user->data->display_name : '';
					$user_login   = isset( $user->data->user_login ) ? $user->data->user_login : '';

					if ( ! $display_name ) {
						continue;
					}

					$label = '';

					if ( $user->data->ID === $current_user->get( 'ID' ) ) {
						$label = esc_html__( 'Me: ', 'pennews' );
					}

					$label .= $display_name . '( ' . $user_login . ' )';


					$output[ $user->data->ID ] = $label;
				}
			}

			return $output;
		}

		public function is_show_white_label_panel() {
        	$output = true;

        	$id_show = penci_get_theme_mod( 'show_white_lable_user' );
			$user_id = get_current_user_id();

        	if( ! $id_show || ( $user_id == $id_show ) ) {
				$output = true;
	        }elseif( $id_show && ( $user_id != $id_show ) ){
		        $output = false;
	        }

	        return $output;
		}
	}
}

new Penci_White_Lable();
