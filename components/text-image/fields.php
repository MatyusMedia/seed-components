<?php
/**
 * ACF Fields for Text Image Block
 *
 * This file registers all ACF fields for the text-image block.
 * Fields are registered as a minimal field group that targets this specific block.
 *
 * @package Seed_Components
 */

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

// Register field group for text-image block
acf_add_local_field_group(
	array(
		'key'    => 'group_text_image_block',
		'title'  => __( 'Text Image Block Fields', 'seed-components' ),
		'fields' => array(
			// Image Position field
			array(
				'key'           => 'field_text_image_position',
				'label'         => __( 'Image Position', 'seed-components' ),
				'name'          => 'image_position',
				'type'          => 'select',
				'choices'       => array(
					'left'  => __( 'Left', 'seed-components' ),
					'right' => __( 'Right', 'seed-components' ),
				),
				'default_value' => 'left',
				'allow_null'    => 0,
				'multiple'      => 0,
				'ui'            => 1,
				'return_format' => 'value',
			),
			// Layout Ratio field
			array(
				'key'           => 'field_text_image_layout',
				'label'         => __( 'Layout Ratio', 'seed-components' ),
				'name'          => 'layout_ratio',
				'type'          => 'select',
				'choices'       => array(
					'25-75' => __( '25% - 75%', 'seed-components' ),
					'30-70' => __( '30% - 70%', 'seed-components' ),
					'50-50' => __( '50% - 50%', 'seed-components' ),
					'70-30' => __( '70% - 30%', 'seed-components' ),
					'75-25' => __( '75% - 25%', 'seed-components' ),
				),
				'default_value' => '50-50',
				'allow_null'    => 0,
				'multiple'      => 0,
				'ui'            => 1,
				'return_format' => 'value',
			),
			// Text Align field
			array(
				'key'           => 'field_text_image_text_align',
				'label'         => __( 'Text Align', 'seed-components' ),
				'name'          => 'text_align',
				'type'          => 'select',
				'choices'       => array(
					'left'   => __( 'Left', 'seed-components' ),
					'center' => __( 'Center', 'seed-components' ),
					'right'  => __( 'Right', 'seed-components' ),
				),
				'default_value' => 'center',
				'allow_null'    => 0,
				'multiple'      => 0,
				'ui'            => 1,
				'return_format' => 'value',
			),
			// Lead Text field
			array(
				'key'           => 'field_text_image_lead',
				'label'         => __( 'Lead Text', 'seed-components' ),
				'name'          => 'lead_text',
				'type'          => 'text',
				'default_value' => '',
				'placeholder'   => __( 'Enter lead text', 'seed-components' ),
			),
			// Image field (ID format)
			array(
				'key'           => 'field_text_image_image',
				'label'         => __( 'Image', 'seed-components' ),
				'name'          => 'image',
				'type'          => 'image',
				'return_format' => 'id',
				'preview_size'  => 'medium',
				'library'       => 'all',
				'required'      => 1,
			),
			// Image Layout field
			array(
				'key'           => 'field_text_image_image_layout',
				'label'         => __( 'Image Layout', 'seed-components' ),
				'name'          => 'image_layout',
				'type'          => 'select',
				'choices'       => array(
					'normal' => __( 'Normal', 'seed-components' ),
					'cover'  => __( 'Cover', 'seed-components' ),
				),
				'default_value' => 'normal',
				'allow_null'    => 0,
				'multiple'      => 0,
				'ui'            => 1,
				'return_format' => 'value',
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'block',
					'operator' => '==',
					'value'    => 'seed-components/text-image',
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
		'description'           => __( 'Fields for the Text Image block', 'seed-components' ),
	)
);

