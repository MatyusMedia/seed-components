<?php
/**
 * Three in a Row Block Template
 *
 * This template is used to render the three-in-a-row block on the frontend.
 *
 * Available variables:
 * - $block: The block data array (contains fields in $block['data'])
 * - $content: The block content
 * - $is_preview: Boolean indicating if we're in the block editor preview
 * - $post_id: The current post ID
 *
 * Fields are available via:
 * - $block['data'] - Direct access to field values
 * - get_field() / get_fields() - After ACF sets up meta context
 *
 * @package Seed_Components
 */

// Get field values - ACF sets up meta context before including template
// Use get_field() which works during both initial render and AJAX preview updates
$title = function_exists( 'get_field' ) ? get_field( 'title' ) : ( isset( $block['data']['title'] ) ? $block['data']['title'] : '' );
$text  = function_exists( 'get_field' ) ? get_field( 'text' ) : ( isset( $block['data']['text'] ) ? $block['data']['text'] : '' );

// Get items - handle both get_field() and $block['data'] formats
$items = array();
if ( function_exists( 'get_field' ) ) {
	$items = get_field( 'items' );
} elseif ( isset( $block['data']['items'] ) ) {
	$items = $block['data']['items'];
}

// Ensure we have defaults
if ( $title === null || $title === false ) {
	$title = '';
}
if ( $text === null || $text === false ) {
	$text = '';
}
if ( ! is_array( $items ) ) {
	$items = array();
}

// Get block attributes
$align     = isset( $block['align'] ) ? $block['align'] : '';
$anchor    = isset( $block['anchor'] ) ? $block['anchor'] : '';
$className = isset( $block['className'] ) ? $block['className'] : '';

// Build wrapper classes
$wrapper_classes = array( 'sdcmps-three-in-a-row' );
if ( $align ) {
	$wrapper_classes[] = 'align' . $align;
}
if ( $anchor ) {
	$wrapper_classes[] = 'anchor-' . $anchor;
}
if ( $className ) {
	$wrapper_classes[] = $className;
}
$wrapper_class = implode( ' ', $wrapper_classes );

?>

<div class="<?php echo esc_attr( $wrapper_class ); ?>">
	<div class="sdcmps-three-in-a-row__container">
		<?php if ( $title ) : ?>
			<h2 class="sdcmps-three-in-a-row__title"><?php echo esc_html( $title ); ?></h2>
		<?php endif; ?>

		<?php if ( $text ) : ?>
			<div class="sdcmps-three-in-a-row__text">
				<?php echo wp_kses_post( wpautop( $text ) ); ?>
			</div>
		<?php endif; ?>
		

		<?php
		// Use ACF have_rows() pattern if available, otherwise fall back to array
		if ( function_exists( 'have_rows' ) && have_rows( 'items' ) ) :
			?>
			<div class="sdcmps-three-in-a-row__items">
				<?php while ( have_rows( 'items' ) ) : the_row(); ?>
					<?php
					$icon      = get_sub_field( 'icon' );
					$item_title = get_sub_field( 'item_title' );
					$item_text  = get_sub_field( 'item_text' );
					
					// Skip if item is empty
					if ( empty( $icon ) && empty( $item_title ) && empty( $item_text ) ) {
						continue;
					}
					?>
					<div class="sdcmps-three-in-a-row__item">
						<?php if ( $icon ) : ?>
							<div class="sdcmps-three-in-a-row__icon sdcmps-three-in-a-row__icon--<?php echo esc_attr( $icon ); ?>">
								<?php
								// Icon will be handled via CSS or SVG
								// You can add SVG icons here based on the icon value
								?>
							</div>
						<?php endif; ?>
						<?php if ( $item_title ) : ?>
							<h3 class="sdcmps-three-in-a-row__item-title"><?php echo esc_html( $item_title ); ?></h3>
						<?php endif; ?>
						<?php if ( $item_text ) : ?>
							<div class="sdcmps-three-in-a-row__item-text">
								<?php echo wp_kses_post( $item_text ); ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			</div>
		<?php elseif ( ! empty( $items ) && is_array( $items ) ) : ?>
			<div class="sdcmps-three-in-a-row__items">
				<?php foreach ( $items as $item ) : ?>
					<?php
					// Handle both field names and field keys for repeater sub-fields
					$icon = '';
					$item_title = '';
					$item_text = '';
					
					// Try field names first (most common)
					if ( isset( $item['icon'] ) ) {
						$icon = $item['icon'];
					} elseif ( isset( $item['field_three_in_a_row_item_icon'] ) ) {
						$icon = $item['field_three_in_a_row_item_icon'];
					}
					
					if ( isset( $item['item_title'] ) ) {
						$item_title = $item['item_title'];
					} elseif ( isset( $item['field_three_in_a_row_item_title'] ) ) {
						$item_title = $item['field_three_in_a_row_item_title'];
					}
					
					if ( isset( $item['item_text'] ) ) {
						$item_text = $item['item_text'];
					} elseif ( isset( $item['field_three_in_a_row_item_text'] ) ) {
						$item_text = $item['field_three_in_a_row_item_text'];
					}
					
					// Skip if item is empty
					if ( empty( $icon ) && empty( $item_title ) && empty( $item_text ) ) {
						continue;
					}
					?>
					<div class="sdcmps-three-in-a-row__item">
						<?php if ( $icon ) : ?>
							<div class="sdcmps-three-in-a-row__icon sdcmps-three-in-a-row__icon--<?php echo esc_attr( $icon ); ?>">
								<?php
								// Icon will be handled via CSS or SVG
								// You can add SVG icons here based on the icon value
								?>
							</div>
						<?php endif; ?>
						<?php if ( $item_title ) : ?>
							<h3 class="sdcmps-three-in-a-row__item-title"><?php echo esc_html( $item_title ); ?></h3>
						<?php endif; ?>
						<?php if ( $item_text ) : ?>
							<div class="sdcmps-three-in-a-row__item-text">
								<?php echo wp_kses_post( $item_text ); ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>

