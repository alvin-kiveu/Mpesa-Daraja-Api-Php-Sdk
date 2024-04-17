<?php

namespace MpesaSdk;

use MpesaSdk\MpesaSdk;

class B2c extends MpesaSdk
{

  public function b2c($Amount,$phone,$CommandID)
  {
    $mpesa_sdk = new MpesaSdk();
    $access_token = $mpesa_sdk->generateAccessToken();
    $InitiatorName = getenv('MPESA_INITIATOR_NAME');
    $password = getenv('MPESA_INITIATOR_PASSWORD');
    $B2cShortCode = getenv('MPESA_B2C_SHORTCODE');
    $QueueTimeOutURL = getenv('MPESA_QUEUE_TIMEOUT_URL');
    $ResultURL = getenv('MPESA_RESULT_URL');
    $SecurityCredential = $mpesa_sdk->SecurityCredential($password);
    $env = getenv('MPESA_ENV');
    $b2c_url = $env == 'sandbox' ? 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest' : 'https://api.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';
    $PartyA = $B2cShortCode;
    $PartyB = $phone;
    $Remarks = 'Withdrawal';
    $Occasion = 'Online Payment';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $b2c_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token]);
    $curl_post_data = array(
      'InitiatorName' => $InitiatorName,
      'SecurityCredential' => $SecurityCredential,
      'CommandID' => $CommandID,
      'Amount' => $Amount,
      'PartyA' => $PartyA,
      'PartyB' => $PartyB,
      'Remarks' => $Remarks,
      'QueueTimeOutURL' => $QueueTimeOutURL,
      'ResultURL' => $ResultURL,
      'Occasion' => $Occasion
    );
    $data_string = json_encode($curl_post_data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    $curl_response = curl_exec($curl);
    return $curl_response;
  }
}
