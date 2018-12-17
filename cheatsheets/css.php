<?php
/**
 * CSS Stylesheets
 *
 * @package WPDTRT
 * @since 0.1.0
 */

namespace DoTheRightThing\WPDTRT\Cheatsheets;

/**
 * Add a 'no-js' class to the body element
 *
 * Replaced with hardcoded attribute on html element
 * so we don't need to wait for the body element to become available
 *
 * @param array $classes Classes.
 * @return array Classes
 * @link https://developer.wordpress.org/reference/functions/body_class/
 */
function wpdtrt_js_nojs( $classes ) {
	return array_merge( $classes, array( 'wpdtrt-nojs' ) );
}
