Paydia SNAP PHP
===============

This is the Official PHP wrapper/library for Paydia SNAP QRIS API, that is compatible with Composer. Visit [https://paydia.id](https://paydia.id) for more information about the product and see documentation at [https://snap-docs.paydia.id](https://snap-docs.paydia.id) for more technical details.

## 1. Installation

### 1.a Composer Installation

If you are using [Composer](https://getcomposer.org), you can install via composer CLI:

```
composer require paydia/paydia-snap-php
```

**or**

add this require line to your `composer.json` file:

```json
{
    "require": {
        "paydia/paydia-snap-php": "1.*"
    }
}
```

and run `composer install` on your terminal.

### 1.b Manual Instalation

If you are not using Composer, you can clone or [download](https://github.com/Paydia/paydia-snap-php/archive/master.zip) this repository.

Then you should require/autoload `PaydiaSNAP.php` file on your code.

```php
<?php
require_once dirname(__FILE__) . '/pathofproject/PaydiaSNAP.php';

// my code goes here
```

## 2. Getting Started

### 2.1 General Setting

```php
<?php
    use PaydiaSNAP\Config;

    // Set to Enable Sandbox/Production Enviroment. Set to true for Production Environment
    Config::enableProduction(false);

    // Set your Merchant Client Id
    Config::setClientId("<your client id>");
    // Set your Merchant Client Secret
    Config::setClientSecret("<your client secret>");
    // Set your Merchant Private Key. Private Key in String Format, can use https://www.samltool.com/format_privatekey.php for formatting Private Key as String
    Config::setPrivateKey("<your private key>");
```

### 2.2 Request Access Token

```php
<?php
    use PaydiaSNAP\Auth;

    // Timestamp in ISO-8601 (Optional Parameter)
    $timestamp = '';

    $accessToken = Auth::getAccessTokenB2b($timestamp);
```

### 2.3 Request QRIS MPM

For more information about Request and Response can see documentation at https://snap-docs.paydia.id/snap-service/qris-mpm-acquirer/.

```php
<?php
    use PaydiaSNAP\Mpm;

    // Access Token from Access Token B2B
    $accessToken = '';
    // Request Generate QR MPM, see documentation for detail request
    $request = array(
        ...
    );
    // External Id Request (Optional Parameter)
    $externalId = '';
    // Timestamp in ISO-8601 (Optional Parameter)
    $timestamp = '';

    // Request Generate QR MPM
    $generateQr = Mpm::generateQr($accessToken, $request, $externalId, $timestamp);

    // Request Status Inquiry
    $checkStatus = Mpm::checkStatusQr($accessToken, $request, $externalId, $timestamp);
```

### 2.4 Balance Inquiry

For more information about Request and Response can see documentation at https://snap-docs.paydia.id/snap-service/balance-inquiry/.

```php
<?php
    use PaydiaSNAP\Balance;

    // Access Token from Access Token B2B
    $accessToken = '';
    // Request Balance Inquiry, see documentation for detail request
    $request = array(
        ...
    );
    // External Id Request (Optional Parameter)
    $externalId = '';
    // Timestamp in ISO-8601 (Optional Parameter)
    $timestamp = '';

    // Request Balance Inquiry
    $balanceInquiry = Balance::inquiry($accessToken, $request, $externalId, $timestamp);
```

### 2.5 Customer Topup

For more information about Request and Response can see documentation at https://snap-docs.paydia.id/snap-service/customer-topup/.

```php
<?php
    use PaydiaSNAP\CustomerTopup;

    // Access Token from Access Token B2B
    $accessToken = '';
    // Request Customer Topup, see documentation for detail request
    $request = array(
        ...
    );
    // External Id Request (Optional Parameter)
    $externalId = '';
    // Timestamp in ISO-8601 (Optional Parameter)
    $timestamp = '';

    // Request Account Inquiry
    $accountInquiry = CustomerTopup::accountInquiry($accessToken, $request, $externalId, $timestamp);

    // Request Topup
    $topup = CustomerTopup::topup($accessToken, $request, $externalId, $timestamp);

    // Request Topup Inquiry Status
    $topupStatus = CustomerTopup::topupStatus($accessToken, $request, $externalId, $timestamp);
```

### 2.6 Transfer to Bank

For more information about Request and Response can see documentation at https://snap-docs.paydia.id/snap-service/transfer-to-bank/.

```php
<?php
    use PaydiaSNAP\TransferToBank;

    // Access Token from Access Token B2B
    $accessToken = '';
    // Request Transfer to Bank, see documentation for detail request
    $request = array(
        ...
    );
    // External Id Request (Optional Parameter)
    $externalId = '';
    // Timestamp in ISO-8601 (Optional Parameter)
    $timestamp = '';

    // Request Account Inquiry
    $accountInquiry = TransferToBank::accountInquiry($accessToken, $request, $externalId, $timestamp);

    // Request Transfer Bank
    $topup = TransferToBank::transferBank($accessToken, $request, $externalId, $timestamp);

    // Request Transfer Status
    $topupStatus = TransferToBank::topupStatus($accessToken, $request, $externalId, $timestamp);
```
