<?php
/**
 * Menus
 *
 * @package WPDTRT
 * @subpackage DTRT Framework - Library
 * @since 0.1.0
 * @version 0.1.0
 */

/**
 * Pluggable
 * Allow child themes to replace this function witb their own
 */
if ( ! function_exists('wpdtrt_register_menus') ) {

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
	    	// menu location slug => description
	      	"header-menu" => __( 'Header Menu', 'wpdtrt' ),
	      	"footer-menu" => __( 'Footer Menu (mobile-first noscript fallback)', 'wpdtrt' )
	    )
	  );
	}
}
?>