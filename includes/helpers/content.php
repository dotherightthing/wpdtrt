<?php
/**
 * Content
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Theme Functions
 * @since 0.1.0
 * @version 0.1.0
 */

/**
 * Strip &nbsp; that is inserted randomly through the content
 * (apparently this is a chrome bug)
 * @see https://core.trac.wordpress.org/ticket/31157
 */

add_filter('the_excerpt', 'wpdtrt__remove_nonbreaking_spaces', 99);
add_filter('the_content', 'wpdtrt__remove_nonbreaking_spaces', 99);

function wpdtrt__remove_nonbreaking_spaces($string) {
  // the non-breaking space character, got you!
  // http://www.utf8-chartable.de/unicode-utf8-table.pl?start=128&number=128&utf8=string-literal&unicodeinhtml=hex
  return str_replace("\xc2\xa0", " ", $string);
}

/**
 * Add default content to the editor
 * @uses http://www.wpbeginner.com/wp-tutorials/how-to-add-default-content-in-your-wordpress-post-editor/
 * @see https://developer.wordpress.org/reference/hooks/default_content/
 */

//add_filter( 'default_content', 'wpdtrt__default_content' );

function wpdtrt__default_content( $post_content ) {
  $post_content = "TODO";
  return $post_content;
}

/**
 * Wrap content in section elements with id and class attributes
 * for compatibility with stickyNavbar.js
 * This repurposes the anchors injected by the
 * better-anchor-links plugin
 * Dependent on Better Anchor Links
 * @todo Make this reusable/optional
 */

add_filter( 'the_content', 'add_content_sections' );

function add_content_sections($content) {
  $regex = '/<a class=[\"\']mwm-aal-item[\"\'] name=\"(?P<anchor_name>[0-9a-z-]+)\"><\/a>/im';
  // $regex = "/<a class=[\"\']mwm-aal-item[\"\'] name=\"(?P<anchor_name>[0-9a-z-]+)\"><\/a>+(?P<section_content>[\s\S]+)(?P<next_anchor>class=[\"\']mwm-aal-item[\"\'])/im";

  $anchor_after_all = preg_split($regex, $content); // excludes anchors
  $anchor_after_first = array_shift( $anchor_after_all ); // the first item is held (removed) here, the remainder are in $anchor_after_all
  preg_match_all($regex, $content, $matches); // $matches['anchor_name'] is just the anchors

  $content_sectioned = '';
  $content_sectioned .= $anchor_after_first . "\n";
  $content_sectioned .= '<div class="clear"></div>' . "\n";

  $array_index = 0;

  foreach( $matches['anchor_name'] as $anchor_name ) {
    // tabindex="-1" works better in JAWS 17
    $content_sectioned .= '<section id="' . $anchor_name . '" class="scrollto" tabindex="-1">' . "\n";
    $content_sectioned .= $anchor_after_all[$array_index] . "\n";
    $content_sectioned .= '</section>' . "\n";

    $array_index++;
  }

  return $content_sectioned;
}

/**
 * Wrap Gallery HTML around H2 headings
 * Inject Gallery HTML into H2 headings
 * @todo Make this reusable and document the options
 */

function wpdtrt__h2_wrapper_start() {
  $str = '';
  $str .= '<div class="stack stack_link_viewer gallery-viewer h2-viewer" id="[]-viewer" data-has-image="false" data-expanded="false">';
  $str .= '<div class="gallery-viewer--header">';
  $str .= '<h2 class="gallery-viewer--heading">';

  return $str;
}

function wpdtrt__h2_wrapper_end() {
  $str = '';
  $str .= '</h2>';
  $str .= '</div>';
  $str .= '<div class="stack--wrapper" style="">';
  $str .= '<figure class="stack--liner">';
  $str .= '<img src="" alt="">';
  $str .= '<iframe width="100%" height="100%" src="" frameborder="0" allowfullscreen="true" scrolling="no" aria-hidden="true"></iframe>';
  $str .= '<figcaption class="gallery-viewer--footer">';
  $str .= '<div class="gallery-viewer--caption">';
  $str .= '</div>';
  $str .= '</figcaption>';
  $str .= '</figure>';
  $str .= '</div>';
  $str .= '</div>';

  return $str;
}

add_filter( 'the_content', 'wpdtrt__content_h2_liner' );

function wpdtrt__content_h2_liner($content) {
  $content = str_replace('<h2>', wpdtrt__h2_wrapper_start(), $content);
  $content = str_replace('</h2>', wpdtrt__h2_wrapper_end(), $content);

  return $content;
}

add_filter( 'the_content', 'wpdtrt__content_gallery_heading', 3 );

function wpdtrt__content_gallery_heading($content) {
  $content = str_replace("<div id='gallery'>", "<h3>Gallery</h3><div id='gallery'>", $content);

  return $content;
}

?>