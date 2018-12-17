<?php
/**
 * Comments
 *
 * @package WPDTRT
 * @since 0.1.0
 */

add_filter( 'comment_form_defaults', 'wpdtrt_dbth_comment_form_defaults' );

/**
 * Change form title
 *
 * @param  array $defaults The default comment form arguments.
 * @return array The filtered default comment form arguments
 */
function wpdtrt_dbth_comment_form_defaults( $defaults ) {
	$defaults['title_reply'] = __( 'Leave a comment' );

	return $defaults;
}
