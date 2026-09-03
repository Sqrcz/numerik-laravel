<?php

declare(strict_types=1);

namespace SlashLab\NumerikLaravel\Tests;

final class PolishTranslationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->app?->setLocale('pl');
    }

    public function test_nip_translation_keys_exist(): void
    {
        $attr = ['attribute' => 'NIP'];

        $this->assertSame('Pole NIP nie jest prawidłowym numerem NIP.', trans('numerik::validation.nip.default', $attr));
        $this->assertSame('Pole NIP musi składać się dokładnie z 10 cyfr.', trans('numerik::validation.nip.invalid_length', $attr));
        $this->assertSame('Pole NIP może zawierać wyłącznie cyfry i myślniki.', trans('numerik::validation.nip.invalid_characters', $attr));
        $this->assertSame('Kod urzędu skarbowego w polu NIP nie może zaczynać się od 000.', trans('numerik::validation.nip.invalid_format', $attr));
        $this->assertSame('Cyfra kontrolna w polu NIP jest nieprawidłowa.', trans('numerik::validation.nip.invalid_checksum', $attr));
        $this->assertSame('Pole NIP nie może składać się z jednej powtarzającej się cyfry.', trans('numerik::validation.nip.all_same_digit', $attr));
    }

    public function test_krs_translation_keys_exist(): void
    {
        $attr = ['attribute' => 'KRS'];

        $this->assertSame('Pole KRS nie jest prawidłowym numerem KRS.', trans('numerik::validation.krs.default', $attr));
        $this->assertSame('Pole KRS musi zawierać od 1 do 10 cyfr.', trans('numerik::validation.krs.invalid_length', $attr));
        $this->assertSame('Pole KRS może zawierać wyłącznie cyfry.', trans('numerik::validation.krs.invalid_characters', $attr));
        $this->assertSame('Pole KRS nie może składać się wyłącznie z zer.', trans('numerik::validation.krs.all_zeros', $attr));
        $this->assertSame('Pole KRS nie może składać się z jednej powtarzającej się cyfry.', trans('numerik::validation.krs.all_same_digit', $attr));
    }

    public function test_pesel_translation_keys_exist(): void
    {
        $attr = ['attribute' => 'PESEL'];

        $this->assertSame('Pole PESEL nie jest prawidłowym numerem PESEL.', trans('numerik::validation.pesel.default', $attr));
        $this->assertSame('Pole PESEL musi składać się dokładnie z 11 cyfr.', trans('numerik::validation.pesel.invalid_length', $attr));
        $this->assertSame('Pole PESEL może zawierać wyłącznie cyfry.', trans('numerik::validation.pesel.invalid_characters', $attr));
        $this->assertSame('Pole PESEL zawiera nieprawidłowe kodowanie miesiąca.', trans('numerik::validation.pesel.invalid_month', $attr));
        $this->assertSame('Pole PESEL zawiera nieprawidłową datę.', trans('numerik::validation.pesel.invalid_date', $attr));
        $this->assertSame('Cyfra kontrolna w polu PESEL jest nieprawidłowa.', trans('numerik::validation.pesel.invalid_checksum', $attr));
        $this->assertSame('Pole PESEL musi należeć do osoby urodzonej w przeszłości.', trans('numerik::validation.pesel.future_date', $attr));
        $this->assertSame('Pole PESEL nie może składać się z jednej powtarzającej się cyfry.', trans('numerik::validation.pesel.all_same_digit', $attr));
    }

    public function test_pesel_semantic_keys_exist(): void
    {
        $attr = ['attribute' => 'PESEL'];
        $date = ['attribute' => 'PESEL', 'date' => '2000-01-01'];

        $this->assertSame('Pole PESEL nie odpowiada oczekiwanej płci.', trans('numerik::validation.pesel_gender', $attr));
        $this->assertSame('Pole PESEL musi należeć do osoby urodzonej przed 2000-01-01.', trans('numerik::validation.pesel_born_before', $date));
        $this->assertSame('Pole PESEL musi należeć do osoby urodzonej po 2000-01-01.', trans('numerik::validation.pesel_born_after', $date));
    }

    public function test_regon_translation_keys_exist(): void
    {
        $attr = ['attribute' => 'REGON'];

        $this->assertSame('Pole REGON nie jest prawidłowym numerem REGON.', trans('numerik::validation.regon.default', $attr));
        $this->assertSame('Pole REGON musi zawierać 9 lub 14 cyfr.', trans('numerik::validation.regon.invalid_length', $attr));
        $this->assertSame('Pole REGON może zawierać wyłącznie cyfry.', trans('numerik::validation.regon.invalid_characters', $attr));
        $this->assertSame('Cyfra kontrolna w polu REGON jest nieprawidłowa.', trans('numerik::validation.regon.invalid_checksum', $attr));
    }

    public function test_id_card_translation_keys_exist(): void
    {
        $attr = ['attribute' => 'Dowód'];

        $this->assertSame('Pole Dowód nie jest prawidłowym numerem dowodu osobistego.', trans('numerik::validation.id_card.default', $attr));
        $this->assertSame('Pole Dowód musi składać się dokładnie z 9 znaków.', trans('numerik::validation.id_card.invalid_length', $attr));
        $this->assertSame('Pole Dowód zawiera niedozwolone znaki.', trans('numerik::validation.id_card.invalid_characters', $attr));
        $this->assertSame('Seria w polu Dowód nie może zawierać liter O ani Q.', trans('numerik::validation.id_card.invalid_format', $attr));
        $this->assertSame('Cyfra kontrolna w polu Dowód jest nieprawidłowa.', trans('numerik::validation.id_card.invalid_checksum', $attr));
    }

    public function test_passport_translation_keys_exist(): void
    {
        $attr = ['attribute' => 'Paszport'];

        $this->assertSame('Pole Paszport nie jest prawidłowym numerem paszportu.', trans('numerik::validation.passport.default', $attr));
        $this->assertSame('Pole Paszport musi składać się dokładnie z 9 znaków.', trans('numerik::validation.passport.invalid_length', $attr));
        $this->assertSame('Pole Paszport zawiera niedozwolone znaki.', trans('numerik::validation.passport.invalid_characters', $attr));
        $this->assertSame('Cyfra kontrolna w polu Paszport jest nieprawidłowa.', trans('numerik::validation.passport.invalid_checksum', $attr));
    }

    public function test_vat_eu_translation_keys_exist(): void
    {
        $attr = ['attribute' => 'VAT-EU'];

        $this->assertSame('Pole VAT-EU nie jest prawidłowym numerem VAT-EU.', trans('numerik::validation.vat_eu.default', $attr));
        $this->assertSame('Pole VAT-EU musi zawierać dokładnie 10 cyfr po prefiksie PL.', trans('numerik::validation.vat_eu.invalid_length', $attr));
        $this->assertSame('Pole VAT-EU musi zaczynać się od prefiksu kraju PL.', trans('numerik::validation.vat_eu.invalid_format', $attr));
        $this->assertSame('Pole VAT-EU może zawierać wyłącznie cyfry po prefiksie PL.', trans('numerik::validation.vat_eu.invalid_characters', $attr));
        $this->assertSame('Cyfra kontrolna w polu VAT-EU jest nieprawidłowa.', trans('numerik::validation.vat_eu.invalid_checksum', $attr));
        $this->assertSame('Pole VAT-EU nie może składać się z jednej powtarzającej się cyfry.', trans('numerik::validation.vat_eu.all_same_digit', $attr));
    }

    public function test_nrb_translation_keys_exist(): void
    {
        $attr = ['attribute' => 'NRB'];

        $this->assertSame('Pole NRB nie jest prawidłowym numerem rachunku bankowego NRB.', trans('numerik::validation.nrb.default', $attr));
        $this->assertSame('Pole NRB musi składać się dokładnie z 26 cyfr.', trans('numerik::validation.nrb.invalid_length', $attr));
        $this->assertSame('Pole NRB może zawierać wyłącznie cyfry.', trans('numerik::validation.nrb.invalid_characters', $attr));
        $this->assertSame('Suma kontrolna (MOD-97) w polu NRB jest nieprawidłowa.', trans('numerik::validation.nrb.invalid_checksum', $attr));
    }

    public function test_iban_translation_keys_exist(): void
    {
        $attr = ['attribute' => 'IBAN'];

        $this->assertSame('Pole IBAN nie jest prawidłowym polskim numerem IBAN.', trans('numerik::validation.iban.default', $attr));
        $this->assertSame('Pole IBAN musi zawierać dokładnie 26 cyfr po prefiksie PL.', trans('numerik::validation.iban.invalid_length', $attr));
        $this->assertSame('Pole IBAN musi zaczynać się od prefiksu kraju PL.', trans('numerik::validation.iban.invalid_format', $attr));
        $this->assertSame('Pole IBAN może zawierać wyłącznie cyfry po prefiksie PL.', trans('numerik::validation.iban.invalid_characters', $attr));
        $this->assertSame('Suma kontrolna w polu IBAN jest nieprawidłowa.', trans('numerik::validation.iban.invalid_checksum', $attr));
    }
}
