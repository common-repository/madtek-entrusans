<?php

/**
 * Fired during plugin uninstall 
 *
 * @link       http://madtek.com
 * @since      1.0.0
 *
 * @package    madtek-entrusans
 * @subpackage madtek-entrusans/includes
 */

/**
 * Fired during plugin uninstall.
 *
 * This class defines all code necessary to run during the plugin's uninstall.
 *
 * @since      1.0.0
 * @package    madtek-entrusans
 * @subpackage madtek-entrusans/includes
 * @author     jeemadtekcom
 */
class Madtek_Entrusans_Uninstall {

	/**
	 * Short Description.
     *  Remove Entrusans options from the wp-options table.
	 *
	 * Long Description. (TBD)
	 *
	 * @since    1.0.0
	 */
	public static function uninstall() {

      global $wpdb;

      delete_option( 'madtek_entrusans_status' );
      delete_option( 'madtek_entrusans_domain' );
      delete_option( 'madtek_entrusans_cpbk' );
      delete_option( 'madtek_entrusans_spvk' );
      delete_option( 'madtek_entrusans_license' );

	}

}
