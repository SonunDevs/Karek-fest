<?php
   
   

   if ( defined( 'FW' ) ) { 
	$button_settings = exhibz_option('header_cta_button_settings');
	//Page settings
	$header_btn_show = $button_settings['header_btn_show'];
	$header_btn_url = $button_settings['header_btn_url'];
   $header_btn_title = $button_settings['header_btn_title'];
  
   }else{

	$header_btn_show = 'no';
	$header_btn_url = '#';
	$header_btn_title = ' Buy Ticket ';
   }
?>

<!-- header nav start-->
<header id="header" class="header nav-center-logo header-transparent h-transparent2 nav-center <?php echo exhibz_option('header_nav_sticky_section','no')=="yes"?"navbar-fixed":''; ?> ">
	<div class="container">
          
      

         <?php if(exhibz_text_logo()): ?>
			     	<h1 class="logo-title">
			        	<a rel='home' class="logo center" href="<?php echo esc_url(home_url('/')); ?>">
                           <?php echo esc_html(exhibz_text_logo()); ?>
                        </a>
					</h1>	
				<?php else: ?>		
					<a class="navbar-brand logo" href="<?php echo esc_url(home_url( '/' )); ?>">
								<img src="<?php 
									echo esc_url(
										exhibz_src(
											'general_main_logo',
                                 EXHIBZ_IMG . '/logo/logo_header.png'
										)
									);
								?>" alt="<?php bloginfo('name'); ?>">
					</a>
				<?php endif; ?>

			
				<?php get_template_part( 'template-parts/navigations/nav', 'primary' ); ?>

	
	</div><!--Container end -->
</header><!-- Header end -->
