<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://ridwan-arifandi.com/
 * @since      1.0.0
 *
 * @package    Od_Product_Enquiry
 * @subpackage Od_Product_Enquiry/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Od_Product_Enquiry
 * @subpackage Od_Product_Enquiry/includes
 * @author     Ridwan Arifandi <orangerdigiart@gmail.com>
 */
class Od_Product_Enquiry_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'od-product-enquiry',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
