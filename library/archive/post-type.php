<?php
/**
 * DTRT Framework Helper: Post Type
 * Helper function to generate custom taxonomies with predictable defaults
 *
 * @package WPDTRT
 * @subpackage WPDTRT Functions
 * @since 0.1.0
 * @version 0.1.0
 */

add_action( 'init', 'wpdtrt_post_type_register_all' );

/**
 * Arguments cannot be passed directly to functions called via WordPress hooks and filters
 * Saving options to the database allows us to retrieve these when the function is called.
 *
 * Store all of our plugin options in an array
 * So that we only use have to consume one row in the WP Options table
 * WordPress automatically serializes this (into a string)
 * because MySQL does not support arrays as a data type
 */
$wpdtrt_post_types = array();

/**
 * Create a custom post type
 *
 * @param array $args Arguments.
 * @since 0.1.0
 */
function wpdtrt_post_type_create( $args ) {

	/**
	 * $args are passed in an associative array to give values named context
	 * Predeclare extracted variables for debugging purposes
	 *
	 * @see http://kb.dotherightthing.dan/php/wordpress/extract/
	 */
	$slug         = null;
	$rewrite_slug = null;
	$description  = null;
	$label_single = null;
	$label_plural = null;
	$supports     = null;
	$hierarchical = null;
	$has_archive  = null;
	$public       = null;

	// only overwrite the predeclared variables.
	extract( $args, EXTR_IF_EXISTS );

	$wpdtrt_post_types = get_option( 'wpdtrt_post_types' );

	// don't add duplicate items.
	foreach ( $wpdtrt_post_types as $post_type ) {
		if ( $post_type['slug'] === $slug ) {
			return;
		}
	}

	// add a new taxonomy to our options array.
	$wpdtrt_post_types[] = array(
		'slug'         => $slug,
		'rewrite_slug' => $rewrite_slug,
		'description'  => $description,
		'label_single' => $label_single,
		'label_plural' => $label_plural,
		'supports'     => $supports,
		'hierarchical' => $hierarchical,
		'has_archive'  => $has_archive,
		'public'       => $public,
	);

	/**
	 * Filter options
	 *
	 * @example $options = array_unique( $wpdtrt_tax_options ); // see above
	 */

	/**
	 * Save options object to database
	 *
	 * Update the plugin data stored in the WP Options table
	 * This function may be used in place of add_option, although it is not as flexible.
	 * update_option will check to see if the option already exists.
	 * If it does not, it will be added with add_option('option_name', 'option_value').
	 * Unless you need to specify the optional arguments of add_option(),
	 * update_option() is a useful catch-all for both adding and updating options.
	 *
	 * @example update_option( string $option, mixed $value, string|bool $autoload = null )
	 * @see https://codex.wordpress.org/Function_Reference/update_option
	 */
	update_option( 'wpdtrt_post_types', $wpdtrt_post_types, null );
}

/**
 * Register post type
 *
 * @uses ../../../../wp-includes/post.php
 * @see https://codex.wordpress.org/Function_Reference/register_post_type
 * @see https://premium.wpmudev.org/blog/creating-content-custom-post-types/
 */
function wpdtrt_post_type_register_all() {

	/**
	 * Load the plugin data stored in the WP Options table
	 * Retrieves an option value based on an option name.
	 *
	 * @example get_option( string $option, mixed $default = false )
	 */
	$post_types = get_option( 'wpdtrt_post_types' );

	/**
	 * Create a post type from each item in the post types array
	 * Note: concatenation requires brackets to pass theme-check
	 *
	 * @see https://codex.wordpress.org/Function_Reference/register_post_type
	 */
	foreach ( $post_types as $post_type ) {

		if ( ! post_type_exists( $post_type['slug'] ) ) {

			// phpcs:disable
			$labels = array(
				/**
				 * The same and overridden by $post_type_object->label.
				 * Default: Posts/Pages
				 */
				'name'                  => _x( $post_type['label_plural'], 'post type general name', 'wpdtrt' ),

				/**
				* Default: Post/Page
				*/
				'singular_name'         => _x( $post_type['label_single'], 'post type singular name', 'wpdtrt' ),

				/**
				* The default is "Add New" for both hierarchical and non-hierarchical post types.
				* I18n: Use a gettext context matching your post type: _x('Add New', 'text-domain');
				*/
				'add_new'               => _x( ( 'Add New ' . $post_type['label_single'] ), 'wpdtrt' ),

				/**
				* Default: Add New Post/Add New Page.
				*/
				'add_new_item'          => __( ( 'Add New ' . $post_type['label_single'] ), 'wpdtrt' ),

				/**
				* Default: Edit Post/Edit Page.
				*/
				'edit_item'             => __( ( 'Edit ' . $post_type['label_single'] ), 'wpdtrt' ),

				/**
				* Default: New Post/New Page.
				*/
				'new_item'              => __( ( 'New ' . $post_type['label_single'] ), 'wpdtrt' ),

				/**
				* Default: View Post/View Page.
				*/
				'view_item'             => __( ( 'View ' . $post_type['label_single'] ), 'wpdtrt' ),

				/**
				* Default: View Posts/View Pages.
				*/
				'view_items'            => __( ( 'View ' . $post_type['label_plural'] ), 'wpdtrt' ),

				/**
				* Default: Search Posts/Search Pages.
				*/
				'search_items'          => __( ( 'Search ' . $post_type['label_plural'] ), 'wpdtrt' ),

				/**
				* Default: No posts found/No pages found.
				*/
				'not_found'             => __( ( 'No  ' . $post_type['label_plural'] . ' found.' ), 'wpdtrt' ),

				/**
				* Default: No posts found in Trash/No pages found in Trash.
				*/
				'not_found_in_trash'    => __( ( 'No  ' . $post_type['label_plural'] . ' found in Trash.' ), 'wpdtrt' ),

				/**
				* This string isn't used on non-hierarchical types.
				* The default is 'Parent Page:'.
				*/
				'parent_item_colon'     => __( ( 'Parent ' . $post_type['label_single'] . ':' ), 'wpdtrt' ),

				/**
				* String for the submenu.
				* Default: All Posts/All Pages.
				*/
				'all_items'             => __( ( 'All ' . $post_type['label_plural'] ), 'wpdtrt' ),

				/**
				* String for use with archives in nav menus.
				* Default: Post Archives/Page Archives.
				*/
				'archives'              => __( ( $post_type['label_single'] . ' Archives' ), 'wpdtrt' ),

				/**
				* Label for the attributes meta box.
				* Default: 'Post Attributes' / 'Page Attributes'.
				*/
				'attributes'            => __( ( $post_type['label_single'] . ' Attributes' ), 'wpdtrt' ),

				/**
				* String for the media frame button.
				* Default: Insert into post/Insert into page.
				*/
				'insert_into_item'      => __( ( 'Insert into ' . $post_type['label_single'] ), 'wpdtrt' ),

				/**
				* String for the media frame filter.
				* Default: Uploaded to this post/Uploaded to this page.
				*/
				'uploaded_to_this_item' => __( ( 'Uploaded to this ' . $post_type['label_single'] ), 'wpdtrt' ),

				/**
				* Default: Featured Image.
				*/
				'featured_image'        => __( 'Featured Image', 'wpdtrt' ),

				/**
				* Default: Set featured image.
				*/
				'set_featured_image'    => __( 'Set featured image', 'wpdtrt' ),

				/**
				* Default: Remove featured image.
				*/
				'remove_featured_image' => __( 'Remove featured image', 'wpdtrt' ),

				/**
				* Default: Use as featured image.
				*/
				'use_featured_image'    => __( 'Use as featured image', 'wpdtrt' ),

				/**
				* Default: the same as name
				*/
				'menu_name'             => _x( $post_type['label_plural'], 'post type general name', 'wpdtrt' ),

				/**
				* String for the table views hidden heading
				*/
				'filter_items_list'     => _x( $post_type['label_single'], 'wpdtrt' ), // no example in docs.

				/**
				* String for the table pagination hidden heading.
				*/
				'items_list_navigation' => _x( $post_type['label_single'], 'wpdtrt' ), // no example in docs.

				/**
				* String for the table hidden heading.
				*/
				'items_list'            => _x( $post_type['label_single'], 'wpdtrt' ), // no example in docs.

				/**
				* String for use in New in Admin menu bar.
				* Default: the same as `singular_name`.
				*/
				'name_admin_bar'        => _x( $post_type['label_single'], 'post type singular name', 'wpdtrt' ),
			);
			// phpcs:enable

			$args = array(

				/**
				 * Labels - defined above
				 */
				'labels'              => $labels,

				/**
				 * A short descriptive summary of what the post type is.
				 * Default: ''
				 *
				 * @example
				 *    $obj = get_post_type_object( 'your_post_type_name' );
				 *    echo esc_html( $obj->description );
				 */
				'description'         => $post_type['description'],

				/**
				 * Whether a post type is intended for use publicly
				 * (either via the admin interface or by front-end users.?)
				 * Default: false
				 */
				'public'              => $post_type['public'],

				/**
				 * Whether to exclude posts with this post type from front end search results.
				 * Default: !$public
				 */
				'exclude_from_search' => ! $post_type['public'],

				/**
				 * Whether the post type is publicly queryable.
				 * Whether queries can be performed on the front end as part of parse_request().
				 * Default: $public.
				 */
				'publicly_queryable'  => $post_type['public'],

				/**
				 * Whether to generate a default UI for managing this post type in the admin.
				 * Note: _built-in post types, such as post and page, are intentionally set to false.
				 * Default: $public.
				 */
				'show_ui'             => $post_type['public'],

				/**
				 * Whether post_type is available for selection in navigation menus.
				 * Default: $public.
				 */
				'show_in_nav_menus'   => $post_type['public'],

				/**
				 * Where to show the post type in the admin menu.
				 * show_ui must be true.
				 * Default: $show_ui.
				 */
				'show_in_menu'        => $post_type['public'],

				/**
				 * Whether to make this post type available in the WordPress admin bar
				 * Default: $show_in_menu
				 */
				'show_in_admin_bar'   => $post_type['public'],

				/**
				 * The position in the menu order the post type should appear.
				 * show_in_menu must be true
				 * Default: null (below comments)
				 * 5 - below Posts
				 * 10 - below Media
				 * 15 - below Links
				 * 20 - below Pages
				 * 25 - below comments
				 * 60 - below first separator
				 * 65 - below Plugins
				 * 70 - below Users
				 * 75 - below Tools
				 * 80 - below Settings
				 * 100 - below second separator
				 */
				'menu_position'       => 5,

				/**
				 * The url to the icon to be used for this menu or the name of the icon from the dashicons iconfont.
				 * Default: null (posts icon)
				 */
				'menu_icon'           => null,

				/**
				 * The string to use to build the read, edit, and delete capabilities.
				 * Used as a base to construct capabilities unless they are explicitly set with the 'capabilities' parameter.
				 * map_meta_cap needs to be set to false or null, to make this work
				 *
				 * @see https://codex.wordpress.org/Function_Reference/register_post_type#capability_type
				 */
				'capability_type'     => 'post',

				/**
				 * An array of the capabilities for this post type.
				 * Default: $capability_type is used to construct this
				 *
				 * @example 'capabilities' => array(),
				 */

				/**
				 * Whether to use the internal default meta capability handling.
				 * If set it to false then standard admin role can't edit the posts types.
				 * Then the edit_post capability must be added to all roles to add or edit the posts types.
				 */
				'map_meta_cap'        => null,

				/**
				 * Whether the post type is hierarchical (e.g. page). Allows Parent to be specified. The 'supports' parameter should contain 'page-attributes' to show the parent select box on the editor page.
				 * Note: This parameter was intended for Pages. Shared servers / 2k+ entries will cause memory / load time issues.
				 * Default: false
				 */
				'hierarchical'        => $post_type['hierarchical'],

				/**
				 * The admin elements to display.
				 * An alias for calling add_post_type_support() directly.
				 * 3.5+, false can be passed as value instead of an array to prevent default (title and editor) behavior.
				 */
				'supports'            => $post_type['supports'],

				/**
				 * Provide a callback function that will be called when setting up the meta boxes for the edit form
				 * The callback function takes one argument $post, which contains the WP_Post object for the currently edited post.
				 * Do remove_meta_box() and add_meta_box() calls in the callback.
				 * Default: None
				 *
				 * @example 'register_meta_box_cb' => None,
				 */

				/**
				 * An array of registered taxonomies like category or post_tag that will be used with this post type.
				 * Note: This can be used in lieu of calling register_taxonomy_for_object_type() directly.
				 * BUT Custom taxonomies still need to be registered with register_taxonomy().
				 * AND register_taxonomy() recommends calling register_taxonomy_for_object_type from there for best results
				 * Default: no taxonomies
				 *
				 * @example 'taxonomies' =>
				 */

				/**
				 * Enables post type archives.
				 * Default: $post_type as slug
				 */
				'has_archive'         => $post_type['has_archive'],

				/**
				 * Set to false to prevent automatic URL rewriting a.k.a. "pretty permalinks".
				 * Pass an $args array to override default URL settings for permalinks.
				 *
				 * Note: WP respects some of the string set in Permalink Settings and some of the string set here
				 *
				 * @example 'rewrite' => true
				 * @example
				 *  http://dontbelievethehype.dan/sample-post/ (Permalink Settings - Post name)
				 *  + tour-diary/%tour%/%elapsedday% (Custom Post Type Rewrite String)
				 *  = http://dontbelievethehype.dan/tour-diary/rainbow-road-2017/no-day/permalink-test-3/ (Permalink)
				 *
				 * However if the same placeholders are used in both strings the results are more unpredictable
				 * Default: true and use $post_type as slug
				 */
				'rewrite'             => array(
					/**
					 * Used as pretty permalink text (i.e. /tag/)
					 * Default: $post_type, should be translatable
					 */
					'slug'       => $post_type['rewrite_slug'],

					/**
					 * Allows permalinks to be prepended with front base
					 *
					 * @example
					 *  permalink structure: /blog/
					 *  false == /news/
					 *  true == /blog/news/
					 * Default: true
					 * @see https://mondaybynoon.com/revisiting-custom-post-types-taxonomies-permalinks-slugs/
					 */
					'with_front' => false,

					/**
					 * Should a feed permalink structure be built for this post type.
					 * Default: $has_archive
					 */
					'feeds'      => $post_type['has_archive'],

					/**
					 * Should the permalink structure provide for pagination.
					 * Default: true
					 */
					'pages'      => true,

					/**
					 * 3.4+ Assign an endpoint (EP) mask for this post type.
					 *
					 * Notes for taxonomony.php:
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
					 * Default: EP_PERMALINK
					 *
					 * @see https://make.wordpress.org/plugins/2012/06/07/rewrite-endpoints-api/
					 */
					'ep_mask'    => EP_PERMALINK,
				),

				/**
				 * The default rewrite endpoint bitmasks
				 * Default: EP_PERMALINK
				 */
				'permalink_epmask'    => EP_PERMALINK,

				/**
				 * Default: true - set to $post_type
				 * false = disable the query_var
				 * string = use custom query_var instead of default which is $taxonomy
				*/
				'query_var'           => $post_type['slug'],

				/**
				 * Can this post_type be exported.
				 * Default: true
				 */
				'can_export'          => true,

				/**
				 * Whether to delete posts of this type when deleting a user
				 * Default: null (posts are trashed if post_type_supports('author'), otherwise posts are not trashed or deleted).
				 */
				'delete_with_user'    => null,

				/**
				 * Whether to expose this post type in the REST API.
				 * Default: false.
				 */
				'show_in_rest'        => false,

				/**
				 * To change the base url of REST API route.
				 * The base slug that this post type will use when accessed using the REST API.
				 */
				'rest_base'           => $post_type['slug'],

				/**
				 * An optional custom controller to use instead of WP_REST_Posts_Controller. Must be a subclass of WP_REST_Controller.
				 *
				 * @example rest_controller_class' => WP_REST_Posts_Controller,
				 */

				/**
				* Whether this post type is a native or "built-in" post type.
				* Do not edit.
				* Default: false
				*
				* @example '_builtin' => false,
				*/

				/**
				 * Link to edit an entry with this post type.
				 * Do not edit.
				 * Default: 'post.php?post=%d'
				 *
				 * @example '_edit_link' => 'post.php?post=%d'
				 */
			);

			register_post_type(
				/**
				 * Post type
				 * max. 20 characters, cannot contain capital letters or spaces
				 * Default: None
				 */
				$post_type['slug'],
				/**
				 * Optional array of Arguments.
				 * Default: None
				 */
				$args
			);
		}
	}
}

/**
 * Test the current post type in a template
 *
 * @param string $post_type The post type (slug).
 * @return $is boolean
 *
 * @example
 *  if ( wpdtrt_post_type_is('tourdiaryday') ) {
 *    get_template_part( 'template-parts/stack--navigation' );
 *  }
 */
function wpdtrt_post_type_is( $post_type ) {
	$is = ( is_singular() && ( get_query_var( 'post_type' ) === $post_type ) );
	return $is;
}
