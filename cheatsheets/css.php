<?php
/**
 * CSS Stylesheets
 *
 * @package WPDTRT
 * @subpackage DTRT Framework - Cheatsheets
 * @since 0.1.0
 * @version 0.1.0
 */

/**
 * Add a 'no-js' class to the body element
 * @link https://developer.wordpress.org/reference/functions/body_class/
 * Replaced with hardcoded attribute on html element
 * so we don't need to wait for the body element to become available
 */
add_filter( 'body_class', 'wpdtrt_js_nojs' );

function wpdtrt_js_nojs($classes) {
  return array_merge( $classes, array( 'wpdtrt-nojs' ) );
}