<?php
/**
 * Contains the top most navigation of the website
 * @package Supernova
 * @since  Supernova 2.0.0
 */

$has_cat_nav    = get_theme_mod( 'sup_display_categories_nav' , true );
$has_main_nav   = get_theme_mod( 'sup_display_main_nav' , true );
$has_header_nav = get_theme_mod( 'sup_display_top_most_nav' , true );

?>

<div id="sup-mobile-navigation" class="sup-mobile-navigation clearfix <?php echo $has_cat_nav ? 'sup-mobile-has-cat' : false; ?>">
	<?php if( $has_cat_nav ){ ?>
	<div class="sup-mobile-cat-nav">
		<a href="#sup-cat-nav">
			<span class="sup-icon-list-bullet"></span>
			<span class="sup-mobile-cat-text">
				<?php _e( 'Categories', 'supernova' ); ?>
			</span>
		</a>
	</div>
	<?php } ?>
	<div class="sup-mobile-right-part <?php echo $has_header_nav ? 'sup-mobile-has-header-nav' : false; ?> <?php echo $has_main_nav ? 'sup-mobile-has-main-nav' : false; ?>">
		<?php if( $has_main_nav ){ ?>
		<a class="sup-mobile-main-nav sup-icon-menu" href="#sup-main-menu"></a>
		<?php } ?>
		<div class="sup-mobile-search">
			<?php get_search_form(); ?>
		</div>
		<?php if( $has_header_nav ){ ?>
		<a class="sup-mobile-header-nav sup-icon-menu" href="#sup-header-nav"></a>
		<?php } ?>
	</div>
</div> <!-- sup-top-most -->