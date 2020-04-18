<?php
/**
 * Comments template
 *
 * @package Wordpress
 * @since 1.0
 */

if ( post_password_required() ) {
	return;
}

// Get numbers comments
$comment_numbers = get_comments_number();
if( get_theme_mod( 'penci_user_review_enable' ) ){
$comments = get_comments( array( 'post_id' => get_the_ID(), 'type__not_in' => 'penci_review' ) );

	if( $comments ){
		$comment_numbers = count( (array)$comments );
	}else{
		$comment_numbers = 0;
	}
}
?>
<div class="post-comments  post-comments-<?php the_ID(); ?> <?php if ( $comment_numbers == 0 ): echo ' no-comment-yet'; endif; ?>" id="comments">
	<?php
	if ( ( $comment_numbers > 0 ) ) :
		echo '<div class="post-title-box"><h4 class="post-box-title">';
		comments_number( penci_get_tran_setting( 'penci_comment_zero' ), penci_get_tran_setting( 'penci_comment_one' ), '% ' . penci_get_tran_setting( 'penci_comment_more' ) );
		echo '</h4></div>';

		echo "<div class='comments'>";
		if( get_theme_mod( 'penci_user_review_enable' ) ){
			$comments = get_comments( array( 'post_id' => get_the_ID(), 'type__not_in' => 'penci_review' ) );

			wp_list_comments( array(
				'avatar_size' => 100,
				'max_depth'   => 5,
				'style'       => 'div',
				'callback'    => 'penci_comments_template',
				'type'        => 'all'
			), $comments );
		}else{
			wp_list_comments( array(
				'avatar_size' => 100,
				'max_depth'   => 5,
				'style'       => 'div',
				'callback'    => 'penci_comments_template',
				'type'        => 'all'
			) );
		}
		echo "</div>";

	endif;

	$max_page = get_comment_pages_count();
	if( $max_page > 1 ) {
		echo "<div id='comments_pagination' class='penci-pagination'>";
		paginate_comments_links( array( 'prev_text' => '&laquo;', 'next_text' => '&raquo;' ) );
		echo "</div>";
	}

	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php echo penci_get_tran_setting( 'penci_comment_close' ); ?></p>
		<?php
	endif;

	/* Custom field */
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );
	$consent  = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

	$fields = array(
		'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . penci_get_tran_setting( 'penci_comment_author_placeholder' ) . '" size="30"' . $aria_req . ' /></p>',

		'email' => '<p class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . penci_get_tran_setting( 'penci_comment_author_email_placeholder' ) . '" size="30"' . $aria_req . ' /></p>',

		'url' => '<p class="comment-form-url"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . penci_get_tran_setting( 'penci_comment_author_url_placeholder' ) . '" size="30" /></p>',
	);

	if( ! penci_get_theme_mod( 'penci_comment_save_fields' ) ) {
		$fields['cookies'] = '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
		                     '<span>' . penci_get_tran_setting( 'penci_comment_save_field_text' ) . '</span></p>';
	}

	$custom_comment_field = '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" placeholder="' . penci_get_tran_setting( 'penci_comment_field_placeholder' ) . '" aria-required="true"></textarea></p>';  //label removed for cleaner layout

	$gdrp_mess = '';

	global $wp_version;
	if( penci_get_theme_mod( 'penci_single_gdpr' ) && version_compare( $wp_version, '4.9.6', '>=' )  ){
		$mess_default = penci_get_theme_mod( 'penci_single_gdpr_text' ) ? penci_get_theme_mod( 'penci_single_gdpr_text' ) : esc_html__( '* By using this form you agree with the storage and handling of your data by this website.','pennews' );

		if( $mess_default ) {
			$gdrp_mess .= '<div class="penci-gdpr-message">';
			$gdrp_mess .= do_shortcode( $mess_default );
			$gdrp_mess .= '</div>';
		}
	}

	comment_form( array(
		'comment_field'        => $custom_comment_field,
		'comment_notes_after'  => '',
		'logged_in_as'         => '',
		'comment_notes_before' => '',
		'title_reply'          => '<span>' . penci_get_tran_setting( 'penci_comment_title_reply' ) . '</span>',
		'cancel_reply_link'    => penci_get_tran_setting( 'penci_comment_cancel_reply_link' ),
		'label_submit'         => penci_get_tran_setting( 'penci_comment_label_submit' ),
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'submit_field'         => $gdrp_mess . '<p class="form-submit">%1$s %2$s</p>',
	) );
	?>
</div> <!-- end comments div -->
