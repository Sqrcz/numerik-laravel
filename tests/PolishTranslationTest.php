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
        $this->assertSame('NIP musi składać się dokładnie z 10 cyfr.', trans('numerik::validation.nip.invalid_length', $attr));
        $this->assertSame('Pole NIP może zawierać wyłącznie cyfry i myślniki.', trans('numerik::validation.nip.invalid_characters', $attr));
        $this->assertSame('Kod urzędu skarbowego w polu NIP nie może zaczynać się od 000.', trans('numerik::validation.nip.invalid_format', $attr));
        $this->assertSame('Cyfra kontrolna w polu NIP jest nieprawidłowa.', trans('numerik::validation.nip.invalid_checksum', $attr));
        $this->assertSame('Pole NIP nie może składać się z jednej powtarzającej się cyfry.', trans('numerik::validation.nip.all_same_digit', $attr));
    }

    public function test_krs_translation_keys_exist(): void
    {
        $attr = ['attribute' => 'KRS'];

        $this->assertSame('Pole KRS nie jest prawidłowym numerem KRS.', trans('numerik::validation.krs.default', $attr));
        $this->assertSame('KRS musi zawierać od 1 do 10 cyfr.', trans('numerik::validation.krs.invalid_length', $attr));
        $this->assertSame('Pole KRS może zawierać wyłącznie cyfry.', trans('numerik::validation.krs.invalid_characters', $attr));
        $this->assertSame('Pole KRS nie może składać się wyłącznie z zer.', trans('numerik::validation.krs.all_zeros', $attr));
        $this->assertSame('Pole KRS nie może składać się z jednej powtarzającej się cyfry.', trans('numerik::validation.krs.all_same_digit', $attr));
    }

    public function test_pesel_translation_keys_exist(): void
    {
        $attr = ['attribute' => 'PESEL'];

        $this->assertSame('Pole PESEL nie jest prawidłowym numerem PESEL.', trans('numerik::validation.pesel.default', $attr));
        $this->assertSame('PESEL musi składać się dokładnie z 11 cyfr.', trans('numerik::validation.pesel.invalid_length', $attr));
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

    public function test_regon_translation_key_exists(): void
    {
        $attr = ['attribute' => 'REGON'];

        $this->assertSame('Pole REGON nie jest prawidłowym numerem REGON.', trans('numerik::validation.regon', $attr));
    }
}
