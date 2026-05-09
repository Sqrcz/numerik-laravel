<?php

declare(strict_types=1);

namespace SlashLab\NumerikLaravel\Tests\Rules;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use SlashLab\NumerikLaravel\Rules\IdCardRule;
use SlashLab\NumerikLaravel\Tests\TestCase;

final class IdCardRuleTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Lang::addLines(['validation.attributes.id_card' => 'ID Card'], 'en');
    }

    public function test_valid_id_card_passes(): void
    {
        $validator = Validator::make(['id_card' => 'ABC123454'], ['id_card' => new IdCardRule()]);

        $this->assertTrue($validator->passes());
    }

    public function test_lowercase_with_hyphens_passes(): void
    {
        $validator = Validator::make(['id_card' => 'abc-123-454'], ['id_card' => new IdCardRule()]);

        $this->assertTrue($validator->passes());
    }

    public function test_invalid_id_card_fails(): void
    {
        $validator = Validator::make(['id_card' => 'ABC123453'], ['id_card' => new IdCardRule()]);

        $this->assertFalse($validator->passes());
    }

    public function test_empty_string_fails_when_combined_with_required(): void
    {
        $validator = Validator::make(['id_card' => ''], ['id_card' => ['required', new IdCardRule()]]);

        $this->assertFalse($validator->passes());
    }

    public function test_invalid_length_message(): void
    {
        $validator = Validator::make(['id_card' => 'ABC12345'], ['id_card' => new IdCardRule()]);

        $this->assertSame('Identity card number must be exactly 9 characters.', $validator->errors()->first('id_card'));
    }

    public function test_invalid_characters_message(): void
    {
        $validator = Validator::make(['id_card' => '1BC123456'], ['id_card' => new IdCardRule()]);

        $this->assertSame('The ID Card contains invalid characters.', $validator->errors()->first('id_card'));
    }

    public function test_invalid_format_message(): void
    {
        $validator = Validator::make(['id_card' => 'OBC123456'], ['id_card' => new IdCardRule()]);

        $this->assertSame('The ID Card series cannot contain the letters O or Q.', $validator->errors()->first('id_card'));
    }

    public function test_invalid_checksum_message(): void
    {
        $validator = Validator::make(['id_card' => 'ABC123453'], ['id_card' => new IdCardRule()]);

        $this->assertSame('The ID Card checksum digit is incorrect.', $validator->errors()->first('id_card'));
    }

    public function test_string_alias_passes_for_valid_id_card(): void
    {
        $validator = Validator::make(['id_card' => 'ABC123454'], ['id_card' => 'id_card']);

        $this->assertTrue($validator->passes());
    }

    public function test_string_alias_fails_for_invalid_id_card(): void
    {
        $validator = Validator::make(['id_card' => 'ABC123453'], ['id_card' => 'id_card']);

        $this->assertFalse($validator->passes());
    }
}
