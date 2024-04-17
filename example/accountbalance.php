<?php
require_once __DIR__ . '/../vendor/autoload.php';
use MpesaSdk\AccountBalance;

$accountbalance = new AccountBalance();

echo $response = $accountbalance->AccountBalance();

