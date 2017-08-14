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
   * wp_localize_script makes PHP variables available to the JS
   * @todo is wp_localize_script required here or only in child theme?
   */
  wp_register_script( $header,
    get_template_directory_uri() . '/js/' . $header . '.min.js',
    array(),
    $theme_version,
    false
  );

  wp_enqueue_script( $header );
}

?>