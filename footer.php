<?php
/**
 * The template for displaying the page footer
 * Use the wp_footer() call, just before closing body tag.
 *
 * @package WPDTRT
 * @since 0.1.0
 * @see https://codex.wordpress.org/Theme_Development
 */

?>
		</div>
		<!-- /#wrapper -->

		<?php
		if ( has_nav_menu( 'header-menu' ) ) {
			get_template_part( 'template-parts/navigation/navigation', 'footer' );
		}

		wp_footer();
		?>
	</body>
</html>
