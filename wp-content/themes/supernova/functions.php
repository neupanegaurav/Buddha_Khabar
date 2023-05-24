<?php
/**
 * supernova functions and definitions
 *
 * @package Supernova
 */

$supernova = wp_get_theme();

define ( 'SUPERNOVA_VERSION'  , $supernova->Version );
define ( 'SUPERNOVA_TEMP_URI' , get_template_directory_uri() );
define ( 'SUPERNOVA_TEMP_DIR' , get_template_directory() );
define ( 'SUPERNOVA_CSS_URI'  , SUPERNOVA_TEMP_URI . '/css' );
define ( 'SUPERNOVA_JS_URI'	  , SUPERNOVA_TEMP_URI . '/js' 	);
define ( 'SUPERNOVA_IMG_URI'  , SUPERNOVA_TEMP_URI . '/images' );
define ( 'SUPERNOVA_IS_DEV'   , true );

do_action( 'sup_before' );

if ( ! function_exists( 'sup_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sup_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on supernova, use a find and replace
	 * to change 'supernova' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'supernova', SUPERNOVA_TEMP_DIR . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( apply_filters( 'sup_registered_menus' , array(
		'Header_Nav' => __('Top Most Navigation' , 'supernova'),
		'Header_Cat' => __('Categories Navigation' , 'supernova'),
		'Main_Nav'   => __('Main Navigation'   , 'supernova'),
	) ) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	// add_theme_support( 'post-formats', array(
	// 	'aside',
	// 	'image',
	// 	'video',
	// 	'quote',
	// 	'link',
	// ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'sup_custom_background_args', array(
		'default-color' => '#F7F5F4',
		'default-image' => SUPERNOVA_IMG_URI . '/background.png',

	) ) );

	add_editor_style( array( 'editor-style.css', sup_main_font_url() ) );

	do_action( 'sup_after_setup_theme' );
}
endif; // sup_setup
add_action( 'after_setup_theme', 'sup_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sup_content_width() {
	global $content_width;
	$content_width = apply_filters( 'sup_content_width', 640 );
}
add_action( 'after_setup_theme', 'sup_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function sup_widgets_init()
{
	register_sidebar(array(
		'name'          => __('Sidebar', 'supernova'),
		'id'            => 'sidebar-widgets',
		'before_widget' => '<div id="%1$s" class="widget widget-sidebar large-12 medium-6 small-6 column %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title widget-title-sidebar">',
		'after_title'   => '</h3>'
	));
	register_sidebar(array(
		'name'          => __('Footer Widgets', 'supernova'),
		'id'            => 'footer-widgets',
		'description'   => __('I will appear at the footer', 'supernova'),
		'before_widget' => '<div id="%1$s" class="widget widget-footer large-3 medium-6 small-6 column %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title widget-title-footer" >',
		'after_title'   => '</h3>'
	));
}
add_action( 'widgets_init', 'sup_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sup_scripts()
{
	/*==============================
	          GOOGLE FONTS
	===============================*/

	wp_register_style( 'pt-sans-narrow', sup_main_font_url() );

	/*==============================
	          STYLES
	===============================*/

	wp_enqueue_style( 'sup-style', get_stylesheet_uri(), array( 'pt-sans-narrow' ) );

	/*==============================
	          SCRIPTS
	===============================*/

	if ( SUPERNOVA_IS_DEV ) {
		wp_register_script( 'sup-mmenu', SUPERNOVA_JS_URI . '/vendor/jquery.mmenu.min.all.js', array( 'jquery' ), SUPERNOVA_VERSION, true );
		wp_register_script( 'sup-slick', SUPERNOVA_JS_URI . '/vendor/slick.js', array( 'jquery' ), SUPERNOVA_VERSION, true );
		wp_register_script( 'sup-sticky', SUPERNOVA_JS_URI . '/vendor/jquery.sticky.js', array( 'jquery' ), SUPERNOVA_VERSION, true );
		wp_register_script( 'sup-main', SUPERNOVA_JS_URI . '/main.js', array( 'jquery', 'sup-mmenu', 'sup-slick' , 'sup-sticky' ), SUPERNOVA_VERSION, true );
	}
	else {

		wp_register_script( 'sup-main', SUPERNOVA_JS_URI . '/main.min.js', array( 'jquery' ), SUPERNOVA_VERSION, true );
	}

	wp_enqueue_script( 'sup-main' );

	wp_localize_script( 'sup-main' , 'supVars' , apply_filters( 'sup_main_js_variables' , array(
			'ajaxurl'        => admin_url( 'admin-ajax.php' ),
			'loading'        => __( 'Loading..' , 'supernova' ),
			'isPro' 		 => false,
			'menuText' 		 => __( 'Menu' , 'supernova' ),
			'categoriesText' => __( 'Categories' , 'supernova' ),
			'loadmore_error' => __( 'Sorry there was an error loading posts. Please try again later.' , 'supernova' ),
			'nomore_posts'   => __( 'Sorry there are no more posts available right now.' , 'supernova' ),
			'settings'		 => array(
					'sticky_menu'	 => get_theme_mod( 'sup_sticky_nav' , true ),
				),
			'slider_options' => array(
					'prevArrow'     => ".sup-prev",
					'nextArrow'     => ".sup-next",
					'appendDots'    => '.sup-cycle-pager',
					'dots'          => true,
					'autoplaySpeed' => 3000,
					'respondTo'     => 'body',
					'autoplay'      => true
				 )
		) ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sup_scripts', 20 );


/*==============================
          FILE INCLUDES
===============================*/

//Backward Compatibility
require SUPERNOVA_TEMP_DIR . '/lib/backward-compatibility.php';

//Contains Hooks
require SUPERNOVA_TEMP_DIR . '/inc/hooks.php';

//Custom Functions
require SUPERNOVA_TEMP_DIR . '/inc/custom-functions.php';

//Custom functions that act independently of the theme templates.
require SUPERNOVA_TEMP_DIR . '/inc/extras.php';

//Admin Folder
require SUPERNOVA_TEMP_DIR . '/lib/admin/admin.php';

//Custom template tags for this theme.
require SUPERNOVA_TEMP_DIR . '/inc/template-tags.php';

//Load Jetpack compatibility file.
require SUPERNOVA_TEMP_DIR . '/inc/jetpack.php';

//Load More
require SUPERNOVA_TEMP_DIR . '/inc/load-more.php';

//Custom Header
require SUPERNOVA_TEMP_DIR . '/inc/custom-header.php';

//Widgets
require SUPERNOVA_TEMP_DIR . '/inc/widgets/post-tabs.php';
require SUPERNOVA_TEMP_DIR . '/inc/widgets/recent-posts.php';

//Meta Boxes
require SUPERNOVA_TEMP_DIR . '/inc/meta-boxes.php';

do_action( 'sup_after' );
