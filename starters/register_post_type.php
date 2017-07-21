<?php
/**
 * DTRT Framework Starter: Register Post Type
 * Starter template with predictable defaults.
 * Please keep the version updated, to support diffing.
 *
 * This cannot use PHP variables without violating theme-check (i18n),
 * but a static generator such as Mustache.php could be an option.
 *
 * Parts:
 * 1. Register post type
 *
 * Variables
 * 1. POST_TYPE_SLUG - plural, e.g. cameras
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Theme Function Starters
 * @since 0.1.0
 * @version 0.1.0
 */

/**
 * 1. Register post type
 * @uses ../../../../wp-includes/post.php
 * @see https://codex.wordpress.org/Function_Reference/register_post_type
 * @see https://premium.wpmudev.org/blog/creating-content-custom-post-types/
 */
add_action('init', 'wpdtrt_register_post_type_POST_TYPE_SLUG');

function wpdtrt_register_post_type_POST_TYPE_SLUG() {

    if ( !post_type_exists( 'COLLECTION_SLUG_PLURAL' ) ) {

      $labels = array(
        /**
         * The same and overridden by $post_type_object->label.
         * Default: Posts/Pages
         */
        'name'                          => _x( 'COLLECTION_PLURAL', 'post type general name', 'TEXT_DOMAIN' ),

        /**
         * Default: Post/Page
         */
        'singular_name'                 => _x( 'POST_SINGLE', 'post type singular name', 'TEXT_DOMAIN' ),

        /**
         * The default is "Add New" for both hierarchical and non-hierarchical post types.
         * I18n: Use a gettext context matching your post type: _x('Add New', 'text-domain');
         */
        'add_new'                       => _x( 'Add New POST_SINGLE', 'TEXT_DOMAIN' ),

        /**
         * Default: Add New Post/Add New Page.
         */
        'add_new_item'                  => __( 'Add New POST_SINGLE', 'TEXT_DOMAIN' ),

        /**
         * Default: Edit Post/Edit Page.
         */
        'edit_item'                     => __( 'Edit POST_SINGLE', 'TEXT_DOMAIN' ),

        /**
         * Default: New Post/New Page.
         */
        'new_item'                      => __( 'New POST_SINGLE', 'TEXT_DOMAIN' ),

        /**
         * Default: View Post/View Page.
         */
        'view_item'                     => __( 'View POST_SINGLE', 'TEXT_DOMAIN' ),

        /**
         * Default: View Posts/View Pages.
         */
        'view_items'                    => __( 'View POST_PLURAL', 'TEXT_DOMAIN' ),

        /**
         * Default: Search Posts/Search Pages.
         */
        'search_items'                  => __( 'Search POST_PLURAL', 'TEXT_DOMAIN' ),

        /**
         * Default: No posts found/No pages found.
         */
        'not_found'                     => __( 'No POST_PLURAL found', 'TEXT_DOMAIN' ),

        /**
         * Default: No posts found in Trash/No pages found in Trash.
         */
        'not_found_in_trash'            => __( 'No POST_PLURAL found in Trash', 'TEXT_DOMAIN' ),

        /**
         * This string isn't used on non-hierarchical types.
         * The default is 'Parent Page:'.
         */
        'parent_item_colon'             => __( 'Parent POST_SINGLE:', 'TEXT_DOMAIN' ),

        /**
         * String for the submenu.
         * Default: All Posts/All Pages.
         */
        'all_items'                     => __( 'All POST_PLURAL', 'TEXT_DOMAIN' ),

        /**
         * String for use with archives in nav menus.
         * Default: Post Archives/Page Archives.
         */
        'archives'                      => __( 'POST_SINGLE Archives', 'TEXT_DOMAIN' ),

        /**
         * Label for the attributes meta box.
         * Default: 'Post Attributes' / 'Page Attributes'.
         */
        'attributes'                    => __( 'POST_SINGLE Attributes', 'TEXT_DOMAIN' ),

        /**
         * String for the media frame button.
         * Default: Insert into post/Insert into page.
         */
        'insert_into_item'              => __( 'Insert into POST_SINGLE', 'TEXT_DOMAIN' ),

        /**
         * String for the media frame filter.
         * Default: Uploaded to this post/Uploaded to this page.
         */
        'uploaded_to_this_item'         => __( 'Uploaded to this POST_SINGLE', 'TEXT_DOMAIN' ),

        /**
         * Default: Featured Image.
         */
        //'featured_image'              => __( 'Featured Image', 'TEXT_DOMAIN' ),

        /**
         * Default: Set featured image.
         */
        //'set_featured_image'          => __( 'Set featured image', 'TEXT_DOMAIN' ),

        /**
         * Default: Remove featured image.
         */
        //'remove_featured_image'       => __( 'Remove featured image', 'TEXT_DOMAIN' ),

        /**
         * Default: Use as featured image.
         */
        //'use_featured_image'          => __( 'Use as featured image', 'TEXT_DOMAIN' ),

        /**
         * Default: the same as name
         */
        'menu_name'                     => _x( 'COLLECTION_PLURAL', 'post type general name', 'TEXT_DOMAIN' ),

        /**
         * String for the table views hidden heading
         */
        'filter_items_list'             => _x( 'POST_SINGLE', 'TEXT_DOMAIN' ), // no example in docs

        /**
         * String for the table pagination hidden heading.
         */
        'items_list_navigation'         => _x( 'POST_SINGLE', 'TEXT_DOMAIN' ), // no example in docs

        /**
         * String for the table hidden heading.
         */
        'items_list'                    => _x( 'POST_SINGLE', 'TEXT_DOMAIN' ), // no example in docs

        /**
         * String for use in New in Admin menu bar.
         * Default: the same as `singular_name`.
         */
        'name_admin_bar'                => _x( 'POST_SINGLE', 'post type singular name', 'TEXT_DOMAIN' ),
      );

      $args = array(

        /**
         * Labels - defined above
         */
        'labels'                        => $labels,

        /**
         * A short descriptive summary of what the post type is.
         * Default: ''
         * @example
         *    $obj = get_post_type_object( 'your_post_type_name' );
         *    echo esc_html( $obj->description );
         */
        //'description'                  => '',

        /**
         * Whether a post type is intended for use publicly
         * (either via the admin interface or by front-end users.?)
         * Default: false
         */
        'public'                        => true,

        /**
         * Whether to exclude posts with this post type from front end search results.
         * Default: !$public
         */
        'exclude_from_search'           => false,

        /**
         * Whether the post type is publicly queryable.
         * Whether queries can be performed on the front end as part of parse_request().
         * Default: $public.
         */
        //'publicly_queryable'          => true,

        /**
         * Whether to generate a default UI for managing this post type in the admin.
         * Note: _built-in post types, such as post and page, are intentionally set to false.
         * Default: $public.
         */
        //'show_ui'                     => true,

        /**
         * Whether post_type is available for selection in navigation menus.
         * Default: $public.
         */
        //'show_in_nav_menus'           => true,

        /**
         * Where to show the post type in the admin menu.
         * show_ui must be true.
         * Default: $show_ui.
         */
        //'show_in_menu'                => true,

        /**
         * Whether to make this post type available in the WordPress admin bar
         * Default: $show_in_menu
         */
        //'show_in_admin_bar'           => true,

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
        'menu_position'                 => 5,

        /**
         * The url to the icon to be used for this menu or the name of the icon from the dashicons iconfont.
         * Default: null (posts icon)
         */
        //'menu_icon'                   => null,

        /**
         * The string to use to build the read, edit, and delete capabilities.
         * Used as a base to construct capabilities unless they are explicitly set with the 'capabilities' parameter.
         * map_meta_cap needs to be set to false or null, to make this work
         * @see https://codex.wordpress.org/Function_Reference/register_post_type#capability_type
         */
        'capability_type'               => 'post',

        /**
         * An array of the capabilities for this post type.
         * Default: $capability_type is used to construct this
         */
        //'capabilities'                => array(),

        /**
         * Whether to use the internal default meta capability handling.
         * If set it to false then standard admin role can't edit the posts types.
         * Then the edit_post capability must be added to all roles to add or edit the posts types.
         */
        //'map_meta_cap'                => null,

        /**
         * Whether the post type is hierarchical (e.g. page). Allows Parent to be specified. The 'supports' parameter should contain 'page-attributes' to show the parent select box on the editor page.
         * Note: This parameter was intended for Pages. Shared servers / 2k+ entries will cause memory / load time issues.
         * Default: false
         */
        //'hierarchical'                => false,

        /**
         * The admin elements to display.
         * An alias for calling add_post_type_support() directly.
         * 3.5+, false can be passed as value instead of an array to prevent default (title and editor) behavior.
         */
        'supports'                      => array(
            'title',
            'editor',
            'excerpt',
            'custom-fields',
            'thumbnail',
            'comments',
            'revisions'
        ),

        /**
         * Provide a callback function that will be called when setting up the meta boxes for the edit form
         * The callback function takes one argument $post, which contains the WP_Post object for the currently edited post.
         * Do remove_meta_box() and add_meta_box() calls in the callback.
         * Default: None
         */
        //'register_meta_box_cb'        => None,

        /**
         * An array of registered taxonomies like category or post_tag that will be used with this post type.
         * Note: This can be used in lieu of calling register_taxonomy_for_object_type() directly.
         * BUT Custom taxonomies still need to be registered with register_taxonomy().
         * AND register_taxonomy() recommends calling register_taxonomy_for_object_type from there for best results
         * Default: no taxonomies
         */
        //'taxonomies'                  =>

        /**
         * Enables post type archives.
         * Default: $post_type as slug
         */
        //'has_archive'                   => 'COLLECTION_SLUG_PLURAL',

        /**
         * Set to false to prevent automatic URL rewriting a.k.a. "pretty permalinks".
         * Pass an $args array to override default URL settings for permalinks.
         *
         * Note: WP respects some of the string set in Permalink Settings and some of the string set here
         * @example
         *  http://dontbelievethehype.dan/sample-post/ (Permalink Settings - Post name)
         *  + tour-diary/%tour%/%elapsedday% (Custom Post Type Rewrite String)
         *  = http://dontbelievethehype.dan/tour-diary/rainbow-road-2017/no-day/permalink-test-3/ (Permalink)
         *
         * However if the same placeholders are used in both strings the results are more unpredictable
         * Default: true and use $post_type as slug
         */
        //'rewrite' => true,
        'rewrite'                       => array(
          /**
           * Used as pretty permalink text (i.e. /tag/)
           * Default: $post_type, should be translatable
           */
          'slug'                        => 'REWRITE_SLUG',

          /**
           * Allows permalinks to be prepended with front base
           * @example
           *  permalink structure: /blog/
           *  false == /news/
           *  true == /blog/news/
           * Default: true
           * @see https://mondaybynoon.com/revisiting-custom-post-types-taxonomies-permalinks-slugs/
           */
          'with_front'                  => false,

          /**
           * Should a feed permalink structure be built for this post type.
           * Default: $has_archive
           */
          //'feeds'                     => true,

          /**
           * Should the permalink structure provide for pagination.
           * Default: true
           */
          //'pages'                     => true,

          /**
           * 3.4+ Assign an endpoint (EP) mask for this post type.
           *
           * taxonomony.php notes:
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
           * @see https://make.wordpress.org/plugins/2012/06/07/rewrite-endpoints-api/
           */
          //'ep_mask'                   => EP_PERMALINK,
        ),

        /**
         * The default rewrite endpoint bitmasks
         * Default: EP_PERMALINK
         */
        //'permalink_epmask'            => EP_PERMALINK,

        /**
         * false = disable the query_var
         * string = use custom query_var instead of default which is $taxonomy
         * Default: true - set to $post_type
         */
        //'query_var'                   => 'POST_TYPE_SLUG',

        /**
         * Can this post_type be exported.
         * Default: true
         */
        //'can_export'                  => true,

        /**
         * Whether to delete posts of this type when deleting a user
         * Default: null (posts are trashed if post_type_supports('author'), otherwise posts are not trashed or deleted).
         */
        //'delete_with_user'            => null,

        /**
         * Whether to expose this post type in the REST API.
         * Default: false.
         */
        //'show_in_rest'                => false,

        /**
         * To change the base url of REST API route.
         * The base slug that this post type will use when accessed using the REST API.
         */
        //'rest_base'                   => 'POST_TYPE_SLUG',

        /**
         * An optional custom controller to use instead of WP_REST_Posts_Controller. Must be a subclass of WP_REST_Controller.
         */
        //'rest_controller_class'       => WP_REST_Posts_Controller,

        /**
         * Whether this post type is a native or "built-in" post type.
         * Do not edit.
         * Default: false
         */
        //'_builtin'                    => false,

        /**
         * Link to edit an entry with this post type.
         * Do not edit.
         * Default: 'post.php?post=%d'
         */
        //'_edit_link'                  => 'post.php?post=%d'
      );

      register_post_type(
        /**
         * Post type
         * max. 20 characters, cannot contain capital letters or spaces
         * Default: None
         */
        'COLLECTION_SLUG_PLURAL',

        /**
         * Optional array of Arguments.
         * Default: None
         */
        $args
      );
    }
}

?>