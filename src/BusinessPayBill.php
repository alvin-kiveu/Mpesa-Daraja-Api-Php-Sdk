<?php

namespace MpesaSdk;

use MpesaSdk\MpesaSdk;

class BusinessPayBill extends MpesaSdk
{

  public function bussinesspaybill($Amount, $DepositePaybillTillNumber, $accountReference)
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
    $apiUrl = $env == 'sandbox' ? 'https://sandbox.safaricom.co.ke/mpesa/b2b/v1/paymentrequest' : 'https://api.safaricom.co.ke/mpesa/b2b/v1/paymentrequest';
    $partyA = $BusinessShortCode; // Business short code
    $partyB = $DepositePaybillTillNumber; // Merchant's short code or till number
    $requester = "254700000000"; // Phone number of the person making the request
    $remarks = "OK"; // Optional remarks for the transaction
    // Prepare the request body as an array
    $requestBody = array(
      'Initiator' => $InitiatorName,
      'SecurityCredential' => $SecurityCredential,
      'CommandID' => 'BusinessPayBill',
      'SenderIdentifierType' => '4',
      'RecieverIdentifierType' => '4',
      'Amount' => $Amount,
      'PartyA' => $partyA,
      'PartyB' => $partyB,
      'AccountReference' => $accountReference,
      'Requester' => $requester,
      'Remarks' => $remarks,
      'QueueTimeOutURL' => $QueueTimeOutURL,
      'ResultURL' => $ResultURL,
    );
    $requestJson = json_encode($requestBody);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $requestJson);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Authorization:Bearer ' . $access_token // Replace with your actual access token
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    return $response;
  }
}
