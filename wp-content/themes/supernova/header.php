<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package supernova
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'supernova' ); ?></a>

	<?php get_template_part( 'template-parts/top-most' , 'navigation' ); ?>
	<?php get_template_part( 'template-parts/top-most' , 'mobile-navigation' ); ?>

	<header id="masthead" class="sup-site-header row-container <?php sup_header_classes(); ?>" role="banner">
		<div class="sup-site-branding">
			<?php sup_site_branding(); ?>
		</div><!-- .site-branding -->
		<?php do_action( 'sup_next_to_branding' ); ?>
	</header><!-- #masthead -->

	<?php if( get_theme_mod( 'sup_display_main_nav' , true ) || get_theme_mod( 'sup_main_nav_search_bar' , true ) ){ ?>
	<div id="site-navigation" class="sup-main-nav-row" >
		<div class="row-container">
			<?php if( get_theme_mod( 'sup_display_main_nav' , true ) ){ ?>
			<nav id="sup-main-menu" class="sup-main-nav" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'Main_Nav', 'menu_id' => 'sup-main-nav' , 'depth' => 5 ) ); ?>
			</nav>
			<?php } ?>
			<?php if( get_theme_mod( 'sup_main_nav_search_bar' , true ) ){ ?>
			<div class="sup-main-search">
				<?php get_search_form(); ?>
			</div>
			<?php } ?>
		</div>
	</div><!-- #site-navigation -->
	<?php } ?>

	<?php do_action( 'sup_before_content' ); ?>

	<div id="content" class="sup-site-content row">

	<?php do_action( 'sup_content_start' ); ?>
