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

wpdtrt_ui.webfontloader = function($) {

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
    wf.async = "false";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(wf, s);
  })();

};