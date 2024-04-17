<?php

namespace MpesaSdk;

use MpesaSdk\MpesaSdk;

class B2bExpressCheckOut extends MpesaSdk
{

  public function b2bexpresscheckout($Amount, $primaryShortCode, $receiverShortCode)
  {
    $mpesa_sdk = new MpesaSdk();
    $access_token = $mpesa_sdk->generateAccessToken();
    $ResultURL = getenv('MPESA_RESULT_URL');
    $env = getenv('MPESA_ENV');
    $B2BExpressCheckOutUrl = $env == 'sandbox' ? 'https://sandbox.safaricom.co.ke/v1/ussdpush/get-msisdn' : 'https://sandbox.safaricom.co.ke/v1/ussdpush/get-msisdn';
    //GENERATE REQUEST ID ODk4O-Tk4NWU4O-DQ66HD-D4OThkY 
    $FirstCode = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
    $SecondCode = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
    $ThirdCode = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
    $FourthCode = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
    $RequestRefID = $FirstCode . '-' . $SecondCode . '-' . $ThirdCode . '-' . $FourthCode;
    $headers = array(
      'Authorization:Bearer ' . $access_token,
      'Content-Type: application/json',
    );
    $requestData = array(
      'primaryShortCode' => $primaryShortCode,
      'receiverShortCode' => $receiverShortCode,
      'amount' => $Amount,
      'paymentRef' => 'paymentRef',
      'callbackUrl' => $ResultURL,
      'partnerName' => 'Vendor',
      'RequestRefID' => $RequestRefID,
    );
    $curl = curl_init($B2BExpressCheckOutUrl);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($requestData));
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    return $response;
  }
}
