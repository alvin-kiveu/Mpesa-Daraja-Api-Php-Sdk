<?php

require_once __DIR__ . '/../vendor/autoload.php';

use MpesaSdk\StkPush;

$stkpush = new StkPush();

$phone_number = '254768168060';
$amount = 1;
$reference = '123456';
$description = 'Testing stk push';

echo $response = $stkpush->initiate($phone_number, $amount, $reference, $description);

