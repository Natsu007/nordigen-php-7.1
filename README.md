# Nordigen PHP(7.1) Library

**This is a fork from [https://github.com/nordigen/nordigen-php](https://github.com/nordigen/nordigen-php) repostitory, so I can use API in php 7.1. I hope it helps others who cannot use the latest version of php due to other dependencies. Remdme.md has been partially rewritten to comply with php 7.1. I left the other parts in their original form.**

This is a **non-official** PHP client library for [GoCardless Bank Account Data](https://gocardless.com/bank-account-data/).

For a full list of endpoints and arguments, see the [docs](https://developer.gocardless.com/bank-account-data/quick-start-guide).

Before starting to use API you will need to create a new secret and get your `SECRET_ID` and `SECRET_KEY` from the [Nordigen's Open Banking Portal](https://bankaccountdata.gocardless.com/user-secrets/).


## Requirements

* PHP >= 7.1

## Installation

Install library via composer:

```sh
composer require natsu007/nordigen-php-7.1
```

## Example application

Laravel example application can be found in `example` directory

## Quickstart

To use the library, use Composer's [autoload](https://getcomposer.org/doc/01-basic-usage.md#autoloading):

```php
require_once('vendor/autoload.php');
```

```php
// Get secretId and secretKey from bankaccoutndata.gocardless.com portal and pass them to NordigenClient
$secretId  = "YOUR_SECRET_ID";
$secretKey = "YOUR_SECRET_KEY";

$client = new \Nordigen\NordigenPHP\API\NordigenClient($secretId, $secretKey);

// Generate new access token. Token is valid for 24 hours
// Token is automatically injected into every response
$token = $client->createAccessToken();

// Get access token
$accessToken = $client->getAccessToken();
// Get refresh token
$refreshToken = $client->getRefreshToken();

// Exchange refresh token for new access token
$newToken = $client->refreshAccessToken($refreshToken);

// Get list of institutions by country. Country should be in ISO 3166 standard.
$institutions = $client->institution->getInstitutionsByCountry("LV");

// Institution id can be gathered from getInstitutions response.
// Example Revolut ID
$institutionId = "REVOLUT_REVOGB21";
$redirectUri = "https://nordigen.com";

// Initialize new bank connection session
$session = $client->initSession($institutionId, $redirectUri);

// Get link to authorize in the bank
// Authorize with your bank via this link, to gain access to account data
$link = $session["link"];
// requisition id is needed to get accountId in the next step
$requisitionId = $session["requisition_id"];
```

After successful authorization with a bank you can fetch your data (details, balances, transactions)

## Fetching account metadata, balances, details and transactions

```php
// Get account id after completed authorization with a bank
$requisitionData = $client->requisition->getRequisition($requisitionId);
// Get account id from the array of accounts
$accountId = $requisitionData["accounts"][0];

// Instantiate account object
$account = $client->account($accountId);

// Fetch account metadata
$metadata = $account->getAccountMetaData();
// Fetch account balances
$balances = $account->getAccountBalances();
// Fetch account details
$details = $account->getAccountDetails();
// Fetch account transactions
$transactions = $account->getAccountTransactions();

// Optional. You can filter transactions by specific date range
$transactions = $account->getAccountTransactions("2021-12-01", "2022-01-30");

// Get premium transactions
// Optional parameters country, dateFrom, dateTo
$premiumTransactions = $account->getPremiumAccountTransactions();
```

## Tests

```php
./vendor/bin/phpunit
```