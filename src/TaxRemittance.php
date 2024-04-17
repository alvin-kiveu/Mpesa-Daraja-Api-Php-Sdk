<?php

namespace MpesaSdk;

use MpesaSdk\MpesaSdk;

class TaxRemittance extends MpesaSdk
{
  public function taxRemittance($KRA_PIN, $Amount)
  {
    $mpesa_sdk = new MpesaSdk();
    $access_token = $mpesa_sdk->generateAccessToken();
    $InitiatorName = getenv('MPESA_INITIATOR_NAME');
    $password = getenv('MPESA_INITIATOR_PASSWORD');
    $BusinessShortCode = getenv('MPESA_SHORTCODE');
    $QueueTimeOutURL = getenv('MPESA_QUEUE_TIMEOUT_URL');
    $ResultURL = getenv('MPESA_RESULT_URL');
    $KRA_SHORT_CODE = getenv('KRA_SHORT_CODE');
    $env = getenv('MPESA_ENV');
    $SecurityCredential = $mpesa_sdk->SecurityCredential($password);
    $TaxRemittanceUrl = $env == 'sandbox' ? 'https://sandbox.safaricom.co.ke/mpesa/b2b/v1/remittax' : 'https://api.safaricom.co.ke/mpesa/b2b/v1/remittax';
    $request_data = array(
      'Initiator' => $InitiatorName,
      'SecurityCredential' => $SecurityCredential,
      'CommandID' => 'PayTaxToKRA',
      "SenderIdentifierType" => "4",
      "RecieverIdentifierType" => "4",
      "Amount" => $Amount,
      "PartyA" => $BusinessShortCode,
      "PartyB" => $KRA_SHORT_CODE,
      "AccountReference" => $KRA_PIN,
      "Remarks" => "OK",
      'QueueTimeOutURL' => $QueueTimeOutURL,
      'ResultURL' => $ResultURL,
    );
    $data_string = json_encode($request_data);
    $headers = array(
      'Content-Type: application/json',
      'Authorization: Bearer ' . $access_token
    );
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $TaxRemittanceUrl);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
  }
}
