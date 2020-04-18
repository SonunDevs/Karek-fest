<?php 

$tag_list = get_the_tag_list( '', ' ' );

      if ( $tag_list ) {
      echo '<div class="post-tag-container">';
            echo '<div class="tag-lists">';
               echo '<span>' . esc_html__( 'Tags: ', 'exhibz' ) . '</span>';
               echo exhibz_kses( $tag_list );
            echo '</div>';
      echo '</div>';
   }