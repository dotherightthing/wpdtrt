<?php
/**
 * Hooks and Filters
 *
 * @package WPDTRT
 * @since 0.1.0
 */

namespace DoTheRightThing\WPDTRT\Cheatsheets;

/**
 * Pluggable function
 * Allows the function to be overridden/replaced
 *
 * This technique is only useful if the function
 * is not attached to an 'action' or 'filter' hook
 * as those can be overridden,
 * or removed via remove_action() or remove_filter()
 *
 * @see http://wpcandy.com/teaches/custom-hooks-and-pluggable-functions/#.WZFYh3cjFlc
 * @example
 * if ( ! function_exists( 'wpdtrt_pluggable_function' ) ) {
 * // code that may be overridden
 * }
 */
