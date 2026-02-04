<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://matyus.me/about
 * @since             1.0.0
 * @package           Seed_Components
 *
 * @wordpress-plugin
 * Plugin Name:       ACF Seed Components
 * Plugin URI:        https://matyus.me
 * Description:       ACF powered Gutenberg Components to get any website started where data is saved in fields in chunks instead of blobs. Because blobs suck! And chunks rule!
 * Version:           1.0.0
 * Author:            Arpad Lehel Matyus
 * Author URI:        https://matyus.me/about/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       seed-components
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */

/**
 * Enable debug logging.
 * Set to true to enable error_log debugging throughout the plugin.
 */
if ( ! defined( 'SDCMPS_DEBUG' ) ) {
	define( 'SDCMPS_DEBUG', true );
}

/**
 * Enable WordPress debug flags for error_log.
 * Only enabled if SDCMPS_DEBUG is true and flags aren't already set.
 */
	if ( ! defined( 'WP_DEBUG' ) ) {
		define( 'WP_DEBUG', true );
	}
	if ( ! defined( 'WP_DEBUG_LOG' ) ) {
		define( 'WP_DEBUG_LOG', true );
	}
	if ( ! defined( 'WP_DEBUG_DISPLAY' ) ) {
		define( 'WP_DEBUG_DISPLAY', false );
	}

/**
 * Check if ACF is active and has required version.
 * ACF blocks require ACF 6.0.0 or higher.
 */
function sdcmps_check_acf_dependency() {
	// Check if ACF class exists (more reliable than function check)
	if ( ! class_exists( 'ACF' ) && ! function_exists( 'acf' ) ) {
		add_action( 'admin_notices', 'sdcmps_acf_missing_notice' );
		add_action( 'admin_init', 'sdcmps_deactivate_plugin' );
		return false;
	}

	// Check ACF version (blocks require ACF 6.0.0+)
	$acf_version = null;
	if ( defined( 'ACF_VERSION' ) ) {
		$acf_version = constant( 'ACF_VERSION' );
	} elseif ( function_exists( 'acf_get_setting' ) ) {
		// Try to get version from ACF instance
		$acf_version = acf_get_setting( 'version' );
	}

	if ( $acf_version && version_compare( $acf_version, '6.0.0', '<' ) ) {
		add_action( 'admin_notices', 'sdcmps_acf_version_notice' );
		add_action( 'admin_init', 'sdcmps_deactivate_plugin' );
		return false;
	}

	return true;
}

/**
 * Display admin notice when ACF is missing.
 */
function sdcmps_acf_missing_notice() {
	?>
	<div class="notice notice-error">
		<p><strong><?php esc_html_e( 'ACF Seed Components', 'seed-components' ); ?></strong>: <?php esc_html_e( 'This plugin requires Advanced Custom Fields (ACF) to be installed and active.', 'seed-components' ); ?></p>
	</div>
	<?php
}

/**
 * Display admin notice when ACF version is too old.
 */
function sdcmps_acf_version_notice() {
	?>
	<div class="notice notice-error">
		<p><strong><?php esc_html_e( 'ACF Seed Components', 'seed-components' ); ?></strong>: <?php esc_html_e( 'This plugin requires Advanced Custom Fields (ACF) version 6.0.0 or higher. Please update ACF.', 'seed-components' ); ?></p>
	</div>
	<?php
}

/**
 * Deactivate the plugin.
 */
function sdcmps_deactivate_plugin() {
	deactivate_plugins( plugin_basename( __FILE__ ) );
}

// Check ACF dependency before loading plugin
if ( ! sdcmps_check_acf_dependency() ) {
	return;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-seed-components-activator.php
 */
function activate_seed_components() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-seed-components-activator.php';
	Seed_Components_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-seed-components-deactivator.php
 */
function deactivate_seed_components() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-seed-components-deactivator.php';
	Seed_Components_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_seed_components' );
register_deactivation_hook( __FILE__, 'deactivate_seed_components' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-seed-components.php';

/**
 * Load image sizes utility
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-sdcmps-image-sizes.php';

/**
 * Register the Seed Components block category.
 *
 * @since    1.0.0
 * @param    array $categories Array of block categories.
 * @param    object $editor_context The editor context.
 * @return   array Modified array of block categories.
 */
function sdcmps_register_block_category( $categories, $editor_context ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'seed-components',
				'title' => __( 'Seed Components', 'seed-components' ),
				'icon'  => null,
			),
		)
	);
}
add_filter( 'block_categories_all', 'sdcmps_register_block_category', 10, 2 );

/**
 * Register all seed component blocks.
 *
 * @since    1.0.0
 */
function sdcmps_register_blocks() {
	$plugin_dir = plugin_dir_path( __FILE__ );
	$components_dir = $plugin_dir . 'components';

	if ( ! is_dir( $components_dir ) ) {
		return;
	}

	$items = scandir( $components_dir );
	foreach ( $items as $item ) {
		if ( $item[0] === '.' ) {
			continue;
		}

		$block_path = $components_dir . '/' . $item;
		if ( is_dir( $block_path ) && file_exists( $block_path . '/block.json' ) ) {
			// Load fields.php if it exists
			$fields_path = $block_path . '/fields.php';
			if ( file_exists( $fields_path ) ) {
				try {
					require_once $fields_path;
				} catch ( Exception $e ) {
					// Silently fail if fields.php has errors
				}
			}
			
			// Register the block
			register_block_type( $block_path );
		}
	}
}
add_action( 'init', 'sdcmps_register_blocks' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_seed_components() {

	$plugin = new Seed_Components();
	$plugin->run();

}
run_seed_components();
