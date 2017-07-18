<?php

/**
* Increase the maxiumum file upload size
* @see http://www.wpbeginner.com/wp-tutorials/how-to-increase-the-maximum-file-upload-size-in-wordpress/
* @see https://www.elegantthemes.com/blog/tips-tricks/is-the-wordpress-upload-limit-giving-you-trouble-heres-how-to-change-it
*/
/*
@ini_set( 'memory_limit' , '64M' );
@ini_set( 'upload_max_filesize' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );
*/

/**
 * Add Geolocation EXIF to the attachment metadata stored in the WP database
 * Added false values to prevent this function running over and over
 * if the image was taken with a non-geotagging camera
 * @uses http://kristarella.blog/2009/04/add-image-exif-metadata-to-wordpress/
 */
include_once( ABSPATH . 'wp-admin/includes/image.php' ); // for access to wp_read_image_metadata

if ( ! function_exists('wpdtrt_add_geolocation_exif_to_attachment_metadata') ) {

  add_filter('wp_read_image_metadata', 'wpdtrt_add_geolocation_exif_to_attachment_metadata','',3);

  function wpdtrt_add_geolocation_exif_to_attachment_metadata( $meta, $file, $sourceImageType ) {

    $exif = @exif_read_data( $file );

    if (!empty($exif['GPSLatitude'])) {
      $meta['latitude'] = $exif['GPSLatitude'] ;
    }
    else {
      $meta['latitude'] = false;
    }

    if (!empty($exif['GPSLatitudeRef'])) {
      $meta['latitude_ref'] = trim( $exif['GPSLatitudeRef'] );
    }
    else {
      $meta['latitude_ref'] = false;
    }

    if (!empty($exif['GPSLongitude'])) {
      $meta['longitude'] = $exif['GPSLongitude'] ;
    }
    else {
      $meta['longitude'] = false;
    }

    if (!empty($exif['GPSLongitudeRef'])) {
      $meta['longitude_ref'] = trim( $exif['GPSLongitudeRef'] );
    }
    else {
      $meta['longitude_ref'] = false;
    }

    return $meta;
  }

}

/**
  * Generate the full decimal latitude and longitude for Google
  * Naming convention follows /wp-admin/includes/image.php
  * @uses http://kristarella.blog/2008/12/geo-exif-data-in-wordpress/
  */

function geo_single_fracs2dec($fracs) {
  return wp_exif_frac2dec($fracs[0]) +
      wp_exif_frac2dec($fracs[1]) / 60 +
      wp_exif_frac2dec($fracs[2]) / 3600;
}

/**
  * Get Latitude and Longitude from stored attachment metadata
  * @param $id
  * @param $format
  * @returns array ($lat, $lng)
  * @uses http://kristarella.blog/2008/12/geo-exif-data-in-wordpress/
  */

// reinstate attachment metadata accidentally deleted during development:
// ini_set('max_execution_time', 300); //300 seconds = 5 minutes

function wpdtrt_get_attachment_geodata($id, $format) {

  $lat_out = '';
  $lng_out = '';

  // reinstate attachment metadata accidentally deleted during development:
  // $attach_data = wp_generate_attachment_metadata( $id, get_attached_file( $id ) );
  // wp_update_attachment_metadata( $id, $attach_data );

  //PC::debug('1. attachment_metadata');
  $attachment_metadata = wp_get_attachment_metadata( $id, false );
  //PC::debug($attachment_metadata);

  if ( !array_key_exists('latitude', $attachment_metadata) || !array_key_exists('longitude', $attachment_metadata) ) {
    $file = get_attached_file( $id ); // full path

    //PC::debug('2. image_metadata');
    $image_metadata = wp_read_image_metadata( $file ); // extract geolocation data
    //PC::debug($image_metadata);

    //PC::debug('3. merge to update');
    $attachment_metadata_updated = $attachment_metadata;
    $attachment_metadata_updated['image_meta'] = $image_metadata;
    //PC::debug($attachment_metadata_updated);

    //PC::debug('3. wp_update_attachment_metadata');
    wp_update_attachment_metadata($id, $attachment_metadata_updated);

    //PC::debug('4. attachment_metadata');
    $attachment_metadata = wp_get_attachment_metadata( $id, false ); // try again
    //PC::debug($attachment_metadata);
  }

  $latitude = $attachment_metadata['image_meta']['latitude'];
  $longitude = $attachment_metadata['image_meta']['longitude'];
  $lat_ref = $attachment_metadata['image_meta']['latitude_ref'];
  $lng_ref = $attachment_metadata['image_meta']['longitude_ref'];

  $lat = geo_single_fracs2dec($latitude);
  $lng = geo_single_fracs2dec($longitude);

  if ($lat_ref == 'S') {
    $neg_lat = '-';
  }
  else {
    $neg_lat = '';
  }

  if ($lng_ref == 'W') {
    $neg_lng = '-';
  }
  else {
    $neg_lng = '';
  }

  if ($latitude != 0 && $longitude != 0) {
    // full decimal latitude and longitude for Google
    if ( $format === 'number' ) {
      $lat_out = ( $neg_lat . number_format($lat,6) );
      $lng_out = ( $neg_lng . number_format($lng, 6) );
    }
    // text based latitude and longitude for Alternative text
    else if ( $format === 'text' ) {
      $lat_out = ( geo_pretty_fracs2dec($latitude). $lat_ref );
      $lng_out = ( geo_pretty_fracs2dec($longitude) . $lng_ref );
    }
  }

  return array($lat_out, $lng_out);
}

/**
 * Get a reference to the gallery which an attachment belongs to.
 * Used on an image attachment page to show the source gallery.
 *
 * @param string $post_id The ID of the parent post
 * @example echo dbth_get_attachment_gallery($parent_id);
 */

function wpdtrt_get_attachment_gallery( $post_id = NULL ) {

  if ( ! $post_id ) {
    return;
  }

  $attachment_url = get_the_permalink();
  $parent_galleries = get_post_galleries( $post_id );
  $attachment_gallery = '';

  // loop through all galleries on the parent page
  foreach ($parent_galleries as $gallery) {
    // if a gallery contains the attachment URL of this image attachment
    if ( strpos($gallery, $attachment_url) ) {
      // it's that gallery
      $attachment_gallery = $gallery;
    }
  }

  // TODO: add [data-viewing="true"]
  return $attachment_gallery;
}

/**
  * @param $attachment_url
  * @returns $attachment_id
  * @uses https://philipnewcomer.net/2012/11/get-the-attachment-id-from-an-image-url-in-wordpress/
  */
function wpdtrt_get_attachment_id_from_url( $attachment_url = '' ) { // redundant?

  global $wpdb;
  $attachment_id = false;

  // If there is no url, return.
  if ( '' == $attachment_url )
    return;

  // Get the upload directory paths
  $upload_dir_paths = wp_upload_dir();

  // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
  if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

    // If this is the URL of an auto-generated thumbnail, get the URL of the original image
    $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

    // Remove the upload path base directory from the attachment URL
    $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

    // Finally, run a custom database query to get the attachment ID from the modified attachment URL
    $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

  }

  return $attachment_id;
}

/**
 * Filters the image quality for thumbnails to be at the highest ratio possible.
 *
 * Supports the new 'wp_editor_set_quality' filter added in WP 3.5.
 *
 * @since 1.0.0
 *
 * @param int $quality  The default quality (90).
 * @return int $quality Amended quality (100).
 * source: https://thomasgriffin.io/how-to-change-the-quality-of-wordpress-thumbnails/
 */
add_filter( 'jpeg_quality', 'wpdtrt_image_full_quality' );
add_filter( 'wp_editor_set_quality', 'wpdtrt_image_full_quality' );

function wpdtrt_image_full_quality( $quality ) {
  return 100;
}

/**
* Add attributes to gallery thumbnail links
* These are transformed to data attributes by the UI JS
*
* @param $html
* @param $id
* @param $size
* @param $permalink
* @return string
* @todo Update to query all fields in an ACF fieldgroup
*/
function wpdtrt_thumbnail_queryparams($html, $id, $size, $permalink) {

  if ( false !== $permalink ) {
    return $html;
  }

  $link_options = array();

  // Vimeo

  $vimeo_pageid = get_post_meta( $id, 'dtrt_vimeo_pageid', true ); // used for embed

  if ( $vimeo_pageid ) {
    $link_options['vimeo_pageid'] = $vimeo_pageid;
  }

  // SoundCloud

  $soundcloud_pageid = get_post_meta( $id, 'dtrt_soundcloud_pageid', true ); // used for SEO
  $soundcloud_trackid = get_post_meta( $id, 'dtrt_soundcloud_trackid', true ); // used for embed, see also http://stackoverflow.com/a/28182284

  if ( $soundcloud_pageid && $soundcloud_trackid ) {
    $link_options['soundcloud_pageid'] = urlencode( $soundcloud_pageid );
    $link_options['soundcloud_trackid'] = $soundcloud_trackid;
  }

  // Ride With GPS

  $rwgps_pageid = get_post_meta( $id, 'dtrt_rwgps_pageid', true );

  if ( $rwgps_pageid ) {
    $link_options['rwgps_pageid'] = urlencode( $rwgps_pageid );
  }

  // Position Y

  $position_y = get_post_meta( $id, 'dtrt_position_y', true );
  $position_y_default = "50";

  if ( $position_y !== '' ) {
    $link_options['position_y'] = $position_y;
  }
  else {
    $link_options['position_y'] = $position_y_default;
  }

  // Select onload

  $select_onload = get_post_meta( $id, 'dtrt_select_onload', true );

  if ( $select_onload === "1" ) {
    $link_options['select_onload'] = $select_onload;
  }

  // Panorama

  $panorama = get_post_meta( $id, 'dtrt_panorama', true ); // used for JS dragging

  if ( $panorama ) {
    $link_options['panorama'] = $panorama;
  }

  // Geolocation
  $geo_exif = wpdtrt_get_attachment_geodata($id, 'number');

  $link_options['latitude'] = $geo_exif[0];
  $link_options['longitude'] = $geo_exif[1];

  // Filter the gallery thumbnail links to link to the 'large' image size and not the 'full' image size.
  // [and update the link to include the options ?? ]
  // Src: http://johnciacia.com/2012/12/31/filter-wordpress-gallery-image-link/
  // list() is used to assign a list of variables in one operation.

  // @todo the 'full' images are massive!
  // need to resize these proportional to a max height of 350px
  // @see https://wordpress.stackexchange.com/questions/212768/add-image-size-where-largest-possible-proportional-size-is-generated
  $image_size = $panorama ? 'full' : 'large';

  list( $link, , ) = wp_get_attachment_image_src( $id, $image_size );

  // Encode options
  // http://stackoverflow.com/a/39370906

  $query = http_build_query($link_options, '', '&amp;');
  $link .= '?' . $query;

  // Update gallery link
  return preg_replace( "/href='([^']+)'/", "href='$link'", $html );
}

add_filter( 'wp_get_attachment_link', 'wpdtrt_thumbnail_queryparams', 1, 4 );

?>