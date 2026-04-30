<?php

declare(strict_types=1);

namespace SlashLab\NumerikLaravel\Tests\Rules;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use SlashLab\NumerikLaravel\Rules\RegonRule;
use SlashLab\NumerikLaravel\Tests\TestCase;

final class RegonRuleTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Lang::addLines(['validation.attributes.regon' => 'REGON'], 'en');
    }

    public function test_valid_9_digit_regon_passes(): void
    {
        $validator = Validator::make(['regon' => '850518457'], ['regon' => new RegonRule()]);

        $this->assertTrue($validator->passes());
    }

    public function test_valid_14_digit_regon_passes(): void
    {
        $validator = Validator::make(['regon' => '85051845749370'], ['regon' => new RegonRule()]);

        $this->assertTrue($validator->passes());
    }

    public function test_invalid_regon_fails(): void
    {
        $validator = Validator::make(['regon' => '850518456'], ['regon' => new RegonRule()]);

        $this->assertFalse($validator->passes());
    }

    public function test_empty_string_fails_when_combined_with_required(): void
    {
        $validator = Validator::make(['regon' => ''], ['regon' => ['required', new RegonRule()]]);

        $this->assertFalse($validator->passes());
    }

    public function test_strict_false_parameter_is_accepted(): void
    {
        $validator = Validator::make(['regon' => '850518457'], ['regon' => new RegonRule(strict: false)]);

        $this->assertTrue($validator->passes());
    }

    public function test_fail_message_uses_translation(): void
    {
        $validator = Validator::make(['regon' => '850518456'], ['regon' => new RegonRule()]);

        $this->assertSame('The REGON is not a valid REGON number.', $validator->errors()->first('regon'));
    }

    public function test_string_alias_passes_for_valid_regon(): void
    {
        $validator = Validator::make(['regon' => '850518457'], ['regon' => 'regon']);

        $this->assertTrue($validator->passes());
    }

    public function test_string_alias_fails_for_invalid_regon(): void
    {
        $validator = Validator::make(['regon' => '850518456'], ['regon' => 'regon']);

        $this->assertFalse($validator->passes());
    }
}
