[🇬🇧 English](README.md) | [🇵🇱 Polski](README.pl.md)

# numerik-laravel

[![Tests](https://github.com/sqrcz/numerik-laravel/actions/workflows/tests.yml/badge.svg)](https://github.com/sqrcz/numerik-laravel/actions/workflows/tests.yml)
[![PHPStan](https://img.shields.io/badge/PHPStan-level%2010-brightgreen.svg)](https://phpstan.org)
[![Latest Version](https://img.shields.io/packagist/v/slashlab/numerik-laravel.svg)](https://packagist.org/packages/slashlab/numerik-laravel)
[![PHP Version](https://img.shields.io/packagist/php-v/slashlab/numerik-laravel.svg)](https://packagist.org/packages/slashlab/numerik-laravel)
[![License](https://img.shields.io/github/license/sqrcz/numerik-laravel.svg)](LICENSE)
[![CodeRabbit](https://img.shields.io/coderabbit/prs/github/sqrcz/numerik-laravel)](https://coderabbit.ai)

> Reguły walidacji Laravel dla polskich numerów identyfikacyjnych — PESEL, NIP, REGON, KRS, dowód osobisty, paszport, VAT-UE, NRB oraz IBAN. Oparte na [slashlab/numerik](https://github.com/sqrcz/numerik).

## Wymagania

- PHP 8.3+
- Laravel 12 lub 13

## Instalacja

```bash
composer require slashlab/numerik-laravel
```

Provider jest wykrywany automatycznie (Package Discovery) — nie trzeba go rejestrować ręcznie.

## Użycie

### Reguły walidacji

Reguł można używać w klasach FormRequest lub w wywołaniach `Validator::make()`:

```php
// Dane osobowe
use SlashLab\NumerikLaravel\Rules\PeselRule;
use SlashLab\NumerikLaravel\Rules\IdCardRule;
use SlashLab\NumerikLaravel\Rules\PassportRule;

// Podatki i działalność gospodarcza
use SlashLab\NumerikLaravel\Rules\NipRule;
use SlashLab\NumerikLaravel\Rules\VatEuRule;
use SlashLab\NumerikLaravel\Rules\RegonRule;
use SlashLab\NumerikLaravel\Rules\KrsRule;

// Bankowość
use SlashLab\NumerikLaravel\Rules\NrbRule;
use SlashLab\NumerikLaravel\Rules\IbanRule;

public function rules(): array
{
    return [
        'pesel'    => ['required', new PeselRule()],
        'id_card'  => ['required', new IdCardRule()],
        'passport' => ['required', new PassportRule()],
        'nip'      => ['required', new NipRule()],
        'vat_eu'   => ['required', new VatEuRule()],
        'regon'    => ['required', new RegonRule()],
        'krs'      => ['required', new KrsRule()],
        'nrb'      => ['required', new NrbRule()],
        'iban'     => ['required', new IbanRule()],
    ];
}
```

### Tryb strict

Wszystkie reguły przyjmują opcjonalny parametr `strict` (domyślnie `true`). W trybie strict odrzucane są numery PESEL z datą urodzenia w przyszłości oraz numery złożone z samych identycznych cyfr:

```php
new PeselRule(strict: false)
```

### Komunikaty walidacji

Reguły klasowe zwracają dedykowany komunikat dla każdej przyczyny błędu — na przykład NIP z błędną cyfrą kontrolną zwraca inny komunikat niż NIP o nieprawidłowej długości.

Komunikaty błędów korzystają z etykiety pola zarejestrowanej w `validation.attributes`, jeśli taka istnieje — dokładnie tak samo jak wbudowane reguły Laravela. Jeśli etykieta nie jest zarejestrowana, nazwa pola jest humanizowana (podkreślenia zamieniane na spacje, pierwsza litera wielka).

Pakiet zawiera gotowe tłumaczenia komunikatów w języku **angielskim** (`en`) i **polskim** (`pl`). Aby je opublikować i dostosować:

```bash
php artisan vendor:publish --tag=numerik-lang
```

### Dodatkowe ograniczenia PeselRule

`PeselRule` przyjmuje dodatkowe parametry umożliwiające dokładniejszą weryfikację tożsamości:

```php
new PeselRule(
    gender: Gender::Female,
    bornBefore: new DateTimeImmutable('2000-01-01'),
    bornAfter: new DateTimeImmutable('1980-01-01'),
)
```

Wszystkie parametry są opcjonalne i można je dowolnie łączyć.

### Reguły w formie ciągu znaków

Reguły są też dostępne jako proste stringi, rejestrowane przez service provider:

```php
// Dane osobowe
'pesel'    => ['required', 'pesel'],
'id_card'  => ['required', 'id_card'],
'passport' => ['required', 'passport'],

// Podatki i działalność gospodarcza
'nip'    => ['required', 'nip'],
'vat_eu' => ['required', 'vat_eu'],
'regon'  => ['required', 'regon'],
'krs'    => ['required', 'krs'],

// Bankowość
'nrb'  => ['required', 'nrb'],
'iban' => ['required', 'iban'],
```

Reguły w formie stringów zawsze zwracają ogólny komunikat, niezależnie od przyczyny błędu. Gdy zależy Ci na konkretnym komunikacie dla każdej przyczyny, użyj reguł klasowych.

## Historia zmian

Zobacz [CHANGELOG.md](CHANGELOG.md).

## Współpraca

Zobacz [CONTRIBUTING.md](CONTRIBUTING.md).

## Bezpieczeństwo

Zobacz [SECURITY.md](SECURITY.md).

## Licencja

MIT — zobacz [LICENSE](LICENSE).

---

Jeśli ten pakiet zaoszczędził Ci czasu → [☕ postaw mi kawę](https://buymeacoffee.com/sqrcz)

---
**Słowa kluczowe:** php, laravel, walidacja nip laravel, sprawdzanie pesel, walidacja regon, walidacja krs, walidacja polskich numerów identyfikacyjnych, reguły walidacji laravel, nip php, pesel php, dowód osobisty, paszport, vat-ue, nrb, iban
