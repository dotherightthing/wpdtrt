<?php
/**
 * Advanced Custom Fields (ACF)
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Theme Functions
 * @since 0.1.0
 * @version 0.1.0
 */

/**
  * Automatically save config to JSON files, for easier migration & debugging
  * @uses https://www.advancedcustomfields.com/resources/local-json/
  */

if ( function_exists('register_field_group') ) {

  add_filter('acf/settings/save_json', 'wpdtrt_acf_config_directory');

  function wpdtrt_acf_config_directory( $path ) {
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

/**
  * wpdtrt_hex2rgba
  * Convert ACF color picker values to rgba
  * @uses https://support.advancedcustomfields.com/forums/topic/color-picker-values/
  */

if ( ! function_exists('wpdtrt_hex2rgba') ) {

  function wpdtrt_hex2rgba($color, $opacity = false) {

    $default = 'rgb(0,0,0)';

    //Return default if no color provided
    if(empty($color))
        return $default;

    //Sanitize $color if "#" is provided
      if ($color[0] == '#' ) {
        $color = substr( $color, 1 );
      }

      //Check if color has 6 or 3 characters and get values
      if (strlen($color) == 6) {
          $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
      } elseif ( strlen( $color ) == 3 ) {
          $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
      } else {
          return $default;
      }

      //Convert hexadec to rgb
      $rgb =  array_map('hexdec', $hex);

      //Check if opacity is set(rgba or rgb)
      if($opacity){
        if(abs($opacity) > 1)
          $opacity = 1.0;
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
      } else {
        $output = 'rgb('.implode(",",$rgb).')';
      }

      //Return rgb(a) color string
      return $output;
  }
}

?>