<?php
require_once __DIR__ . '/../vendor/autoload.php';
use MpesaSdk\DynamicQR;
$dynamicqr = new DynamicQR();
$merchantname = '';
$accountnumber = '';
$amount = '';
$trxcode = '';
$size = '';

echo $response = $dynamicqr->generate($merchantname, $accountnumber, $amount, $trxcode, $size);