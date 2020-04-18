<?php
/**
 * Display detail author of current post
 * Use in single post
 *
 */
$post_author = penci_get_setting( 'penci_hide_single_author_box' );
$description = get_the_author_meta( 'description' );

if( $post_author ) {
	return;
}
global $authordata;
$user_id = isset( $authordata->ID ) ? $authordata->ID : 0;

$count_user_posts = count_user_posts( $user_id );
$comment_count    = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) AS total FROM $wpdb->comments WHERE comment_approved = 1 AND user_id = %d", $user_id ) );
$comment_count    = $comment_count . ' ' . penci_get_tran_setting( 'penci_comment_text' );

?>
<div class="penci-author-box-wrap penci_media_object">
	<div class="author-img penci_mobj__img">
		<?php echo wp_kses_post( get_avatar( get_the_author_meta( 'email' ), '100' ) ); ?>
	</div>
	<div class="penci-author-content penci_mobj__body">
		<div class="penci-author-url">
			<?php if ( get_the_author_meta( 'user_url' ) ) : ?>
			<a href="<?php the_author_meta( 'user_url'); ?>"><?php the_author_meta( 'user_url'); ?></a> -
			<?php endif; ?>
			<span><?php echo esc_attr( $count_user_posts ); ?> <?php echo penci_get_tran_setting( 'penci_posts_text' ); ?></span> -
			<span><?php echo esc_attr( $comment_count ); ?></span>
		</div>
		<div class="author-description">
		<?php the_author_meta( 'description' ); ?>
		</div>
		<?php if ( get_the_author_meta( 'facebook' ) ) : ?>
			<a target="_blank"<?php echo penci_get_rel_noopener(); ?> class="author-social" href="http://facebook.com/<?php echo esc_attr( the_author_meta( 'facebook' ) ); ?>"><i class="fa fa-facebook"></i></a>
		<?php endif; ?>
		<?php if ( get_the_author_meta( 'twitter' ) ) : ?>
			<a target="_blank"<?php echo penci_get_rel_noopener(); ?> class="author-social" href="http://twitter.com/<?php echo esc_attr( the_author_meta( 'twitter' ) ); ?>"><i class="fa fa-twitter"></i></a>
		<?php endif; ?>
		<?php if ( get_the_author_meta( 'googleplus' ) ) : ?>
			<a target="_blank"<?php echo penci_get_rel_noopener(); ?> class="author-social" href="http://plus.google.com/<?php echo esc_attr( the_author_meta( 'googleplus' ) ); ?>?rel=author"><i class="fa fa-google-plus"></i></a>
		<?php endif; ?>
		<?php if ( get_the_author_meta( 'instagram' ) ) : ?>
			<a target="_blank"<?php echo penci_get_rel_noopener(); ?> class="author-social" href="http://instagram.com/<?php echo esc_attr( the_author_meta( 'instagram' ) ); ?>"><i class="fa fa-instagram"></i></a>
		<?php endif; ?>
		<?php if ( get_the_author_meta( 'pinterest' ) ) : ?>
			<a target="_blank"<?php echo penci_get_rel_noopener(); ?> class="author-social" href="http://pinterest.com/<?php echo esc_attr( the_author_meta( 'pinterest' ) ); ?>"><i class="fa fa-pinterest"></i></a>
		<?php endif; ?>
		<?php if ( get_the_author_meta( 'tumblr' ) ) : ?>
			<a target="_blank"<?php echo penci_get_rel_noopener(); ?> class="author-social" href="http://<?php echo esc_attr( the_author_meta( 'tumblr' ) ); ?>.tumblr.com/"><i class="fa fa-tumblr"></i></a>
		<?php endif; ?>
	</div>
</div>