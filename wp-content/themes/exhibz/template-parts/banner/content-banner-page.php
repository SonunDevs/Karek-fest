<?php 
$banner_image	= '';
$banner_title = '';
$header_style = 'classic';

if ( defined( 'FW' ) ) { 


    $banner_settings = exhibz_option('page_banner_setting'); 
    $banner_image   = exhibz_meta_option( get_the_ID(), 'header_image' );
    $header_style        = exhibz_option('header_layout_style', 'classic');


      //title

    if(exhibz_meta_option( get_the_ID(), 'header_title' ) != ''){
        $banner_title  = exhibz_meta_option( get_the_ID(), 'header_title' );
    }elseif($banner_settings['banner_page_title'] != ''){
        $banner_title = $banner_settings['banner_page_title'];
    }
    
    //image
    if(is_array($banner_image) && $banner_image['url'] != '' ){
        $banner_image = $banner_image['url'];
    }elseif( is_array($banner_settings['banner_page_image']) && $banner_settings['banner_page_image']['url'] != ''){
          $banner_image = $banner_settings['banner_page_image']['url'];
    }else{
      
        $banner_image = EXHIBZ_IMG.'/banner/about-banner.jpg';
    }
     
   $show = (isset($banner_settings['page_show_banner'])) ? $banner_settings['page_show_banner'] : 'yes'; 
   // breadcumb
   $show_breadcrumb =  (isset($banner_settings['page_show_breadcrumb'])) ? $banner_settings['page_show_breadcrumb'] : 'yes';

 
 }else{
     //default
     $banner_image = EXHIBZ_IMG.'/banner/banner_bg.jpg';
     $banner_title = get_the_title();
     $show = 'yes';
     $show_breadcrumb = 'no';
 }
 if( $banner_image != ''){
    $banner_image = 'style="background-image:url('.esc_url( $banner_image ).');"';
}

$banner_heading_class = '';
if($header_style=="classic"):
   $banner_heading_class     = "mt-80";   
endif;  
?>

<?php if(isset($show) && $show == 'yes'): ?>
<div id="page-banner-area" class="page-banner-area" <?php echo wp_kses_post( $banner_image ); ?>>
         <!-- Subpage title start -->
         <div class="page-banner-title <?php echo esc_attr($banner_heading_class); ?>">
            <div class="text-center">
           <?php if($banner_title!=''): ?>   
            <p class="banner-title">
               <?php echo esc_html($banner_title); ?> 
            </p>
          <?php endif; ?>
               <?php if(isset($show_breadcrumb) && $show_breadcrumb == 'yes'): ?>
                            <?php exhibz_get_breadcrumbs(' / '); ?>
               <?php endif; ?>
            </div>
         </div><!-- Subpage title end -->
</div><!-- Page Banner end -->
<?php endif; ?>