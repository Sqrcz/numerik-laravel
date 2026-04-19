# Contributing to numerik-laravel

Thank you for your interest in contributing!

## Development Setup

```bash
git clone https://github.com/sqrcz/numerik-laravel.git
cd numerik-laravel
composer install
```

## Running Checks Locally

```bash
composer test        # PHPUnit test suite (via Orchestra Testbench)
composer stan        # PHPStan static analysis (level 10)
composer cs-fix      # Fix code style automatically
composer cs-check    # Check code style without fixing
composer check       # Run cs-check + stan + test in sequence
```

## Workflow

- All changes go through a pull request — no direct commits to `main`
- Keep PRs focused — one feature or fix per PR
- Use [Conventional Commits](https://www.conventionalcommits.org) for commit messages

## Commit Message Format

- `feat`: add `PeselRule` gender constraint parameter
- `fix`: correct error message key for REGON
- `docs`: update usage examples for strict mode
- `test`: add Orchestra Testbench coverage for string-based rule aliases
- `chore`: update `orchestra/testbench` to v10
- `refactor`: extract rule registration to dedicated method

## Adding Support for a New Identifier

When the core `slashlab/numerik` package gains a new identifier, add the bridge support here. Every addition requires all of the following — PRs missing any item will not be merged:

- [ ] `src/Rules/NewIdentifierRule.php` — implements `Illuminate\Contracts\Validation\ValidationRule`
- [ ] Rule registered in `NumerikServiceProvider::boot()` under its string alias
- [ ] Translation key added to `resources/lang/en/validation.php`
- [ ] Tests in `tests/Rules/NewIdentifierRuleTest.php` covering valid, invalid, and edge cases
- [ ] `CHANGELOG.md` updated under `[Unreleased]`

## Code Style

PSR-12 with additional rules enforced by PHP CS Fixer.
Run `composer cs-fix` before committing — CI will reject style violations.

## Reporting Bugs

Use the [Bug Report](https://github.com/sqrcz/numerik-laravel/issues/new?template=bug_report.yml) template.

## Security

See [SECURITY.md](SECURITY.md).
