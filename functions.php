<?php
/**
 * Function library
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Library
 * @since 0.1.0
 * @version 0.1.0
 */

require_once( __DIR__ . '/library/acf.php');
require_once( __DIR__ . '/library/archive-title.php');
require_once( __DIR__ . '/library/content.php');
require_once( __DIR__ . '/library/content-sections.php');
require_once( __DIR__ . '/library/css.php');
require_once( __DIR__ . '/library/debug.php');
require_once( __DIR__ . '/library/excerpt.php');
require_once( __DIR__ . '/library/image.php');
require_once( __DIR__ . '/library/image-admin-fields.php');
require_once( __DIR__ . '/library/image-featured.php');
require_once( __DIR__ . '/library/js.php');
require_once( __DIR__ . '/library/js-body.php');
require_once( __DIR__ . '/library/js-css.php');
require_once( __DIR__ . '/library/js-gtm.php');
require_once( __DIR__ . '/library/js-head.php');
require_once( __DIR__ . '/library/js-jquery.php');
require_once( __DIR__ . '/library/js-webfont-loader.php');
require_once( __DIR__ . '/library/menus.php');
require_once( __DIR__ . '/library/permalink-placeholders.php');
require_once( __DIR__ . '/library/post-type.php');
require_once( __DIR__ . '/library/theme-options.php');
require_once( __DIR__ . '/library/validation-comment-form.php');

/**
 * Weather
 * @todo Make plugin
 */
require_once( __DIR__ . '/library/weather.php');
require_once( __DIR__ . '/vendor/bower_components/wp-darksky/wp-darksky.php');
require_once( __DIR__ . '/vendor/bower_components/12e9915ad81d62a6991c/wp-darksky-weather-icon-forecast.php');

// Config
require_once( __DIR__ . '/vendor/tgm-plugin-activation/class-tgm-plugin-activation.php');
require_once( __DIR__ . '/config/tgm-plugin-activation.php');

?>
