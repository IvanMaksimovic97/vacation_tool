<?php

namespace App\Http\Controllers;

use App\Models\Korisnik;
use Illuminate\Http\Request;

class KorisnikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $korisnici = Korisnik::with(['uloga'])->get();

        return response()->json($korisnici);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, Korisnik $korisnik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Korisnik $korisnik)
    {
        //
    }
}
