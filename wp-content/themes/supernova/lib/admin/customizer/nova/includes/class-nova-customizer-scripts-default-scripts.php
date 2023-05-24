<?php
/**
 * Enqueue the scripts that are required by the customizer.
 * Any additional scripts that are required by individual controls
 * are enqueued in the control classes themselves.
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
if ( class_exists( 'Nova_Customizer_Scripts_Default_Scripts' ) ) {
	return;
}

class Nova_Customizer_Scripts_Default_Scripts extends Nova_Customizer_Scripts_Enqueue {

	public function generate_script( $args = array() ) {}

	/**
	 * Enqueue the scripts required.
	 */
	public function customize_controls_enqueue_scripts() {

		wp_enqueue_script( 'nova-tooltip', trailingslashit( Nova::$url ) . 'assets/js/nova-tooltip.js', array( 'jquery', 'customize-controls' ) );
		wp_enqueue_script( 'serialize-js', trailingslashit( Nova::$url ) . 'assets/js/vendor/serialize.js' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-tooltip' );
		wp_enqueue_script( 'jquery-stepper-min-js' );

	}

	public function customize_controls_print_scripts() {}

	public function customize_controls_print_footer_scripts() {}

	public function wp_footer() {}

}
