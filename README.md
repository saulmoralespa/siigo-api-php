# siigo-api-php

SDK PHP API SIIGO

## Requirements

- PHP >= 8.1
- Composer
- SIIGO API credentials (username and access key)

## Installation ##

```bash 
composer require saulmoralespa/siigo-api-php
```

## Basic Usage ##

```php
include_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
use Saulmoralespa\Siigo\Client;

$username = 'YOUR_USERNAME';
$accessKey = 'YOUR_ACCESS_KEY';
$siigo = new Client($username, $accessKey);

// Get authentication token
$token = $siigo->getAccessToken();

// Set the token in the client
$filePath = __DIR__ . DIRECTORY_SEPARATOR . 'token.json';
$siigo->setTokenFilePath($filePath);
```

## Examples

### Create Invoice
```php
$invoiceData = [
    "document" => [
        "id" => 2372 // Get this ID from getDocumentTypes() method
    ],
    "date" => date('Y-m-d'),
    "customer" => [
        "identification" => "123456789",
        "branch_office" => 0
    ],
    "seller" => 62, // Get this ID from getSellers() method
    "stamp" => [
        "send" => false // Set true to send to DIAN
    ],
    "mail" => [
        "send" => false // Set true to send to customer
    ],
    "observations" => "Invoice observations",
    "items" => [
        [
            "code" => "PROD-001",
            "description" => "Test Product",
            "quantity" => 1,
            "price" => 12000
        ]
    ],
    "payments" => [
        [
            "id" => 542, // Get this ID from getPaymentMethods() method
            "value" => 12000,
            "due_date" => date('Y-m-d')
        ]
    ]
];

$invoice = $siigo->createInvoice($invoiceData);
```