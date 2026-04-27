<?php

declare(strict_types=1);

namespace SlashLab\NumerikLaravel\Tests\Rules;

use Illuminate\Support\Facades\Validator;
use SlashLab\NumerikLaravel\Rules\KrsRule;
use SlashLab\NumerikLaravel\Tests\TestCase;

final class KrsRuleTest extends TestCase
{
    public function test_valid_krs_passes(): void
    {
        $validator = Validator::make(['krs' => '0000127206'], ['krs' => new KrsRule()]);

        $this->assertTrue($validator->passes());
    }

    public function test_invalid_krs_fails(): void
    {
        $validator = Validator::make(['krs' => '0000000000'], ['krs' => new KrsRule()]);

        $this->assertFalse($validator->passes());
    }

    public function test_empty_string_fails_when_combined_with_required(): void
    {
        $validator = Validator::make(['krs' => ''], ['krs' => ['required', new KrsRule()]]);

        $this->assertFalse($validator->passes());
    }

    public function test_strict_mode_rejects_all_same_digits(): void
    {
        $validator = Validator::make(['krs' => '1111111111'], ['krs' => new KrsRule(strict: true)]);

        $this->assertFalse($validator->passes());
    }

    public function test_non_strict_mode_accepts_all_same_digits(): void
    {
        $validator = Validator::make(['krs' => '1111111111'], ['krs' => new KrsRule(strict: false)]);

        $this->assertTrue($validator->passes());
    }

    public function test_fail_message_uses_translation(): void
    {
        $validator = Validator::make(['field' => '0000000000'], ['field' => new KrsRule()]);

        $this->assertSame('The field is not a valid KRS number.', $validator->errors()->first('field'));
    }

    public function test_string_alias_passes_for_valid_krs(): void
    {
        $validator = Validator::make(['krs' => '0000127206'], ['krs' => 'krs']);

        $this->assertTrue($validator->passes());
    }

    public function test_string_alias_fails_for_invalid_krs(): void
    {
        $validator = Validator::make(['krs' => '0000000000'], ['krs' => 'krs']);

        $this->assertFalse($validator->passes());
    }
}
