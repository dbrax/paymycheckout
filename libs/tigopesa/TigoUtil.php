<?php

/**
 * Author: Emmanuel Paul Mnzava
 * Twitter: @epmnzava
 * Email: epmnzava@gmail.com
 * Github:https://github.com/dbrax/tigopesa-tanzania
 * This class contains all api calls ..
 */



class TigoUtil
{
  // Build your next great package.


    /**
     * @param string $base_url
     * @return bool|string
     * Function that gets access_token
     */
  public   function get_access_token(string $base_url,$client_id,$client_secret)
  {

    $access_token_url = $base_url . "/v1/oauth/generate/accesstoken?grant_type=client_credentials";

    $data = [
      'client_id' =>$client_id,
      'client_secret' => $client_secret
    ];




    $ch = curl_init($access_token_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    curl_setopt($ch, CURLOPT_URL, $access_token_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    //    Log::info('TigoUtil::getAccessToken request='.$ch);
    $response = curl_exec($ch);


    //$info = curl_getinfo($ch);
    //  $http_result = $info ['http_code'];
    curl_close($ch);

    return $response;
  }


  //:TODO currency and endpoints should be given as parameters

    /**
     * @param $amount
     * @param $refecence_id
     * @param $customer_firstname
     * @param $custormer_lastname
     * @param $customer_email
     * @return string
     *
     * funciton that creates payment authentication json
     */

  public function createPaymentAuthJson($amount, $refecence_id, $customer_firstname, $custormer_lastname, $customer_email,$redirect_url,$callback_url,$account_number,$account_pin,$account_id)
  {

    //$transaction_number=transaction::where('id','>',1)->count();

    //$transaction_id="SIFA".$transaction_number.md5(date('d/m/y'));

    $paymentJson = '{
  "MasterMerchant": {
    "account": "' . $account_number . '",
    "pin": "' . $account_pin. '",
    "id": "' . $account_id . '"
  },
  "Merchant": {
    "reference": "",
    "fee": "0.00",
    "currencyCode": ""
  },
  "Subscriber": {
    "account": "",
    "countryCode": "255",
    "country": "TZA",
    "firstName": "' . $customer_firstname . '",
    "lastName": "' . $custormer_lastname . '",
    "emailId": "' . $customer_email . '"
  },
  "redirectUri":" ' .$redirect_url. '",
  "callbackUri": "' .$callback_url. '",
  "language": "' . "sw" . '",
  "terminalId": "",
  "originPayment": {
    "amount": "'.$amount.'",
    "currencyCode": "TZS",
    "tax": "0.00",
    "fee": "0.00"
  },
  "exchangeRate": "1",
  "LocalPayment": {
    "amount": "'.$amount.'",
    "currencyCode": "TZS"
  },
  "transactionRefId": "' . $refecence_id . '"
}';

    return $paymentJson;



  }


    /**
     * @param string $base_url
     * @param $issuedToken
     * @param $amount
     * @param $refecence_id
     * @param $customer_firstname
     * @param $custormer_lastname
     * @param $customer_email
     * @return bool|string
     *
     * Tigo secure payment call function using endpoint /v1/tigo/payment-auth/authorize
     */

  public function makePaymentRequest(string $base_url, $issuedToken, $amount, $refecence_id, $customer_firstname, $custormer_lastname, $customer_email,$redirect_url,$callback_url,$account_number,$account_pin,$account_id)
  {

    $access_token_url = $base_url . "/v1/tigo/payment-auth/authorize";

    //update transaction table about this transaction..

    $paymentAuthUrl =  $access_token_url;
    $ch = curl_init($paymentAuthUrl);
    curl_setopt_array($ch, array(
      CURLOPT_URL => $paymentAuthUrl,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $this->createPaymentAuthJson($amount, $refecence_id, $customer_firstname, $custormer_lastname, $customer_email,$redirect_url,$callback_url,$account_number,$account_pin,$account_id),
      CURLOPT_HTTPHEADER => array(
        "accesstoken:" . $issuedToken,
        "cache-control: no-cache",
        "content-type: application/json",
      ),
    ));

    $response = curl_exec($ch);
   
    curl_close($ch);

    return $response;
  }
}
