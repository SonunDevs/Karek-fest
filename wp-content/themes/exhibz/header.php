<?php
/**
 * The header template for the theme
 */
?>
<!DOCTYPE html>
<!--[if !IE]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>

	<?php 
         
      $header_style             = exhibz_option('header_layout_style', 'standard');
      $page_override_header     = exhibz_meta_option(get_the_ID(),'page_header_override', 'no');
      $page_header_layout_style = exhibz_meta_option(get_the_ID(),'page_header_layout_style','standard');
    
      if(function_exists( '_dev_site_style_control' ) && $page_override_header=='yes'):
        $header_style = $page_header_layout_style;
      endif;  
      // if($page_override_header=='yes'):
      //   $header_style = $page_header_layout_style;
      // endif;  

      get_template_part( 'template-parts/headers/header', $header_style );
	?>