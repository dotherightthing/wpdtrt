<?php
/**
 * JavaScript - Webfont Loader
 *
 * @package WPDTRT
 * @subpackage WPDTRT - Library
 * @since 0.1.0
 * @version 0.1.0
 */

//add_action( 'wp_enqueue_scripts', 'wpdtrt_js_webfonts', 0 );

function wpdtrt_js_webfonts() {

    /**
     * Attach scripts to bottom of the page
     * to prevent blocking behaviour
     * which affects PageSpeed
     * @see https://github.com/typekit/webfontloader
     * @see http://www.wpbeginner.com/wp-tutorials/how-to-move-javascripts-to-the-bottom-or-footer-in-wordpress/
     */
    $attach_to_footer = true;

    $wpdtrt_js_webfont_loader = 'wpdtrt_js_webfont_loader';

    wp_register_script( $wpdtrt_js_webfont_loader,
      'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js',
      false,
      false,
      $attach_to_footer
    );

    wp_enqueue_script( $wpdtrt_js_webfont_loader );

    /**
     * Configuration object
     */
    $js_webfont_config = array(
    	'google' => array(
    		'families' => array('Open Sans', 'Open Serif')
    	)
    );

    /**
     * Create a filter to allow child themes to modify the configuration object
	 * @see http://archive.extralogical.net/2007/06/wphooks/
     * @see http://wpcandy.com/teaches/custom-hooks-and-pluggable-functions/#.WZFYh3cjFlc
     */
    $js_webfont_config = apply_filters( 'wpdtrt_js_webfont_config', $js_webfont_config );

    wp_add_inline_script( $wpdtrt_js_webfont_loader, 'WebFont.load(' . json_encode( $js_webfont_config ) . ');' );
}

/**
 * Test
 */
//add_filter( 'wpdtrt_js_webfont_config', 'wpdtrt_js_webfont_config_test' );

function wpdtrt_js_webfont_config_test() {
	return array(
    	'google' => array(
    		'families' => array('Roboto', 'Archivo')
    	)
    );
}

add_action( 'wp_enqueue_scripts', 'wpdtrt_js_webfonts_inline' );

function wpdtrt_js_webfonts_inline() {

    /**
     * Inline scripts at top of page
     * to prevent FOUC
     * @see https://github.com/typekit/webfontloader
     */
    $header = 'wpdtrt_header';

    /**
     * Configuration object
     */
    $js_webfont_config = array(
        'google' => array(
            'families' => array('Open Sans', 'Open Serif')
        )
    );

    /**
     * Create a filter to allow child themes to modify the configuration object
     * This is a copy of the one in wpdtrt_js_webfonts()
     */
    $js_webfont_config = apply_filters( 'wpdtrt_js_webfont_config', $js_webfont_config );

    wp_add_inline_script( $header, "\r\n" . 'WebFontConfig = ' . json_encode( $js_webfont_config ) . ";\r\n\r\n" . "(function(d) {
      var wf = d.createElement('script'), s = d.scripts[0];
      wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
      wf.async = true;
      s.parentNode.insertBefore(wf, s);
   })(document);" );

}
