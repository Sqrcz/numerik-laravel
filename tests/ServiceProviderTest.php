<?php

declare(strict_types=1);

namespace SlashLab\NumerikLaravel\Tests;

use SlashLab\NumerikLaravel\NumerikServiceProvider;

final class ServiceProviderTest extends TestCase
{
    public function test_provider_is_loaded(): void
    {
        $this->assertArrayHasKey(NumerikServiceProvider::class, $this->app?->getLoadedProviders() ?? []);
    }

    public function test_config_has_strict_default(): void
    {
        $this->assertTrue(config('numerik.strict'));
    }

    public function test_config_has_all_rule_keys(): void
    {
        $rules = config('numerik.rules');

        $this->assertIsArray($rules);
        $this->assertTrue($rules['pesel']);
        $this->assertTrue($rules['nip']);
        $this->assertTrue($rules['regon']);
        $this->assertTrue($rules['krs']);
        $this->assertTrue($rules['id_card']);
        $this->assertTrue($rules['passport']);
        $this->assertTrue($rules['vat_eu']);
        $this->assertTrue($rules['nrb']);
        $this->assertTrue($rules['iban']);
    }

    public function test_config_can_be_overridden(): void
    {
        config(['numerik.strict' => false]);

        $this->assertFalse(config('numerik.strict'));
    }

    public function test_translations_are_loaded(): void
    {
        $this->assertSame(
            'The NIP is not a valid NIP number.',
            trans('numerik::validation.nip.default', ['attribute' => 'NIP']),
        );
    }

    public function test_all_translation_keys_exist(): void
    {
        $nip = ['attribute' => 'NIP'];
        $krs = ['attribute' => 'KRS'];
        $pesel = ['attribute' => 'PESEL'];
        $regon = ['attribute' => 'REGON'];
        $peselBefore = ['attribute' => 'PESEL', 'date' => '2000-01-01'];
        $peselAfter = ['attribute' => 'PESEL', 'date' => '2000-01-01'];

        $this->assertSame('The NIP is not a valid NIP number.', trans('numerik::validation.nip.default', $nip));
        $this->assertSame('NIP must be exactly 10 digits.', trans('numerik::validation.nip.invalid_length', $nip));
        $this->assertSame('The NIP may only contain digits and hyphens.', trans('numerik::validation.nip.invalid_characters', $nip));
        $this->assertSame('The NIP tax office code cannot start with 000.', trans('numerik::validation.nip.invalid_format', $nip));
        $this->assertSame('The NIP checksum digit is incorrect.', trans('numerik::validation.nip.invalid_checksum', $nip));
        $this->assertSame('The NIP cannot consist of a single repeated digit.', trans('numerik::validation.nip.all_same_digit', $nip));

        $this->assertSame('The KRS is not a valid KRS number.', trans('numerik::validation.krs.default', $krs));
        $this->assertSame('KRS must be between 1 and 10 digits.', trans('numerik::validation.krs.invalid_length', $krs));
        $this->assertSame('The KRS may only contain digits.', trans('numerik::validation.krs.invalid_characters', $krs));
        $this->assertSame('The KRS cannot be all zeros.', trans('numerik::validation.krs.all_zeros', $krs));
        $this->assertSame('The KRS cannot consist of a single repeated digit.', trans('numerik::validation.krs.all_same_digit', $krs));

        $this->assertSame('The PESEL is not a valid PESEL number.', trans('numerik::validation.pesel.default', $pesel));
        $this->assertSame('PESEL must be exactly 11 digits.', trans('numerik::validation.pesel.invalid_length', $pesel));
        $this->assertSame('The PESEL may only contain digits.', trans('numerik::validation.pesel.invalid_characters', $pesel));
        $this->assertSame('The PESEL contains an invalid month encoding.', trans('numerik::validation.pesel.invalid_month', $pesel));
        $this->assertSame('The PESEL contains an invalid date.', trans('numerik::validation.pesel.invalid_date', $pesel));
        $this->assertSame('The PESEL checksum digit is incorrect.', trans('numerik::validation.pesel.invalid_checksum', $pesel));
        $this->assertSame('The PESEL must belong to a person born in the past.', trans('numerik::validation.pesel.future_date', $pesel));
        $this->assertSame('The PESEL cannot consist of a single repeated digit.', trans('numerik::validation.pesel.all_same_digit', $pesel));

        $this->assertSame('The REGON is not a valid REGON number.', trans('numerik::validation.regon', $regon));
        $this->assertSame('The PESEL does not match the expected gender.', trans('numerik::validation.pesel_gender', $pesel));
        $this->assertSame('The PESEL must belong to a person born before 2000-01-01.', trans('numerik::validation.pesel_born_before', $peselBefore));
        $this->assertSame('The PESEL must belong to a person born after 2000-01-01.', trans('numerik::validation.pesel_born_after', $peselAfter));

        $idCard   = ['attribute' => 'ID Card'];
        $passport = ['attribute' => 'Passport'];
        $vatEu    = ['attribute' => 'VAT-EU'];
        $nrb      = ['attribute' => 'NRB'];
        $iban     = ['attribute' => 'IBAN'];

        $this->assertSame('The ID Card is not a valid Polish ID card number.', trans('numerik::validation.id_card.default', $idCard));
        $this->assertSame('Identity card number must be exactly 9 characters.', trans('numerik::validation.id_card.invalid_length', $idCard));
        $this->assertSame('The ID Card contains invalid characters.', trans('numerik::validation.id_card.invalid_characters', $idCard));
        $this->assertSame('The ID Card series cannot contain the letters O or Q.', trans('numerik::validation.id_card.invalid_format', $idCard));
        $this->assertSame('The ID Card checksum digit is incorrect.', trans('numerik::validation.id_card.invalid_checksum', $idCard));

        $this->assertSame('The Passport is not a valid Polish passport number.', trans('numerik::validation.passport.default', $passport));
        $this->assertSame('Passport number must be exactly 9 characters.', trans('numerik::validation.passport.invalid_length', $passport));
        $this->assertSame('The Passport contains invalid characters.', trans('numerik::validation.passport.invalid_characters', $passport));
        $this->assertSame('The Passport checksum digit is incorrect.', trans('numerik::validation.passport.invalid_checksum', $passport));

        $this->assertSame('The VAT-EU is not a valid VAT-EU number.', trans('numerik::validation.vat_eu.default', $vatEu));
        $this->assertSame('VAT-EU number must contain exactly 10 digits after the PL prefix.', trans('numerik::validation.vat_eu.invalid_length', $vatEu));
        $this->assertSame('The VAT-EU must start with the PL country prefix.', trans('numerik::validation.vat_eu.invalid_format', $vatEu));
        $this->assertSame('The VAT-EU may only contain digits after the PL prefix.', trans('numerik::validation.vat_eu.invalid_characters', $vatEu));
        $this->assertSame('The VAT-EU checksum digit is incorrect.', trans('numerik::validation.vat_eu.invalid_checksum', $vatEu));
        $this->assertSame('The VAT-EU cannot consist of a single repeated digit.', trans('numerik::validation.vat_eu.all_same_digit', $vatEu));

        $this->assertSame('The NRB is not a valid NRB account number.', trans('numerik::validation.nrb.default', $nrb));
        $this->assertSame('NRB must be exactly 26 digits.', trans('numerik::validation.nrb.invalid_length', $nrb));
        $this->assertSame('The NRB may only contain digits.', trans('numerik::validation.nrb.invalid_characters', $nrb));
        $this->assertSame('The NRB checksum (MOD-97) is incorrect.', trans('numerik::validation.nrb.invalid_checksum', $nrb));

        $this->assertSame('The IBAN is not a valid Polish IBAN.', trans('numerik::validation.iban.default', $iban));
        $this->assertSame('IBAN must contain exactly 26 digits after the PL prefix.', trans('numerik::validation.iban.invalid_length', $iban));
        $this->assertSame('The IBAN must start with the PL country prefix.', trans('numerik::validation.iban.invalid_format', $iban));
        $this->assertSame('The IBAN may only contain digits after the PL prefix.', trans('numerik::validation.iban.invalid_characters', $iban));
        $this->assertSame('The IBAN checksum is incorrect.', trans('numerik::validation.iban.invalid_checksum', $iban));
    }
}
