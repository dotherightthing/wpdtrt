<?php
/**
 * JavaScript
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Cheatsheets
 * @since 0.1.0
 * @version 0.1.0
 */

/**
 * Deregister only those scripts which are incorrectly output into the head.
 * Then reregister these to load into the footer.
 * This leaves wp_head load actions intact for scripts that we deem worthy (such as GTM).
 * @see http://justintadlock.com/archives/2009/08/06/how-to-disable-scripts-and-styles
 */
//add_action( 'wp_print_scripts', 'wpdtrt_deregister_head_js', 100 );

function wpdtrt_deregister_head_js() {

  //wp_deregister_script( 'plugin-name' );
  /*
  wp_register_script( 'plugin-name',
    get_template_directory_uri() . '/js/' . $header . '.min.js',
    array(),
    $theme_version,
    false
  );
  */
}

/**
  * Move blocking JavaScript from <head> to bottom of <body>
  *   Removed as not required when Autoptimize is used
  * @param string $script_hook
  * @example wpdtrt_dbth_remove_blocking_js( 'twentysixteen_javascript_detection' );
  */
//add_action( 'after_setup_theme', 'wpdtrt_move_blocking_js' );

function wpdtrt_move_blocking_js( $script_hook ) {
  remove_action('wp_head', $script_hook, 0);
  add_action('wp_footer', $script_hook, 0);
}

/**
 * Remove the default WordPress actions that allow any scripts in the document's head
 * As a result, they will naturally be forced to be enqueued in the footer.
 *
 * @link http://stackoverflow.com/a/21167716
 * @link https://www.linkedin.com/pulse/speed-boost-how-move-javascripts-footer-wordpress-john-engle
 * @todo 2 & 3 prevent output of $header into the <head>.
 *  Removing all 3 results in some plugin scripts appearing in <head>.
 *  Could an alternate custom wp_head be set up for this type of usage?
 */
add_action( 'wp_enqueue_scripts', 'wpdtrt_js_all_to_footer' );

function wpdtrt_js_all_to_footer() {
  //remove_action('wp_head', 'wp_print_scripts');
  //remove_action('wp_head', 'wp_print_head_scripts', 9);
  //remove_action('wp_head', 'wp_enqueue_scripts', 1);
  //add_action('wp_footer', 'wp_print_scripts', 5);
  //add_action('wp_footer', 'wp_enqueue_scripts', 5);
  //add_action('wp_footer', 'wp_print_head_scripts', 5);
}

/**
 * Comment reply
 * Only include a script when it is required in-page
 * @link https://make.wordpress.org/themes/handbook/review/required/
 */
add_action( 'wp_enqueue_scripts', 'wpdtrt_js_comments' );

function wpdtrt_js_comments() {
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}

?>