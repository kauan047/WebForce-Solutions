<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * This file contains the autoloading mechanism.
 *
 * The spl_autoload_register function is a pre-defined function
 * to effectively create a queue of autoload functions, and run through each of them in the order they are defined.
 *
 * @package Rootblox
 */
spl_autoload_register(
	function ( $class_name ) {
		// project-specific namespace prefix.
		$prefix = 'Rootblox\\';

		// base directory for the namespace prefix.
		$base_dir = ROOTBLOX_PLUGIN_DIR . 'includes/';

		// does the class_name use the namespace prefix?
		$len = strlen( $prefix );
		if ( strncmp( $prefix, $class_name, $len ) !== 0 ) {
			// no, move to the next registered autoloader.
			return;
		}

		// get the relative class_name name.
		$relative_class = strtolower( str_replace( '_', '-', substr( $class_name, $len ) ) );

		// replace the namespace prefix with the base directory, replace namespace.
		// separators with directory separators in the relative class name, append.
		// with .php.
		$file = $base_dir . 'class-' . $relative_class . '.php';

		// if the file exists, require it.
		if ( file_exists( $file ) ) {
			require $file;
		}
	}
);
