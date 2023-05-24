<?php

class Nova_Fields_Filter extends Nova_Customizer {

	public function __construct() {
		parent::__construct();
		$this->fields_from_filters();
	}

	/**
	 * Process fields added using the 'nova/fields' and 'nova/controls' filter.
	 * These filters are no longer used, this is simply for backwards-compatibility
	 */
	public function fields_from_filters() {

		$fields = apply_filters( 'nova/controls', array() );
		$fields = apply_filters( 'nova/fields', $fields );

		if ( ! empty( $fields ) ) {
			foreach ( $fields as $field ) {
				Nova::add_field( 'global', $field );
			}
		}

	}

}
