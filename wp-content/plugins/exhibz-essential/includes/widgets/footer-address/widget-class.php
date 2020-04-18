<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

/**
 * Creates widget with recent post thumbnail
 */

class Exhibz_Footer_Address extends WP_Widget
{
    function __construct() {
        $widget_opt = array(
            'classname'     => 'exhibz-footer-address',
            'description'   => esc_html__('Exhibz footer address','exhibz-essntial')
        );
        
        parent::__construct('xs-footer-address', esc_html__('Exhibz footer address', 'exhibz-essntial'), $widget_opt);
    }
    
    function widget( $args, $instance ){
        
        echo exhibz_return($args['before_widget']);
        if ( !empty( $instance[ 'title' ] ) ) {

            echo exhibz_return($args[ 'before_title' ]) . apply_filters( 'widget_title', $instance[ 'title' ] ) . exhibz_return($args[ 'after_title' ]);
        }



        if(isset($instance['message'])){
            $message = $instance['message'];
        }else{
            $message = '';
        }
        if(isset($instance['address'])){
            $address = $instance['address'];
            $address_arr = array('q' => $address);
            $query_string = http_build_query($address_arr);
        }else{
            $address = '';
            $query_string = '';
        }
        if(isset($instance['mobile'])){
            $mobile = $instance['mobile'];
        }else{
            $mobile = '';
        }
        if(isset($instance['media_icon'])){
            $media_icon = $instance['media_icon'];
        }else{
            $media_icon = '';
        }
        if(isset($instance['map_icon'])){
            $map_icon = $instance['map_icon'];
        }else{
            $map_icon = '';
        }
        if(isset($instance['map_btn'])){
            $map_btn = $instance['map_btn'];
        }else{
            $map_btn = '';
        }
        
        ?>
        <div class="media xs-footer-info-and-payment">

            <?php if($media_icon != ''): ?>
                <span class="<?php echo esc_html($media_icon); ?> d-flex"></span>
            <?php endif; ?>

            <div class="media-body">
                <h5>
                    <?php if($message != ''): ?>
                        <?php echo esc_html($message); ?>
                    <?php endif; ?>
                    <?php if($mobile != ''): ?>
                        <strong>
                            <?php echo esc_html($mobile); ?>
                        </strong>
                    <?php endif; ?>
                </h5>
                <?php if($address != ''): ?>
                    <address>
                        <?php echo esc_html($address); ?>
                    </address>
                <?php endif; ?>
                <?php if($map_btn != ''): ?>
                    <a href="https://maps.google.com/maps?<?php echo exhibz_return($query_string);?>" class="xs-map-popup btn btn-primary">
                        <?php if($map_icon != ''): ?>
                            <i class="<?php echo esc_html($map_icon); ?>"></i>
                        <?php endif; ?>
                        <?php echo esc_html($map_btn); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <?php
        echo exhibz_return($args['after_widget']);
    }
    
    
    function update ( $old_instance , $new_instance) {
        $new_instance['title'] = strip_tags( $old_instance['title'] );
        $new_instance['address'] = $old_instance['address'];
        $new_instance['message'] = $old_instance['message'];
        $new_instance['media_icon'] = $old_instance['media_icon'];
        $new_instance['map_icon'] = $old_instance['map_icon'];
        $new_instance['map_btn'] = $old_instance['map_btn'];
        $new_instance['mobile'] = $old_instance['mobile'];

        return $new_instance;
    	
    }
    
    function form($instance){
    	if(isset($instance['title'])){
            $title = $instance['title'];
        }
        else{
            $title = esc_html__( 'Footer address', 'exhibz-essntial' );
        }
        if(isset($instance['message'])){
            $message = $instance['message'];
        }else{
            $message = '';
        }
        if(isset($instance['address'])){
            $address = $instance['address'];
        }else{
            $address = '';
        }
        if(isset($instance['mobile'])){
            $mobile = $instance['mobile'];
        }else{
            $mobile = '';
        }
        if(isset($instance['media_icon'])){
            $media_icon = $instance['media_icon'];
        }else{
            $media_icon = '';
        }
        if(isset($instance['map_icon'])){
            $map_icon = $instance['map_icon'];
        }else{
            $map_icon = '';
        }
        if(isset($instance['map_btn'])){
            $map_btn = $instance['map_btn'];
        }else{
            $map_btn = '';
        }


        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'exhibz-essntial' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'message' )); ?>"><?php esc_html_e( 'Message' , 'exhibz-essntial' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'message' )); ?>"
                   name="<?php echo esc_attr($this->get_field_name( 'message' )); ?>" type="text"
                   value="<?php echo esc_attr( $message ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'address' )); ?>"><?php esc_html_e( 'Address:' , 'exhibz-essntial' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'address' )); ?>" 
                       name="<?php echo esc_attr($this->get_field_name( 'address' )); ?>" type="text" 
                       value="<?php echo esc_attr( $address ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'mobile' )); ?>"><?php esc_html_e( 'Mobile:' , 'exhibz-essntial' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'mobile' )); ?>" 
                       name="<?php echo esc_attr($this->get_field_name( 'mobile' )); ?>" type="text" 
                       value="<?php echo esc_attr( $mobile ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'media_icon' )); ?>"><?php esc_html_e( 'Media icon:' , 'exhibz-essntial' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'media_icon' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'media_icon' )); ?>" type="text"
                       value="<?php echo esc_attr( $media_icon ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'map_icon' )); ?>"><?php esc_html_e( 'Map icon:' , 'exhibz-essntial' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'map_icon' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'map_icon' )); ?>" type="text"
                       value="<?php echo esc_attr( $map_icon ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'map_btn' )); ?>"><?php esc_html_e( 'Map button:' , 'exhibz-essntial' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'map_btn' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'map_btn' )); ?>" type="text"
                       value="<?php echo esc_attr( $map_btn ); ?>" />
        </p>
        
    <?php
    }
}
