<?php
/**
 * Image Utility Class
 *
 * Utility class for handling image operations in Seed Components.
 * Similar to Atomic_Image_Utility but with SDCMPS prefix.
 *
 * @link       https://matyus.me/about
 * @since      1.0.0
 *
 * @package    Seed_Components
 * @subpackage Seed_Components/utils
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Image Utility class.
 *
 * @since      1.0.0
 * @package    Seed_Components
 * @subpackage Seed_Components/utils
 * @author     Arpad Lehel Matyus <contact@matyus.me>
 */
class SDCMPS_Image_Utility {

	/**
	 * The image object ID.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      int|string    $img_obj_id    The image attachment ID.
	 */
	private $img_obj_id;

	/**
	 * Constructor for SDCMPS_Image_Utility class.
	 *
	 * @since    1.0.0
	 * @param    int|string $img_obj_id The image attachment ID.
	 */
	public function __construct( $img_obj_id ) {
		$this->img_obj_id = empty( $img_obj_id ) ? '' : $img_obj_id;
	}

	/**
	 * Check if the image object ID is valid.
	 *
	 * @since    1.0.0
	 * @return   bool Returns true if the ID is valid, false otherwise.
	 */
	private function check_id() {
		if ( empty( $this->img_obj_id ) ) {
			return false;
		}
		return true;
	}

	/**
	 * Output a simple image tag using wp_get_attachment_image.
	 *
	 * @since    1.0.0
	 * @param    string $size The image size.
	 * @param    array  $additional_classes Additional CSS classes.
	 * @param    array  $additional_attributes Additional HTML attributes.
	 */
	public function img_tag_simple( $size = 'full', $additional_classes = array(), $additional_attributes = array() ) {
		if ( ! $this->check_id() ) {
			return;
		}

		$classes = array_merge( array( 'sdcmps-img' ), $additional_classes );
		$attributes = array_merge(
			array( 'class' => esc_attr( implode( ' ', $classes ) ) ),
			$additional_attributes
		);

		echo wp_kses(
			wp_get_attachment_image( $this->img_obj_id, $size, false, $attributes ),
			array(
				'img' => array(
					'src'      => true,
					'srcset'   => true,
					'sizes'    => true,
					'loading'  => true,
					'decoding' => true,
					'style'    => true,
					'title'    => true,
					'class'    => true,
					'alt'      => true,
					'width'    => true,
					'height'   => true,
				),
			)
		);
	}

	/**
	 * Render an image tag with cover mode styling.
	 *
	 * @since    1.0.0
	 * @param    string $size The image size.
	 * @param    array  $additional_classes Additional CSS classes.
	 * @param    array  $additional_attributes Additional HTML attributes.
	 */
	public function img_tag_cover( $size = 'full', $additional_classes = array(), $additional_attributes = array() ) {
		if ( ! $this->check_id() ) {
			return;
		}

		$classes = array_merge( array( 'sdcmps-img', 'sdcmps-img--cover' ), $additional_classes );
		$attributes = array_merge(
			array( 'class' => esc_attr( implode( ' ', $classes ) ) ),
			$additional_attributes
		);

		echo wp_kses(
			wp_get_attachment_image( $this->img_obj_id, $size, false, $attributes ),
			array(
				'img' => array(
					'src'      => true,
					'srcset'   => true,
					'sizes'    => true,
					'loading'  => true,
					'decoding' => true,
					'style'    => true,
					'title'    => true,
					'class'    => true,
					'alt'      => true,
					'width'    => true,
					'height'   => true,
				),
			)
		);
	}

	/**
	 * Output the URL of the image.
	 *
	 * @since    1.0.0
	 * @param    string $size The image size.
	 * @return   string|false The image URL or false on failure.
	 */
	public function url( $size = 'full' ) {
		if ( ! $this->check_id() ) {
			return false;
		}
		return wp_get_attachment_image_url( $this->img_obj_id, $size );
	}

	/**
	 * Get the image source URL.
	 *
	 * @since    1.0.0
	 * @param    string $size The image size.
	 * @return   string|false The image URL or false on failure.
	 */
	public function src( $size = 'full' ) {
		if ( ! $this->check_id() ) {
			return false;
		}
		$image_data = wp_get_attachment_image_src( $this->img_obj_id, $size );
		return $image_data ? $image_data[0] : false;
	}

	/**
	 * Get the image source set.
	 *
	 * @since    1.0.0
	 * @param    string $size The image size.
	 * @return   string|false The srcset string or false on failure.
	 */
	public function srcset( $size = 'full' ) {
		if ( ! $this->check_id() ) {
			return false;
		}
		return wp_get_attachment_image_srcset( $this->img_obj_id, $size );
	}

	/**
	 * Return image tag as string (simple mode).
	 *
	 * @since    1.0.0
	 * @param    string $size The image size.
	 * @param    array  $additional_classes Additional CSS classes.
	 * @return   string|false The image HTML or false on failure.
	 */
	public function return_image_tag_simple( $size = 'full', $additional_classes = array() ) {
		if ( ! $this->check_id() ) {
			return false;
		}

		$classes = array_merge( array( 'sdcmps-img' ), $additional_classes );
		$attributes = array( 'class' => esc_attr( implode( ' ', $classes ) ) );

		return wp_get_attachment_image( $this->img_obj_id, $size, false, $attributes );
	}
}

