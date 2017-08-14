<?php
/**
 * Document Head (header.php)
 * ------------------------
 * Use Automatic Feed Links to add feed links.
 *
 * Src: https://codex.wordpress.org/Theme_Development
 *
 * The title tag is injected by WordPress since 4.1 - https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
 */

?><!DOCTYPE html>
<html <?php language_attributes() ?> class="wpdtrt-nojs">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <?php get_template_part( 'template-parts/gtm/gtm', 'body' ); ?>
        <div id="wrapper">
            <header>
                <p class="accessible">
                    <a href="/"><?php echo get_option( 'blogname' ); ?></a>
                </p>
            </header>

            <div>
                <?php dynamic_sidebar('header-center'); ?>
            </div>

            <?php if ( has_nav_menu( 'header-menu' ) ) : ?>
                <div id="header-nav-wrapper">
                <?php echo do_shortcode( '[wpdtrt_responsive_nav header_nav_id="header-nav" footer_nav_id="footer-nav"]' ); ?>
                <?php get_template_part( 'template-parts/navigation/navigation', 'header' ); ?>
                </div>
            <?php endif; ?>
