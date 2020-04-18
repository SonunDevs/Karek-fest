<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;


class Exhibz_Title_Widget extends Widget_Base {


    public $base;

    public function get_name() {
        return 'exhibz-title';
    }

    public function get_title() {
        return esc_html__( 'Title', 'exhibz' );
    }

    public function get_icon() { 
        return 'eicon-type-tool';
    }

    public function get_categories() {
        return [ 'exhibz-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Title settings', 'exhibz'),
            ]
        );

        $this->add_control(
			'top_title', [
				'label'			=> esc_html__( 'Heading Top Title', 'exhibz' ),
				'type'			=> Controls_Manager::TEXT,
				'label_block'	=> true,
				'placeholder'	=> esc_html__( 'LISTEN TO THE', 'exhibz' ),
				'default'	    => esc_html__( 'LISTEN TO THE', 'exhibz' ),
			]
		);

        $this->add_control(
			'title', [
				'label'			=> esc_html__( 'Heading Title', 'exhibz' ),
				'type'			=> Controls_Manager::TEXTAREA,
				'label_block'	=> true,
				'placeholder'	=> esc_html__( 'Event Speakers', 'exhibz' ),
				'default'       => esc_html__( 'Event Speakers', 'exhibz' ),
			]
        );
		$this->add_control(
			'title_desc',
			[
				'label' => __( 'Description', 'exhibz' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'placeholder' => __( 'Type your description here', 'exhibz' ),
			]
		);

        $this->add_control(
			'show_title_shape',
			[
				'label' => __( 'Show Title Shape', 'exhibz' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'exhibz' ),
				'label_off' => __( 'Hide', 'exhibz' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		 );
        
        $this->add_control(
			'show_title_border',
			[
				'label' => __( 'Show Title border', 'exhibz' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'exhibz' ),
				'label_off' => __( 'Hide', 'exhibz' ),
				'return_value' => 'yes',
				'default' => 'no',
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
                    '{{WRAPPER}} .title-section-area' => 'text-align: {{VALUE}};',
				],
			]
        );//Responsive control end
        $this->end_controls_section();

        //Title Style Section
		$this->start_controls_section(
			'section_sub_title_style', [
				'label'	 => esc_html__( 'Sub Title', 'exhibz' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'top_title_color', [
				'label'		 => esc_html__( 'Top Title color', 'exhibz' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .section-title span' => 'color: {{VALUE}};',
				],
			]
		);

        
        $this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'top_title_typography',
			'selector'	 => '{{WRAPPER}} .section-title span',
			]
		);

        $this->end_controls_section();
        
        //Title Style Section
		$this->start_controls_section(
			'section_title_style', [
				'label'	 => esc_html__( 'Title', 'exhibz' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'title_color', [
				'label'		 => esc_html__( 'Title color', 'exhibz' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .section-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .title-section-area .title-shape svg' => 'fill: {{VALUE}};',
				],
			]
        );
     

        $this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'title_typography',
			'label'		 => esc_html__( 'Title Typography', 'exhibz' ),
			'selector'	 => '{{WRAPPER}} .section-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => __( 'Margin', 'exhibz' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'desc_color', [
				'label'		 => esc_html__( 'Description color', 'exhibz' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .title-section-area .title-desc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'desc_typography',
			'label'		 => esc_html__( 'Desc Typography', 'exhibz' ),

			'selector'	 => '{{WRAPPER}} .title-section-area .title-desc',
			]
		);

		$this->add_control(
			'shap_color', [
				'label'		 => esc_html__( 'Shap color', 'exhibz' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .title-section-area .title-shape svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .title-section-area .title-border' => 'background: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'focused_title_color', [
				'label'		 => esc_html__( 'Focused Border Color', 'exhibz' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .title-section-area .title-bar-shap::before' => 'background: {{VALUE}};',
				],
			]
        );
		$this->end_controls_section();
    } //Register control end

    protected function render( ) { 
		$settings = $this->get_settings();
		$title_desc = $settings['title_desc'];
    ?>

    <div class="title-section-area">
        <h2 class="section-title">
            <span class="sub-title"><?php echo esc_html($settings['top_title']); ?></span>
			<?php
			 $title        = str_replace(['{', '}'], ['<em class="title-bar-shap">', '</em>'], $settings['title']); 

			 echo wp_kses_post($title); 

			?>
        </h2>
		<?php if(isset($title_desc) && $title_desc !=''): ?>
			<div class="title-desc"><?php echo exhibz_kses($title_desc); ?></div>
		<?php endif; ?>
        <?php if($settings['show_title_shape']=='yes' ): ?>
            <span class="title-shape">
                  <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='71px' height='11px'> <path fill-rule='evenodd' d='M59.669,10.710 L49.164,3.306 L39.428,10.681 L29.714,3.322 L20.006,10.682 L10.295,3.322 L1.185,10.228 L-0.010,8.578 L10.295,0.765 L20.006,8.125 L29.714,0.765 L39.428,8.125 L49.122,0.781 L59.680,8.223 L69.858,1.192 L70.982,2.895 L59.669,10.710 Z'/></svg>
            </span>
        <?php endif; ?>
        <?php if($settings['show_title_border']=='yes' ): ?>
            <span class="title-border">&nbsp;</span>
        <?php endif; ?>
    </div><!-- Section title -->
    
    

    <?php  
    }
    protected function _content_template() { }
}