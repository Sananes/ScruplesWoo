<?php if(!defined('ABSPATH')) exit; // Exit if accessed directly
/*
Plugin Name: Aelia Foundation Classes for WooCommerce
Description: This plugin implements common classes for other WooCommerce plugins developed by Aelia.
Author: Aelia
Author URI: http://aelia.co
Version: 1.5.4.150316
*/

require_once(dirname(__FILE__) . '/src/lib/classes/install/aelia-wc-afc-requirementscheck.php');

// If requirements are not met, deactivate the plugin
if(Aelia_WC_AFC_RequirementsChecks::factory()->check_requirements()) {
	require_once dirname(__FILE__) . '/src/plugin-main.php';

	// Check for plugin updates
	Aelia\WC\WC_AeliaFoundationClasses::instance()->check_for_updates(__FILE__);
}
