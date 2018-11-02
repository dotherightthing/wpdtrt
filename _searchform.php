<?php
/**
 * The template for displaying the search forms
 * Inputs of type 'search' are hard to style in Safari
 *
 * @package WPDTRT
 * @since 0.1.0
 * @see https://premium.wpmudev.org/blog/build-your-own-custom-wordpress-search/
 * @see https://css-tricks.com/webkit-html5-search-inputs/
 */

$input_type = 'text'; // search.
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="form-liner">
		<label>
			<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'wpdtrt' ); ?></span>
			<input type="<?php echo $input_type; ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search for &hellip;', 'placeholder', 'wpdtrt' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		</label>
	</div>
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'wpdtrt' ); ?></span></button>
</form>
