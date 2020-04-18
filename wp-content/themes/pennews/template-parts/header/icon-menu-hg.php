<?php
$nav_show = penci_get_theme_mod( 'penci_verttical_nav_show' );
if( $nav_show ) {
	return;
}

$header_layout = penci_get_theme_mod( 'penci_header_layout' );
$hbg_show = penci_get_theme_mod( 'penci_menu_hbg_show' );
if ( ! in_array( $header_layout, array( 'header_s12', 'header_s13' ) ) && ! $hbg_show ) {
	return;
}
?>
<div class="penci-menuhbg-wapper penci-menu-toggle-wapper">
	<a href="#pencimenuhbgtoggle" class="penci-menuhbg-toggle">
		<span class="penci-menuhbg-inner">
			<i class="lines-button lines-button-double">
				<i class="penci-lines"></i>
			</i>
			<i class="lines-button lines-button-double penci-hover-effect">
				<i class="penci-lines"></i>
			</i>
		</span>
	</a>
</div>