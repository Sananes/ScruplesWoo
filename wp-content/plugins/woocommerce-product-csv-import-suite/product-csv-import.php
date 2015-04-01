<?php
/*
Plugin Name: WooCommerce Product CSV Import Suite
Plugin URI: http://woothemes.com/woocommerce/
Description: Import and export products and variations straight from WordPress admin. Go to WooCommerce > CSV Import Suite to get started. Supports post fields, product data, custom post types, taxonomies, and images.
Author: Mike Jolley / WooThemes
Author URI: http://mikejolley.com
Version: 1.9.8
Text Domain: wc_csv_importer

	Copyright: © 2009-2014 WooThemes.
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html

	Adapted from the WordPress post importer by the WordPress team
*/

if ( ! defined( 'ABSPATH' ) || ! is_admin() ) {
	return;
}

/**
 * Required functions
 */
if ( ! function_exists( 'woothemes_queue_update' ) ) {
	require_once( 'woo-includes/woo-functions.php' );
}

/**
 * Plugin updates
 */
woothemes_queue_update( plugin_basename( __FILE__ ), '7ac9b00a1fe980fb61d28ab54d167d0d', '18680' );

/**
 * Check WooCommerce exists
 */
if ( ! is_woocommerce_active() ) {
	return;
}

if ( ! class_exists( 'WC_Product_CSV_Import_Suite' ) ) :

/**
 * Main CSV Import class
 */
class WC_Product_CSV_Import_Suite {

	/**
	 * Constructor
	 */
	public function __construct() {
		define( 'WC_PCSVIS_FILE', __FILE__ );

		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
		add_action( 'init', array( $this, 'catch_export_request' ), 20 );
		add_action( 'admin_init', array( $this, 'register_importers' ) );
		
		include_once( 'includes/class-wc-pcsvis-system-status-tools.php' );
		include_once( 'includes/class-wc-pcsvis-admin-screen.php' );
		include_once( 'includes/importer/class-wc-pcsvis-importer.php' );

		if ( defined('DOING_AJAX') ) {
			include_once( 'includes/class-wc-pcsvis-ajax-handler.php' );
		}
	}

	/**
	 * Handle localisation
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'wc_csv_import', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Catches an export request and exports the data. This class is only loaded in admin.
	 */
	public function catch_export_request() {
		if ( ! empty( $_GET['action'] ) && ! empty( $_GET['page'] ) && $_GET['page'] == 'woocommerce_csv_import_suite' ) {
			switch ( $_GET['action'] ) {
				case "export" :
					include_once( 'includes/exporter/class-wc-pcsvis-exporter.php' );
					WC_PCSVIS_Exporter::do_export( 'product' );
				break;
				case "export_variations" :
					include_once( 'includes/exporter/class-wc-pcsvis-exporter.php' );
					WC_PCSVIS_Exporter::do_export( 'product_variation' );
				break;
			}
		}
	}

	/**
	 * Register importers for use
	 */
	public function register_importers() {
		register_importer( 'woocommerce_csv', 'WooCommerce Products (CSV)', __('Import <strong>products</strong> to your store via a csv file.', 'wc_csv_import'), 'WC_PCSVIS_Importer::product_importer' );

		register_importer( 'woocommerce_variation_csv', 'WooCommerce Product Variations (CSV)', __('Import <strong>product variations</strong> to your store via a csv file.', 'wc_csv_import'), 'WC_PCSVIS_Importer::variation_importer' );
	}
}
endif;

new WC_Product_CSV_Import_Suite();