<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Korisnik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Polje email je obavezno',
            'email.email' => 'Email nije u ispravnom formatu',
            'password.required' => 'Polje password je obavezno'
        ]);

        $korisnik = Korisnik::where('email', $request->email)->first();

        if ($korisnik && Hash::check($request->password, $korisnik->password)) {
            return response()->json([
                'poruka' => 'Uspešno ste se ulogovali na aplikaciju!',
                'tip_tokena' => 'Bearer Token',
                'token' => $korisnik->createToken('LOGIN_TOKEN')->plainTextToken,
            ], 200);
        } else {
            return response()->json([
                'poruka' => 'Korisnik sa zadatim email adresom i lozinkom nije pronadjen!'
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "poruka"=>"Uspešna odjava sa aplikacije!"
        ]);
    }

    public function ulogovanKorisnik(Request $request)
    {
        $korisnik = $request->user();

        $korisnik->uloga = $korisnik->uloga->naziv;
        $korisnik->tim = $korisnik->tim->naziv;

        return $korisnik;
    }
}
