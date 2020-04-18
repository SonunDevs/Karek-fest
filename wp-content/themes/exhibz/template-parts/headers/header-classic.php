<?php
 
   if ( defined( 'FW' ) ) { 
	$button_settings = exhibz_option('header_cta_button_settings');
   $header_top_settings = exhibz_option('header_top_settings');

   // header top settings
  $header_contact_icon = $header_top_settings['header_contact_icon'];
  $header_contact_number = $header_top_settings['header_contact_number'];
  $header_contact_mail_icon = $header_top_settings['header_contact_mail_icon'];
  $header_contact_mail = $header_top_settings['header_contact_mail'];
  $header_contact_show = $header_top_settings['header_contact_show'];
	//Page settings
	$header_btn_show = $button_settings['header_btn_show'];
	$header_btn_url = $button_settings['header_btn_url'];
   $header_btn_title = $button_settings['header_btn_title'];
   $header_nav_search = exhibz_option('header_nav_search');
  
   }else{

	$header_btn_show = 'no';
	$header_btn_url = '#';
	$header_btn_title = ' Buy Ticket ';
	$header_nav_search = 'no';
	$header_contact_show = 'no';
   }


?>
<!-- header top area -->
<div class="header-transparent">
<div class="header-top">
   <div class="container">
      <div class="row">
         <div class="col-lg-3 col-md-6 col-6 align-self-center">
               <?php if(exhibz_text_logo()): ?>
                  <h1 class="logo-title">
                     <a rel='home' class="logo" href="<?php echo esc_url(home_url('/')); ?>">
                              <?php echo esc_html(exhibz_text_logo()); ?>
                           </a>
                  </h1>	
               <?php else: ?>		
                  <a class="navbar-brand logo" href="<?php echo esc_url(home_url( '/' )); ?>">
                           <img src="<?php 
                              echo esc_url(
                                 exhibz_src(
                                    'general_main_logo',
                                    EXHIBZ_IMG . '/logo/logo-light.png'
                                 )
                              );
                           ?>" alt="<?php bloginfo('name'); ?>">
                  </a>
               <?php endif; ?>
         </div>
         <!-- col end -->
         <div class="col-lg-9 align-self-center header-top-info col-md-6 col-6">
                  <?php if($header_contact_show == 'yes'): ?>
               <ul class="header-contact-info">
               <?php if($header_contact_number !=''): ?>
                  <li>
                     <i class="<?php echo esc_attr($header_contact_icon ); ?>"></i>
                     <?php echo esc_attr($header_contact_number); ?>
                  </li>
               <?php endif; ?>
               <!-- header contact number end -->
               <?php if($header_contact_mail !=''): ?>
                  <li>
                     <i class="<?php echo esc_attr($header_contact_mail_icon ); ?>"></i>
                     <?php echo esc_attr($header_contact_mail); ?>
                  </li>
               <?php endif; ?>
                 <!-- header contact mail end -->
               </ul> 
               <?php endif; ?>
               <!-- header contact info end -->

               <?php $social_links = exhibz_option('general_social_links',[]);  ?>
                  <ul class="social-links">
                 
                        <?php 
                        
                           if(count($social_links)):   
                              foreach($social_links as $sl):
                                 if( isset( $sl['icon_class']) && isset($sl['ttile']) ) :
                                    $class = 'ts-' . str_replace('fa fa-', '', $sl['icon_class']);
                                    $title = $sl["title"];
                                 endif; 
                        ?>
                              <li>
                                 <a title="<?php echo esc_attr($title); ?>" href="<?php echo esc_url($sl['url']); ?>">
                                 <span class="social-icon">  <i class="<?php echo esc_attr($sl['icon_class']); ?>"></i> </span>
                                 </a>
                              </li>
                        <?php endforeach; ?>
                     <?php endif; ?>
                  </ul>
               <!-- end social links -->
               <?php if($header_btn_show == 'yes'){ ?>
               <ul class="qoute-btn">
                     <li>
                        <a class="ticket-btn btn" href="<?php echo esc_url($header_btn_url); ?>">
                           <?php echo esc_html($header_btn_title); ?>
                        </a>
                     </li>
               </ul>
               <?php } ?>

         </div>
         <!-- col end -->
      </div>
   </div>
</div>

<!-- header nav start-->
<header id="header" class="header  header-classic <?php echo exhibz_option('header_nav_sticky_section','no')=="yes"?"navbar-fixed":''; ?> ">
	<div class="container">
		<div class="row">
			<div class="align-self-center col-lg-11 col-10">
				<?php get_template_part( 'template-parts/navigations/nav', 'primary' ); ?>
         </div>
         <div class="col-2 col-lg-1 align-self-center">
            <div class="nav-search-area">
               <?php if( $header_nav_search=='yes'): ?>
                  <div class="nav-search">
                     <span id="search">
                        <i class="icon icon-search1"></i>
                     </span>
                  </div>
               <?php endif; ?>
                  <!--Search End-->
               <div class="search-block" style="display: none;">
                     <?php get_search_form(); ?>
                     <span class="search-close">×</span>
               </div>
            </div>
         </div>
		</div><!-- Row end -->
	</div><!--Container end -->
</header><!-- Header end -->
 </div>
