<?php
/**
 * Content
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Cheatsheets
 * @since 0.1.0
 * @version 0.1.0
 */

add_filter( 'the_content', 'wpdtrt_content_filter' );

function wpdtrt_content_filter($content) {

  $content = str_replace('<h2>', '<div><h2>', $content);
  $content = str_replace('</h2>', '</h2></div>', $content);

  return $content;
}

?>