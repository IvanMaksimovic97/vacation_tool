<?php

namespace App\Http\Requests;

use App\Rules\UlogaCheck;
use Illuminate\Foundation\Http\FormRequest;

class KorisnikPromenaUlogeRequest extends FormRequest
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
            'uloga_id' => ['required', 'integer', new UlogaCheck]
        ];
    }

    public function messages(): array
    {
        return [
            'uloga_id.required' => 'Polje uloga_id je obavezno',
            'uloga_id.integer' => 'Polje uloga_id mora biti broj'
        ];
    }
}
