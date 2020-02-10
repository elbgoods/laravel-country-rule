# Laravel Country Validation Rules

[![Latest Version](http://img.shields.io/packagist/v/elbgoods/laravel-country-rule.svg?label=Release&style=for-the-badge)](https://packagist.org/packages/elbgoods/laravel-country-rule)
[![MIT License](https://img.shields.io/github/license/elbgoods/laravel-country-rule.svg?label=License&color=blue&style=for-the-badge)](https://github.com/elbgoods/laravel-country-rule/blob/master/LICENSE)
[![Offset Earth](https://img.shields.io/badge/Treeware-%F0%9F%8C%B3-green?style=for-the-badge&cacheSeconds=600)](https://offset.earth/treeware)

This package provides multiple validation rules to validate countries according to [ISO-3166](https://wikipedia.org/wiki/ISO_3166).

## Installation

At first you have to add this package to your `composer.json`:

```bash
composer require elbgoods/laravel-country-rule
```

After this you can publish the package translation files to adjust the error messages:

```bash
php artisan vendor:publish --provider="Elbgoods\CountryRule\CountryRuleServiceProvider" --tag=lang
```

## Usage

### General

This package provides a basic `CountryRule` which you can use. All more specif rules only extend this rule with a predefined `format`.

```php
use Elbgoods\CountryRule\Rules\CountryRule;
use League\ISO3166\ISO3166;

$rule = new CountryRule(ISO3166::KEY_ALPHA2);
```

By default the rule requires a value - if you want to accept `null` values you can use the `nullable()` method or set the `$required` parameter to `false`.

```php
use Elbgoods\CountryRule\Rules\CountryRule;
use League\ISO3166\ISO3166;

$rule = new CountryRule(ISO3166::KEY_ALPHA2, false);
$rule->nullable();
```

### Alpha2

```php
use Elbgoods\CountryRule\Rules\CountryAlpha2Rule;

$rule = new CountryAlpha2Rule();
```

### Alpha3

```php
use Elbgoods\CountryRule\Rules\CountryAlpha3Rule;

$rule = new CountryAlpha3Rule();
```

### Name

```php
use Elbgoods\CountryRule\Rules\CountryNameRule;

$rule = new CountryNameRule();
```

### Numeric

```php
use Elbgoods\CountryRule\Rules\CountryNumericRule;

$rule = new CountryNumericRule();
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Versioning

This package follows [semantic versioning](https://semver.org/).

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

Please see [SECURITY](SECURITY.md) for details.

## Credits

- [Tom Witkowski](https://github.com/Gummibeer)
- [All Contributors](https://github.com/elbgoods/laravel-country-rule/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

## Treeware

You're free to use this package, but if it makes it to your production environment we would highly appreciate you buying or planting the world a tree.

It’s now common knowledge that one of the best tools to tackle the climate crisis and keep our temperatures from rising above 1.5C is to [plant trees](https://www.bbc.co.uk/news/science-environment-48870920). If you contribute to my forest you’ll be creating employment for local families and restoring wildlife habitats.

You can buy trees at https://offset.earth/treeware

Read more about Treeware at https://treeware.earth

[![We offset our carbon footprint via Offset Earth](https://toolkit.offset.earth/carbonpositiveworkforce/badge/5e186e68516eb60018c5172b?black=true&landscape=true)](https://offset.earth/treeware)
