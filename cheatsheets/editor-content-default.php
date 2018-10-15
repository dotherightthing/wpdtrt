<?php
/**
 * Editor - Content
 *
 * @package WPDTRT
 * @subpackage DTRT Framework - Cheatsheets
 * @since 0.1.0
 * @version 0.1.0
 */

/**
 * Add default content to the editor
 * @uses http://www.wpbeginner.com/wp-tutorials/how-to-add-default-content-in-your-wordpress-post-editor/
 * @see https://developer.wordpress.org/reference/hooks/default_content/
 */

//add_filter( 'default_content', 'wpdtrt_default_content' );

function wpdtrt_default_content( $post_content ) {
  $post_content = "TODO";
  return $post_content;
}

?>