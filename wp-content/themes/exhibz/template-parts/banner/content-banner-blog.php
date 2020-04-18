<?php 
   $banner_image =  '';
   $banner_title = '';
   $banner_subtitle = '';
   $header_style = 'classic';

if ( defined( 'FW' ) ) { 
   $banner_settings = exhibz_option('blog_banner_setting'); 
   $header_style        = exhibz_option('header_layout_style', 'classic');
   
   //image
   $banner_image = ( is_array($banner_settings['banner_blog_image']) && $banner_settings['banner_blog_image']['url'] != '') ? 
                        $banner_settings['banner_blog_image']['url'] : EXHIBZ_IMG.'/banner/banner_bg.jpg';

   //title 
   $banner_title = (isset($banner_settings['banner_blog_title']) && $banner_settings['banner_blog_title'] != '') ? 
                        $banner_settings['banner_blog_title'] : get_bloginfo( 'name' );
   //show
   $show = (isset($banner_settings['blog_show_banner'])) ? $banner_settings['blog_show_banner'] : 'yes'; 
    
   //breadcumb 
   $show_breadcrumb =  (isset($banner_settings['blog_show_breadcrumb'])) ? $banner_settings['blog_show_breadcrumb'] : 'yes';

 }else{
     //default
   $banner_image = EXHIBZ_IMG.'/banner/banner_bg.jpg';
   $banner_title = get_bloginfo( 'name' );
   $show = 'yes';
   $show_breadcrumb = 'no';
     
 }
 if( isset($banner_image) && $banner_image != ''){
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
      
         <p class="banner-title">
         <?php 
            if(is_archive()){
            the_archive_title();
         }else{
           echo esc_html($banner_title);
         }
         ?> 
         </p> 
      
      
      <?php if(isset($show_breadcrumb) && $show_breadcrumb == 'yes'): ?>
            <?php exhibz_get_breadcrumbs(' / '); ?>
      <?php endif; ?>
      </div>
   </div><!-- Subpage title end -->
</div><!-- Page Banner end -->
<?php endif; ?>