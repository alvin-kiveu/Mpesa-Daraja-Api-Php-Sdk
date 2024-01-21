<?php

namespace MpesaSdk;

class MpesaSdk
{
  public function generateToken($consumer_key, $consumer_secret)
  {
    $credentials = base64_encode($consumer_key . ":" . $consumer_secret);
    $url = 'https://sandbox.intasend.com/api/v1/oauth/token/';
    $payload = [
      "grant_type" => "client_credentials"
    ];
    $payload = json_encode($payload);
    $headers = [
      'Authorization: Basic ' . $credentials,
      'Content-Type: application/json'
    ];
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($response);
    return $response->access_token;
  }
}
