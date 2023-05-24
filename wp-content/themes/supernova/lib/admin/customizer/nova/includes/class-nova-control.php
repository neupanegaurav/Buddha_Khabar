<?php

class Nova_Control extends Nova_Customizer {

	/**
	 * an array of all the control types
	 * and the classname each one of them will use.
	 */
	public static $control_types = array(
		'checkbox'         => 'Nova_Controls_Checkbox_Control',
		'code'             => 'Nova_Controls_Code_Control',
		'color-alpha'      => 'Nova_Controls_Color_Alpha_Control',
		'custom'           => 'Nova_Controls_Custom_Control',
		'dimension'        => 'Nova_Controls_Dimension_Control',
		'editor'           => 'Nova_Controls_Editor_Control',
		'multicheck'       => 'Nova_Controls_MultiCheck_Control',
		'number'           => 'Nova_Controls_Number_Control',
		'palette'          => 'Nova_Controls_Palette_Control',
		'preset'           => 'Nova_Controls_Preset_Control',
		'radio'            => 'Nova_Controls_Radio_Control',
		'radio-buttonset'  => 'Nova_Controls_Radio_ButtonSet_Control',
		'radio-image'      => 'Nova_Controls_Radio_Image_Control',
		'repeater'         => 'Nova_Controls_Repeater_Control',
		'select'           => 'Nova_Controls_Select_Control',
		'slider'           => 'Nova_Controls_Slider_Control',
		'sortable'         => 'Nova_Controls_Sortable_Control',
		'spacing'          => 'Nova_Controls_Spacing_Control',
		'switch'           => 'Nova_Controls_Switch_Control',
		'textarea'         => 'Nova_Controls_Textarea_Control',
		'toggle'           => 'Nova_Controls_Toggle_Control',
		'typography'       => 'Nova_Controls_Typography_Control',
		'color'            => 'WP_Customize_Color_Control',
		'image'            => 'WP_Customize_Image_Control',
		'upload'           => 'WP_Customize_Upload_Control',
	);

	/**
	 * Some controls may need to create additional classes
	 * for their settings regiastration.
	 * in that case here's an array of those controls.
	 */
	public static $setting_types = array(
		'repeater' => 'Nova_Settings_Repeater_Setting',
	);

	public $wp_customize;

	/**
	 * The class constructor
	 */
	public function __construct( $args ) {
		// call the parent constructor
		parent::__construct( $args );
		/**
		 * Apply the 'nova/control_types' filter to Nova_Control::$control_types.
		 * We can use that to register our own customizer controls and extend Nova.
		 */
		self::$control_types = apply_filters( 'nova/control_types', self::$control_types );
		/**
		 * Apply the 'nova/setting_types' filter to Nova_Control::$control_types.
		 * We can use that to register our own setting classes for controls and extend Nova.
		 */
		self::$setting_types = apply_filters( 'nova/setting_types', self::$setting_types );
		// Add the control
		$this->add_control( $args );

	}

	/**
	 * Get the class name of the class needed to create tis control.
	 *
	 * @param  $args array
	 * @return  string
	 */
	public static function control_class_name( $args ) {
		// Set a default class name
		$class_name = 'WP_Customize_Control';
		// Get the classname from the array of control classnames
		if ( array_key_exists( $args['type'], self::$control_types ) ) {
			$class_name = self::$control_types[ $args['type'] ];
		}

		return $class_name;

	}

	/**
	 * Add the control.
	 *
	 * @param  $arg array
	 * @return  void
	 */
	public function add_control( $args ) {

		$control_class_name = self::control_class_name( $args );

		$this->wp_customize->add_control( new $control_class_name(
			$this->wp_customize,
			Nova_Field_Sanitize::sanitize_id( $args ),
			Nova_Field_Sanitize::sanitize_field( $args )
		) );

	}

}
