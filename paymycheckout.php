<?php


/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wordpress.org/plugins/paymycheckout 
 * @since             1.0.1
 * @package           paymycheckout
 *
 * @wordpress-plugin
 * Plugin Name:       paymycheckout
 * Plugin URI:        
 * Description:       This is a simple Mobile Money (Tigopesa) WooCommerce payment gateway that allows customers to send the shop owner the payment on mobile phone number.
 * Version:           1.0.1
 * Author:            Emmanuel Mnzava
 * Author URI:        https://profiles.wordpress.org/epmnzava
 * License:           GPLv3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.txt
 * Requires at least: 5.4
 * Requires PHP: 7.0
 * Text Domain:       paymycheckout
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('paymycheckout_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-paymycheckout-activator.php
 */
function activate_paymycheckout()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-paymycheckout-activator.php';
	paymycheckout_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-paymycheckout-deactivator.php
 */
function deactivate_paymycheckout()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-paymycheckout-deactivator.php';
	paymycheckout_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_paymycheckout');
register_deactivation_hook(__FILE__, 'deactivate_paymycheckout');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-paymycheckout.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_paymycheckout()
{

	$plugin = new paymycheckout();
	$plugin->run();
}
run_paymycheckout();
