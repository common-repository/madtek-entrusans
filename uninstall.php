<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * @link       http://madtek.com
 * @since      1.0.0
 *
 * @package    madtek-entrusans
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
  die;
}  
    // Clean up wp_options

    global $wpdb;
    delete_option( 'madtek_entrusans_status' );
    delete_option( 'madtek_entrusans_domain' );
    delete_option( 'madtek_entrusans_cpbk' );
    delete_option( 'madtek_entrusans_spvk' );
    delete_option( 'madtek_entrusans_license' );


