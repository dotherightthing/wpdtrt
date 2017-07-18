<?php
/**
 * Shortcodes
 * Simple content manipulation that doesn't justify a plugin
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Theme Functions
 * @since 0.1.0
 * @version 0.1.0
 */

/**
  * Tip shortcode
  * @see https://codex.wordpress.org/Shortcode_API#Enclosing_vs_self-closing_shortcodes
  */

if ( ! function_exists('wpdtrt_tip_shortcode') ) {

  function wpdtrt_tip_shortcode( $atts, $content = null ) {

    $html = '';
    $html .= '<div>'; // float/margins
    $html .= '<div class="tip_tourdiaryday">';
    $html .= '<h3 class="says">Tip</h3>';
    $html .= '<p>' . $content . '</p>';
    $html .= '</div>';
    $html .= '</div>';

    return $html;
  }

  add_shortcode( 'tip', 'wpdtrt_tip_shortcode' );
}
?>