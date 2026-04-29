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
            trans('numerik::validation.nip.default', ['attribute' => 'field']),
        );
    }

    public function test_all_translation_keys_exist(): void
    {
        $attr = ['attribute' => 'field'];
        $date = ['attribute' => 'field', 'date' => '2000-01-01'];

        $this->assertSame('The field is not a valid NIP number.', trans('numerik::validation.nip.default', $attr));
        $this->assertSame('NIP must be exactly 10 digits.', trans('numerik::validation.nip.invalid_length', $attr));
        $this->assertSame('The field may only contain digits and hyphens.', trans('numerik::validation.nip.invalid_characters', $attr));
        $this->assertSame('The field tax office code cannot start with 000.', trans('numerik::validation.nip.invalid_format', $attr));
        $this->assertSame('The field checksum digit is incorrect.', trans('numerik::validation.nip.invalid_checksum', $attr));
        $this->assertSame('The field cannot consist of a single repeated digit.', trans('numerik::validation.nip.all_same_digit', $attr));

        $this->assertSame('The field is not a valid KRS number.', trans('numerik::validation.krs.default', $attr));
        $this->assertSame('KRS must be between 1 and 10 digits.', trans('numerik::validation.krs.invalid_length', $attr));
        $this->assertSame('The field may only contain digits.', trans('numerik::validation.krs.invalid_characters', $attr));
        $this->assertSame('The field cannot be all zeros.', trans('numerik::validation.krs.all_zeros', $attr));
        $this->assertSame('The field cannot consist of a single repeated digit.', trans('numerik::validation.krs.all_same_digit', $attr));

        $this->assertSame('The field is not a valid PESEL number.', trans('numerik::validation.pesel.default', $attr));
        $this->assertSame('PESEL must be exactly 11 digits.', trans('numerik::validation.pesel.invalid_length', $attr));
        $this->assertSame('The field may only contain digits.', trans('numerik::validation.pesel.invalid_characters', $attr));
        $this->assertSame('The field contains an invalid month encoding.', trans('numerik::validation.pesel.invalid_month', $attr));
        $this->assertSame('The field contains an invalid date.', trans('numerik::validation.pesel.invalid_date', $attr));
        $this->assertSame('The field checksum digit is incorrect.', trans('numerik::validation.pesel.invalid_checksum', $attr));
        $this->assertSame('The field must belong to a person born in the past.', trans('numerik::validation.pesel.future_date', $attr));
        $this->assertSame('The field cannot consist of a single repeated digit.', trans('numerik::validation.pesel.all_same_digit', $attr));

        $this->assertSame('The field is not a valid REGON number.', trans('numerik::validation.regon', $attr));
        $this->assertSame('The field does not match the expected gender.', trans('numerik::validation.pesel_gender', $attr));
        $this->assertSame('The field must belong to a person born before 2000-01-01.', trans('numerik::validation.pesel_born_before', $date));
        $this->assertSame('The field must belong to a person born after 2000-01-01.', trans('numerik::validation.pesel_born_after', $date));
    }
}
