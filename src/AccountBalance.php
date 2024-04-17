<?php

namespace MpesaSdk;

use MpesaSdk\MpesaSdk;

class AccountBalance extends MpesaSdk
{

  public function AccountBalance()
  {
    $mpesa_sdk = new MpesaSdk();
    $access_token = $mpesa_sdk->generateAccessToken();
    $InitiatorName = getenv('MPESA_INITIATOR_NAME');
    $password = getenv('MPESA_INITIATOR_PASSWORD');
    $BusinessShortCode = getenv('MPESA_SHORTCODE');
    $QueueTimeOutURL = getenv('MPESA_QUEUE_TIMEOUT_URL');
    $ResultURL = getenv('MPESA_RESULT_URL');
    $SecurityCredential = $mpesa_sdk->SecurityCredential($password);
    $env = getenv('MPESA_ENV');
    $AccountBalanceUrl = $env == 'sandbox' ? 'https://sandbox.safaricom.co.ke/mpesa/accountbalance/v1/query' : 'https://api.safaricom.co.ke/mpesa/accountbalance/v1/query';
    $request_data = array(
      'Initiator' => $InitiatorName,
      'SecurityCredential' => $SecurityCredential,
      'CommandID' => 'AccountBalance',
      'PartyA' => $BusinessShortCode,
      'IdentifierType' => '4',
      'Remarks' => 'ok',
      'QueueTimeOutURL' => $QueueTimeOutURL,
      'ResultURL' => $ResultURL
    );
    $data_string = json_encode($request_data);
    $headers = array(
      'Content-Type: application/json',
      'Authorization:Bearer ' . $access_token
    );
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $AccountBalanceUrl);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
  }
}
