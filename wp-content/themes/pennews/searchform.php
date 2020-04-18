<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'pennews' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo penci_get_tran_setting( 'penci_search_enter_keyword' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	</label>
	<button type="submit" class="search-submit">
		<i class="fa fa-search"></i>
		<span class="screen-reader-text"><?php esc_attr_e( 'Search', 'pennews' ); ?></span>
	</button>
</form>
