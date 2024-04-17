<?php
require_once __DIR__ . '/../vendor/autoload.php';
use MpesaSdk\C2b;

$c2b = new C2b();

echo $response = $c2b->register();