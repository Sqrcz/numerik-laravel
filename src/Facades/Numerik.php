<?php

declare(strict_types=1);

namespace SlashLab\NumerikLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @mixin \SlashLab\Numerik\Numerik
 */
final class Numerik extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \SlashLab\Numerik\Numerik::class;
    }
}
