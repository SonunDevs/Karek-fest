<section class="ts-schedule">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 mx-auto">
            <div class="ts-schedule-nav">
               <ul class="nav nav-tabs justify-content-center" role="tablist">
                  <?php 
                     extract(array(
                        'number'=> $schedule_day_limit,
                          'order' => $schedule_order,
                          'class' => '',
                     ));
                     
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
                     <a class="active" title="<?php echo get_the_title($postnav->ID) ?>" href="<?php echo esc_attr("#date".$i); ?>" role="tab" data-toggle="tab">
                        <h3><?php echo get_the_title($postnav->ID) ?></h3>
                        <?php if(!empty(fw_get_db_post_option($postnav->ID,'schedule_day'))){  ?>
                        <span><?php echo fw_get_db_post_option($postnav->ID,'schedule_day'); ?></span>
                        <?php }?>
                     </a>
                  </li>
                  <?php }else { ?>  
                  <li class="nav-item">
                     <a class="" title="<?php echo get_the_title($postnav->ID) ?>" href="<?php echo esc_attr("#date".$i); ?>" role="tab" data-toggle="tab">
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
            <div class="tab-content schedule-tabs schedule-tabs-item">
               <?php 
                  $j=1;
                  foreach ($posts as $post) {
                       setup_postdata( $post );
                       $schedule_list = fw_get_db_post_option($post->ID)["exhibz_schedule_pop_up"];
                  ?>  
               <?php if($j==1){ ?>  
               <div role="tabpanel" class="tab-pane active" id="<?php echo esc_attr("date".$j); ?>">
                  <ul>
                     <?php foreach ($schedule_list as $key => $schedule) { ?>
                        <?php 
                           if($key==$schedule_limit){
                              break;
                           }
                           $speaker = fw_get_db_post_option($schedule["speakers"],"exhibs_photo"); 
                           $speaker_name = get_post( $schedule["speakers"] );
                          
                
                   ?> 
                     <li>
                        <div class="schedule-listing-item  <?php echo esc_attr(++$key%2==1?"schedule-left":"schedule-right"); ?> ">
                         
                          <?php if($speaker): ?>            
                             <a target="_blank" href="<?php echo esc_url(get_the_permalink($speaker_name->ID)); ?>"> 
                               <img class="schedule-slot-speakers" src="<?php echo wp_get_attachment_url($speaker["attachment_id"],'thumbnail'); ?>" title=" <?php echo esc_html($speaker_name->post_title); ?> " alt=" <?php echo esc_html($speaker_name->post_title); ?> ">  
                             </a>                                    
                           <?php endif; ?>
                           <span class="schedule-slot-time"><?php echo esc_attr($schedule["schedule_time"]); ?>  </span>
                           <div class="schedule-speaker">
                              <?php if($schedule["speakers"]!=''): ?>
                                  <?php echo esc_html($speaker_name->post_title); ?>
                              <?php endif; ?>
                           </div>
                           <h3 class="schedule-slot-title"><?php echo esc_attr($schedule["schedule_title"]); ?></h3>
                        
                           <p>
                              <?php echo exhibz_kses($schedule["schedule_note"]); ?>
                           </p>
                        </div>
                     </li>
                     <!-- col end-->
                     <?php } ?>  
                  </ul>
                  <!-- row end-->
               </div>
               <!-- tab pane end-->
               <?php }else{ //else ?> 
               <div role="tabpanel" class="tab-pane" id="<?php echo esc_attr("date".$j); ?>">
                  <ul>
                     <?php foreach ($schedule_list as $key => $schedule) { ?>
                        <?php 
                           if($key==$schedule_limit){
                              break;
                           }
                     
                           $speaker = fw_get_db_post_option($schedule["speakers"],"exhibs_photo"); 
                           $speaker_name = get_post( $schedule["speakers"] );
                        
                
                   ?>
                     <li>
                        <div class="schedule-listing-item  <?php echo esc_attr(++$key%2==1?"schedule-left":"schedule-right"); ?> ">
                           <?php if($speaker): ?> 
                              <a target="_blank" href="<?php echo esc_url(get_the_permalink($speaker_name->ID)); ?>"> 
                                 <img class="schedule-slot-speakers" src="<?php echo wp_get_attachment_url($speaker["attachment_id"],'thumbnail'); ?>" title="<?php echo esc_html($speaker_name->post_title); ?>" alt=" <?php echo esc_html($speaker_name->post_title); ?> ">
                              </a>                                    
                          <?php endif; ?>
                           <span class="schedule-slot-time"><?php echo esc_attr($schedule["schedule_time"]); ?>  </span>
                           <div class="schedule-speaker">
                              <?php if($schedule["speakers"]!=''): ?>
                                     <?php echo esc_html($speaker_name->post_title); ?>
                              <?php endif; ?>
                           </div>
                           <h3 class="schedule-slot-title"><?php echo esc_attr($schedule["schedule_title"]); ?></h3>
                         
                           <p>
                              <?php echo exhibz_kses($schedule["schedule_note"]); ?>
                           </p>
                        </div>
                     </li>
                     <!-- col end-->
                     <?php } ?>  
                  </ul>
                  <!-- row end-->
               </div>
               <!-- tab pane end-->
               <?php 
                  }
                   $j++;
                   } 
                   	wp_reset_postdata(); ?>  
            </div>
         </div>
      </div>
   </div>
   <!-- container end-->
</section>