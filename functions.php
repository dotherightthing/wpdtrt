<?php
/**
 * Theme functions
 *
 * @package DTRT Framework - Theme
 * @since 0.1.0
 * @version 0.1.0
 */

/**
 * Helpers
 * @todo Make plugins, or move to symlinked Cookbook
 */

require_once( __DIR__ . '/includes/helpers/acf.php');
require_once( __DIR__ . '/includes/helpers/attachment.php');
require_once( __DIR__ . '/includes/helpers/content.php');
require_once( __DIR__ . '/includes/helpers/css.php');
require_once( __DIR__ . '/includes/helpers/debug.php');
require_once( __DIR__ . '/includes/helpers/dom.php');
require_once( __DIR__ . '/includes/helpers/form-validaton_comments.php');
require_once( __DIR__ . '/includes/helpers/js.php');
require_once( __DIR__ . '/includes/helpers/map.php');
require_once( __DIR__ . '/includes/helpers/media.php');
require_once( __DIR__ . '/includes/helpers/menus.php');
require_once( __DIR__ . '/includes/helpers/permalinks.php');
require_once( __DIR__ . '/includes/helpers/post-type.php');
require_once( __DIR__ . '/includes/helpers/sidebar.php');
require_once( __DIR__ . '/includes/helpers/taxonomy.php');
require_once( __DIR__ . '/includes/helpers/template-tags.php');
require_once( __DIR__ . '/includes/helpers/theme-options.php');
require_once( __DIR__ . '/includes/shortcodes/featured-image.php');

/**
 * Weather
 * @todo Make plugin
 */
require_once( __DIR__ . '/includes/helpers/weather.php');
require_once( __DIR__ . '/vendor/bower_components/wp-darksky/wp-darksky.php');
require_once( __DIR__ . '/vendor/bower_components/12e9915ad81d62a6991c/wp-darksky-weather-icon-forecast.php');

// Config
require_once( __DIR__ . '/vendor/tgm-plugin-activation/class-tgm-plugin-activation.php');
require_once( __DIR__ . '/config/tgm-plugin-activation.php');

?>
