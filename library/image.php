<?php
/**
 * Image
 *
 * @package WPDTRT
 * @subpackage WPDTRT - Library
 * @since 0.1.0
 * @version 0.1.0
 */

/**
 * Increase the maxiumum file upload size
 *
 * @see http://www.wpbeginner.com/wp-tutorials/how-to-increase-the-maximum-file-upload-size-in-wordpress/
 * @see https://www.elegantthemes.com/blog/tips-tricks/is-the-wordpress-upload-limit-giving-you-trouble-heres-how-to-change-it
 */

/*
@ini_set( 'memory_limit' , '64M' );
@ini_set( 'upload_max_filesize' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );
*/

/**
 * Get a reference to the gallery which an attachment belongs to.
 * Used on an image attachment page to show the source gallery.
 *
 * @param string $post_id The ID of the parent post.
 * @example echo dbth_get_attachment_gallery($parent_id);
 * @return object $attachment_gallery
 */
function wpdtrt_get_attachment_gallery( $post_id = null ) {

	if ( ! $post_id ) {
		return;
	}

	$attachment_url     = get_the_permalink();
	$parent_galleries   = get_post_galleries( $post_id );
	$attachment_gallery = '';

	// loop through all galleries on the parent page.
	foreach ( $parent_galleries as $gallery ) {
		// if a gallery contains the attachment URL of this image attachment.
		if ( strpos( $gallery, $attachment_url ) ) {
			// it's that gallery.
			$attachment_gallery = $gallery;
		}
	}

	// TODO: add [data-viewing="true"].
	return $attachment_gallery;
}
