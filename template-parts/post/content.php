<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package DTRT Framework - Theme
 * @since 0.1.0
 * @version 0.1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="page-header">
        <h1><?php the_title(); ?></h1>
        <p>Published <?php the_modified_date('d F Y'); ?>
       <?php
            /**
             * Tags
             * @link https://wordpress.org/plugins/theme-check/
             */
            the_tags( '<p>Tagged with:</p><ul><li>', '</li><li>', '</li></ul>' );
        ?>
    </header>
    <div class="page-body">
        <?php the_excerpt(); ?>

        <?php the_content(); ?>

        <?php
            /**
             * Link pages
             * @link https://make.wordpress.org/themes/handbook/review/required/#templates
             */
            wp_link_pages( array(
                'before'      => '<div class="page-links">' . __( 'Pages:', 'wpdtrt' ),
                'after'       => '</div>',
                'link_before' => '<span class="page-number">',
                'link_after'  => '</span>',
            ) );

            /**
             * Comments
             * @link https://make.wordpress.org/themes/handbook/review/required/#core-functionality-and-features
             */
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
        ?>
    </div>

</article>