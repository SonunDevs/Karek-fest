<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * recent post widget with thumbnails
 */

class Exhibz_Instagram extends WP_Widget
{
    function __construct() {

        $widget_opt = array(
            'classname'     => 'exhibz-widget',
            'description'   => 'exhibz instagrams'
        );
        
        parent::__construct('exhibz-instagram', esc_html__('exhibz instagram', 'exhibz-essntial'), $widget_opt);
    }
    
    function widget( $args, $instance ){

    	$access_token = '';
        $user_id = '';
        $media_count = 10;
        $title = apply_filters( 'widget_title', $instance['title'] );

        if ( ! empty( $title ) ){ 
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }
        if(isset($instance['access_token'])){
            $access_token = $instance['access_token'];
        }
        if(isset($instance['user_id'])){
            $user_id = $instance['user_id'];
        }
        if(isset($instance['media_count'])){
            $media_count = $instance['media_count'];
        }
        

        $data = $this->get_data($access_token,$user_id,$media_count);
        
        ?>
        <div class="instagram_photo">
            <?php if(!empty($data)): ?>
                <?php foreach ($data as $xs_media):?>
                    <a href="<?php echo esc_url($xs_media->link) ?>" target="_blank" ><img src="<?php echo esc_url($xs_media->images->thumbnail->url) ?>"></a>
                <?php endforeach; ?>
            <?php endif; ?>    
        </div>
        <?php
        echo $args['after_widget'];
    }
    
    
    function update ( $new_instance, $old_instance ) {

    	$old_instance['title'] = strip_tags( $new_instance['title'] );
        $old_instance['access_token'] = $new_instance['access_token'];
        $old_instance['user_id'] = $new_instance['user_id'];
        $old_instance['media_count'] = $new_instance['media_count'];

        return $old_instance;
    }
    
    function form($instance){

        $access_token = '';
        $user_id = '';
        $media_count = 10;
        $title = esc_html__( 'Instagram', 'exhibz-essntial' );

    	if(isset($instance['title'])){
            $title = $instance['title'];
        }
        if(isset($instance['access_token'])){
            $access_token = $instance['access_token'];
        }
        if(isset($instance['user_id'])){
            $user_id = $instance['user_id'];
        }
        if(isset($instance['media_count'])){
            $media_count = $instance['media_count'];
        }
        
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'exhibz-essntial' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <a href="https://instagram.com/oauth/authorize/?client_id=3a81a9fa2a064751b8c31385b91cc25c&scope=basic+public_content&redirect_uri=https://smashballoon.com/instagram-feed/instagram-token-plugin/?return_uri=<?php echo admin_url() ?>widgets.php&response_type=token" class="sbi_admin_btn">
            <?php esc_html__( 'Log in and get my Access Token and User ID' , 'exhibz-essntial' ); ?>
            </a>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'access_token' )); ?>"><?php esc_html__( 'Access token:' , 'exhibz-essntial' ); ?></label>
            <input class="widefat xs_access_token" id="<?php echo esc_attr($this->get_field_id( 'access_token' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'access_token' )); ?>" type="text" value="<?php echo esc_attr( $access_token ); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'user_id' )); ?>"><?php esc_html__( 'User ID:' , 'exhibz-essntial' ); ?></label>
            <input class="widefat xs_user_id" id="<?php echo esc_attr($this->get_field_id( 'user_id' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'user_id' )); ?>" type="text" value="<?php echo esc_attr( $user_id ); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'media_count' )); ?>"><?php esc_html__( 'Count:' , 'exhibz-essntial' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'media_count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'media_count' )); ?>" type="text" value="<?php echo esc_attr( $media_count ); ?>" />
        </p>
        <?php
    }

    public function get_data($accessToken, $userId, $count){
        $mediadata = $this->makeRequest($accessToken, $userId, $count);

        if(isset($mediadata->data) && is_array($mediadata->data) && !empty($mediadata->data)){
           return$mediadata->data;
        }
        else{
            if(isset($mediadata->meta) && !empty($mediadata->meta)){
                return $mediadata->meta->error_message;
            }
        }
    }
    private function makeRequest($accessToken, $userId, $count){

        $data = array(
            'access_token' => $accessToken,
            'count' => $count
        );

        $query = http_build_query($data);
        $url = 'https://api.instagram.com/v1/users/'.$userId.'/media/recent/?'.$query;
        $headerData = array('Accept: application/json');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headerData);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = json_decode(curl_exec($ch));
        if (!$result) {
            return 'Error: - cURL error: ' . curl_error($ch);
        }else{
            return $result;
        }
        curl_close($ch);
    }
}
