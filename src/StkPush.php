<?php
namespace MpesaSdk;

use MpesaSdk\MpesaSdk;

class StkPush
{
 

  public function initiate($phone_number, $amount, $reference, $description)
  {
      $mpesa_sdk=new MpesaSdk();
      $access_token=$mpesa_sdk->generateAccessToken();
      $env = getenv('MPESA_ENV');
      $url = $env == 'sandbox' ? 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest' : 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header
      $curl_post_data = array(
        //Fill in the request parameters with valid values
        'BusinessShortCode' => getenv('MPESA_SHORTCODE'),
        'Password' => base64_encode(getenv('MPESA_SHORTCODE').getenv('MPESA_PASSKEY').date("YmdHis")),
        'Timestamp' => date("YmdHis"),
        'TransactionType' => 'CustomerPayBillOnline',
        'Amount' => $amount,
        'PartyA' => $phone_number,
        'PartyB' => getenv('MPESA_SHORTCODE'),
        'PhoneNumber' => $phone_number,
        'CallBackURL' => getenv('MPESA_CALLBACK_URL'),
        'AccountReference' => $reference,
        'TransactionDesc' => $description
      );
      $data_string = json_encode($curl_post_data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
      $curl_response = curl_exec($curl);
      return $curl_response;
  }

  public function query($checkout_request_id)
  {
      $mpesa_sdk=new MpesaSdk();
      $access_token=$mpesa_sdk->generateAccessToken();
      $env = getenv('MPESA_ENV');
      $url = $env == 'sandbox' ? 'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query' : 'https://api.safaricom.co.ke/mpesa/stkpushquery/v1/query';
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header
      $curl_post_data = array(
        //Fill in the request parameters with valid values
        'BusinessShortCode' => getenv('MPESA_SHORTCODE'),
        'Password' => base64_encode(getenv('MPESA_SHORTCODE').getenv('MPESA_PASSKEY').date("YmdHis")),
        'Timestamp' => date("YmdHis"),
        'CheckoutRequestID' => $checkout_request_id
      );
      $data_string = json_encode($curl_post_data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
      $curl_response = curl_exec($curl);
      return $curl_response;
    }
}
