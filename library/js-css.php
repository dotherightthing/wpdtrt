<?php
/**
 * JavaScript - CSS hook
 *
 * @package WPDTRT
 * @since 0.1.0
 */

add_action( 'wp_enqueue_scripts', 'wpdtrt_js_css' );

/**
 * Add wpdtrt-js class to body
 */
function wpdtrt_js_css() {
	// attach to <head>.
	$header = 'inline_scripts_hook';

	// add wpdtrt-js hook immediately.
	// (without waiting for jQuery to load).
	wp_add_inline_script( $header, "
		(function() {
		var html = document.documentElement;
		var class_old = html.getAttribute('class');
		var class_new = class_old.replace('wpdtrt-nojs', 'wpdtrt-js');
		html.setAttribute('class', class_new);
		})();
	" );
}
