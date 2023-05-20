<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://kedistkid723@gmail.com
 * @since             1.0.0
 * @package           Lounge_Managment
 *
 * @wordpress-plugin
 * Plugin Name:       Gursha
 * Plugin URI:        https://lounge-management
 * Description:       lounge management system with wordpress
 * Version:           1.0.0
 * Author:            Kedist
 * Author URI:        https://kedistkid723@gmail.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       lounge-managment
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


if (!defined("gursha"))
    define("gursha", "gursha");
if (!defined("gursha_PLAGIN_DIR"))
    define("gursha_PLAGIN_DIR", plugin_dir_path(__FILE__));
if (!defined("gursha_PLAGIN_URL"))
    define("gursha_PLAGIN_URL", plugin_dir_url(__FILE__));

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'LOUNGE_MANAGMENT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-lounge-managment-activator.php
 */
function activate_lounge_managment() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lounge-managment-activator.php';
	Lounge_Managment_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-lounge-managment-deactivator.php
 */
function deactivate_lounge_managment() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lounge-managment-deactivator.php';
	Lounge_Managment_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_lounge_managment' );
register_deactivation_hook( __FILE__, 'deactivate_lounge_managment' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-lounge-managment.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_lounge_managment() {

	$plugin = new Lounge_Managment();
	$plugin->run();

}
run_lounge_managment();
