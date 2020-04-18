<?php 
   extract(array(
       'number' 	=> 1,
         'order' 	=> $schedule_order,
         'class' 	=> '',
    ));
   
     global $post;
    $args = array(
       'post_type' 			=> 'ts-schedule',
       'post__in' => array($schedule_post_id)
    );
   
    $i=1;
    $posts = get_posts($args);
   
    foreach ($posts as $postnav) {
       setup_postdata( $postnav );
    
    ?>             
<section class="ts-schedule">
   <div class="container">
      <div class="row">
         <div class="col-lg-12" style="display:<?php echo esc_attr($header_show=="yes"?"block":"none"); ?>">
            <h2 class="section-title" >
               <?php echo get_the_title($postnav->ID) ?>
            </h2>
         </div>
         <!-- col end-->
      </div>
      <!-- row end-->
      <div class="row">
         <div class="col-lg-12">
            <div class="tab-content schedule-tabs">
               <div role="tabpanel" class="tab-pane active" id="date3">
                  <?php 
                     $schedule_list = fw_get_db_post_option($postnav->ID)["exhibz_schedule_pop_up"];
                     foreach($schedule_list as $schedule) {
                      
                        $speaker = fw_get_db_post_option($schedule["speakers"],"exhibs_photo"); 
                        $speaker_name = get_post( $schedule["speakers"] );

                        ?>
                  <div class="schedule-listing">
                     <div class="schedule-slot-time">
                        <span>  <?php echo esc_attr($schedule["schedule_time"]); ?>  </span>
                     </div>
                     <div class="schedule-slot-info">
                        <?php if($speaker): ?> 
                           <a target="_blank" href="<?php echo esc_url(get_the_permalink($speaker_name->ID)); ?>"> 
                              <img class="schedule-slot-speakers" src="<?php echo wp_get_attachment_url($speaker["attachment_id"],'thumbnail'); ?>" alt="<?php echo esc_attr($schedule["schedule_title"]); ?>">
                           </a>
                        <?php endif; ?> 
                        <div class="schedule-slot-info-content">
                          <p class="schedule-speaker speaker-1"> 
                             <?php if($schedule["speakers"] !=''): ?>
                                 <?php echo esc_html($speaker_name->post_title); ?> 
                              <?php endif; ?>   
                          </p>
                           <h3 class="schedule-slot-title">
                              <?php echo esc_attr($schedule["schedule_title"]); ?>
                           </h3>
                           <p>
                              <?php echo wp_kses_post($schedule["schedule_note"]); ?>
                           </p>
                        </div>
                        <!--Info content end -->
                     </div>
                     <!-- Slot info end -->
                  </div>
                  <!--schedule-listing end -->
                  <?php } ?>     
                  <!--schedule-listing end -->
                  <div class="schedule-listing-btn">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- container end-->
</section>
<?php } ?>