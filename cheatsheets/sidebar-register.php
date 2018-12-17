<?php
/**
 * Sidebar (Widgets)
 *
 * @package WPDTRT
 * @since 0.1.0
 */

namespace DoTheRightThing\WPDTRT\Cheatsheets;

add_action( 'widgets_init', 'wpdtrt_widgets_init' );

/**
 * Register a widget ready sidebar
 */
function wpdtrt_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'wpdtrt' ),
		'id'            => 'sidebar-location',
		'description'   => __( 'Add widgets here to appear in the location sidebar.', 'wpdtrt' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}
