<?php
/**
 * Text Image Block Template
 *
 * This template is used to render the text-image block on the frontend.
 *
 * Available variables:
 * - $block: The block data array (contains fields in $block['data'])
 * - $content: The block content (InnerBlocks content)
 * - $is_preview: Boolean indicating if we're in the block editor preview
 * - $post_id: The current post ID
 *
 * @package Seed_Components
 */

// Load image utility class
require_once dirname( dirname( dirname( __FILE__ ) ) ) . '/utils/class-sdcmps-image-utility.php';

// Get field values - ACF sets up meta context before including template
// Use get_field() which works during both initial render and AJAX preview updates
$image_position = function_exists( 'get_field' ) ? get_field( 'image_position' ) : ( isset( $block['data']['image_position'] ) ? $block['data']['image_position'] : 'left' );
$layout_ratio   = function_exists( 'get_field' ) ? get_field( 'layout_ratio' ) : ( isset( $block['data']['layout_ratio'] ) ? $block['data']['layout_ratio'] : '50-50' );
$text_align     = function_exists( 'get_field' ) ? get_field( 'text_align' ) : ( isset( $block['data']['text_align'] ) ? $block['data']['text_align'] : 'center' );
$lead_text      = function_exists( 'get_field' ) ? get_field( 'lead_text' ) : ( isset( $block['data']['lead_text'] ) ? $block['data']['lead_text'] : '' );
$image_id       = function_exists( 'get_field' ) ? get_field( 'image' ) : ( isset( $block['data']['image'] ) ? $block['data']['image'] : '' );
$image_layout   = function_exists( 'get_field' ) ? get_field( 'image_layout' ) : ( isset( $block['data']['image_layout'] ) ? $block['data']['image_layout'] : 'normal' );

// Ensure we have defaults
if ( empty( $image_position ) ) {
	$image_position = 'left';
}
if ( empty( $layout_ratio ) ) {
	$layout_ratio = '50-50';
}
if ( empty( $text_align ) ) {
	$text_align = 'center';
}
if ( $lead_text === null || $lead_text === false ) {
	$lead_text = '';
}
if ( $image_id === null || $image_id === false ) {
	$image_id = '';
}
if ( empty( $image_layout ) ) {
	$image_layout = 'normal';
}

// Parse layout ratio (e.g., "50-50" becomes text: 50%, image: 50%)
$ratio_parts = explode( '-', $layout_ratio );
$text_width  = isset( $ratio_parts[0] ) ? (int) $ratio_parts[0] : 50;
$image_width = isset( $ratio_parts[1] ) ? (int) $ratio_parts[1] : 50;

// Get block attributes
$align  = isset( $block['align'] ) ? $block['align'] : '';
$anchor = isset( $block['anchor'] ) ? $block['anchor'] : '';
$className = isset( $block['className'] ) ? $block['className'] : '';

// Build wrapper classes
$wrapper_classes = array( 'sdcmps-text-image' );
if ( $align ) {
	$wrapper_classes[] = 'align' . $align;
}
if ( $anchor ) {
	$wrapper_classes[] = 'anchor-' . $anchor;
}
$wrapper_classes[] = 'sdcmps-text-image--position-' . $image_position;
$wrapper_classes[] = 'sdcmps-text-image--layout-' . $layout_ratio;
if ( $className ) {
	$wrapper_classes[] = $className;
}
$wrapper_class = implode( ' ', $wrapper_classes );

// Build column classes
$text_column_classes  = array( 'sdcmps-text-image__text' );
$image_column_classes = array( 'sdcmps-text-image__image' );
if ( 'cover' === $image_layout ) {
	$image_column_classes[] = 'sdcmps-text-image__image--cover';
}
$text_column_class  = implode( ' ', $text_column_classes );
$image_column_class = implode( ' ', $image_column_classes );
?>

<div class="<?php echo esc_attr( $wrapper_class ); ?>">
	<div class="sdcmps-text-image__container">
		<?php if ( $image_id ) : ?>
			<div class="<?php echo esc_attr( $image_column_class ); ?>" style="flex: 0 0 <?php echo esc_attr( $image_width ); ?>%;">
				<?php
				$img_utility = new SDCMPS_Image_Utility( $image_id );
				if ( 'cover' === $image_layout ) {
					$img_utility->img_tag_cover( 'full' );
				} else {
					$img_utility->img_tag_simple( 'full' );
				}
				?>
			</div>
		<?php endif; ?>

		<div class="<?php echo esc_attr( $text_column_class ); ?>" style="flex: 0 0 <?php echo esc_attr( $text_width ); ?>%;">
			<div class="sdcmps-text-image__text-wrapper sdcmps-text-image__text-wrapper--align-<?php echo esc_attr( $text_align ); ?>">
				<?php if ( $lead_text ) : ?>
					<div class="sdcmps-text-image__lead">
						<?php echo esc_html( $lead_text ); ?>
					</div>
				<?php endif; ?>

				<div class="sdcmps-text-image__content">
					<InnerBlocks />
				</div>
			</div>
		</div>
	</div>
</div>

