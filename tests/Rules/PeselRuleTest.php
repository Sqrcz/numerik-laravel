<?php

declare(strict_types=1);

namespace SlashLab\NumerikLaravel\Tests\Rules;

use DateTimeImmutable;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use SlashLab\Numerik\Enums\Gender;
use SlashLab\NumerikLaravel\Rules\PeselRule;
use SlashLab\NumerikLaravel\Tests\TestCase;

// 44051401458 — male, born 1944-05-14
// 90123112340 — female, born 1990-12-31

final class PeselRuleTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Lang::addLines(['validation.attributes.pesel' => 'PESEL'], 'en');
    }

    public function test_valid_pesel_passes(): void
    {
        $validator = Validator::make(['pesel' => '44051401458'], ['pesel' => new PeselRule()]);

        $this->assertTrue($validator->passes());
    }

    public function test_invalid_pesel_fails(): void
    {
        $validator = Validator::make(['pesel' => '44051401459'], ['pesel' => new PeselRule()]);

        $this->assertFalse($validator->passes());
    }

    public function test_empty_string_fails_when_combined_with_required(): void
    {
        $validator = Validator::make(['pesel' => ''], ['pesel' => ['required', new PeselRule()]]);

        $this->assertFalse($validator->passes());
    }

    public function test_strict_mode_rejects_all_same_digits(): void
    {
        $validator = Validator::make(['pesel' => '22222222222'], ['pesel' => new PeselRule(strict: true)]);

        $this->assertFalse($validator->passes());
    }

    public function test_non_strict_mode_accepts_all_same_digits(): void
    {
        $validator = Validator::make(['pesel' => '22222222222'], ['pesel' => new PeselRule(strict: false)]);

        $this->assertTrue($validator->passes());
    }

    public function test_strict_mode_rejects_future_birth_date(): void
    {
        $validator = Validator::make(['pesel' => '30210100018'], ['pesel' => new PeselRule(strict: true)]);

        $this->assertFalse($validator->passes());
    }

    public function test_non_strict_mode_accepts_future_birth_date(): void
    {
        $validator = Validator::make(['pesel' => '30210100018'], ['pesel' => new PeselRule(strict: false)]);

        $this->assertTrue($validator->passes());
    }

    public function test_invalid_length_message(): void
    {
        $validator = Validator::make(['pesel' => '123'], ['pesel' => new PeselRule()]);

        $this->assertSame('The PESEL must be exactly 11 digits.', $validator->errors()->first('pesel'));
    }

    public function test_invalid_characters_message(): void
    {
        $validator = Validator::make(['pesel' => 'abc12345678'], ['pesel' => new PeselRule()]);

        $this->assertSame('The PESEL may only contain digits.', $validator->errors()->first('pesel'));
    }

    public function test_invalid_month_message(): void
    {
        $validator = Validator::make(['pesel' => '00001500010'], ['pesel' => new PeselRule()]);

        $this->assertSame('The PESEL contains an invalid month encoding.', $validator->errors()->first('pesel'));
    }

    public function test_invalid_date_message(): void
    {
        $validator = Validator::make(['pesel' => '00013200000'], ['pesel' => new PeselRule()]);

        $this->assertSame('The PESEL contains an invalid date.', $validator->errors()->first('pesel'));
    }

    public function test_invalid_checksum_message(): void
    {
        $validator = Validator::make(['pesel' => '44051401459'], ['pesel' => new PeselRule()]);

        $this->assertSame('The PESEL checksum digit is incorrect.', $validator->errors()->first('pesel'));
    }

    public function test_future_date_message(): void
    {
        $validator = Validator::make(['pesel' => '30210100018'], ['pesel' => new PeselRule(strict: true)]);

        $this->assertSame('The PESEL must belong to a person born in the past.', $validator->errors()->first('pesel'));
    }

    public function test_all_same_digit_message(): void
    {
        $validator = Validator::make(['pesel' => '22222222222'], ['pesel' => new PeselRule(strict: true)]);

        $this->assertSame('The PESEL cannot consist of a single repeated digit.', $validator->errors()->first('pesel'));
    }

    public function test_gender_match_passes(): void
    {
        $validator = Validator::make(
            ['pesel' => '44051401458'],
            ['pesel' => new PeselRule(gender: Gender::Male)],
        );

        $this->assertTrue($validator->passes());
    }

    public function test_gender_mismatch_fails(): void
    {
        $validator = Validator::make(
            ['pesel' => '44051401458'],
            ['pesel' => new PeselRule(gender: Gender::Female)],
        );

        $this->assertFalse($validator->passes());
        $this->assertSame(
            'The PESEL does not match the expected gender.',
            $validator->errors()->first('pesel'),
        );
    }

    public function test_born_before_passes_when_birth_date_is_before_threshold(): void
    {
        $validator = Validator::make(
            ['pesel' => '44051401458'],
            ['pesel' => new PeselRule(bornBefore: new DateTimeImmutable('1945-01-01'))],
        );

        $this->assertTrue($validator->passes());
    }

    public function test_born_before_fails_when_birth_date_equals_threshold(): void
    {
        $validator = Validator::make(
            ['pesel' => '44051401458'],
            ['pesel' => new PeselRule(bornBefore: new DateTimeImmutable('1944-05-14'))],
        );

        $this->assertFalse($validator->passes());
        $this->assertSame(
            'The PESEL must belong to a person born before 1944-05-14.',
            $validator->errors()->first('pesel'),
        );
    }

    public function test_born_before_fails_when_birth_date_is_after_threshold(): void
    {
        $validator = Validator::make(
            ['pesel' => '44051401458'],
            ['pesel' => new PeselRule(bornBefore: new DateTimeImmutable('1944-01-01'))],
        );

        $this->assertFalse($validator->passes());
    }

    public function test_born_after_passes_when_birth_date_is_after_threshold(): void
    {
        $validator = Validator::make(
            ['pesel' => '44051401458'],
            ['pesel' => new PeselRule(bornAfter: new DateTimeImmutable('1943-01-01'))],
        );

        $this->assertTrue($validator->passes());
    }

    public function test_born_after_fails_when_birth_date_equals_threshold(): void
    {
        $validator = Validator::make(
            ['pesel' => '44051401458'],
            ['pesel' => new PeselRule(bornAfter: new DateTimeImmutable('1944-05-14'))],
        );

        $this->assertFalse($validator->passes());
        $this->assertSame(
            'The PESEL must belong to a person born after 1944-05-14.',
            $validator->errors()->first('pesel'),
        );
    }

    public function test_born_after_fails_when_birth_date_is_before_threshold(): void
    {
        $validator = Validator::make(
            ['pesel' => '44051401458'],
            ['pesel' => new PeselRule(bornAfter: new DateTimeImmutable('1945-01-01'))],
        );

        $this->assertFalse($validator->passes());
    }

    public function test_combined_constraints_pass_when_all_match(): void
    {
        $validator = Validator::make(
            ['pesel' => '44051401458'],
            ['pesel' => new PeselRule(
                gender: Gender::Male,
                bornBefore: new DateTimeImmutable('1950-01-01'),
                bornAfter: new DateTimeImmutable('1940-01-01'),
            )],
        );

        $this->assertTrue($validator->passes());
    }

    public function test_constraints_are_skipped_when_base_pesel_is_invalid(): void
    {
        $validator = Validator::make(
            ['pesel' => '44051401459'],
            ['pesel' => new PeselRule(gender: Gender::Male)],
        );

        $this->assertFalse($validator->passes());
        $this->assertSame(
            'The PESEL checksum digit is incorrect.',
            $validator->errors()->first('pesel'),
        );
    }

    public function test_string_alias_passes_for_valid_pesel(): void
    {
        $validator = Validator::make(['pesel' => '44051401458'], ['pesel' => 'pesel']);

        $this->assertTrue($validator->passes());
    }

    public function test_string_alias_fails_for_invalid_pesel(): void
    {
        $validator = Validator::make(['pesel' => '44051401459'], ['pesel' => 'pesel']);

        $this->assertFalse($validator->passes());
    }
}
