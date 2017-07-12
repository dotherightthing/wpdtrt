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
 * @package DTRT Framework - Theme
 * @since 0.1.0
 * @version 0.1.0
 */
?>
<?php get_header(); ?>

                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <main>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <header>
                            <h1><?php the_title(); ?></h1>
                        </header>

                        <p>Published <?php the_modified_date('d F Y'); ?>

                        <?php
                            /**
                             * Tags
                             * @link https://wordpress.org/plugins/theme-check/
                             */
                            the_tags( '<p>Tagged with:</p><ul><li>', '</li><li>', '</li></ul>' );
                        ?>

                        <?php the_excerpt(); ?>

                        <?php the_content(); ?>

                        <?php
                            /**
                             * Link pages
                             * @link https://make.wordpress.org/themes/handbook/review/required/#templates
                             */
                            wp_link_pages( array(
                                'before'      => '<div class="page-links">' . __( 'Pages:', 'wp-dtrt-fwt' ),
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

                    </article>

                </main>

                <aside>
                    <?php get_sidebar('sidebar-1'); ?>
                </aside>

                <?php endwhile ?>

                <?php endif; ?>

<?php get_footer(); ?>
