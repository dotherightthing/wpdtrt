=== DTRT Framework - Theme ===
Contributors: dotherightthingnz
Requires at least: WordPress 4.8
Tested up to: WordPress 4.8
Version: 0.1.0
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

= 0.1.0 =
* Initial release
