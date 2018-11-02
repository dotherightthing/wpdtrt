<?php
/**
 * Advanced Custom Fields (ACF)
 *
 * @package WPDTRT
 * @since 0.1.0
 */

/**
 * Hide WP Admin menu item
 *
 * @example
 * add_filter( 'acf/settings/show_admin', '__return_false' );
 */
add_filter( 'acf/settings/show_admin', '__return_false' );

if ( ! function_exists( 'wpdtrt_acf_json_save_point' ) ) {
	/**
	 * Configure custom Local JSON save point (ACF 5.0.0+)
	 *
	 * @param string $path Save path.
	 * @return string $path
	 * @since 0.1.0
	 * @uses https://www.advancedcustomfields.com/resources/local-json/
	 */
	function wpdtrt_acf_json_save_point( $path ) {
		// update path.
		$path = get_stylesheet_directory() . '/config';

		return $path;
	}

	add_filter( 'acf/settings/save_json', 'wpdtrt_acf_json_save_point' );
}

if ( ! function_exists( 'wpdtrt_acf_json_load_point' ) ) {
	/**
	 * Configure custom Local JSON load point (ACF 5.0.0+)
	 *
	 * @param array $paths Load paths.
	 * @return array $paths
	 * @since 0.1.0
	 * @uses https://www.advancedcustomfields.com/resources/local-json/
	 */
	function wpdtrt_acf_json_load_point( $paths ) {
		// remove original path (optional).
		unset( $paths[0] );

		// append path.
		$paths[] = get_stylesheet_directory() . '/config';

		return $paths;
	}

	add_filter( 'acf/settings/load_json', 'wpdtrt_acf_json_load_point' );
}

/**
 * Theme options menu (ACF PRO 5.0.0+)
 * The actual fields are set up in ACF
 *
 * @see https://www.advancedcustomfields.com/resources/options-page/
 */

if ( function_exists( 'acf_add_options_page' ) ) {
	// add parent.
	$parent = acf_add_options_page(array(
		'page_title' => 'Settings : Theme',
		'menu_title' => 'Theme Settings',
		'menu_slug'  => 'theme-settings',
		'capability' => 'edit_posts',
		'redirect'   => false,
	));

	// add sub page.
	//
	// acf_add_options_sub_page(array(.
	// 'page_title'  => 'Owner Settings',
	// 'menu_title'  => 'Owner',
	// 'parent_slug'   => $parent['menu_slug'],
	// ));.
}

/**
 * Hex to RGBA
 * Convert ACF color picker values to rgba
 *
 * @uses https://support.advancedcustomfields.com/forums/topic/color-picker-values/
 */

if ( ! function_exists( 'wpdtrt_hex2rgba' ) ) {

	/**
	 * Convert hex codes into RGBA
	 *
	 * @param array       $color   Colour.
	 * @param boolean|int $opacity Opacity.
	 * @return string rgb(a) color string
	 */
	function wpdtrt_hex2rgba( $color, $opacity = false ) {

		$default = 'rgb(0,0,0)';

		// Return default if no color provided.
		if ( empty( $color ) ) {
			return $default;
		}

		// Sanitize $color if "#" is provided.
		if ( '#' === $color[0] ) {
			$color = substr( $color, 1 );
		}

		// Check if color has 6 or 3 characters and get values.
		if ( strlen( $color ) === 6 ) {
			$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) === 3 ) {
			$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
			return $default;
		}

		// Convert hexadec to rgb.
		$rgb = array_map( 'hexdec', $hex );

		// Check if opacity is set(rgba or rgb).
		if ( $opacity ) {
			if ( abs( $opacity ) > 1 ) {
				$opacity = 1.0;
				$output  = 'rgba(' . implode( ',', $rgb ) . ',' . $opacity . ')';
			} else {
				$output = 'rgb(' . implode( ',', $rgb ) . ')';
			}
		}

		// Return rgb(a) color string.
		return $output;
	}
}
