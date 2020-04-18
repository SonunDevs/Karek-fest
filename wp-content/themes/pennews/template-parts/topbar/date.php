<?php
$show_date = penci_get_setting( 'penci_topbar_show_date' );
if ( ! $show_date ) {
	return;
}

$date_format = penci_get_setting( 'penci_topbar_date_format' );
$date_format = $date_format ? $date_format : get_option( 'date_format' );

?>
<div class="topbar_item topbar_date">
	<?php echo date_i18n( $date_format ); ?>
</div>
