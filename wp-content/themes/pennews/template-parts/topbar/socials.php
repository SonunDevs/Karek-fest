<?php
$show_socials = penci_get_theme_mod( 'penci_topbar_show_socials', 1 );
if ( empty( $show_socials ) ) {
	return;
}
?>
<div class="topbar_item topbar__social-media">
	<?php penci_list_socail_media(); ?>
</div>

