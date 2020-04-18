<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * social widget
 */
class Exhibz_Social extends WP_Widget {

	function __construct() {
		$widget_opt = array(
			'classname'		 => 'exhibz-widget',
			'description'	 => esc_html__('Exhibz Social','exhibz-essntial')
		);

		parent::__construct( 'xs-social', esc_html__( 'Exhibz social', 'exhibz-essntial' ), $widget_opt );
	}

	function widget( $args, $instance ) {
		global $wp_query;

		echo exhibz_return( $args[ 'before_widget' ] );
		if ( !empty( $instance[ 'title' ] ) ) {

			echo exhibz_return( $args[ 'before_title' ] ) . apply_filters( 'widget_title', $instance[ 'title' ] ) . exhibz_return( $args[ 'after_title' ] );
		}

		$facebook			 = '';
		$twitter			 = '';
		$google				 = '';
		$pinterest			 = '';
		$youtube			 = '';
		$linkedin			 = '';
		$behance			 = '';
		$flickr				 = '';
		$github				 = '';
		$skype				 = '';
		$soundcloud			 = '';
		$stumbleupon		 = '';
		$tumblr				 = '';
		$vimeo				 = '';
		$vine				 = '';
		$vk					 = '';
		$xing				 = '';
		$yelp				 = '';
		$social_alignment	 = 'Center';

		if ( isset( $instance[ 'facebook' ] ) ) {
			$facebook = $instance[ 'facebook' ];
		}
		if ( isset( $instance[ 'twitter' ] ) ) {
			$twitter = $instance[ 'twitter' ];
		}
		if ( isset( $instance[ 'google' ] ) ) {
			$google = $instance[ 'google' ];
		}
		if ( isset( $instance[ 'pinterest' ] ) ) {
			$pinterest = $instance[ 'pinterest' ];
		}
		if ( isset( $instance[ 'youtube' ] ) ) {
			$youtube = $instance[ 'youtube' ];
		}
		if ( isset( $instance[ 'linkedin' ] ) ) {
			$linkedin = $instance[ 'linkedin' ];
		}
		if ( isset( $instance[ 'behance' ] ) ) {
			$behance = $instance[ 'behance' ];
		}
		if ( isset( $instance[ 'flickr' ] ) ) {
			$flickr = $instance[ 'flickr' ];
		}
		if ( isset( $instance[ 'github' ] ) ) {
			$github = $instance[ 'github' ];
		}
		if ( isset( $instance[ 'skype' ] ) ) {
			$skype = $instance[ 'skype' ];
		}
		if ( isset( $instance[ 'soundcloud' ] ) ) {
			$soundcloud = $instance[ 'soundcloud' ];
		}
		if ( isset( $instance[ 'stumbleupon' ] ) ) {
			$stumbleupon = $instance[ 'stumbleupon' ];
		}
		if ( isset( $instance[ 'tumblr' ] ) ) {
			$tumblr = $instance[ 'tumblr' ];
		}
		if ( isset( $instance[ 'vimeo' ] ) ) {
			$vimeo = $instance[ 'vimeo' ];
		}
		if ( isset( $instance[ 'vine' ] ) ) {
			$vine = $instance[ 'vine' ];
		}
		if ( isset( $instance[ 'vk' ] ) ) {
			$vk = $instance[ 'vk' ];
		}
		if ( isset( $instance[ 'xing' ] ) ) {
			$xing = $instance[ 'xing' ];
		}
		if ( isset( $instance[ 'yelp' ] ) ) {
			$yelp = $instance[ 'yelp' ];
		}
		if ( isset( $instance[ 'social_alignment' ] ) ) {
			$social_alignment = $instance[ 'social_alignment' ];
		}
		?>
		<div class="footer-social">
			<ul class="xs-social-list xs-social-list-v6 exhibz-social-list">

		<?php if ( $facebook != '' ): ?>
					<li><a href="<?php echo esc_url( $facebook ); ?>"><i class="fa fa-facebook"></i></a></li>
				<?php endif; ?>

				<?php if ( $twitter != '' ): ?>
					<li><a href="<?php echo esc_url( $twitter ); ?>"><i class="fa fa-twitter"></i></a></li>
				<?php endif; ?>

				<?php if ( $google != '' ): ?>
					<li><a href="<?php echo esc_url( $google ); ?>"><i class="fa fa-google-plus"></i></a></li>
				<?php endif; ?>

				<?php if ( $pinterest != '' ): ?>
					<li><a href="<?php echo esc_url( $pinterest ); ?>"><i class="fa fa-pinterest-p"></i></a></li>
				<?php endif; ?>

				<?php if ( $youtube != '' ): ?>
					<li><a href="<?php echo esc_url( $youtube ); ?>"><i class="fa fa-instagram"></i></a></li>
				<?php endif; ?>

				<?php if ( $linkedin != '' ): ?>
					<li><a href="<?php echo esc_url( $linkedin ); ?>"><i class="fa fa-linkedin"></i></a></li>
				<?php endif; ?>
				<?php if ( $behance != '' ): ?>
					<li><a href="<?php echo esc_url( $behance ); ?>"><i class="fa fa-behance"></i></a></li>
				<?php endif; ?>
				<?php if ( $flickr != '' ): ?>
					<li><a href="<?php echo esc_url( $flickr ); ?>"><i class="fa fa-flickr"></i></a></li>
				<?php endif; ?>
				<?php if ( $github != '' ): ?>
					<li><a href="<?php echo esc_url( $github ); ?>"><i class="fa fa-github"></i></a></li>
				<?php endif; ?>
				<?php if ( $skype != '' ): ?>
					<li><a href="<?php echo esc_url( $skype ); ?>"><i class="fa fa-skype"></i></a></li>
				<?php endif; ?>
				<?php if ( $soundcloud != '' ): ?>
					<li><a href="<?php echo esc_url( $soundcloud ); ?>"><i class="fa fa-soundcloud"></i></a></li>
				<?php endif; ?>
				<?php if ( $stumbleupon != '' ): ?>
					<li><a href="<?php echo esc_url( $stumbleupon ); ?>"><i class="fa fa-stumbleupon"></i></a></li>
				<?php endif; ?>
				<?php if ( $tumblr != '' ): ?>
					<li><a href="<?php echo esc_url( $tumblr ); ?>"><i class="fa fa-tumblr"></i></a></li>
				<?php endif; ?>

				<?php if ( $vimeo != '' ): ?>
					<li><a href="<?php echo esc_url( $vimeo ); ?>"><i class="fa fa-vimeo"></i></a></li>
				<?php endif; ?>

				<?php if ( $vine != '' ): ?>
					<li><a href="<?php echo esc_url( $vine ); ?>"><i class="fa fa-vine"></i></a></li>
				<?php endif; ?>
				<?php if ( $vk != '' ): ?>
					<li><a href="<?php echo esc_url( $vk ); ?>"><i class="fa fa-vk"></i></a></li>
				<?php endif; ?>
				<?php if ( $xing != '' ): ?>
					<li><a href="<?php echo esc_url( $xing ); ?>"><i class="fa fa-xing"></i></a></li>
				<?php endif; ?>

				<?php if ( $yelp != '' ): ?>
					<li><a href="<?php echo esc_url( $yelp ); ?>"><i class="fa fa-yelp"></i></a></li>
				<?php endif; ?>
			</ul>
		</div><!-- Footer social end -->

		<?php
		echo exhibz_return( $args[ 'after_widget' ] );
	}

	function update( $old_instance, $new_instance ) {
		$new_instance[ 'title' ]			 = strip_tags( $old_instance[ 'title' ] );
		$new_instance[ 'facebook' ]			 = $old_instance[ 'facebook' ];
		$new_instance[ 'twitter' ]			 = $old_instance[ 'twitter' ];
		$new_instance[ 'google' ]			 = $old_instance[ 'google' ];
		$new_instance[ 'pinterest' ]		 = $old_instance[ 'pinterest' ];
		$new_instance[ 'youtube' ]			 = $old_instance[ 'youtube' ];
		$new_instance[ 'linkedin' ]			 = $old_instance[ 'linkedin' ];
		$new_instance[ 'behance' ]			 = $old_instance[ 'behance' ];
		$new_instance[ 'flickr' ]			 = $old_instance[ 'flickr' ];
		$new_instance[ 'github' ]			 = $old_instance[ 'github' ];
		$new_instance[ 'skype' ]			 = $old_instance[ 'skype' ];
		$new_instance[ 'soundcloud' ]		 = $old_instance[ 'soundcloud' ];
		$new_instance[ 'stumbleupon' ]		 = $old_instance[ 'stumbleupon' ];
		$new_instance[ 'tumblr' ]			 = $old_instance[ 'tumblr' ];
		$new_instance[ 'vimeo' ]			 = $old_instance[ 'vimeo' ];
		$new_instance[ 'vine' ]				 = $old_instance[ 'vine' ];
		$new_instance[ 'vk' ]				 = $old_instance[ 'vk' ];
		$new_instance[ 'xing' ]				 = $old_instance[ 'xing' ];
		$new_instance[ 'yelp' ]				 = $old_instance[ 'yelp' ];
		$new_instance[ 'social_alignment' ]	 = $old_instance[ 'social_alignment' ];
		return $new_instance;
	}

	function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = esc_html__( 'Social', 'exhibz' );
		}

		$facebook			 = '';
		$twitter			 = '';
		$google				 = '';
		$pinterest			 = '';
		$youtube			 = '';
		$linkedin			 = '';
		$behance			 = '';
		$flickr				 = '';
		$github				 = '';
		$skype				 = '';
		$soundcloud			 = '';
		$stumbleupon		 = '';
		$tumblr				 = '';
		$vimeo				 = '';
		$vine				 = '';
		$vk					 = '';
		$xing				 = '';
		$yelp				 = '';
		$social_alignment	 = 'Center';

		if ( isset( $instance[ 'facebook' ] ) ) {
			$facebook = $instance[ 'facebook' ];
		}
		if ( isset( $instance[ 'twitter' ] ) ) {
			$twitter = $instance[ 'twitter' ];
		}
		if ( isset( $instance[ 'google' ] ) ) {
			$google = $instance[ 'google' ];
		}
		if ( isset( $instance[ 'pinterest' ] ) ) {
			$pinterest = $instance[ 'pinterest' ];
		}
		if ( isset( $instance[ 'youtube' ] ) ) {
			$youtube = $instance[ 'youtube' ];
		}
		if ( isset( $instance[ 'linkedin' ] ) ) {
			$linkedin = $instance[ 'linkedin' ];
		}
		if ( isset( $instance[ 'behance' ] ) ) {
			$behance = $instance[ 'behance' ];
		}
		if ( isset( $instance[ 'flickr' ] ) ) {
			$flickr = $instance[ 'flickr' ];
		}
		if ( isset( $instance[ 'github' ] ) ) {
			$github = $instance[ 'github' ];
		}
		if ( isset( $instance[ 'skype' ] ) ) {
			$skype = $instance[ 'skype' ];
		}
		if ( isset( $instance[ 'soundcloud' ] ) ) {
			$soundcloud = $instance[ 'soundcloud' ];
		}
		if ( isset( $instance[ 'stumbleupon' ] ) ) {
			$stumbleupon = $instance[ 'stumbleupon' ];
		}
		if ( isset( $instance[ 'tumblr' ] ) ) {
			$tumblr = $instance[ 'tumblr' ];
		}
		if ( isset( $instance[ 'vimeo' ] ) ) {
			$vimeo = $instance[ 'vimeo' ];
		}
		if ( isset( $instance[ 'vine' ] ) ) {
			$vine = $instance[ 'vine' ];
		}
		if ( isset( $instance[ 'vk' ] ) ) {
			$vk = $instance[ 'vk' ];
		}
		if ( isset( $instance[ 'xing' ] ) ) {
			$xing = $instance[ 'xing' ];
		}
		if ( isset( $instance[ 'yelp' ] ) ) {
			$yelp = $instance[ 'yelp' ];
		}
		if ( isset( $instance[ 'social_alignment' ] ) ) {
			$social_alignment = $instance[ 'social_alignment' ];
		}
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'exhibz-essntial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>"><?php esc_html_e( 'Facebook:', 'exhibz-essntial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" 
				   name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" type="text" 
				   value="<?php echo esc_attr( $facebook ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>"><?php esc_html_e( 'Twitter:', 'exhibz-essntial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" 
				   name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" type="text" 
				   value="<?php echo esc_attr( $twitter ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'google' ) ); ?>"><?php esc_html_e( 'Google Plus:', 'exhibz-essntial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'google' ) ); ?>" 
				   name="<?php echo esc_attr( $this->get_field_name( 'google' ) ); ?>" type="text" 
				   value="<?php echo esc_attr( $google ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>"><?php esc_html_e( 'Pinterest:', 'exhibz-essntial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>" 
				   name="<?php echo esc_attr( $this->get_field_name( 'pinterest' ) ); ?>" type="text" 
				   value="<?php echo esc_attr( $pinterest ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>"><?php esc_html_e( 'Instagram:', 'exhibz-essntial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" 
				   name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" type="text" 
				   value="<?php echo esc_attr( $youtube ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>"><?php esc_html_e( 'Linkedin:', 'exhibz-essntial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>" 
				   name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>" type="text" 
				   value="<?php echo esc_attr( $linkedin ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'behance' ) ); ?>"><?php esc_html_e( 'behance:', 'exhibz-essntial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'behance' ) ); ?>" 
				   name="<?php echo esc_attr( $this->get_field_name( 'behance' ) ); ?>" type="text" 
				   value="<?php echo esc_attr( $behance ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'flickr' ) ); ?>"><?php esc_html_e( 'flickr:', 'exhibz-essntial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'flickr' ) ); ?>" 
				   name="<?php echo esc_attr( $this->get_field_name( 'flickr' ) ); ?>" type="text" 
				   value="<?php echo esc_attr( $flickr ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'github' ) ); ?>"><?php esc_html_e( 'github:', 'exhibz-essntial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'github' ) ); ?>" 
				   name="<?php echo esc_attr( $this->get_field_name( 'github' ) ); ?>" type="text" 
				   value="<?php echo esc_attr( $github ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'soundcloud' ) ); ?>"><?php esc_html_e( 'soundcloud:', 'exhibz-essntial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'soundcloud' ) ); ?>" 
				   name="<?php echo esc_attr( $this->get_field_name( 'soundcloud' ) ); ?>" type="text" 
				   value="<?php echo esc_attr( $soundcloud ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'skype' ) ); ?>"><?php esc_html_e( 'skype:', 'exhibz-essntial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'skype' ) ); ?>" 
				   name="<?php echo esc_attr( $this->get_field_name( 'skype' ) ); ?>" type="text" 
				   value="<?php echo esc_attr( $skype ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'stumbleupon' ) ); ?>"><?php esc_html_e( 'stumbleupon:', 'exhibz-essntial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'stumbleupon' ) ); ?>" 
				   name="<?php echo esc_attr( $this->get_field_name( 'stumbleupon' ) ); ?>" type="text" 
				   value="<?php echo esc_attr( $stumbleupon ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tumblr' ) ); ?>"><?php esc_html_e( 'tumblr:', 'exhibz-essntial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tumblr' ) ); ?>" 
				   name="<?php echo esc_attr( $this->get_field_name( 'tumblr' ) ); ?>" type="text" 
				   value="<?php echo esc_attr( $tumblr ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'vimeo' ) ); ?>"><?php esc_html_e( 'vimeo:', 'exhibz-essntial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vimeo' ) ); ?>" 
				   name="<?php echo esc_attr( $this->get_field_name( 'vimeo' ) ); ?>" type="text" 
				   value="<?php echo esc_attr( $vimeo ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'vine' ) ); ?>"><?php esc_html_e( 'vine:', 'exhibz-essntial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vine' ) ); ?>" 
				   name="<?php echo esc_attr( $this->get_field_name( 'vine' ) ); ?>" type="text" 
				   value="<?php echo esc_attr( $vine ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'vk' ) ); ?>"><?php esc_html_e( 'vk:', 'exhibz-essntial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vk' ) ); ?>" 
				   name="<?php echo esc_attr( $this->get_field_name( 'vk' ) ); ?>" type="text" 
				   value="<?php echo esc_attr( $vk ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'xing' ) ); ?>"><?php esc_html_e( 'xing:', 'exhibz-essntial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'xing' ) ); ?>" 
				   name="<?php echo esc_attr( $this->get_field_name( 'xing' ) ); ?>" type="text" 
				   value="<?php echo esc_attr( $xing ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'yelp' ) ); ?>"><?php esc_html_e( 'yelp:', 'exhibz-essntial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'yelp' ) ); ?>" 
				   name="<?php echo esc_attr( $this->get_field_name( 'yelp' ) ); ?>" type="text" 
				   value="<?php echo esc_attr( $yelp ); ?>" />
		</p>


		<?php
	}

}
