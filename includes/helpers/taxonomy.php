<?php

/**
 * DTRT Framework Helper: Taxonomy
 * Helper function to generate custom taxonomies with predictable defaults
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Theme Functions
 * @since 0.1.0
 * @version 0.1.0
 */

/**
 * Arguments cannot be passed directly to functions called via WordPress hooks and filters
 * Saving options to the database allows us to retrieve these when the function is called.
 *
 * Store all of our plugin options in an array
 * So that we only use have to consume one row in the WP Options table
 * WordPress automatically serializes this (into a string)
 * because MySQL does not support arrays as a data type
 */
$wpdtrt__taxonomies = array();

/**
 * Create a taxonomy
 * @param $slug string
 * @param $fallback string
 * @param $post_type_slug string
 * @param $description string
 * @param $label_single string
 * @param $label_plural string
 * @param $hierarchical boolean
 * @param $public boolean
 * @param $label_prefix string
 * @param $terms array
 * @since 0.1.0
 */
function wpdtrt__taxonomy_create($args) {

	/**
   	 * $args are passed in an associative array to give values named context
	 * Predeclare extracted variables for debugging purposes
	 * @see http://kb.dotherightthing.dan/php/wordpress/extract/
	 */
	$slug = null;
	$fallback = null;
	$post_type_slug = null;
	$description = null;
	$label_single = null;
	$label_plural = null;
	$hierarchical = null;
	$public = null;
	$label_prefix = null;
	$terms = null;

	// only overwrite the predeclared variables
	extract($args, EXTR_IF_EXISTS);

	$wpdtrt__taxonomies = get_option('wpdtrt__taxonomies');

	// don't add duplicate items
	foreach( $wpdtrt__taxonomies as $taxonomy ) {
		if ( $taxonomy['slug'] === $slug ) {
			return;
		}
	}

	// add a new taxonomy to our options array
	// @todo could we just use $args here?
	$wpdtrt__taxonomies[] = array(
		'slug' => $slug,
		'fallback' => $fallback,
		'post_type_slug' => $post_type_slug,
		'description' => $description,
		'label_single' => $label_single,
		'label_plural' => $label_plural,
		'hierarchical' => $hierarchical,
		'public' => $public,
		'label_prefix' => $label_prefix,
		'terms' => $terms
	);

	//$options = array_unique( $wpdtrt__taxonomies ); // see above

    /**
     * Save options object to database
     *
     * Update the plugin data stored in the WP Options table
     * This function may be used in place of add_option, although it is not as flexible.
     * update_option will check to see if the option already exists.
     * If it does not, it will be added with add_option('option_name', 'option_value').
     * Unless you need to specify the optional arguments of add_option(),
     * update_option() is a useful catch-all for both adding and updating options.
     * @example update_option( string $option, mixed $value, string|bool $autoload = null )
     * @see https://codex.wordpress.org/Function_Reference/update_option
     */
    update_option( 'wpdtrt__taxonomies', $wpdtrt__taxonomies, null );
}

/**
 * Register taxonomy
 * @uses ../../../../wp-includes/taxonomy.php
 * @see https://codex.wordpress.org/Function_Reference/register_taxonomy
 * @see https://www.smashingmagazine.com/2012/01/create-custom-taxonomies-wordpress/
 * @see https://code.tutsplus.com/articles/the-rewrite-api-post-types-taxonomies--wp-25488
 * @todo $terms
 */

/**
 * Register Custom Taxonomy BEFORE the Custom Post Type
 * for the rewrite rule to work
 * for WordPress to build the URL correctly
 * @see https://cnpagency.com/blog/the-right-way-to-do-wordpress-custom-taxonomy-rewrites/
 */

add_action('init', 'wpdtrt__taxonomy_register_all', 0);

function wpdtrt__taxonomy_register_all() {

	/**
	 * Load the plugin data stored in the WP Options table
	 * Retrieves an option value based on an option name.
	 * @example get_option( string $option, mixed $default = false )
	 */
	$taxonomies = get_option( 'wpdtrt__taxonomies' );

	/**
	 * Create a taxonomy from each item in the taxonomies array
	 * @see https://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	foreach( $taxonomies as $taxonomy ) {

		if ( !taxonomy_exists( $taxonomy['slug'] ) ) {

			$labels = array(
				/**
				 * The same as and overridden by $tax->label
				 */
				'name' => _x( $taxonomy['label_single'], 'taxonomy general name', 'wpdtrt_fwt' ),

				/**
				 * Default: _x( 'Post Tag', 'taxonomy singular name' )
				 */
				'singular_name' => _x( $taxonomy['label_single'], 'taxonomy singular name', 'wpdtrt_fwt' ),

				/**
				 * Defaults to value of name label.
				 */
				'menu_name' => __( $taxonomy['label_plural'], 'wpdtrt_fwt' ),

				/**
				 * Default:  All Tags / All Categories
				 */
				'all_items' => __( 'All ' . $taxonomy['label_plural'], 'wpdtrt_fwt' ),

				/**
				 * Default: Add New Tag / Add New Category
				 */
				'add_new_item' => __( 'Add New ' . $taxonomy['label_single'], 'wpdtrt_fwt' ),

				/**
				 * Default: Edit Tag / Edit Category
				 */
				'edit_item' => __( 'Edit ' . $taxonomy['label_single'], 'wpdtrt_fwt' ),

				/**
				 * Default: View Tag / View Category
				 */
				'view_item' => __( 'View ' . $taxonomy['label_plural'], 'wpdtrt_fwt' ),

				/**
				 * Default: Update Tag / Update Category
				 */
				'update_item' => __( 'Update ' . $taxonomy['label_plural'], 'wpdtrt_fwt' ),

				/**
				 * Default: New Tag Name / New Category Name
				 */
				'new_item_name' => __( 'New ' . $taxonomy['label_single'] . ' Name', 'wpdtrt_fwt' ),

				/**
				 * This string is not used on non-hierarchical taxonomies such as post tags.
				 * Default: null / Parent Category
				 */
				'parent_item' => __( 'Parent' . $taxonomy['label_single'], 'wpdtrt_fwt' ),

				/**
				 * The same as parent_item, but with colon : in the end
				 * Default: null / Parent Category:
				 */
				'parent_item_colon' => __( 'Parent' . $taxonomy['label_single'] . ':', 'wpdtrt_fwt' ),

				/**
				 * Default: Search Tags / Search Categories
				 */
				'search_items' => __( 'Search ' . $taxonomy['label_plural'], 'wpdtrt_fwt' ),

				/**
				 * This string is not used on hierarchical taxonomies.
				 * Default: null / Popular Tags
				 */
				'popular_items' => __( 'Popular ' . $taxonomy['label_plural'], 'wpdtrt_fwt' ),

				/**
				 * Used in the taxonomy meta box.
				 * This string is not used on hierarchical taxonomies.
				 * Default: null / Separate tags with commas
				 */
				'separate_items_with_commas' => __( 'Separate ' . $taxonomy['label_plural'] . ' with commas', 'wpdtrt_fwt' ),

				/**
				 * Used in the meta box when JavaScript is disabled.
				 * This string is not used on hierarchical taxonomies.
				 * Default: null / Add or remove tags
				 */
				'add_or_remove_items' => __( 'Add or remove ' . $taxonomy['label_plural'], 'wpdtrt_fwt' ),

				/**
				 * Used in the taxonomy meta box.
				 * This string is not used on hierarchical taxonomies.
				 * Default: null / Choose from the most used tags
				 */
				'choose_from_most_used' => __( 'Choose from the most used ' . $taxonomy['label_plural'], 'wpdtrt_fwt' ),

				/**
				 * (3.6+) - the text displayed via clicking 'Choose from the most used tags' in the taxonomy meta box when no tags are available
				 * and
				 * (4.2+) - the text used in the terms list table when there are no items for a taxonomy.
				 * Default: No tags found / No categories found
				 */
				'not_found' => __( 'No  ' . $taxonomy['label_plural'] . ' found.', 'wpdtrt_fwt' ),
			);

			$args = array(

		        /**
		         * Labels - defined above
		         */
		        'labels' => $labels,

		        /**
		         * Whether a taxonomy is intended for use publicly
		         * either via the admin interface or by front-end users.
		         * Default: true
		         */
		        'public' => $taxonomy['public'],

		        /**
		         * Whether the taxonomy is publicly queryable.
		         * Default: $public.
		         */
		        'publicly_queryable' => $taxonomy['public'],

		        /**
		         * Whether to generate a default UI for managing this taxonomy.
		         * 3.5+ setting this to false for attachment taxonomies will hide the UI.
		         * Default: $public.
		         */
		        'show_ui' => $taxonomy['public'],

		        /**
		         * Where to show the taxonomy in the admin menu.
		         * show_ui must be true.
		         * Default: $show_ui.
		         */
		        'show_in_menu' => $taxonomy['public'],

		        /**
		         * Make this taxonomy available for selection in navigation menus.
		         * Default: $public.
		         */
		        'show_in_nav_menus' => $taxonomy['public'],

		        /**
		         * Make this taxonomy available for selection in navigation menus.
		         * Default: $public.
		         */
		        'show_in_rest' => $taxonomy['public'],

		        /**
		         * To change the base url of REST API route.
		         */
		        'rest_base' => $taxonomy['slug'],

		        /**
		         * REST API Controller class name.
		         */
		        //'rest_controller_class' => WP_REST_Terms_Controller,

		        /**
		         * Whether to allow the Tag Cloud widget to use this taxonomy.
		         * Default: $show_ui.
		         */
		        'show_tagcloud' => $taxonomy['public'],

		        /**
		         * 4.2+ Whether to show the taxonomy in the quick/bulk edit panel.
		         * Default: $show_ui.
		         */
		        'show_in_quick_edit' => $taxonomy['public'],

		        /**
		         * 3.8+  Provide a callback function name for the meta box display.
		         * No meta box is shown if set to false.
		         * Default: null
		         */
		        'meta_box_cb' => null,

		        /**
		         * 3.5+  Whether to allow automatic creation of taxonomy columns on associated post-types table.
		         * Default: false
		         */
		        'show_admin_column' => false,

		        /**
		         * Default: ''
		         */
		        'description' => $taxonomy['description'],

		        /**
		         * Is this taxonomy hierarchical (have descendants) like categories or not hierarchical like tags.
		         * Default: false
		         */
		        'hierarchical' => $taxonomy['hierarchical'],

				/**
				 * A function name that will be called when the count of an associated $object_type, such as post, is updated.
				 * Works much like a hook.
				 * Default: None - but see Note
				 * @see https://codex.wordpress.org/Function_Reference/register_taxonomy
				 */
				//'update_count_callback' => '_update_post_term_count',

		        /**
		         * false = disable the query_var
		         * string = use custom query_var instead of default which is $taxonomy
		         * Default: $taxonomy
		         */
				'query_var' => $taxonomy['slug'],

				/**
				 * Set to false to prevent automatic URL rewriting a.k.a. "pretty permalinks".
				 * Pass an $args array to override default URL settings for permalinks as outlined below:
				 * Default: true
				 */
				'rewrite' => array(

					/**
					 * Used as pretty permalink text (i.e. /tag/)
					 * Default: $taxonomy
					 * Note: this has conflicted with post type in the past
					 */
					'slug' => $taxonomy['slug'],

					/**
					 * Allows permalinks to be prepended with front base
					 * Default: true
					 */
					'with_front' => true,

					/**
					 * 3.1+ Allow hierarchical urls
					 * Default: false
					 */
					'hierarchical' => $taxonomy['hierarchical'],

					/**
					 * Assign an endpoint (EP) mask for this taxonomy.
					 * If you do not specify the EP_MASK, pretty permalinks will not work.
					 * If pretty permalinks are not enabled then endpoints are not going to work.
					 * This is because endpoints rely on WordPress’s internal rewrite system
					 * which is disabled for the default links.
					 *
					 * Endpoints make it easier to get the variable out of a URL when pretty permalinks are enabled.
					 *
					 * Using endpoints allows you to easily create rewrite rules to catch the normal WordPress URLs,
					 * but with a little extra at the end.
					 * For example, you could use an endpoint to match all post URLs followed by “gallery”
					 * and display all of the images used in a post, e.g. http://example.com/my-fantastic-post/gallery/.
					 *
					 * Note: resave permalinks or $wp_rewrite->flush_rules() once, after the taxonomy has been created.
					 *
					 * Default: EP_NONE
					 * @see https://make.wordpress.org/plugins/2012/06/07/rewrite-endpoints-api/
					 */
					'ep_mask' => EP_NONE,
				),

		        /**
		         * An array of the capabilities for this taxonomy.
		         * manage_terms / manage_categories
		         * edit_terms / manage_categories
		         * delete_terms / manage_categories
		         * assign_terms / edit_posts
		         * Default: None
		         */
		        //'capabilities' => None,

		        /**
		         * Whether this taxonomy should remember the order in which terms are added to objects.
		         * Default: None
		         */
		        //'sort' => None,

		        /**
		         * Whether this taxonomy is a native or "built-in" taxonomy.
		         * Do not edit.
		         * Default: false
		         */
		        //'_builtin' => false,
			);

			register_taxonomy(
				/**
				 * Taxonomy Name should only contain lowercase letters and the underscore character,
				 * and not be more than 32 characters long (database structure restriction).
				 * Default: None
				 */
				$taxonomy['slug'],

				/**
				 * Object-types can be built-in Post Type or any Custom Post Type that may be registered.
				 * Default: None
				 */
				$taxonomy['post_type_slug'],

				/**
				 * Optional array of Arguments.
				 * Default: None
				 */
				$args
			);

			/**
			 * Better be safe than sorry when registering custom taxonomies for custom post types.
			 * Use register_taxonomy_for_object_type() right after the function to interconnect them.
			 * Else you could run into minetraps where the post type isn't attached inside filter callback
			 * that run during parse_request or pre_get_posts.
			 * @see https://codex.wordpress.org/Function_Reference/register_taxonomy#Usage
			 */
			register_taxonomy_for_object_type(
				/**
				 * The name of the taxonomy.
				 * Default: None
				 */
				$taxonomy['slug'],

				/**
				 * A name of the object type for the taxonomy object.
				 * Default: None
				 */
				$taxonomy['post_type_slug']
			);

			/*
			if ( $taxonomy->terms ) {
				// https://wordpress.stackexchange.com/a/47688
				if ( !term_exists( 'Tour', 'tour') ) {
					wp_insert_term( 'Tour', 'tour',
						array(
							'description' => 'A ride which may contain tour legs',
							'slug' => 'tour'
						)
					);
				}
			}
			*/
		}
	}
}

/**
 * Create a %placeholder% for use in WordPress Permalinks settings
 * Taxonomies do not automatically appear in permalinks
 * The placeholder must be added to the string
 * The placeholder must be translated from a placeholder to the taxonomy term value
 * @param $permalink See WordPress function options
 * @param $post_id See WordPress function options
 * @param $leavename See WordPress function options
 * @see http://shibashake.com/wordpress-theme/add-custom-taxonomy-tags-to-your-wordpress-permalinks
 * @see http://shibashake.com/wordpress-theme/custom-post-type-permalinks-part-2#conflict
 * @see https://stackoverflow.com/questions/7723457/wordpress-custom-type-permalink-containing-taxonomy-slug
 */

add_filter('post_link', 'wpdtrt__taxonomy_permalink', 10, 3);
add_filter('post_type_link', 'wpdtrt__taxonomy_permalink', 10, 3);

function wpdtrt__taxonomy_permalink($permalink, $post_id, $leavename) {

	/**
	 * Load the plugin data stored in the WP Options table
	 * Retrieves an option value based on an option name.
	 * @example get_option( string $option, mixed $default = false )
	 */
	$taxonomies = get_option( 'wpdtrt__taxonomies' );

	/**
	 * Create a permalink from each item in the taxonomies array
	 */
	foreach( $taxonomies as $taxonomy ) {

		$placeholder = '%' . $taxonomy['slug'] . '%';

		/**
		* If the permalink does not contain the %placeholder% tag,
		* then we don’t need to translate anything.
		*/
		if (strpos($permalink, $placeholder) === FALSE) { // todo
			return $permalink;
		}

		// Get post
		$post = get_post($post_id);
		if (!$post) {
			return $permalink;
		}

		/**
		* Get the taxonomy terms related to the current post object
		* and cache the results (wp_get_object_terms doesn't)
		*/
		$terms = wp_get_object_terms($post->ID, $taxonomy['slug']);
		// todo: //$terms = get_the_terms($post->ID, $taxonomy['slug']);

		/**
		* Retrieve the slug value of the first custom taxonomy object linked to the current post.
		* If no terms are retrieved, then replace our term tag with the fallback value.
		* This prevents // in permalink
		*/
		if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0])) {
			$taxonomy_slug = $terms[0]->slug;
		}
		else {
			$taxonomy_slug = $taxonomy['fallback'];
		}

		/**
		* Replace the %placeholder% tag with our custom taxonomy slug.
		*/
		$permalink = str_replace($placeholder, $taxonomy_slug, $permalink);
	}

	return $permalink;

}

/**
 * Programatically set the elapsedday number
 * Note: Save Permalinks after changing this.
 * @see https://codex.wordpress.org/Function_Reference/wp_set_object_terms
 * @see https://stackoverflow.com/questions/29049543/set-default-taxonomy-term-for-custom-post-type
 * @todo Move to elapsed-day.php if it works from there
 * @todo wp_insert_term doesn't seem to do anything, or it is overwritten by wp_set_object_terms
 */

// run on save, publish, update and bulk/quick edit
add_action( 'save_post_tourdiaryday', 'wpdtrt__taxonomy_set_terms' );

/**
 * Run wp_set_object_terms after the custom taxonomy is registered.
 * Since register_taxonomy() is usually run at init,
 * you can also run your function at init,
 * but with a lower priority so it runs later.
 * @see https://wordpress.stackexchange.com/a/62813
 */
//add_action( 'init', 'wpdtrt__taxonomy_set_terms', 10); // runs but data not available for elapsed-day functions

function wpdtrt__taxonomy_set_terms( $post_id ) {

	/**
	 * Load the plugin data stored in the WP Options table
	 * Retrieves an option value based on an option name.
	 * @example get_option( string $option, mixed $default = false )
	 */
	$taxonomies = get_option( 'wpdtrt__taxonomies' );

	// bail if revision
	// https://core.trac.wordpress.org/ticket/16593
	// https://wordpress.stackexchange.com/a/67539
	if ( wp_is_post_revision($post_id) ) {
		return $post_id;
	}

	/**
	 * Apply a taxonomy term (category) to the appropriate item in the taxonomies array
	 */
	foreach( $taxonomies as $taxonomy ) {
		if ( $taxonomy['slug'] === 'elapsedday' ) {

			$current_post = get_post( $post_id );

			$elapsedday = dbth_get_post_daynumber($post_id);

			// cast the day integer as a string, to prevent the slug from being interpreted as a tag ID
			$term_id = (string)$elapsedday;

			$term_description = $taxonomy['label_prefix'] . $elapsedday;

			// if an elapsedday is not set
			if ( ! has_term( $term_id, $taxonomy['slug'], $post_id ) ) {

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
						 */
						'description' => $term_description,

						/**
						 * (numeric) (optional)
						 * Will assign value of 'parent' to the term.
						 * Default: 0 (zero)
						 */
						'parent' => 0,

						/**
						 * (string) (optional)
						 * Default: None
						 */
						'slug' => $elapsedday
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
					$taxonomy['slug'],

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
				$term = get_term_by ('slug', $term_id, $taxonomy['slug']);
			}

			// test that terms were created
			// wpdtrt__log($terms); //ok
		}
	}

	return $post_id;
}

/**
 * Examples
 */



?>