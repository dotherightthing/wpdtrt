<?php
/**
 * The template for displaying tag, category, date-based, or author archives
 * Displays a list of posts in excerpt or full-length form.
 * Include wp_link_pages() to support navigation links within posts.
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

                <main id="main">

                    <h1><?php the_archive_title(''); ?></h1>

                    <?php the_content(); ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                    <div>
                        <h2>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <?php the_excerpt(); ?>
                        <p>
                            <?php
                                if ( is_search() ) {
                                    the_category(', ');
                                }
                            ?>
                        </p>
                    </div>

                    <?php endwhile;
                    /**
                     * Post pagination
                     * @link https://make.wordpress.org/themes/handbook/review/required/#templates
                     */
                    the_posts_pagination( array(
                      'prev_text' => '<span class="screen-reader-text">' . __( 'Previous page', 'wp-dtrt-fwt' ) . '</span>',
                      'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'wp-dtrt-fwt' ) . '</span>',
                      'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'wp-dtrt-fwt' ) . ' </span>',
                    ) );

                    ?>

                </main>

                <aside>
                    <?php get_sidebar(); ?>
                </aside>

<?php get_footer(); ?>
