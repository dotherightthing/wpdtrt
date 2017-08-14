<?php
/**
  * Create Custom Post Type
  * Original source: https://premium.wpmudev.org/blog/creating-content-custom-post-types/
  * @todo create generator as per taxonomies, and add to generator-wp-theme-boilerplate
  */

/**
 * wp_create_post_type__tourdiaryday()
 */

function wp_create_post_type__tourdiaryday() {
  // set up labels
  $labels = array(
    'name' => 'Tour Day',
      'singular_name' => 'Tour Day',
      'add_new' => 'Add Tour Day',
      'add_new_item' => 'Add Tour Day',
      'edit_item' => 'Edit Tour Day',
      'new_item' => 'New Tour Day',
      'all_items' => 'All Tour Days',
      'view_item' => 'View Tour Day',
      'search_items' => 'Search Tour Days',
      'not_found' =>  'No Tour Days Found',
      'not_found_in_trash' => 'No Tour Days found in Trash',
      'parent_item_colon' => '',
      'menu_name' => 'Tour Days',
    );
  //register post type
  register_post_type( 'tourdiaryday', array(
    'labels' => $labels,
    'has_archive' => true, // show archive pages for this post type.
    'public' => true,
    'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'comments', 'revisions' ), // the elements of the WordPress admin that the custom post type supports.
    'taxonomies' => array( 'post_tag', 'category' ), // built-in categories and tags
    'exclude_from_search' => false, // included in search results.
    'capability_type' => 'post', // behave like posts and not pages.
    'rewrite' => array(
      /*
       * WP respects some of the string set in Permalink Settings
       * and some of the string set here
       * @example
       * http://dontbelievethehype.dan/sample-post/ (Permalink Settings - Post name)
       * + tour-diary/%tour%/%elapsedday% (Custom Post Type Rewrite String)
       * = http://dontbelievethehype.dan/tour-diary/rainbow-road-2017/no-day/permalink-test-3/ (Permalink)
       *
       * However if the same placeholders are used in both strings
       * the results are more unpredictable:
       */
      'slug' => 'tour-diary/%tour%/%elapsedday%', //'/%post_type%/%tour%/%elapsedday%/%postname%/'
    ), // the post slug: http://dontbelievethehype.dan/tour-diary/1/
    'hierarchical' => true
    )
  );
}

add_action( 'init', 'wp_create_post_type__tourdiaryday' );

?>