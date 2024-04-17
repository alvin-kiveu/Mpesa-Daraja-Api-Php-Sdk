<?php
require_once __DIR__ . '/../vendor/autoload.php';
use MpesaSdk\TransactionStatus;
$transactionstatus = new TransactionStatus();
$TransactionID = '';
$OriginatorConversationID = '';
echo $response = $transactionstatus->transactionStatus($TransactionID,$OriginatorConversationID);