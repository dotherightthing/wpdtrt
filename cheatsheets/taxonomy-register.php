<?php
/**
 * Taxonomy - Register
 *
 * @package WPDTRT
 * @since 0.1.0
 */

namespace DoTheRightThing\WPDTRT\Cheatsheets;
/**
 * This cannot use PHP variables without violating theme-check (i18n),
 * but a static generator such as Mustache.php could be an option.
 */

/**
 * Register taxonomy
 * @uses ../../../../wp-includes/taxonomy.php
 * @see https://codex.wordpress.org/Function_Reference/register_taxonomy
 * @see https://www.smashingmagazine.com/2012/01/create-custom-taxonomies-wordpress/
 * @see https://code.tutsplus.com/articles/the-rewrite-api-post-types-taxonomies--wp-25488
 *
 * Register Custom Taxonomy BEFORE the Custom Post Type
 * for the rewrite rule to work
 * for WordPress to build the URL correctly
 * @see https://cnpagency.com/blog/the-right-way-to-do-wordpress-custom-taxonomy-rewrites/
 * @see https://mondaybynoon.com/revisiting-custom-post-types-taxonomies-permalinks-slugs/
 */
add_action('init', 'wpdtrt_register_taxonomy_TAXONOMY_SLUG', 0);

function wpdtrt_register_taxonomy_TAXONOMY_SLUG() {

	if ( !taxonomy_exists( 'TAXONOMY_SLUG' ) ) {

		$labels = array(
			/**
			 * The same as and overridden by $tax->label
			 */
			'name'                      	=> _x( 'LABEL_SINGLE', 'taxonomy general name', 'TEXT_DOMAIN' ),

			/**
			 * Default: _x( 'Post Tag', 'taxonomy singular name' )
			 */
			'singular_name' 				=> _x( 'LABEL_SINGLE', 'taxonomy singular name', 'TEXT_DOMAIN' ),

			/**
			 * Defaults to value of name label.
			 */
			'menu_name' 					=> __( 'LABEL_PLURAL', 'TEXT_DOMAIN' ),

			/**
			 * Default:  All Tags / All Categories
			 */
			'all_items' 					=> __( 'All LABEL_PLURAL', 'TEXT_DOMAIN' ),

			/**
			 * Default: Add New Tag / Add New Category
			 */
			'add_new_item' 					=> __( 'Add New LABEL_SINGLE', 'TEXT_DOMAIN' ),

			/**
			 * Default: Edit Tag / Edit Category
			 */
			'edit_item' 					=> __( 'Edit LABEL_SINGLE', 'TEXT_DOMAIN' ),

			/**
			 * Default: View Tag / View Category
			 */
			'view_item' 					=> __( 'View LABEL_SINGLE', 'TEXT_DOMAIN' ),

			/**
			 * Default: Update Tag / Update Category
			 */
			'update_item' 					=> __( 'Update LABEL_SINGLE', 'TEXT_DOMAIN' ),

			/**
			 * Default: New Tag Name / New Category Name
			 */
			'new_item_name'					=> __( 'New LABEL_SINGLE Name', 'TEXT_DOMAIN' ),

			/**
			 * This string is not used on non-hierarchical taxonomies such as post tags.
			 * Default: null / Parent Category
			 */
			'parent_item'					=> __( 'Parent LABEL_SINGLE', 'TEXT_DOMAIN' ),

			/**
			 * The same as parent_item, but with colon : in the end
			 * Default: null / Parent Category:
			 */
			'parent_item_colon'				=> __( 'Parent LABEL_SINGLE:', 'TEXT_DOMAIN' ),

			/**
			 * Default: Search Tags / Search Categories
			 */
			'search_items' 					=> __( 'Search LABEL_PLURAL', 'TEXT_DOMAIN' ),

			/**
			 * This string is not used on hierarchical taxonomies.
			 * Default: null / Popular Tags
			 */
			'popular_items' 				=> __( 'Popular LABEL_PLURAL', 'TEXT_DOMAIN' ),

			/**
			 * Used in the taxonomy meta box.
			 * This string is not used on hierarchical taxonomies.
			 * Default: null / Separate tags with commas
			 */
			'separate_items_with_commas' 	=> __( 'Separate LABEL_PLURAL with commas', 'TEXT_DOMAIN' ),

			/**
			 * Used in the meta box when JavaScript is disabled.
			 * This string is not used on hierarchical taxonomies.
			 * Default: null / Add or remove tags
			 */
			'add_or_remove_items' 			=> __( 'Add or remove LABEL_PLURAL', 'TEXT_DOMAIN' ),

			/**
			 * Used in the taxonomy meta box.
			 * This string is not used on hierarchical taxonomies.
			 * Default: null / Choose from the most used tags
			 */
			'choose_from_most_used' 		=> __( 'Choose from the most used LABEL_PLURAL', 'TEXT_DOMAIN' ),

			/**
			 * (3.6+) - the text displayed via clicking 'Choose from the most used tags' in the taxonomy meta box when no tags are available
			 * and
			 * (4.2+) - the text used in the terms list table when there are no items for a taxonomy.
			 * Default: No tags found / No categories found
			 */
			'not_found' 					=> __( 'No LABEL_PLURAL found', 'TEXT_DOMAIN' ),
		);

		$args = array(

	        /**
	         * Labels - defined above
	         */
	        'labels' 						=> $labels,

	        /**
	         * Whether a taxonomy is intended for use publicly
	         * either via the admin interface or by front-end users.
	         * Default: true
	         */
	        //'public' 						=> true,

	        /**
	         * Whether the taxonomy is publicly queryable.
	         * Default: $public.
	         */
	        //'publicly_queryable' 			=> true,

	        /**
	         * Whether to generate a default UI for managing this taxonomy.
	         * 3.5+ setting this to false for attachment taxonomies will hide the UI.
	         * Default: $public.
	         */
	        //'show_ui' 					=> true,

	        /**
	         * Where to show the taxonomy in the admin menu.
	         * show_ui must be true.
	         * Default: $show_ui.
	         */
	        //'show_in_menu' 				=> true,

	        /**
	         * Make this taxonomy available for selection in navigation menus.
	         * Default: $public.
	         */
	        //'show_in_nav_menus' 			=> true,

	        /**
	         * Make this taxonomy available for selection in navigation menus.
	         * Default: $public.
	         */
	        //'show_in_rest' 				=> true,

	        /**
	         * To change the base url of REST API route.
	         */
	        //'rest_base' 					=> 'TAXONOMY_SLUG',

	        /**
	         * REST API Controller class name.
	         */
	        //'rest_controller_class' 		=> WP_REST_Terms_Controller,

	        /**
	         * Whether to allow the Tag Cloud widget to use this taxonomy.
	         * Default: $show_ui.
	         */
	        //'show_tagcloud' 				=> true,

	        /**
	         * 4.2+ Whether to show the taxonomy in the quick/bulk edit panel.
	         * Default: $show_ui.
	         */
	        //'show_in_quick_edit' 			=> true,

	        /**
	         * 3.8+  Provide a callback function name for the meta box display.
	         * No meta box is shown if set to false.
	         * Default: null
	         */
	        //'meta_box_cb' 				=> null,

	        /**
	         * 3.5+  Whether to allow automatic creation of taxonomy columns on associated post-types table.
	         * Default: false
	         */
	        //'show_admin_column' 			=> false,

	        /**
	         * Default: ''
	         */
	        //'description' 				=> '',

	        /**
	         * Is this taxonomy hierarchical (have descendants) like categories or not hierarchical like tags.
	         * Default: false
	         */
	        'hierarchical' 					=> true,

			/**
			 * A function name that will be called when the count of an associated $object_type, such as post, is updated.
			 * Works much like a hook.
			 * Default: None - but see Note
			 * @see https://codex.wordpress.org/Function_Reference/register_taxonomy
			 */
			//'update_count_callback' 		=> '_update_post_term_count',

	        /**
	         * false = disable the query_var
	         * string = use custom query_var instead of default which is $taxonomy
	         * Default: $taxonomy
	         */
			//'query_var' 					=> true, // 'TAXONOMY_SLUG',

			/**
			 * Set to false to prevent automatic URL rewriting a.k.a. "pretty permalinks".
			 * Pass an $args array to override default URL settings for permalinks as outlined below:
			 * Default: true
			 */
			'rewrite' 						=> array(

				/**
				 * Used as pretty permalink text (i.e. /tag/)
				 *
				 * Do prefix the Custom Post Type rewrite slug
				 * but note that if the taxonomy slug matches the Custom Post Type slug
				 * taxonomy pages will fail as they will be interpreted as missing Posts
				 *
				 * Default: $taxonomy
				 */
				'slug' 						=> 'REWRITE_SLUG',

				/**
				 * Allows permalinks to be prepended with front base
				 * Default: true
				 * @src https://mondaybynoon.com/revisiting-custom-post-types-taxonomies-permalinks-slugs/
				 */
				'with_front' 				=> false,

				/**
				 * 3.1+ Allow hierarchical urls
				 * Default: false
				 */
				'hierarchical'				=> true,

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
				//'ep_mask' 					=> EP_NONE,
			),

	        /**
	         * An array of the capabilities for this taxonomy.
	         * manage_terms / manage_categories
	         * edit_terms / manage_categories
	         * delete_terms / manage_categories
	         * assign_terms / edit_posts
	         * Default: None
	         */
	        //'capabilities' 				=> None,

	        /**
	         * Whether this taxonomy should remember the order in which terms are added to objects.
	         * Default: None
	         */
	        //'sort' 						=> None,

	        /**
	         * Whether this taxonomy is a native or "built-in" taxonomy.
	         * Do not edit.
	         * Default: false
	         */
	        //'_builtin' 					=> false,
		);

		register_taxonomy(
			/**
			 * Taxonomy Name should only contain lowercase letters and the underscore character,
			 * and not be more than 32 characters long (database structure restriction).
			 * Default: None
			 */
			'TAXONOMY_SLUG',

			/**
			 * Object-types can be built-in Post Type or any Custom Post Type that may be registered.
			 * Default: None
			 */
			'POST_TYPE_SLUG',

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
		 *
		 * Define the taxonomy first
		 * So we can piggyback the base URL
		 * @see https://mondaybynoon.com/revisiting-custom-post-types-taxonomies-permalinks-slugs/
		 * tours/tourname/tourday/postname
		 * matching the WP Admin structure makes administration easier for clients
		 */
		register_taxonomy_for_object_type(
			/**
			 * The name of the taxonomy.
			 * Default: None
			 */
			'TAXONOMY_SLUG',

			/**
			 * A name of the object type for the taxonomy object.
			 * Default: None
			 */
			'POST_TYPE_SLUG'
		);
	}
}

?>