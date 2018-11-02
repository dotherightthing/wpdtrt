<?php
/**
 * Debug
 *
 * @package WPDTRT
 * @since 0.1.0
 */

/**
 * Output errors to wp-content/debug.log
 * Supports strings and arrays (print_r)
 * WP_DEBUG can be toggled on in wp-config.php
 *
 * @param array|string $log Value to log.
 * @link http://www.stumiller.me/sending-output-to-the-wordpress-debug-log/
 */
function wpdtrt_log( $log ) {
	if ( true === WP_DEBUG ) {
		if ( is_array( $log ) || is_object( $log ) ) {
			error_log( print_r( $log, true ) );
		} else {
			error_log( $log );
		}
	}
}
