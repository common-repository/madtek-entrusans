<?php

/**
 * Fired during plugin activation
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
class Madtek_Entrusans_Activator {

	/**
	 * Short Description.
     *  Drop the madtek.com domain in the wp_options table for later use.
	 *
	 * Long Description. (TBD)
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

      global $wpdb;

      update_option( 'madtek_entrusans_domain', 'madtek.com' );
      update_option( 'madtek_entrusans_status', 'activated' );


	}

}
