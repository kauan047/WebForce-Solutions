<?php
namespace Rootblox;

class Rootblox_Resources {
	/**
	 * The single instance of the Rootblox_Resources class.
	 *
	 * This static variable holds the single instance of the class and ensures
	 * that only one instance of the class is created (Singleton pattern).
	 *
	 * @var Rootblox_Resources|null The single instance of the Rootblox_Resources class or null if not instantiated.
	 */
	private static $instance = null;

	/**
	 * The directory path for plugin resources.
	 *
	 * This variable stores the file path to the plugin's resources directory.
	 * It is used to load resource files from the plugin's directory.
	 *
	 * @var string The full path to the resources directory within the plugin.
	 */
	private static $dir = ROOTBLOX_PLUGIN_DIR . 'resources/';

	/**
	 * The URL for plugin resources.
	 *
	 * This variable stores the URL to the plugin's resources directory.
	 * It is used to reference resource files that are publicly accessible on the web.
	 *
	 * @var string The URL to the resources directory within the plugin.
	 */
	private static $url = ROOTBLOX_PLUGIN_URL . 'resources/';

	/**
	 * The URL for plugin vendor.
	 *
	 * This variable stores the URL to the plugin's vendor directory.
	 * It is used to reference resource files that are publicly accessible on the web.
	 *
	 * @var string The URL to the vendor directory within the plugin.
	 */
	private static $vendor_url = ROOTBLOX_PLUGIN_URL . 'vendor/';

	/**
	 * Retrieves the single instance of the Rootblox_Resources class.
	 *
	 * This method implements the Singleton pattern, ensuring that only
	 * one instance of the Rootblox_Resources class is created and used throughout
	 * the application. If the instance doesn't exist yet, it will be created.
	 *
	 * @return Rootblox_Resources The single instance of the Rootblox_Resources class.
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
	 * This constructor is used to hook into WordPress actions for enqueuing block assets. It adds two actions:
	 * - `enqueue_block_editor_assets`: Calls the `cthf_enqueue_editor_assets` method to enqueue editor-specific assets.
	 * - `enqueue_block_assets`: Calls the `cthf_enqueue_block_global_assets` method to enqueue global block assets.
	 *
	 * This ensures that the necessary JavaScript and CSS files are loaded when editing blocks in the block editor
	 * and on the frontend for global assets.
	 *
	 * @access private
	 */
	private function __construct() {
		add_action( 'enqueue_block_editor_assets', array( $this, 'cthf_enqueue_editor_assets' ) );
		add_action( 'enqueue_block_assets', array( $this, 'cthf_enqueue_block_global_assets' ) );

		$this->enqueue_resource_files();
		$this->include_vendors();
	}

	/**
	 * Enqueues editor-specific assets for the block editor.
	 *
	 * This function is hooked into the `enqueue_block_editor_assets` action. It should be used to enqueue
	 * JavaScript, CSS, or other assets that are only needed within the block editor environment.
	 * Currently, the function does not contain any specific implementation but can be extended to
	 * include necessary assets like block editor styles, scripts, or any other resources required
	 * for block editing.
	 *
	 * @return void
	 */
	public function cthf_enqueue_editor_assets() {
	}

	/**
	 * Enqueues global assets for custom blocks.
	 *
	 * This function is hooked into the `enqueue_block_assets` action to load global styles for the blocks.
	 * It enqueues the necessary CSS files that are applied both in the block editor and the frontend.
	 * These assets include editor styles, global block styles, and pattern-specific styles, ensuring
	 * consistent visual presentation across the editor and the website.
	 *
	 * @return void
	 */
	public function cthf_enqueue_block_global_assets() {
		wp_enqueue_script( 'cthf-blocks--pattern-scripts', self::$url . 'js/pattern-scripts.js', array( 'jquery' ), ROOTBLOX_VERSION, true );

		wp_enqueue_style( 'cthf-blocks--editor-styles', self::$url . 'css/block-editor.css', array(), ROOTBLOX_VERSION, 'all' );
		wp_enqueue_style( 'cthf-blocks--global-styles', self::$url . 'css/block-styles.css', array(), ROOTBLOX_VERSION, 'all' );
		wp_enqueue_style( 'cthf-blocks--pattern-styles', self::$url . 'css/pattern-styles.css', array(), ROOTBLOX_VERSION, 'all' );
	}

	/**
	 * Includes additional resource files required by the theme.
	 *
	 * This private method loads external resource definitions, such as Google Fonts,
	 * by including necessary PHP files. Currently, it includes the `google-fonts.php`
	 * file which contains the list or logic related to Google Fonts used in blocks.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	private function enqueue_resource_files() {
		include_once self::$dir . 'fonts/google-fonts.php';
	}

	/**
	 * Registers vendor script loading actions for the plugin.
	 *
	 * This method hooks into the 'wp_enqueue_scripts' action to ensure
	 * external vendor scripts like Luxon are enqueued on the frontend.
	 *
	 * @return void
	 */
	public function include_vendors() {
		add_action( 'wp_enqueue_scripts', array( $this, 'load_luxon_scripts' ) );
	}

	/**
	 * Enqueues the Luxon JavaScript library from the plugin's vendor directory.
	 *
	 * The script is enqueued on the frontend with a handle of 'rootblox--luxon'.
	 * It is loaded in the header (not deferred), and versioned using ROOTBLOX_VERSION.
	 *
	 * @return void
	 */
	public function load_luxon_scripts() {
		wp_enqueue_script( 'rootblox--luxon', self::$vendor_url . 'luxon/luxon.js', array(), ROOTBLOX_VERSION, false );
	}
}
