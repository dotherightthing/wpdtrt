<?php
/**
 * Displays footer navigation
 *  This is a duplicate of header navigation,
 *  which is shown on mobile devices
 *  when JS is disabled.
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Theme Templates
 * @since 0.1.0
 * @version 0.1.0
 */

?>
<nav role="navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'wpdtrt' ); ?>">
    <?php
        /**
         * wp_page_menu: 2.7.0+
         * wp_nav_menu: 3.0.0+
         */
        wp_nav_menu( array(
            /**
             * Apply Appearance > Menus > Menu Structure
             * otherwise fallback_cb is used
             */
            'menu' => 'header-menu', // intentional duplicate to use same source
            'container' => 'div',
            'container_class' => '',
            'container_id' => 'footer-nav',
            'menu_class' => 'navigation',
            'menu_id' => '',
            'echo' => true,
            /**
             * wp_page_menu() is sorted alphabetically
             */
            'fallback_cb' => 'wp_page_menu',
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'item_spacing' => 'preserve',
            'depth' => 0,
            'walker' => '',
            /**
             * Theme location must be registered with register_nav_menu()
             * in order to be selectable by the user.
             * @todo why does this work when the full text is
             * "Footer Menu (mobile-first noscript fallback)"
             */
            'theme_location' => 'Footer Menu',
         ) );
    ?>
</nav>
