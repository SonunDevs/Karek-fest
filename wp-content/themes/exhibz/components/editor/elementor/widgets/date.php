<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;


class Exhibz_date_Widget extends Widget_Base {


  public $base;

    public function get_name() {
        return 'exhibz-date';
    }

    public function get_title() {

        return esc_html__( 'date', 'exhibz' );

    }

    public function get_icon() { 
        return 'eicon-date';
    }

    public function get_categories() {
        return [ 'exhibz-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('date settings', 'exhibz'),
            ]
        );
        $this->add_control(
            'event_day',
            [
                'label' => esc_html__('Event Day', 'exhibz'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '20',
            ]
        );
        $this->add_control(
            'event_month',
            [
                'label' => esc_html__('Event Month', 'exhibz'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Jun',
            ]
        );
        $this->add_control(
            'event_year',
            [
                'label' => esc_html__('Event Year', 'exhibz'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '2020',
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
					'{{WRAPPER}} .date-item span' => 'color: {{VALUE}};',
				],
         ]
     );
     $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
      'name'		 => 'date_typography',
      'label' => esc_html__('Event typgraphy', 'exhibz'),
      'selector'	 => '{{WRAPPER}} .date-item span',
      ]
   );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
         'name'		 => 'day_typography',
         'label' => esc_html__('Event day typgraphy', 'exhibz'),
         'selector'	 => '{{WRAPPER}} .date-item span.event-day',
         ]
      );
       $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __( 'Border', 'exhibz' ),
				'selector' => '{{WRAPPER}} .date-item',
			]
      );
      $this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'exhibz' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .date-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
    }

    protected function render( ) { 
        $settings = $this->get_settings();
        $event_day = $settings['event_day'];
        $event_month = $settings['event_month'];
        $event_year = $settings['event_year'];

    ?>
      <div class="date-item">
         <span class="event-day"><?php echo esc_attr($event_day); ?></span>
         <span class="event-month"><?php echo esc_attr($event_month); ?></span>
         <span class="event-year"><?php echo esc_attr($event_year); ?></span>
      </div>
 
    <?php  
    }

    protected function _content_template() {
  
	}
}