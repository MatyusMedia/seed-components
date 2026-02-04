<?php
/**
 * ACF Fields for Three in a Row Block
 *
 * This file registers all ACF fields for the three-in-a-row block.
 * Fields are registered as a minimal field group that targets this specific block.
 *
 * @package Seed_Components
 */

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

// Register field group for three-in-a-row block
acf_add_local_field_group(
	array(
		'key'    => 'group_three_in_a_row_block',
		'title'  => __( 'Three in a Row Block Fields', 'seed-components' ),
		'fields' => array(
			// Title field
			array(
				'key'           => 'field_three_in_a_row_title',
				'label'         => __( 'Title', 'seed-components' ),
				'name'          => 'title',
				'type'          => 'text',
				'default_value' => '',
				'placeholder'   => __( 'Enter title', 'seed-components' ),
			),
			// Text field
			array(
				'key'           => 'field_three_in_a_row_text',
				'label'         => __( 'Text', 'seed-components' ),
				'name'          => 'text',
				'type'          => 'textarea',
				'rows'          => 4,
				'default_value' => '',
				'placeholder'   => __( 'Enter text', 'seed-components' ),
			),
			// Items repeater field
			array(
				'key'               => 'field_three_in_a_row_items',
				'label'             => __( 'Items', 'seed-components' ),
				'name'              => 'items',
				'type'              => 'repeater',
				'instructions'       => __( 'Add items to display in a row', 'seed-components' ),
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'collapsed'         => '',
				'min'               => 0,
				'max'               => 0,
				'layout'            => 'block',
				'button_label'      => __( 'Add Item', 'seed-components' ),
				'sub_fields'        => array(
					// Icon dropdown
					array(
						'key'           => 'field_three_in_a_row_item_icon',
						'label'         => __( 'Icon', 'seed-components' ),
						'name'          => 'icon',
						'type'          => 'select',
						'choices'       => array(
							'box'       => __( 'Box', 'seed-components' ),
							'checkmark' => __( 'Checkmark', 'seed-components' ),
							'dialog'    => __( 'Dialog', 'seed-components' ),
						),
						'default_value' => '',
						'allow_null'    => 0,
						'multiple'      => 0,
						'ui'            => 1,
						'return_format' => 'value',
					),
					// Item Title
					array(
						'key'           => 'field_three_in_a_row_item_title',
						'label'         => __( 'Item Title', 'seed-components' ),
						'name'          => 'item_title',
						'type'          => 'text',
						'default_value' => '',
						'placeholder'   => __( 'Enter item title', 'seed-components' ),
					),
					// Item Text (WYSIWYG)
					array(
						'key'           => 'field_three_in_a_row_item_text',
						'label'         => __( 'Text', 'seed-components' ),
						'name'          => 'item_text',
						'type'          => 'wysiwyg',
						'tabs'          => 'all',
						'toolbar'       => 'full',
						'media_upload'  => 1,
						'delay'         => 0,
						'default_value' => '',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'block',
					'operator' => '==',
					'value'    => 'seed-components/three-in-a-row',
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
		'description'           => __( 'Fields for the Three in a Row block', 'seed-components' ),
	)
);

