# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

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

[Unreleased]: https://github.com/sqrcz/numerik-laravel/compare/v1.1.0...HEAD
[1.1.0]: https://github.com/sqrcz/numerik-laravel/compare/v1.0.0...v1.1.0
[1.0.0]: https://github.com/sqrcz/numerik-laravel/releases/tag/v1.0.0
