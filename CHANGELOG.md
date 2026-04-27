# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

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

[Unreleased]: https://github.com/sqrcz/numerik-laravel/compare/v1.0.0...HEAD
[1.0.0]: https://github.com/sqrcz/numerik-laravel/releases/tag/v1.0.0
