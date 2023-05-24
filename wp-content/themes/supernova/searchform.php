<form role="search" method="get" class="sup-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text"><?php _x( 'Search for:', 'label', 'supernova' ); ?></label>
	<input type="search" class="sup-searchinput" placeholder="<?php _e( 'Search...', 'supernova' ); ?>" value="<?php echo get_search_query(); ?>" name="s" required />
	<input type="submit" class="sup-searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'supernova' ); ?>"  />
</form>