<?php

declare(strict_types=1);

namespace SlashLab\NumerikLaravel\Tests\Rules;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use SlashLab\NumerikLaravel\Rules\NrbRule;
use SlashLab\NumerikLaravel\Tests\TestCase;

final class NrbRuleTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Lang::addLines(['validation.attributes.nrb' => 'NRB'], 'en');
    }

    public function test_valid_nrb_passes(): void
    {
        $validator = Validator::make(['nrb' => '61102010260000000000000000'], ['nrb' => new NrbRule()]);

        $this->assertTrue($validator->passes());
    }

    public function test_nrb_with_spaces_passes(): void
    {
        $validator = Validator::make(['nrb' => '61 1020 1026 0000 0000 0000 0000'], ['nrb' => new NrbRule()]);

        $this->assertTrue($validator->passes());
    }

    public function test_nrb_with_iban_prefix_passes(): void
    {
        $validator = Validator::make(['nrb' => 'PL61102010260000000000000000'], ['nrb' => new NrbRule()]);

        $this->assertTrue($validator->passes());
    }

    public function test_invalid_nrb_fails(): void
    {
        $validator = Validator::make(['nrb' => '62102010260000000000000000'], ['nrb' => new NrbRule()]);

        $this->assertFalse($validator->passes());
    }

    public function test_empty_string_fails_when_combined_with_required(): void
    {
        $validator = Validator::make(['nrb' => ''], ['nrb' => ['required', new NrbRule()]]);

        $this->assertFalse($validator->passes());
    }

    public function test_invalid_length_message(): void
    {
        $validator = Validator::make(['nrb' => '6110201026000000000000000'], ['nrb' => new NrbRule()]);

        $this->assertSame('The NRB must be exactly 26 digits.', $validator->errors()->first('nrb'));
    }

    public function test_invalid_characters_message(): void
    {
        $validator = Validator::make(['nrb' => '61102010260000000000000ABC'], ['nrb' => new NrbRule()]);

        $this->assertSame('The NRB may only contain digits.', $validator->errors()->first('nrb'));
    }

    public function test_invalid_checksum_message(): void
    {
        $validator = Validator::make(['nrb' => '62102010260000000000000000'], ['nrb' => new NrbRule()]);

        $this->assertSame('The NRB checksum (MOD-97) is incorrect.', $validator->errors()->first('nrb'));
    }

    public function test_string_alias_passes_for_valid_nrb(): void
    {
        $validator = Validator::make(['nrb' => '61102010260000000000000000'], ['nrb' => 'nrb']);

        $this->assertTrue($validator->passes());
    }

    public function test_string_alias_fails_for_invalid_nrb(): void
    {
        $validator = Validator::make(['nrb' => '62102010260000000000000000'], ['nrb' => 'nrb']);

        $this->assertFalse($validator->passes());
    }
}
