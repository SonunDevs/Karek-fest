<?php
if ( ! is_admin() ) {
	require get_template_directory() . '/inc/custom-css/css.php';
	require get_template_directory() . '/inc/custom-css/general.php';
	require get_template_directory() . '/inc/custom-css/topbar.php';
	require get_template_directory() . '/inc/custom-css/sign-up-form.php';
	require get_template_directory() . '/inc/custom-css/header.php';
	require get_template_directory() . '/inc/custom-css/single.php';
	require get_template_directory() . '/inc/custom-css/page.php';
	require get_template_directory() . '/inc/custom-css/mobile-nav.php';
	require get_template_directory() . '/inc/custom-css/portfolio.php';
	require get_template_directory() . '/inc/custom-css/woo.php';
	require get_template_directory() . '/inc/custom-css/archive.php';
	
	require get_template_directory() . '/inc/custom-css/footer.php';

	require get_template_directory() . '/inc/custom-css/color-general.php';
	require get_template_directory() . '/inc/custom-css/sidebar.php';
	require get_template_directory() . '/inc/custom-css/color-header.php';
	require get_template_directory() . '/inc/custom-css/color-sidebar.php';
	require get_template_directory() . '/inc/custom-css/color-single.php';
	require get_template_directory() . '/inc/custom-css/color-footer.php';

	require get_template_directory() . '/inc/custom-css/header-signup.php';
	require get_template_directory() . '/inc/custom-css/footer-signup.php';
	
	require get_template_directory() . '/inc/custom-css/page-header.php';
	require get_template_directory() . '/inc/custom-css/menu-hamburger.php';
	require get_template_directory() . '/inc/custom-css/layout-boxed.php';
}