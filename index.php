<?php
/**
 * The template for displaying post title and content.
 * Include wp_link_pages() to support navigation links within a post.
 * The title should be plain text instead of a link pointing to itself.
 * Display the post date.
 * Respect the date and time format settings unless it's important to the design.
   (User settings for date and time format are in Administration Panels > Settings > General).
 * For output based on the user setting, use the_time( get_option( 'date_format' ) ).
 * Display the author name (if appropriate).
 * Display post categories and post tags.
 * Display an "Edit" link for logged-in users with edit permissions.
 * Display comment list and comment form.
 * Show navigation links to next and previous post using previous_post_link() and next_post_link().
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @link https://codex.wordpress.org/Theme_Development
 *
 * @package DTRT Framework - Theme
 * @since 0.1.0
 * @version 0.1.0
 */
?>
<?php get_header(); ?>

                <main class="page">

                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                    <article>
                        <header class="page-header">
                            <h1><?php the_title(); ?></h1>
                        </header>
                        <div class="page-body">
                            <?php //the_excerpt(); ?>
                            <?php the_content(); ?>
                        </div>
                    </article>

                    <?php endwhile;
                    /**
                     * Post pagination
                     * @link https://make.wordpress.org/themes/handbook/review/required/#templates
                     */
                    the_posts_pagination( array(
                        'prev_text' => '<span class="screen-reader-text">' . __( 'Previous page', 'wpdtrt' ) . '</span>',
                        'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'wpdtrt' ) . '</span>',
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'wpdtrt' ) . ' </span>',
                    ) );

                    endif; ?>

                </main>

                <aside>
                    <?php get_sidebar(); ?>
                </aside>

<?php get_footer(); ?>
