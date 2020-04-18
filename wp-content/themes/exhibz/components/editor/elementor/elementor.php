<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if(defined('ELEMENTOR_VERSION')):

include_once EXHIBZ_EDITOR . '/elementor/manager/controls.php';

class EXHIBZ_Shortcode{

	/**
     * Holds the class object.
     *
     * @since 1.0
     *
     */
    public static $_instance;
    

    /**
     * Localize data array
     *
     * @var array
     */
    public $localize_data = array();

	/**
     * Load Construct
     * 
     * @since 1.0
     */

	public function __construct(){

		add_action('elementor/init', array($this, 'EXHIBZ_elementor_init'));
        add_action('elementor/controls/controls_registered', array( $this, 'exhibz_icon_pack' ), 11 );
        add_action('elementor/controls/controls_registered', array( $this, 'control_image_choose' ), 13 );
        add_action('elementor/controls/controls_registered', array( $this, 'EXHIBZ_ajax_select2' ), 13 );
        add_action('elementor/widgets/widgets_registered', array($this, 'EXHIBZ_shortcode_elements'));
        add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'editor_enqueue_styles' ) );
        add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'elementor/preview/enqueue_styles', array( $this, 'preview_enqueue_scripts' ) );

        $this-> exhibz_elementor_icon_pack();
        
	}


    /**
     * Enqueue Scripts
     *
     * @return void  
     */ 
    
     public function enqueue_scripts() {
         wp_enqueue_script( 'exhibz-main-elementor', EXHIBZ_JS  . '/elementor.js',array( 'jquery', 'elementor-frontend' ), EXHIBZ_VERSION, true );
    }

    /**
     * Enqueue editor styles
     *
     * @return void
     */

    public function editor_enqueue_styles() {
        wp_enqueue_style( 'exhibz-panel', EXHIBZ_CSS.'/panel.css',null, EXHIBZ_VERSION );
        wp_enqueue_style( 'exhibz-icon-elementor', EXHIBZ_CSS.'/icofont.css',null, EXHIBZ_VERSION );

    }

    /**
     * Preview Enqueue Scripts
     *
     * @return void
     */

    public function preview_enqueue_scripts() {}
	/**
     * Elementor Initialization
     *
     * @since 1.0
     *
     */

    public function EXHIBZ_elementor_init(){
    
        \Elementor\Plugin::$instance->elements_manager->add_category(
            'exhibz-elements',
            [
                'title' =>esc_html__( 'EXHIBZ', 'exhibz' ),
                'icon' => 'fa fa-plug',
            ],
            1
        );
    }

    /**
     * Extend Icon pack core controls.
     *
     * @param  object $controls_manager Controls manager instance.
     * @return void
     */ 

    public function EXHIBZ_icon_pack( $controls_manager ) {

        require_once EXHIBZ_EDITOR_ELEMENTOR. '/controls/icon.php';

        $controls = array(
            $controls_manager::ICON => 'EXHIBZ_Icon_Controler',
        );

        foreach ( $controls as $control_id => $class_name ) {
            $controls_manager->unregister_control( $control_id );
            $controls_manager->register_control( $control_id, new $class_name() );
        }

    }
    

    public function exhibz_elementor_icon_pack(  ) {

		$this->__generate_font();
		
		add_filter( 'elementor/icons_manager/additional_tabs', function(){
                return apply_filters( 'elementor/icons_manager/native', [
                    
					'icon-instive' => [
						'name' => 'icon-instive',
						'label' => esc_html__( 'exhibz Icon', 'exhibz' ),
						'url' => EXHIBZ_CSS . '/icofont.css',
						'enqueue' => [ EXHIBZ_CSS . '/icofont.css' ],
						'prefix' => 'icon-',
						'displayPrefix' => 'icon',
						'labelIcon' => 'icon icon-hand',
						'ver' => '5.9.0',
						'fetchJson' => EXHIBZ_JS . '/icofont.js',
						'native' => true,
					]
                ]);
            }
        );
		
    }
	
	public function __generate_font(){
		global $wp_filesystem;
 
        require_once ( ABSPATH . '/wp-admin/includes/file.php' );
        WP_Filesystem();
        $css_file =  EXHIBZ_CSS_DIR . '/icofont.css';
     
        if ( $wp_filesystem->exists( $css_file ) ) {
            $css_source = $wp_filesystem->get_contents( $css_file );
        } // End If Statement
        
		preg_match_all( "/\.(icon-.*?):\w*?\s*?{/", $css_source, $matches, PREG_SET_ORDER, 0 );
		$iconList = [];
		
		foreach ( $matches as $match ) {
			$new_icons[$match[1] ] = str_replace('icon-', '', $match[1]);
			$iconList[] = str_replace('icon-', '', $match[1]);
		}

		$icons = new \stdClass();
		$icons->icons = $iconList;
		$icon_data = json_encode($icons);
		
		$file = EXHIBZ_THEME_DIR . '/assets/js/icofont.js';
          
            global $wp_filesystem;
            require_once ( ABSPATH . '/wp-admin/includes/file.php' );
            WP_Filesystem();
            if ( $wp_filesystem->exists( $file ) ) {
                $content =  $wp_filesystem->put_contents( $file, $icon_data) ;
            } 
		
    }
    


    // registering ajax select 2 control
    public function EXHIBZ_ajax_select2( $controls_manager ) {
        require_once EXHIBZ_EDITOR_ELEMENTOR. '/controls/select2.php';
        $controls_manager->register_control( 'ajaxselect2', new \Control_Ajax_Select2() );
    }
    
    // registering image choose
    public function control_image_choose( $controls_manager ) {
        require_once EXHIBZ_EDITOR_ELEMENTOR. '/controls/choose.php';
        $controls_manager->register_control( 'imagechoose', new \Control_Image_Choose() );
    }

    public function EXHIBZ_shortcode_elements($widgets_manager){

        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/call-to-action.php';
        $widgets_manager->register_widget_type(new Elementor\EXHIBZ_Call_To_Action_Widget());

        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/title.php';
        $widgets_manager->register_widget_type(new Elementor\Exhibz_Title_Widget());

        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/feature.php';
        $widgets_manager->register_widget_type(new Elementor\Exhibz_Feature_Widget());

        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/speaker.php';
        $widgets_manager->register_widget_type(new Elementor\Exhibz_Speaker_Widget());

        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/speaker-archive.php';
        $widgets_manager->register_widget_type(new Elementor\Exhibz_Speaker_Archive_Widget());

        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/schedule.php';
        $widgets_manager->register_widget_type(new Elementor\Exhibz_Schedule_Widget());

        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/countdown.php';
        $widgets_manager->register_widget_type(new Elementor\Exhibz_Countdown_Widget());

        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/pricing.php';
        $widgets_manager->register_widget_type(new Elementor\Exhibz_Pricing_Widget());

        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/latestnew.php';
        $widgets_manager->register_widget_type(new Elementor\Exhibz_Latestnews_Widget());

        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/owlslider.php';
        $widgets_manager->register_widget_type(new Elementor\Exhibz_OwlSlider_Widget());

        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/date.php';
        $widgets_manager->register_widget_type(new Elementor\Exhibz_date_Widget());

        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/topics.php';
        $widgets_manager->register_widget_type(new Elementor\Exhibz_Topics_Widget());

        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/gallery-slider.php';
        $widgets_manager->register_widget_type(new Elementor\Exhibz_Gallery_Slider_Widget());

        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/video-btn.php';
        $widgets_manager->register_widget_type(new Elementor\Exhibz_Video_Btn_Widget());

        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/speaker-slider.php';
        $widgets_manager->register_widget_type(new Elementor\Exhibz_Speaker_Slider_Widget());
        
        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/meetup.php';
        $widgets_manager->register_widget_type(new Elementor\Exhibz_Meetup_Widget());
        
    
    }
    
	public static function EXHIBZ_get_instance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new EXHIBZ_Shortcode();
        }
        return self::$_instance;
    }

}
$EXHIBZ_Shortcode = EXHIBZ_Shortcode::EXHIBZ_get_instance();

endif;