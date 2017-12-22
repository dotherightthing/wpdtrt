<?php
/**
 * JavaScript - GTM
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Library
 * @since 0.1.0
 * @version 0.1.0
 */

//add_action( 'wp_enqueue_scripts', 'wpdtrt_js_gtm' );

function wpdtrt_js_gtm() {

  /**
   * Link assets to theme version to ensure user gets the latest version
   * @see https://wordpress.org/ideas/topic/add-theme-version-number-to-stylesheet-url-not-wp-version
   */
  $theme_version = wp_get_theme()->Version;

  $header = 'wpdtrt_header';

  /**
   * @see http://kb.dotherightthing.dan/seo/google-tag-manager-gtm/
   */
  if ( function_exists('get_field') ) {
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
  }
}
?>