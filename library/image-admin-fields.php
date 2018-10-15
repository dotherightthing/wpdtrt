<?php
/**
 * Image - Admin Fields
 *
 * @package WPDTRT
 * @subpackage WPDTRT - Library
 * @since 0.1.0
 * @version 0.1.0
 */

/**
 * Add new fields to media items
 *
 * @see http://www.billerickson.net/wordpress-add-custom-fields-media-gallery/
 * @todo create a helper function, move into a plugin
 * @todo Use ACF field groups
 */

/**
 * Convert Degrees Minutes Seconds String To Number
 *
 * @param string $string String.
 * @return number $number Number
 */
function dms_to_number( $string ) {
	$number = 0;
	$pos    = strpos( $string, '/' );

	if ( false !== $pos ) {
		$temp   = explode( '/', $string );
		$number = $temp[0] / $temp[1];
	}

	return $number;
}

/**
 * Convert Degrees Minutes Seconds to Decimal Degrees
 *
 * @param string $reference_direction (n/s/e/w).
 * @param string $degrees Degrees.
 * @param string $minutes Minutes.
 * @param string $seconds Seconds.
 * @return string $decimal The decimal value
 */
function gps_dms_to_decimal( $reference_direction, $degrees, $minutes, $seconds ) {

	// http://stackoverflow.com/a/32611358.
	// http://stackoverflow.com/a/19420991.
	// https://www.mail-archive.com/pkg-perl-maintainers@lists.launchpad.net/msg02335.html.
	$degrees = dms_to_number( $degrees );
	$minutes = dms_to_number( $minutes );
	$seconds = dms_to_number( $seconds );
	$decimal = ( $degrees + ( $minutes / 60 ) + ( $seconds / 3600 ) );

	// If the latitude is South, or the longitude is West, make it negative.
	if ( ( 'S' === $reference_direction ) || ( 'W' === $reference_direction ) ) {
		$decimal *= -1;
	}

	return $decimal;
}
