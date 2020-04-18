<?php
/*
 * Template Name: HomePage Template
 *  */

get_header();
while (have_posts()) :
    the_post();
    the_content();
endwhile;
get_footer();