# Triple A (Authentication, Authorization, and Accounting)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laraflow/triplea.svg?style=flat-square)](https://packagist.org/packages/laraflow/triplea)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/laraflow/triplea/run-tests?label=tests)](https://github.com/laraflow/triplea/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/laraflow/triplea/Check%20&%20fix%20styling?label=code%20style)](https://github.com/laraflow/triplea/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/laraflow/triplea.svg?style=flat-square)](https://packagist.org/packages/laraflow/triplea)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

We invest a lot of resources into creating [best in class open source packages](https://laraflow.be/open-source). You can support us by [buying one of our paid products](https://laraflow.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://laraflow.be/about-us). We publish all received postcards on [our virtual postcard wall](https://laraflow.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require laraflow/triplea
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="triplea-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="triplea-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="triplea-views"
```

## Usage

```php
$variable = new Laraflow\TripleA();
echo $variable->echoPhrase('Hello, Laraflow!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/laraflow/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Mohammad Hafijul Islam](https://github.com/hafijul233)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Environments

|      Package      |       Key        |     Values   | Default |
|-------------------|------------------|--------------|---------|
| **Laravel Audit** | AUDITING_ENABLED |(true, false) |   true  |
|   **Laratrust**   | LARATRUST_ENABLE_CACHE |(true, false) |   true  |
| **Laravel Audit** | AUDITING_ENABLED |(true, false) |   true  |
| **Laravel Audit** | AUDITING_ENABLED |(true, false) |   true  |
| **Laravel Audit** | AUDITING_ENABLED |(true, false) |   true  |
| **Laravel Audit** | AUDITING_ENABLED |(true, false) |   true  |
