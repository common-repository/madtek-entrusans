<?php

/**
 *
 * This purpose of this file is to follow the standard WordPress plugin guidelines to deliver
 * the MadTek Entrusans(tm) Intrusion Detection Service as a WordPress plugin.
 *
 * @link              https://madtek.com
 * @since             1.6.2
 * @package           madtek-entrusans
 *
 * @wordpress-plugin
 * Plugin Name:       MadTek Entrusans&trade; Intrusion Detection Service 
 * Plugin URI:        https://madtek.com
 * Description:       This plugin is the Wordpress Entrusans IDS Client component of the Entrusans Intrusion Detection Service.
 * Version:           2.0.6
 * Author:            jeemadtek.com
 * Author URI:        https://madtek.com/
 * License:           GPL v2 or later
 * Text Domain:       madtek-entrusans
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-madtek-entrusans-activator.php
 */
function activate_madtek_entrusans() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-madtek-entrusans-activator.php';
	Madtek_Entrusans_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-madtek-entrusans-deactivator.php
 */
function deactivate_madtek_entrusans() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-madtek-entrusans-deactivator.php';
	Madtek_Entrusans_Deactivator::deactivate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-madtek-entrusans-deactivator.php
 */
function uninstall_madtek_entrusans() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-madtek-entrusans-uninstall.php';
	Madtek_Entrusans_Uninstall::uninstall();
}

register_activation_hook( __FILE__, 'activate_madtek_entrusans' );
register_deactivation_hook( __FILE__, 'deactivate_madtek_entrusans' );
register_uninstall_hook( __FILE__, 'uninstall_madtek_entrusans' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-madtek-entrusans.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_madtek_entrusans() {

	$plugin = new Madtek_Entrusans();
	$plugin->run();

}

run_madtek_entrusans();

?>
