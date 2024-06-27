# Mpesa Daraja Api Php Sdk

This is a php sdk for the new Mpesa Daraja Api. It is still in development and will be updated as the api changes.

## Installation

You can install the package via composer:

```bash
composer require kiveu/mpesa
```

dev version

```bash
composer require kiveu/mpesa:dev-main
```

UNDER DEVELOPMENT

## Usage

```php
use Kiveu\Mpesa\StkPush;

$stkpush = new StkPush();

$stkpush->initiate($phone_number, $amount, $reference, $description);
```

## Testing

```bash
composer test
```





## ENVIRONMENT VARIABLES

```bash
MPESA_ENV= production # or sandbox >
MPESA_CONSUMER_KEY= add your consumer key
MPESA_CONSUMER_SECRET= add your consumer secret
MPESA_PASSKEY= add your passkey
MPESA_SHORTCODE= add your shortcode
MPESA_SHORTCODE_TYPE= Paybill # or BuyGoods
MPESA_BUY_GOODS_TILL= add your buy goods till
MPESA_CALLBACK_URL= add your callback url
MPESA_INITIATOR_NAME= add your initiator name
MPESA_INITIATOR_PASSWORD= add your initiator password
MPESA_B2C_SHORTCODE= add your b2c shortcode
MPESA_B2C_COMMAND_ID= add your b2c command id eg SalaryPayment, BusinessPayment, PromotionPayment
MAPESA_C2B_VERSION= add your c2b version v1 or v2
MPESA_CONFIRMATION_URL= add your confirmation url
MPESA_VALIDATION_URL= add your validation url
MPESA_RESULT_URL= add your result url
KRA_SHORT_CODE= add your kra shortcode
```
