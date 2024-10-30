<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://madtek.com
 * @since      1.0.0
 *
 * @package    madtek-entrusans
 * @subpackage madtek-entrusans/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    madtek-entrusans
 * @subpackage madtek-entrusans/includes
 * @author     jeemadtekcom
 */
class Madtek_Entrusans_Deactivator {

	/**
	 * Short Description. (TBD)
	 *
	 * Long Description. (TBD)
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
      global $wpdb;
      update_option( 'madtek_entrusans_status', 'deactivated');

	}

}
