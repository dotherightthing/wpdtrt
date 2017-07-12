<?php
/**
 * Include the TGM_Plugin_Activation class.
 *
 * @link http://tgmpluginactivation.com/download/
 * @link http://tgmpluginactivation.com/configuration/
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme DTRT Framework - Theme
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */
require_once get_template_directory() . '/inc/tgm-plugin-activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'wp_dtrt_fwt__register_required_plugins' );

/**
 * Register the required plugins for this theme.
 * @see includes/tgm-plugin-activation/example.php
 */
function wp_dtrt_fwt__register_required_plugins() {
  /*
   * Array of plugin arrays. Required keys are name and slug.
   * If the source is NOT from the .org repo, then source is also required.
   */
  $plugins = array(

    // Plugins from the WordPress Plugin Repository.
    // ---------------------------------------------

    // Spam & SEO
    array(
      'name'      => 'Akismet',
      'slug'      => 'akismet',
      'required'  => false,
    ),

    // Debugging & Maintenance
    array(
      'name'      => 'Maintenance Switch',
      'slug'      => 'maintenance-switch',
      'required'  => false,
    ),

    // Theme integrity
    array(
      'name'      => 'Theme Check',
      'slug'      => 'theme-check',
      'required'  => false,
    ),

    // Backups and Migration
    array(
      'name'      => 'UpdraftPlus WordPress Backup Plugin',
      'slug'      => 'updraftplus',
      'required'  => true,
    ),

  );

  /*
   * Array of configuration settings. Amend each line as needed.
   *
   * TGMPA will start providing localized text strings soon. If you already have translations of our standard
   * strings available, please help us make TGMPA even better by giving us access to these translations or by
   * sending in a pull-request with .po file(s) with the translations.
   *
   * Only uncomment the strings in the config array if you want to customize the strings.
   */
  $config = array(
    'id'           => 'wp-dtrt-fwt',           // Unique ID for hashing notices for multiple instances of TGMPA.
    'default_path' => '',                      // Default absolute path to bundled plugins.
    'menu'         => 'tgmpa-install-plugins', // Menu slug.
    'parent_slug'  => 'themes.php',            // Parent menu slug.
    'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
    'has_notices'  => true,                    // Show admin notices or not.
    'dismissable'  => false,                   // If false, a user cannot dismiss the nag message.
    'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
    'is_automatic' => true,                    // Automatically activate plugins after installation or not.
    'message'      => '',                      // Message to output right before the plugins table.
  );

  tgmpa( $plugins, $config );
}
?>