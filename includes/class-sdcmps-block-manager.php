<?php

/**
 * The file that defines the block manager class
 *
 * This class is responsible for automatically discovering and registering
 * ACF blocks from the components directory.
 *
 * @link       https://matyus.me/about
 * @since      1.0.0
 *
 * @package    Seed_Components
 * @subpackage Seed_Components/includes
 */

/**
 * Block Manager class.
 *
 * Scans the components directory for blocks and registers them with ACF.
 *
 * @since      1.0.0
 * @package    Seed_Components
 * @subpackage Seed_Components/includes
 * @author     Arpad Lehel Matyus <contact@matyus.me>
 */
class SDCMPS_Block_Manager {

	/**
	 * Get the plugin directory path.
	 *
	 * @since    1.0.0
	 * @return   string    The plugin directory path.
	 */
	private static function get_plugin_dir() {
		return plugin_dir_path( dirname( __FILE__ ) );
	}

	/**
	 * Get the components directory path.
	 *
	 * @since    1.0.0
	 * @return   string    The components directory path.
	 */
	private static function get_components_dir() {
		return self::get_plugin_dir() . 'components';
	}

	/**
	 * Get the theme components directory path.
	 *
	 * @since    1.0.0
	 * @return   string    The theme components directory path.
	 */
	private static function get_theme_components_dir() {
		return get_template_directory() . '/seed-components';
	}

	/**
	 * Register the Seed Components block category.
	 *
	 * @since    1.0.0
	 * @param    array $categories Array of block categories.
	 * @param    object $editor_context The editor context.
	 * @return   array Modified array of block categories.
	 */
	public static function register_block_category( $categories, $editor_context ) {
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

	/**
	 * Register all discovered blocks.
	 *
	 * @since    1.0.0
	 */
	public static function register_blocks() {
		// Register block category
		add_filter( 'block_categories_all', array( __CLASS__, 'register_block_category' ), 10, 2 );

		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		$blocks = self::discover_blocks();

		foreach ( $blocks as $block_name => $block_path ) {
			self::register_block( $block_name, $block_path );
		}
	}

	/**
	 * Discover all blocks in the components directory.
	 *
	 * @since    1.0.0
	 * @return   array    Array of block names and their paths.
	 */
	private static function discover_blocks() {
		$blocks = array();

		$components_dir = self::get_components_dir();
		$theme_components_dir = self::get_theme_components_dir();

		// Check if components directory exists
		if ( ! is_dir( $components_dir ) ) {
			return $blocks;
		}

		// Scan plugin components directory
		$plugin_blocks = self::scan_directory( $components_dir );

		// Scan theme override directory if it exists
		$theme_blocks = array();
		if ( is_dir( $theme_components_dir ) ) {
			$theme_blocks = self::scan_directory( $theme_components_dir );
		}

		// Merge blocks (theme overrides take precedence)
		$blocks = array_merge( $plugin_blocks, $theme_blocks );

		return $blocks;
	}

	/**
	 * Scan a directory for blocks.
	 *
	 * @since    1.0.0
	 * @param    string $dir The directory to scan.
	 * @return   array  Array of block names and their paths.
	 */
	private static function scan_directory( $dir ) {
		$blocks = array();

		if ( ! is_dir( $dir ) ) {
			return $blocks;
		}

		$items = scandir( $dir );

		foreach ( $items as $item ) {
			// Skip hidden files and directories
			if ( $item[0] === '.' ) {
				continue;
			}

			$block_path = trailingslashit( $dir ) . $item;

			// Check if it's a directory and has block.json
			if ( is_dir( $block_path ) && file_exists( $block_path . '/block.json' ) ) {
				$blocks[ $item ] = $block_path;
			}
		}

		return $blocks;
	}

	/**
	 * Register a single block.
	 *
	 * @since    1.0.0
	 * @param    string $block_name The block name (folder name).
	 * @param    string $block_path The full path to the block directory.
	 */
	private static function register_block( $block_name, $block_path ) {
		// Verify block.json exists
		$block_json_path = $block_path . '/block.json';
		if ( ! file_exists( $block_json_path ) ) {
			return;
		}

		// Load fields if fields.php exists
		$fields_path = $block_path . '/fields.php';
		if ( file_exists( $fields_path ) ) {
			try {
				require_once $fields_path;
			} catch ( Exception $e ) {
				// Silently fail if fields.php has errors
			}
		}

		// Simple block registration - WordPress and ACF will read block.json automatically
		register_block_type( $block_path );
	}

}

