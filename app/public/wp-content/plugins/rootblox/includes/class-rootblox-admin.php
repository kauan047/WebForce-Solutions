<?php
namespace Rootblox;

class Rootblox_Admin {
	/**
	 * The single instance of the Rootblox_Admin class.
	 *
	 * This static variable holds the single instance of the class and ensures
	 * that only one instance of the class is created (Singleton pattern).
	 *
	 * @var Rootblox_Admin|null The single instance of the Rootblox_Admin class or null if not instantiated.
	 */
	private static $instance = null;

	/**
	 * The directory path for the admin folder.
	 *
	 * This variable stores the file path to the plugin's admin directory.
	 * It is used to load admin-related files from the plugin's directory.
	 *
	 * @var string The full path to the admin directory within the plugin.
	 */
	private static $dir = ROOTBLOX_PLUGIN_DIR . 'admin/';

	/**
	 * The URL for the admin folder.
	 *
	 * This variable stores the URL to the plugin's admin directory.
	 * It is used to reference admin-related files that are publicly accessible on the web.
	 *
	 * @var string The URL to the admin directory within the plugin.
	 */
	private static $url = ROOTBLOX_PLUGIN_URL . 'admin/';

	/**
	 * Retrieves the single instance of the Rootblox_Admin class.
	 *
	 * This method implements the Singleton pattern, ensuring that only
	 * one instance of the Rootblox_Admin class is created and used throughout
	 * the application. If the instance doesn't exist yet, it will be created.
	 *
	 * @return Rootblox_Admin The single instance of the Rootblox_Admin class.
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
	 * This is the constructor for the class. It is automatically called when an instance of the class is created.
	 * As it stands, this constructor does not perform any specific actions, but it can be expanded to initialize
	 * properties, set up necessary configurations, or handle dependencies when needed.
	 *
	 * @access private
	 */
	private function __construct() {
		$this->load_admin_files();

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
		add_action( 'admin_menu', array( $this, 'register_admin_page' ) );
	}

	/**
	 * Enqueue admin-specific styles and scripts for the Rootblox plugin.
	 *
	 * This function loads custom styles and JavaScript files used in the WordPress admin dashboard
	 * for the Rootblox plugin interface.
	 *
	 * @return void
	 */
	public function enqueue_admin_assets() {
		$current_screen = get_current_screen();

		// Load Notice Styles.
		wp_enqueue_style( 'rootblox--notice-style', self::$url . 'assets/css/admin-notice.css', array(), ROOTBLOX_VERSION, false );

		if ( 'toplevel_page__rootblox' === $current_screen->id ) {
			// Load Admin Styles.
			wp_enqueue_style( 'rootblox--admin-style', self::$url . 'assets/css/admin-styles.css', array(), ROOTBLOX_VERSION, false );

			// Load Admin Script.
			wp_enqueue_script( 'rootblox--admin-script', self::$url . 'assets/js/admin-scripts.js', array( 'jquery' ), ROOTBLOX_VERSION, false );
			wp_localize_script(
				'rootblox--admin-script',
				'scriptObj',
				array(
					'ajaxURL'          => admin_url( 'admin-ajax.php' ),
					'welcomeNonce'     => wp_create_nonce( 'rootblox-welcome-notice-dismissable' ),
					'blockStatusNonce' => wp_create_nonce( 'rootblox-block-status' ),
				)
			);
		}
	}

	/**
	 * Register the Rootblox admin menu page and dashboard submenu.
	 *
	 * Adds a top-level menu item called "Rootblox" to the WordPress admin sidebar,
	 * along with a submenu item for the Dashboard. The admin page is restricted to users
	 * with the 'manage_options' capability.
	 *
	 * @return void
	 */
	public function register_admin_page() {
		if ( ! menu_page_url( '_rootblox' ) ) {
			add_menu_page( 'Rootblox', 'Rootblox', 'manage_options', '_rootblox', array( $this, 'admin_dashboard_render' ), self::$url . 'assets/img/rootblox-dark.png', 2 );
			add_submenu_page(
				'_rootblox',
				'Dashboard',
				__( 'Dashboard', 'rootblox' ),
				'manage_options',
				'_rootblox',
			);

		}
	}

	/**
	 * Render the content of the Rootblox dashboard admin page.
	 *
	 * Includes the dashboard.php template file, which contains the markup for the admin interface.
	 *
	 * @return void
	 */
	public function admin_dashboard_render() {
		include_once self::$dir . 'dashboard.php';
	}

	/**
	 * Loads admin-only files required for the plugin's backend functionality.
	 *
	 * This method includes admin-related PHP files such as admin notices,
	 * settings pages, or dashboard widgets.
	 *
	 * @access private
	 * @return void
	 */
	private function load_admin_files() {
		if ( is_admin() ) {
			require_once self::$dir . 'helpers/helper.php';
			include_once self::$dir . 'admin-notice.php';
		}
	}
}
