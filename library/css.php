<?php
/**
 * CSS Stylesheets
 *
 * @package WPDTRT
 * @since 0.1.0
 */

add_action( 'wp_enqueue_scripts', 'wpdtrt_css' );
add_action( 'admin_enqueue_scripts', 'wpdtrt_css_admin' );
add_action( 'init', 'wpdtrt_css_editor' );

/**
 * Style frontend content & UI
 *
 * @link https://wordpress.org/ideas/topic/add-theme-version-number-to-stylesheet-url-not-wp-version
 */
function wpdtrt_css() {
	$theme_version = wp_get_theme()->Version;
	$parent_style  = 'wpdtrt';

	wp_enqueue_style( $parent_style,
		get_template_directory_uri() . '/css/' . $parent_style . '.css',
		array(),
		$theme_version
	);

	// $wpdtrt_inline_css = '';.
	// wp_add_inline_style( $theme_style, $wpdtrt_inline_css );.
}

/**
 * Style back-end UI
 *
 * @link https://wordpress.org/ideas/topic/add-theme-version-number-to-stylesheet-url-not-wp-version
 */
function wpdtrt_css_admin() {
	$theme_version = wp_get_theme()->Version;
	$parent_style  = 'wpdtrt';

	wp_enqueue_style( $parent_style . '-css-admin',
		get_template_directory_uri() . '/css/' . $parent_style . '-admin.css',
		array(),
		$theme_version
	);
}

/**
 * Style contents of visual editor
 *
 * @uses add_editor_style() Links a stylesheet to visual editor
 * @uses get_stylesheet_uri() Returns URI of theme stylesheet
 * @link https://carriedils.com/add-editor-style/
 * @link https://codex.wordpress.org/Editor_Style
 * @link https://developer.wordpress.org/reference/functions/add_editor_style/#Description
 * @since Version 3.0.
 */
function wpdtrt_css_editor() {
	$theme_version = wp_get_theme()->Version;
	$parent_style  = 'wpdtrt';

	add_editor_style(
		get_template_directory_uri() . '/css/' . $parent_style . '-editor.css'
	);
}
