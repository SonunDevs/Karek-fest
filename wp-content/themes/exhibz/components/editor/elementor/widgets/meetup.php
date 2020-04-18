<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;


class Exhibz_Meetup_Widget extends Widget_Base {


    public $base;

    public function get_name() {
        return 'exhibz-meetup';
    }

    public function get_title() {
        return esc_html__( 'Meetup', 'exhibz' );
    }

    public function get_icon() { 
        return 'eicon-info-box';
    }

    public function get_categories() {
        return [ 'exhibz-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Exhibz Meetup', 'exhibz'),
            ]
		);
        $this->add_control(
			'meetup_title', [
				'label'			=> esc_html__( 'Meetup Title', 'exhibz' ),
				'type'			=> Controls_Manager::TEXT,
				'label_block'	=> true,
				'placeholder'	=> esc_html__( 'Day Long Meetup', 'exhibz' ),
				'default'	    => esc_html__( 'Day Long Meetup', 'exhibz' ),
			]
		);

        $this->add_control(
			'meetup_desc', [
                'label'			=> esc_html__( 'Meetup Content', 'exhibz' ),
                'type'			=> Controls_Manager::TEXTAREA,
                'label_block'	=> true,
                'placeholder'	=> esc_html__( 'There such a thing as too much infornation especially for you', 'exhibz' ),
                'default'       => esc_html__( 'There such a thing as too much infornation especially for you', 'exhibz' ),
            ]
		);
        
        $this->add_control(
			'meetup_image',
			[
                'label'	=> esc_html__( 'Meetup Image', 'exhibz' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
        
		$this->add_responsive_control(
			'overlay_box_position',
			[
				'label'	=> esc_html__( 'Overlay Box Position', 'exhibz' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'left'  => esc_html__( 'Left', 'exhibz' ),
					'right'  => esc_html__( 'Right', 'exhibz' ),
				],
			]
		);
		
		$this->add_responsive_control('meetup_text_align', 
          [
				'label'			 => esc_html__( 'Text Alignment', 'exhibz' ),
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
                    '{{WRAPPER}} .meetup-box' => 'text-align: {{VALUE}};',
				],
			]
        );//Responsive control end
        $this->end_controls_section();

		
       
		$this->start_controls_section(
			'section_sub_title_style', [
				'label'	 => esc_html__( 'Title', 'exhibz' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'meetup_title_color', [
				'label'		 => esc_html__( 'Title color', 'exhibz' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .meetup-box .ts-title' => 'color: {{VALUE}};',
				],
			]
		);

        
        $this->add_group_control(Group_Control_Typography::get_type(),
         [
			'name'		 => 'meetup_title_typography',
			'selector'	 => '{{WRAPPER}} .meetup-box .ts-title',
			]
        );
        
        $this->add_responsive_control(
            'meetup_title_margin',
                [
                    'label' =>esc_html__( 'Title Margin', 'exhibz' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .meetup-box .ts-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();
        
        //Content Style Section
      $this->start_controls_section('section_content_style',
         [
				'label'	 => esc_html__( 'Content', 'exhibz' ),
				'tab'	    => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'meetup_content_color', [
				'label'		 => esc_html__( 'Content color', 'exhibz' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .meetup-box .ts-title' => 'color: {{VALUE}};',
				],
			]
        );

        $this->add_group_control(Group_Control_Typography::get_type(),
         [
			 'name'		 => 'meetup_content_typography',
			 'selector'	 => '{{WRAPPER}} .meetup-box p',
			]
        );
        $this->add_responsive_control(
            'meetup_content_margin',
                [
                    'label' =>esc_html__( 'Content Margin', 'exhibz' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .meetup-box p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

		$this->end_controls_section();

		// Box Padding
      $this->start_controls_section('box_padding',
         [
				'label'	 => esc_html__( 'Box Style', 'exhibz' ),
				'tab'	   => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'meetup_box_bg', [
				'label'		 => esc_html__( 'Meetup Box BG', 'exhibz' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .meetup-box' => 'background: {{VALUE}};',
				],
			]
        );

        $this->add_responsive_control(
            'meetup_box_padding',
                [
                    'label' =>esc_html__( 'Box Padding', 'exhibz' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .meetup-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();
        
	  // Box Padding
      $this->start_controls_section('indecator_style',
         [
				'label'	 => esc_html__( 'Indecator Style', 'exhibz' ),
				'tab'	   => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'indecator_color', [
				'label'		 => esc_html__( 'Indecator color', 'exhibz' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .meetup-box::after' => 'background: {{VALUE}};',
				],
			]
        );

        $this->end_controls_section();
        
        //image width 
        $this->start_controls_section('meetup_image_size',
        [
                'label'	 => esc_html__( 'Image Style', 'exhibz' ),
                'tab'	   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'meetup_img_shadow',
                'label' => esc_html__( 'Image Shadow', 'exhibz' ),
                'selector' => '{{WRAPPER}} .meetup-wrap .meetup-image img',
            ]
        ); 

        $this->add_responsive_control(
			'meetup_img_width',
			[
				'label' => esc_html__( 'Meetup Image Width', 'exhibz' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 350,
				],
				'selectors' => [
					'{{WRAPPER}} .meetup-wrap .meetup-image img ' => 'width: {{SIZE}}{{UNIT}};',
					// '{{WRAPPER}} .meetup-wrap .meetup-image ' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'meetup_img_height',
			[
				'label' => esc_html__( 'Meetup Image Height', 'exhibz' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 350,
				],
				'selectors' => [
					'{{WRAPPER}} .meetup-wrap .meetup-image img ' => 'height: {{SIZE}}{{UNIT}};',
					// '{{WRAPPER}} .meetup-wrap .meetup-image ' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'meetup_box_position',
			[
				'label' => esc_html__( 'Meetup Box Position', 'exhibz' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 350,
				],
				'selectors' => [
					'{{WRAPPER}} .meetup-wrap .meetup-image .meetup-box ' => 'left: {{SIZE}}{{UNIT}};',
					// '{{WRAPPER}} .meetup-wrap .meetup-image ' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();


    } //Register control end

    protected function render( ) { 
		$settings  			= $this->get_settings();
		$title     			= $settings["meetup_title"];
        $image        		= $settings["meetup_image"]["url"];
		$desc      			= $settings["meetup_desc"];
        $overlay_position 	= $settings["overlay_box_position"];
    ?>
 
   <div class="meetup-wrap">
        <div class="meetup-image">
            <img src="<?php echo esc_attr($image); ?>" alt="">
            <div class="meetup-box <?php echo esc_attr($overlay_position); ?>">
                <h4 class="ts-title"><?php echo esc_html($title); ?></h4>
                <p>
                    <?php echo exhibz_kses($desc); ?>
                </p>
            </div><!-- single intro text end-->
        </div>
   </div>
    
    <?php  
    }
    protected function _content_template() { }
}