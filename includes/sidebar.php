<?php
/**
 * Sidebar (Widgets)
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Theme Functions
 * @since 0.1.0
 * @version 0.1.0
 */

/**
 * Register a widget ready sidebar
 */
add_action( 'widgets_init', 'wpdtrt__widgets_init' );

function wpdtrt__widgets_init() {

  register_sidebar( array(
    'name'          => __( 'Sidebar', 'wp-dtrt-fwt' ),
    'id'            => 'sidebar-location',
    'description'   => __( 'Add widgets here to appear in the location sidebar.', 'wp-dtrt-fwt' ),
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ));
}

?>
