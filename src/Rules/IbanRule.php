<?php

declare(strict_types=1);

namespace SlashLab\NumerikLaravel\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Lang;
use SlashLab\Numerik\Identifiers\IbanIdentifier;

final class IbanRule implements ValidationRule
{
    public function __construct(
        private readonly bool $strict = true,
    ) {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $identifier = new IbanIdentifier(strict: $this->strict);
        $string = is_scalar($value) ? (string) $value : '';

        $result = $identifier->validate($string);

        if ($result->isFailed()) {
            $reason = $result->getFirstFailure()?->reason->value ?? 'default';
            $key = "numerik::validation.iban.{$reason}";
            $humanAttribute = Lang::has("validation.attributes.{$attribute}")
                ? Lang::get("validation.attributes.{$attribute}")
                : ucfirst(str_replace('_', ' ', $attribute));

            $fail(Lang::has($key) ? $key : 'numerik::validation.iban.default')
                ->translate(['attribute' => $humanAttribute]);
        }
    }
}
