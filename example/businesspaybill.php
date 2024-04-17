<?php
require_once __DIR__ . '/../vendor/autoload.php';
use MpesaSdk\BussinessPayBill;

$bussinesspaybill = new BussinessPayBill();

$Amount = '100';
$DepositePaybillTillNumber = '600000';
$accountReference = 'Test';

echo $response = $bussinesspaybill->bussinesspaybill($Amount, $DepositePaybillTillNumber, $accountReference);