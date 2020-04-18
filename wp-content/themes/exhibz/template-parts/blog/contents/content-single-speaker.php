

<article id="post-<?php the_ID(); ?>" <?php post_class( ' post-details' ); ?>>
		<!-- Article content -->
		<?php 
				     
				$exhibs_designation = exhibz_meta_option(get_the_id(),'exhibs_designation'); 
				$exhibs_photo   = exhibz_meta_option(get_the_id(),'exhibs_photo'); 
				$exhibs_logo    = exhibz_meta_option(get_the_id(),'exhibs_logo'); 
				$exhibs_summery = exhibz_meta_option(get_the_id(),'exhibs_summery'); 
				$socials         = exhibz_meta_option(get_the_id(),'social'); 
				
				$scheduled = exhibz_get_all_schedule();
				
				$sorted_speaker_schedule = exhibz_get_speaker_schedule_array_reduced(get_the_id(),$scheduled);  
			?>

		<div class="entry-content clearfix ts-single-speaker">
			<div class="row">
				<div class="col-md-4">
					<div class="speaker-content">
						<div class="speaker-exhibs_photo">
							<img src="<?php echo isset($exhibs_photo['url'])? $exhibs_photo['url']:''; ?> " />
						</div>

						<h2 class="ts-title ts-speaker-title"><?php echo esc_html(get_the_title()); ?></h2>
						<div class="speaker-designation">
							<?php echo $exhibs_designation; ?>
						</div>

						<div class="speaker-exhibs_logo">
						  <img src="<?php echo isset($exhibs_logo['url'])?$exhibs_logo['url']:''; ?>" />
						</div>
						<div class="speaker-exhibs_summery">
							<?php echo $exhibs_summery; ?>
                  </div>
						<ul class="ts-social-list">
							<?php foreach ($socials as $social): ?>
								<li>
									<a href="<?php echo esc_url($social['option_site_link']); ?>"> <i class="<?php echo esc_attr($social['option_site_icon']); ?>"></i></a>
								</li>
							<?php endforeach; ?>
						</ul>		

               </div>	
				</div>
				<div class="col-lg-8">
					<div class="speaker-schedule single-speaker-schedule">
							<?php foreach ($sorted_speaker_schedule as $val): ?>
									<div class="schedule-listing">
										<div class="schedule-slot-time">
												
											<span> <?php echo esc_html($val['schedule_time']); ?> </span>
										</div>
										<div class="schedule-slot-info">
											<div class="schedule-slot-info-content">
											<p class="schedule-speaker speaker-1"> 
												<?php echo esc_html($val['schedule_day']); ?>   
												<span><?php echo esc_html($val['post_title']); ?></span>
											</p>
												<h3 class="schedule-slot-title">
													<?php echo esc_html($val['schedule_title']); ?>         
												</h3>
												<div>
													<?php echo wp_kses_post($val['schedule_note']); ?>
													</div>
											</div>
											<!--Info content end -->
										</div>
										<!-- Slot info end -->
									</div>
						
								<?php endforeach; ?>
						</div>
				</div>
			</div>

			<?php
		     
			if ( is_search() ) {
				the_excerpt();
			} else {
				the_content( esc_html__( 'Continue reading &rarr;', 'exhibz' ) );
				exhibz_link_pages();
			}

			?>
		</div> <!-- end entry-content -->
</article>
