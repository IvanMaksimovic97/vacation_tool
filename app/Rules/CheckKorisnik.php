<?php

namespace App\Rules;

use App\Models\Korisnik;
use App\Models\TimKorisnik;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckKorisnik implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $korisnik = Korisnik::find($value);

        if (!$korisnik) { 
            $fail("Korisnik sa id-em $value ne postoji!");
        }

        $korisnikJeVecDodeljenUTim = TimKorisnik::where("korisnik_id", $value)->first();

        if ($korisnikJeVecDodeljenUTim) {
            $fail("Korisnik sa id-em $value je vec dodeljen u tim!");
        }
    }
}
