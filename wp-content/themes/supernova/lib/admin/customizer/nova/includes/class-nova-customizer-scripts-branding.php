<?php
/**
 * Add the logo and description to the customizer.
 * Logo and customizer are defined using the nova/config filter.
 * See https://github.com/aristath/nova/wiki/Styling-the-Customizer for documentation
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
if ( class_exists( 'Nova_Customizer_Scripts_Branding' ) ) {
	return;
}

class Nova_Customizer_Scripts_Branding extends Nova_Customizer_Scripts_Enqueue {

	/**
	 * If we've specified an image to be used as logo,
	 * replace the default theme description with a div that will include our logo.
	 */
	public function generate_script( $args = array() ) {

		$config = apply_filters( 'nova/config', array() );
		$script = '';
		if ( ( isset( $config['logo_image'] ) && '' != $config['logo_image'] ) || ( isset( $config['description'] ) && '' != $config['description'] ) ) {
			if ( isset( $config['logo_image'] ) && '' != $config['logo_image'] ) {
				$config['logo_image'] = esc_url_raw( $config['logo_image'] );
				$script .= '$( \'div#customize-info .preview-notice\' ).replaceWith( \'<img src="' . $config['logo_image'] . '">\' );';
			}
			if ( isset( $config['description'] ) && '' != $config['description'] ) {
				$config['description'] = esc_textarea( $config['description'] );
				$script .= '$( \'div#customize-info .accordion-section-content\' ).replaceWith( \'<div class="accordion-section-content"><div class="theme-description">' . $config['description'] . '</div></div>\' );';
			}
		}

		return $script;

	}

	public function customize_controls_print_scripts() {
		$script = $this->generate_script();
		if ( '' != $script ) {
			echo Nova_Scripts_Registry::prepare( $script );
		}
	}

	public function customize_controls_enqueue_scripts() {}

	public function customize_controls_print_footer_scripts() {}

	public function wp_footer() {}

}
