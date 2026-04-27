<?php

declare(strict_types=1);

namespace SlashLab\NumerikLaravel\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use SlashLab\Numerik\Identifiers\KrsIdentifier;

final class KrsRule implements ValidationRule
{
    public function __construct(
        private readonly bool $strict = true,
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $identifier = new KrsIdentifier(strict: $this->strict);
        $string = is_scalar($value) ? (string) $value : '';

        if (! $identifier->isValid($string)) {
            $fail('numerik::validation.krs')->translate(['attribute' => $attribute]);
        }
    }
}
