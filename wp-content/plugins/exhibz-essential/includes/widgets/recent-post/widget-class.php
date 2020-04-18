<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * recent post widget
 */
class Exhibz_Recent_Post extends WP_Widget {

	function __construct() {

		$widget_opt = array(
			'classname'		 => 'exhibz-widget',
			'description'	 => esc_html__('Recent post with thumbnail','exhibz-essntial')
		);

		parent::__construct( 'xs-recent-post', esc_html__( 'Exhibz recent post', 'exhibz-essntial' ), $widget_opt );
	}

	function widget( $args, $instance ) {

		global $wp_query;

		echo exhibz_return($args[ 'before_widget' ]);

		if ( !empty( $instance[ 'title' ] ) ) {

			echo exhibz_return($args[ 'before_title' ]) . apply_filters( 'widget_title', $instance[ 'title' ] ) . exhibz_return($args[ 'after_title' ]);
		}

		if ( !empty( $instance[ 'number_of_posts' ] ) ) {
			$no_of_post = $instance[ 'number_of_posts' ];
		} else {
			$no_of_post = 3;
		}


		$query = array(
			'post_type'		 => array( 'post' ),
			'post_status'	 => array( 'publish' ),
			'orderby'		 => 'date',
			'order'			 => 'DESC',
			'posts_per_page' => $no_of_post
		);  

		$loop = new WP_Query( $query );
		?>
		<div class="widget-posts">
			<?php
			if ( $loop->have_posts() ):
				while ( $loop->have_posts() ):
					$loop->the_post();
					?>
					<div class="widget-post media">
						<?php
							$thumbnail	 = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), '' );
							$img  = fw_resize( $thumbnail[ 0 ], 70, 70,true );
							echo '<a href="'.get_the_permalink().'"><img src="' . esc_url( $img ) . '" alt="' . esc_attr__('thumb','exhibz-essntial') . '"></a>';
							?>
						<div class="media-body">
							<span class="post-meta-date"> 
								<?php echo get_the_time( 'd M, Y' ); ?>
							</span>
							<h5 class="entry-title">
								<a href="<?php echo get_the_permalink(); ?>" ><?php echo get_the_title();?></a>
							</h5>
							<span class="post-author">
								<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php echo get_the_author(); ?></a>
							</span>
						</div>
					</div>

				<?php endwhile; ?>
			<?php else: ?>
				<div class="nopost_message">
					<p><?php echo esc_html__( 'No post avainable', 'exhibz-essntial' ) ?></p>';
				</div>
			<?php endif; ?>  
			</div>
		<?php
		wp_reset_postdata();
		echo exhibz_return($args[ 'after_widget' ]);
	}

	function update( $new_instance, $old_instance ) {

		$old_instance[ 'title' ]			 = strip_tags( $new_instance[ 'title' ] );
		$old_instance[ 'number_of_posts' ] = $new_instance[ 'number_of_posts' ];

		return $old_instance;
	}

	function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = esc_html__( 'Recent posts', 'exhibz-essntial' );
		}
		if ( isset( $instance[ 'number_of_posts' ] ) ) {
			$no_of_post = $instance[ 'number_of_posts' ];
		} else {
			$no_of_post = 3;
		}
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'exhibz-essntial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number_of_posts' ) ); ?>"><?php esc_html_e( 'Number of posts:', 'exhibz-essntial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number_of_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_of_posts' ) ); ?>" type="text" value="<?php echo esc_attr( $no_of_post ); ?>" />
		</p>
		<?php
	}

}
