<?php
/**
 * Theme Support options / customisations
 * Controls which options users can customise via Appearance > Customise
 * Note that settings made in Theme A's Customiser will be lost when switching to Theme B
 *
 * @package WPDTRT
 * @subpackage WPDTRT - Library
 * @since 0.1.0
 * @version 0.1.0
 */

/**
 * Remove Appearance > Customise > Additional CSS (4.7)
 * Better to use a child theme.
 * @param $wp_customize WP_Customize_Manager
 * @link https://robincornett.com/additional-css-wordpress-customizer/
 */

add_action( 'customize_register', 'prefix_remove_css_section', 15 );

function prefix_remove_css_section( $wp_customize ) {
  $wp_customize->remove_section( 'custom_css' );
}

/**
 * Content Width
 * Using this feature you can set the maximum allowed width for any content in the theme,
 * like oEmbeds and images added to posts.
 *
 * @link https://codex.wordpress.org/Content_Width#Adding_Theme_Support
 * @link https://make.wordpress.org/themes/handbook/review/required/#templates
 * @since Version 2.6.
 */
if ( ! isset( $content_width ) ) {
  $content_width = 600;
}

/**
 * Enable Theme Support features
 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#features
 */
add_action( 'after_setup_theme', 'wpdtrt_theme_setup' );

function wpdtrt_theme_setup() {

  /**
   * Enables Automatic Feed Links for post and comment in the head. This should be used in place of the deprecated automatic_feed_links() function
   * @link https://make.wordpress.org/themes/handbook/review/required/#core-functionality-and-features
   * @since WordPress 3.0
   */
  add_theme_support('automatic-feed-links');

  /**
   * Enables Custom_Backgrounds support for a theme
   * @since WordPress 3.4
   */
  //add_theme_support('custom-background');

  /**
   * Enables Custom_Headers support for a theme
   * @since WordPress 2.1
   */
  //add_theme_support('custom-header');

  /**
   * Enables Theme_Logo support for a theme
   * @since WordPress 4.5
   */
  //add_theme_support('custom-logo');

  /**
   * Enables the Selective Refresh preview mechanism for Widgets being managed within the Customizer
   * @since WordPress 4.5
   */
  //add_theme_support('customize-selective-refresh-widgets');

  /**
   * Allows the use of HTML5 markup for the search forms, comment forms, comment lists, gallery, and caption
   * @since WordPress 3.6
   */
  add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery', // affects wpdtrt-gallery presentation in wpdtrt-dbth
    'caption', // affects wpdtrt-gallery presentation in wpdtrt-dbth
  ) );

  /**
   * Enables Post Formats support for a theme
   * @since WordPress 2.9 -> 'Featured Images' 3.0
   */
  //add_theme_support('post-formats');

  /**
   * Enables Post Thumbnails support for a theme, or certain post types
   * @since WordPress 3.1
   */
  add_theme_support('post-thumbnails');

  /**
   * Enables plugins and themes to manage the document title tag. This should be used in place of wp_title() function
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   * @link https://make.wordpress.org/themes/handbook/review/required/#core-functionality-and-features
   * @since WordPress 4.1
   */
  add_theme_support('title-tag');

  //remove_theme_support( array());
}

?>