<?php
namespace Od_Product_Enquiry;
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://ridwan-arifandi.com/
 * @since      1.0.0
 *
 * @package    Od_Product_Enquiry
 * @subpackage Od_Product_Enquiry/public
 */

class Front {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 * Hooked via wp_enqueue_scripts, priority 999
	 * @since    1.0.0
	 * @return 	 void
	 */
	public function enqueue_styles() {

		if(is_singular('product')) :
			wp_register_style	( 'fontawesome',		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css',[],'5.8.2');
			wp_enqueue_style	( $this->plugin_name, 	plugin_dir_url( __FILE__ ) . 'css/od-product-enquiry-public.css', ['fontawesome'], $this->version, 'all' );
		endif;

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 * Hooked via wp_enqueue_scripts, priority 999
	 * @since    1.0.0
	 * @return 	 void
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/od-product-enquiry-public.js', array( 'jquery' ), $this->version, false );

	}

}
