<?php

declare(strict_types=1);

namespace SlashLab\NumerikLaravel;

use Illuminate\Support\ServiceProvider;

final class NumerikServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/numerik.php', 'numerik');
    }

    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'numerik');

        $this->publishes([
            __DIR__ . '/../config/numerik.php' => config_path('numerik.php'),
        ], 'numerik-config');

        $this->publishes([
            __DIR__ . '/../resources/lang' => lang_path('vendor/numerik'),
        ], 'numerik-lang');
    }
}
