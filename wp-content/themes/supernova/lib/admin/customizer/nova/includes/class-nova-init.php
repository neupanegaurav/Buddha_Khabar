<?php

class Nova_Init {

	/**
	 * the class constructor
	 */
	public function __construct() {
		$this->set_url();
		add_action( 'wp_loaded', array( $this, 'add_to_customizer' ), 1 );
	}

	/**
	 * Properly set the Nova URL for assets
	 * Determines if Nova is installed as a plugin, in a child theme, or a parent theme
	 * and then does some calculations to get the proper URL for its CSS & JS assets
	 *
	 * @return string
	 */
	public function set_url() {
		/**
		 * Are we on a parent theme?
		 */
		if ( Nova_Toolkit::is_parent_theme( __FILE__ ) ) {
			$relative_url = str_replace( Nova_Toolkit::clean_file_path( get_template_directory() ), '', dirname( dirname( __FILE__ ) ) );
			Nova::$url = trailingslashit( get_template_directory_uri() . $relative_url );
		}
		/**
		 * Are we on a child theme?
		 */
		elseif ( Nova_Toolkit::is_child_theme( __FILE__ ) ) {
			$relative_url = str_replace( Nova_Toolkit::clean_file_path( get_stylesheet_directory() ), '', dirname( dirname( __FILE__ ) ) );
			Nova::$url = trailingslashit( get_stylesheet_directory_uri() . $relative_url );
		}
		/**
		 * Fallback to plugin
		 */
		else {
			Nova::$url = plugin_dir_url( dirname( __FILE__ ) . 'nova.php' );
		}
	}

	/**
	 * Helper function that adds the fields, sections and panels to the customizer.
	 *
	 * @return void
	 */
	public function add_to_customizer() {
		new Nova_Fields_Filter();
		add_action( 'customize_register', array( $this, 'register_control_types' ) );
		add_action( 'customize_register', array( $this, 'add_panels' ), 97 );
		add_action( 'customize_register', array( $this, 'add_sections' ), 98 );
		add_action( 'customize_register', array( $this, 'add_fields' ), 99 );
	}

	/**
	 * Register control types
	 *
	 * @return  void
	 */
	public function register_control_types() {
		global $wp_customize;

		$wp_customize->register_control_type( 'Nova_Controls_Checkbox_Control' );
		$wp_customize->register_control_type( 'Nova_Controls_Code_Control' );
		$wp_customize->register_control_type( 'Nova_Controls_Color_Alpha_Control' );
		$wp_customize->register_control_type( 'Nova_Controls_Custom_Control' );
		$wp_customize->register_control_type( 'Nova_Controls_Dimension_Control' );
		$wp_customize->register_control_type( 'Nova_Controls_Number_Control' );
		$wp_customize->register_control_type( 'Nova_Controls_Radio_Control' );
		$wp_customize->register_control_type( 'Nova_Controls_Radio_Buttonset_Control' );
		$wp_customize->register_control_type( 'Nova_Controls_Radio_Image_Control' );
		$wp_customize->register_control_type( 'Nova_Controls_Select_Control' );
		$wp_customize->register_control_type( 'Nova_Controls_Slider_Control' );
		$wp_customize->register_control_type( 'Nova_Controls_Spacing_Control' );
		$wp_customize->register_control_type( 'Nova_Controls_Switch_Control' );
		$wp_customize->register_control_type( 'Nova_Controls_Textarea_Control' );
		$wp_customize->register_control_type( 'Nova_Controls_Toggle_Control' );
		$wp_customize->register_control_type( 'Nova_Controls_Typography_Control' );
		$wp_customize->register_control_type( 'Nova_Controls_Palette_Control' );
		$wp_customize->register_control_type( 'Nova_Controls_Preset_Control' );
		$wp_customize->register_control_type( 'Nova_Controls_Multicheck_Control' );
		$wp_customize->register_control_type( 'Nova_Controls_Sortable_Control' );
	}

	/**
	 * register our panels to the WordPress Customizer
	 *
	 * @var	object	The WordPress Customizer object
	 * @return  void
	 */
	public function add_panels() {
		if ( ! empty( Nova::$panels ) ) {
			foreach ( Nova::$panels as $panel_args ) {
				new Nova_Panel( $panel_args );
			}
		}
	}

	/**
	 * register our sections to the WordPress Customizer
	 *
	 * @var	object	The WordPress Customizer object
	 * @return  void
	 */
	public function add_sections() {
		if ( ! empty( Nova::$sections ) ) {
			foreach ( Nova::$sections as $section_args ) {
				new Nova_Section( $section_args );
			}
		}
	}

	/**
	 * Create the settings and controls from the $fields array and register them.
	 *
	 * @var	object	The WordPress Customizer object
	 * @return  void
	 */
	public function add_fields() {
		foreach ( Nova::$fields as $field ) {
			if ( isset( $field['type'] ) && 'background' == $field['type'] ) {
				continue;
			}
			if ( isset( $field['type'] ) && 'select2-multiple' == $field['type'] ) {
				$field['multiple'] = 999;
			}
			new Nova_Field( $field );
		}
	}

	/**
	 * Build the variables.
	 *
	 * @return array 	('variable-name' => value)
	 */
	public function get_variables() {

		$variables = array();

		/**
		 * Loop through all fields
		 */
		foreach ( Nova::$fields as $field ) {
			/**
			 * Check if we have variables for this field
			 */
			if ( isset( $field['variables'] ) && false != $field['variables'] && ! empty( $field['variables'] ) ) {
				/**
				 * Loop through the array of variables
				 */
				foreach ( $field['variables'] as $field_variable ) {
					/**
					 * Is the variable ['name'] defined?
					 * If yes, then we can proceed.
					 */
					if ( isset( $field_variable['name'] ) ) {
						/**
						 * Sanitize the variable name
						 */
						$variable_name = esc_attr( $field_variable['name'] );
						/**
						 * Do we have a callback function defined?
						 * If not then set $variable_callback to false.
						 */
						$variable_callback = ( isset( $field_variable['callback'] ) && is_callable( $field_variable['callback'] ) ) ? $field_variable['callback'] : false;
						/**
						 * If we have a variable_callback defined then get the value of the option
						 * and run it through the callback function.
						 * If no callback is defined (false) then just get the value.
						 */
						if ( $variable_callback ) {
							$variables[ $variable_name ] = call_user_func( $field_variable['callback'], Nova::get_option( Nova_Field_Sanitize::sanitize_settings( $field ) ) );
						} else {
							$variables[ $variable_name ] = Nova::get_option( $field['settings'] );
						}

					}

				}

			}

		}
		/**
		 * Pass the variables through a filter ('nova/variable')
		 * and return the array of variables
		 */
		return apply_filters( 'nova/variable', $variables );

	}

	public static function path() {

	}

}
