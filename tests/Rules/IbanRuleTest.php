<?php

declare(strict_types=1);

namespace SlashLab\NumerikLaravel\Tests\Rules;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use SlashLab\NumerikLaravel\Rules\IbanRule;
use SlashLab\NumerikLaravel\Tests\TestCase;

final class IbanRuleTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Lang::addLines(['validation.attributes.iban' => 'IBAN'], 'en');
    }

    public function test_valid_iban_passes(): void
    {
        $validator = Validator::make(['iban' => 'PL61102010260000000000000000'], ['iban' => new IbanRule()]);

        $this->assertTrue($validator->passes());
    }

    public function test_lowercase_prefix_passes(): void
    {
        $validator = Validator::make(['iban' => 'pl61102010260000000000000000'], ['iban' => new IbanRule()]);

        $this->assertTrue($validator->passes());
    }

    public function test_iban_with_spaces_passes(): void
    {
        $validator = Validator::make(['iban' => 'PL61 1020 1026 0000 0000 0000 0000'], ['iban' => new IbanRule()]);

        $this->assertTrue($validator->passes());
    }

    public function test_invalid_iban_fails(): void
    {
        $validator = Validator::make(['iban' => 'PL62102010260000000000000000'], ['iban' => new IbanRule()]);

        $this->assertFalse($validator->passes());
    }

    public function test_empty_string_fails_when_combined_with_required(): void
    {
        $validator = Validator::make(['iban' => ''], ['iban' => ['required', new IbanRule()]]);

        $this->assertFalse($validator->passes());
    }

    public function test_missing_prefix_message(): void
    {
        $validator = Validator::make(['iban' => '61102010260000000000000000'], ['iban' => new IbanRule()]);

        $this->assertSame('The IBAN must start with the PL country prefix.', $validator->errors()->first('iban'));
    }

    public function test_invalid_length_message(): void
    {
        $validator = Validator::make(['iban' => 'PL6110201026000000000000000'], ['iban' => new IbanRule()]);

        $this->assertSame('The IBAN must contain exactly 26 digits after the PL prefix.', $validator->errors()->first('iban'));
    }

    public function test_invalid_characters_message(): void
    {
        $validator = Validator::make(['iban' => 'PL61102010260000000000000ABC'], ['iban' => new IbanRule()]);

        $this->assertSame('The IBAN may only contain digits after the PL prefix.', $validator->errors()->first('iban'));
    }

    public function test_invalid_checksum_message(): void
    {
        $validator = Validator::make(['iban' => 'PL62102010260000000000000000'], ['iban' => new IbanRule()]);

        $this->assertSame('The IBAN checksum is incorrect.', $validator->errors()->first('iban'));
    }

    public function test_string_alias_passes_for_valid_iban(): void
    {
        $validator = Validator::make(['iban' => 'PL61102010260000000000000000'], ['iban' => 'iban']);

        $this->assertTrue($validator->passes());
    }

    public function test_string_alias_fails_for_invalid_iban(): void
    {
        $validator = Validator::make(['iban' => 'PL62102010260000000000000000'], ['iban' => 'iban']);

        $this->assertFalse($validator->passes());
    }
}
