<?php
/**
 * JavaScript - <body>
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Library
 * @since 0.1.0
 * @version 0.1.0
 */

/**
  * Load custom JavaScripts from the child theme
  * Get jQuery version: jQuery().jquery
  *
  * @link https://wordpress.org/support/topic/how-to-add-js-files-to-child-theme?replies=7
  */
add_action( 'wp_enqueue_scripts', 'wpdtrt_js_body' );

function wpdtrt_js_body() {

  /**
   * Link assets to theme version to ensure user gets the latest version
   * @see https://wordpress.org/ideas/topic/add-theme-version-number-to-stylesheet-url-not-wp-version
   */
  $theme_version = wp_get_theme()->Version;

  $footer = 'wpdtrt_footer';

  /**
   * Attach scripts to bottom of the page
   * to prevent blocking behaviour
   * which affects PageSpeed
   * @link http://www.wpbeginner.com/wp-tutorials/how-to-move-javascripts-to-the-bottom-or-footer-in-wordpress/
   */
  $attach_to_footer = true;

  /**
   * Body scripts (foot of body)
   * wp_localize_script makes PHP variables available to the JS
   * @todo is wp_localize_script required here or only in child theme?
   */
  wp_register_script( $footer,
    get_template_directory_uri() . '/js/' . $footer . '.js',
    array('jquery'),
    $theme_version,
    $attach_to_footer
  );

  wp_enqueue_script( $footer );

  wp_localize_script(
    $footer,
    'wpdtrt_template_directory_uri',
    get_template_directory_uri()
  );
}

?>