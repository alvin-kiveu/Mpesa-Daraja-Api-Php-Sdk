<?php
require_once __DIR__ . '/../vendor/autoload.php';
use MpesaSdk\Reversals;
$reversal = new Reversals();
$TransactionID = '';
$Amount = '';

echo $response = $reversal->reversals($TransactionID, $Amount);