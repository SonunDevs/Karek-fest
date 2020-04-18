<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Exhibz_OwlSlider_Widget extends Widget_Base {

    public function get_name() {
        return 'exhibz-slider';
    }

    public function get_title() {
        return esc_html__( 'Exhibz Sliders', 'exhibz' );
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return ['exhibz-elements'];
    }

    protected function _register_controls() {
        
        $this->start_controls_section(
            'section_tab_style',
            [
                'label' => esc_html__('Exhibz Slider', 'exhibz'),
            ]
         );

         
         $this->add_control(
            'exhibz_slider_items',
            [
                'label' => esc_html__('exhibz Slider', 'exhibz'),
                'type' => Controls_Manager::REPEATER,
                'separator' => 'before',
                'default' => [
                    [ 'name' => esc_html__(' Carousel #1', 'exhibz') ],
         
                ],
                'fields' => [
             
                    [
                        'name'         => 'exhibz_show_title_shap',
                        'label'         => esc_html__( 'Show Title Shape', 'exhibz' ),
                        'type'         => \Elementor\Controls_Manager::SWITCHER,
                        'label_on'     => esc_html__( 'Show', 'exhibz' ),
                        'label_off'    => esc_html__( 'Hide', 'exhibz' ),
                        'return_value' => 'yes',
                        'default'      => 'yes',
                    ],
                    [
                        'name' => 'exhibz_slider_title_top',
                        'label' => esc_html__('Slider Top title', 'exhibz'),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__('5 to 7 June 2019, Waterfront Hotel, London', 'exhibz'),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'exhibz_slider_title',
                        'label' => esc_html__('Slider Title', 'exhibz'),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__('digital thinkers Meet', 'exhibz'),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'exhibz_slider_description',
                        'label' => esc_html__('Slider Description ', 'exhibz'),
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => esc_html__('How you transform your business as technology, consumer, habits industry dynamis change? Find out from those leading the charge.', 'exhibz'),
                        'label_block' => true,
                      
                    ],
                    [
                        'name' => 'exhibz_slider_bg_image',
                        'label' => esc_html__('Background Image', 'exhibz'),
                        'type' => Controls_Manager::MEDIA,
                        'label_block' => true,
                        'separator'=>'after',
                    ],
                    [
                        'name' => 'exhibz_button_one_text',
                        'label' => esc_html__('Button #1 Text', 'exhibz'),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__('Button one', 'exhibz'),
                        'label_block' => true,
                    ],
                    [
                    'name' => 'exhibz_button_one',
                    'label' => esc_html__( 'Button #1', 'exhibz' ),
                    'type' => \Elementor\Controls_Manager::URL,
                    'label_block' => true,
                    'separator'=>'after', 
                    'separator'=>'before',                      
                     ],

                    [
                        'name' => 'exhibz_button_two_text',
                        'label' => esc_html__('Button #2 Text', 'exhibz'),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__('Button Two', 'exhibz'),
                        'label_block' => true,
                    ],
                    [
                    'name' => 'exhibz_button_two',
                    'label' => esc_html__( 'Button #2', 'exhibz' ),
                    'type' => \Elementor\Controls_Manager::URL,
                    'label_block' => true,
                    'separator'=>'after', 
                    'separator'=>'before',                      
                     ],
                    //

                  
                 
                ],
            ]
        );
       
        $this->end_controls_section();

        //style
        $this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Style Section', 'exhibz' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		); 
      $this->add_control(
         'team_text_color',
         [
             'label' => esc_html__('Title color', 'exhibz'),
             'type' => Controls_Manager::COLOR,
             'default' => '',
             'selectors' => [
                  '{{WRAPPER}} .banner-content-wrap .banner-title' => 'color: {{VALUE}};',
              
             ],
         ]
        );

      
        $this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'exhibz_testimonial_typography',
			'selectors'	 => [
                '{{WRAPPER}} .banner-content-wrap',
                          
                ]
			]
		);
      $this->end_controls_section();  

    }

    protected function render( ) {

        $settings      = $this->get_settings();
        $exhibz_slider = $settings['exhibz_slider_items'];
    ?>
        
             <!-- banner start-->
      <section class="main-slider owl-carousel">
         <?php foreach ($exhibz_slider as $key => $value): ?>
               
      <div class="banner-item overlay" style="background-image:url(<?php echo is_array($value["exhibz_slider_bg_image"])?$value["exhibz_slider_bg_image"]["url"]:''; ?>)">
            <div class="container">
               <div class="row">
                  <div class="col-lg-11 mx-auto">
                     <div class="banner-content-wrap text-center">
                        <?php if($value["exhibz_show_title_shap"]=="yes"): ?>
                        <img class="title-shap-img" src="<?php echo esc_url( EXHIBZ_IMG.'/shap/title-white.png' ); ?> " alt="<?php esc_attr_e('shape','exhibz'); ?> ">
                      <?php endif; ?>
                        <p class="banner-info"><?php echo esc_html($value["exhibz_slider_title_top"]); ?></p>
                        <h1 class="banner-title"><?php echo esc_html($value["exhibz_slider_title"]); ?></h1>

                        <p class="banner-desc">
                         <?php echo wp_kses_post($value["exhibz_slider_description"]); ?>
                        </p>
                        <!-- Countdown end -->
                        <div class="banner-btn">
                         
                           <?php if($value["exhibz_button_one_text"]!=''): ?> 
                           <a href="<?php echo esc_url($value["exhibz_button_one"]["url"]); ?>" class="btn"><?php echo esc_html($value["exhibz_button_one_text"]); ?></a>
                         <?php endif; ?>
                         <?php if($value["exhibz_button_two_text"]!=''): ?> 
                           <a href="<?php echo esc_url($value["exhibz_button_two"]["url"]); ?>" class="btn fill"><?php echo esc_html($value["exhibz_button_two_text"]); ?></a>
                          <?php endif; ?>
                        </div>

                     </div>
                     <!-- Banner content wrap end -->
                  </div><!-- col end-->

               </div><!-- row end-->
            </div>
            <!-- Container end -->
         </div><!-- banner item end-->
         <?php endforeach; ?>
      </section>
      <!-- banner end-->
     
        <?php
    }

    protected function _content_template() { }
}