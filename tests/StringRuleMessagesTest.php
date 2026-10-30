<?php

declare(strict_types=1);

namespace SlashLab\NumerikLaravel\Tests;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\DataProvider;

final class StringRuleMessagesTest extends TestCase
{
    /**
     * @return array<string, array{string, string}>
     */
    public static function rules(): array
    {
        return [
            'pesel'    => ['pesel', 'The field name is not a valid PESEL number.'],
            'id_card'  => ['id_card', 'The field name is not a valid Polish ID card number.'],
            'passport' => ['passport', 'The field name is not a valid Polish passport number.'],
            'nip'      => ['nip', 'The field name is not a valid NIP number.'],
            'vat_eu'   => ['vat_eu', 'The field name is not a valid VAT-EU number.'],
            'regon'    => ['regon', 'The field name is not a valid REGON number.'],
            'krs'      => ['krs', 'The field name is not a valid KRS number.'],
            'nrb'      => ['nrb', 'The field name is not a valid NRB account number.'],
            'iban'     => ['iban', 'The field name is not a valid Polish IBAN.'],
        ];
    }

    #[DataProvider('rules')]
    public function test_failure_uses_package_default_message(string $rule, string $expected): void
    {
        $validator = Validator::make(['field_name' => 'invalid'], ['field_name' => $rule]);

        $this->assertSame($expected, $validator->errors()->first('field_name'));
    }

    public function test_message_follows_locale_set_after_boot(): void
    {
        $this->app?->setLocale('pl');

        $validator = Validator::make(['field_name' => 'invalid'], ['field_name' => 'regon']);

        $this->assertSame('Pole field name nie jest prawidłowym numerem REGON.', $validator->errors()->first('field_name'));
    }

    public function test_message_uses_custom_attribute_name(): void
    {
        $validator = Validator::make(['field_name' => 'invalid'], ['field_name' => 'regon'], [], ['field_name' => 'company number']);

        $this->assertSame('The company number is not a valid REGON number.', $validator->errors()->first('field_name'));
    }

    public function test_inline_message_takes_precedence(): void
    {
        $validator = Validator::make(['field_name' => 'invalid'], ['field_name' => 'regon'], ['regon' => 'Inline :attribute']);

        $this->assertSame('Inline field name', $validator->errors()->first('field_name'));
    }

    public function test_application_translation_takes_precedence(): void
    {
        Lang::addLines(['validation.regon' => 'App :attribute'], 'en');

        $validator = Validator::make(['field_name' => 'invalid'], ['field_name' => 'regon']);

        $this->assertSame('App field name', $validator->errors()->first('field_name'));
    }

    public function test_default_message_expands_generic_placeholders(): void
    {
        Lang::addLines(['validation.regon.default' => ':attribute :input :index :position'], 'en', 'numerik');

        $validator = Validator::make(['items' => ['invalid']], ['items.*' => 'regon']);

        $this->assertSame('items.0 invalid 0 1', $validator->errors()->first('items.0'));
    }
}
