<?php
/**
 * Image Sizes Utility Class
 *
 * Registers custom image sizes for seed components.
 *
 * @package Seed_Components
 */

if ( ! class_exists( 'SDCMPS_Image_Sizes' ) ) {

	/**
	 * Image Sizes class
	 */
	class SDCMPS_Image_Sizes {

		/**
		 * Register custom image sizes
		 *
		 * @since 1.0.0
		 */
		public static function register_image_sizes() {
			// Post Grid thumbnail size
			add_image_size( 'sdcmps_post_grid', 437, 251, true );
		}
	}

	// Register image sizes on after_setup_theme (better hook for image sizes)
	add_action( 'after_setup_theme', array( 'SDCMPS_Image_Sizes', 'register_image_sizes' ) );
}

