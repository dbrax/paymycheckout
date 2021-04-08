<?php

/**
 * Author: Emmanuel Paul Mnzava
 * Twitter: @epmnzava
 * Github:https://github.com/dbrax/tigopesa-tanzania
 * Email: epmnzava@gmail.com
 * 
 */


class Tigosecure
{


    private $client_id;
    private $client_secret;
    private $account_id;
    private $account_number;
    private $account_pin;
    private $baseurl;
    private $redirect_url;
    private $callback_url;
    private $lang;
    private $currency;



    //private $issuedToken;

    public  $base_url,
        $issuedToken,
        $customer_firstname,
        $customer_lastname,
        $customer_email,
        $amount,
        $reference_id;

    /**
     * Class constructor
     */
    public function __construct($client_id, $client_secret, $account_id, $account_pin, $account_number, $redirect_url, $callback_url, $lang, $currency, $environment = "live")
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->account_id = $account_id;
        $this->account_pin = $account_pin;
        $this->account_number = $account_number;

        if ($environment == "test")
            $this->baseurl = "https://securesandbox.tigo.com";
        else
            $this->baseurl = "https://secure.tigo.com";

        $this->lang = $lang;
        $this->redirect_url = $redirect_url;
        $this->callback_url = $callback_url;
        $this->lang = $lang;
        $this->currency = $currency;

        $this->load_dependencies();
    }


    private function load_dependencies()
    {
        require_once plugin_dir_path(dirname(__FILE__)) . '/tigopesa/TigoUtil.php';
    }


    /**
     *  access_token
     */
    public function access_token()
    {

        $api = new TigoUtil();
        $tokenArray = json_decode($api->get_access_token($this->baseurl, $this->client_id, $this->client_secret));
        $this->issuedToken = $tokenArray->accessToken;

        // $tokenArray = json_decode($api->get_access_token(config('tigosecure.api_url')));
        //$this->issuedToken = $tokenArray->accessToken;
    }

    /**
     * make_payment
     *
     * @param $customer_firstname
     * @param $customer_lastname
     * @param $customer_email
     * @param $amount
     * @param $reference_id
     * @return mixed
     */
    public function make_payment($customer_firstname, $customer_lastname, $customer_email, $amount, $reference_id)
    {

        $this->write_log("redirect ".$this->redirect_url);

        $this->write_log("callback ".$this->callback_url);

        $this->access_token();
        $api = new TigoUtil();
        $base_url = $this->baseurl;
        $response = $api->makePaymentRequest($base_url, $this->issuedToken, $amount, $reference_id, $customer_firstname, $customer_lastname, $customer_email, $this->redirect_url, $this->callback_url, $this->account_number, $this->account_pin, $this->account_id,$this->lang);

        return json_decode($response);
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

    /**
     * @param string $prefix
     * @param int $length
     *
     * @return string
     * @throws \Exception
     */
    public function random_reference($prefix = 'TIGOPESA', $length = 15)
    {
        $keyspace = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $str = '';

        $max = mb_strlen($keyspace, '8bit') - 1;

        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }

        return $prefix . $str;
    }
}
