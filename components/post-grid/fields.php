<?php
/**
 * ACF Fields for Post Grid Block
 *
 * This file registers all ACF fields for the post-grid block.
 * Fields are registered as a minimal field group that targets this specific block.
 *
 * @package Seed_Components
 */

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

// Register field group for post-grid block
acf_add_local_field_group(
	array(
		'key'    => 'group_post_grid_block',
		'title'  => __( 'Post Grid Block Fields', 'seed-components' ),
		'fields' => array(
			// Title field
			array(
				'key'           => 'field_post_grid_title',
				'label'         => __( 'Title', 'seed-components' ),
				'name'          => 'title',
				'type'          => 'text',
				'default_value' => '',
				'placeholder'   => __( 'Enter title', 'seed-components' ),
			),
			// Text field
			array(
				'key'           => 'field_post_grid_text',
				'label'         => __( 'Text', 'seed-components' ),
				'name'          => 'text',
				'type'          => 'textarea',
				'rows'          => 4,
				'default_value' => '',
				'placeholder'   => __( 'Enter text', 'seed-components' ),
			),
			// Columns field
			array(
				'key'           => 'field_post_grid_columns',
				'label'         => __( 'Columns', 'seed-components' ),
				'name'          => 'columns',
				'type'          => 'select',
				'choices'       => array(
					'2' => __( '2', 'seed-components' ),
					'3' => __( '3', 'seed-components' ),
					'4' => __( '4', 'seed-components' ),
				),
				'default_value' => '3',
				'allow_null'    => 0,
				'multiple'      => 0,
				'ui'            => 1,
				'return_format' => 'value',
			),
			// Selector Tag field
			array(
				'key'           => 'field_post_grid_selector_tag',
				'label'         => __( 'Selector Tag', 'seed-components' ),
				'name'          => 'selector_tag',
				'type'          => 'text',
				'default_value' => '',
				'placeholder'   => __( 'Enter tag slug', 'seed-components' ),
				'instructions'  => __( 'Display posts with this tag', 'seed-components' ),
			),
			// Number of posts field
			array(
				'key'           => 'field_post_grid_number_of_posts',
				'label'         => __( 'Number of Posts', 'seed-components' ),
				'name'          => 'number_of_posts',
				'type'          => 'number',
				'default_value' => 6,
				'min'           => 2,
				'max'           => 12,
				'step'          => 1,
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'block',
					'operator' => '==',
					'value'    => 'seed-components/post-grid',
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
		'description'           => __( 'Fields for the Post Grid block', 'seed-components' ),
	)
);

