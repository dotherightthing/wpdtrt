<?php
/**
 * Form Validation - Comment
 *
 * @package WPDTRT
 * @subpackage DTRT Framework - Library
 * @since 0.1.0
 * @version 0.1.0
 */

/* Comments form
 * Override wp-includes/comment-template.php to add placeholders for jQuery field validation
 * All fields are also individually passed through a filter of the ‘comment_form_field_$name’
 * where $name is the key used in the array of fields.
 * Source: https://developer.wordpress.org/reference/functions/comment_form/
 *
 * See also wpdtrt_ui.comment_validation() in functions.js
 */

/* Comment field
 * The form states that "Required fields are marked *" but the comment form isn't marked with *
 * jQuery Validation automatically adds aria-invalid and aria-describedby when invalid
 * Add custom container for errors
 * Use custom error message rather than "This field is required"
 */
add_filter( 'comment_form_field_comment', 'wpdtrt_comment_form_field_comment__validation' );

function wpdtrt_comment_form_field_comment__validation( $content ) {
  $content = str_ireplace('<label for="comment">Comment</label>', '<label for="comment">Comment <span class="required">*</span></label>', $content);
  $content = str_ireplace('<textarea', '<textarea data-errors="comment-validation" data-msg-required="Please enter a comment"', $content);
  $content = str_ireplace('</p>', '<span id="comment-validation" class="validation"></span></p>', $content);
  return $content;
}

/* Author field
 * jQuery Validation automatically adds aria-invalid and aria-describedby when invalid
 * Add custom container for errors
 * Use custom error message rather than "This field is required"
 */
add_filter( 'comment_form_field_author', 'wpdtrt_comment_form_field_author__validation' );

function wpdtrt_comment_form_field_author__validation( $content ) {
  $content = str_ireplace('<input', '<input data-errors="author-validation" data-msg-required="Please enter your name"', $content);
  $content = str_ireplace('</p>', '<span id="author-validation" class="validation"></span></p>', $content);
  return $content;
}

/* Email field
 * jQuery Validation automatically adds aria-invalid and aria-describedby when invalid (and handles multiple aria-describedby values)
 * Add custom container for errors
 * Use custom error message rather than "This field is required"
 */
add_filter( 'comment_form_field_email', 'wpdtrt_comment_form_field_email__validation' );

function wpdtrt_comment_form_field_email__validation( $content ) {
  $content = str_ireplace('<input', '<input data-errors="email-validation" data-msg-required="Please enter a valid email address"', $content);
  $content = str_ireplace('</p>', '<span id="email-validation" class="validation"></span></p>', $content);
  return $content;
}

?>