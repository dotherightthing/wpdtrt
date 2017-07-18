<?php
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