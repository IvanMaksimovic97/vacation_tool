<?php

namespace App\Http\Requests;

use App\Rules\CheckTim;
use App\Rules\EmailCheck;
use App\Rules\UlogaCheck;
use Illuminate\Foundation\Http\FormRequest;

class KorisnikValidationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tim_id' => ['integer', new CheckTim],
            'uloga_id' => ['required', 'integer', new UlogaCheck],
            'ime' => 'required',
            'prezime' => 'required',
            'email' => ['required', 'email', new EmailCheck],
            'password' => 'required|min:8'
        ];
    }

    public function messages(): array
    {
        return [
            'uloga_id.required' => 'Polje uloga_id je obavezno',
            'uloga_id.integer' => 'Polje uloga_id mora biti broj',
            'ime.required' => 'Polje ime je obavezno',
            'prezime.required' => 'Polje prezime je obavezno',
            'email.required' => 'Polje email je obavezno',
            'email.email' => 'Neispravan format email adrese',
            'password.required' => 'Polje password je obavezno',
            'password.min' => 'Polje password mora biti mininalne duzine od 8 karaktera'
        ];
    }
}
