<?php
/**
 * Stylesheets (CSS)
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Theme Functions
 * @since 0.1.0
 * @version 0.1.0
 */

/**
 * Style frontend content & UI
 * @link https://wordpress.org/ideas/topic/add-theme-version-number-to-stylesheet-url-not-wp-version
 */
add_action( 'wp_enqueue_scripts', 'wpdtrt_css' );

function wpdtrt_css() {

  $theme_version = wp_get_theme()->Version;
  $parent_style = 'wpdtrt_parent';
  $child_style = 'wpdtrt_child';

  wp_enqueue_style( $parent_style,
    get_template_directory_uri() . '/css/' . $parent_style . '.min.css',
    array(),
    $theme_version
  );

  /*
  wp_enqueue_style( $child_style,
    get_template_directory_uri() . '/css/' . $child_style . '.min.css',
    array($parent_style),
    $theme_version
  );
  */

  //$wpdtrt_inline_css = '';
  //wp_add_inline_style( $theme_style, $wpdtrt_inline_css );
}

/**
 * Style back-end UI
 */
add_action( 'admin_enqueue_scripts', 'wpdtrt_admin_css' );

function wpdtrt_admin_css() {

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
add_action( 'init', 'wpdtrt_editor_css' );

function wpdtrt_editor_css() {
    add_editor_style( get_template_directory_uri() . '/css/editor-style.css' );
}

?>