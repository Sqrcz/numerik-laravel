# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.4.0] - 2026-06-25

### Removed

- Laravel 11 support dropped — the entire `laravel/framework:11.*` range reached end of life in August 2025 and has unresolved security advisories. Minimum supported version is now Laravel 12.

## [1.3.0] - 2026-05-09

### Added

- `IdCardRule` — Polish ID card (*Dowód osobisty*) validation, with per-reason messages (`invalid_length`, `invalid_characters`, `invalid_format`, `invalid_checksum`)
- `PassportRule` — Polish passport (*Paszport*) validation, with per-reason messages (`invalid_length`, `invalid_characters`, `invalid_checksum`)
- `VatEuRule` — EU VAT number (*Numer VAT UE*) validation, with per-reason messages (`invalid_length`, `invalid_format`, `invalid_characters`, `invalid_checksum`, `all_same_digit`)
- `NrbRule` — Polish bank account number (*NRB*) validation, with per-reason messages (`invalid_length`, `invalid_characters`, `invalid_checksum`)
- `IbanRule` — Polish IBAN validation, with per-reason messages (`invalid_length`, `invalid_format`, `invalid_characters`, `invalid_checksum`)
- String-based aliases `id_card`, `passport`, `vat_eu`, `nrb`, `iban` registered via service provider
- English (`en`) and Polish (`pl`) translations for all five new rule groups
- Config keys `rules.id_card`, `rules.passport`, `rules.vat_eu`, `rules.nrb`, `rules.iban` (all default `true`)

### Changed

- Bumped `slashlab/numerik` requirement from `^1.0` to `^1.1`

## [1.2.0] - 2026-05-01

### Fixed

- Attribute name humanisation now uses `Str::ucfirst()` instead of `ucfirst()`, correctly capitalising multibyte (e.g. accented) first characters.

### Changed

- Validation error messages now resolve the field label from `validation.attributes.*` when available, matching Laravel's built-in rule behaviour. Falls back to a humanised version of the field name (underscores replaced with spaces, first letter capitalised).

## [1.1.0] - 2026-04-29

### Added

- Polish (`pl`) translations for all validation messages
- Per-reason validation messages for `NipRule`, `KrsRule`, and `PeselRule`. Each failure reason (invalid checksum, invalid length, invalid format, etc.) now returns a specific message instead of a generic one. `RegonRule` is unchanged — granular messages for REGON are deferred.

### Changed

- Translation keys for `nip`, `krs`, and `pesel` are now nested arrays. Each key has a `default` entry (used as a fallback for unknown reasons) plus one entry per `ValidationFailureReason`. The `regon` key and all `pesel_gender` / `pesel_born_before` / `pesel_born_after` keys are unchanged.

> **Upgrading from 1.0.0:** only affects you if you ran `vendor:publish --tag=numerik-lang`. If you did, convert the `nip`, `krs`, and `pesel` keys in your published file from flat strings to nested arrays matching the structure in [`resources/lang/en/validation.php`](resources/lang/en/validation.php).

## [1.0.0] - 2026-04-27

### Added

- `PeselRule`, `NipRule`, `RegonRule`, `KrsRule` validation rule classes
- String-based aliases (`pesel`, `nip`, `regon`, `krs`) registered via service provider
- `PeselRule` constraint parameters: `gender`, `bornBefore`, `bornAfter`
- `strict` mode parameter on all rules (default `true`)
- `NumerikServiceProvider` with auto-discovery, config publishing, and translation publishing
- `Numerik` facade
- Support for Laravel 11, 12, and 13

---

[Unreleased]: https://github.com/sqrcz/numerik-laravel/compare/v1.3.0...HEAD
[1.3.0]: https://github.com/sqrcz/numerik-laravel/compare/v1.2.0...v1.3.0
[1.2.0]: https://github.com/sqrcz/numerik-laravel/compare/v1.1.0...v1.2.0
[1.1.0]: https://github.com/sqrcz/numerik-laravel/compare/v1.0.0...v1.1.0
[1.0.0]: https://github.com/sqrcz/numerik-laravel/releases/tag/v1.0.0
