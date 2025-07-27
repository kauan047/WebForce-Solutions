<?php
namespace Rootblox;

class Rootblox_Blocks {
	/**
	 * The single instance of the Rootblox_Blocks class.
	 *
	 * This static variable holds the single instance of the class and ensures
	 * that only one instance of the class is created (Singleton pattern).
	 *
	 * @var Rootblox_Blocks|null The single instance of the Rootblox_Blocks class or null if not instantiated.
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
	private static $dir = ROOTBLOX_PLUGIN_DIR . 'blocks/';

	/**
	 * The URL for the blocks folder.
	 *
	 * This variable stores the URL to the plugin's blocks directory.
	 * It is used to reference block-related files that are publicly accessible on the web.
	 *
	 * @var string The URL to the blocks directory within the plugin.
	 */
	private static $url = ROOTBLOX_PLUGIN_URL . 'blocks/';

	/**
	 * Retrieves the single instance of the Rootblox_Blocks class.
	 *
	 * This method implements the Singleton pattern, ensuring that only
	 * one instance of the Rootblox_Blocks class is created and used throughout
	 * the application. If the instance doesn't exist yet, it will be created.
	 *
	 * @return Rootblox_Blocks The single instance of the Rootblox_Blocks class.
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
	 * Hooks into WordPress to:
	 * - Register a custom block category using the 'block_categories_all' filter.
	 * - Enqueue custom blocks on the 'init' action.
	 *
	 * @access private
	 */
	private function __construct() {
		add_filter( 'block_categories_all', array( $this, 'cthf_register_block_category' ), PHP_INT_MAX, 2 );

		add_action( 'init', array( $this, 'cthf_enqueue_blocks' ) );
	}

	/**
	 * Registers a custom block category for the block editor.
	 *
	 * This function registers a new block category for the Gutenberg block editor by merging
	 * a custom category, "Rootblox," into the existing categories. The new category will be
	 * available in the block selection interface in the WordPress admin.
	 *
	 * @param array $categories An array of existing block categories.
	 *
	 * @return array The modified array of block categories, including the new 'Rootblox' category.
	 */
	public function cthf_register_block_category( $categories ) {
		return array_merge(
			array(
				array(
					'slug'  => 'rootblox-header',
					'title' => __( 'Rootblox — Header Elements', 'rootblox' ),
				),
				array(
					'slug'  => 'rootblox-footer',
					'title' => __( 'Rootblox — Footer Elements', 'rootblox' ),
				),
			),
			$categories
		);
	}

	/**
	 * Enqueues block assets (scripts and styles) for custom Gutenberg blocks.
	 *
	 * This function registers and enqueues the necessary JavaScript and CSS files for each custom block
	 * in the plugin. It handles different assets for the block editor (editor script and editor style)
	 * as well as frontend scripts and styles. It ensures that the necessary assets are loaded based on
	 * the existence of the files in the block's build directory.
	 *
	 * @return void
	 */
	public function cthf_enqueue_blocks() {
		// Enqueue core block styles.
		$this->register_core_block_styles();

		$cthf_blocks = glob( self::$dir . '*/build' );
		foreach ( $cthf_blocks as $block_dir ) {
			$path_parts = explode( '/', $block_dir );
			$block_name = $path_parts[ count( $path_parts ) - 2 ];

			$can_register_block = apply_filters( 'rootblox_block_registration_status', $block_name );

			if ( ! is_dir( $block_dir ) || ! $can_register_block ) {
				continue;
			}

			register_block_type( $block_dir );

			$asset_file = $this->asset_file_values( trailingslashit( $block_dir ) . 'index.asset.php' );
			// Editor script.
			if ( file_exists( trailingslashit( self::$dir . $block_name ) . 'build/index.js' ) ) {
				wp_register_script( 'cthf-blocks--' . $block_name, trailingslashit( self::$url . $block_name ) . 'build/index.js', $asset_file['dependencies'], $asset_file['version'], false );
				wp_localize_script(
					'cthf-blocks--' . $block_name,
					'cthfAssets',
					array(
						'img'         => ROOTBLOX_PLUGIN_URL . 'resources/img/',
						'isPremium'   => filter_var( apply_filters( 'rootblox_premium_check', null ), FILTER_VALIDATE_BOOLEAN ),
						'siteURL'     => get_site_url(),
						'googleFonts' => rootblox_google_fonts(),
						'siteLogoURL' => wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), 'full' ),
						'upsellURL'   => rootblox_get_upsell_url(),
						'siteTitle'   => get_bloginfo( 'name' ),
					)
				);
			}

			// Editor style.
			if ( file_exists( trailingslashit( self::$dir . $block_name ) . 'build/index.css' ) ) {
				wp_register_style( 'cthf-blocks--' . $block_name . '--editor-style', trailingslashit( self::$url . $block_name ) . 'build/index.css', array(), $asset_file['version'] );

				if ( function_exists( 'wp_set_script_translations' ) ) {
					/**
					 * Adds internalization support
					 */
					wp_set_script_translations( 'cthf-blocks--' . $block_name . '--editor-style', 'rootblox' );
				}
			}

			// Common style.
			if ( file_exists( trailingslashit( self::$dir . $block_name ) . 'build/style-index.css' ) ) {
				wp_register_style( 'cthf-blocks--' . $block_name . '--style', trailingslashit( self::$url . $block_name ) . 'build/style-index.css', array(), $asset_file['version'] );
			}

			// Frontend script.
			if ( file_exists( ROOTBLOX_PLUGIN_DIR . 'frontend/' . $block_name . '.js' ) ) {
				wp_register_script( 'cthf-blocks--' . $block_name . '--frontend-script', ROOTBLOX_PLUGIN_URL . 'frontend/' . $block_name . '.js', array( 'jquery' ), ROOTBLOX_VERSION, false );
			}
		}
	}

	/**
	 * Include asset path if exists to fetch dependencies and version.
	 *
	 * @param string $path location to the index.asset.php.
	 * @return array
	 */
	private function asset_file_values( string $path ): array {
		$asset_path = $path;

		return file_exists( $asset_path )
			? include $asset_path
			: array(
				'dependencies' => array(),
				'version'      => $version ?? ROOTBLOX_VERSION,
			);
	}

	/**
	 * Registers custom block styles for core blocks.
	 *
	 * This function registers a custom style for the core "Search" block.
	 * The style adds a modal overlay effect, allowing the search block
	 * to be displayed as a modal popup.
	 *
	 * - Style Name: `cthf__search-modal-overlay`
	 * - Style Label: "Modal Search"
	 * - Applies to: `core/search` block
	 *
	 * @since 1.0.0
	 */
	private function register_core_block_styles() {
		register_block_style(
			'core/search',
			array(
				'name'         => 'cthf__search-modal-overlay',
				'label'        => __( 'Modal Search', 'rootblox' ),
				'style_handle' => 'cthf-blocks--header--style',
			)
		);
	}
}
