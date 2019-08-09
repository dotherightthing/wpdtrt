<?php
/**
 * The template for displaying Search Results, and the search term which generated the results
 * Displays a list of posts in excerpt or full-length form.
 *
 * @package WPDTRT
 * @since 0.1.0
 * @see https://codex.wordpress.org/Template_Hierarchy
 * @see https://codex.wordpress.org/Theme_Development
 */

get_header();

// http://www.wpbeginner.com/wp-tutorials/display-search-term-and-result-count-in-wordpress/.
// https://codex.wordpress.org/Creating_a_Search_Page.
global $wp_query;
?>
<main>
	<header>
		<h1>Search Results</h1>
	</header>
	<div class="excerpt">
		<p>There were <?php echo $wp_query->found_posts; ?> results for &quot;<?php echo get_search_query(); ?>&quot;:</p>
	</div>
	<?php
	the_content();
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>
	<div>
		<h2>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
			<?php
			the_excerpt();
			?>
		<p>
			<?php
			if ( is_search() ) {
				the_category( ', ' );
			}
			?>
		</p>
	</div>
			<?php
		endwhile;
		/**
		* Post pagination
		*
		* @see https://make.wordpress.org/themes/handbook/review/required/#templates
		*/
		the_posts_pagination( array(
			'prev_text'          => '<span class="screen-reader-text">' . __( 'Previous page', 'wpdtrt' ) . '</span>',
			'next_text'          => '<span class="screen-reader-text">' . __( 'Next page', 'wpdtrt' ) . '</span>',
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'wpdtrt' ) . ' </span>',
		) );

		else :
			?>

	<h2>Sorry</h2>
	<p>We didn't find anything.</p>
			<?php
	endif;
		?>
</main>
<aside>
	<?php get_sidebar(); ?>
</aside>
<?php get_footer(); ?>
