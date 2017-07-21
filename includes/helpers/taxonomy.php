<?php
/**
 * Taxonomy helpers
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Theme Functions
 * @since 0.1.0
 * @version 0.1.0
 */

/**
 * Create a taxonomy %placeholder% for use in WordPress Permalinks settings
 * Taxonomies do not automatically appear in permalinks
 * The placeholder must be added to the string
 * The placeholder must be translated from a placeholder to the taxonomy term value
 *
 * @param $permalink See WordPress function options
 * @param $post_id See WordPress function options
 * @param $leavename See WordPress function options
 *
 * @see http://shibashake.com/wordpress-theme/add-custom-taxonomy-tags-to-your-wordpress-permalinks
 * @see http://shibashake.com/wordpress-theme/custom-post-type-permalinks-part-2#conflict
 * @see https://stackoverflow.com/questions/7723457/wordpress-custom-type-permalink-containing-taxonomy-slug
 */
add_filter('post_link', 		'wpdtrt_taxonomy_permalink_placeholders', 10, 3);
add_filter('post_type_link', 	'wpdtrt_taxonomy_permalink_placeholders', 10, 3);

function wpdtrt_taxonomy_permalink_placeholders($permalink, $post_id, $leavename) {

	// Get post
	$post = get_post($post_id);

	if ( !$post ) {
		return $permalink;
	}

	// extract all %placeholders% from the permalink
	// https://regex101.com/
	preg_match_all('/(?<=\/%).+?(?=%\/)/', $permalink, $placeholders, PREG_OFFSET_CAPTURE);

	// placeholders in an array of taxonomy/term arrays
	foreach ( $placeholders[0] as $taxonomy ) {

		$taxonomy_name = $taxonomy[0];

		if ( taxonomy_exists( $taxonomy_name ) ) {

			/**
			 * Get the taxonomy terms related to the current post object
			 * wp_get_object_terms() doesn't cache the result like get_the_terms() does
			 * but get_the_terms() doesn't offer a sort order
			 */
			$terms = wp_get_object_terms(
				$post->ID,
				$taxonomy_name,
				array(
					'order' => 'DESC' // parent,child, not primary,secondary
				)
			);

			/**
			 * Retrieve the slug value of the first custom taxonomy object linked to the current post.
			 * If no terms are retrieved, then replace our term tag with the fallback value.
			 * This prevents // in permalink
			 */
			$replacements = array();

			if ( !is_wp_error($terms) ) {
				foreach ($terms as $term) {
					if ( !empty( $term ) && is_object( $term ) ) {
						$replacements[] = $term->slug;
					}
				}

				$replacements = implode('/', $replacements);
			}
			else {
				$replacements = 'no-' . $taxonomy_name;
			}

			/**
			 * Replace the %taxonomy% tag with our custom taxonomy slug.
			 */
			$permalink = str_replace( ( '%' . $taxonomy_name . '%' ), $replacements, $permalink);
		}
	}

	return $permalink;
}

?>