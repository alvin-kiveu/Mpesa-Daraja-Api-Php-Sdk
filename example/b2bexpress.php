<?php
require_once __DIR__ . '/../vendor/autoload.php';
use MpesaSdk\B2BExpressCheckOut ;

$b2bexpresscheckout = new B2BExpressCheckOut ();

$Amount = '100';
$primaryShortCode = '600000';
$receiverShortCode = '600000';

echo $response = $b2bexpresscheckout->b2bexpresscheckout($Amount, $primaryShortCode, $receiverShortCode);