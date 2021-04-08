<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://woopayments.com
 * @since      1.0.0
 *
 * @package    wopay
 * @subpackage wopay/libs
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    wopay
 * @subpackage wopay/libs
 * @author     Emmanuel Mnzava <epmnzava@gmail.com>
 */
class wopay_gateway {


	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $wopay    The ID of this plugin.
	 */
	private $wopay;

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
	 * @param      string    $wopay       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $wopay, $version ) {

		$this->wopay = $wopay;
        $this->version = $version;
        
 


	}


    public function wopay_gateways($gateways ){
		$gateways[] = 'Wc_wopay_tigopesa_gateway'; // your class name is here
	//	array_push($gateways,'Wc_wopay_mpesa_gateway');
	return $gateways;

    }

 

    public function wopay_init_gateway_class(){
        if(class_exists("WC_Payment_Gateway")){
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'libs/Wc_wopay_tigopesa_gateway.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'libs/Wc_wopay_mpesa_gateway.php';

		$gateway_init=new Wc_wopay_tigopesa_gateway();
		//$gateway_init=new Wc_wopay_mpesa_gateway();


        }

    }




}
