<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Exhibz_Speaker_Slider_Widget extends Widget_Base {


    public $base;

    public function get_name() {
        return 'exhibz-speaker-slider';
    }

    public function get_title() {
        return esc_html__( 'Speakers slider', 'exhibz' );
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
				'label' => esc_html__( 'Exhibz Speakers slider', 'exhibz' ),
			]
        );
        
        $this->add_control(
			'speaker_id',
			[
				'label' => esc_html__( 'Speaker', 'exhibz' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
            'multiple' => true,
			   'options' => $this->speaker_list(),
			]
        ); 
        
        
        $this->add_control(
			'speaker_style',
			[
				'label' => esc_html__( 'Speaker Style', 'exhibz' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'speaker-1',
				'options' => [
					'speaker-1'  => esc_html__( 'Speaker Circle', 'exhibz' ),
		
				],
			]
        );
        
        $this->add_control('slider_count', 
                [
                'label'		 => esc_html__( 'Count', 'exhibz' ),
                'type'		 => Controls_Manager::NUMBER,
                'default' => 4,
            ]
        );
        $this->add_control(
            'speaker_order',
            [
                'label'     =>esc_html__( 'order', 'exhibz' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'DESC',
                'options'   => [
                        'DESC'      =>esc_html__( 'Descending', 'exhibz' ),
                        'ASC'       =>esc_html__( 'Ascending', 'exhibz' ),
                    ],
            ]
        );
        $this->add_control('text_color', 
        [
           'label'		 => esc_html__( 'Text color', 'exhibz' ),
           'type'		 => Controls_Manager::COLOR,
           'selectors'	 => [
               '{{WRAPPER}} .ts-speaker-slider .ts-speaker .ts-speaker-info .ts-title' => 'color: {{VALUE}};',
               '{{WRAPPER}} .ts-speaker-slider .ts-speaker .ts-speaker-info p' => 'color: {{VALUE}};',
           ],
       ]
      );
        $this->add_control('hover_bg_color', 
        [
           'label'		 => esc_html__( 'Box Hover color', 'exhibz' ),
           'type'		 => Controls_Manager::COLOR,
           'selectors'	 => [
               '{{WRAPPER}} .ts-speaker-slider .ts-speaker::before' => 'background-color: {{VALUE}};',
           ],
       ]
      );

      $this->add_group_control(Group_Control_Typography::get_type(),
        [
            'name'		 => 'title_typography',
            'label'		 => esc_html__( 'Title Typography', 'exhibz' ),
            'selector'	 => '{{WRAPPER}} .ts-speaker-slider .ts-speaker .ts-speaker-info .ts-title',
            ]
        );
      $this->add_group_control(Group_Control_Typography::get_type(),
        [
            'name'		 => 'designation_typography',
            'label'		 => esc_html__( 'Designation Typography', 'exhibz' ),
            'selector'	 => '{{WRAPPER}} .ts-speaker-slider .ts-speaker .ts-speaker-info p',
            ]
        );
        

        $this->end_controls_section();
        
    }    
    protected function render() {
     
   
      $settings   = $this->get_settings();
      $style      = $settings["speaker_style"];
      $speaker_ids = $settings["speaker_id"];
      $speaker_order = $settings['speaker_order'];
      $slider_count = $settings["slider_count"];
      if($speaker_order=="DESC"){
        rsort($speaker_ids);
      }
    
      
?>
   <div class="ts-speaker-slider owl-carousel" data-count="<?php echo esc_attr($slider_count) ?>">
<?php
      foreach( $speaker_ids as  $speaker_id):  
         $data= [];
         $data['exhibs_designation'] = exhibz_meta_option($speaker_id,'exhibs_designation',true);
         $data['social'] = exhibz_meta_option($speaker_id,'social',true);
         $data['exhibs_photo'] = exhibz_meta_option($speaker_id,'exhibs_photo',true);
         $data['exhibs_summery'] = exhibz_meta_option($speaker_id,'exhibs_summery',true);
         $data['exhibs_logo'] = exhibz_meta_option($speaker_id,'exhibs_logo',true); 
        ?>
      <div class="ts-speaker">
        <div class="speaker-img">
              <?php if(count($data["exhibs_photo"])>1): ?>  
                  <?php echo wp_get_attachment_image( $data["exhibs_photo"]["attachment_id"], 'full','',array( "class" => "img-fluid" )); ?>
               <?php endif; ?> 
            <a href="<?php echo esc_html("#popup_".$speaker_id); ?>" class="view-speaker ts-image-popup" data-effect="mfp-zoom-in">
            <!-- <i class="icon icon-plus"></i> -->
            </a>
        </div>
        <div class="ts-speaker-info">
            <h3 class="ts-title"><?php echo esc_html(get_the_title($speaker_id)); ?></h3>
            <p>
                <?php echo esc_html($data["exhibs_designation"]); ?>
            </p>
        </div>
        <!--- speaker info end -->
        <!-- popup start-->
        <div id="<?php echo esc_html("popup_".$speaker_id); ?>" class="container ts-speaker-popup mfp-hide">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ts-speaker-popup-img">
                    <?php if(count($data["exhibs_photo"])>1): ?>  
                    <?php echo wp_get_attachment_image( $data["exhibs_photo"]["attachment_id"], 'full' ); ?>
                    <?php endif; ?>    
                    </div>
                </div>
                <!-- col end-->
                <div class="col-lg-6">
                    <div class="ts-speaker-popup-content">
                    <h3 class="ts-title"><?php echo esc_html(get_the_title($speaker_id)); ?> </h3>
                    <span class="speakder-designation"> <?php echo esc_attr($data["exhibs_designation"]); ?></span>
                    <?php if(count($data["exhibs_logo"])>1): ?>  
                       
                       <?php echo wp_get_attachment_image( $data["exhibs_logo"]["attachment_id"], 'thumb','',array( "class" => "company-logo" )); ?>
                    <?php endif; ?>
                    <p>
                        <?php echo exhibz_kses($data["exhibs_summery"]); ?>
                    </p>
                
                    </div>
                    <!-- ts-speaker-popup-content end-->
                </div>
                <!-- col end-->
            </div>
            <!-- row end-->
        </div>
        <!-- popup end-->
       </div>
        <!-- ts-speaker end  -->
 
    <?php 
      
    endforeach;
    ?>
</div>
    <?php

    }

    public function speaker_list(){

        $schedule_list = [];
        $args = array(
            'post_type' 			=> 'ts-speaker',
             'posts_per_page' =>'-1'
         
         );
         
         $posts = get_posts($args);
         foreach ($posts as $postdata) {
            setup_postdata( $postdata );
            $schedule_list[$postdata->ID] = [$postdata->post_title];
         
         }
      
        return $schedule_list;
    }

}