<?php
/**
 * Menus
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Theme Functions
 * @since 0.1.0
 * @version 0.1.0
 */

/**
 * Register Menus
 * This sets the name that will appear at Appearance -> Menus.
 * Add locations to Menu settings > Display location, and the Manage Locations tab
 *
 * @link https://developer.wordpress.org/themes/functionality/navigation-menus/#register-menus
 */
add_action( 'init', 'wpdtrt_register_menus' );

function wpdtrt_register_menus() {
  register_nav_menus(
    array(
      "header-menu" => __( 'Header Menu', 'wpdtrt' )
    )
  );
}

?>