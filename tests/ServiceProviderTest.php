<?php

declare(strict_types=1);

namespace SlashLab\NumerikLaravel\Tests;

use SlashLab\NumerikLaravel\NumerikServiceProvider;

final class ServiceProviderTest extends TestCase
{
    public function test_provider_is_loaded(): void
    {
        $this->assertArrayHasKey(NumerikServiceProvider::class, $this->app?->getLoadedProviders() ?? []);
    }

    public function test_config_has_strict_default(): void
    {
        $this->assertTrue(config('numerik.strict'));
    }

    public function test_config_has_all_rule_keys(): void
    {
        $rules = config('numerik.rules');

        $this->assertIsArray($rules);
        $this->assertTrue($rules['pesel']);
        $this->assertTrue($rules['nip']);
        $this->assertTrue($rules['regon']);
        $this->assertTrue($rules['krs']);
    }

    public function test_config_can_be_overridden(): void
    {
        config(['numerik.strict' => false]);

        $this->assertFalse(config('numerik.strict'));
    }

    public function test_translations_are_loaded(): void
    {
        $this->assertSame(
            'The field is not a valid NIP number.',
            trans('numerik::validation.nip', ['attribute' => 'field']),
        );
    }

    public function test_all_translation_keys_exist(): void
    {
        $replacements = ['attribute' => 'field', 'date' => '2000-01-01'];

        $this->assertSame('The field is not a valid PESEL number.', trans('numerik::validation.pesel', $replacements));
        $this->assertSame('The field is not a valid NIP number.', trans('numerik::validation.nip', $replacements));
        $this->assertSame('The field is not a valid REGON number.', trans('numerik::validation.regon', $replacements));
        $this->assertSame('The field is not a valid KRS number.', trans('numerik::validation.krs', $replacements));
        $this->assertSame('The field does not match the expected gender.', trans('numerik::validation.pesel_gender', $replacements));
        $this->assertSame('The field must belong to a person born before 2000-01-01.', trans('numerik::validation.pesel_born_before', $replacements));
        $this->assertSame('The field must belong to a person born after 2000-01-01.', trans('numerik::validation.pesel_born_after', $replacements));
    }
}
