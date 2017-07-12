<?php
/**
 * The template for displaying Search Results, and the search term which generated the results
 * Displays a list of posts in excerpt or full-length form.
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

    <?php
        // http://www.wpbeginner.com/wp-tutorials/display-search-term-and-result-count-in-wordpress/
        // https://codex.wordpress.org/Creating_a_Search_Page
        global $wp_query;
    ?>

                <main>

                    <header>
                        <h1>Search Results</h1>
                    </header>

                    <div class="excerpt">
                        <p>There were <?php echo $wp_query->found_posts; ?> results for &quot;<?php echo get_search_query(); ?>&quot;:</p>
                    </div>

                    <?php the_content(); ?>

                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

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
                        'prev_text' =>  '<span class="screen-reader-text">' . __( 'Previous page', 'wp-dtrt-fwt' ) . '</span>',
                        'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'wp-dtrt-fwt' ) . '</span>' ,
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'wp-dtrt-fwt' ) . ' </span>',
                    ) );

                    else: ?>

                    <h2>Sorry</h2>

                    <p>We didn't find anything.</p>

                    <?php endif; ?>

                </main>

                <aside>
                    <?php get_sidebar(); ?>
                </aside>

<?php get_footer(); ?>
