<?php

namespace App\Http\Requests;

use App\Rules\CheckTipZahteva;
use Illuminate\Foundation\Http\FormRequest;

class ZahtevKreiranjeRequest extends FormRequest
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
            'tip_zahteva_id' => ['required', 'integer', new CheckTipZahteva],
            'datum_od' => ['required', 'date_format:Y-m-d'],
            'datum_do' => ['required', 'date_format:Y-m-d']
        ];
    }

    public function messages(): array
    {
        return [
            'tip_zahteva_id.required' => 'Polje tip_zahteva_id je obavezno',
            'tip_zahteva_id.integer' => 'polje tip_zahteva_id mora biti broj',
            'datum_od.required' => 'Polje datum_od je obavezno',
            'datum_od.date_format' => 'Polje datum_od mora biti u formatu YYYY-mm-dd',
            'datum_do.required' => 'Polje datum_do je obavezno',
            'datum_do.date_format' => 'Polje datum_do mora biti u formatu YYYY-mm-dd',
        ];
    }
}
