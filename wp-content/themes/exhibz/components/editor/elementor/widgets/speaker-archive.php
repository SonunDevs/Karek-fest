<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Exhibz_Speaker_Archive_Widget extends Widget_Base {


    public $base;

    public function get_name() {
        return 'exhibz-speaker-archive';
    }

    public function get_title() {
        return esc_html__( 'Speakers Archive', 'exhibz' );
    }

    public function get_icon() { 
        return 'eicon-person';
    }

    public function get_categories() {
        return [ 'exhibz-elements' ];
    }

    protected function _register_controls() {
		$this->start_controls_section(
			'section_tab', [
				'label' => esc_html__( 'Speakers Archive', 'exhibz' ),
			]
        );
        
        $this->add_control(
            'speaker_count',
                [
                    'label'         => esc_html__( 'Speaker count', 'exhibz' ),
                    'type'          => Controls_Manager::NUMBER,
                    'default'       => '4',

                ]
           );
        $this->add_control(
            'post_title_crop',
            [
              'label'         => esc_html__( 'Title limit', 'exhibz' ),
              'type'          => Controls_Manager::NUMBER,
              'default'       => '3',
              
            ]
          ); 
        $this->add_control(
			'speaker_col',
			[
				'label'   => esc_html__( 'Speaker column', 'exhibz' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'3'  => esc_html__( '4 Column ', 'exhibz' ),
					'4'  => esc_html__( '3 Column', 'exhibz' ),
					'6'  => esc_html__( '2 Column', 'exhibz' ),
			
				],
			]
        );

        $this->add_control(
            'post_order',
            [
                'label'     =>esc_html__( 'Speaker order', 'exhibz' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'DESC',
                'options'   => [
                        'DESC'      =>esc_html__( 'Descending', 'exhibz' ),
                        'ASC'       =>esc_html__( 'Ascending', 'exhibz' ),
                    ],
            ]
        );
        
        $this->add_control(
			'speaker_category',
			[
				'label' => __( 'Speakers category', 'exhibz' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $this->speaker_category()
				
			]
		);
        
        $this->add_control('text_color', 
            [
            'label'		 => esc_html__( 'Name color', 'exhibz' ),
            'type'		 => Controls_Manager::COLOR,
            'selectors'	 => [
                '{{WRAPPER}} .ts-speaker-archive-widget .ts-single-speaker .ts-title.ts-speaker-title a' => 'color: {{VALUE}};',
                
            ],
         ]
        );

        $this->add_control('text_hover_color', 
            [
            'label'		 => esc_html__( 'Name hover color', 'exhibz' ),
            'type'		 => Controls_Manager::COLOR,
            'selectors'	 => [
                '{{WRAPPER}} .ts-speaker-archive-widget .ts-single-speaker:hover .ts-title.ts-speaker-title a' => 'color: {{VALUE}};',
                
            ],
        ]
        );
      
      $this->add_group_control(Group_Control_Typography::get_type(),
        [
            'name'		 => 'title_typography',
            'label'		 => esc_html__( 'Name Typography', 'exhibz' ),
            'selector'	 => '{{WRAPPER}} .ts-speaker-archive-widget .ts-single-speaker .ts-title.ts-speaker-title',
            ]
        );
        $this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title margin', 'exhibz' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ts-speaker-archive-widget .ts-single-speaker .ts-title.ts-speaker-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_control('designations_color', 
            [
            'label'		 => esc_html__( 'Designation color', 'exhibz' ),
            'type'		 => Controls_Manager::COLOR,
            'selectors'	 => [
                '{{WRAPPER}} .ts-speaker-archive-widget .ts-single-speaker .speaker-designation' => 'color: {{VALUE}};',
                
            ],
          ]
        );
      $this->add_group_control(Group_Control_Typography::get_type(),
        [
            'name'		 => 'designation_typography',
            'label'		 => esc_html__( 'Designation Typography', 'exhibz' ),
            'selector'	 => '{{WRAPPER}} .ts-speaker-archive-widget .ts-single-speaker .speaker-designation',
            ]
        );
        
        $this->add_responsive_control(
			'speaker_padding',
			[
				'label' => esc_html__( 'Padding', 'exhibz' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ts-speaker-archive-widget .ts-single-speaker .speaker-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        
        $this->add_responsive_control(
			'block_margin',
			[
				'label' => esc_html__( 'Column margin', 'exhibz' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ts-speaker-archive-widget .ts-single-speaker' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
                    '{{WRAPPER}} .ts-speaker-archive-widget .ts-single-speaker' => 'text-align: {{VALUE}};',
				],
			]
        );//Responsive control end


   
      $this->add_control('box_bg_color', 
            [
                'label'		 => esc_html__( 'Box bacgournd color', 'exhibz' ),
                'type'		 => Controls_Manager::COLOR,
            'selectors'	 => [
                '{{WRAPPER}} .ts-single-speaker .speaker-content' => 'background-color: {{VALUE}};',
                
            ],
        ]
    );



        $this->end_controls_section();
        
    }    
    protected function render() {
     
        $settings   = $this->get_settings();
        $speaker_count      = $settings["speaker_count"];
        $args = array(
            'posts_per_page'      => $speaker_count,
            'orderby'          => 'post_date',
            'order' => $settings['post_order'],
            'post_type'        => 'ts-speaker',
            'post_status'      => 'publish',
            'suppress_filters' => false,
        );   

        if(is_array($settings['speaker_category']) && count( $settings['speaker_category'] ) ) {
            $args['tax_query'] = array(
            array(
                'taxonomy' => 'ts-speaker_cat',
                'terms'    => $settings['speaker_category'],
                'field' => 'id',
                'include_children' => true,
                'operator' => 'IN'
                    ),
                );
        };


        $speaker_col = $settings['speaker_col'];
        $speakers_query = new \WP_Query( $args );
     
        echo exhibz_kses("<div class='row ts-speaker-archive-widget'>");  
     
        while ( $speakers_query->have_posts() ) {
            $speakers_query->the_post();
            $exhibs_designation = exhibz_meta_option(get_the_id(),'exhibs_designation'); 
            $exhibs_photo       = exhibz_meta_option(get_the_id(),'exhibs_photo'); 
           
        ?>
            <div class="ts-single-speaker col-md-<?php echo esc_attr($speaker_col); ?>">
               <div class="speaker-content">
                    <div class="speaker-exhibs_photo">
                      <a href="<?php echo esc_url(get_the_permalink()); ?>">  <img src="<?php echo isset($exhibs_photo['url'])? $exhibs_photo['url']:''; ?> " /> </a>
                    </div>
                    <h2 class="ts-title ts-speaker-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"> <?php echo esc_html(get_the_title()); ?></a> </h2>
                    <div class="speaker-designation">
                        <?php echo esc_html($exhibs_designation); ?>
                    </div>
                </div>
            </div>
        <?php
        }
        echo exhibz_kses("</div>");  

    }

    protected function speaker_category(){
       
        $speaker_category = [];
        $terms = get_terms( array(
            'taxonomy' => 'ts-speaker_cat',
            'hide_empty' => false,
        ) );

        foreach($terms as $speakers){
            $speaker_category[$speakers->term_id] = $speakers->name;
        }
        return $speaker_category;
    }



}