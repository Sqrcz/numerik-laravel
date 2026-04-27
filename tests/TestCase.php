<?php

declare(strict_types=1);

namespace SlashLab\NumerikLaravel\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use SlashLab\NumerikLaravel\NumerikServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            NumerikServiceProvider::class,
        ];
    }
}
