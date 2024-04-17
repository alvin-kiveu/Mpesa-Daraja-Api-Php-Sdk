<?php
require_once __DIR__ . '/../vendor/autoload.php';
use MpesaSdk\B2c;

$b2c = new B2c();

$Amount = '100';
$PhoneNumber = '254708374149';
$AccountReference = 'Test';

echo $response = $b2c->b2c($Amount, $PhoneNumber, $AccountReference);