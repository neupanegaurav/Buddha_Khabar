<?php

if ( ! function_exists( 'nova_autoload_classes' ) ) {
	/**
	 * The Nova class autoloader.
	 * Finds the path to a class that we're requiring and includes the file.
	 */
	function nova_autoload_classes( $class_name ) {
		$paths = array();
		if ( 0 === stripos( $class_name, 'Nova' ) ) {

			$replacements = array(
				'Controls',
				'Scripts',
				'Settings',
				'Styles',
			);

			$path     = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR;
			$filename = 'class-' . strtolower( str_replace( '_', '-', $class_name ) ) . '.php';

			$paths[] = $path . $filename;
			$paths[] = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . $filename;

			foreach ( $replacements as $replacement ) {
				if ( 0 === stripos( $class_name, 'Nova_' . $replacement ) ) {
					$substr   = str_replace( 'Nova_' . $replacement, '', $class_name );
					$exploded = explode( '_', $substr );

					$paths[] = $path . strtolower( $replacement ) . DIRECTORY_SEPARATOR . $filename;
					$paths[] = $path . strtolower( $replacement ) . DIRECTORY_SEPARATOR . strtolower( str_replace( '_', '-', str_replace( '_' . $replacement, '', str_replace( 'Nova_' . $replacement . '_', '', $class_name ) ) ) ) . DIRECTORY_SEPARATOR . $filename;
					if ( isset( $exploded[1] ) ) {
						$paths[] = $path . strtolower( $replacement ) . DIRECTORY_SEPARATOR . strtolower( $exploded[1] ) . DIRECTORY_SEPARATOR . $filename;
						if ( isset( $exploded[2] ) ) {
							$paths[] = $path . strtolower( $replacement ) . DIRECTORY_SEPARATOR . strtolower( $exploded[1] ) . DIRECTORY_SEPARATOR . strtolower( $exploded[2] ) . DIRECTORY_SEPARATOR . $filename;
							$paths[] = $path . strtolower( $replacement ) . DIRECTORY_SEPARATOR . strtolower( $exploded[1] ) . '-' . strtolower( $exploded[2] ) . DIRECTORY_SEPARATOR . $filename;
						}
					}
				}
			}

			foreach ( $paths as $path ) {
				if ( file_exists( $path ) ) {
					include $path;
					return;
				}
			}

		}

	}
	// Run the autoloader
	spl_autoload_register( 'nova_autoload_classes' );
}
