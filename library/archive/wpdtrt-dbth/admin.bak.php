<?php
/**
 * Add admin columns
 * There is a plugin for this but it doesn't have sorting so it is useless for day
 *
 * @package WPDTRT
 * @subpackage WPDTRT Functions
 * @since 0.1.0
 * @version 0.1.0
 * @see http://code.tutsplus.com/articles/quick-tip-make-your-custom-column-sortable--wp-25095
 * @see http://code.tutsplus.com/tutorials/add-a-custom-column-in-posts-and-custom-post-types-admin-screen--wp-24934
 */

add_image_size( 'admin_thumbnail', 50, 50, false );
add_action( 'manage_tourdiaryday_posts_custom_column', 'dbth_columns_content', 10, 2 );
add_filter( 'manage_edit-tourdiaryday_columns', 'dbth_column_order' );
add_filter( 'manage_edit-tourdiaryday_sortable_columns', 'dbth_sortable_columns' );
add_action( 'pre_get_posts', 'dbth_sort_order', 1 );

/**
 * GET FEATURED IMAGE
 *
 * @param int $post_id Post ID.
 * @todo Replace with codepress-admin-columns
 */
function dbth_get_featured_image( $post_id ) {
	$post_thumbnail_id = get_post_thumbnail_id( $post_id );
	if ( $post_thumbnail_id ) {
		$post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'admin_thumbnail' );
		return $post_thumbnail_img[0];
	}
}

/**
 * SHOW THE CONTENT
 * for 'day' posttype this would be: manage_day_posts_custom_column
 *
 * @param string $column_name Column name.
 * @param int    $post_id Post ID.
 * @todo Replace with codepress-admin-columns
 */
function dbth_columns_content( $column_name, $post_id ) {
	if ( 'featured_image_column' === $column_name ) {
		$post_featured_image = dbth_get_featured_image( $post_id );
		if ( $post_featured_image ) {
			echo '<img src="' . $post_featured_image . '" />';
		}
	} elseif ( 'day_column' === $column_name ) {
		$post = get_post( $post_id );
		// $post_day = get_the_slug($post_id);.
		// $post_day = $post->post_name;.
		$post_day = get_the_terms( $post, 'elapsedday' );
		if ( $post_day ) {
			echo str_replace( 'day-', '', $post_day );
		}
	} elseif ( 'location_column' === $column_name ) {
		$post_location = get_field( 'acf_location' );
		if ( $post_location ) {
			echo $post_location;
		}
	} elseif ( 'accommodation_column' === $column_name ) {
		$accommodation = get_field( 'acf_accommodation' );
		if ( $accommodation ) {
			echo $accommodation;
		}
	}
}

/**
 * ADD NEW COLUMNS & CHANGE COLUMN ORDER
 * for 'day' posttype this would be: manage_edit-day_columns
 *
 * @param array $columns Columns.
 * @see http://wordpress.stackexchange.com/a/116602
 * @todo Replace with codepress-admin-columns
 */
function dbth_column_order( $columns ) {
	// add your column key to the existing columns.
	$columns['featured_image_column'] = __( 'Thumb' );
	$columns['day_column']            = __( 'Day' );
	$columns['location_column']       = __( 'Location' );
	$columns['accommodation_column']  = __( 'Accommodation' );
	$columns['temperature_column']    = __( 'Temp' );

	/**
	 * Now define a new order. you need to look up the column
	 * names in the HTML of the admin interface HTML of the table header.
	 * "cb" is the "select all" checkbox.
	 * "title" is the title column.
	 * "date" is the date column.
	 */
	$custom__order = array( 'cb', 'day_column', 'date', 'title', 'location_column', 'featured_image_column', 'accommodation_column', 'temperature_column', 'categories', 'tags' );

	/**
	 * Return a new column array to WordPress.
	 * Order is the exactly like you set in $custom__order.
	 */
	foreach ( $custom__order as $colname ) {
		$new[ $colname ] = $columns[ $colname ];
	}

	return $new;
}

/**
 * For 'day' posttype this would be: manage_edit-day_sortable_columns
 *
 * @param array $sortable_columns Sortable columns.
 * @see http://wpdreamer.com/2014/04/how-to-make-your-wordpress-admin-columns-sortable/
 * @todo Replace with codepress-admin-columns
 */
function dbth_sortable_columns( $sortable_columns ) {
	$sortable_columns['day_column'] = 'post_name';

	// To make a column 'un-sortable' remove it from the array.
	// unset($columns['date']);.
	return $sortable_columns;
}

/**
 * Set sort order
 *
 * @param object $query Query.
 */
function dbth_sort_order( $query ) {
	/**
	 * We only want our code to run in the main WP query
	 * AND if an orderby query variable is designated.
	 *
	 * @see https://codex.wordpress.org/Custom_Queries#Display_Order_and_Post_Count_Limit
	 * @see https://css-tricks.com/snippets/wordpress/natural-sort/
	 */
	if ( $query->is_main_query() && ( $orderby === $query->get( 'orderby' ) ) ) {
		switch ( $orderby ) {
			case 'post_name':
				// //return "post_name+0 ASC";.
				$query->set( 'orderby', 'meta_value_num' ); // sort numerical - BUT only seems to work ASC.
				break;
		}
	}
}
