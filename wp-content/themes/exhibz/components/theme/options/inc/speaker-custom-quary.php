<?php 

$args=array(
    'post_type'       => 'ts-speaker',
    'order'           => 'ASC', 
    'post_status'     => 'publish',
    'posts_per_page'  => -1,
);
$speaker_quary_data = new WP_Query($args);
$posts = $speaker_quary_data->posts;
$speaker_list = [];
$multi_speaker_list = [];
$speaker_list['']  = ["text"=>'Break'];
foreach($posts as $post) {
   $speaker_list[$post->ID]  = ["text"=>$post->post_title];
   $multi_speaker_list[$post->ID]  = [$post->post_title];

}


