<?php
/**
 * Mpesa SDK for PHP - Daraja Api Version 2.0
 * 
 * @package MpesaSdk
 * 
 * @see https://github.com/alvin-kiveu/Mpesa-Daraja-Api-Php-Sdk.git
 * 
 * @license MIT License
 * 
 * @version 1.0.0
 * 
 * @author Alvin Kiveu
 * 
 * @copyright 2024 Umeskia Softwares
 * 
  * @note      This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 * 
 */

namespace MpesaSdk;

class MpesaSdk
{
  
  public function generateAccessToken()
  {
      $consumer_key = getenv('MPESA_CONSUMER_KEY');
      $consumer_secret = getenv('MPESA_CONSUMER_SECRET');
      $env = getenv('MPESA_ENV');
      $url = $env == 'sandbox' ? 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials' : 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, $url);
      $credentials = base64_encode($consumer_key . ':' . $consumer_secret);
      curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials)); //setting a custom header
      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      $curl_response = curl_exec($curl);
      $response = json_decode($curl_response);
      return $response->access_token;
  }

}
