<?php

/*
 * Add admin columns
 * http://code.tutsplus.com/articles/quick-tip-make-your-custom-column-sortable--wp-25095
 * There is a plugin for this but it doesn't have sorting so it is useless for day
 *
 * http://code.tutsplus.com/tutorials/add-a-custom-column-in-posts-and-custom-post-types-admin-screen--wp-24934
 */

// GET FEATURED IMAGE
// TODO: replace with codepress-admin-columns
add_image_size('admin_thumbnail', 50, 50, false);

// TODO: replace with codepress-admin-columns
function dbth_get_featured_image($post_id) {
  $post_thumbnail_id = get_post_thumbnail_id($post_id);
  if ($post_thumbnail_id) {
    $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'admin_thumbnail');
    return $post_thumbnail_img[0];
  }
}

// SHOW THE CONTENT
// for 'day' posttype this would be: manage_day_posts_custom_column
// TODO: replace with codepress-admin-columns
add_action('manage_tourdiaryday_posts_custom_column', 'dbth_columns_content', 10, 2);
function dbth_columns_content($column_name, $post_id) {
  if ($column_name == 'featured_image_column') {
    $post_featured_image = dbth_get_featured_image($post_id);
    if ($post_featured_image) {
      echo '<img src="' . $post_featured_image . '" />';
    }
  }
  else if ($column_name == 'day_column') {
    $post = get_post($post_id);
    //$post_day = get_the_slug($post_id);
    //$post_day = $post->post_name;
    $post_day = get_the_terms( $post, 'elapsedday' );
    if ($post_day) {
      echo str_replace('day-', '', $post_day);
    }
  }
  else if ($column_name == 'location_column') {
    $post_location = get_field('acf_location');
    if ($post_location) {
      echo $post_location;
    }
  }
  else if ($column_name == 'accommodation_column') {
    $accommodation = get_field('acf_accommodation');
    if ($accommodation) {
      echo $accommodation;
    }
  }
}

// ADD NEW COLUMNS & CHANGE COLUMN ORDER
// http://wordpress.stackexchange.com/a/116602
// for 'day' posttype this would be: manage_edit-day_columns
// TODO: replace with codepress-admin-columns
add_filter('manage_edit-tourdiaryday_columns', 'dbth_column_order');
function dbth_column_order($columns) {
  # add your column key to the existing columns.
  $columns['featured_image_column'] = __( 'Thumb');
  $columns['day_column'] = __( 'Day');
  $columns['location_column'] = __( 'Location');
  $columns['accommodation_column'] = __( 'Accommodation');
  $columns['temperature_column'] = __( 'Temp');


  # now define a new order. you need to look up the column
  # names in the HTML of the admin interface HTML of the table header.
  #   "cb" is the "select all" checkbox.
  #   "title" is the title column.
  #   "date" is the date column.
  $customOrder = array('cb', 'day_column', 'date', 'title', 'location_column', 'featured_image_column', 'accommodation_column', 'temperature_column', 'categories', 'tags');

  # return a new column array to wordpress.
  # order is the exactly like you set in $customOrder.
  foreach ($customOrder as $colname)
    $new[$colname] = $columns[$colname];
  return $new;
}

// http://wpdreamer.com/2014/04/how-to-make-your-wordpress-admin-columns-sortable/
// for 'day' posttype this would be: manage_edit-day_sortable_columns
// TODO: replace with codepress-admin-columns
/*
add_filter('manage_edit-tourdiaryday_sortable_columns', 'dbth_sortable_columns');
function dbth_sortable_columns( $sortable_columns ) {
  $sortable_columns['day_column'] = 'post_name';

  //To make a column 'un-sortable' remove it from the array
  //unset($columns['date']);

  return $sortable_columns;
}
*/

add_action('pre_get_posts', 'dbth_sort_order', 1 );
function dbth_sort_order( $query ) {

 /**
  * We only want our code to run in the main WP query
  * AND if an orderby query variable is designated.
  */
 if ( $query->is_main_query() && ( $orderby = $query->get( 'orderby' ) ) ) {

  switch( $orderby ) {

    case 'post_name':
      ////return "post_name+0 ASC";
      // https://codex.wordpress.org/Custom_Queries#Display_Order_and_Post_Count_Limit
      // https://css-tricks.com/snippets/wordpress/natural-sort/
      $query->set( 'orderby', 'meta_value_num' ); // sort numerical - BUT only seems to work ASC
      break;
  }
 }
}

?>