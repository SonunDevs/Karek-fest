<section class="ts-schedule">
   <div class="container">
      <div class="row">
         <div class="col-lg-6 align-self-center wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="400ms">
            <div class="ts-schedule-content">
               <h2 class="column-title">
                  <span><?php echo esc_attr($schedule_top_title); ?></span>
                  <?php echo esc_attr($schedule_title); ?>
               </h2>
               <p>
                  <?php echo wp_kses_post($schedule_desc); ?>
               </p>
            </div>
         </div>
         <!-- col end-->
         <div class="col-lg-6 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="500ms">
            <div class="ts-schedule-info mb-70">
               <ul class="nav nav-tabs" role="tablist">
                  <?php 
                     extract([
                          'number' => $schedule_day_limit,
                          'order'=> $schedule_order,
                          'class'=> '',
                     ]);
                     
                      global $post;
                     $args = array(
                        'post_type' 			=> 'ts-schedule',
                        'suppress_filters' => false,
                        'posts_per_page' 		=> esc_attr($number),
                        'order' 				=> $order,
                     );
                     $i=1;
                     $posts = get_posts($args);
                     foreach ($posts as $postnav) {
                        setup_postdata( $postnav );
                     
                      
                     ?>   
                  <?php if( $i == 1 ){ ?>
                  <li class="nav-item">
                     <a class="active" title="Click Me" href="<?php echo esc_attr("#date".$i); ?>" role="tab" data-toggle="tab">
                        <h3><?php echo get_the_title($postnav->ID) ?></h3>
                        <span><?php echo fw_get_db_post_option($postnav->ID,'schedule_day'); ?></span>
                     </a>
                  </li>
                  <?php }else { ?>  
                  <li class="nav-item">
                     <a  title="Click Me" href="<?php echo esc_attr("#date".$i); ?>" role="tab" data-toggle="tab">
                        <h3><?php echo get_the_title($postnav->ID) ?></h3>
                        <?php if(!empty(fw_get_db_post_option($postnav->ID,'schedule_day'))){  ?>
                        <span><?php echo fw_get_db_post_option($postnav->ID,'schedule_day'); ?></span>
                        <?php }?>
                     </a>
                  </li>
                  <?php  } ?>  
                  <?php $i++; } wp_reset_postdata(); ?>
               </ul>
               <!-- Tab panes -->
            </div>
         </div>
         <!-- col end-->
      </div>
      <!-- row end-->
      <div class="row">
         <div class="col-lg-12">
            <div class="tab-content schedule-tabs">
               <?php 
                  $j=1;
                  foreach ($posts as $post) {
                       setup_postdata( $post );
                       $schedule_list = fw_get_db_post_option($post->ID)["exhibz_schedule_pop_up"];
                  ?>  
               <?php if($j==1){ ?>  
               <div role="tabpanel" class="tab-pane active" id="<?php echo "date".$j; ?>">
                  <?php foreach ($schedule_list as $key => $schedule) { ?>
                  <?php 
                     $speaker = fw_get_db_post_option($schedule["speakers"],"exhibs_photo"); 
                  
                  
                     $speaker_name = get_post( $schedule["speakers"] );
                    
                     ?>
                  <div class="schedule-listing">
                     <div class="schedule-slot-time">
                        <span> <?php echo esc_attr($schedule["schedule_time"]); ?> </span>
                      
                     </div>
                     <div class="schedule-slot-info">
                        <?php if($speaker): ?>
                           <a target="_blank" href="<?php echo esc_url(get_the_permalink($speaker_name->ID)); ?>"> 
                              <img class="schedule-slot-speakers" src="<?php echo wp_get_attachment_url($speaker["attachment_id"],'thumbnail'); ?>" alt="<?php echo esc_attr($schedule["schedule_title"]); ?>"> 
                           </a>
                        <?php endif; ?>
                        <div class="schedule-slot-info-content">
                          <p class="schedule-speaker speaker-1"> 
                             <?php if($schedule["speakers"]!=''): ?>
                                 <?php echo esc_html($speaker_name->post_title); ?> 
                             <?php endif; ?>
                          </p>
                         
                           <h3 class="schedule-slot-title">
                              <?php echo esc_attr($schedule["schedule_title"]); ?>
                              <!-- <strong>@ Fredric Martinsson</strong> -->
                           </h3>
                           <p> 
                              <?php echo wp_kses_post($schedule["schedule_note"]); ?>
                           </p>
                        </div>
                        <!--Info content end -->
                     </div>
                     <!-- Slot info end -->
                  </div>
                  <?php    } // end loop schedule list ?>  
                  <!--schedule-listing end -->
               </div>
               <?php }else{ //active ?>     
               <div role="tabpanel" class="tab-pane" id="<?php echo esc_attr("date".$j); ?>">
                  <?php foreach ($schedule_list as $key => $schedule) { ?>
                  <?php 
                     $speaker = fw_get_db_post_option($schedule["speakers"],"exhibs_photo"); 
                     $speaker_name = get_post( $schedule["speakers"] );
                     
                     ?>
                  <div class="schedule-listing">
                     <div class="schedule-slot-time">
                        <span> <?php echo esc_attr($schedule["schedule_time"]); ?> </span>
                       
                     </div>
                     <div class="schedule-slot-info">
                       <?php if($speaker): ?>
                          <a target="_blank" href="<?php echo esc_url(get_the_permalink($speaker_name->ID)); ?>">  <img class="schedule-slot-speakers" src="<?php echo wp_get_attachment_url($speaker  ["attachment_id"],'thumbnail'); ?>" alt=" <?php echo esc_attr($schedule["schedule_title"]); ?>"> </a>
                       <?php endif; ?>
                        <div class="schedule-slot-info-content">

                           <p class="schedule-speaker speaker-1">
                                <?php if($schedule["speakers"]!=''): ?>
                                    <?php echo esc_html($speaker_name->post_title); ?> 
                                <?php endif; ?>    
                            </p>
                         
                           <h3 class="schedule-slot-title">
                              <?php echo esc_attr($schedule["schedule_title"]); ?>
                              <!-- <strong>@ Fredric Martinsson </strong> -->
                           </h3>
                           <p> 
                              <?php echo wp_kses_post($schedule["schedule_note"]); ?>
                           </p>
                        </div>
                        <!--Info content end -->
                     </div>
                     <!-- Slot info end -->
                  </div>
                  <?php    } // end loop schedule list ?>  
                  <!--schedule-listing end -->
               </div>
               <?php }//end else  ?>  
               <?php
                  $j++;
                  } 
                  	wp_reset_postdata(); ?> 
            </div>
         </div>
      </div>
   </div>
   <!-- container end-->
</section>