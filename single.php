<?php
/**
 * The template for displaying a Single Post
 * ------------------------
 * Include wp_link_pages() to support navigation links within a post.
 * Display post title and post content.
 * The title should be plain text instead of a link pointing to itself.
 * Display the post date.
 * Respect the date and time format settings unless it's important to the design.
 * (User settings for date and time format are in Administration Panels > Settings > General).
 * For output based on the user setting, use the_time( get_option( 'date_format' ) ).
 * Display the author name (if appropriate).
 * Display post categories and post tags.
 * Display an "Edit" link for logged-in users with edit permissions.
 * Display comment list and comment form.
 * Show navigation links to next and previous post using previous_post_link() and next_post_link().
 *
 * @link https://codex.wordpress.org/Theme_Development
 *
 * @package WPDTRT
 * @since 0.1.0
 * @version 0.1.0
 */
?>
<?php get_header(); ?>

                <main class="page">

                    <?php while ( have_posts() ) : the_post();

                        get_template_part( 'template-parts/post/content', get_post_format() );

                    ?>


                </main>

                <aside>
                    <?php get_sidebar('widget-tests'); ?>
                </aside>

                <?php endwhile ?>

<?php get_footer(); ?>
