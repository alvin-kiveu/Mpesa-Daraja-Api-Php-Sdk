<?php
require_once __DIR__ . '/../vendor/autoload.php';
use MpesaSdk\BusinessBuyGoods;

$bussinessbuygoods = new BusinessBuyGoods();

$amount = '100';
$DepositePaybillTillNumber = '600000';
$accountReference = 'Test';

echo $response = $bussinessbuygoods->bussinessbuygoods($amount, $DepositePaybillTillNumber, $accountReference);