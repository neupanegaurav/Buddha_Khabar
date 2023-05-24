<?php
/**
 * @package     Kirki
 * @subpackage  Controls
 * @copyright   Copyright (c) 2015, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Early exit if the class already exists
if ( class_exists( 'Nova_Customize_Control' ) ) {
	return;
}

class Nova_Customize_Control extends WP_Customize_Control {

	public $help = '';

	public function to_json() {
		parent::to_json();

		if ( isset( $this->default ) ) {
			$this->json['default'] = $this->default;
		} else {
			$this->json['default'] = $this->setting->default;
		}
		$this->json['value']   = $this->value();
		$this->json['choices'] = $this->choices;
		$this->json['link']    = $this->get_link();
		$this->json['help']    = $this->help;
		$this->json['id']      = $this->id;
	}

	public function enqueue() {
		Nova_Styles_Customizer::enqueue_customizer_control_script( 'nova-' . str_replace( 'nova-', '', $this->type ), 'controls/' . str_replace( 'nova-', '', $this->type ), array( 'jquery' ) );
	}

	public function render_content() {}

}
