<?php
namespace Rootblox\Api;

final class Api_Init {
	/**
	 * The single instance of the Api_Init class.
	 *
	 * This static variable holds the single instance of the class and ensures
	 * that only one instance of the class is created (Singleton pattern).
	 *
	 * @var Api_Init|null The single instance of the Api_Init class or null if not instantiated.
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
	private static $dir = ROOTBLOX_PLUGIN_DIR . 'core/api/';

	/**
	 * The URL for the blocks folder.
	 *
	 * This variable stores the URL to the plugin's blocks directory.
	 * It is used to reference block-related files that are publicly accessible on the web.
	 *
	 * @var string The URL to the blocks directory within the plugin.
	 */
	private static $url = ROOTBLOX_PLUGIN_URL . 'core/api/';

	/**
	 * Retrieves the single instance of the Api_Init class.
	 *
	 * This method implements the Singleton pattern, ensuring that only
	 * one instance of the Rootblox_Blocks class is created and used throughout
	 * the application. If the instance doesn't exist yet, it will be created.
	 *
	 * @return Api_Init The single instance of the Api_Init class.
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
	 * Registers a custom REST API endpoint for parsing and rendering block markup.
	 * The endpoint is:
	 * - Route: /wp-json/rootblox/v1/parse-block
	 * - Method: GET
	 * - Callback: rootblox_get_block_render()
	 *
	 * @access private
	 */
	private function __construct() {
		add_action( 'rest_api_init', array( $this, 'rootblox_register_routes' ) );
	}

	public function rootblox_register_routes() {
		register_rest_route(
			'rootblox/v1',
			'/parse-block',
			array(
				'methods'             => \WP_REST_Server::READABLE,
				'callback'            => array( $this, 'rootblox_get_block_render' ),
				'permission_callback' => '__return_true',
			)
		);
	}

	/**
	 * Callback for the /rootblox/v1/parse-block REST API endpoint.
	 *
	 * Accepts a block markup string and returns the rendered HTML using do_blocks().
	 * Only users with 'manage_options' capability can receive output.
	 *
	 * @param \WP_REST_Request $request The REST request containing 'markup' parameter.
	 *
	 * @return string Rendered block HTML or an empty string on failure or insufficient permissions.
	 */
	public function rootblox_get_block_render( \WP_REST_Request $request ) {
		if ( ! current_user_can( 'manage_options' ) ) {
			return '';
		}

		$menu_id = $request->get_param( 'menuID' ) ? sanitize_text_field( wp_unslash( $request->get_param( 'menuID' ) ) ) : '';

		if ( ! empty( $menu_id ) ) {
			$render = do_blocks( '<!-- wp:navigation {"ref":' . $menu_id . ', "overlayMenu": "never", "layout": {"type": "flex", "orientation":"vertical"}} /-->' );

			return $render;
		}

		return '';
	}
}
