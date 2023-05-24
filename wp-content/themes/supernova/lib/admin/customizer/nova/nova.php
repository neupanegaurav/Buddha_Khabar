<?php
/**
 * @package     Kirki
 * @category    Core
 * @author      Aristeides Stathopoulos
 * @copyright   Copyright (c) 2015, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Include the autoloader
include_once( dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'autoloader.php' );

if ( ! function_exists( 'Nova' ) ) {
	/**
	 * Returns the Nova object
	 */
	function Nova() {
		// Make sure the class is instanciated
		$nova = Nova_Toolkit::get_instance();

		$nova->font_registry = new Nova_Google_Fonts_Registry();
		$nova->api           = new Nova();
		$nova->scripts       = new Nova_Scripts_Registry();
		$nova->styles        = array(
			'back'  => new Nova_Styles_Customizer(),
			'front' => new Nova_Styles_Frontend(),
		);

		/**
		 * The path of the current Nova instance
		 */
		Nova::$path = dirname( __FILE__ );

		return $nova;

	}

	global $nova;
	$nova = Nova();
}

/**
 * Apply the filters to the Nova::$url
 */
if ( ! function_exists( 'nova_filtered_url' ) ) {
	function nova_filtered_url() {
		$config = apply_filters( 'nova/config', array() );
		if ( isset( $config['url_path'] ) ) {
			Nova::$url = esc_url_raw( $config['url_path'] );
		}
	}
	add_action( 'after_setup_theme', 'nova_filtered_url' );
}

include_once( Nova::$path . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'deprecated.php' );
// Include the API class
include_once( Nova::$path . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'class-nova.php' );

if ( ! function_exists( 'nova_load_textdomain' ) ) {
	/**
	 * Load plugin textdomain.
	 *
	 * @since 0.8.0
	 */
	function nova_load_textdomain() {
		$textdomain = 'nova';

		// Look for WP_LANG_DIR/{$domain}-{$locale}.mo
		if ( file_exists( WP_LANG_DIR . '/' . $textdomain . '-' . get_locale() . '.mo' ) ) {
			$file = WP_LANG_DIR . '/' . $textdomain . '-' . get_locale() . '.mo';
		}
		// Look for Nova::$path/languages/{$domain}-{$locale}.mo
		if ( ! isset( $file ) && file_exists( Nova::$path . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR . $textdomain . '-' . get_locale() . '.mo' ) ) {
			$file = Nova::$path . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR . $textdomain . '-' . get_locale() . '.mo';
		}

		if ( isset( $file ) ) {
			load_textdomain( $textdomain, $file );
		}

		load_plugin_textdomain( $textdomain, false, Nova::$path . DIRECTORY_SEPARATOR . 'languages' );
	}
	add_action( 'plugins_loaded', 'nova_load_textdomain' );
}

// Add an empty config for global fields
Nova::add_config( '' );

/**
 * To enable the demo theme, just add this line to your wp-config.php file:
 * define( 'KIRKI_CONFIG', true );
 * Once you add that line, you'll see a new theme in your dashboard called "Nova Demo".
 * Activate that theme to test all controls.
 */
if ( defined( 'KIRKI_DEMO' ) && KIRKI_DEMO && file_exists( dirname( __FILE__ ) . '/demo-theme/style.css' ) ) {
	register_theme_directory( dirname( __FILE__ ) );
}
