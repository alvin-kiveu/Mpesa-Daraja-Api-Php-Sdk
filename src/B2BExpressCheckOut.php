<?php

namespace MpesaSdk;

use MpesaSdk\MpesaSdk;

class B2bExpressCheckOut extends MpesaSdk
{

  public function B2bExpressCheckOut($Amount, $DepositePaybillTillNumber, $accountReference)
  {
    $mpesa_sdk = new MpesaSdk();
    $access_token = $mpesa_sdk->generateAccessToken();
    $InitiatorName = getenv('MPESA_INITIATOR_NAME');
    $password = getenv('MPESA_INITIATOR_PASSWORD');
    $BusinessShortCode = getenv('MPESA_SHORTCODE');
    $QueueTimeOutURL = getenv('MPESA_QUEUE_TIMEOUT_URL');
    $ResultURL = getenv('MPESA_RESULT_URL');
    $SecurityCredential = $mpesa_sdk->SecurityCredential($password);
  }
   
}