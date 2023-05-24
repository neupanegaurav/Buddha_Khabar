<?php

class Nova_Settings extends Nova_Customizer {

	public function __construct( $args ) {

		parent::__construct( $args );
		$this->add_settings( $args );

	}

	public function add_settings( $args ) {

		if ( isset( $args['settings'] ) && is_array( $args['settings'] ) ) {
			$settings          = Nova_Field_Sanitize::sanitize_settings( $args );
			$defaults          = isset( $args['default'] ) ? $args['default'] : array();
			$sanitize_callback = Nova_Field_Sanitize::sanitize_callback( $args );
			foreach ( $settings as $setting_key => $setting_value ) {
				$default    = ( isset( $defaults[ $setting_key ] ) ) ? $defaults[ $setting_key ] : '';
				$type       = Nova_Field_Sanitize::sanitize_type( $args );
				$capability = Nova_Field_Sanitize::sanitize_capability( $args );
				$transport  = isset( $args['transport'] ) ? $args['transport'] : 'refresh';

				if ( isset( $args['sanitize_callback'] ) && is_array( $args['sanitize_callback'] ) ) {
					if ( isset( $args['sanitize_callback'][ $setting_key ] ) ) {
						$sanitize_callback = Nova_Field_Sanitize::sanitize_callback( array( 'sanitize_callback' => $args['sanitize_callback'][ $setting_key ] ) );
					}
				}
				$this->wp_customize->add_setting( $setting_value, array(
					'default'           => $default,
					'type'              => $type,
					'capability'        => $capability,
					'sanitize_callback' => $sanitize_callback,
					'transport'         => $transport,
				) );
			}
		}

		if ( isset( $args['type'] ) && array_key_exists( $args['type'], Nova_Control::$setting_types ) ) {
			// We must instantiate a custom class for the setting
			$setting_classname = Nova_Control::$setting_types[ $args['type'] ];
			$this->wp_customize->add_setting( new $setting_classname( $this->wp_customize, Nova_Field_Sanitize::sanitize_settings( $args ), array(
				'default'           => isset( $args['default'] ) ? $args['default'] : '',
				'type'              => Nova_Field_Sanitize::sanitize_type( $args ),
				'capability'        => Nova_Field_Sanitize::sanitize_capability( $args ),
				'transport'         => isset( $args['transport'] ) ? $args['transport'] : 'refresh',
				'sanitize_callback' => Nova_Field_Sanitize::sanitize_callback( $args ),
			) ) );

		} else {
			$this->wp_customize->add_setting( Nova_Field_Sanitize::sanitize_settings( $args ), array(
				'default'           => isset( $args['default'] ) ? $args['default'] : '',
				'type'              => Nova_Field_Sanitize::sanitize_type( $args ),
				'capability'        => Nova_Field_Sanitize::sanitize_capability( $args ),
				'transport'         => isset( $args['transport'] ) ? $args['transport'] : 'refresh',
				'sanitize_callback' => Nova_Field_Sanitize::sanitize_callback( $args ),
			) );
		}

	}
}
