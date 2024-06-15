<?php

namespace App\Rules;

use App\Models\TipZahteva;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckTipZahteva implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $tipZahteva = TipZahteva::find($value);

        if (!$tipZahteva) { 
            $fail("Tip zahteva sa id-em $value ne postoji!");
        }
    }
}
