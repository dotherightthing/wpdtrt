<?php
/**
 * Register widget-ready sidebars
 *
 * @package WPDTRT
 * @since 0.1.4
 */

/**
 * Register a widget ready sidebar
 *
 * @example
 * // mytheme/sidebar-widget-tests.php
 * if ( is_active_sidebar( 'sidebar-widget-tests' ) ) {
 *    dynamic_sidebar( 'sidebar-widget-tests' );
 * }
 *
 * // single.php
 * <?php get_sidebar('widget-tests'); ?>
 */
register_sidebar( array(
	'name'          => esc_html__( 'Widget Tests', 'wpdtrt' ),
	'id'            => 'sidebar-widget-tests',
	'description'   => esc_html__( 'Add test widgets here.', 'wpdtrt' ),
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '<h2 class="widget-title">',
	'after_title'   => '</h2>',
));
