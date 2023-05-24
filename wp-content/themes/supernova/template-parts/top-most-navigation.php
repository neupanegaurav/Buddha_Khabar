<?php
/**
 * Contains the top most navigation of the website
 * @package Supernova
 * @since  Supernova 2.0.0
 */

if( ! get_theme_mod( 'sup_display_top_most_nav' , true ) && ! get_theme_mod( 'sup_display_categories_nav' , true ) ) return; ?>

<div id="sup-top-most" class="sup-top-most">
	<div class="row-container">
		<?php if( get_theme_mod( 'sup_display_top_most_nav' , true ) ){ ?>
		<nav id="sup-header-nav" class="sup-left-menu"  role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'Header_Nav', 'menu_id' => 'sup-left-nav' , 'depth' => 5 ) ); ?>
		</nav>
		<?php } ?>
		<?php if( get_theme_mod( 'sup_display_categories_nav' , true ) ){ ?>
		<div class="sup-right-menu">
			<div class="sup-nav-label">
				<span class="sup-icon-menu"></span>
				<span class="sup-nav-name"><?php _e( 'Categories' , 'supernova' ) ?></span>
			</div>
			<nav id="sup-cat-nav" class="sup-menu-container" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'Header_Cat', 'menu_id' => 'sup-right-nav' , 'depth' => 1 ) ); ?>
			</nav>
		</div>
		<?php } ?>
		<span class="sup-header-search-icons sup-icon-search"></span>
		<div class="sup-header-search">
			<?php get_search_form(); ?>
		</div>
	</div>
</div> <!-- sup-top-most -->
