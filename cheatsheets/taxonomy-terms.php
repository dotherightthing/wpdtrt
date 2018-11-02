<?php
/**
 * Taxonomy - Terms
 *
 * @package WPDTRT
 * @since 0.1.0
 */

namespace DoTheRightThing\WPDTRT\Cheatsheets;

/**
 * DTRT Framework Starter: Taxonomy
 * Starter template with predictable defaults.
 * Please keep the version updated, to support diffing.
 *
 * This cannot use PHP variables without violating theme-check (i18n),
 * but a static generator such as Mustache.php could be an option.
 *
 * @package WPDTRT
 * @subpackage WPDTRT Function Starters
 * @since 0.1.0
 * @version 0.1.0
 */

/**
 * Seed a custom taxonomy with terms
 * Note: Save Permalinks after changing this.
 *
 * save_post is run on save, publish, update and bulk/quick edit
 *
 * @see https://codex.wordpress.org/Function_Reference/wp_set_object_terms
 * @see https://stackoverflow.com/questions/29049543/set-default-taxonomy-term-for-custom-post-type
 * @todo Move to elapsed-day.php if it works from there
 * @todo wp_insert_term doesn't seem to do anything, or it is overwritten by wp_set_object_terms
 * @todo Make this into a reusable function (again)
 *
 * Run wp_set_object_terms after the custom taxonomy is registered.
 * Since register_taxonomy() is usually run at init,
 * you can also run your function at init,
 * but with a lower priority so it runs later.
 * @see https://wordpress.stackexchange.com/a/62813
 */
add_action( 'save_post_POST_TYPE_SLUG', 'wpdtrt_insert_and_set_taxonomy_terms_TAXONOMY_SLUG' );
//add_action( 'init', 'wpdtrt_insert_and_set_taxonomy_terms_TAXONOMY_SLUG', 10); // runs but data not available for elapsed-day functions

function wpdtrt_insert_and_set_taxonomy_terms_TAXONOMY_SLUG() {

	global $post;
	$post_id = $post->ID;

	/**
	 * bail if revision
	 * @see https://core.trac.wordpress.org/ticket/16593
	 * @see https://wordpress.stackexchange.com/a/67539
	 */
	if ( wp_is_post_revision($post_id) ) {
		return $post_id;
	}

	/**
	 * Add a taxonomy term (category) to the appropriate item in the hierarchical taxonomies array
	 */
	$terms = array(
		'TAXONOMY_TERM'
	);

	foreach ( $terms as $term ) {

		/**
		 * cast the day integer as a string, to prevent the slug from being interpreted as a tag ID
		 */
		$term_id = (string)$term;

		// if the term has not been set
		if ( ! has_term( $term_id, 'TAXONOMY_SLUG', $post_id ) ) {

			// https://codex.wordpress.org/Function_Reference/wp_insert_term
			$term = wp_insert_term(

				/**
				 * $term
				 * (int|string) (required) The term to add or update.
				 * Default: None
				 */
				$term,

				/**
				 * $taxonomy (string) (required)
				 * The taxonomy to which to add the term.
				 * Default: None
				 */
				$taxonomy,

				/**
				 * $args (array|string) (optional)
				 * Change the values of the inserted term
				 * Default: None
				 */
				$args = array(
					/**
					 * (string) (optional)
					 * There is no default, but if added, expected is the slug that the term will be an alias of.
					 * Default: None
					 */
					// 'alias_of' => null,

					/**
					 * (string) (optional)
					 * If exists, will be added to the database along with the term.
					 * Default: None
					 * TODO: not appearing in Admin term table
					 * @todo does this need i18n __() ?
					 */
					'description' => 'TAXONOMY_LABEL_PREFIX TAXONOMY_TERM',

					/**
					 * (numeric) (optional)
					 * Will assign value of 'parent' to the term.
					 * Default: 0 (zero)
					 */
					//'parent' => 0,

					/**
					 * (string) (optional)
					 * Default: None
					 * @todo test and update
					 */
					//'slug' => $elapsedday
				)
			);

			//$term_id2 = $term->term_id;

			$terms = wp_set_object_terms(
				/**
				 * $object_id
				 * (int) (required) The object to relate to, such as post ID.
				 * Default: None
				 */
				$post_id,

				/**
				 * $terms (array/int/string) (required)
				 * The slug or id of the term (such as category or tag IDs),
				 * will replace all existing related terms in this taxonomy.
				 * To clear or remove all terms from an object, pass an empty string or NULL.
				 * NOTE: Integers are interpreted as tag IDs.
				 * Default: None
				 */
				$term_id,

				/**
				 * $taxonomy (array/string) (required)
				 * The context in which to relate the term to the object.
				 * This can be category, post_tag, or the name of another taxonomy.
				 * Default: None
				 */
				'TAXONOMY_SLUG',

				/**
				 * $append (bool) (optional)
				 * If true, terms will be appended to the object.
				 * If false, terms will replace existing terms
				 * Default: False
				 */
				false
			);
		}
		else {
			$term = get_term_by ('slug', $term_id, 'TAXONOMY_SLUG');
		}

		// test that terms were created
		// wpdtrt_log($terms); //ok
	}

	return $post_id;
}