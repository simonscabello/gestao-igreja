<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class ValidPhone implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string, ?string=): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $numeric = preg_replace('/\D/', '', $value);

        if (!in_array(strlen($numeric), [10, 11])) {
            $fail("O campo {$attribute} deve conter um número válido com DDD.");
        }

        $ddd = substr($numeric, 0, 2);
        $inicialNumero = substr($numeric, 2, 1);

        if ((int)$ddd < 11 || (int)$ddd > 99) {
            $fail("O DDD informado no campo {$attribute} é inválido.");
        }

        if (strlen($numeric) === 11 && $inicialNumero !== '9') {
            $fail("O número de celular deve começar com 9.");
        }
    }
}
