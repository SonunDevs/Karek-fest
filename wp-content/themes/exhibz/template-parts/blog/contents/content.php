<?php
/**
 * content.php
 *
 * The default template for displaying content.
 */
?>
   
<article <?php post_class('post');?>>
	<div class="post-media">
		<?php 

		switch(get_post_format()){
			case 'video':
				$video_url	 	=	exhibz_meta_option( get_the_ID(), 'featured_video' );
				$embed_url	 	=	exhibz_video_embed($video_url);
				
				$thumbnail_src 	= 	(has_post_thumbnail()) 
									? get_the_post_thumbnail_url()
									: exhibz_youtube_cover($video_url);
									// if empty, returns null
			

			break;
			case 'audio':
				$soundcloud_url	=	exhibz_soundcloud_embed(
										exhibz_meta_option( get_the_ID(), 'featured_audio' )
									);
	
			
			break; 

			default:
				if ( has_post_thumbnail() ) :
				
					the_post_thumbnail(); 
				endif;
			break;
		}
		?>
	</div><!-- Post Media end -->
	<div class="post-body">
		<div class="entry-header">
			<?php exhibz_post_meta(); ?>
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<?php if ( is_sticky() ) {
					echo '<sup class="meta-featured-post"> <i class="fa fa-thumb-tack"></i> ' . esc_html__( 'Sticky', 'exhibz' ) . ' </sup>';
				} ?>
			</h2>
			
			<div class="entry-content">
				<?php exhibz_excerpt( 40, null ); ?>
			</div>

			<div class="post-footer">
				<a class="btn-readmore" href="<?php the_permalink(); ?>">
					<?php esc_html_e('Read More', 'exhibz') ?>
					<i class="icon icon-arrow-right"></i>
				</a>
			</div>

		</div><!-- Entry header end -->
	</div><!-- Post body end -->
</article>