<?php
/**
 * Shortcodes
 * Simple content manipulation that doesn't justify a plugin
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Theme Theme Functions
 * @since 0.1.0
 * @version 0.1.0
 */

/**
  * Register a shortcode
  *
  * @see https://codex.wordpress.org/Shortcode_API#Enclosing_vs_self-closing_shortcodes
  */
if ( ! function_exists('tip_shortcode') ) {

  function div_shortcode( $atts, $content = null ) {

    $html = '';
    $html .= '<div class="div">';
    $html .= '<p>' . $content . '</p>';
    $html .= '</div>';

    return $html;
  }

  //add_shortcode( 'div', 'div_shortcode' );
}

?>