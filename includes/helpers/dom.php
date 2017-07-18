<?php

require_once( dirname( dirname( dirname(__FILE__) ) ) . '/vendor/html5-dom-document-php-master/autoload.php');

/**
 * Wrap content in section elements with id and class attributes
 * for compatibility with stickyNavbar.js
 * This repurposes the anchors injected by the better-anchor-links plugin
 *
 * @requires https://wordpress.org/plugins/better-anchor-links/
 * @todo Make this reusable/optional
 * @since 3.0.0
 */

add_filter( 'the_content', 'wpdtrt_dom_content_sections' );

function wpdtrt_dom_content_sections($content) {
  $regex = '/<a class=[\"\']mwm-aal-item[\"\'] name=\"(?P<anchor_name>[0-9a-z-]+)\"><\/a>/im';
  // $regex = "/<a class=[\"\']mwm-aal-item[\"\'] name=\"(?P<anchor_name>[0-9a-z-]+)\"><\/a>+(?P<section_content>[\s\S]+)(?P<next_anchor>class=[\"\']mwm-aal-item[\"\'])/im";


	// DOMDocument doesn't support HTML5 elements
	// https://github.com/ivopetkov/html5-dom-document-php
	/*
	$dom = new IvoPetkov\HTML5DOMDocument();
	$dom->loadHTML($content);

	foreach( $dom->childNodes as $element ) {
		wpdtrt_log( $element->getAttribute('name') );
	}

	// if heading/anchor link add to array
	// if anything else make nested array of current heading/anchor link
	*/

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

?>