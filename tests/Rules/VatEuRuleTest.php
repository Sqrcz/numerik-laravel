<?php

declare(strict_types=1);

namespace SlashLab\NumerikLaravel\Tests\Rules;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use SlashLab\NumerikLaravel\Rules\VatEuRule;
use SlashLab\NumerikLaravel\Tests\TestCase;

final class VatEuRuleTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Lang::addLines(['validation.attributes.vat_eu' => 'VAT-EU'], 'en');
    }

    public function test_valid_vat_eu_passes(): void
    {
        $validator = Validator::make(['vat_eu' => 'PL5260250274'], ['vat_eu' => new VatEuRule()]);

        $this->assertTrue($validator->passes());
    }

    public function test_lowercase_prefix_passes(): void
    {
        $validator = Validator::make(['vat_eu' => 'pl5260250274'], ['vat_eu' => new VatEuRule()]);

        $this->assertTrue($validator->passes());
    }

    public function test_invalid_vat_eu_fails(): void
    {
        $validator = Validator::make(['vat_eu' => 'PL5260250275'], ['vat_eu' => new VatEuRule()]);

        $this->assertFalse($validator->passes());
    }

    public function test_empty_string_fails_when_combined_with_required(): void
    {
        $validator = Validator::make(['vat_eu' => ''], ['vat_eu' => ['required', new VatEuRule()]]);

        $this->assertFalse($validator->passes());
    }

    public function test_strict_mode_rejects_all_same_digits(): void
    {
        $validator = Validator::make(['vat_eu' => 'PL1111111111'], ['vat_eu' => new VatEuRule(strict: true)]);

        $this->assertFalse($validator->passes());
    }

    public function test_non_strict_mode_accepts_all_same_digits(): void
    {
        $validator = Validator::make(['vat_eu' => 'PL1111111111'], ['vat_eu' => new VatEuRule(strict: false)]);

        $this->assertTrue($validator->passes());
    }

    public function test_missing_prefix_message(): void
    {
        $validator = Validator::make(['vat_eu' => '5260250274'], ['vat_eu' => new VatEuRule()]);

        $this->assertSame('The VAT-EU must start with the PL country prefix.', $validator->errors()->first('vat_eu'));
    }

    public function test_invalid_length_message(): void
    {
        $validator = Validator::make(['vat_eu' => 'PL526025027'], ['vat_eu' => new VatEuRule()]);

        $this->assertSame('VAT-EU number must contain exactly 10 digits after the PL prefix.', $validator->errors()->first('vat_eu'));
    }

    public function test_invalid_checksum_message(): void
    {
        $validator = Validator::make(['vat_eu' => 'PL5260250275'], ['vat_eu' => new VatEuRule()]);

        $this->assertSame('The VAT-EU checksum digit is incorrect.', $validator->errors()->first('vat_eu'));
    }

    public function test_all_same_digit_message(): void
    {
        $validator = Validator::make(['vat_eu' => 'PL1111111111'], ['vat_eu' => new VatEuRule(strict: true)]);

        $this->assertSame('The VAT-EU cannot consist of a single repeated digit.', $validator->errors()->first('vat_eu'));
    }

    public function test_string_alias_passes_for_valid_vat_eu(): void
    {
        $validator = Validator::make(['vat_eu' => 'PL5260250274'], ['vat_eu' => 'vat_eu']);

        $this->assertTrue($validator->passes());
    }

    public function test_string_alias_fails_for_invalid_vat_eu(): void
    {
        $validator = Validator::make(['vat_eu' => 'PL5260250275'], ['vat_eu' => 'vat_eu']);

        $this->assertFalse($validator->passes());
    }
}
