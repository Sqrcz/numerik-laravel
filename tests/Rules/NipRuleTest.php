<?php

declare(strict_types=1);

namespace SlashLab\NumerikLaravel\Tests\Rules;

use Illuminate\Support\Facades\Validator;
use SlashLab\NumerikLaravel\Rules\NipRule;
use SlashLab\NumerikLaravel\Tests\TestCase;

final class NipRuleTest extends TestCase
{
    public function test_valid_nip_passes(): void
    {
        $validator = Validator::make(['nip' => '5260250274'], ['nip' => new NipRule()]);

        $this->assertTrue($validator->passes());
    }

    public function test_invalid_nip_fails(): void
    {
        $validator = Validator::make(['nip' => '5260250275'], ['nip' => new NipRule()]);

        $this->assertFalse($validator->passes());
    }

    public function test_empty_string_fails_when_combined_with_required(): void
    {
        $validator = Validator::make(['nip' => ''], ['nip' => ['required', new NipRule()]]);

        $this->assertFalse($validator->passes());
    }

    public function test_strict_mode_rejects_all_same_digits(): void
    {
        $validator = Validator::make(['nip' => '1111111111'], ['nip' => new NipRule(strict: true)]);

        $this->assertFalse($validator->passes());
    }

    public function test_non_strict_mode_accepts_all_same_digits(): void
    {
        $validator = Validator::make(['nip' => '1111111111'], ['nip' => new NipRule(strict: false)]);

        $this->assertTrue($validator->passes());
    }

    public function test_fail_message_uses_translation(): void
    {
        $validator = Validator::make(['field' => '5260250275'], ['field' => new NipRule()]);

        $this->assertSame('The field is not a valid NIP number.', $validator->errors()->first('field'));
    }

    public function test_string_alias_passes_for_valid_nip(): void
    {
        $validator = Validator::make(['nip' => '5260250274'], ['nip' => 'nip']);

        $this->assertTrue($validator->passes());
    }

    public function test_string_alias_fails_for_invalid_nip(): void
    {
        $validator = Validator::make(['nip' => '5260250275'], ['nip' => 'nip']);

        $this->assertFalse($validator->passes());
    }
}
