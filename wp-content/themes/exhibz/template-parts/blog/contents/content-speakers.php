<?php 
  // speaker details
  $exhibs_designation = exhibz_meta_option(get_the_id(),'exhibs_designation'); 
  $exhibs_photo       = exhibz_meta_option(get_the_id(),'exhibs_photo'); 
  $exhibs_logo        = exhibz_meta_option(get_the_id(),'exhibs_logo'); 
  $exhibs_summery     = exhibz_meta_option(get_the_id(),'exhibs_summery'); 
  $socials            = exhibz_meta_option(get_the_id(),'social'); 

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'ts-speaker post-details ts-single-speaker archive col-md-6 col-lg-3' ); ?>>

    <div class="speaker-content">
        <div class="speaker-img">
           <a href="<?php echo esc_url(get_the_permalink()); ?>">  <img src="<?php echo isset($exhibs_photo['url'])? $exhibs_photo['url']:''; ?> " /> </a>
        </div>

        <h2 class="ts-title ts-speaker-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"> <?php echo esc_html(get_the_title()); ?></a> </h2>
        <div class="speaker-designation">
            <?php echo esc_html($exhibs_designation); ?>
        </div>
     		
    </div>
	
</article>