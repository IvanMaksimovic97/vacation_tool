<?php

namespace App\Http\Controllers;

use App\Models\TimKorisnik;
use App\Rules\CheckKorisnik;
use App\Rules\CheckTim;
use Illuminate\Http\Request;

class TimKorisnikController extends Controller
{
    public function dodajKorisnikaUTim(Request $request)
    {
        $request->validate([
            'tim_id' => ['required', 'integer', new CheckTim],
            'korisnik_id' => ['required', 'integer', new CheckKorisnik]
        ], [
            'tim_id.required' => 'Polje tim_id je obavezno',
            'tim_id.integer' => 'Polje tim_id mora biti broj',
            'korisnik_id.required' => 'Polje korisnik_id je obavezno',
            'korisnik_id.integer' => 'Polje korisnik_id mora biti broj',
        ]);

        $newTimKorisnik = new TimKorisnik;
        $newTimKorisnik->tim_id = $request->tim_id;
        $newTimKorisnik->korisnik_id = $request->korisnik_id;

        //Ako tim nema nijednog korisnika, prvi korisnik je automatski menadzer tima
        $korisniciUTimu = TimKorisnik::where('tim_id', $request->tim_id)->count();
        if ($korisniciUTimu === 0) {
            $newTimKorisnik->je_menadzer = 1;
        }

        $newTimKorisnik->save();

        return response()->json(['poruka' => 'Korisnik je uspešno dodat u tim.']);
    }

    public function obrisiKorisnikaIzTima($korisnik_id)
    {
        TimKorisnik::where('korisnik_id', $korisnik_id)->delete();

        return response()->json(['poruka' => 'Korisnik je uspešno obrisan iz tima.']);
    }

    public function postaviUkloniMenadzeraTima(Request $request)
    {
        $request->validate([
            'tim_id' => ['required', 'integer', new CheckTim],
            'korisnik_id' => ['required', 'integer'],
            'je_menadzer' => ['required', 'integer', 'min:0', 'max:1']
        ], [
            'tim_id.required' => 'Polje tim_id je obavezno',
            'tim_id.integer' => 'Polje tim_id mora biti broj',
            'korisnik_id.required' => 'Polje korisnik_id je obavezno',
            'korisnik_id.integer' => 'Polje korisnik_id mora biti broj',
            'je_menadzer.required' => 'Polje je_menadzer je obavezno',
            'je_menadzer.integer' => 'Polje je_menadzer moze imati vrednosti samo 0 ili 1',
            'je_menadzer.min' => 'Polje je_menadzer moze imati vrednosti samo 0 ili 1',
            'je_menadzer.max' => 'Polje je_menadzer moze imati vrednosti samo 0 ili 1',
        ]);

        $korisnikPostojiUTimu = TimKorisnik::where('tim_id', $request->tim_id)->where('korisnik_id', $request->korisnik_id)->first();

        if (!$korisnikPostojiUTimu) {
            return response()->json(['error' => 'Korisnik se ne nalazi u navedenom timu'], 422);
        }

        $korisnikPostojiUTimu->je_menadzer = $request->je_menadzer;
        $korisnikPostojiUTimu->save();

        return response()->json(['poruka' => 'Status menadzera je uspesno azuriran']);
    }
}
