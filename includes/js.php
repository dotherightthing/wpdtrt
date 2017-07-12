<?php
/**
 * JavaScript (JS)
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Theme Theme Functions
 * @since 0.1.0
 * @version 0.1.0
 */

/**
  * Load custom JavaScripts from the child theme
  * Get jQuery version: jQuery().jquery
  *
  * @link https://wordpress.org/support/topic/how-to-add-js-files-to-child-theme?replies=7
  */
add_action( 'wp_enqueue_scripts', 'wp_dtrt_fwt__js' );

function wp_dtrt_fwt__js() {

  /**
   * Link assets to theme version
   * to ensure user gets the latest version
   * @link https://wordpress.org/ideas/topic/add-theme-version-number-to-stylesheet-url-not-wp-version
   */
  $theme_version = wp_get_theme()->Version;

  /**
   * Attach scripts to bottom of the page
   * to prevent blocking behaviour
   * which affects PageSpeed
   * @link http://www.wpbeginner.com/wp-tutorials/how-to-move-javascripts-to-the-bottom-or-footer-in-wordpress/
   */
  $attach_to_footer = true;

  /**
   * Remove the default WordPress actions that allow any scripts in the document's head
   * As a result, they will naturally be forced to be enqueued in the footer.
   *
   * @link http://stackoverflow.com/a/21167716
   * @link https://www.linkedin.com/pulse/speed-boost-how-move-javascripts-footer-wordpress-john-engle
   */
  remove_action('wp_head', 'wp_print_scripts');
  remove_action('wp_head', 'wp_print_head_scripts', 9);
  remove_action('wp_head', 'wp_enqueue_scripts', 1);

  // scripts.js
  wp_register_script('wp_dtrt_fwt__js',
    get_template_directory_uri() . '/js/frontend.js',
    array('jquery'),
    $theme_version,
    $attach_to_footer
  );

  // make wp_dtrt_fwt__template_directory_uri available as a JS variable
  wp_localize_script( 'wp_dtrt_fwt__js', 'wp_dtrt_fwt__template_directory_uri', get_template_directory_uri() );
  //wp_add_inline_script('wp_dtrt_fwt__js', 'alert('test'));
  wp_enqueue_script('wp_dtrt_fwt__js');

  /**
   * Comment reply
   * @link https://make.wordpress.org/themes/handbook/review/required/
   */
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }

  add_action('wp_footer', 'wp_print_scripts', 5);
  add_action('wp_footer', 'wp_enqueue_scripts', 5);
  add_action('wp_footer', 'wp_print_head_scripts', 5);
}
?>