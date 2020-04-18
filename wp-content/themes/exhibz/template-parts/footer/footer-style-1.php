<?php
   $footer_bg              = exhibz_option("footer_bg_color");
   $footer_copyright_color = exhibz_option("footer_copyright_color");
   
   if ( $footer_bg!='' ) {
      $footer_bg = "style='background-color:{$footer_bg}'";
   }

   if ( $footer_copyright_color!='' ) {
      $footer_copyright_color = "style='color:{$footer_copyright_color}'";
   }
    

?>
  
  <footer class="ts-footer" <?php echo wp_kses_post($footer_bg); ?> >
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                  <?php if ( defined( 'FW' ) ) : ?>
                    <div class="ts-footer-social text-center mb-30">
                        <ul>
                            <?php 
                                $social_links = exhibz_option('footer_social_links',[]);
                                foreach($social_links as $sl):
                                $class = 'ts-' . str_replace('fa fa-', '', $sl['icon_class']);
                            ?>
                            <li class="<?php echo esc_attr($class); ?>">
                                <a href="<?php echo esc_url($sl['url']); ?>" target="_blank">
                                    <i class="<?php echo esc_attr($sl['icon_class']); ?>"></i>
                                    <span><?php esc_html_e($sl['title'], 'exhibz'); ?></span>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>   
                    <!-- footer social end-->

                    <?php if ( has_nav_menu( 'footermenu' ) ) : ?>
                        <div class="footer-menu text-center mb-25">
                            <?php
                                // footer Nav
                                wp_nav_menu( array(
                                    'theme_location' => 'footermenu',
                                    'depth'          => 1,
                                 
                                ) );
                            ?>
                        </div><!-- footer menu end-->
                    <?php endif; ?>
                    
                    <div class="copyright-text text-center">
                    <p <?php echo wp_kses_post($footer_copyright_color); ?>>
                    <?php 
                        $copyright_text = exhibz_option('footer_copyright', '&copy; 2019, Exhibz. All rights reserved');
                        echo exhibz_kses($copyright_text);                                
                    ?></p>
                    </div>
                      <?php 
             
                        $back_top=exhibz_option('back_to_top');
             
                      ?> 
                    <?php if($back_top=="yes"): ?>  
                    <div class="BackTo">
                     <a href="#" class="fa fa-angle-up" aria-hidden="true"></a>
                     </div>
                    <?php endif; ?>  
                </div>
            </div>
        </div>
    </footer>
