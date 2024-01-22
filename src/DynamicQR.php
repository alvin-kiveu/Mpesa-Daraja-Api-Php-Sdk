<?php

namespace MpesaSdk;

use MpesaSdk\MpesaSdk;

class DynamicQR extends MpesaSdk
{
  public function generate($merchantname, $accountnumber, $amount, $trxcode, $size)
  {
    $mpesa_sdk = new MpesaSdk();
    $access_token = $mpesa_sdk->generateAccessToken();
    $env = getenv('MPESA_ENV');
    $DynamicQRUrl = $env == 'sandbox' ? 'https://sandbox.safaricom.co.ke/mpesa/qrcode/v1/generate' : 'https://api.safaricom.co.ke/mpesa/qrcode/v1/generate';
    $payload = array(
      'MerchantName' => $merchantname,
      'RefNo' =>  $accountnumber,
      'Amount' => $amount,
      'TrxCode' => $trxcode,
      'CPI' => getenv('MPESA_SHORTCODE'),
      'Size' => $size
    );
    $ch = curl_init();
    curl_setopt_array(
      $ch,
      array(
        CURLOPT_URL => $DynamicQRUrl,
        CURLINFO_HEADER_OUT => true,
        CURLOPT_HTTPHEADER =>  array('Content-Type: application/json', 'Authorization:Bearer ' . $access_token),
        CURLOPT_POST =>  true,
        CURLOPT_POSTFIELDS =>  json_encode($payload),
        CURLOPT_RETURNTRANSFER =>  true,
        CURLOPT_SSL_VERIFYPEER =>  false,
        CURLOPT_SSL_VERIFYHOST =>  false
      )
    );
    return curl_exec($ch);
  }
}
