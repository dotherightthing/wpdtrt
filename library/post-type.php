<?php
/**
 * Post Type
 *
 * @package WPDTRT
 * @subpackage WPDTRT - Library
 * @since 0.1.0
 * @version 0.1.0
 */

/**
 * Test the current post type in a template
 *
 * @param string $post_type string The post type (slug).
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
