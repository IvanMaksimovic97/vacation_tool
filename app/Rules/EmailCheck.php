<?php

namespace App\Rules;

use App\Models\Korisnik;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmailCheck implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $emailPostoji = Korisnik::where("email", $value)->first();

        if ($emailPostoji) { 
            $fail('Korisnik sa unetom email adresom već postoji!');
        }
    }
}
