<?php

namespace Od_Product_Enquiry;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://ridwan-arifandi.com/
 * @since      1.0.0
 *
 * @package    Od_Product_Enquiry
 * @subpackage Od_Product_Enquiry/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Od_Product_Enquiry
 * @subpackage Od_Product_Enquiry/admin
 * @author     Ridwan Arifandi <orangerdigiart@gmail.com>
 */
class Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 * Hooked via admin_enqueue_scripts, priority 999
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		// wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/od-product-enquiry-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 * Hooked via admin_enqueue_scripts, priority 999
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/od-product-enquiry-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Load carbon fields
	 * Hooked via after_setup_theme, priority 1
	 * @since    1.0.0
	 * @return void
	 */
	public function load_carbon_fields()
	{
		require_once(OD_PRODUCT_ENQUIRY_DIR.'vendor/autoload.php');
		\Carbon_Fields\Carbon_Fields::boot();
	}

	/**
	 * Display plugin setting
	 * Hooked via carbon_fields_register_fields, priority 1
	 * @since    1.0.0
	 * @return void
	 */
	public function display_setting()
	{
		Container::make('theme_options'	,__('OW Product Enquiry','od-product-enquiry'))
		->add_tab(__('Enquiry Content','od-product-enquiry'),[
			Field::make('html',		'owpe_shortcode')
				->set_html('
				 	<p><strong>Available Shortcodes</strong></p>
					<p>
						%%%SITENAME%%%, display the sitename <br />
					 	%%%PRODUCTNAME%%%, display the product name
					<p>
				'),
			Field::make('checkbox',	'owpe_email_active',	__('Activate Enquiry via Email','od-product-enquiry'))
				->set_default_value(true),
			Field::make('text',	'owpe_email_recipient',	__('Recipient Email','od-product-enquiry'))
				->set_conditional_logic([
					'relation'	=> 'AND',
					[
						'field'   => 'owpe_email_active',
						'value'   => true,
					]
				])
				->set_default_value(get_option('admin_email')),
			Field::make('text',		'owpe_email_title'	,	__('Email Title','od-product-enquiry'))
				->set_conditional_logic([
					'relation'	=> 'AND',
					[
						'field'   => 'owpe_email_active',
						'value'   => true
					]
				])
				->set_default_value('Enquiry about %%%PRODUCTNAME%%%'),
			Field::make('textarea',	'owpe_email_content',	__('Email Content','od-product-enquiry'))
				->set_conditional_logic([
					'relation'	=> 'AND',
					[
						'field'   => 'owpe_email_active',
						'value'   => true,
					]
				])
				->set_default_value('Please send me a quotation about %%%PRODUCTNAME%%%'),
			Field::make('text',	'owpe_email_text_button',	__('Text Button','od-product-enquiry'))
				->set_conditional_logic([
					'relation'	=> 'AND',
					[
						'field'   => 'owpe_email_active',
						'value'   => true,
					]
				])
				->set_default_value('Need more detail about this product'),
			Field::make('color',	'owpe_email_button_color',	__('Button Color','od-product-enquiry'))
				->set_conditional_logic([
					'relation'	=> 'AND',
					[
						'field'   => 'owpe_email_active',
						'value'   => true,
					]
				])
				->set_default_value('#eeeeee')
				->set_width(50),
			Field::make('color',	'owpe_email_text_button_color',	__('Text Button Color','od-product-enquiry'))
				->set_conditional_logic([
					'relation'	=> 'AND',
					[
						'field'   => 'owpe_email_active',
						'value'   => true,
					]
				])
				->set_default_value('#000000')
				->set_width(50)
		])
		->add_tab(__('Configuration','od-product-enquiry'),[
			Field::make('select',	'owpe_display_enquiry_buttons',	__('Where to display enquiry buttons','od-product-enquiry'))
				->add_options([
					''						 => __('Display manually by shortcode','od-product-enquiry'),
					'before_product_title'   => __('Before product title','od-product-enquiry'),
					'before_product_price'   => __('Before product price','od-product-enquiry'),
					'before_add_to_cart'     => __('Before add to Cart button','od-product-enquiry'),
					'after_add_to_cart'      => __('After add to Cart button','od-product-enquiry'),
					'before_product_meta'    => __('Before product meta','od-product-enquiry'),
					'before_product_sharing' => __('After product sharing','od-product-enquiry'),
				])
				->set_default_value('after_add_to_cart')
		]);
	}

}
