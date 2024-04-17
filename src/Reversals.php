<?php

namespace MpesaSdk;

use MpesaSdk\MpesaSdk;

class Reversals extends MpesaSdk
{

  public function reversals($TransactionID, $Amount)
  {
    $mpesa_sdk = new MpesaSdk();
    $access_token = $mpesa_sdk->generateAccessToken();
    $InitiatorName = getenv('MPESA_INITIATOR_NAME');
    $password = getenv('MPESA_INITIATOR_PASSWORD');
    $BusinessShortCode = getenv('MPESA_SHORTCODE');
    $QueueTimeOutURL = getenv('MPESA_QUEUE_TIMEOUT_URL');
    $ResultURL = getenv('MPESA_RESULT_URL');
    $env = getenv('MPESA_ENV');
    $SecurityCredential = $mpesa_sdk->SecurityCredential($password);
    $ReversalsUrl = $env == 'sandbox' ? 'https://sandbox.safaricom.co.ke/mpesa/reversal/v1/request' : 'https://api.safaricom.co.ke/mpesa/reversal/v1/request';
    $request_data = array(
      'Initiator' => $InitiatorName,
      'SecurityCredential' => $SecurityCredential,
      'CommandID' => 'TransactionReversal',
      'TransactionID' => $TransactionID,
      'Amount' => $Amount,
      'ReceiverParty' => $BusinessShortCode,
      'RecieverIdentifierType' => '11',
      'QueueTimeOutURL' => $QueueTimeOutURL,
      'ResultURL' => $ResultURL,
      'Remarks' => 'Test',
      'Occasion' => 'work',
    );
    $data_string = json_encode($request_data);
    $headers = array(
      'Content-Type: application/json',
      'Authorization: Bearer ' . $access_token
    );
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $ReversalsUrl);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
  }
}
