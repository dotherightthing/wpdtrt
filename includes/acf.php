<?php
/**
 * Advanced Custom Fields (ACF)
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Theme Theme Functions
 * @since 0.1.0
 * @version 0.1.0
 */

/**
  * Automatically save config to JSON files, for easier migration & debugging
  * @uses https://www.advancedcustomfields.com/resources/local-json/
  */

if ( function_exists('register_field_group') ) {

  add_filter('acf/settings/save_json', 'wp_dtrt_fwt__acf_config_directory');

  function wp_dtrt_fwt__acf_config_directory( $path ) {
    // update save path
    $path = get_stylesheet_directory() . '/config';
    return $path;
  }
}

/**
  * Theme options menu
  * The actual fields are set up in ACF
  *
  * @see https://www.advancedcustomfields.com/resources/options-page/
  */

if ( function_exists('acf_add_options_page') ) {

  // add parent
  $parent = acf_add_options_page(array(
    'page_title'  => 'Settings : DTRT Framework - Theme',
    'menu_title'  => 'DTRT Framework: Theme',
    'redirect'    => false
  ));

  // add sub page
  /*
  acf_add_options_sub_page(array(
    'page_title'  => 'Owner Settings',
    'menu_title'  => 'Owner',
    'parent_slug'   => $parent['menu_slug'],
  ));
  */

}

?>