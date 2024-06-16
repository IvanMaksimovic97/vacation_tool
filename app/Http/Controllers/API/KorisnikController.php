<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\KorisnikPromenaTimaRequest;
use App\Http\Requests\KorisnikPromenaUlogeRequest;
use App\Http\Requests\KorisnikValidationStoreRequest;
use App\Http\Requests\KorisnikValidationUpdateRequest;
use App\Models\Korisnik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class KorisnikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $korisnici = Korisnik::with(['uloga', 'tim'])->get();

        return response()->json($korisnici);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KorisnikValidationStoreRequest $request)
    {
        $korisnik = new Korisnik;
        $korisnik->uloga_id = $request->uloga_id;
        $korisnik->tim_id = $request->tim_id;
        $korisnik->ime = $request->ime;
        $korisnik->prezime = $request->prezime;
        $korisnik->email = $request->email;
        $korisnik->password = Hash::make($request->password);
        $korisnik->broj_dana_godisnjeg_odmora = 20;
        $korisnik->broj_slobodnih_dana = 5;
        $korisnik->save();

        return response()->json(['poruka' => 'Korisnik je uspesno kreiran!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Korisnik $korisnik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KorisnikValidationUpdateRequest $request, $id)
    {
        $korisnik = Korisnik::findOrFail($id);

        if ($request->tim_id) {
            $korisnik->tim_id = $request->tim_id;
        }

        if ($request->uloga_id) {
            $korisnik->uloga_id = $request->uloga_id;
        }

        if ($request->ime) {
            $korisnik->ime = $request->ime;
        }

        if ($request->prezime) {
            $korisnik->prezime = $request->prezime;
        }

        if ($request->password) {
            $korisnik->password = Hash::make($request->password);
        }
        
        $korisnik->save();

        return response()->json(['poruka' => 'Korisnik je uspesno izmenjen!']);
    }

    public function promeniUlogu(KorisnikPromenaUlogeRequest $request, $korisnik_id)
    {
        $korisnik = Korisnik::findOrFail($korisnik_id);
        $korisnik->uloga_id = $request->uloga_id;
        $korisnik->save();

        return response()->json(['poruka'=> 'Korisnicka uloga je uspesno izmenjena']);
    }

    public function promeniTim(KorisnikPromenaTimaRequest $request, $korisnik_id)
    {
        $korisnik = Korisnik::findOrFail($korisnik_id);
        $korisnik->tim_id = $request->tim_id;
        $korisnik->save();

        return response()->json(['poruka'=> 'Korisnicka uloga je uspesno izmenjena']);
    }

    public function pregledTima(Request $request)
    {
        /**
         * Ulogovan korisnik
         */
        $korisnik = $request->user();

        $korisnici = Korisnik::with(['uloga'])->where('tim_id', $korisnik->tim_id)->get();

        return response()->json($korisnici);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $korisnik = Korisnik::findOrFail($id);
        $korisnik->delete();

        return response()->json(['poruka' => 'Korisnik je uspesno obrisan!']);
    }
}
