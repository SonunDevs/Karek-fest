<?php
/**
 * displays sidebar
 */
?>


<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
   <div class="col-lg-4 col-md-12">
      <aside id="sidebar" class="sidebar" role="complementary">
         <?php dynamic_sidebar( 'sidebar-1' ); ?>
      </aside> <!-- #sidebar --> 
   </div><!-- Sidebar col end -->
<?php } ?>