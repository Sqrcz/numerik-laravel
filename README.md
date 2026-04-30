# numerik-laravel

[![Tests](https://github.com/sqrcz/numerik-laravel/actions/workflows/tests.yml/badge.svg)](https://github.com/sqrcz/numerik-laravel/actions/workflows/tests.yml)
[![Latest Version](https://img.shields.io/packagist/v/slashlab/numerik-laravel.svg)](https://packagist.org/packages/slashlab/numerik-laravel)
[![PHP Version](https://img.shields.io/packagist/php-v/slashlab/numerik-laravel.svg)](https://packagist.org/packages/slashlab/numerik-laravel)
[![License](https://img.shields.io/github/license/sqrcz/numerik-laravel.svg)](LICENSE)

> Laravel validation rules for Polish identification numbers — PESEL, NIP, REGON, and KRS. Powered by [slashlab/numerik](https://github.com/sqrcz/numerik).

## Requirements

- PHP 8.3+
- Laravel 11, 12, or 13

## Installation

```bash
composer require slashlab/numerik-laravel
```

The service provider is auto-discovered — no manual registration needed.

## Usage

### Validation rules

Use the rules in form requests or `Validator::make()` calls:

```php
use SlashLab\NumerikLaravel\Rules\PeselRule;
use SlashLab\NumerikLaravel\Rules\NipRule;
use SlashLab\NumerikLaravel\Rules\RegonRule;
use SlashLab\NumerikLaravel\Rules\KrsRule;

public function rules(): array
{
    return [
        'pesel' => ['required', new PeselRule()],
        'nip'   => ['required', new NipRule()],
        'regon' => ['required', new RegonRule()],
        'krs'   => ['required', new KrsRule()],
    ];
}
```

### Strict mode

All rules accept an optional `strict` parameter (default `true`). In strict mode, PESELs with future birth dates or all-identical digits are rejected:

```php
new PeselRule(strict: false)
```

### Validation messages

Class-based rules return a specific message for each failure reason — for example, a NIP with a wrong checksum digit returns a different message than one with an invalid length.

Error messages use the field label registered in `validation.attributes` when one is found, matching the behaviour of Laravel's built-in rules. If no label is registered, the field name is humanised (underscores replaced with spaces, first letter capitalised).

The package ships with **English** (`en`) and **Polish** (`pl`) translations. To publish and customise them:

```bash
php artisan vendor:publish --tag=numerik-lang
```

### String-based rules

Rules are also available as strings via the service provider:

```php
'pesel' => ['required', 'pesel'],
'nip'   => ['required', 'nip'],
'regon' => ['required', 'regon'],
'krs'   => ['required', 'krs'],
```

String-based rules always return a generic message regardless of the failure reason. Use the class-based rules when specific messages matter.

## Changelog

See [CHANGELOG.md](CHANGELOG.md).

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md).

## Security

See [SECURITY.md](SECURITY.md).

## License

MIT — see [LICENSE](LICENSE).

---

If this saved you time → [☕ Buy me a coffee](https://buymeacoffee.com/sqrcz)
