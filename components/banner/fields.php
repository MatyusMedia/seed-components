<?php
/**
 * ACF Fields for Banner Block
 *
 * This file registers all ACF fields for the banner block.
 * Fields are registered as a minimal field group that targets this specific block.
 *
 * @package Seed_Components
 */

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

// Register field group for banner block
acf_add_local_field_group(
	array(
		'key'    => 'group_banner_block',
		'title'  => __( 'Banner Block Fields', 'seed-components' ),
		'fields' => array(
			// Lead Text field
			array(
				'key'           => 'field_banner_lead_text',
				'label'         => __( 'Lead Text', 'seed-components' ),
				'name'          => 'lead_text',
				'type'          => 'text',
				'default_value' => '',
				'placeholder'   => __( 'Enter lead text', 'seed-components' ),
			),
			// Title field
			array(
				'key'           => 'field_banner_title',
				'label'         => __( 'Title', 'seed-components' ),
				'name'          => 'title',
				'type'          => 'text',
				'default_value' => '',
				'placeholder'   => __( 'Enter banner title', 'seed-components' ),
			),
			// Heading Type field
			array(
				'key'           => 'field_banner_heading_type',
				'label'         => __( 'Heading Type', 'seed-components' ),
				'name'          => 'heading_type',
				'type'          => 'select',
				'choices'       => array(
					'h1' => __( 'H1', 'seed-components' ),
					'h2' => __( 'H2', 'seed-components' ),
					'h3' => __( 'H3', 'seed-components' ),
					'h4' => __( 'H4', 'seed-components' ),
				),
				'default_value' => 'h2',
				'allow_null'    => 0,
				'multiple'      => 0,
				'ui'            => 1,
				'return_format' => 'value',
			),
			// Text/Description field
			array(
				'key'           => 'field_banner_text',
				'label'         => __( 'Text', 'seed-components' ),
				'name'          => 'text',
				'type'          => 'textarea',
				'rows'          => 4,
				'default_value' => '',
				'placeholder'   => __( 'Enter banner text', 'seed-components' ),
			),
			// Background Image field
			array(
				'key'           => 'field_banner_image',
				'label'         => __( 'Background Image', 'seed-components' ),
				'name'          => 'image',
				'type'          => 'image',
				'return_format' => 'array',
				'preview_size'  => 'medium',
				'library'       => 'all',
				'instructions'  => __( 'This image will be used as the banner background.', 'seed-components' ),
			),
			// Background Color field
			array(
				'key'           => 'field_banner_bg_color',
				'label'         => __( 'Background Color', 'seed-components' ),
				'name'          => 'background_color',
				'type'          => 'color_picker',
				'default_value' => '#ffffff',
			),
			// Height field
			array(
				'key'           => 'field_banner_height',
				'label'         => __( 'Height', 'seed-components' ),
				'name'          => 'height',
				'type'          => 'select',
				'choices'       => array(
					'auto'   => __( 'Auto', 'seed-components' ),
					'small'  => __( 'Small', 'seed-components' ),
					'medium' => __( 'Medium', 'seed-components' ),
					'large'  => __( 'Large', 'seed-components' ),
				),
				'default_value' => 'auto',
				'allow_null'    => 0,
				'multiple'      => 0,
				'ui'            => 1,
				'return_format' => 'value',
			),
			// Button Text field
			array(
				'key'           => 'field_banner_button_text',
				'label'         => __( 'Button Text', 'seed-components' ),
				'name'          => 'button_text',
				'type'          => 'text',
				'default_value' => '',
				'placeholder'   => __( 'Enter button text', 'seed-components' ),
			),
			// Button Link field
			array(
				'key'           => 'field_banner_button_link',
				'label'         => __( 'Button Link', 'seed-components' ),
				'name'          => 'button_link',
				'type'          => 'url',
				'default_value' => '',
				'placeholder'   => __( 'https://example.com', 'seed-components' ),
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'block',
					'operator' => '==',
					'value'    => 'seed-components/banner',
				),
			),
		),
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen'         => '',
		'active'                => true,
		'description'           => __( 'Fields for the Banner block', 'seed-components' ),
	)
);

