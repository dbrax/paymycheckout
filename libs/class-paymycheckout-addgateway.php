<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/dbrax/paymycheckout
 * @since      1.0.0
 *
 * @package    paymycheckout
 * @subpackage paymycheckout/libs
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    paymycheckout
 * @subpackage paymycheckout/libs
 * @author     Emmanuel Mnzava <epmnzava@gmail.com>
 */
class paymycheckout_gateway
{


	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $paymycheckout    The ID of this plugin.
	 */
	private $paymycheckout;

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
	 * @param      string    $paymycheckout       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($paymycheckout, $version)
	{

		$this->paymycheckout = $paymycheckout;
		$this->version = $version;
	}


	public function paymycheckout_gateways($gateways)
	{
		$gateways[] = 'Wc_paymycheckout_tigopesa_gateway'; // your class name is here
		//	array_push($gateways,'Wc_paymycheckout_mpesa_gateway');
		return $gateways;
	}



	public function paymycheckout_init_gateway_class()
	{
		if (class_exists("WC_Payment_Gateway")) {
			require_once plugin_dir_path(dirname(__FILE__)) . 'libs/Wc_paymycheckout_tigopesa_gateway.php';
			require_once plugin_dir_path(dirname(__FILE__)) . 'libs/Wc_paymycheckout_mpesa_gateway.php';

			$gateway_init = new Wc_paymycheckout_tigopesa_gateway();
			//$gateway_init=new Wc_paymycheckout_mpesa_gateway();


		}
	}
}
