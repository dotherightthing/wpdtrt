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

add_filter('the_excerpt', 'wpdtrt_remove_nonbreaking_spaces', 99);
add_filter('the_content', 'wpdtrt_remove_nonbreaking_spaces', 99);

function wpdtrt_remove_nonbreaking_spaces($string) {
  // the non-breaking space character, got you!
  // http://www.utf8-chartable.de/unicode-utf8-table.pl?start=128&number=128&utf8=string-literal&unicodeinhtml=hex
  return str_replace("\xc2\xa0", " ", $string);
}

/**
 * Add default content to the editor
 * @uses http://www.wpbeginner.com/wp-tutorials/how-to-add-default-content-in-your-wordpress-post-editor/
 * @see https://developer.wordpress.org/reference/hooks/default_content/
 */

//add_filter( 'default_content', 'wpdtrt_default_content' );

function wpdtrt_default_content( $post_content ) {
  $post_content = "TODO";
  return $post_content;
}

/**
 * Wrap Gallery HTML around H2 headings
 * Inject Gallery HTML into H2 headings
 * @todo Make this reusable and document the options
 */

function wpdtrt_h2_wrapper_start() {
  $str = '';
  $str .= '<div class="stack stack_link_viewer gallery-viewer h2-viewer" id="[]-viewer" data-has-image="false" data-expanded="false">';
  $str .= '<div class="gallery-viewer--header">';
  $str .= '<h2 class="gallery-viewer--heading">';

  return $str;
}

function wpdtrt_h2_wrapper_end() {
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

//add_filter( 'the_content', 'wpdtrt_content_h2_liner' );

function wpdtrt_content_h2_liner($content) {
  $content = str_replace('<h2>', wpdtrt_h2_wrapper_start(), $content);
  $content = str_replace('</h2>', wpdtrt_h2_wrapper_end(), $content);

  return $content;
}

//add_filter( 'the_content', 'wpdtrt_content_gallery_heading', 3 );

function wpdtrt_content_gallery_heading($content) {
  $content = str_replace("<div id='gallery'>", "<h3>Gallery</h3><div id='gallery'>", $content);

  return $content;
}

?>