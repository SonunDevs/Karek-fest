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
                  <?php echo esc_html($schedule_desc); ?>
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
                     $multiple_speaker = [];
                     $args = array(
                        'post_type' 			   => 'ts-schedule',
                        'suppress_filters' => false,
                        'posts_per_page' 		   => esc_attr($number),
                        'order' 				      => $order,
                     );
                     $i=1;
                     $posts = get_posts($args);
                     foreach ($posts as $postnav) {
                        setup_postdata( $postnav );
                     
                      
                     ?>   
                  <?php if( $i == 1 ){ ?>
                  <li class="nav-item">
                     <a class="active" title="<?php esc_attr_e('Click Me','exhibz'); ?>" href="<?php echo esc_attr("#date".$i); ?>" role="tab" data-toggle="tab">
                        <h3><?php echo get_the_title($postnav->ID) ?></h3>
                        <?php $schedule_day_v = fw_get_db_post_option($postnav->ID,'schedule_day'); if(!empty($schedule_day_v)){  ?>
                        <span><?php echo fw_get_db_post_option($postnav->ID,'schedule_day'); ?></span>
                        <?php }?>
                     </a>
                  </li>
                  <?php }else { ?>  
                  <li class="nav-item">
                     <a  title="<?php esc_attr_e('Click Me','exhibz'); ?>" href="<?php echo esc_attr("#date".$i); ?>" role="tab" data-toggle="tab">
                        <h3><?php echo get_the_title($postnav->ID) ?></h3>

                        <?php $schedule_day_v= fw_get_db_post_option($postnav->ID,'schedule_day'); if(!empty($schedule_day_v)){  ?>
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
               <div role="tabpanel" class="tab-pane active" id="<?php echo esc_attr("date".$j); ?>">
               <?php foreach ($schedule_list as $key => $schedule) { ?>
                  <?php 

                     if($key==$schedule_limit){
                        break;
                     }
                     
                     $speaker_one = '';
                     $speaker_two = '';
                     $speaker_three = '';

                     $speaker_id_one = '';
                     $speaker_id_two = '';
                     $speaker_id_three = '';

                     $schedule_speaker_multi = [];
                    
                     $q=[];
                     $multiple_speaker = [];
                  
                     if(array_key_exists("multi_speaker_choose",$schedule)){
                        if(array_key_exists("style",$schedule["multi_speaker_choose"])) {
                            $schedule_speaker_check = $schedule["multi_speaker_choose"];
                            $schedule_speaker = $schedule_speaker_check["yes"]["multi_speakers"];
                              if($schedule_speaker_check["style"]=="yes"){ //multi speaker style 
                                 $schedule_speaker_multi = $schedule_speaker_check["yes"]['multi_speakers'];
                                    foreach($schedule_speaker_multi as $sp_key => $speaker){
                                       $multiple_speaker[] =exhibz_meta_option($speaker,"exhibs_photo"); 
                                       $single_sp = get_post( $speaker );
                                       if($sp_key==0){
                                          $speaker_one = $single_sp->post_title;
                                          $speaker_id_one = $single_sp->ID;
                                       }
                                       if($sp_key==1){
                                          $speaker_two = $single_sp->post_title;
                                          $speaker_id_two = $single_sp->ID;
                                       }
                                       if($sp_key==2){
                                          $speaker_three = $single_sp->post_title;
                                          $speaker_id_three = $single_sp->ID;
                                       }
                                    }
                              
                                    // get speaker name
                                    $args = [
                                       'post_type'      => 'ts-speaker',
                                       'posts_per_page' => 3,
                                       'post__in'  =>$schedule_speaker_multi,
                                    ];
                                 
                                    $q = get_posts( $args ,ARRAY_A );
                              }else{//single speaker  

                                 if(is_string($schedule["speakers"]) && $schedule["speakers"]!='' ) {
                                    $multiple_speaker[] = exhibz_meta_option($schedule["speakers"],"exhibs_photo"); 
                                       if( $schedule["speakers"]!='' && $schedule["speakers"]>0 ){
                                        
                                          $q = get_post( $schedule["speakers"]  );
                                          $speaker_one = $q->post_title;
                                          $speaker_id_one = $q->ID;
                                       } 
                                 }// single speaker
                           }
                            
                         }
                      } else {
                          
                           if(is_string($schedule["speakers"]) && $schedule["speakers"]!='' ) {
                              $multiple_speaker[] = exhibz_meta_option($schedule["speakers"],"exhibs_photo"); 
                                 if( $schedule["speakers"]!='' && $schedule["speakers"]>0 ){
                                      $q = get_post( $schedule["speakers"] );
                                       $speaker_one = $q->post_title;
                                       $speaker_id_one = $q->ID;
                                 } 
                            }// single speaker

                  }

                    
                
                   ?>  
                  <div class="schedule-listing multi-schedule-list">
                     <div class="schedule-slot-time">
                        <span> <?php echo esc_attr($schedule["schedule_time"]); ?> </span>
                      
                     </div>
                     <div class="schedule-slot-info">
                     <?php  if(count($multiple_speaker)): ?>
                         <div class="<?php echo count($multiple_speaker)==1?'single-speaker':'multi-speaker' ?>"> 
                              <?php foreach($multiple_speaker as $key => $value){ ?>
                                 <div class="speaker-content"> 
                                    <?php if(isset($value['attachment_id'])): ?>
                                          <?php ++$key; if($key==1): ?>
                                            <a target="_blank" href="<?php echo esc_url(get_the_permalink($speaker_id_one)); ?>"> <img class="schedule-slot-speakers <?php echo esc_attr("speaker-img-".$key); ?>" src="<?php echo wp_get_attachment_url($value["attachment_id"],'thumbnail'); ?>" title="<?php echo esc_attr($speaker_one); ?>" alt="<?php echo esc_attr("speaker-".$key); ?>"> </a>
                                          <?php elseif($key==2): ?>
                                            <a target="_blank" href="<?php echo esc_url(get_the_permalink($speaker_id_two)); ?>"> <img class="schedule-slot-speakers <?php echo esc_attr("speaker-img-".$key); ?>" src="<?php echo wp_get_attachment_url($value["attachment_id"],'thumbnail'); ?>" title="<?php echo esc_attr($speaker_two); ?>" alt="<?php echo esc_attr("speaker-".$key); ?>"> </a>
                                          <?php elseif($key==3): ?>
                                            <a target="_blank" href="<?php echo esc_url(get_the_permalink($speaker_id_three)); ?>"> <img class="schedule-slot-speakers <?php echo esc_attr("speaker-img-".$key); ?>" src="<?php echo wp_get_attachment_url($value["attachment_id"],'thumbnail'); ?>" title="<?php echo esc_attr($speaker_three); ?>" alt="<?php echo esc_attr("speaker-".$key); ?>"> </a>
                                          <?php endif; ?>
                                    <?php endif; ?>
                                      <p class="schedule-speaker <?php echo esc_attr("speaker-".$key); ?>">
                                           <?php if($key==1): ?>
                                             <?php echo exhibz_kses($speaker_one); ?>
                                             <?php elseif($key==2): ?>
                                             <?php echo exhibz_kses($speaker_two); ?>
                                             <?php elseif($key==3): ?>
                                             <?php echo exhibz_kses($speaker_three); ?>
                                           <?php endif; ?>
                                       </p>
                                    </div>   
                              <?php } ?>
                        </div>
                      <?php elseif($schedule["speakers"]==''): ?> 
                         <div class="single-speaker"></div>  
                     <?php  endif; ?>
                        <div class="schedule-slot-info-content">
                        
                           <h3 class="schedule-slot-title">
                              <?php echo esc_attr($schedule["schedule_title"]); ?>
                              <!-- <strong>@ Fredric Martinsson </strong> -->
                           </h3>
                           <p> 
                              <?php echo exhibz_kses($schedule["schedule_note"]); ?>
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

                     if($key==$schedule_limit){
                        break;
                     }
                     
                     $speaker_one = '';
                     $speaker_two = '';
                     $speaker_three = '';

                     $speaker_id_one = '';
                     $speaker_id_two = '';
                     $speaker_id_three = '';

                     $schedule_speaker_multi = [];
                    
                     $q=[];
                     $multiple_speaker = [];
                  
                     if(array_key_exists("multi_speaker_choose",$schedule)){
                        if(array_key_exists("style",$schedule["multi_speaker_choose"])) {
                            $schedule_speaker_check = $schedule["multi_speaker_choose"];
                            $schedule_speaker = $schedule_speaker_check["yes"]["multi_speakers"];
                              if($schedule_speaker_check["style"]=="yes"){ //multi speaker style 
                                 $schedule_speaker_multi = $schedule_speaker_check["yes"]['multi_speakers'];
                                    foreach($schedule_speaker_multi as $sp_key => $speaker){
                                       $multiple_speaker[] =exhibz_meta_option($speaker,"exhibs_photo"); 
                                       $single_sp = get_post( $speaker );
                                       
                                       if($sp_key==0){
                                          $speaker_one = $single_sp->post_title;
                                          $speaker_id_one = $single_sp->ID;
                                          
                                       }
                                       if($sp_key==1){
                                          $speaker_two = $single_sp->post_title;
                                          $speaker_id_two = $single_sp->ID;
                                       }
                                       if($sp_key==2){
                                          $speaker_three = $single_sp->post_title;
                                          $speaker_id_three = $single_sp->ID;
                                       }
                                    }
                              
                                  
                              }else{//single speaker  

                                 if(is_string($schedule["speakers"]) && $schedule["speakers"]!='' ) {
                                    $multiple_speaker[] = exhibz_meta_option($schedule["speakers"],"exhibs_photo"); 
                                       if( $schedule["speakers"]!='' && $schedule["speakers"]>0 ){
                                          $q = get_post( $schedule["speakers"] );
                                          $speaker_one = $q->post_title;
                                          $speaker_id_one = $q->ID;
                                       } 
                                 }// single speaker
                           }
                            
                         }
                      } else {
                          
                           if(is_string($schedule["speakers"]) && $schedule["speakers"]!='' ) {
                              $multiple_speaker[] = exhibz_meta_option($schedule["speakers"],"exhibs_photo"); 
                                 if( $schedule["speakers"]!='' && $schedule["speakers"]>0 ){
                                    $q = get_post( $schedule["speakers"]  );
                                    $speaker_one = $q->post_title;
                                    $speaker_id_one = $q->ID;
                                 } 
                            }// single speaker

                  }

                  
                
                   ?>   
                  <div class="schedule-listing multi-schedule-list">
                     <div class="schedule-slot-time">
                        <span> <?php echo esc_attr($schedule["schedule_time"]); ?> </span>
                       
                     </div>
                     <div class="schedule-slot-info">
                     <?php  if(count($multiple_speaker)): ?>
                        <div class="<?php echo count($multiple_speaker)==1?'single-speaker':'multi-speaker' ?>"> 
                        <?php foreach($multiple_speaker as $key=>$value) { ?>
                             <div class="speaker-content"> 
                              <?php ++$key; if(isset($value['attachment_id'])): ?>
                                       <?php if($key==1): ?>
                                             <a target="_blank" href="<?php echo esc_url(get_the_permalink($speaker_id_one)); ?>"> <img class="schedule-slot-speakers <?php echo esc_attr("speaker-img-".$key); ?>" src="<?php echo wp_get_attachment_url($value["attachment_id"],'thumbnail'); ?>" title="<?php echo esc_attr($speaker_one); ?>" alt="<?php echo esc_attr("speaker-".$key); ?>"> </a>
                                       <?php elseif($key==2): ?>
                                             <a target="_blank" href="<?php echo esc_url(get_the_permalink($speaker_id_two)); ?>"> <img class="schedule-slot-speakers <?php echo esc_attr("speaker-img-".$key); ?>" src="<?php echo wp_get_attachment_url($value["attachment_id"],'thumbnail'); ?>" title="<?php echo esc_attr($speaker_two); ?>" alt="<?php echo esc_attr("speaker-".$key); ?>"> </a>
                                       <?php elseif($key==3): ?>
                                             <a target="_blank" href="<?php echo esc_url(get_the_permalink($speaker_id_three)); ?>"> <img class="schedule-slot-speakers <?php echo esc_attr("speaker-img-".$key); ?>" src="<?php echo wp_get_attachment_url($value["attachment_id"],'thumbnail'); ?>" title="<?php echo esc_attr($speaker_three); ?>" alt="<?php echo esc_attr("speaker-".$key); ?>"> </a>
                                       <?php endif; ?>
                                <?php endif; ?>
                              <p class="schedule-speaker <?php echo esc_attr("speaker-".$key); ?>">
                                             <?php if($key==1): ?>
                                             <?php echo exhibz_kses($speaker_one); ?>
                                             <?php elseif($key==2): ?>
                                             <?php echo exhibz_kses($speaker_two); ?>
                                             <?php elseif($key==3): ?>
                                             <?php echo exhibz_kses($speaker_three); ?>
                                             <?php endif; ?>
                                 </p>
                            </div>  
                        <?php } ?>
                        </div>
                      <?php elseif($schedule["speakers"]==''): ?> 
                         <div class="single-speaker"></div>  
                     <?php  endif; ?>
                        <div class="schedule-slot-info-content">
                        
                           <h3 class="schedule-slot-title">
                              <?php echo esc_attr($schedule["schedule_title"]); ?>
                              <!-- <strong>@ Fredric Martinsson </strong> -->
                           </h3>
                           <p> 
                              <?php echo exhibz_kses($schedule["schedule_note"]); ?>
                           </p>
                        </div>
                        <!--Info content end -->
                     </div>
                     <!-- Slot info end -->
                  </div>
                  <?php  $multiple_speaker = array(); $q = '';  } // end loop schedule list ?>  
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