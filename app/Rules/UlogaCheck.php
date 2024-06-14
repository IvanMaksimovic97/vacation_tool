<?php

namespace App\Rules;

use App\Models\Uloga;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UlogaCheck implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $uloga = Uloga::find($value);

        if (!$uloga) { 
            $fail("Uloga sa id-em $value ne postoji!");
        }
    }
}
