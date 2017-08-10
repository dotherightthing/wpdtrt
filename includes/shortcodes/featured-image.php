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
  * Featured image shortcode
  */

if ( ! function_exists('wpdtrt_featured_image_shortcode') ) {

  function wpdtrt_featured_image_shortcode( $atts ) {

    $id = get_the_ID(); // Retrieve the ID of the current item in the WordPress Loop.
    $src = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $atts['size'], true );

    // http://stackoverflow.com/questions/19267650/get-wordpress-featured-image-alt
    $thumbnail_id = get_post_thumbnail_id( $id );

    $alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true);

    //$caption = get_post( $thumbnail_id )->post_excerpt;
    //$image_title = $attachment->post_title;
    //$caption = $attachment->post_excerpt;
    //$description = $image->post_content;

    $html = '';

    if ( $atts['display'] === 'background' ) {

      $html .= $src[0];

    }
    else if ( $atts['display'] === 'inline' ) {

      $html .= '<div class="wpdtrt-featured-image">';
      $html .= '<img src="' . $src[0] . '" alt="' . $alt . '" />';
      $html .= '</div>';

    }

    return $html;
  }

  add_shortcode( 'wpdtrt-featured-image', 'wpdtrt_featured_image_shortcode' );
}
?>