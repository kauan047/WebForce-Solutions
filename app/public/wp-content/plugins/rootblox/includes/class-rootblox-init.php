<?php
namespace Rootblox;

final class Rootblox_Init {
	/**
	 * The single instance of the Rootblox_Init class.
	 *
	 * This static variable holds the single instance of the class and ensures
	 * that only one instance of the class is created (Singleton pattern).
	 *
	 * @var Rootblox_Init|null The single instance of the Rootblox_Init class or null if not instantiated.
	 */
	private static $instance = null;

	/**
	 * Indicates whether the premium version is active.
	 *
	 * This variable stores the premium status of the plugin or theme.
	 * If null, the status has not been determined yet.
	 *
	 * @var bool|null True if premium is active, false if not, or null if undefined.
	 */
	private $is_premium = null;

	/**
	 * Retrieves the single instance of the Rootblox_Init class.
	 *
	 * This method implements the Singleton pattern, ensuring that only
	 * one instance of the Rootblox_Init class is created and used throughout
	 * the application. If the instance doesn't exist yet, it will be created.
	 *
	 * @return Rootblox_Init The single instance of the Rootblox_Init class.
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Rootblox_Init constructor.
	 *
	 * The constructor can be used to initialize resources, load configurations,
	 * or perform tasks necessary when the class is instantiated.
	 * In this case, resources can be loaded here.
	 *
	 * @return void
	 */
	private function __construct() {
		add_action( 'init', array( $this, 'i18n' ) );

		require_once ROOTBLOX_PLUGIN_DIR . 'admin/functions.php';

		// Load Core
		\Rootblox\Rootblox_Core::get_instance();

		// Load Admin area.
		\Rootblox\Rootblox_Admin::get_instance();

		// Load Resources.
		\Rootblox\Rootblox_Resources::get_instance();

		// Register blocks.
		\Rootblox\Rootblox_Blocks::get_instance();
	}

	/**
	 * Sets the premium status.
	 *
	 * This method updates the premium status of the plugin or theme.
	 *
	 * @param bool $status True if premium is active, false otherwise.
	 * @return void
	 */
	public function set_premium_status( $status ) {
		$this->is_premium = $status;
	}

	/**
	 * Retrieves the premium status.
	 *
	 * This method returns the premium status. If the status has not been set,
	 * it defaults to false.
	 *
	 * @return bool True if premium is active, false otherwise.
	 */
	public function is_premium() {
		return $this->is_premium;
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {
		$lang_dir = ROOTBLOX_PLUGIN_DIR . 'languages/';

		load_plugin_textdomain( 'rootblox', false, $lang_dir );
	}
}
