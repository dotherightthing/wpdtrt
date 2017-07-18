<?php
/**
 * Document Head (header.php)
 * ------------------------
 * Use the proper DOCTYPE.
 * The opening <html> tag should include language_attributes().
 * The <meta> charset element should be placed before everything else, including the <title> element.
 * Use bloginfo() to set the <meta> charset and description elements.
 * Use wp_title() to set the <title> element.
 * Use Automatic Feed Links to add feed links.
 * Add a call to wp_head() before the closing </head> tag. Plugins use this action hook
 * to add their own scripts, stylesheets, and other functionality.
 * Do not link the theme stylesheets in the Header template. Use the wp_enqueue_scripts action hook
 * in a theme function instead.
 *
 * Src: https://codex.wordpress.org/Theme_Development
 *
 * Notes:
 * The title tag is injected by WordPress since 4.1 - https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
 */

?><!DOCTYPE html>
<html <?php language_attributes() ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div id="wrapper">
            <header class="banner-logo widget">
                <p class="h1-like">
                    <a href="/">
                        <abbr title="<?php echo get_option( 'blogname' ); ?>" id="customizer-site_title_short"><?php echo get_theme_mod( 'site_title_short' ); ?></abbr>
                    </a>
                </p>
            </header>
            <div class="banner-subgrid">
                <?php dynamic_sidebar('header-center'); ?>
            </div>
