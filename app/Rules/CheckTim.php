<?php

namespace App\Rules;

use App\Models\Tim;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckTim implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $tim = Tim::find($value);

        if (!$tim) { 
            $fail("Tim sa id-em $value ne postoji!");
        }
    }
}
