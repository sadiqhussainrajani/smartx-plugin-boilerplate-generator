<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the
 * plugin admin area. This file also includes all of the dependencies used by
 * the plugin, registers the activation and deactivation functions, and defines
 * a function that starts the plugin.
 * 
 * @wordpress-plugin
 * Plugin Name:       Smartx Plugin Boilerplate
 * Plugin URI:        https://github.com/sadiqhussainrajani/smartx-plugin-boilerplate
 * Description:       This is a Boilerplate plugin to create OOP based plugin in Wordpress with namespaces and composer for autoload classes.
 * Version:           1.0
 * Author:            Sadiq Hussain Rajani
 * Author URI:        https://github.com/sadiqhussainrajani/
 * License:           GPL v3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.en.html
 * Text Domain:       smartx-plugin-boilerplate
 * Domain Path:       /languages
 */

use Smartx_Plugin_Boilerplate\Initialize as Init;
use Smartx_Plugin_Boilerplate\Activator as Activator;
use Smartx_Plugin_Boilerplate\Deactivator as Deactivator;
use Smartx_Plugin_Boilerplate\Uninstaller as Uninstaller;
use Smartx_Plugin_Boilerplate\Helper as Helper;

/**
 * Define Base Path and Url
 */
define('SPB_PLUGIN_PATH',plugin_dir_path(__FILE__));
define('SPB_PLUGIN_URL',plugin_dir_url(__FILE__));

/**
 * Include Composer Autoload to include all classes from inc/classes
 */
include_once(SPB_PLUGIN_PATH.'vendor/autoload.php');

/**
 * Define Constants
 */
define('SPB_PREFIX','spb_');
define('SPB_VERSION','1.0');
define('SPB_PLUGIN_NAME','smartx_plugin_boilerplate');
define('SPB_PLUGIN_TITLE',Helper::getHumanFriendly(SPB_PLUGIN_NAME));
define('SPB_TEXT_DOMAIN',Helper::getSlug(SPB_PLUGIN_NAME));
define('SPB_AJAX_URL',admin_url('admin-ajax.php'));


/**
 * Plugin Activate Event Handler
 *
 * @since   1.0
 */
$activator = new Activator;
register_activation_hook( __FILE__, array($activator,'onActivate') );

/**
 * Plugin Deactivate Event Handler
 *
 * @since   1.0
 */
$deactivator = new Deactivator;
register_deactivation_hook( __FILE__, array($deactivator,'onDeactivate') );

/**
 * Plugin Uninstall Event Handler
 *
 * @since   1.0
 */
$uninstaller = new Uninstaller;
register_uninstall_hook( __FILE__, array($uninstaller,'onUninstall') );

/**
 * Inititalize the plugin to load all dependencies and hooks and run shortcodes.
 */
$init = new Init;
$init->run();