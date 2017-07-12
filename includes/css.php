<?php
/**
 * Stylesheets (CSS)
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Theme Theme Functions
 * @since 0.1.0
 * @version 0.1.0
 */

/**
 * Style frontend content & UI
 * @link https://wordpress.org/ideas/topic/add-theme-version-number-to-stylesheet-url-not-wp-version
 */
add_action( 'wp_enqueue_scripts', 'wp_dtrt_fwt__css' );

function wp_dtrt_fwt__css() {

  $theme_version = wp_get_theme()->Version;
  $theme_style = 'wp_dtrt_fwt__css';

  // style.css (theme info)
  wp_enqueue_style( $theme_style,
    get_template_directory_uri() . '/style.css',
    array(),
    $theme_version
  );

  // css/style.css (theme styles)
  wp_enqueue_style( $theme_style,
    get_template_directory_uri() . '/css/frontend.css',
    array(),
    $theme_version
  );

  //$wp_dtrt_fwt__inline_css = '';
  //wp_add_inline_style( $theme_style, $wp_dtrt_fwt__inline_css );

  // theme-requirements.css (theme-check)
  wp_enqueue_style( 'wp_dtrt_fwt__css_theme_requirements',
    get_template_directory_uri() . '/css/theme-requirements.css'
  );
}

/**
 * Style back-end UI
 */
add_action( 'admin_enqueue_scripts', 'wp_dtrt_fwt__admin_css' );

function wp_dtrt_fwt__admin_css() {

  $theme_version = wp_get_theme()->Version;

  wp_enqueue_style( 'admin-style',
    get_template_directory_uri() . '/css/admin-style.css',
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
add_action( 'init', 'wp_dtrt_fwt__editor_css' );

function wp_dtrt_fwt__editor_css() {
    add_editor_style( get_template_directory_uri() . '/css/editor-style.css' );
}

?>