<?php
/**
 * JavaScript (JS)
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Theme Functions
 * @since 0.1.0
 * @version 0.1.0
 */

if ( ! function_exists('wpdtrt_js_jquery') ) {

  /**
   * Remove render blocking jQuery scripts from header
   * @see https://www.oxhow.com/optimize-defer-javascript-wordpress/
   */
  //add_action('wp_print_scripts', 'wpdtrt_js_jquery'); // separates scripts
  add_action('template_redirect', 'wpdtrt_js_jquery'); // prints scripts together

  function wpdtrt_js_jquery() {

    $site_url = get_site_url();

    /**
     * Attach scripts to bottom of the page
     * to prevent blocking behaviour
     * which affects PageSpeed
     * @link http://www.wpbeginner.com/wp-tutorials/how-to-move-javascripts-to-the-bottom-or-footer-in-wordpress/
     */
    $attach_to_footer = true;

    if ( is_admin() ) {
      return;
    }

    wp_deregister_script('jquery');
    wp_deregister_script('jquery-migrate');

    wp_register_script(
      'jquery',
      $site_url . '/wp-includes/js/jquery/jquery.js',
      false,
      '1.12.4',
      $attach_to_footer
    );

    wp_register_script(
      'jquery-migrate',
      $site_url . '/wp-includes/js/jquery/jquery-migrate.min.js',
      array('jquery'),
      '1.4.1',
      $attach_to_footer
    );

    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-migrate');
  }

}

if ( ! function_exists('wpdtrt_js') ) {

  /**
    * Load custom JavaScripts from the child theme
    * Get jQuery version: jQuery().jquery
    *
    * @link https://wordpress.org/support/topic/how-to-add-js-files-to-child-theme?replies=7
    */
  add_action( 'wp_enqueue_scripts', 'wpdtrt_js' );

  function wpdtrt_js() {

    /**
     * Link assets to theme version to ensure user gets the latest version
     * @see https://wordpress.org/ideas/topic/add-theme-version-number-to-stylesheet-url-not-wp-version
     */
    $theme_version = wp_get_theme()->Version;

    $header = 'wpdtrt_header';
    $footer = 'wpdtrt_footer';

    /**
     * Attach scripts to bottom of the page
     * to prevent blocking behaviour
     * which affects PageSpeed
     * @link http://www.wpbeginner.com/wp-tutorials/how-to-move-javascripts-to-the-bottom-or-footer-in-wordpress/
     */
    $attach_to_footer = true;

    /**
     * Remove the default WordPress actions that allow any scripts in the document's head
     * As a result, they will naturally be forced to be enqueued in the footer.
     *
     * @link http://stackoverflow.com/a/21167716
     * @link https://www.linkedin.com/pulse/speed-boost-how-move-javascripts-footer-wordpress-john-engle
     * @todo 2 & 3 prevent output of $header into the <head>.
     *  Removing all 3 results in some plugin scripts appearing in <head>.
     *  Could an alternate custom wp_head be set up for this type of usage?
     */
    //remove_action('wp_head', 'wp_print_scripts');
    //remove_action('wp_head', 'wp_print_head_scripts', 9);
    //remove_action('wp_head', 'wp_enqueue_scripts', 1);
    //add_action('wp_footer', 'wp_print_scripts', 5);
    //add_action('wp_footer', 'wp_enqueue_scripts', 5);
    //add_action('wp_footer', 'wp_print_head_scripts', 5);

    /**
     * Head scripts (head of page)
     * for GTM
     * wp_localize_script makes PHP variables available to the JS
     * @see http://kb.dotherightthing.dan/seo/google-tag-manager-gtm/
     * @todo is wp_localize_script required here or only in child theme?
     */
    wp_register_script( $header,
      get_template_directory_uri() . '/js/' . $header . '.min.js',
      array(),
      $theme_version,
      false
    );

    wp_enqueue_script( $header );

    wp_localize_script(
      $header,
      'wpdtrt_gtm_container_id',
      get_field('wpdtrt_acf_gtm_container_id', 'option')
    );

    // Google Tag Manager
    wp_add_inline_script( $header, "(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer',wpdtrt_gtm_container_id);" );

    /**
     * Body scripts (foot of body)
     * wp_localize_script makes PHP variables available to the JS
     * @todo is wp_localize_script required here or only in child theme?
     */
    wp_register_script( $footer,
      get_template_directory_uri() . '/js/' . $footer . '.min.js',
      array('jquery'),
      $theme_version,
      $attach_to_footer
    );

    wp_enqueue_script( $footer );

    wp_localize_script(
      $footer,
      'wpdtrt_template_directory_uri',
      get_template_directory_uri()
    );

    /**
     * Comment reply
     * @link https://make.wordpress.org/themes/handbook/review/required/
     * @todo What does this do?
     */
    //if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    //  wp_enqueue_script( 'comment-reply' );
    //}
  }

}

if ( ! function_exists('wpdtrt_deregister_head_js') ) {

  /**
   * Deregister only those scripts which are incorrectly output into the head.
   * Then reregister these to load into the footer.
   * This leaves wp_head load actions intact for scripts that we deem worthy (such as GTM).
   * @see http://justintadlock.com/archives/2009/08/06/how-to-disable-scripts-and-styles
   */

  //add_action( 'wp_print_scripts', 'wpdtrt_deregister_head_js', 100 );

  function wpdtrt_deregister_head_js() {

    //wp_deregister_script( 'plugin-name' );
    /*
    wp_register_script( 'plugin-name',
      get_template_directory_uri() . '/js/' . $header . '.min.js',
      array(),
      $theme_version,
      false
    );
    */
  }

}

if ( ! function_exists('wpdtrt_move_blocking_js') ) {

  /**
    * Move blocking JavaScript from <head> to bottom of <body>
    *   Removed as not required when Autoptimize is used
    * @param string $script_hook
    * @example wpdtrt_dbth_remove_blocking_js( 'twentysixteen_javascript_detection' );
    */
  //add_action( 'after_setup_theme', 'wpdtrt_move_blocking_js' );

  function wpdtrt_move_blocking_js( $script_hook ) {
    remove_action('wp_head', $script_hook, 0);
    add_action('wp_footer', $script_hook, 0);
  }

}

?>