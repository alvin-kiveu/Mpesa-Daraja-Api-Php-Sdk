<?php
require_once __DIR__ . '/../vendor/autoload.php';
use MpesaSdk\StkPush;
$stkpush = new StkPush();
$checkout_request_id = '254768168060';
echo $response = $stkpush->query($checkout_request_id);

