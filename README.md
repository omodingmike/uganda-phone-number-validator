# uganda-phone-number-validator

[![Latest Version on Packagist](https://img.shields.io/packagist/v/omodingmike/uganda-phone-number-validator.svg?style=flat-square)](https://packagist.org/packages/omodingmike/uganda-phone-number-validator)
[![Tests](https://img.shields.io/github/actions/workflow/status/omodingmike/uganda-phone-number-validator/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/omodingmike/uganda-phone-number-validator/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/omodingmike/uganda-phone-number-validator.svg?style=flat-square)](https://packagist.org/packages/omodingmike/uganda-phone-number-validator)

For validating ugandan phone numbers.


## Installation

You can install the package via composer:

```bash
composer require omodingmike/uganda-phone-number-validator
```

## Usage

```php
 use OmodingMike\PhoneNumberValidator\Constants\PhoneNumberFormat;
 use OmodingMike\PhoneNumberValidator\PhoneNumberValidator;
 
 $phone = '0701234567';
 $isValid = PhoneNumberValidator::isValid($phone);

 $formatted = PhoneNumberValidator::format($phone,PhoneNumberFormat::E164)  
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [omodingmike](https://github.com/omodingmike)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
