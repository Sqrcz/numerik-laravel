<?php

declare(strict_types=1);

namespace SlashLab\NumerikLaravel\Rules;

use Closure;
use DateTimeImmutable;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Lang;
use SlashLab\Numerik\Enums\Gender;
use SlashLab\Numerik\Identifiers\PeselIdentifier;

final class PeselRule implements ValidationRule
{
    public function __construct(
        private readonly bool $strict = true,
        private readonly ?Gender $gender = null,
        private readonly ?DateTimeImmutable $bornBefore = null,
        private readonly ?DateTimeImmutable $bornAfter = null,
    ) {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $identifier = new PeselIdentifier(strict: $this->strict);
        $string = is_scalar($value) ? (string) $value : '';

        $result = $identifier->validate($string);

        if ($result->isFailed()) {
            $reason = $result->getFirstFailure()?->reason->value ?? 'default';
            $key = "numerik::validation.pesel.{$reason}";

            $fail(Lang::has($key) ? $key : 'numerik::validation.pesel.default')
                ->translate(['attribute' => $attribute]);

            return;
        }

        if ($this->gender === null && $this->bornBefore === null && $this->bornAfter === null) {
            return;
        }

        $pesel = $identifier->parse($string);

        if ($this->gender !== null && $pesel->getGender() !== $this->gender) {
            $fail('numerik::validation.pesel_gender')->translate(['attribute' => $attribute]);
        }

        if ($this->bornBefore !== null && $pesel->getBirthDate() >= $this->bornBefore) {
            $fail('numerik::validation.pesel_born_before')->translate([
                'attribute' => $attribute,
                'date'      => $this->bornBefore->format('Y-m-d'),
            ]);
        }

        if ($this->bornAfter !== null && $pesel->getBirthDate() <= $this->bornAfter) {
            $fail('numerik::validation.pesel_born_after')->translate([
                'attribute' => $attribute,
                'date'      => $this->bornAfter->format('Y-m-d'),
            ]);
        }
    }
}
