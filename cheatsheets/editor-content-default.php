<?php
/**
 * Editor - Content
 *
 * @package WPDTRT
 * @since 0.1.0
 */

namespace DoTheRightThing\WPDTRT\Cheatsheets;

/**
 * Add default content to the editor
 *
 * @param string $post_content Post content.
 * @uses http://www.wpbeginner.com/wp-tutorials/how-to-add-default-content-in-your-wordpress-post-editor/
 * @see https://developer.wordpress.org/reference/hooks/default_content/
 * @example
 * add_filter( 'default_content', 'wpdtrt_default_content' );
 */
function wpdtrt_default_content( $post_content ) {
	$post_content = 'TODO';
	return $post_content;
}
