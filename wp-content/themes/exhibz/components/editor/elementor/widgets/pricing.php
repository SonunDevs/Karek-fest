<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;


class Exhibz_Pricing_Widget extends Widget_Base {


    public $base;

    public function get_name() {
        return 'exhibz-pricing';
    }

    public function get_title() {
        return esc_html__( 'Pricing ', 'exhibz' );
    }

    public function get_icon() { 
        return 'eicon-price-list';
    }

    public function get_categories() {
        return [ 'exhibz-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Pricing settings', 'exhibz'),
            ]
        );
        
     

        $this->add_control(
			'pricing_style',
			[
				'label' => esc_html__( 'Pricing Style', 'exhibz' ),
				'type' => Custom_Controls_Manager::IMAGECHOOSE,
				'default' => 'curly-price',
				'options' => [
                    'curly-price' => [
						'title' => esc_html__( 'Curly price', 'exhibz' ),
                        'imagelarge' => EXHIBZ_IMG. '/style/price-big-2.png',
                        'imagesmall' => EXHIBZ_IMG. '/style/price-2.png',
                        'width' => '30%',
					],
              		'icon-price' => [
						'title' => esc_html__( 'Icon price', 'exhibz' ),
                        'imagelarge' => EXHIBZ_IMG. '/style/price-big-1.png',
                        'imagesmall' => EXHIBZ_IMG. '/style/price-1.png',
                        'width' => '30%',
					],
			
				],
			]
        );

        $this->add_control(
			'price_disable',
			[
				'label' => esc_html__( 'Package Disable', 'exhibz' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'exhibz' ),
				'label_off' => esc_html__( 'No', 'exhibz' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );
        $this->add_control(
			'price_featured',
			[
				'label' => esc_html__( 'Featured', 'exhibz' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'exhibz' ),
				'label_off' => esc_html__( 'No', 'exhibz' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );

        $this->add_control(
			'package_icon',
			[
				'label' => esc_html__( 'Price Icons', 'exhibz' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-apple',
                'condition' => [
                    'pricing_style' => ['icon-price'],
                    
                ]
			]
		);
        $this->add_control(
			'package_name',
			[
				'label' => esc_html__( 'Package Name', 'exhibz' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter your Price Package', 'exhibz' ),
			]
        );
        
        $this->add_control(
			'price',
			[
				'label' => esc_html__( 'Package Price', 'exhibz' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Package Price', 'exhibz' ),
			]
        );
        
        $this->add_control(
			'currency',
			[
				'label' => esc_html__( 'Currency', 'exhibz' ),
                'type' => Controls_Manager::TEXT,
                'default' => '$',
                'placeholder' => esc_html__( 'Enter Currency', 'exhibz' ),
                'condition' => [
                    'pricing_style' => ['curly-price'],
                ]
			]
        );
        $this->add_control(
			'currency_image',
			[
				'label' => esc_html__( 'Currency Icon', 'exhibz' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => EXHIBZ_IMG.'/pricing/dollar.png',
                ],
                'condition' => [
                    'pricing_style' => ['icon-price'],
                  ]
			]
		);
        
        $this->add_control(
			'pricing_progress',
			[
				'label' => esc_html__( 'Package status note', 'exhibz' ),
				'type' => Controls_Manager::WYSIWYG,
            'placeholder' => esc_html__( 'Available tickets for this price', 'exhibz' ),
            'condition' => [
               'pricing_style' => ['icon-price'],
             ]
			]
        );
        
        $this->add_control(
            'pricing_progress_curly',
            [
               'label' => esc_html__( 'Package status note', 'exhibz' ),
               'type' => Controls_Manager::TEXTAREA,
               'placeholder' => esc_html__( 'Available tickets for this price', 'exhibz' ),
               'condition' => [
                  'pricing_style' => ['curly-price'],
                ]
            ]
        );

        $this->add_control(
			'total_ticket',
			[
				'label' => esc_html__( 'Total Ticket', 'exhibz' ),
                'type' => Controls_Manager::NUMBER,
                'condition' => [
                    'pricing_style' => ['curly-price'],
                  ]
				
			]
        );
        
        $this->add_control(
			'avail_ticket',
			[
				'label' => esc_html__( 'Available Ticket', 'exhibz' ),
                'type' => Controls_Manager::NUMBER,
                'condition' => [
                    'pricing_style' => ['curly-price'],
                    
                ]
				
			]
        );

        $this->add_control(
			'promotion_text',
			[
				'label' => esc_html__( 'Promotion Text', 'exhibz' ),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'pricing_style' => ['curly-price'],
                    
                ]
				
			]
        );
        
        $this->add_control(
			'price_button_text',
			[
				'label' => esc_html__( 'Button Text', 'exhibz' ),
				'type' => Controls_Manager::TEXT,
				
			]
        );
        
        $this->add_control(
			'price_button_url',
			[
				'label' => esc_html__( 'Button Link', 'exhibz' ),
				'type' => Controls_Manager::URL,
				
			]
        );
        
        $this->add_control(
			'price_package_vat',
			[
				'label' => esc_html__( 'Vat Condition', 'exhibz' ),
				'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'All prices exclude 25% VAT', 'exhibz' ),
                'condition' => [
                    'pricing_style' => ['curly-price'],
                    
                ]
			]
		);
         
        
        $this->end_controls_section();
  
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Style Section', 'exhibz' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
			'box_text_color', [
				'label'		 =>esc_html__( 'Text color', 'exhibz' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
			
                    '{{WRAPPER}} .ts-pricing-item a.btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ts-pricing-header i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .promotional-code a.btn' => 'color: {{VALUE}};',
         
                  
				],
			]
        );

        $this->add_control(
			'box_text_content_color', [
				'label'		 => esc_html__( 'content color', 'exhibz' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .ts-pricing-price span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ts-pricing-price ' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ts-pricing-name' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ts-pricing-box .ts-pricing-progress .ts-pricing-value' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ts-pricing-box .promotional-code .promo-code-text' => 'color: {{VALUE}};',
                    
                  
				],
			]
        );

        $this->add_control(
			'box_background_color', [
				'label'		 => esc_html__( 'Button Background', 'exhibz' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .btn' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .ts-pricing-header i' => 'background: {{VALUE}};',
                   
				],
			]
        );

    

        $this->add_control(
			'box_shape_image',
			[
				'label' => esc_html__( 'Border Image', 'exhibz' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => EXHIBZ_IMG.'/pricing/dot.png',
                ],
                'condition' => [
                    'pricing_style' => ['curly-price'],
                    
                ]
			]
        );
        
        $this->add_control(
			'progressbar_headding',
			[
				'label' => esc_html__( 'Progressbar color', 'exhibz' ),
				'type' => Controls_Manager::HEADING,
                'condition' => [
                    'pricing_style' => ['curly-price'],
                    
                ]
			]
        );
        
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'progress_background',
				'label' => esc_html__( 'Progressbar Color', 'exhibz' ),
                'types' => [ 'gradient' ],
                'condition' => [
                    'pricing_style' => ['curly-price'],
                    
                ],
				'selector' => '{{WRAPPER}} .ts-pricing-box .ts-progress .ts-progress-inner',
			]
		);
        $this->end_controls_section();

		
       
        

    } //Register control end

    protected function render( ) { 
        $avail_ticket = 0;
        $total_ticket=0;
        $prograss = "0%";
        $settings = $this->get_settings();
        $price_disable = $settings["price_disable"];
        $package_name = $settings["package_name"];
        $price = $settings["price"];
        $currency = isset($settings["currency"])?$settings["currency"]:'$';
        $pricing_progress = $settings["pricing_progress"];
        $pricing_progress_curly = $settings["pricing_progress_curly"];
        $total_ticket = $settings["total_ticket"];
        $avail_ticket = $settings["avail_ticket"];
        $price_button_text = $settings["price_button_text"];
        $price_button_url = $settings["price_button_url"];
        $price_package_vat = $settings["price_package_vat"];
        $promotion_text = $settings["promotion_text"];
        $package_icon = $settings["package_icon"];
        $currency_image= $settings["currency_image"];
        $box_shape_image = $settings["box_shape_image"];
        $price_featured = $settings["price_featured"];
       
        $style = $settings["pricing_style"];
        
        if($avail_ticket>$total_ticket){
            $avail_ticket = $total_ticket; 
        }
        if($avail_ticket>0 && $total_ticket>0){
            $prograss = (($avail_ticket/$total_ticket)*100).'%';
        }
    
        ?>  
        <?php if($style=="curly-price"): ?>
        <div class="pricing-item <?php echo esc_attr($price_featured=="yes"?"active":''); ?> <?php echo esc_attr($price_disable=="yes"?'disebled':''); ?> ">
        <img class="pricing-dot " src="<?php echo esc_url($box_shape_image["url"]); ?>" alt="<?php echo esc_attr($package_name); ?>">
        <div class="ts-pricing-box">
            <div class="ts-pricing-header">
                <h2 class="ts-pricing-name"> <?php echo esc_html($package_name); ?> </h2>
                <h3 class="ts-pricing-price">
                    <span class="currency"><?php echo esc_html($currency); ?></span><?php echo esc_attr($price); ?>
                </h3>
            </div>
            <div class="ts-pricing-progress">
                <p class="amount-progres-text"><?php echo esc_html($pricing_progress_curly); ?></p>
                <div class="ts-progress">
                    <div class="ts-progress-inner" style="width: <?php echo esc_attr($prograss); ?>"></div>
                </div>
                <p class="ts-pricing-value"><?php echo esc_html($total_ticket>0 || $avail_ticket>0?$avail_ticket.'/'.$total_ticket:''); ?></p>
            </div>
            <div class="promotional-code">
                <p class="promo-code-text"> <?php echo esc_html($promotion_text); ?></p>
                <a target="<?php echo esc_attr($price_button_url["is_external"]=="on"?"_blank":'_self'); ?>" rel="<?php echo esc_attr($price_button_url["nofollow"]=="on"?"":'nofollow'); ?>" href="<?php echo esc_url($price_button_url["url"]); ?>" class="btn pricing-btn"><?php echo esc_attr($price_button_text); ?></a>
                <p class="vate-text"><?php echo esc_html($price_package_vat); ?></p>
            </div>
        </div>
        <!-- ts pricing box-->
        <img class="pricing-dot1 " src="<?php echo esc_url($box_shape_image["url"]); ?>" alt="<?php echo esc_attr($package_name); ?>">
        </div>
        <?php elseif($style=="icon-price"): ?>
        <div class="ts-pricing-item <?php echo esc_attr($price_featured=="yes"?"active":''); ?> <?php echo esc_attr($price_disable=="yes"?'disebled':''); ?>">
        <div class="ts-pricing-header">
            <i class="<?php echo esc_attr($package_icon); ?>"></i>
            <h2 class="ts-pricing-name"><?php echo esc_attr($package_name); ?></h2>
            <h3 class="ts-pricing-price">
                <img class="currency" src="<?php echo esc_url($currency_image["url"]); ?>" alt="<?php echo esc_attr($package_name); ?>">
                <span><?php echo esc_attr($price); ?></span>
            </h3>
        </div>
        <p>
            <?php echo exhibz_kses($pricing_progress); ?>
        </p>
        <a target="<?php echo esc_attr($price_button_url["is_external"]=="on"?"_blank":'_self'); ?>" rel="<?php echo esc_attr($price_button_url["nofollow"]=="on"?"":'nofollow'); ?>" href="<?php echo esc_url($price_button_url["url"]); ?>" class="btn btn-round"><?php echo esc_attr($price_button_text); ?></a>
        </div>
        <?php endif; ?>
      
    <?php  
    }
    protected function _content_template() { }
}