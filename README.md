# Mikropakket PHP Api

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vendor_slug/package_slug.svg?style=flat-square)](https://packagist.org/packages/proclame/micropakket-php)
[![Total Downloads](https://img.shields.io/packagist/dt/vendor_slug/package_slug.svg?style=flat-square)](https://packagist.org/packages/vendor_slug/package_slug)

[comment]: <> ([![GitHub Tests Action Status]&#40;https://img.shields.io/github/workflow/status/vendor_slug/package_slug/run-tests?label=tests&#41;]&#40;https://github.com/vendor_slug/package_slug/actions?query=workflow%3ATests+branch%3Amaster&#41;)

[comment]: <> ([![GitHub Code Style Action Status]&#40;https://img.shields.io/github/workflow/status/vendor_slug/package_slug/Check%20&%20fix%20styling?label=code%20style&#41;]&#40;https://github.com/vendor_slug/package_slug/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster&#41;)


This package is a PHP implementation for the [Mikropakket](https://www.mikropakket.be/) API, with it, you can create and track parcels.

## Installation

You can install the package via composer:

```bash
composer require proclame/mikropakket-php
```

## Usage

```php
// Create a parcel
$request = new Mikropakket\ParcelRequest();
$request->setApiKey(API_KEY);
$request->setAttributes($attributes = ["attribute_key" => "attribute_value"]);
$labelResponse = $request->request();

$labelResponse->shipmentParcel->stream("optional-filename.pdf");
```

### Attributes
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
AlsoSaturday | | 1 | 0 | Also enable delivery on Saturday
CreateRetourLabel | | 1 | 0 | Create return label as  well 
PickupType | | | | Unsure
Reference | | "order-number" | | Reference for the order 
ReceiversEmail | | "receiver@email.com" | | Receivers Email address (for notification) 
SendersEmail | | "sender@email.com" | | Senders Email address
ReceiversNote | | | | Unsure
SendersNote | | | | Unsure

[comment]: <> (## Testing)

[comment]: <> (```bash)

[comment]: <> (composer test)

[comment]: <> (```)

[comment]: <> (## Changelog)

[comment]: <> (Please see [CHANGELOG]&#40;CHANGELOG.md&#41; for more information on what has changed recently.)

[comment]: <> (## Contributing)

[comment]: <> (Please see [CONTRIBUTING]&#40;.github/CONTRIBUTING.md&#41; for details.)

[comment]: <> (## Security Vulnerabilities)

[comment]: <> (Please review [our security policy]&#40;../../security/policy&#41; on how to report security vulnerabilities.)

[comment]: <> (## Credits)

[comment]: <> (- [:author_name]&#40;https://github.com/:author_username&#41;)

[comment]: <> (- [All Contributors]&#40;../../contributors&#41;)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
