<?php

/**
* Add new fields to media items
* @see http://www.billerickson.net/wordpress-add-custom-fields-media-gallery/
* @todo create a helper function, move into a plugin
* @todo Use ACF field groups
*/

/**
 * Add Location field to media uploader, for gallery searches
 *
 * @param $form_fields array, fields to include in attachment form
 * @param $post object, attachment record in database
 * @return $form_fields, modified form fields
 */

function dtrt_attachment_field_location( $form_fields, $post ) {
  $form_fields['dtrt-location'] = array(
    'label' => 'Location',
    'input' => 'text',
    'value' => get_post_meta( $post->ID, 'dtrt_location', true ),
    //'helps' => '50% __%',
  );

  return $form_fields;
}

add_filter( 'attachment_fields_to_edit', 'dtrt_attachment_field_location', 10, 2 );

/**
 * Save value of Location field in media uploader, for gallery-viewer
 *
 * @param $post array, the post data for database
 * @param $attachment array, attachment fields from $_POST form
 * @return $post array, modified post data
 */

function dtrt_attachment_field_location_save( $post, $attachment ) {
  if ( isset( $attachment['dtrt-location'] ) ) {
    update_post_meta( $post['ID'], 'dtrt_location', $attachment['dtrt-location'] );
  }

  return $post;
}

add_filter( 'attachment_fields_to_save', 'dtrt_attachment_field_location_save', 10, 2 );

/**
 * Add Position-Y field to media uploader, for gallery-viewer
 *
 * @param $form_fields array, fields to include in attachment form
 * @param $post object, attachment record in database
 * @return $form_fields, modified form fields
 */

function dtrt_attachment_field_position_y( $form_fields, $post ) {
  $form_fields['dtrt-position-y'] = array(
    'label' => 'Position Y',
    'input' => 'text',
    'value' => get_post_meta( $post->ID, 'dtrt_position_y', true ),
    'helps' => '0% __%',
  );

  return $form_fields;
}

add_filter( 'attachment_fields_to_edit', 'dtrt_attachment_field_position_y', 10, 2 );

/**
 * Save value of Position-Y field in media uploader, for gallery-viewer
 *
 * @param $post array, the post data for database
 * @param $attachment array, attachment fields from $_POST form
 * @return $post array, modified post data
 */

function dtrt_attachment_field_position_y_save( $post, $attachment ) {
  if ( isset( $attachment['dtrt-position-y'] ) ) {
    update_post_meta( $post['ID'], 'dtrt_position_y', $attachment['dtrt-position-y'] );
  }

  return $post;
}

add_filter( 'attachment_fields_to_save', 'dtrt_attachment_field_position_y_save', 10, 2 );


/**
 * Add SoundCloud field to media uploader, for gallery-viewer
 *
 * @param $form_fields array, fields to include in attachment form
 * @param $post object, attachment record in database
 * @return $form_fields, modified form fields
 */

function dtrt_attachment_field_soundcloud_pageid( $form_fields, $post ) {
  $form_fields['dtrt-soundcloud-pageid'] = array(
    'label' => '<abbr title="SoundCloud">SC</abbr> Page ID',
    'input' => 'text',
    'value' => get_post_meta( $post->ID, 'dtrt_soundcloud_pageid', true ),
    'helps' => '//soundcloud.com/dontbelievethehypenz/_________',
  );

  return $form_fields;
}

add_filter( 'attachment_fields_to_edit', 'dtrt_attachment_field_soundcloud_pageid', 10, 2 );

/**
 * Save value of SoundCloud field in media uploader, for gallery-viewer
 *
 * @param $post array, the post data for database
 * @param $attachment array, attachment fields from $_POST form
 * @return $post array, modified post data
 */

function dtrt_attachment_field_soundcloud_pageid_save( $post, $attachment ) {
  if ( isset( $attachment['dtrt-soundcloud-pageid'] ) ) {
    update_post_meta( $post['ID'], 'dtrt_soundcloud_pageid', $attachment['dtrt-soundcloud-pageid'] );
  }

  return $post;
}

add_filter( 'attachment_fields_to_save', 'dtrt_attachment_field_soundcloud_pageid_save', 10, 2 );

/**
 * Add Ride With GPS field to media uploader, for gallery-viewer
 *
 * @param $form_fields array, fields to include in attachment form
 * @param $post object, attachment record in database
 * @return $form_fields, modified form fields
 */

function dtrt_attachment_field_rwgps_pageid( $form_fields, $post ) {
  $form_fields['dtrt-rwgps-pageid'] = array(
    'label' => 'Ride With GPS Route ID',
    'input' => 'text',
    'value' => get_post_meta( $post->ID, 'dtrt_rwgps_pageid', true ),
    'helps' => 'https://ridewithgps.com/routes/_________',
  );

  return $form_fields;
}

add_filter( 'attachment_fields_to_edit', 'dtrt_attachment_field_rwgps_pageid', 10, 2 );

/**
 * Save value of Ride With GPS field in media uploader, for gallery-viewer
 *
 * @param $post array, the post data for database
 * @param $attachment array, attachment fields from $_POST form
 * @return $post array, modified post data
 */

function dtrt_attachment_field_rwgps_pageid_save( $post, $attachment ) {
  if ( isset( $attachment['dtrt-rwgps-pageid'] ) ) {
    update_post_meta( $post['ID'], 'dtrt_rwgps_pageid', $attachment['dtrt-rwgps-pageid'] );
  }

  return $post;
}

add_filter( 'attachment_fields_to_save', 'dtrt_attachment_field_rwgps_pageid_save', 10, 2 );

/**
 * Add SoundCloud field to media uploader, for gallery-viewer
 *
 * @param $form_fields array, fields to include in attachment form
 * @param $post object, attachment record in database
 * @return $form_fields, modified form fields
 */

function dtrt_attachment_field_soundcloud_trackid( $form_fields, $post ) {
  $form_fields['dtrt-soundcloud-trackid'] = array(
    'label' => '<abbr title="SoundCloud">SC</abbr> Track ID',
    'input' => 'text',
    'value' => get_post_meta( $post->ID, 'dtrt_soundcloud_trackid', true ),
    'helps' => '//api.soundcloud.com/tracks/_________',
  );

  return $form_fields;
}

add_filter( 'attachment_fields_to_edit', 'dtrt_attachment_field_soundcloud_trackid', 10, 2 );

/**
 * Save value of SoundCloud field in media uploader, for gallery-viewer
 *
 * @param $post array, the post data for database
 * @param $attachment array, attachment fields from $_POST form
 * @return $post array, modified post data
 */

function dtrt_attachment_field_soundcloud_trackid_save( $post, $attachment ) {
  if ( isset( $attachment['dtrt-soundcloud-trackid'] ) ) {
    update_post_meta( $post['ID'], 'dtrt_soundcloud_trackid', $attachment['dtrt-soundcloud-trackid'] );
  }

  return $post;
}

add_filter( 'attachment_fields_to_save', 'dtrt_attachment_field_soundcloud_trackid_save', 10, 2 );

/**
 * Add Vimeo field to media uploader, for gallery-viewer
 *
 * @param $form_fields array, fields to include in attachment form
 * @param $post object, attachment record in database
 * @return $form_fields, modified form fields
 */

function dtrt_attachment_field_vimeo_pageid( $form_fields, $post ) {
  $form_fields['dtrt-vimeo-pageid'] = array(
    'label' => 'Vimeo ID',
    'input' => 'text',
    'value' => get_post_meta( $post->ID, 'dtrt_vimeo_pageid', true ),
    'helps' => '//vimeo.com/_________',
  );

  return $form_fields;
}

add_filter( 'attachment_fields_to_edit', 'dtrt_attachment_field_vimeo_pageid', 10, 2 );

/**
 * Save value of Vimeo field in media uploader, for gallery-viewer
 *
 * @param $post array, the post data for database
 * @param $attachment array, attachment fields from $_POST form
 * @return $post array, modified post data
 */

function dtrt_attachment_field_vimeo_pageid_save( $post, $attachment ) {
  if ( isset( $attachment['dtrt-vimeo-pageid'] ) ) {
    update_post_meta( $post['ID'], 'dtrt_vimeo_pageid', $attachment['dtrt-vimeo-pageid'] );
  }

  return $post;
}

add_filter( 'attachment_fields_to_save', 'dtrt_attachment_field_vimeo_pageid_save', 10, 2 );


/**
 * Add "Select onload" option to media uploader
 *
 * @param $form_fields array, fields to include in attachment form
 * @param $post object, attachment record in database
 * @return $form_fields, modified form fields
 */

function dtrt_attachment_field_select_onload( $form_fields, $post ) {

  // Set up options
  $options = array( '1' => 'Yes', '0' => 'No' );

  // Get currently select value
  $select = get_post_meta( $post->ID, 'dtrt_select_onload', true );

  // If no select value, default to 'No'
  if( !isset( $select ) )
    $select = '0';

  // Display each option
  foreach ( $options as $value => $label ) {
    $checked = '';
    $css_id = 'select-onload-option-' . $value;

    if ( $select == $value ) {
      $checked = " checked='checked'";
    }

    $html = "<div class='select-onload-option'><input type='radio' name='attachments[$post->ID][dtrt-select-onload]' id='{$css_id}' value='{$value}'$checked />";

    $html .= "<label for='{$css_id}'>$label</label>";

    $html .= '</div>';

    $out[] = $html;
  }

  // Construct the form field
  $form_fields['dtrt-select-onload'] = array(
    'label' => 'Select onload',
    'input' => 'html',
    'html'  => join("\n", $out),
  );

  // Return all form fields
  return $form_fields;
}

add_filter( 'attachment_fields_to_edit', 'dtrt_attachment_field_select_onload', 10, 2 );


/**
 * Save value of "Select onload" selection in media uploader
 *
 * @param $post array, the post data for database
 * @param $attachment array, attachment fields from $_POST form
 * @return $post array, modified post data
 */

function dtrt_attachment_field_select_onload_save( $post, $attachment ) {
  if( isset( $attachment['dtrt-select-onload'] ) )
    update_post_meta( $post['ID'], 'dtrt_select_onload', $attachment['dtrt-select-onload'] );

  return $post;
}

add_filter( 'attachment_fields_to_save', 'dtrt_attachment_field_select_onload_save', 10, 2 );


/**
 * Add "Panorama" option to media uploader
 *
 * @param $form_fields array, fields to include in attachment form
 * @param $post object, attachment record in database
 * @return $form_fields, modified form fields
 */

function dtrt_attachment_field_panorama( $form_fields, $post ) {

  // Set up options
  $options = array( '1' => 'Yes', '0' => 'No' );

  // Get currently select value
  $select = get_post_meta( $post->ID, 'dtrt_panorama', true );

  // If no select value, default to 'No'
  if( !isset( $select ) )
    $select = '0';

  // Display each option
  foreach ( $options as $value => $label ) {
    $checked = '';
    $css_id = 'panorama-option-' . $value;

    if ( $select == $value ) {
      $checked = " checked='checked'";
    }

    $html = "<div class='panorama-option'><input type='radio' name='attachments[$post->ID][dtrt-panorama]' id='{$css_id}' value='{$value}'$checked />";

    $html .= "<label for='{$css_id}'>$label</label>";

    $html .= '</div>';

    $out[] = $html;
  }

  // Construct the form field
  $form_fields['dtrt-panorama'] = array(
    'label' => 'Panorama',
    'input' => 'html',
    'html'  => join("\n", $out),
  );

  // Return all form fields
  return $form_fields;
}

add_filter( 'attachment_fields_to_edit', 'dtrt_attachment_field_panorama', 10, 2 );

/**
 * Save value of "panorama" selection in media uploader
 *
 * @param $post array, the post data for database
 * @param $attachment array, attachment fields from $_POST form
 * @return $post array, modified post data
 * @todo calculate this automatically, or make it a theme option to do so
 */

function dtrt_attachment_field_panorama_save( $post, $attachment ) {
  if( isset( $attachment['dtrt-panorama'] ) )
    update_post_meta( $post['ID'], 'dtrt_panorama', $attachment['dtrt-panorama'] );

  return $post;
}

add_filter( 'attachment_fields_to_save', 'dtrt_attachment_field_panorama_save', 10, 2 );

?>