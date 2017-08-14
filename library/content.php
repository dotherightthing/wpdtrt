<?php
/**
 * Content
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Library
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

?>