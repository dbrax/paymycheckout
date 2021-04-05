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
class Wc_wopay_gateway extends WC_Payment_Gateway
{

    /**
     * Class constructor
     */
    public function __construct()
    {

    $this->id = 'wopay'; // payment gateway plugin ID
	$this->icon = ''; // URL of the icon that will be displayed on checkout page near your gateway name
	$this->has_fields = true; // in case you need a custom credit card form
	$this->method_title = 'Wopay Gateway';
	$this->method_description = 'An online wordpress payment gateway'; // will be displayed on the options page
 
	// gateways can support subscriptions, refunds, saved payment methods,
	// but in this tutorial we begin with simple payments
	$this->supports = array(
		'products'
	);
 
	// Method with all the options fields
    $this->init_form_fields();

	// Load the settings.
	$this->init_settings();
	$this->title = $this->get_option( 'title' );
	$this->description = $this->get_option( 'description' );
	$this->testmode = 'yes' === $this->get_option( 'testmode' );
	$this->private_key = $this->testmode ? $this->get_option( 'test_private_key' ) : $this->get_option( 'private_key' );
	$this->publishable_key = $this->testmode ? $this->get_option( 'test_publishable_key' ) : $this->get_option( 'publishable_key' );
 



    	// This action hook saves the settings
	add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
 
	// We need custom JavaScript to obtain a token
	//add_action( 'wp_enqueue_scripts', array( $this, 'payment_scripts' ) );
 


    }

    /**
     * Plugin options, we deal with it in Step 3 too
     */
    public function init_form_fields()
    {
    }

    /**
     * You will need it if you want your custom credit card form, Step 4 is about it
     */
    public function payment_fields()
    {
    }

    /*
             * Custom CSS and JS, in most cases required only when you decided to go with a custom credit card form
             */
    public function payment_scripts()
    {
    }

    /*
              * Fields validation, more in Step 5
             */
    public function validate_fields()
    {
    }

    /*
             * We're processing the payments here, everything about it is in Step 5
             */
    public function process_payment($order_id)
    {
    }

    /*
             * In case you need a webhook, like PayPal IPN etc
             */
    public function webhook()
    {
    }
}
