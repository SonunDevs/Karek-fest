<nav class="navbar navbar-light xs-navbar navbar-expand-lg">

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#primary-nav" aria-controls="primary-nav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"><i class="icon icon-menu"></i></span>
	</button>

	<?php

   $frontpage_ID	 = exhibz_org_id( get_option( 'page_on_front' ), false );
   $template       = get_page_template_slug($frontpage_ID);

   $nav_arg = [
      'menu'            => 'primary',
      'theme_location'  => 'primary',
      'container'       => 'div',
      'container_id'    => 'primary-nav',
      'container_class' => 'collapse navbar-collapse justify-content-end',
      'menu_id'         => 'main-menu',
      'menu_class'      => 'navbar-nav  main-menu',
      'depth'           => 3,
   ];
   if($template=='template/template-onepage.php'){
      $nav_arg['walker'] = new Exhibz_Custom_Nav_Walker();
      $nav_arg['fallback_cb'] = 'Exhibz_Custom_Nav_Walker::fallback';
   }else{
      $nav_arg['walker'] = new exhibz_navwalker();
      $nav_arg['fallback_cb'] = 'exhibz_navwalker::fallback';
   }

   
	wp_nav_menu($nav_arg);
	?>
</nav>

