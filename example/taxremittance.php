<?php
require_once __DIR__ . '/../vendor/autoload.php';
use MpesaSdk\TaxRemittance;
$taxremittance = new TaxRemittance();
$KRA_PIN = 'KRA_PIN';
$Amount = '100';
echo $response = $taxremittance->taxRemittance($KRA_PIN, $Amount);