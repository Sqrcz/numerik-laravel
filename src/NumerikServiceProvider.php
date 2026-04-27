<?php

declare(strict_types=1);

namespace SlashLab\NumerikLaravel;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use SlashLab\Numerik\Identifiers\KrsIdentifier;
use SlashLab\Numerik\Identifiers\NipIdentifier;
use SlashLab\Numerik\Identifiers\PeselIdentifier;
use SlashLab\Numerik\Identifiers\RegonIdentifier;

final class NumerikServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/numerik.php', 'numerik');
    }

    public function boot(): void
    {
        $strict = (bool) config('numerik.strict', true);

        if ((bool) config('numerik.rules.pesel', true)) {
            Validator::extend('pesel', static function (string $attr, mixed $value) use ($strict): bool {
                $string = is_scalar($value) ? (string) $value : '';
                return (new PeselIdentifier(strict: $strict))->isValid($string);
            });
        }

        if ((bool) config('numerik.rules.nip', true)) {
            Validator::extend('nip', static function (string $attr, mixed $value) use ($strict): bool {
                $string = is_scalar($value) ? (string) $value : '';
                return (new NipIdentifier(strict: $strict))->isValid($string);
            });
        }

        if ((bool) config('numerik.rules.regon', true)) {
            Validator::extend('regon', static function (string $attr, mixed $value) use ($strict): bool {
                $string = is_scalar($value) ? (string) $value : '';
                return (new RegonIdentifier(strict: $strict))->isValid($string);
            });
        }

        if ((bool) config('numerik.rules.krs', true)) {
            Validator::extend('krs', static function (string $attr, mixed $value) use ($strict): bool {
                $string = is_scalar($value) ? (string) $value : '';
                return (new KrsIdentifier(strict: $strict))->isValid($string);
            });
        }

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'numerik');

        $this->publishes([
            __DIR__ . '/../config/numerik.php' => config_path('numerik.php'),
        ], 'numerik-config');

        $this->publishes([
            __DIR__ . '/../resources/lang' => lang_path('vendor/numerik'),
        ], 'numerik-lang');
    }
}
