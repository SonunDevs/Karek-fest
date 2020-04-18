<?php
$pheader_show = penci_check_page_title_show();
if ( ! $pheader_show ) {
	return;
}
if ( is_page() || is_single() ):
	$postid = get_the_ID();
	$class_header_width = penci_get_class_header_width( false );
	$page_header  = penci_get_theme_mod( 'penci_pheader_align' );
	$page_header  = $page_header ? $page_header : 'center';

	$pre_page_header = get_post_meta( $postid, 'penci_pheader_align', true );
	if ( $pre_page_header ) {
		$page_header = $pre_page_header;
	}

	$pheader_hidebead     = penci_get_theme_mod( 'penci_pheader_hidebead' );
	$pre_pheader_hidebead = get_post_meta( $postid, 'penci_pheader_hidebead', true );
	if ( $pre_pheader_hidebead ) {
		if ( 'hide' == $pre_pheader_hidebead ) {
			$pheader_hidebead = 1;
		} elseif ( 'show' == $pre_pheader_hidebead ) {
			$pheader_hidebead = 0;
		}
	}

	$hideline      = penci_get_theme_mod( 'penci_pheader_hideline' );
	$pre__hideline = get_post_meta( $postid, 'penci_pheader_hideline', true );

	if ( $pre__hideline ) {
		if ( 'hide' == $pre__hideline ) {
			$hideline = 1;
		} elseif ( 'show' == $pre__hideline ) {
			$hideline = 0;
		}
	}

	$class_page_header = 'penci-page-header';
	$class_page_header .= ' penci-pheader-'.  esc_attr( $page_header );
	$class_page_header .= $pheader_hidebead  ? ' penci-phhide-bread' : '';
	$class_page_header .= $hideline  ? ' penci-phhide-line' : '';

	?>
	<div class="<?php echo ( $class_page_header ); ?>">
		<div class="penci-page-header-inner <?php echo penci_get_class_header_width(); ?>">
			<h1 class="penci-page-header-title"> <?php echo get_the_title( $postid ); ?> </h1>
			<?php
			if ( ! $pheader_hidebead ) {
				penci_breadcrumbs();
			}
			?>
		</div>
	</div>
	</header>
<?php endif; ?>