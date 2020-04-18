<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;


class Exhibz_Video_Btn_Widget extends Widget_Base {


  public $base;

    public function get_name() {
        return 'exhibz-video-btn';
    }

    public function get_title() {

        return esc_html__( 'Video Btn', 'exhibz' );

    }

    public function get_icon() { 
        return 'eicon-button';
    }

    public function get_categories() {
        return [ 'exhibz-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Video settings', 'exhibz'),
            ]
        );
        $this->add_control(
            'video_icon',
            [
                'label' => esc_html__(' Video ICON', 'exhibz'),
                'type' => \Elementor\Controls_Manager::ICON,
            ]
        );
   
        $this->add_control(
            'video_url',
            [
                'label' => esc_html__(' Video Url', 'exhibz'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );
   
        
        
        $this->end_controls_section();

        $this->start_controls_section(
         'event_date_style',
            [
               'label' => esc_html__('date Style', 'exhibz'),
               'tab'	    => Controls_Manager::TAB_STYLE,

            ]
      );
      $this->add_control(
         'event_color',
         [
             'label' => esc_html__('Event color', 'exhibz'),
             'type' => \Elementor\Controls_Manager::COLOR,
             'selectors'	 => [
					'{{WRAPPER}} .video-btn' => 'color: {{VALUE}};',
				],
         ]
     );
     $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
      'name'		 => 'date_typography',
      'label' => esc_html__('Video btn typgraphy', 'exhibz'),
      'selector'	 => '{{WRAPPER}} .video-btn',
      ]
   );

   $this->add_group_control(
      Group_Control_Border::get_type(),
      [
         'name' => 'border',
         'label' => __( 'Border', 'exhibz' ),
         'selector' => '{{WRAPPER}} .video-btn',
      ]
   );
      $this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'exhibz' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .video-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
      $this->add_control(
			'padding',
			[
				'label' => __( 'Padding', 'exhibz' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .video-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
      $this->add_responsive_control(
			'btn_align', [
				'label'			 => esc_html__( 'Alignment', 'exhibz' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [

					'left'		 => [
						'title'	 => esc_html__( 'Left', 'exhibz' ),
						'icon'	 => 'fa fa-align-left',
					],
					'center'	 => [
						'title'	 => esc_html__( 'Center', 'exhibz' ),
						'icon'	 => 'fa fa-align-center',
					],
					'right'		 => [
						'title'	 => esc_html__( 'Right', 'exhibz' ),
						'icon'	 => 'fa fa-align-right',
					],
					'justify'	 => [
						'title'	 => esc_html__( 'Justified', 'exhibz' ),
						'icon'	 => 'fa fa-align-justify',
					],
				],
				'default'		 => 'center',
                'selectors' => [
                    '{{WRAPPER}} .video-btn-area' => 'text-align: {{VALUE}};',
				],
			]
        );//Responsive control end
        $this->end_controls_section();
    }

    protected function render( ) { 
        $settings = $this->get_settings();
        $video_icon = $settings['video_icon'];
        $video_url = $settings['video_url'];
     

    ?>
      <div class="video-btn-area">
         <a href="<?php echo esc_attr($video_url); ?>" class="video-btn"><i class="<?php echo esc_attr($video_icon); ?>"></i></a>
      </div>
 
    <?php  
    }

    protected function _content_template() {
  
	}
}