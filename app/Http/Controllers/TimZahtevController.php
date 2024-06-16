<?php

namespace App\Http\Controllers;

use App\Models\Korisnik;
use App\Models\TipZahteva;
use App\Models\Zahtev;
use App\Rules\CheckTipZahteva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimZahtevController extends Controller
{
    public function kreiranjeZahteva(Request $request)
    {
        $request->validate([
            'tip_zahteva_id' => ['required', 'integer', new CheckTipZahteva],
            'datum_od' => ['required', 'date_format:Y-m-d'],
            'datum_do' => ['required', 'date_format:Y-m-d']
        ], [
            'tip_zahteva_id.required' => 'Polje tip_zahteva_id je obavezno',
            'tip_zahteva_id.integer' => 'polje tip_zahteva_id mora biti broj',
            'datum_od.required' => 'Polje datum_od je obavezno',
            'datum_od.date_format' => 'Polje datum_od mora biti u formatu YYYY-mm-dd',
            'datum_do.required' => 'Polje datum_do je obavezno',
            'datum_do.date_format' => 'Polje datum_do mora biti u formatu YYYY-mm-dd',
        ]);

        $datumOd = $request->datum_od;
        $datumDo = $request->datum_do;

        if (strtotime($datumOd) < strtotime(date('Y-m-d'))) { 
            return response()->json(['poruka' => 'Pocetni datum ne sme biti manji od danasnjeg!'], 422);
        }

        if (strtotime($datumOd) > strtotime($datumDo)) { 
            return response()->json(['poruka' => 'Pocetni datum ne sme biti veci od krajnjeg datuma!'], 422);
        }

        $korisnik = $request->user();

        /**
         * Korisnik ne moze kreirati novi zahtev ako je vec kreirao zahtev u kojem dolazi do preklapanja perioda
         */
        if (Zahtev::brojPreklapajucihZahtevaKreiranje($korisnik->id, $datumOd, $datumDo) > 0) {
            return response()->json(['poruka' => 'Zahtev u navedenom periodu je vec kreiran!'], 422);
        }

        /**
         * Izracunavanje koliko dana odmora ili slobodnih dana je potrebno korisniku da bi mogao da podnese zahtev
         * Samo se radni dani uzimaju u obzir
         */
        $brojRadnihDana = Zahtev::brojRadnihDana($datumOd, $datumDo);
        
        if ($request->tip_zahteva_id == 1) {
            if ($korisnik->broj_dana_godisnjeg_odmora < $brojRadnihDana) { 
                return response()->json([
                    'poruka' => 'Nemate dovoljno raspolozivih dana godisnjeg odmora!',
                    'broj_potrebnih_dana' => $brojRadnihDana,
                    'broj_preostalih_dana' => $korisnik->broj_dana_godisnjeg_odmora
                ], 422);
            }
        }

        if ($request->tip_zahteva_id == 2) {
            if ($korisnik->broj_slobodnih_dana < $brojRadnihDana) { 
                return response()->json([
                    'poruka' => 'Nemate dovoljno raspolozivih slobodnih dana!',
                    'broj_potrebnih_dana' => $brojRadnihDana,
                    'broj_preostalih_dana' => $korisnik->broj_slobodnih_dana
                ], 422);
            }
        }

        /**
         * Kreiranje zahteva nakon uspesne validacije
         */
        $noviZahtev = new Zahtev;
        $noviZahtev->korisnik_id = $korisnik->id;
        $noviZahtev->tip_zahteva_id = $request->tip_zahteva_id;
        $noviZahtev->datum_od = $datumOd;
        $noviZahtev->datum_do = $datumDo;
        $noviZahtev->broj_dana = $brojRadnihDana;
        $noviZahtev->status = 0;
        $noviZahtev->save();

        return response()->json(['poruka' => 'Zahtev je uspesno kreiran!']);
    }

    public function pregledZahteva(Request $request)
    {
        $korisnik = $request->user();

        $zahteviUTimu = Zahtev::join('korisnik', 'zahtev.korisnik_id', '=', 'korisnik.id')
            ->join('uloga', 'korisnik.uloga_id', '=', 'uloga.id')
            ->join('tip_zahteva', 'zahtev.tip_zahteva_id', '=', 'tip_zahteva.id')
            ->where('korisnik.tim_id', $korisnik->tim->id);
            
        /**
         * Provera ako je uloga KORISNIK, vidi samo zahteve NA CEKANJU i ODOBRENE u timu
         * Ako je menadzer, vidi sve zahteve tima
         */  
        if ($korisnik->uloga_id != 2) {
            $zahteviUTimu = $zahteviUTimu->whereIn('status', [0,1]);
        }
        
        $zahteviUTimu = $zahteviUTimu
            ->select('zahtev.*', 'tip_zahteva.naziv as tip_zahteva', 'korisnik.ime', 'korisnik.prezime', 'uloga.naziv as uloga')
            ->get();

        foreach($zahteviUTimu as $zahtev) { 
            switch($zahtev->status) {
                case 0: $zahtev->status_zahteva = 'Na cekanju'; break;
                case 1: $zahtev->status_zahteva = 'Odobren'; break;
                case 2: $zahtev->status_zahteva = 'Odbijen'; break;
            }
        }

        return response()->json($zahteviUTimu);
    }

    public function pregledSopstvenihZahteva(Request $request)
    {
        $korisnik = $request->user();

        $zahteviUTimu = Zahtev::with(['tipZahteva'])->where('korisnik_id', $korisnik->id)->get();

        foreach($zahteviUTimu as $zahtev) { 
            switch($zahtev->status) {
                case 0: $zahtev->status_zahteva = 'Na cekanju'; break;
                case 1: $zahtev->status_zahteva = 'Odobren'; break;
                case 2: $zahtev->status_zahteva = 'Odbijen'; break;
            }
        }

        return response()->json($zahteviUTimu);
    }

    public function odgovorNaZahtev(Request $request, $zahtev_id)
    {
        $request->validate([
            'status' => ['required', 'integer', 'min:1', 'max:2']
        ], [
            'status.required' => 'Polje status je obavezno',
            'status.integer' => 'Polje status moze imati vrednosti 1 (prihvacen) ili 2 (odbijen)',
            'status.min' => 'Polje status moze imati vrednosti 1 (prihvacen) ili 2 (odbijen)',
            'status.max' => 'Polje status moze imati vrednosti 1 (prihvacen) ili 2 (odbijen)',
        ]);

        $ulogovanKorisnik = $request->user();
        $zahtev = Zahtev::findOrFail($zahtev_id);

        /**
         * Sprecavnje odgovora ukoliko je korisnik menadzer drugog tima
         */
        if ($ulogovanKorisnik->tim_id != $zahtev->korisnik->tim_id) {
            return response()->json(['poruka' => 'Niste menadzer navedenog tima!'], 422);
        }

        if ($zahtev->status != 0) {
            return response()->json(['poruka' => 'Na navedeni zahtev je vec odgovoreno!'], 422);
        }

        /**
         * Neophodna validacija pre nego sto se zahtev odobri ako se odobrava
         */
        if ($request->status == 1) {
            /**
             * Provera da li postoji ODOBREN zahtev u timu koji se preklapa sa periodom trenutnog zahteva koji se odobrava
             */
            if (Zahtev::brojPreklapajucihZahtevaOdobrenje($zahtev->korisnik->tim_id, $zahtev->datum_od, $zahtev->datum_do) > 0) {
                return response()->json(['poruka' => 'Zahtev je odbijen! Zahtev ne moze biti odobren zbog preklapanja datuma sa vec drugim odobrenim zahtevom!'], 422);
            }

            /**
             * Provera da li je korisniku ostalo dovoljno dana godisnjeg odmora ili slobodnih dana u zavisnosti od tipa zahteva
             */
            $korisnik = Korisnik::find($zahtev->korisnik_id);
            
            if ($zahtev->tip_zahteva_id == 1) {
                if ($korisnik->broj_dana_godisnjeg_odmora < $zahtev->broj_dana) {
                    return response()->json([
                        'poruka' => 'Zahtev je odbijen! Korisnik nema dovoljno raspolozivih dana godisnjeg odmora!',
                        'broj_potrebnih_dana' => $zahtev->broj_dana,
                        'broj_preostalih_dana' => $korisnik->broj_dana_godisnjeg_odmora
                    ], 422);
                }

                /**
                 * Smanjuju se dani godisnjeg odmora
                 */
                $korisnik->broj_dana_godisnjeg_odmora -= $zahtev->broj_dana;
            }
    
            if ($zahtev->tip_zahteva_id == 2) {
                if ($korisnik->broj_slobodnih_dana < $zahtev->broj_dana) {
                    return response()->json([
                        'poruka' => 'Zahtev je odbijen! Korisnik nema dovoljno raspolozivih slobodnih dana!',
                        'broj_potrebnih_dana' => $zahtev->broj_dana,
                        'broj_preostalih_dana' => $korisnik->broj_slobodnih_dana
                    ], 422);
                }

                /**
                 * Smanjuju se slobodni dani
                 */
                $korisnik->broj_slobodnih_dana -= $zahtev->broj_dana;
            }

            $korisnik->save();
        }

        $zahtev->status = $request->status;
        $zahtev->save();

        if ($request->status == 1) {
            return response()->json(['poruka' => 'Zahtev je uspesno odobren!']);
        } else {
            return response()->json(['poruka' => 'Zahtev je uspesno odbijen!']);
        }
    }
}
