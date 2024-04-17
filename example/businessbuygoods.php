<?php
require_once __DIR__ . '/../vendor/autoload.php';
use MpesaSdk\BussinessBuyGoods;

$bussinessbuygoods = new BussinessBuyGoods();

$amount = '100';
$DepositePaybillTillNumber = '600000';
$accountReference = 'Test';

echo $response = $bussinessbuygoods->bussinessbuygoods($amount, $DepositePaybillTillNumber, $accountReference);