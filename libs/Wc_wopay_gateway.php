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
     * Plugin options, these are settings
     */
    public function init_form_fields()
    {
        $this->form_fields = array(
            'enabled' => array(
                'title'       => 'Enable/Disable',
                'label'       => 'Enable Tigopesa Secure Gateway',
                'type'        => 'checkbox',
                'description' => '',
                'default'     => 'no'
            ),
            'title' => array(
                'title'       => 'Title',
                'type'        => 'text',
                'description' => 'This controls the title which the user sees during checkout.',
                'default'     => 'Tigopesa',
                'desc_tip'    => true,
            ),
            'description' => array(
                'title'       => 'Description',
                'type'        => 'textarea',
                'description' => 'This controls the description which the user sees during checkout.',
                'default'     => 'Pay with  Tigopesa',
            ),
            'testmode' => array(
                'title'       => 'Test mode',
                'label'       => 'Enable Test Mode',
                'type'        => 'checkbox',
                'description' => 'Place the payment gateway in test mode using test API keys.',
                'default'     => 'yes',
                'desc_tip'    => true,
            ),
            'test_publishable_key' => array(
                'title'       => 'Test Publishable Key',
                'type'        => 'text'
            ),
            'test_private_key' => array(
                'title'       => 'Test Private Key',
                'type'        => 'password',
            ),

             'tigopesa_client_id' => array(
                'title'       => 'Client Id',
                'type'        => 'text'
            ),
            'tigopesa_client_secret' => array(
                'title'       => 'Client Secret',
                'type'        => 'text'
            ),
            'tigopesa_pin' => array(
                'title'       => 'Tigo Pin',
                'type'        => 'text'
            ),

            'tigopesa_account_number' => array(
                'title'       => 'Tigo Account Number',
                'type'        => 'text'
            ),
            

            'tigopesa_account_id' => array(
                'title'       => 'Tigo Account Id',
                'type'        => 'text'
            ),



    
        );


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

	if( empty( $_POST[ 'billing_first_name' ]) ) {
		wc_add_notice(  'First name is required!', 'error' );
		return false;
	}
	return true;
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
