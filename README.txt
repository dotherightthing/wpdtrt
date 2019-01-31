=== DTRT Framework - Theme ===
Contributors: dotherightthingnz
Requires at least: WordPress 4.8
Tested up to: WordPress 4.8
Version: 0.2.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Donate link: http://dotherightthing.co.nz

== Description ==

A framework for WordPress themes.

1. This framework theme (`wpdtrt_parent`) contains generic templating, functionality, and documentation.
2. Framework child themes (`wpdtrt_child`) may be built on top of this theme.
3. Generic theme functionality deemed appropriate to plugins will be promoted to framework helper plugins (`wpdtrt_pluginhelper_foo`). These can then be used with themes or in tandem with specialised plugins.
4. Specialised plugins (`wpdtrt_plugin_bar`) can use Framework Helper plugins.

== Known Issues ==

= Theme Review =

In order to be publish-able to the WordPress theme directory, strict criteria need to be met. This is optional for custom themes, but it is best practice:

1. Non-design related functionality is not allowed in a theme ([Required](https://make.wordpress.org/themes/handbook/review/required/)) - this means that most helpers need to be moved into plugins, especially custom post types and taxonomies
1. Translation function calls must NOT contain PHP variables (theme-check plugin) - this makes it impossible to build function wrappers

== Installation ==

1. In your admin panel, go to Appearance -> Themes
2. Locate DTRT Framework - Theme and click on the 'Activate' button

== Changelog ==

= 0.2.6 =
* Add missing wpdtrt-dbth templates to release

= 0.2.5 =
* Include twentysixteen and icons in release

= 0.2.4 =
* Fixes to support running of Gulp tasks in wpdtrt-dbth's CI (Bitbucket Pipelines)

= 0.2.3 =
* Enable release zip generation

= 0.2.2 =
* Migrate sticky nav code to wpdtrt-anchorlinks
* Migrate attachment fields to wpdtrt-exif
* Migrate image quality settings to wpdtrt-gallery
* Migrate weather to wpdtrt-weather
* Migrate weather dependencies to wpdtrt-weather
* Migrate from Bower & NPM to Yarn, to resolve Gulp compile issues in child themes
* Add ACF JSON load point, document dependencies
* Add linting & formatting
* Remove compiled files
* Compile correct files to ES5
* Fix path to self when loaded as a Composer dependency (so that NPM scripts can be run in a Bitbucket pipeline)
* Replace Travis check with generic CI check
* Use appropriate import paths for WordPress and CI
* Skip WordPress VIP sniffs
* Generate scss source maps to aid debugging, log errors rather than halting task
* Watch for changes in nested scss files too
* Remove permalink placeholder replacement, as it prevents plugin-based replacement from taking place (https://github.com/dotherightthing/wpdtrt-tourdates/issues/27)
* Change comments heading
* Update dependencies
* Documentation
* Linting fixes (#3)
* Update file list for release_copy (#5)

= 0.2.1 =
* (Bump version)

= 0.2.0 =
* Remove custom meta which is now handled by wpdtrt-gallery
* Add 'heading' above attachment field

= 0.1.5 =
* Hot fix for missing wpdtrt_thumbnail_queryparams
* Remove functions that are now in wpdtrt-exif
* Change bower install directory
* Disable buggy DIY GTM

= 0.1.4 =
* Add sidebar for testing widgets
* Remove stray endif

= 0.1.3 =
* Disable Darksky
* Don't minify files, as it prevents Autoptimise from processing them
* Simplify JavaScript

= 0.1.2 =
* Fix variable name

= 0.1.1 =
* Add optional link to featured image (requires ACF setup - see Hands Of Light)

= 0.1.0 =
* Generator output & README
* Accessibility - Add Accessibility styles
* Build - Use Gulp to compile, concatenate and minify theme resources, use postcss, convert px to rems via gulpfile, minify CSS using CSSO
* Content - Disable site-specific content filters
* CSS - Tidy up CSS loading and document running from child theme
* Custom post type & taxonomy wrappers, assign taxonomy terms supplied when setting up taxonomy, match DBTH implementation
* Debugging - Add Query Monitor plugin
* Documentation
* Images - Added GPS field to the media uploader - this is either populated with the image EXIF GPS, or with a user added value
* JavaScript - Add js and no-js hooks, use vanilla JS to toggle nojs hook more quickly
* JavaScript - Move WP jQuery script includes to footer
* Layout - Add viewport meta tag
* Layout - Use twentysixteen editor styles to better present galleries
* Logic - Add functionality and common modules from WPDTRT DBTH
* Maps - Copied relevant functions over from WPAGM (to be tidied up)
* Maps - Migrate map functionality to wpdtrt-maps
* Menus - Remove generic wrappers around navigation
* Menus - Output custom nav in user-specified order, add duplicate nav to footer
* Misc - Remove site-specific customisations from page header
* Misc - Fix Updraft Plus plugin loading
* PHP - Check that functions don't already exist
* Rewrite - Use starter templates rather than function wrappers, to better manage rewrite options
* SEO - Add Google Tag Manager and options page to capture container ID
* Shortcodes - Featured Image, Leaflet Map
* Taxonomy - Helper function to replace hierarchical %taxonomy% placeholders in permalinks
* Templates - Add page template
* TGMPA - Add plugin dependencies and recommendations
* Theme Check - Use wpdtrt consistently as text domain (theme-check plugin: More than one text-domain is being used in this theme)
* Theme Check - Wrap concatenated language strings/variables in brackets to prevent array keys from being treated like text domains (theme-check plugin: More than one text-domain is being used in this theme)
* Theme Check - Use wpdtrt_ as prefix, rather than wpdtrt__ (http://themereview.co/prefix-all-the-things/)
* Theme Check - Remove illegal tags from style.css (theme-check plugin: Found wrong tag, remove framework from your style.css header)
* Theme Check - Add header.php (theme-check plugin: Could not find language_attributes. Could not find body_class call in body tag)
* Theme Check - Remove @ini_set from wp-config; (theme-check plugin: Themes should not change server PHP settings)
* Theme Check - Use WordPress.org settings with TGM plugin (theme-check plugin: Themes should use add_theme_page() for adding admin pages. More than one text-domain is being used in this theme.)
