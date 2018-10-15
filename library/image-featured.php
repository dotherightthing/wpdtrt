<?php
/**
 * Image - Featured
 *
 * @package WPDTRT
 * @subpackage WPDTRT - Library
 * @since 0.1.0
 * @version 0.3.0
 */

add_shortcode( 'wpdtrt-featured-image', 'wpdtrt_image_featured_shortcode' );

/**
 * Featured image shortcode
 *
 * @param  array $atts Attributes.
 * @return string HTML
 */
function wpdtrt_image_featured_shortcode( $atts ) {
	$id  = get_the_ID(); // Retrieve the ID of the current item in the WordPress Loop.
	$src = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $atts['size'], true );

	// http://stackoverflow.com/questions/19267650/get-wordpress-featured-image-alt.
	$thumbnail_id = get_post_thumbnail_id( $id );
	$alt          = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );

	// Note: Hands Of Light ACF field of type "Page Link".
	$wpdtrt_featured_image_link = get_field( 'wpdtrt_featured_image_link' );

	// $caption = get_post( $thumbnail_id )->post_excerpt;.
	// $image_title = $attachment->post_title;.
	// $caption = $attachment->post_excerpt;.
	// $description = $image->post_content;.
	$html = '';

	if ( strpos( $src[0], 'default.png' ) ) {
		return $html;
	}

	if ( 'background' === $atts['display'] ) {
		$html .= $src[0];
	} elseif ( 'inline' === $atts['display'] ) {
		$html .= '<div class="wpdtrt-featured-image">';

		if ( $wpdtrt_featured_image_link ) :
			$html .= '<a href="' . $wpdtrt_featured_image_link . '">';
		endif;

		$html .= '<img src="' . $src[0] . '" alt="' . $alt . '" />';

		if ( $wpdtrt_featured_image_link ) :
			$html .= '</a>';
		endif;

		$html .= '</div>';
	}

	return $html;
}
