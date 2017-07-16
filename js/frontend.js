// JS Hint
/* globals jQuery, WebFontConfig */
/**
 * Theme JavaScript functions
 * Displays a list of posts in excerpt or full-length form.
 * Include wp_link_pages() to support navigation links within posts.
 *
 * @package DTRT Framework - Theme
 * @since 0.1.0
 * @version 0.1.0
 */

var wpdtrt__ui = {};

/**
 * Init UI
 */

wpdtrt__ui.init = function($) {

  document.addEventListener("touchstart", function() {
    // nada, this is just a hack to make :focus state render on touch
  }, false);

  wpdtrt__ui.webfontloader($);
  wpdtrt__ui.get_source_title($);
  //wpdtrt__ui.editor($);
};

/**
 * Run scripts
 */

jQuery(document).ready( function($) {
  wpdtrt__ui.init($);
});

(function($) {
  $(window).on('load', function() {
    // defer these functions, to reduce initial load time for PageSpeed
  });
})(jQuery);
