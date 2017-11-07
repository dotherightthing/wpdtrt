<?php
/**
 * JavaScript - jQuery
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Library
 * @since 0.1.0
 * @version 0.1.0
 */

/**
 * Remove render blocking jQuery scripts from header
 * @see https://www.oxhow.com/optimize-defer-javascript-wordpress/
 */
//add_action('wp_print_scripts', 'wpdtrt_js_jquery'); // separates scripts
add_action('template_redirect', 'wpdtrt_js_jquery'); // prints scripts together

function wpdtrt_js_jquery() {

  $site_url = get_site_url();

  /**
   * Attach scripts to bottom of the page
   * to prevent blocking behaviour
   * which affects PageSpeed
   * @link http://www.wpbeginner.com/wp-tutorials/how-to-move-javascripts-to-the-bottom-or-footer-in-wordpress/
   */
  $attach_to_footer = true;

  if ( is_admin() ) {
    return;
  }

  wp_deregister_script('jquery');
  wp_deregister_script('jquery-migrate');

  wp_register_script(
    'jquery',
    $site_url . '/wp-includes/js/jquery/jquery.js',
    false,
    '1.12.4',
    $attach_to_footer
  );

  wp_register_script(
    'jquery-migrate',
    $site_url . '/wp-includes/js/jquery/jquery-migrate.js',
    array('jquery'),
    '1.4.1',
    $attach_to_footer
  );

  wp_enqueue_script('jquery');
  wp_enqueue_script('jquery-migrate');
}

?>