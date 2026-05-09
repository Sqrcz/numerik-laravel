<?php

declare(strict_types=1);

namespace SlashLab\NumerikLaravel\Tests;

use SlashLab\Numerik\Identifiers\PeselIdentifier;
use SlashLab\Numerik\Identifiers\IdCardIdentifier;
use SlashLab\Numerik\Identifiers\PassportIdentifier;
use SlashLab\Numerik\Identifiers\NipIdentifier;
use SlashLab\Numerik\Identifiers\VatEuIdentifier;
use SlashLab\Numerik\Identifiers\RegonIdentifier;
use SlashLab\Numerik\Identifiers\KrsIdentifier;
use SlashLab\Numerik\Identifiers\NrbIdentifier;
use SlashLab\Numerik\Identifiers\IbanIdentifier;
use SlashLab\NumerikLaravel\Facades\Numerik;

final class FacadeTest extends TestCase
{
    // Personal

    public function test_pesel_returns_pesel_identifier(): void
    {
        $this->assertInstanceOf(PeselIdentifier::class, Numerik::pesel());
    }

    public function test_id_card_returns_id_card_identifier(): void
    {
        $this->assertInstanceOf(IdCardIdentifier::class, Numerik::idCard());
    }

    public function test_passport_returns_passport_identifier(): void
    {
        $this->assertInstanceOf(PassportIdentifier::class, Numerik::passport());
    }

    // Tax & Business

    public function test_nip_returns_nip_identifier(): void
    {
        $this->assertInstanceOf(NipIdentifier::class, Numerik::nip());
    }

    public function test_vat_eu_returns_vat_eu_identifier(): void
    {
        $this->assertInstanceOf(VatEuIdentifier::class, Numerik::vatEu());
    }

    public function test_regon_returns_regon_identifier(): void
    {
        $this->assertInstanceOf(RegonIdentifier::class, Numerik::regon());
    }

    public function test_krs_returns_krs_identifier(): void
    {
        $this->assertInstanceOf(KrsIdentifier::class, Numerik::krs());
    }

    // Banking

    public function test_nrb_returns_nrb_identifier(): void
    {
        $this->assertInstanceOf(NrbIdentifier::class, Numerik::nrb());
    }

    public function test_iban_returns_iban_identifier(): void
    {
        $this->assertInstanceOf(IbanIdentifier::class, Numerik::iban());
    }

    public function test_pesel_is_valid(): void
    {
        $this->assertTrue(Numerik::pesel()->isValid('44051401458'));
    }

    public function test_id_card_is_valid(): void
    {
        $this->assertTrue(Numerik::idCard()->isValid('ABC123454'));
    }

    public function test_passport_is_valid(): void
    {
        $this->assertTrue(Numerik::passport()->isValid('AB1234564'));
    }

    public function test_nip_is_valid(): void
    {
        $this->assertTrue(Numerik::nip()->isValid('5260250274'));
    }

    public function test_vat_eu_is_valid(): void
    {
        $this->assertTrue(Numerik::vatEu()->isValid('PL5260250274'));
    }

    public function test_regon_is_valid(): void
    {
        $this->assertTrue(Numerik::regon()->isValid('850518457'));
    }

    public function test_krs_is_valid(): void
    {
        $this->assertTrue(Numerik::krs()->isValid('0000127206'));
    }

    public function test_nrb_is_valid(): void
    {
        $this->assertTrue(Numerik::nrb()->isValid('61102010260000000000000000'));
    }

    public function test_iban_is_valid(): void
    {
        $this->assertTrue(Numerik::iban()->isValid('PL61102010260000000000000000'));
    }
}
