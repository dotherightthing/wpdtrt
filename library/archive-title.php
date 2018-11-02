<?php
/**
 * Archive - Title
 *
 * @package WPDTRT
 * @since 0.1.0
 */

/**
 * Remove “Category:”, “Tag:”, “Author:” from the_archive_title (disabled)
 *
 * @param  string $title Title.
 * @return string $title
 * @see http://wordpress.stackexchange.com/questions/179585/remove-category-tag-author-from-the-archive-title
 * @example add_filter( 'get_the_archive_title', 'wpdtrt_remove_archive_from_archive_title' );
 */
function wpdtrt_remove_archive_from_archive_title( $title ) {

	if ( is_category() ) {
		// Category_name.
		$title = single_cat_title( '', false );

	} elseif ( is_tag() ) {
		// Category_name/Tag_name.
		$category = get_the_category();
		$title    = single_tag_title( $category[0]->name . '/', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	}

	return $title;
}
