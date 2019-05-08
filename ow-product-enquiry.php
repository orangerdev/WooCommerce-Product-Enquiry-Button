<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://ridwan-arifandi.com/
 * @since             1.1.0
 * @package           Od_Product_Enquiry
 *
 * @wordpress-plugin
 * Plugin Name:       Orangrdev - Product Enquiry Button fo WooCommerce
 * Plugin URI:        https://ridwan-arifandi.com/portfolio/product-enquiry-button-for-woocommerce/
 * Description:       Display call-to-action button in single WooCommerce product page
 * Version:           1.1.0
 * Author:            Ridwan Arifandi
 * Author URI:        https://ridwan-arifandi.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       od-product-enquiry
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'OD_PRODUCT_ENQUIRY_VERSION', '1.0.0' );
define( 'OD_PRODUCT_ENQUIRY_DIR'	, plugin_dir_path(__FILE__));
define( 'OD_PRODUCT_ENQUIRY_URL'	, plugin_dir_url(__FILE__));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ow-product-enquiry-activator.php
 */
function activate_ow_product_enquiry() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ow-product-enquiry-activator.php';
	Od_Product_Enquiry_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ow-product-enquiry-deactivator.php
 */
function deactivate_ow_product_enquiry() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ow-product-enquiry-deactivator.php';
	Od_Product_Enquiry_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ow_product_enquiry' );
register_deactivation_hook( __FILE__, 'deactivate_ow_product_enquiry' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ow-product-enquiry.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ow_product_enquiry() {

	$plugin = new Od_Product_Enquiry();
	$plugin->run();

}
run_ow_product_enquiry();

if(!function_exists('__debug')) :

function __debug()
{
	$bt     = debug_backtrace();
	$caller = array_shift($bt);
	?><pre class='debug'><?php
	print_r([
		"file"  => $caller["file"],
		"line"  => $caller["line"],
		"args"  => func_get_args()
	]);
	?></pre><?php
}
endif;
