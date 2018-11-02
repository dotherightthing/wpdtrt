<?php
/**
 * Excerpt
 *
 * @package WPDTRT
 * @since 0.1.0
 */

/**
 * Pluggable
 * May be replaced in a child theme
 *
 * @todo Copied from twentysixteen - replace with wpdtrt_excerpt
 */
if ( ! function_exists( 'twentysixteen_excerpt' ) ) {
	/**
	 * Displays the optional excerpt.
	 *
	 * Wraps the excerpt in a div element.
	 *
	 * @since Twenty Sixteen 1.0
	 *
	 * @param string $class Optional. Class string of the div element. Defaults to 'entry-summary'.
	 */
	function twentysixteen_excerpt( $class = 'entry-summary' ) {
		$class = esc_attr( $class );

		if ( has_excerpt() || is_search() ) : ?>
			<div class="<?php echo $class; ?>">
				<?php the_excerpt(); ?>
			</div><!-- .<?php echo $class; ?> -->
		<?php endif;
	}
}
