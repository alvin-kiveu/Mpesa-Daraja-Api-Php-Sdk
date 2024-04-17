<?php
require_once __DIR__ . '/../vendor/autoload.php';
use MpesaSdk\B2bExpressCheckOut;

$b2bexpresscheckout = new B2bexpressCheckout();

$Amount = '100';
$primaryShortCode = '600000';
$receiverShortCode = '600000';

echo $response = $b2bexpresscheckout->b2bexpresscheckout($Amount, $primaryShortCode, $receiverShortCode);