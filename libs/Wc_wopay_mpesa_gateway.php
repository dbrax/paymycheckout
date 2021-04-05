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
class Wc_wopay_mpesa_gateway extends WC_Payment_Gateway
{


    private $webhookname;
    /**
     * Class constructor
     */
    public function __construct()
    {

        $this->id = 'wopay-mpesa'; // payment gateway plugin ID
        $this->icon = ''; // URL of the icon that will be displayed on checkout page near your gateway name
        $this->has_fields = true; // in case you need a custom credit card form
        $this->method_title = 'Wopay Gateway (coming soon)';
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
        $this->title = $this->get_option('title');
        $this->description = $this->get_option('description');
        $this->testmode = 'yes' === $this->get_option('testmode');
        $this->private_key = $this->testmode ? $this->get_option('test_private_key') : $this->get_option('private_key');
        $this->publishable_key = $this->testmode ? $this->get_option('test_publishable_key') : $this->get_option('publishable_key');


        $this->webhookname = "paymentcomplete";

        // This action hook saves the settings
       // add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));

        // We need custom JavaScript to obtain a token
        //add_action( 'wp_enqueue_scripts', array( $this, 'payment_scripts' ) );
      //  add_action('woocommerce_api_' . $this->webhookname, array($this, 'webhook'));
        $this->load_dependencies();
    }

    /**
     * Plugin options, these are settings
     */
    public function init_form_fields()
    {
        $this->mpesa_fields();
    }

    public function mpesa_fields()
    {
        $this->form_fields = array(
            'enabled' => array(
                'title'       => 'Enable/Disable',
                'label'       => 'Enable Mpesa Secure Gateway',
                'type'        => 'checkbox',
                'description' => '',
                'default'     => 'no'
            ),
            'title' => array(
                'title'       => 'Title',
                'type'        => 'text',
                'description' => 'This controls the title which the user sees during checkout.',
                'default'     => 'Mpesa',
                'desc_tip'    => true,
            ),


        );
    }


    public function tigopesa_fields()
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

            'mpesa_client_id' => array(
                'title'       => 'Client Id',
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

        if (empty($_POST['billing_first_name'])) {
            wc_add_notice('First name is required!', 'error');
            return false;
        }
        return true;
    }


    private function load_dependencies()
    {
        // require_once plugin_dir_path(dirname(__FILE__)) . 'libs/tigopesa/Tigosecure.php';
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

        header('HTTP/1.1 200 OK');
        echo "callback" . json_encode($_GET);



        //$order = wc_get_order( $_GET['id'] );
        //$order->payment_complete();
        //$order->reduce_order_stock();

        //update_option('webhook_debug', $_GET);
    }
}
