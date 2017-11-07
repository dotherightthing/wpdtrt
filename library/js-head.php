<?php
/**
 * JavaScript - <head>
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Library
 * @since 0.1.0
 * @version 0.1.0
 */

add_action( 'wp_enqueue_scripts', 'wpdtrt_js_head', 0 );

function wpdtrt_js_head() {

  /**
   * Link assets to theme version to ensure user gets the latest version
   * @see https://wordpress.org/ideas/topic/add-theme-version-number-to-stylesheet-url-not-wp-version
   */
  $theme_version = wp_get_theme()->Version;

  $header = 'wpdtrt_header';

  /**
   * Head scripts (head of page)
   * - links an (empty) script file to the head of the pages
   * - this gives us a placeholder to attach inline scripts to
   *   via wp_add_inline_script(), rather than hacking wp_head
   * - the Autoptimize plugin then moves the script file to the bottom of the page,
   *   leaving the associated inline code in the head where we want it.
   */
  wp_register_script( $header,
    get_template_directory_uri() . '/js/' . $header . '.js',
    array(),
    $theme_version,
    false
  );

  wp_enqueue_script( $header );
}

?>