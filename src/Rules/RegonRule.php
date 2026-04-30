<?php

declare(strict_types=1);

namespace SlashLab\NumerikLaravel\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use SlashLab\Numerik\Identifiers\RegonIdentifier;

final class RegonRule implements ValidationRule
{
    public function __construct(
        private readonly bool $strict = true,
    ) {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $identifier = new RegonIdentifier(strict: $this->strict);
        $string = is_scalar($value) ? (string) $value : '';

        if (! $identifier->isValid($string)) {
            $humanAttribute = Lang::has("validation.attributes.{$attribute}")
                ? Lang::get("validation.attributes.{$attribute}")
                : Str::ucfirst(str_replace('_', ' ', $attribute));

            $fail('numerik::validation.regon')->translate(['attribute' => $humanAttribute]);
        }
    }
}
