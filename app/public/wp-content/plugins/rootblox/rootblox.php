<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://cozythemes.com/
 * @since             1.0.0
 * @package           Rootblox
 *
 * @wordpress-plugin
 * Plugin Name:       Rootblox
 * Plugin URI:        https://rootblox.cozythemes.com/
 * Description:       Create headers and footers with multiple block patterns. Easily customize layout and style for a polished look!
 * Version:           1.0.5
 * Author:            CozyThemes
 * Author URI:        https://cozythemes.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rootblox
 * Domain Path:       /languages/
 * Requires at least: 5.8
 * Requires PHP: 7.3
 */


// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ROOTBLOX_VERSION', '1.0.5' );
define( 'ROOTBLOX_PLUGIN_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'ROOTBLOX_PLUGIN_URL', trailingslashit( plugins_url( '', __FILE__ ) ) );

if ( ! class_exists( 'Cozy_Addons' ) || ( class_exists( 'Cozy_Addons' ) && ! cozy_addons_premium_access() ) ) {
	if ( ! function_exists( 'roo_fs' ) ) {
		// Create a helper function for easy SDK access.
		function roo_fs() {
			global $roo_fs;

			if ( ! isset( $roo_fs ) ) {
				// Include Freemius SDK.
				require_once __DIR__ . '/vendor/freemius/start.php';
				$roo_fs = fs_dynamic_init(
					array(
						'id'                  => '18056',
						'slug'                => 'rootblox',
						'type'                => 'plugin',
						'public_key'          => 'pk_489676545df9572234733e4bf7f36',
						'is_premium'          => true,
						'premium_suffix'      => 'Pro',
						// If your plugin is a serviceware, set this option to false.
						'has_premium_version' => false,
						'has_addons'          => false,
						'has_paid_plans'      => true,
						'menu'                => array(
							'slug'    => '_rootblox',
							'support' => false,
						),
					)
				);
			}

			return $roo_fs;
		}

		// Init Freemius.
		roo_fs();
		// Signal that SDK was initiated.
		do_action( 'roo_fs_loaded' );
	}
}

require_once ROOTBLOX_PLUGIN_DIR . 'vendor/autoload.php';

function rootblox_activator() {
	\Rootblox\Rootblox_Activate::activate();
}
register_activation_hook( __FILE__, 'rootblox_activator' );

function rootblox_deactivator() {
	\Rootblox\Rootblox_Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'rootblox_deactivator' );

\Rootblox\Rootblox_Init::get_instance();
