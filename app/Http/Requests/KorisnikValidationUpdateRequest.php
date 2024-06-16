<?php

namespace App\Http\Requests;

use App\Rules\CheckTim;
use App\Rules\UlogaCheck;
use Illuminate\Foundation\Http\FormRequest;

class KorisnikValidationUpdateRequest extends FormRequest
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
            'uloga_id' => ['integer', new UlogaCheck],
            'tim_id' => ['integer', new CheckTim],
            'password' => 'min:8'
        ];
    }

    public function messages(): array
    {
        return [
            'tim_id.integer' => 'Polje tim_id mora biti broj',
            'uloga_id.integer' => 'Polje uloga_id mora biti broj',
            'password.min' => 'Polje password mora biti mininalne duzine od 8 karaktera'
        ];
    }
}
