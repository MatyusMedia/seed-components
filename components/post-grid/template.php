<?php
/**
 * Post Grid Block Template
 *
 * This template is used to render the post-grid block on the frontend.
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
$title           = function_exists( 'get_field' ) ? get_field( 'title' ) : ( isset( $block['data']['title'] ) ? $block['data']['title'] : '' );
$text            = function_exists( 'get_field' ) ? get_field( 'text' ) : ( isset( $block['data']['text'] ) ? $block['data']['text'] : '' );
$columns         = function_exists( 'get_field' ) ? get_field( 'columns' ) : ( isset( $block['data']['columns'] ) ? $block['data']['columns'] : '3' );
$selector_tag    = function_exists( 'get_field' ) ? get_field( 'selector_tag' ) : ( isset( $block['data']['selector_tag'] ) ? $block['data']['selector_tag'] : '' );
$number_of_posts = function_exists( 'get_field' ) ? get_field( 'number_of_posts' ) : ( isset( $block['data']['number_of_posts'] ) ? $block['data']['number_of_posts'] : 6 );

// Ensure we have defaults
if ( $title === null || $title === false ) {
	$title = '';
}
if ( $text === null || $text === false ) {
	$text = '';
}
if ( empty( $columns ) || ! in_array( $columns, array( '2', '3', '4' ), true ) ) {
	$columns = '3';
}
if ( $selector_tag === null || $selector_tag === false ) {
	$selector_tag = '';
}
if ( empty( $number_of_posts ) || $number_of_posts < 2 || $number_of_posts > 12 ) {
	$number_of_posts = 6;
}

// Get block attributes
$align     = isset( $block['align'] ) ? $block['align'] : '';
$anchor    = isset( $block['anchor'] ) ? $block['anchor'] : '';
$className = isset( $block['className'] ) ? $block['className'] : '';

// Build wrapper classes
$wrapper_classes = array( 'sdcmps-post-grid' );
if ( $align ) {
	$wrapper_classes[] = 'align' . $align;
}
if ( $anchor ) {
	$wrapper_classes[] = 'anchor-' . $anchor;
}
if ( $className ) {
	$wrapper_classes[] = $className;
}
$wrapper_classes[] = 'sdcmps-post-grid--columns-' . $columns;
$wrapper_class = implode( ' ', $wrapper_classes );

// Query posts
$query_args = array(
	'post_type'      => 'post',
	'posts_per_page' => (int) $number_of_posts,
	'orderby'        => 'date',
	'order'          => 'DESC',
	'post_status'   => 'publish',
);

// Add tag filter if selector_tag is provided
if ( ! empty( $selector_tag ) ) {
	$query_args['tag'] = sanitize_text_field( $selector_tag );
}

$posts_query = new WP_Query( $query_args );
?>

<div class="<?php echo esc_attr( $wrapper_class ); ?>">
	<div class="sdcmps-post-grid__container">
		<?php if ( $title ) : ?>
			<h2 class="sdcmps-post-grid__title"><?php echo esc_html( $title ); ?></h2>
		<?php endif; ?>

		<?php if ( $text ) : ?>
			<div class="sdcmps-post-grid__text">
				<?php echo wp_kses_post( wpautop( $text ) ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $posts_query->have_posts() ) : ?>
			<div class="sdcmps-post-grid__items">
				<?php while ( $posts_query->have_posts() ) : $posts_query->the_post(); ?>
					<article class="sdcmps-post-grid__item">
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php echo esc_url( get_permalink() ); ?>" class="sdcmps-post-grid__thumbnail-link">
								<?php the_post_thumbnail( 'sdcmps_post_grid', array( 'class' => 'sdcmps-post-grid__thumbnail' ) ); ?>
							</a>
						<?php endif; ?>
						
						<div class="sdcmps-post-grid__content">
							<time class="sdcmps-post-grid__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
								<?php echo esc_html( get_the_date() ); ?>
							</time>
							
							<h3 class="sdcmps-post-grid__item-title">
								<a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
							</h3>
							
							<div class="sdcmps-post-grid__excerpt">
								<?php
								$excerpt = get_the_excerpt();
								if ( strlen( $excerpt ) > 155 ) {
									$excerpt = substr( $excerpt, 0, 155 ) . '...';
								}
								echo esc_html( $excerpt );
								?>
							</div>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
		<?php else : ?>
			<p class="sdcmps-post-grid__no-posts"><?php esc_html_e( 'No posts found.', 'seed-components' ); ?></p>
		<?php endif; ?>
	</div>
</div>

<?php
wp_reset_postdata();
?>

