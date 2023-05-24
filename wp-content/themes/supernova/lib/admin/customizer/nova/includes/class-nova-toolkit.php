<?php
/**
 * The main Nova object
 *
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

// Early exit if the class already exists
if ( class_exists( 'Nova_Toolkit' ) ) {
	return;
}

final class Nova_Toolkit {

	/** @var Nova The only instance of this class */
	public static $instance = null;

	public static $version = '1.0.2';

	public $font_registry = null;
	public $scripts       = null;
	public $api           = null;
	public $styles        = array();

	/**
	 * Access the single instance of this class
	 * @return Nova
	 */
	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new Nova_Toolkit();
		}
		return self::$instance;
	}

	/**
	 * Shortcut method to get the translation strings
	 */
	public static function i18n() {

		$i18n = array(
			'background-color'      => esc_attr__( 'Background Color', 'supernova' ),
			'background-image'      => esc_attr__( 'Background Image', 'supernova' ),
			'no-repeat'             => esc_attr__( 'No Repeat', 'supernova' ),
			'repeat-all'            => esc_attr__( 'Repeat All', 'supernova' ),
			'repeat-x'              => esc_attr__( 'Repeat Horizontally', 'supernova' ),
			'repeat-y'              => esc_attr__( 'Repeat Vertically', 'supernova' ),
			'inherit'               => esc_attr__( 'Inherit', 'supernova' ),
			'background-repeat'     => esc_attr__( 'Background Repeat', 'supernova' ),
			'cover'                 => esc_attr__( 'Cover', 'supernova' ),
			'contain'               => esc_attr__( 'Contain', 'supernova' ),
			'background-size'       => esc_attr__( 'Background Size', 'supernova' ),
			'fixed'                 => esc_attr__( 'Fixed', 'supernova' ),
			'scroll'                => esc_attr__( 'Scroll', 'supernova' ),
			'background-attachment' => esc_attr__( 'Background Attachment', 'supernova' ),
			'left-top'              => esc_attr__( 'Left Top', 'supernova' ),
			'left-center'           => esc_attr__( 'Left Center', 'supernova' ),
			'left-bottom'           => esc_attr__( 'Left Bottom', 'supernova' ),
			'right-top'             => esc_attr__( 'Right Top', 'supernova' ),
			'right-center'          => esc_attr__( 'Right Center', 'supernova' ),
			'right-bottom'          => esc_attr__( 'Right Bottom', 'supernova' ),
			'center-top'            => esc_attr__( 'Center Top', 'supernova' ),
			'center-center'         => esc_attr__( 'Center Center', 'supernova' ),
			'center-bottom'         => esc_attr__( 'Center Bottom', 'supernova' ),
			'background-position'   => esc_attr__( 'Background Position', 'supernova' ),
			'background-opacity'    => esc_attr__( 'Background Opacity', 'supernova' ),
			'on'                    => esc_attr__( 'ON', 'supernova' ),
			'off'                   => esc_attr__( 'OFF', 'supernova' ),
			'all'                   => esc_attr__( 'All', 'supernova' ),
			'cyrillic'              => esc_attr__( 'Cyrillic', 'supernova' ),
			'cyrillic-ext'          => esc_attr__( 'Cyrillic Extended', 'supernova' ),
			'devanagari'            => esc_attr__( 'Devanagari', 'supernova' ),
			'greek'                 => esc_attr__( 'Greek', 'supernova' ),
			'greek-ext'             => esc_attr__( 'Greek Extended', 'supernova' ),
			'khmer'                 => esc_attr__( 'Khmer', 'supernova' ),
			'latin'                 => esc_attr__( 'Latin', 'supernova' ),
			'latin-ext'             => esc_attr__( 'Latin Extended', 'supernova' ),
			'vietnamese'            => esc_attr__( 'Vietnamese', 'supernova' ),
			'hebrew'                => esc_attr__( 'Hebrew', 'supernova' ),
			'arabic'                => esc_attr__( 'Arabic', 'supernova' ),
			'bengali'               => esc_attr__( 'Bengali', 'supernova' ),
			'gujarati'              => esc_attr__( 'Gujarati', 'supernova' ),
			'tamil'                 => esc_attr__( 'Tamil', 'supernova' ),
			'telugu'                => esc_attr__( 'Telugu', 'supernova' ),
			'thai'                  => esc_attr__( 'Thai', 'supernova' ),
			'serif'                 => _x( 'Serif', 'font style', 'supernova' ),
			'sans-serif'            => _x( 'Sans Serif', 'font style', 'supernova' ),
			'monospace'             => _x( 'Monospace', 'font style', 'supernova' ),
			'font-family'           => esc_attr__( 'Font Family', 'supernova' ),
			'font-size'             => esc_attr__( 'Font Size', 'supernova' ),
			'font-weight'           => esc_attr__( 'Font Weight', 'supernova' ),
			'line-height'           => esc_attr__( 'Line Height', 'supernova' ),
			'letter-spacing'        => esc_attr__( 'Letter Spacing', 'supernova' ),
			'top'                   => esc_attr__( 'Top', 'supernova' ),
			'bottom'                => esc_attr__( 'Bottom', 'supernova' ),
			'left'                  => esc_attr__( 'Left', 'supernova' ),
			'right'                 => esc_attr__( 'Right', 'supernova' ),
		);

		$config = apply_filters( 'nova/config', array() );

		if ( isset( $config['i18n'] ) ) {
			$i18n = wp_parse_args( $config['i18n'], $i18n );
		}

		return $i18n;

	}

	/**
	 * Shortcut method to get the font registry.
	 */
	public static function fonts() {
		return self::get_instance()->font_registry;
	}

	/**
	 * Constructor is private, should only be called by get_instance()
	 */
	private function __construct() {
	}

	/**
	 * Return true if we are debugging Nova.
	 */
	public static function nova_debug() {
		return (bool) ( defined( 'KIRKI_DEBUG' ) && KIRKI_DEBUG );
	}

    /**
     * Take a path and return it clean
     *
     * @param string $path
	 * @return string
     */
    public static function clean_file_path( $path ) {
        $path = str_replace( '', '', str_replace( array( "\\", "\\\\" ), '/', $path ) );
        if ( '/' === $path[ strlen( $path ) - 1 ] ) {
            $path = rtrim( $path, '/' );
        }
        return $path;
    }

	/**
	 * Determine if we're on a parent theme
	 *
	 * @param $file string
	 * @return bool
	 */
	public static function is_parent_theme( $file ) {
		$file = self::clean_file_path( $file );
		$dir  = self::clean_file_path( get_template_directory() );
		$file = str_replace( '//', '/', $file );
		$dir  = str_replace( '//', '/', $dir );
		if ( false !== strpos( $file, $dir ) ) {
			return true;
		}
		return false;
	}

	/**
	 * Determine if we're on a child theme.
	 *
	 * @param $file string
	 * @return bool
	 */
	public static function is_child_theme( $file ) {
		$file = self::clean_file_path( $file );
		$dir  = self::clean_file_path( get_stylesheet_directory() );
		$file = str_replace( '//', '/', $file );
		$dir  = str_replace( '//', '/', $dir );
		if ( false !== strpos( $file, $dir ) ) {
			return true;
		}
		return false;
	}

	/**
	 * Determine if we're running as a plugin
	 */
	private static function is_plugin() {
		if ( false !== strpos( self::clean_file_path( __FILE__ ), self::clean_file_path( get_stylesheet_directory() ) ) ) {
			return false;
		}
		if ( false !== strpos( self::clean_file_path( __FILE__ ), self::clean_file_path( get_template_directory_uri() ) ) ) {
			return false;
		}
		if ( false !== strpos( self::clean_file_path( __FILE__ ), self::clean_file_path( WP_CONTENT_DIR . '/themes/' ) ) ) {
			return false;
		}
		return true;
	}

	/**
	 * Determine if we're on a theme
	 *
	 * @param $file string
	 * @return bool
	 */
	public static function is_theme( $file ) {
		if ( true == self::is_child_theme( $file ) || true == self::is_parent_theme( $file ) ) {
			return true;
		}
		return false;
	}
}
