<?php

namespace MpesaSdk;

use MpesaSdk\MpesaSdk;

class TransactionStatus extends MpesaSdk
{
  public function transactionStatus($TransactionID,$OriginatorConversationID)
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
    $TreansactionStatusUrl = $env == 'sandbox' ? 'https://sandbox.safaricom.co.ke/mpesa/transactionstatus/v1/query' : 'https://api.safaricom.co.ke/mpesa/transactionstatus/v1/query';
    $request_data = array(
      'Initiator' => $InitiatorName,
      'SecurityCredential' => $SecurityCredential,
      'CommandID' => 'TransactionStatusQuery',
      'TransactionID' => $TransactionID,
      'OriginatorConversationID' => $OriginatorConversationID,
      'PartyA' => $BusinessShortCode,
      'IdentifierType' => '4',
      'ResultURL' => $ResultURL,
      'QueueTimeOutURL' => $QueueTimeOutURL,
      'Remarks' => 'OK',
      'Occasion' => 'OK',
    );
    $data_string = json_encode($request_data);
    $headers = array(
      'Content-Type: application/json',
      'Authorization:Bearer ' . $access_token
    );
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $TreansactionStatusUrl);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    if (curl_errno($curl)) {
      echo 'Error: ' . curl_error($curl);
    }
    curl_close($curl);
    return $response;
  }
}
