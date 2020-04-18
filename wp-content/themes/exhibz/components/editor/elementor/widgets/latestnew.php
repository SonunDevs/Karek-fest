<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Exhibz_Latestnews_Widget extends Widget_Base {


    public $base;

    public function get_name() {
        return 'exhibz-latestnews';
    }

    public function get_title() {
        return esc_html__( 'Latest News', 'exhibz' );
    }

    public function get_icon() { 
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return [ 'exhibz-elements' ];
    }

    protected function _register_controls() {
		$this->start_controls_section(
			'section_tab', [
				'label' => esc_html__( 'Latest Post', 'exhibz' ),
			]
        );
      
      $this->add_control(
         'post_count',
                     [
                        'label'         => esc_html__( 'Post count', 'exhibz' ),
                        'type'          => Controls_Manager::NUMBER,
                        'default'       => '3',

                     ]
        );
      $this->add_control(
			'post_col',
			[
				'label'   => esc_html__( 'Post Column', 'exhibz' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'3'  => esc_html__( '4 Column ', 'exhibz' ),
					'4'  => esc_html__( '3 Column', 'exhibz' ),
					'6'  => esc_html__( '2 Column', 'exhibz' ),
			
				],
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
         'show_desc',
         [
             'label'     => esc_html__('Show desc', 'exhibz'),
             'type'      => Controls_Manager::SWITCHER,
             'label_on'  => esc_html__('Yes', 'exhibz'),
             'label_off' => esc_html__('No', 'exhibz'),
             'default'   => 'yes',
            
         ]
         ); 
      $this->add_control('desc_limit',
            [
              'label'         => esc_html__( 'Description limit', 'exhibz' ),
              'type'          => Controls_Manager::NUMBER,
              'default'       => '10',
              'condition'     => [ 
                 'show_desc' => ['yes'] 
               ],
              
            ]
          );   
    
      $this->add_control('show_date',
            [
                'label'     => esc_html__('Show Date', 'exhibz'),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__('Yes', 'exhibz'),
                'label_off' => esc_html__('No', 'exhibz'),
                'default'   => 'yes',
            ]
        ); 
      $this->add_control(
         'show_author',
               [
                  'label'     => esc_html__('Show Author', 'exhibz'),
                  'type'      => Controls_Manager::SWITCHER,
                  'label_on'  => esc_html__('Yes', 'exhibz'),
                  'label_off' => esc_html__('No', 'exhibz'),
                  'default'   => 'no',
         
               ]
         );

      $this->add_control('show_readmore',
                  [
                     'label'     => esc_html__('Show Readmore', 'exhibz'),
                     'type'      => Controls_Manager::SWITCHER,
                     'label_on'  => esc_html__('Yes', 'exhibz'),
                     'label_off' => esc_html__('No', 'exhibz'),
                     'default'   => 'yes',
            
                  ]
            );   

       
      $this->end_controls_section();
      
      $this->start_controls_section('style_section',
			[
				'label' => esc_html__( 'Style Section', 'exhibz' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		); 
      $this->add_control(
         'post_text_color',
         [
             'label' => esc_html__('Title color', 'exhibz'),
             'type' => Controls_Manager::COLOR,
             'default' => '',
             'selectors' => [
                  '{{WRAPPER}} .post .entry-title a' => 'color: {{VALUE}};',
             ],
         ]
        );

      $this->add_control(
         'post_text_color_hover',
         [
             'label'     => esc_html__('Title hover', 'exhibz'),
             'type'      => Controls_Manager::COLOR,
             'default'   => '',
             'selectors' => [
               '{{WRAPPER}} .post .entry-title a:hover' => 'color: {{VALUE}};',
           
             ],
         ]
        );
      $this->end_controls_section();  
    } 

    protected function render() {
     
    $settings        = $this->get_settings();
    $post_title_crop = $settings["post_title_crop"];
    $show_desc       = $settings["show_desc"];
    $desc_limit      = $settings["desc_limit"];
    $post_count      = $settings["post_count"];
    $show_date       = $settings["show_date"];
    $show_author     = $settings["show_author"];
    $show_readmore   = $settings["show_readmore"];
    $post_col        = $settings["post_col"];
    $args = array(
        'numberposts'      => $post_count,
        'orderby'          => 'post_date',
        'order'            => 'DESC',
        'post_type'        => 'post',
        'post_status'      => 'publish',
        'suppress_filters' => false,
        
    );
   
    $recent_posts = wp_get_recent_posts( $args, ARRAY_A );
  
    ?>
<div class="row">
  <?php  foreach( $recent_posts as $recent):   ?>
   <div class="col-lg-<?php echo esc_attr($post_col); ?> fadeInUp">
      <div class="post">
         <?php if(has_post_thumbnail($recent['ID'])): ?>
         <div class="post-media post-image">
            <a href="<?php echo get_permalink($recent["ID"]); ?>"><img src="<?php echo get_the_post_thumbnail_url( $recent['ID'], 'large' ); ?>" class="img-fluid" alt="<?php echo get_author_posts_url( $recent['post_author']); ?>"></a>
         </div>
        <?php endif; ?>
         <div class="post-body">
            <div class="post-meta">
               <?php if($show_author=='yes'): ?>
               <span class="post-author">
               <i class="icon icon-user"></i> 
               <a href="<?php echo get_author_posts_url( $recent['post_author']); ?>"> <?php echo get_the_author(); ?></a>
               </span>
               <?php endif; ?> 
               <span class="post-meta-date">
                <i class="icon icon-calendar"></i>
                  <?php echo esc_html($show_date=='yes'?date('F d,Y', strtotime($recent["post_date"])):'');  ?> 
               </span>
            </div>
            <div class="entry-header">
               <h2 class="entry-title">
                  <a href="<?php echo get_post_permalink($recent["ID"]); ?>"><?php echo wp_trim_words( wp_kses($recent["post_title"],['p']), $post_title_crop, '');  ?> </a>
               </h2>
            </div>
            <!-- header end -->
            <div class="entry-content">
               <?php if($show_desc=="yes"): ?>
               <p> <?php echo wp_trim_words( wp_kses($recent["post_content"],['p']), $desc_limit, '');  ?>   </p>
               <?php endif; ?> 
            </div>
            <div class="post-footer">
               <?php if($show_readmore=="yes"): ?>
               <a href="<?php echo get_post_permalink($recent["ID"]); ?>" class="btn-link"> <?php esc_html_e("Read More",'exhibz'); ?> <i class="icon icon-arrow-right"></i></a>
               <?php endif; ?> 
            </div>
         </div>
         <!-- post-body end -->
      </div>
      <!-- post end-->
   </div>
   <?php endforeach; ?> 
</div> <!-- row end -->
   <?php 
    wp_reset_query();
    }

   
}