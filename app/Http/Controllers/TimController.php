<?php

namespace App\Http\Controllers;

use App\Models\Tim;
use Illuminate\Http\Request;

class TimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $korisnici = Tim::all();

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
    public function show(Tim $tim)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tim $tim)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tim $tim)
    {
        //
    }
}
