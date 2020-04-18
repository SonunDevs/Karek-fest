<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;


class Exhibz_Topics_Widget extends Widget_Base {


    public $base;

    public function get_name() {
        return 'exhibz-topics';
    }

    public function get_title() {
        return esc_html__( 'Topics', 'exhibz' );
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
                'label' => esc_html__('Exhibz Topics Item', 'exhibz'),
            ]
		);
        $this->add_control(
			'title', [
				'label'			=> esc_html__( 'Title', 'exhibz' ),
				'type'			=> Controls_Manager::TEXT,
				'label_block'	=> true,
				'placeholder'	=> esc_html__( 'Education Theory', 'exhibz' ),
				'default'	    => esc_html__( 'Education Theory', 'exhibz' ),
			]
		);

        $this->add_control(
			'desc', [
			'label'			=> esc_html__( 'Content', 'exhibz' ),
			'type'			=> Controls_Manager::TEXTAREA,
			'label_block'	=> true,
			'placeholder'	=> esc_html__( 'Exclusively for Principals, these sessions look at the chall', 'exhibz' ),
            'default'       => esc_html__( 'Exclusively for Principals, these sessions look at the chall', 'exhibz' ),
            ]
		);
		
		$this->add_control(
			'icon',
			[
				'label' =>esc_html__( 'Icon', 'exhibz' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => 'icon icon-plus',
			]
        );
        
        $this->add_control(
			'topics_link',
			[
				'label' =>esc_html__( 'Topic Link', 'exhibz' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'Press link', 'exhibz' ),		
			]
		);

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'topic_bg',
                'label' =>esc_html__( 'Background', 'exhibz' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .single-topics::after',
			]
		);
        
        $this->add_responsive_control('title_align', 
          [
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
                    '{{WRAPPER}} ..single-topics' => 'text-align: {{VALUE}};',
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
			'title_color', [
				'label'		 => esc_html__( 'Title color', 'exhibz' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .single-topics .ts-title' => 'color: {{VALUE}};',
				],
			]
		);

        
        $this->add_group_control(Group_Control_Typography::get_type(),
         [
			'name'		 => 'title_typography',
			'selector'	 => '{{WRAPPER}} .single-topics .ts-title',
			]
        );
        
        $this->add_responsive_control(
            'title_margin',
                [
                    'label' =>esc_html__( 'Title Margin', 'exhibz' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .single-topics .ts-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'feature_content_color', [
				'label'		 => esc_html__( 'Content color', 'exhibz' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .single-topics .ts-title' => 'color: {{VALUE}};',
				],
			]
        );

        $this->add_group_control(Group_Control_Typography::get_type(),
         [
			 'name'		 => 'feature_content_typography',
			 'selector'	 => '{{WRAPPER}} .single-topics p',
			]
        );
        $this->add_responsive_control(
            'feature_content_margin',
                [
                    'label' =>esc_html__( 'Content Margin', 'exhibz' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .single-topics p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

		$this->end_controls_section();

		//Icon Style Section
      $this->start_controls_section('section_icon_style',
         [
				'label'	 => esc_html__( 'Icon', 'exhibz' ),
				'tab'	   => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control('icon_color', 
          [
				'label'		 => esc_html__( 'Icon color', 'exhibz' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .single-topics  i' => 'color: {{VALUE}};',
				],
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'icon_typography',
			'selector'	 => '{{WRAPPER}} .single-topics  i',
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

        $this->add_responsive_control(
            'topics_box_padding',
                [
                    'label' =>esc_html__( 'Box Padding', 'exhibz' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .single-topics' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__( 'Box Shadow', 'exhibz' ),
                'selector' => '{{WRAPPER}} .single-topics',
            ]
        ); 

		$this->end_controls_section();


    } //Register control end

    protected function render( ) { 
        $settings  = $this->get_settings();
     	$icon      = $settings["icon"];
		$title     = $settings["title"];
        $desc      = $settings["desc"];
        $link      = $settings['topics_link']['url'];
    ?>
 
    <div class="single-topics">
        <h3 class="ts-title"><?php echo esc_html($title); ?></h3>
        <p>
            <?php echo exhibz_kses($desc); ?>
        </p>
        <a href="<?php echo esc_url($link); ?>" target="_blank" class="topics-link">
            <i class="<?php echo esc_attr($icon); ?>"></i>
        </a>
    </div><!-- single intro text end-->
    
    <?php  
    }
    protected function _content_template() { }
}