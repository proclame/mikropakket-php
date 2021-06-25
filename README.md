# Mikropakket PHP Api

[![Latest Version on Packagist](https://img.shields.io/packagist/v/proclame/mikropakket-php.svg?style=flat-square)](https://packagist.org/packages/proclame/micropakket-php)
[![Total Downloads](https://img.shields.io/packagist/dt/proclame/mikropakket-php.svg?style=flat-square)](https://packagist.org/packages/proclame/mikropakket-php)

[comment]: <> ([![GitHub Tests Action Status]&#40;https://img.shields.io/github/workflow/status/proclame/mikropakket-php/run-tests?label=tests&#41;]&#40;https://github.com/proclame/mikropakket-php/actions?query=workflow%3ATests+branch%3Amaster&#41;)

[comment]: <> ([![GitHub Code Style Action Status]&#40;https://img.shields.io/github/workflow/status/proclame/mikropakket-php/Check%20&%20fix%20styling?label=code%20style&#41;]&#40;https://github.com/proclame/mikropakket-php/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster&#41;)


This package is a PHP implementation for the [Mikropakket](https://www.mikropakket.be/) API, with it, you can create and track parcels.

## Installation

You can install the package via composer:

```bash
composer require proclame/mikropakket-php
```

## Notes
* Each service requires it's own API Key
* There are separate endpoints for Testing, and Production Countries per Service
* The use of the Preadvice Webservice is unclear / unnecessary and therefore unimplemented


## Usage

```php
// Create a parcel
$request = new Mikropakket\ParcelRequest();
$request->setApiKey(API_KEY);
$request->setAttributes($attributes = ["attribute_key" => "attribute_value"]);
$labelResponse = $request->request();

$labelResponse->shipmentParcel->stream("optional-filename.pdf"); // ->download() can be used as well
```

### Endpoint Hosts
Service | Test | Netherlands | Belgium
--- | --- | --- | ---
ParcelLabel | https://mpws.mikropakket.nl:9220 | https://mpws.mikropakket.nl:9200 | ?
ParcelStatus | https://mpws.mikropakket.nl:8901 | https://mpws.mikropakket.nl:8901 | https://www.mikropakket.be:8901

### Endpoints *info for contributors*
Service | Endpoint | Usage
--- | --- | ---
ParcelLabel | POST /mikropakketparcellabel/api/v1-1/parcel-label/{pagesize} | pagesize => 1: A6, 2: A5, 3: A4 (1 label per page)<br> Create a new Parcel Label
ParcelStatus | GET /ParcelStatusService/api/v1-0/Get/Status<br>POST /ParcelStatusService/api/v1-0/Post/Status | Get status (tracking) of a parcel, use either Reference or ParcelNumber + Postal Code  
ParcelStatus | GET /ParcelStatusService/api/v1-0/Get/Signature <br>POST /ParcelStatusService/api/v1-0/Post/Signature | Get signature of a delivered parcel, use ParcelNumber + Postal Code 

### ParcelLabel Attributes
Key | Required | Example | Default | Description
--- | --- | --- | --- | ---
SendersCountryCode | * | "BE" | | Countrycode from sender in isocode-1366 format
MPCustomerNumber | * | 123456456 | | Mikropakket Customer number
SendersName | * | "Jane Doe" | | Name of the parcel sender
SendersStreet | * | "Main Street" | | Senders street (no housenumber) 
SendersHouseNumber | * | "123" | | Senders Housenumber
SendersZipcode | * | "2000" | | Senders Zip Code
SendersCity | * | "Antwerp" | | Senders City
ReceiversName | * | "Joe Dane" | | Receivers Name
ReceiversStreet | * | "Second Street" | | Receivers Street (no housenumber)
ReceiversHouseNumber | * | "456" | | Receivers Housenumber
ReceiversZipcode | * | "1000" | | Receivers Zip Code
ReceiversCity | * | "Brussels" | | Receivers City
ReceiversCountryCode | * | "BE" | | Countrycode addressee in isocode-1366 format
ParcelNumber | | 1234567890 | | Unique parcel nr, length 10 digits (unsure of purpose) 
SendersPhoneNumber | | "0471234567" | | Senders Phone Number (unsure if used)
ReceiversPhoneNumber | | "0471234567" | | Receivers Phone Number (unsure if used)
ReceiversAcceptant | | "John Smith" | | Receivers personal name (eg: if ReceiversName = business name)
DeliveryNote | | "Leave at front door" | | Delivery directions
CashDeliveryInCents | | | | Not sure this is supported in BE
CashDeliveryReference | | | | Not sure this is supported in BE
DeliveryTimeWindow | | | | Timewindow for delivery on time in iso8601 format
PickUpDate | | | | Date of pick up at senders location
CreateRetourLabel | | 1 | 0 | Create return label as  well 
PickupType | | | | Unsure
Reference | | "order-number" | | Reference for the order 
ReceiversEmail | | "receiver@email.com" | | Receivers Email address (for notification) 
SendersEmail | | "sender@email.com" | | Senders Email address
ReceiversNote | | | | Unsure
SendersNote | | | | Unsure
*AlsoSaturday* | |  | | Not used anymore

## Testing
* @todo: Add tests

[comment]: <> (## Changelog)

[comment]: <> (Please see [CHANGELOG]&#40;CHANGELOG.md&#41; for more information on what has changed recently.)

## Contributing
Feel free to contribute by Forking the repo and submitting a pull request.

## Security Vulnerabilities
Please submit security vulnerabilities by email to nick@proclame.be

## Author
- [Nick Mispoulier](https://github.com/proclame)

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
