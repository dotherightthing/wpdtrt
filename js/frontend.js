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
 * WebFontLoader (Page Speed optimisation)
 * Load Google fonts asynchronously by using Google’s Web Font Loader.
 * Eliminates Render Blocking CSS above the fold (Mobile PS 69/100 -> 82/100).
 *
 * Using the Web Font Loader asynchronously avoids blocking your page while loading the JavaScript.
 * Be aware that if the script is used asynchronously, the rest of the page might render
 * before the Web Font Loader is loaded and executed, which can cause a Flash of Unstyled Text (FOUT).
 * https://github.com/typekit/webfontloader
 *
 * Source: https://www.keycdn.com/blog/google-pagespeed-insights-wordpress/
 * Choose fonts: https://fonts.google.com
 */

wpdtrt__ui.webfontloader = function($) {

  WebFontConfig = {
    google: {
      families: [
        "Open Sans:400,700"
      ]
    }
  };

  (function() {
    var wf = document.createElement("script");
    wf.src = "https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js";
    wf.type = "text/javascript";
    wf.async = "true";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(wf, s);
  })();

};

wpdtrt__ui.editor = function($) {

  var $pre = jQuery("pre").eq(0);
  var height = $pre.height();
  $pre.attr('id', 'editor'); // ace requires an ID
  $pre.wrap('<div class="editor-wrapper"></div>');
  $pre.parent().css('min-height', height/16 + 'em');

  var editor = ace.edit("editor");
  editor.setTheme("ace/theme/monokai");
  editor.getSession().setMode("ace/mode/javascript");
};

wpdtrt__ui.get_source_title = function($) {

  if ( ! wpdtrt__template_directory_uri ) {
    return;
  }

  var $kb_source_url = $('#kb-source-url');
  var $kb_source_name = $('#kb-source-name');

  if ( $kb_source_url.text() !== '' ) {

    $.ajax({
      url: wpdtrt__template_directory_uri + '/ajax/get_page_title.php',
      data: { url: $kb_source_url.text() },
      type: 'post',
      cache: false,
      success: function(data) {
         $kb_source_name.html(data);
      },
      // http://stackoverflow.com/questions/8918248/ajax-success-and-error-function-failure#8918298
      error: function(XMLHttpRequest, textStatus, errorThrown) {

        // https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest/readyState
        // 4 - The operation is complete
        console.log("readyState: " + XMLHttpRequest.readyState);

        console.log("Code: " + XMLHttpRequest.status);
        console.log("Status: " + textStatus);
        console.log("Error: " + errorThrown);

        console.log(XMLHttpRequest);

/*
if (xmlHttpReq.readyState == 4) {
           strResponse = xmlHttpReq.responseText;
           switch (xmlHttpReq.status) {
                   // Page-not-found error
                   case 404:
                           alert('Error: Not Found. The requested URL ' + 
                                   strURL + ' could not be found.');
                           break;
                   // Display results in a full window for server-side errors
                   case 500:
                           handleErrFullPage(strResponse);
                           break;
                   default:
                           // Call JS alert for custom error or debug messages
                           if (strResponse.indexOf('Error:') > -1 || 
                                   strResponse.indexOf('Debug:') > -1) {
                                   alert(strResponse);
                           }
                           // Call the desired result function
                           else {
                                   eval(strResultFunc + '(strResponse);');
                           }
                           break;
           }
   }

*/
      }
    });

  }
};

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
