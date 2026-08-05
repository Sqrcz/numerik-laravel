<?php

declare(strict_types=1);

namespace SlashLab\NumerikLaravel;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use SlashLab\Numerik\Identifiers\IbanIdentifier;
use SlashLab\Numerik\Identifiers\IdCardIdentifier;
use SlashLab\Numerik\Identifiers\KrsIdentifier;
use SlashLab\Numerik\Identifiers\NipIdentifier;
use SlashLab\Numerik\Identifiers\NrbIdentifier;
use SlashLab\Numerik\Identifiers\PassportIdentifier;
use SlashLab\Numerik\Identifiers\PeselIdentifier;
use SlashLab\Numerik\Identifiers\RegonIdentifier;
use SlashLab\Numerik\Identifiers\VatEuIdentifier;

final class NumerikServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/numerik.php', 'numerik');

        $this->app->bind(\SlashLab\Numerik\Numerik::class, \SlashLab\Numerik\Numerik::class);
    }

    private const array RULES = [
        // Personal
        'pesel'     => PeselIdentifier::class,
        'id_card'   => IdCardIdentifier::class,
        'passport'  => PassportIdentifier::class,

        // Tax & Business
        'nip'       => NipIdentifier::class,
        'vat_eu'    => VatEuIdentifier::class,
        'regon'     => RegonIdentifier::class,
        'krs'       => KrsIdentifier::class,

        // Banking
        'nrb'       => NrbIdentifier::class,
        'iban'      => IbanIdentifier::class,
    ];

    public function boot(): void
    {
        $strict = (bool) config('numerik.strict', true);

        foreach (self::RULES as $rule => $identifierClass) {
            if (! (bool) config("numerik.rules.{$rule}", true)) {
                continue;
            }

            Validator::extend($rule, static function (string $attr, mixed $value) use ($strict, $identifierClass): bool {
                $string = is_scalar($value) ? (string) $value : '';
                return (new $identifierClass(strict: $strict))->isValid($string);
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
