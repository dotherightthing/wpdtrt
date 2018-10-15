<?php
/**
 * The template for displaying the page footer
 * Use the wp_footer() call, just before closing body tag.
 *
 * @link https://codex.wordpress.org/Theme_Development
 *
 * @package WPDTRT
 * @since 0.1.0
 * @version 0.1.0
 */
?>

            </div>
            <!-- /#wrapper -->

			<?php if ( has_nav_menu( 'header-menu' ) ) : ?>
                <?php get_template_part( 'template-parts/navigation/navigation', 'footer' ); ?>
            <?php endif; ?>

        <?php wp_footer(); ?>
    </body>
</html>
