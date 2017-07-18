<?php
/**
 * Remove “Category:”, “Tag:”, “Author:” from the_archive_title
 * Src: http://wordpress.stackexchange.com/questions/179585/remove-category-tag-author-from-the-archive-title
 */

add_filter( 'get_the_archive_title', function ($title) {

  if ( is_category() ) {

    // Category_name
    $title = single_cat_title( '', false );

  }
  elseif ( is_tag() ) {

    // Category_name/Tag_name
    $category = get_the_category();
    $title = single_tag_title( $category[0]->name . '/', false );

  }
  elseif ( is_author() ) {

    $title = '<span class="vcard">' . get_the_author() . '</span>' ;

  }

  return $title;

});
?>