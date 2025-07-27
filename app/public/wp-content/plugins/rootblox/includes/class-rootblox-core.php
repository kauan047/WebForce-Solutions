<?php
namespace Rootblox;

use Rootblox\Api\Api_Init;

class Rootblox_Core {
	/**
	 * The single instance of the Rootblox_Core class.
	 *
	 * This static variable holds the single instance of the class and ensures
	 * that only one instance of the class is created (Singleton pattern).
	 *
	 * @var Rootblox_Core|null The single instance of the Rootblox_Core class or null if not instantiated.
	 */
	private static $instance = null;

	/**
	 * The directory path for the blocks folder.
	 *
	 * This variable stores the file path to the plugin's blocks directory.
	 * It is used to load block-related files from the plugin's directory.
	 *
	 * @var string The full path to the blocks directory within the plugin.
	 */
	private static $dir = ROOTBLOX_PLUGIN_DIR . 'core/';

	/**
	 * The URL for the blocks folder.
	 *
	 * This variable stores the URL to the plugin's blocks directory.
	 * It is used to reference block-related files that are publicly accessible on the web.
	 *
	 * @var string The URL to the blocks directory within the plugin.
	 */
	private static $url = ROOTBLOX_PLUGIN_URL . 'core/';

	/**
	 * Retrieves the single instance of the Rootblox_Core class.
	 *
	 * This method implements the Singleton pattern, ensuring that only
	 * one instance of the Rootblox_Blocks class is created and used throughout
	 * the application. If the instance doesn't exist yet, it will be created.
	 *
	 * @return Rootblox_Core The single instance of the Rootblox_Core class.
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Class constructor.
	 *
	 * Initializes the core functionality of the plugin by requiring and
	 * bootstrapping the API subsystem.
	 *
	 * @access private
	 */
	private function __construct() {
		require_once self::$dir . 'api/class-rootblox-api.php';
		Api_Init::get_instance();
	}
}
