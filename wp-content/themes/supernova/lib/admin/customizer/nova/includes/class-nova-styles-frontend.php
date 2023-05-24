<?php
/**
 * Generates the styles for the frontend.
 * Handles the 'output' argument of fields.
 * Usage instructions on https://github.com/aristath/nova/wiki/output
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
if ( class_exists( 'Nova_Styles_Frontend' ) ) {
	return;
}

class Nova_Styles_Frontend {

	public function __construct() {

		global $wp_customize;

		$config   = apply_filters( 'nova/config', array() );
		$priority = ( isset( $config['styles_priority'] ) ) ? intval( $config['styles_priority'] ) : 999;

		if ( isset( $config['disable_output'] ) && true !== $config['disable_output'] ) {
			return;
		}
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_styles' ), $priority );
		if ( $wp_customize ) {
			return;
		}

		add_action( 'wp_ajax_nova_dynamic_css', array( $this, 'dynamic_css' ) );
		add_action( 'wp_ajax_nopriv_nova_dynamic_css', array( $this, 'dynamic_css' ) );

	}

	public function dynamic_css() {
		require( Nova::$path . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'dynamic-css.php' );
		exit;
	}

	public function frontend_styles() {
		global $wp_customize;
		if ( $wp_customize ) {
			wp_enqueue_style( 'nova-styles', trailingslashit( Nova::$url ) . 'assets/css/nova-styles.css', null, null );
			wp_add_inline_style( 'nova-styles', self::loop_controls() );
		} else {
			wp_enqueue_style( 'nova-styles-php', admin_url( 'admin-ajax.php' ) . '?action=nova_dynamic_css', null, null );
		}
	}

	/**
	 * loop through all fields and create an array of style definitions
	 */
	public static function loop_controls() {

		$fields = Nova::$fields;
		$css    = array();

		// Early exit if no fields are found.
		if ( empty( $fields ) ) {
			return;
		}

		foreach ( $fields as $field ) {

			// Only continue if $field['output'] is set
			if ( isset( $field['output'] ) && ! empty( $field['output'] ) && 'background' != $field['type'] ) {

				if ( function_exists( 'array_replace_recursive' ) ) {
					$css = array_replace_recursive( $css, Nova_Output_CSS::css( $field ) );
				} else {
					$css = Nova_Helper::array_replace_recursive( $css, Nova_Output_CSS::css( $field ) );
				}

			}

		}

		if ( is_array( $css ) ) {
			return Nova_Output_CSS::styles_parse( Nova_Output_CSS::add_prefixes( $css ) );
		}

		return;

	}

}
