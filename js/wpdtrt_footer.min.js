// UI manipulation for DBTH child theme
/* globals jQuery, Waypoint, URI, WebFontConfig, dbth_config */

var wpdtrt_ui = {};

// JS Hint
/* globals jQuery, WebFontConfig */
/**
 * Theme JavaScript functions
 *
 * @package DTRT Framework - Theme
 * @since 0.1.0
 * @version 0.1.0
 */

var wpdtrt_ui = {};

/**
 * Init UI
 */

wpdtrt_ui.init = function($) {

  document.addEventListener("touchstart", function() {
    // nada, this is just a hack to make :focus state render on touch
  }, false);
};

/**
 * Run scripts
 */

jQuery(document).ready( function($) {
  wpdtrt_ui.init($);
});

(function($) {
  $(window).on('load', function() {
    // defer these functions, to reduce initial load time for PageSpeed
  });
})(jQuery);

