<?php
/**
 * JavaScript - CSS hook
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Library
 * @since 0.1.0
 * @version 0.1.0
 */

add_action( 'wp_enqueue_scripts', 'wpdtrt_js_css' );

function wpdtrt_js_css() {

  // attach to <head>
  $header = 'wpdtrt_header';

  // add wpdtrt-js hook immediately
  // (without waiting for jQuery to load)
  wp_add_inline_script( $header, "
    (function() {
      var html = document.documentElement;
      var class_old = html.getAttribute('class');
      var class_new = class_old.replace('wpdtrt-nojs', 'wpdtrt-js');
      html.setAttribute('class', class_new);
    })();
  " );

}
?>