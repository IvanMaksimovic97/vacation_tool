<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZahtevOdgovorRequest extends FormRequest
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
            'status' => ['required', 'integer', 'min:1', 'max:2']
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Polje status je obavezno',
            'status.integer' => 'Polje status moze imati vrednosti 1 (prihvacen) ili 2 (odbijen)',
            'status.min' => 'Polje status moze imati vrednosti 1 (prihvacen) ili 2 (odbijen)',
            'status.max' => 'Polje status moze imati vrednosti 1 (prihvacen) ili 2 (odbijen)',
        ];
    }
}
