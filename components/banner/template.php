<?php
/**
 * Banner Block Template
 *
 * This template is used to render the banner block on the frontend.
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
$lead_text       = function_exists( 'get_field' ) ? get_field( 'lead_text' ) : ( isset( $block['data']['lead_text'] ) ? $block['data']['lead_text'] : '' );
$title           = function_exists( 'get_field' ) ? get_field( 'title' ) : ( isset( $block['data']['title'] ) ? $block['data']['title'] : '' );
$heading_type    = function_exists( 'get_field' ) ? get_field( 'heading_type' ) : ( isset( $block['data']['heading_type'] ) ? $block['data']['heading_type'] : 'h2' );
$text            = function_exists( 'get_field' ) ? get_field( 'text' ) : ( isset( $block['data']['text'] ) ? $block['data']['text'] : '' );
$image           = function_exists( 'get_field' ) ? get_field( 'image' ) : ( isset( $block['data']['image'] ) ? $block['data']['image'] : '' );
$background_color = function_exists( 'get_field' ) ? get_field( 'background_color' ) : ( isset( $block['data']['background_color'] ) ? $block['data']['background_color'] : '#ffffff' );
$height          = function_exists( 'get_field' ) ? get_field( 'height' ) : ( isset( $block['data']['height'] ) ? $block['data']['height'] : 'auto' );
$button_text     = function_exists( 'get_field' ) ? get_field( 'button_text' ) : ( isset( $block['data']['button_text'] ) ? $block['data']['button_text'] : '' );
$button_link     = function_exists( 'get_field' ) ? get_field( 'button_link' ) : ( isset( $block['data']['button_link'] ) ? $block['data']['button_link'] : '' );

// Ensure we have defaults
if ( $lead_text === null || $lead_text === false ) {
	$lead_text = '';
}
if ( $title === null || $title === false ) {
	$title = '';
}
if ( empty( $heading_type ) || ! in_array( $heading_type, array( 'h1', 'h2', 'h3', 'h4' ), true ) ) {
	$heading_type = 'h2';
}
if ( $text === null || $text === false ) {
	$text = '';
}
if ( $image === null || $image === false ) {
	$image = '';
}
if ( empty( $background_color ) ) {
	$background_color = '#ffffff';
}
if ( empty( $height ) ) {
	$height = 'auto';
}
if ( $button_text === null || $button_text === false ) {
	$button_text = '';
}
if ( $button_link === null || $button_link === false ) {
	$button_link = '';
}

// Get block attributes
$align = isset( $block['align'] ) ? $block['align'] : '';
$anchor = isset( $block['anchor'] ) ? $block['anchor'] : '';
$className = isset( $block['className'] ) ? $block['className'] : '';


// Outer wrapper classes
$outer_className = array( 'sdcmps-banner-wrapper' );
if ( $className ) {
	$outer_className[] = $className;
}
$outer_className = implode( ' ', $outer_className );

// Build wrapper classes
$wrapper_classes = array( 'sdcmps-banner' );
if ( $align ) {
	$wrapper_classes[] = 'align' . $align;
}
if ( $anchor ) {
	$wrapper_classes[] = 'anchor-' . $anchor;
}
if ( $height && $height !== 'auto' ) {
	$wrapper_classes[] = 'sdcmps-banner--height-' . $height;
}

$wrapper_class = implode( ' ', $wrapper_classes );

// Build inline styles for background
$wrapper_styles = array();
if ( $background_color ) {
	$wrapper_styles[] = 'background-color: ' . esc_attr( $background_color ) . ';';
}
if ( $image && is_array( $image ) && isset( $image['url'] ) ) {
	$wrapper_styles[] = 'background-image: url(' . esc_url( $image['url'] ) . ');';
}
$wrapper_style = ! empty( $wrapper_styles ) ? ' style="' . implode( ' ', $wrapper_styles ) . '"' : '';
?>

<div class="sdcmps-banner-wrapper <?php echo esc_attr( $outer_className ); ?>">
	<div class="<?php echo esc_attr( $wrapper_class ); ?>"<?php echo $wrapper_style; ?>>
		<div class="sdcmps-banner__container">
			<div class="sdcmps-banner__content">
				<?php if ( $lead_text ) : ?>
					<div class="sdcmps-banner__lead-text"><?php echo esc_html( $lead_text ); ?></div>
				<?php endif; ?>
				<?php if ( $title ) : ?>
					<<?php echo esc_attr( $heading_type ); ?> class="sdcmps-banner__title"><?php echo esc_html( $title ); ?></<?php echo esc_attr( $heading_type ); ?>>
				<?php endif; ?>

				<?php if ( $text ) : ?>
					<div class="sdcmps-banner__text">
						<?php echo wp_kses_post( wpautop( $text ) ); ?>
					</div>
				<?php endif; ?>

				<?php if ( $button_text && $button_link ) : ?>
					<div class="sdcmps-banner__button">
						<a href="<?php echo esc_url( $button_link ); ?>" class="sdcmps-banner__button-link">
							<?php echo esc_html( $button_text ); ?>
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
