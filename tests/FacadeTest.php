<?php

declare(strict_types=1);

namespace SlashLab\NumerikLaravel\Tests;

use SlashLab\Numerik\Identifiers\KrsIdentifier;
use SlashLab\Numerik\Identifiers\NipIdentifier;
use SlashLab\Numerik\Identifiers\PeselIdentifier;
use SlashLab\Numerik\Identifiers\RegonIdentifier;
use SlashLab\NumerikLaravel\Facades\Numerik;

final class FacadeTest extends TestCase
{
    public function test_pesel_returns_pesel_identifier(): void
    {
        $this->assertInstanceOf(PeselIdentifier::class, Numerik::pesel());
    }

    public function test_nip_returns_nip_identifier(): void
    {
        $this->assertInstanceOf(NipIdentifier::class, Numerik::nip());
    }

    public function test_regon_returns_regon_identifier(): void
    {
        $this->assertInstanceOf(RegonIdentifier::class, Numerik::regon());
    }

    public function test_krs_returns_krs_identifier(): void
    {
        $this->assertInstanceOf(KrsIdentifier::class, Numerik::krs());
    }

    public function test_pesel_is_valid(): void
    {
        $this->assertTrue(Numerik::pesel()->isValid('44051401458'));
    }

    public function test_nip_is_valid(): void
    {
        $this->assertTrue(Numerik::nip()->isValid('5260250274'));
    }

    public function test_regon_is_valid(): void
    {
        $this->assertTrue(Numerik::regon()->isValid('850518457'));
    }

    public function test_krs_is_valid(): void
    {
        $this->assertTrue(Numerik::krs()->isValid('0000127206'));
    }
}
