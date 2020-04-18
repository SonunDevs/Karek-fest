<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Exhibz_Gallery_Slider_Widget extends Widget_Base {

    public function get_name() {
        return 'exhibz-gallery-slider';
    }

    public function get_title() {
        return esc_html__( 'Exhibz Gallery Sliders', 'exhibz' );
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
                'label' => esc_html__('Exhibz gallery Slider', 'exhibz'),
            ]
         );

         
         $this->add_control(
            'exhibz_slider_items',
            [
                'label' => esc_html__('exhibz gallery Slider', 'exhibz'),
                'type' => Controls_Manager::REPEATER,
                'separator' => 'before',
                'default' => [
                    [ 'name' => esc_html__(' Carousel #1', 'exhibz') ],
         
                ],
                'fields' => [
                    [
                        'name' => 'exhibz_slider_bg_image',
                        'label' => esc_html__('Background Image', 'exhibz'),
                        'type' => Controls_Manager::MEDIA,
                        'label_block' => true,
                        'separator'=>'after',
                    ],
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
 
      $this->end_controls_section();  

    }

    protected function render( ) {

        $settings      = $this->get_settings();
        $exhibz_slider = $settings['exhibz_slider_items'];
    ?>
        
             <!-- banner start-->
      <section class="ts-gallery-slider owl-carousel">
         <?php foreach ($exhibz_slider as $key => $value): ?>
               <?php if(isset($value["exhibz_slider_bg_image"]["url"]) && $value["exhibz_slider_bg_image"]["url"] !=''): ?>
            <div class="galler-img-item">
                <a href="<?php echo esc_url( $value["exhibz_slider_bg_image"]["url"]); ?>" class="gallery-popup">
                 <img src="<?php echo esc_url( $value["exhibz_slider_bg_image"]["url"]); ?>" alt="<?php echo esc_attr('gallery', 'exhibz'); ?>">
               </a>
            </div>
         <?php endif; ?>
         <?php endforeach; ?>
      </section>
      <!-- banner end-->
     
        <?php
    }

    protected function _content_template() { }
}