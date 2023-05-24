<?php
/**
 * code Customizer Control.
 *
 * Creates a new custom control.
 * Custom controls accept raw HTML/JS.
 *
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
if ( class_exists( 'Nova_Controls_Code_Control' ) ) {
	return;
}

class Nova_Controls_Code_Control extends Nova_Customize_Control {

	public $type = 'code';

	public function to_json() {
		parent::to_json();
		if ( ! isset( $this->choices['language'] ) ) {
			$this->choices['language'] = 'css';
		}
		if ( ! isset( $this->choices['theme'] ) ) {
			$this->choices['theme'] = 'monokai';
		}
		if ( ! isset( $this->choices['height'] ) ) {
			$this->choices['height'] = 200;
		}
	}

	public function enqueue() {
		/**
		 * Get the language
		 */
		$lang_file = '/assets/js/vendor/codemirror/mode/' . $this->choices['language'] . '/' . $this->choices['language'] . '.js';
		$language  = 'css';
		if ( file_exists( Nova::$path . $lang_file ) || ! file_exists( Nova::$path . str_replace( '/', DIRECTORY_SEPARATOR, $lang_file ) ) ) {
			$language = $this->choices['language'];
		}
		/**
		 * Get the theme
		 */
		$theme_file = '/assets/js/vendor/codemirror/theme/' . $this->choices['theme'] . '.css';
		$theme      = 'monokai';
		if ( file_exists( Nova::$path . $theme_file ) || file_exists( Nova::$path . str_replace( '/', DIRECTORY_SEPARATOR, $theme_file ) ) ) {
			$theme = $this->choices['theme'];
		}
		/**
		 * Enqueue dependencies
		 */
		Nova_Styles_Customizer::enqueue_customizer_control_script( 'codemirror', 'vendor/codemirror/lib/codemirror', array( 'jquery' ) );
		Nova_Styles_Customizer::enqueue_customizer_control_script( 'nova-code', 'controls/code', array( 'jquery', 'codemirror' ) );
		/**
		 * Add language script
		 */
		wp_enqueue_script( 'codemirror-language-' . $language, trailingslashit( Nova::$url ) . 'assets/js/vendor/codemirror/mode/' . $language . '/' . $language . '.js', array( 'jquery', 'codemirror' ) );
		/**
		 * Add theme styles
		 */
		wp_enqueue_style( 'codemirror-theme-' . $theme, trailingslashit( Nova::$url ) . 'assets/js/vendor/codemirror/theme/' . $theme . '.css' );
	}

	protected function content_template() { ?>
		<# if ( data.help ) { #>
			<a href="#" class="tooltip hint--left" data-hint="{{ data.help }}"><span class='dashicons dashicons-info'></span></a>
		<# } #>
		<label>
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{{ data.label }}}</span>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{ data.description }}</span>
			<# } #>
			<textarea id="nova-codemirror-editor-{{ data.id }}">{{{ data.value }}}</textarea>
		</label>
		<?php
	}

}
