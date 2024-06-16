<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\TimValidationStoreRequest;
use App\Models\Tim;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $korisnici = Tim::with(['korisnici.uloga'])->get();

        return response()->json($korisnici);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TimValidationStoreRequest $request)
    {
        $tim = new Tim;
        $tim->naziv = $request->naziv;
        $tim->opis = $request->opis ?? '';
        $tim->save();

        return response()->json(['poruka' => 'Tim je uspešno kreiran']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tim $tim)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tim = Tim::findOrFail($id);

        if ($request->naziv) {
            $tim->naziv = $request->naziv;
        }
        
        if ($request->opis) {
            $tim->opis = $request->opis;
        }
        
        $tim->save();

        return response()->json(['poruka' => 'Tim je uspešno izmenjen']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tim = Tim::findOrFail($id);
        $tim->delete();

        return response()->json(['poruka' => 'Tim je uspesno obrisan!']);
    }
}
