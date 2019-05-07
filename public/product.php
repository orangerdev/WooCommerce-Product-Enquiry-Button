<?php

namespace Od_Product_Enquiry\Front;

/**
 * The product display functionality of the plugin.
 *
 * @link       https://ridwan-arifandi.com/
 * @since      1.0.0
 *
 * @package    Od_Product_Enquiry
 * @subpackage Od_Product_Enquiry/public
 */

class Product
{
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
	private $display_priority = [
		'before_product_title'   => 1,
		'before_product_price'   => 9,
		'before_add_to_cart'     => 29,
		'after_add_to_cart'      => 31,
		'before_product_meta'    => 39,
		'before_product_sharing' => 49,
	];


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Render shortcodes
	 * @param  string $text    		text to be rendered
	 * @param  mixed  $the_product o	ptional
	 * @return string
	 */
	public function render_shortodes($text,$the_product = NULL)
	{
		if(is_null($product) || !is_a($the_product,'WC_Product')) :
			global $product;
			$the_product = $product;
		endif;

		$find_shortcodes = [
			'%%%SITENAME%%%',
			'%%%PRODUCTNAME%%%'
		];

		$replace_shortcodes = [
			get_bloginfo('name'),
			$the_product->get_name()
		];

		return str_replace($find_shortcodes,$replace_shortcodes,$text);
	}

    /**
     * Set where buttons to be displayed
     * Hooked via action template_redirect, priority 999
     * @since   1.0.0
     * @return  void
     */
    public function set_where_to_display()
    {
		if(!is_singular('product')) :
			return;
		endif;

        $where_to_display = carbon_get_theme_option('owpe_display_enquiry_buttons');

		if(isset($this->display_priority[$where_to_display])) :
			$priority = $this->display_priority[$where_to_display];
			add_action('woocommerce_single_product_summary'	,[$this,'display_buttons'],	$priority);
		endif;
    }

	/**
     * Display enquiry buttons
     * Hooked via action woocommerce_single_product_summart, priority dynamic
     * @since   1.0.0
     * @return  void
     */
	public function display_buttons()
	{
		$email_active = boolval(carbon_get_theme_option('owpe_email_active'));

		if(true === $email_active) :

			$email_recipient   = sanitize_email(carbon_get_theme_option('owpe_email_recipient'));
			$email_title       = esc_textarea($this->render_shortodes(carbon_get_theme_option('owpe_email_title')));
			$email_content     = esc_html($this->render_shortodes(carbon_get_theme_option('owpe_email_content')));
			$link              = sprintf('mailto:%s?subject=%s&body=%s',$email_recipient,$email_title,$email_content);
			$text_button       = carbon_get_theme_option('owpe_email_text_button');
			$text_button_color = carbon_get_theme_option('owpe_email_text_button_color');
			$button_color      = carbon_get_theme_option('owpe_email_button_color');
			$icon_class        = 'fa-envelope';

			require(OD_PRODUCT_ENQUIRY_DIR.'public/partials/button.php');
		endif;
	}

}
