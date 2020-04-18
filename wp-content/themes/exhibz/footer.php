
   <?php
   
      if ( !defined( 'FW' ) ) {

         get_template_part( 'template-parts/footer/footer', 'style-1' );  

      } else {

         $style = exhibz_option("footer_style","style-1");

         if(is_array($style)){

            if(array_key_exists("style",$style)){
               $style = $style["style"]==''?'style-1':$style["style"];
            }

         } else {

            $style = "style-1";

         }
         
         get_template_part( 'template-parts/footer/footer', $style );
      }



   ?>

   <?php wp_footer(); ?>

   </body>
</html>