# numerik-laravel

[![Tests](https://github.com/sqrcz/numerik-laravel/actions/workflows/tests.yml/badge.svg)](https://github.com/sqrcz/numerik-laravel/actions/workflows/tests.yml)
[![PHPStan](https://img.shields.io/badge/PHPStan-level%2010-brightgreen.svg)](https://phpstan.org)
[![Latest Version](https://img.shields.io/packagist/v/slashlab/numerik-laravel.svg)](https://packagist.org/packages/slashlab/numerik-laravel)
[![PHP Version](https://img.shields.io/packagist/php-v/slashlab/numerik-laravel.svg)](https://packagist.org/packages/slashlab/numerik-laravel)
[![License](https://img.shields.io/github/license/sqrcz/numerik-laravel.svg)](LICENSE)

[English](README.md) | **Polski**

> Gotowe reguły walidacji Laravel dla polskich numerów identyfikacyjnych — PESEL, NIP, REGON, KRS, dowód osobisty, paszport, VAT-EU, NRB oraz IBAN. Pakiet oparty na bibliotece [slashlab/numerik](https://github.com/sqrcz/numerik).

## Wymagania

- PHP 8.3+
- Laravel 12 lub 13

## Instalacja

```bash
composer require slashlab/numerik-laravel
```

Service Provider jest wykrywany automatycznie (Package Discovery) — nie wymaga ręcznej rejestracji.

## Użycie

### Reguły walidacji

Reguł można używać w klasach `FormRequest` lub bezpośrednio w wywołaniach `Validator::make()`:

```php
// Dane osobowe
use SlashLab\NumerikLaravel\Rules\PeselRule;
use SlashLab\NumerikLaravel\Rules\IdCardRule;
use SlashLab\NumerikLaravel\Rules\PassportRule;

// Podatki i rejestry
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

### Tryb ścisły (strict)

Wszystkie reguły przyjmują opcjonalny parametr `strict` (domyślnie `true`). W trybie ścisłym odrzucane są również numery PESEL z datą urodzenia z przyszłości oraz ciągi składające się z samych identycznych cyfr:

```php
new PeselRule(strict: false)
```

### Komunikaty walidacji

Reguły obiektowe (klasowe) zwracają precyzyjny komunikat dopasowany do konkretnej przyczyny błędu — przykładowo NIP z nieprawidłową cyfrą kontrolną zwróci inny komunikat niż NIP o błędnej długości.

Komunikaty błędów automatycznie pobierają nazwę pola z tablicy `validation.attributes` w plikach językowych (dokładnie tak samo, jak wbudowane reguły Laravela). Jeśli pole nie ma tam zdefiniowanej własnej nazwy, zostanie ona sformatowana automatycznie (znaki podkreślenia zostaną zastąpione spacjami, a pierwsza litera zmieniona na wielką).

Pakiet zawiera wbudowane tłumaczenia komunikatów w języku **angielskim** (`en`) i **polskim** (`pl`). Aby opublikować pliki językowe i dostosować je do własnych potrzeb, uruchom:

```bash
php artisan vendor:publish --tag=numerik-lang
```

### Dodatkowe kryteria dla PeselRule

Klasa `PeselRule` przyjmuje dodatkowe parametry pozwalające zawęzić warunki walidacji:

```php
new PeselRule(
    gender: Gender::Female,
    bornBefore: new DateTimeImmutable('2000-01-01'),
    bornAfter: new DateTimeImmutable('1980-01-01'),
)
```

Wszystkie parametry są opcjonalne i można je dowolnie łączyć.

### Reguły tekstowe (string)

Reguły są również dostępne w tradycyjnej formie tekstowej (rejestrowanej automatycznie przez Service Provider):

```php
// Dane osobowe
'pesel'    => ['required', 'pesel'],
'id_card'  => ['required', 'id_card'],
'passport' => ['required', 'passport'],

// Podatki i rejestry
'nip'    => ['required', 'nip'],
'vat_eu' => ['required', 'vat_eu'],
'regon'  => ['required', 'regon'],
'krs'    => ['required', 'krs'],

// Bankowość
'nrb'  => ['required', 'nrb'],
'iban' => ['required', 'iban'],
```

Reguły w formie tekstowej zawsze zwracają ogólny komunikat błędu, niezależnie od dokładnej przyczyny odrzucenia numeru. Jeśli zależy Ci na precyzyjnych komunikatach dla poszczególnych błędów, użyj reguł obiektowych (`new NipRule()`).

## Historia zmian

Zobacz plik [CHANGELOG.md](CHANGELOG.md).

## Współtworzenie

Zobacz plik [CONTRIBUTING.md](CONTRIBUTING.md).

## Bezpieczeństwo

Zobacz plik [SECURITY.md](SECURITY.md).

## Licencja

Licencja MIT — szczegóły w pliku [LICENSE](LICENSE).

---

Jeśli ten pakiet zaoszczędził Twój czas → [☕ postaw mi kawę](https://buymeacoffee.com/sqrcz)

---
**Słowa kluczowe:** php, laravel, walidacja nip laravel, sprawdzanie pesel, walidacja regon, walidacja krs, walidacja polskich numerów identyfikacyjnych, reguły walidacji laravel, nip php, pesel php, dowód osobisty, paszport, vat-ue, vat-eu, nrb, iban
