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
class Wc_paymycheckout_tigopesa_gateway extends WC_Payment_Gateway
{


    private $webhookname;
    /**
     * Class constructor
     */
    public function __construct()
    {

        $this->id = 'paymycheckout'; // payment gateway plugin ID
        $this->icon = ''; // URL of the icon that will be displayed on checkout page near your gateway name
        $this->has_fields = true; // in case you need a custom credit card form
        $this->method_title = 'paymycheckout Gateway';
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
        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));

        // We need custom JavaScript to obtain a token
        //add_action( 'wp_enqueue_scripts', array( $this, 'payment_scripts' ) );
        add_action('woocommerce_api_' . $this->webhookname, array($this, 'webhook'));
        //do_action( 'woocommerce_api_'.$this->webhookname );

        $this->load_dependencies();
    }

    /**
     * Plugin options, these are settings
     */
    public function init_form_fields()
    {
        $this->tigopesa_fields();
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

        if (empty($_POST['billing_first_name'])) {
            wc_add_notice('First name is required!', 'error');
            return false;
        }
        return true;
    }


    private function load_dependencies()
    {
        require_once plugin_dir_path(dirname(__FILE__)) . 'libs/tigopesa/Tigosecure.php';
    }


    /*
             * We're processing the payments here, everything about it is in Step 5
             */
    public function process_payment($order_id)
    {

        global $woocommerce;

        // we need it to get any order detailes
        $order = wc_get_order($order_id);


        $customer_firstname = $order->get_billing_first_name();

        $customer_lastname = $order->get_billing_last_name();
        $company = $order->get_billing_company();

        $customer_phone_number = $order->get_billing_phone();
        $customer_email = $order->get_billing_email();
        $amount = $order->get_total();


        $clientid = $this->get_option('tigopesa_client_id');
        $clientpin = $this->get_option('tigopesa_pin');
        $account_number = $this->get_option('tigopesa_account_number');
        $account_id = $this->get_option('tigopesa_account_id');
        $client_secret = $this->get_option("tigopesa_client_secret");
        $transaction_id = $this->random_reference("TIGOPESA" . $order_id, 10);
        $lang = "en";

        $this->write_log(get_site_url() . "?wc-api/paymentcomplete");
        $api = new Tigosecure($clientid, $client_secret, $account_id, $clientpin, $account_number, get_site_url() . "?wc-api/paymentcomplete", get_site_url() . "?wc-api/paymentcomplete", $lang, "TZS", $environment = "live");
        $response = $api->make_payment($customer_firstname, $customer_lastname, $customer_email,  $amount, $transaction_id);

        //logging the response here ..
        $this->write_log(json_encode($response));

        if (!is_wp_error($response)) {
            //  {"transactionRefId":"TIGOPESA12EEOMBXGRAT","redirectUrl":"https:\/\/secure.tigo.com\/v1\/tigo\/payment-auth\/transactions?auth_code=6o8wjKFQfQ&transaction_ref_id=TIGOPESA12EEOMBXGRAT&lang=swa","authCode":"6o8wjKFQfQ","creationDateTime":"Mon, 5 Apr 2021 11:42:05 UTC","SessionLife":600}



            $this->write_log(json_encode($response));

            // it could be different depending on your payment processor
            if ($response->transactionRefId == $transaction_id) {


                return array(
                    'result' => 'success',
                    'redirect' => $response->redirectUrl
                );
            } else {
                wc_add_notice('Please try again.', 'error');
                return;
            }
        } else {
            wc_add_notice('Connection error.', 'error');
            return;
        }
    }

    private function random_reference($prefix = 'TIGOPESA', $length = 15)
    {
        $keyspace = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $str = '';

        $max = mb_strlen($keyspace, '8bit') - 1;

        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }

        return $prefix . $str;
    }



    private function write_log($log)
    {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }


    /*
             * In case you need a webhook, like PayPal IPN etc
             */
    public function webhook()
    {

        header('HTTP/1.1 200 OK');
        echo "callback" . json_encode($_GET);
        $order = wc_get_order($_GET['id']);
        $order->payment_complete();
        $order->reduce_order_stock();

        update_option('webhook_debug', $_GET);
    }
}
