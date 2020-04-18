<?php
/**
 * Blog Header
 *
 */
 
$banner_bg	 = $banner_title = $banner_subtitle = '';
 
if ( defined( 'FW' ) ) {
    
    $banner_settings = exhibz_option('shop_banner_settings');
    //Page settings
    $show = (isset($banner_settings['show'])) ? $banner_settings['show'] : 'yes'; 
    $show_breadcrumb = (isset($banner_settings['show_breadcrumb'])) ? $banner_settings['show_breadcrumb'] : 'yes';

    $banner_title = (isset($banner_settings['title']) && $banner_settings['title'] != '') ? 
                        $banner_settings['title'] : esc_html__('Shop','exhibz');
    $single_title = (isset($banner_settings['single_title']) && $banner_settings['single_title'] != '') ? 
                        $banner_settings['single_title'] : esc_html__('Product Details','exhibz');

    $banner_image = ( is_array($banner_settings['image']) && $banner_settings['image']['url'] != '') ? 
                        $banner_settings['image']['url'] : EXHIBZ_IMG.'/banner/banner_bg.jpg';

}else{
    $banner_image =EXHIBZ_IMG.'/banner/banner_bg.jpg';
    $banner_title = esc_html__('Shop','exhibz');
    $single_title = esc_html__('Product Details','exhibz');
    $show = 'yes';
    $show_breadcrumb = 'yes';
}
if( isset($banner_image) && $banner_image != ''){
    $banner_bg = 'style="background-image:url('.esc_url( $banner_image ).');"';
}

if(isset($show) && $show == 'yes'): ?>

<div id="page-banner-area" class="page-banner-area" <?php echo wp_kses_post( $banner_bg ); ?>>
   <!-- Subpage title start -->
   <div class="page-banner-title">
   
      <div class="text-center">
      
         <p class="banner-title">
         <?php 
               if(is_archive()){
                  the_archive_title();
               }elseif(is_product()){
                  echo exhibz_kses( $single_title );
               }else{
                  echo exhibz_kses( $banner_title );
               }
         ?>
         </p> 
      
      
         <?php if($show_breadcrumb == 'yes'): ?>
               <?php woocommerce_breadcrumb(); ?>
         <?php endif; ?>
      </div>
   </div><!-- Subpage title end -->
</div><!-- Page Banner end -->

<?php endif; ?>