<?php

declare(strict_types=1);

namespace SlashLab\NumerikLaravel\Tests\Rules;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use SlashLab\NumerikLaravel\Rules\PassportRule;
use SlashLab\NumerikLaravel\Tests\TestCase;

final class PassportRuleTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Lang::addLines(['validation.attributes.passport' => 'Passport'], 'en');
    }

    public function test_valid_passport_passes(): void
    {
        $validator = Validator::make(['passport' => 'AB1234564'], ['passport' => new PassportRule()]);

        $this->assertTrue($validator->passes());
    }

    public function test_lowercase_with_hyphens_passes(): void
    {
        $validator = Validator::make(['passport' => 'AB-1234564'], ['passport' => new PassportRule()]);

        $this->assertTrue($validator->passes());
    }

    public function test_invalid_passport_fails(): void
    {
        $validator = Validator::make(['passport' => 'AB1234563'], ['passport' => new PassportRule()]);

        $this->assertFalse($validator->passes());
    }

    public function test_empty_string_fails_when_combined_with_required(): void
    {
        $validator = Validator::make(['passport' => ''], ['passport' => ['required', new PassportRule()]]);

        $this->assertFalse($validator->passes());
    }

    public function test_invalid_length_message(): void
    {
        $validator = Validator::make(['passport' => 'AB123456'], ['passport' => new PassportRule()]);

        $this->assertSame('Passport number must be exactly 9 characters.', $validator->errors()->first('passport'));
    }

    public function test_invalid_characters_message(): void
    {
        $validator = Validator::make(['passport' => '1B1234564'], ['passport' => new PassportRule()]);

        $this->assertSame('The Passport contains invalid characters.', $validator->errors()->first('passport'));
    }

    public function test_invalid_checksum_message(): void
    {
        $validator = Validator::make(['passport' => 'AB1234563'], ['passport' => new PassportRule()]);

        $this->assertSame('The Passport checksum digit is incorrect.', $validator->errors()->first('passport'));
    }

    public function test_string_alias_passes_for_valid_passport(): void
    {
        $validator = Validator::make(['passport' => 'AB1234564'], ['passport' => 'passport']);

        $this->assertTrue($validator->passes());
    }

    public function test_string_alias_fails_for_invalid_passport(): void
    {
        $validator = Validator::make(['passport' => 'AB1234563'], ['passport' => 'passport']);

        $this->assertFalse($validator->passes());
    }
}
