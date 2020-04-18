<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;


class Exhibz_Schedule_Widget extends Widget_Base {


    public $base;

    public function get_name() {
        return 'exhibz-schedule';
    }

    public function get_title() {
        return esc_html__( 'Schedules', 'exhibz' );
    }

    public function get_icon() { 
        return 'eicon-table';
    }

    public function get_categories() {
        return [ 'exhibz-elements' ];
    }
     
    protected function _register_controls() {
		$this->start_controls_section(
			'section_tab', [
				'label' =>esc_html__( 'Exhibz Schedule', 'exhibz' ),
			]
        );
        
        $this->add_control(
			'schedule_style',
			[
				'label'      => esc_html__( 'Schedule Display Style', 'exhibz' ),
				'type'     => Controls_Manager::SELECT,
				'default'  => 'schedule-1',
				'options' => [
				    'schedule-1'  => esc_html__( 'Tab Circle', 'exhibz' ),
				    'schedule-1-multiple'  => esc_html__( 'Tab Circle Multi Speaker', 'exhibz' ),
                    'schedule-2' => esc_html__( 'Tab List', 'exhibz' ),
                    'schedule-3' => esc_html__( 'Style List', 'exhibz' ),
                    'schedule-5' => esc_html__( 'Style List Multi Speaker', 'exhibz' ),
                    'schedule-4' => esc_html__( 'Style tab List', 'exhibz' ),
				
				],
			]
      );
      
      $this->add_control(
			'schedule_post_id',
			[
				'label'   => esc_html__( 'Schedule Category', 'exhibz' ),
				'type'    => Controls_Manager::SELECT,
		        'options' => $this->schedule_title(),
                'condition' => [ 'schedule_style' => ['schedule-3','schedule-5']]
			]
        ); 
        
        $this->add_control(
			'schedule_day_limit',
			[
				'label' => esc_html__( 'Number Of schedule', 'exhibz' ),
				'type'  => Controls_Manager::NUMBER,
				'min'   => 1,
				'max'   => 100,
				'step' => 1,
            'default' => 5,
            'condition' => [
                    'schedule_style' => ['schedule-1','schedule-2','schedule-4','schedule-1-multiple'],
                    
                ]
			]
        );

        $this->add_control(
			'schedule_limit',
			[
				'label' => esc_html__( 'Number Of schedule item', 'exhibz' ),
				'type'  => Controls_Manager::NUMBER,
				'min'   => 1,
				'max'   => 100,
				'step' => 1,
            'default' => 4,
         
			]
        );

        
        $this->add_control(
			'schedule_order',
			[
				'label' => esc_html__( 'Schedule Order', 'exhibz' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ASC',
				'options' => [
					'ASC'  => esc_html__( 'ASC', 'exhibz' ),
                    'DESC'  => esc_html__( 'DESC', 'exhibz' ),
				
                ],
                'condition' => [
                    'schedule_style' => ['schedule-1','schedule-2','schedule-4','schedule-1-multiple'],
                    
                ]
			]
		);
        $this->add_control(
			'schedule_top_title',
			[
				'label' => esc_html__( 'Schedule Top Title', 'exhibz' ),
				'type' => Controls_Manager::TEXT,
                'condition' => [
                    'schedule_style' => ['schedule-1','schedule-1-multiple'],
                    
                ]
			]
        );
        
        $this->add_control(
			'schedule_title',
			[
				'label' => esc_html__( 'Schedule Title', 'exhibz' ),
				'type' => Controls_Manager::TEXT,
                'condition' => [
                    'schedule_style' => ['schedule-1','schedule-1-multiple'],
                    
                ]
			]
        );

        $this->add_control(
			'scheule_show_title',
			[
				'label' => __( 'Hide Title border', 'exhibz' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'exhibz' ),
				'label_off' => __( 'Show', 'exhibz' ),
				'return_value' => 'yes',
            'default' => 'yes',
            'condition' => [
              'schedule_style' => ['schedule-1','schedule-1-multiple'],
               
            ],
            'selectors' => [
               '{{WRAPPER}} .ts-schedule .ts-schedule-content .column-title:after' => 'width: 0;',
           
          ],
           
			]
		);
        
        $this->add_control(
			'schedule_desc',
			[
				'label' => esc_html__( 'Schedule Description', 'exhibz' ),
				'type' => Controls_Manager::TEXTAREA,
                'condition' => [
                    'schedule_style' => ['schedule-1','schedule-1-multiple'],
                    
                ]
			]
        );
        
        $this->add_control(
			'header_show',
			[
				'label' => esc_html__( 'Header Display', 'exhibz' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'exhibz' ),
				'label_off' => esc_html__( 'No', 'exhibz' ),
				'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'schedule_style' => ['schedule-3','schedule-5'],
                    
                ]
			]
		); 
        $this->add_responsive_control(
			'title_align', [
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
				'default'		 => 'left',
                'selectors' => [
                    '{{WRAPPER}} .section-title' => 'text-align: {{VALUE}};',
               
                
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
        'title_color',
        [
            'label' => esc_html__('Title color', 'exhibz'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                 '{{WRAPPER}} .ts-schedule .ts-schedule-content .column-title' => 'color: {{VALUE}};',
             
            ],
        ]
       );

       $this->add_control(
         'schedule_text_color',
         [
             'label' => esc_html__('Text color', 'exhibz'),
             'type' => Controls_Manager::COLOR,
             'default' => '',
             'selectors' => [
                  '{{WRAPPER}} .schedule-listing .schedule-slot-time' => 'color: {{VALUE}};',
              
             ],
         ]
        );

     

        $this->add_control(
         'schedule_background_color',
         [
             'label' => esc_html__('Tab Content bg color', 'exhibz'),
             'type' => Controls_Manager::COLOR,
             'default' => '',
             'selectors' => [
                  '{{WRAPPER}} .schedule-listing .schedule-slot-time' => 'background: {{VALUE}};',
              
             ],
         ]
        );

        $this->add_control(
         'schedule_menu_color',
         [
             'label' => esc_html__('Menu Active color', 'exhibz'),
             'type' => Controls_Manager::COLOR,
             'default' => '',
             'condition' => [
               'schedule_style' => ['schedule-2','schedule-4'],
               
             ],
             'selectors' => [
                  '{{WRAPPER}} .ts-schedule-nav ul li a.active' => 'color: {{VALUE}};',
                  '{{WRAPPER}} .ts-schedule-nav ul li a.active h3' => 'color: {{VALUE}};',
              
             ],
         ]
        );

        $this->add_control(
         'schedule_menu_bg_color',
         [
             'label' => esc_html__('Menu Active bg color ', 'exhibz'),
             'type' => Controls_Manager::COLOR,
             'default' => '',
             'condition' => [
               'schedule_style' => ['schedule-2','schedule-4'],
               
             ],
             'selectors' => [
                  '{{WRAPPER}} .ts-schedule-nav ul li a.active' => 'background: {{VALUE}};',
                  '{{WRAPPER}} .ts-schedule-nav ul li a:before' => 'border-right-color: {{VALUE}};',
              
             ],
         ]
        );


      $this->end_controls_section();

        
        
    } 

    protected function render() {
     
   

        $settings           = $this->get_settings();

        $schedule_top_title = $settings["schedule_top_title"];
        $schedule_title     = $settings["schedule_title"];
        $schedule_desc      = $settings["schedule_desc"];
        $schedule_day_limit = $settings["schedule_day_limit"];
        $schedule_order     = $settings["schedule_order"];
        $style              = $settings["schedule_style"];
        $schedule_post_id   = $settings["schedule_post_id"];
        $header_show        = $settings["header_show"];
        $schedule_limit     = $settings["schedule_limit"];   
            
                  
        require "style/schedule/{$style}.php";
 

    }

    public function schedule_title(){
        $schedule_list = [];
        $args = array(
            'post_type' 			=> 'ts-schedule',
            
         
         );
         $i=1;
         $posts = get_posts($args);
         foreach ($posts as $postdata) {
            setup_postdata( $postdata );
            $schedule_list[$postdata->ID] = [$postdata->post_title];
         }
      
        return $schedule_list;
     }
 

}