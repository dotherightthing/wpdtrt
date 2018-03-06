<?php
/**
 * Image - Admin Fields
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Library
 * @since 0.1.0
 * @version 0.1.0
 */

/**
* Add new fields to media items
* @see http://www.billerickson.net/wordpress-add-custom-fields-media-gallery/
* @todo create a helper function, move into a plugin
* @todo Use ACF field groups
*/

/**
 * Convert Degrees Minutes Seconds String To Number
 * @param string $string The String
 * @return number $number The number
 */
function dms_to_number( $string ) {

  $number = 0;

  $pos = strpos($string, '/');

  if ($pos !== false) {
    $temp = explode('/', $string);
    $number = $temp[0] / $temp[1];
  }

  return $number;
}

/**
 * Convert Degrees Minutes Seconds to Decimal Degrees
 * @param string $reference_direction (n/s/e/w)
 * @param string $degrees Degrees
 * @param string $minutes Minutes
 * @param string $seconds Seconds
 * @return string $decimal The decimal value
 */
function gps_dms_to_decimal( $reference_direction, $degrees, $minutes, $seconds ) {

  // http://stackoverflow.com/a/32611358
  // http://stackoverflow.com/a/19420991
  // https://www.mail-archive.com/pkg-perl-maintainers@lists.launchpad.net/msg02335.html

  $degrees = dms_to_number( $degrees );
  $minutes = dms_to_number( $minutes );
  $seconds = dms_to_number( $seconds );

  $decimal = ( $degrees + ( $minutes / 60 ) + ( $seconds / 3600 ) );

  //If the latitude is South, or the longitude is West, make it negative.
  if ( ( $reference_direction === 'S' ) || ( $reference_direction === 'W' ) ) {
    $decimal *= -1;
  }

  return $decimal;
}

/**
 * Add GPS field to media uploader, for GPS dependent functions (map, weather)
 * Writing the EXIF back to the image is a hassle, so we can query the GPS in the future, instead.
 *
 * @param $form_fields array, fields to include in attachment form
 * @param $post object, attachment record in database
 * @return $form_fields, modified form fields
 * @see https://codex.wordpress.org/Function_Reference/get_attached_file
 * @see attachment.php
 */
function dtrt_attachment_field_gps( $form_fields, $post ) {

  $file = get_attached_file( $post->ID );
  $exif = @exif_read_data( $file );
  $meta = array();

  if ( !empty( $exif['GPSLatitude'] ) && isset( $exif['GPSLatitudeRef'] ) ) {
    $meta['latitude'] = gps_dms_to_decimal( $exif['GPSLatitudeRef'], $exif["GPSLatitude"][0], $exif["GPSLatitude"][1], $exif["GPSLatitude"][2] );
  }

  if ( !empty( $exif['GPSLongitude'] ) && isset( $exif['GPSLongitudeRef'] ) ) {
    $meta['longitude'] = gps_dms_to_decimal( $exif['GPSLongitudeRef'], $exif["GPSLongitude"][0], $exif["GPSLongitude"][1], $exif["GPSLongitude"][2] );
  }

  // if the values can be pulled from the image
  if ( isset( $meta['latitude'], $meta['longitude'] ) ) {
    // then display these values to content admins
    $value = ( $meta['latitude'] . ',' . $meta['longitude'] ); // working
  }
  // else try to pull these values from the user field
  else {
    $value = get_post_meta( $post->ID, 'dtrt_gps', true ); // working
  }

  $form_fields['dtrt-gps'] = array(
    'label' => 'GPS',
    'input' => 'text',
    'value' => $value,
    'helps' => 'Latitide,Longitude (WPDTRT)',
  );

  return $form_fields;
}

add_filter( 'attachment_fields_to_edit', 'dtrt_attachment_field_gps', 10, 2 );

/**
 * Save value of Location field in media uploader, for GPS dependent functions (map, weather)
 *
 * @param $post array, the post data for database
 * @param $attachment array, attachment fields from $_POST form
 * @return $post array, modified post data
 */

function dtrt_attachment_field_gps_save( $post, $attachment ) {

  if ( isset( $attachment['dtrt-gps'] ) ) {
    update_post_meta( $post['ID'], 'dtrt_gps', $attachment['dtrt-gps'] ); // working
  }

  return $post;
}

add_filter( 'attachment_fields_to_save', 'dtrt_attachment_field_gps_save', 10, 2 );

?>