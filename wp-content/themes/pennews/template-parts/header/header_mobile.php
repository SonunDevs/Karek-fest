<div class="penci-header-mobile<?php echo esc_attr( wp_is_mobile() ? ' mobile' : '' ); ?>" >
	<div class="penci-header-mobile_container">
		<button class="menu-toggle navbar-toggle" aria-expanded="false"><span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'pennews' ); ?></span><i class="fa fa-bars"></i></button>
		<?php if( ! get_theme_mod( 'hide_logo_header_mobile' ) ){ ?>
			<?php if ( penci_get_setting( 'penci_use_textlogo' ) && penci_get_setting( 'penci_text_logo_on_mobile' ) ) {
			?>
			<div class="site-branding"><div class="site-title"><a href="<?php echo esc_url( penci_home_url() ); ?>" rel="home"><?php echo penci_get_setting( 'penci_text_logo_on_mobile' ); ?></a></div></div>
			<?php
			} elseif ( penci_get_setting( 'penci_use_textlogo' ) && penci_get_setting( 'penci_text_logo' ) ) {
			?>
				<div class="site-branding"><div class="site-title"><a href="<?php echo esc_url( penci_home_url() ); ?>" rel="home"><?php echo penci_get_setting( 'penci_text_logo' ); ?></a></div></div>
			<?php
			} else {
			if ( penci_get_setting( 'penci_logo_header_mobile' ) ) : ?>
					<div class="site-branding"> <a href="<?php echo esc_url( penci_home_url() ); ?>" class="custom-logo-link logo_header_mobile"><img src="<?php echo esc_url( penci_get_setting( 'penci_logo_header_mobile' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a></div>
			<?php elseif ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
			<div class="site-branding"><?php the_custom_logo(); ?></div>
				<?php endif;
			}
		} ?>
		<?php
		$header_search = penci_get_setting( 'penci_hide_header_search' );
		$dis_search_bg   = penci_get_setting( 'penci_dis_header_search_bg' );
		if ( ! $header_search ): ?>
			<div class="header__search-mobile header__search<?php  echo ( $dis_search_bg ? ' header__search_dis_bg': '' ); ?>" id="top-search-mobile">
				<a class="search-click"><i class="fa fa-search"></i></a>
				<div class="show-search">
					<div class="show-search__content">
						<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<label>
								<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'pennews' ); ?></span>
								<?php $autocomplete =  penci_get_setting( 'penci_enable_ajaxsearch' ) ? 'off' : 'on'; ?>
								<input  type="text" id="penci-search-field-mobile" class="search-field penci-search-field-mobile" placeholder="<?php echo penci_get_tran_setting( 'penci_search_enter_keyword' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" autocomplete="<?php echo esc_attr( $autocomplete ); ?>">
							</label>
							<button type="submit" class="search-submit">
								<i class="fa fa-search"></i>
								<span class="screen-reader-text"><?php esc_attr_e( 'Search', 'pennews' ); ?></span>
							</button>
						</form>
						<div class="penci-ajax-search-results">
							<div class="penci-ajax-search-results-wrapper"></div>
							<?php echo apply_filters( 'penci_after_block_items', '' ); ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>