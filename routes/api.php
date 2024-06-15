<?php

use App\Http\Controllers\API\ApiAuthController;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\KorisnikController;
use App\Http\Controllers\TimController;
use App\Http\Controllers\TimKorisnikController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [ApiAuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/auth/logout', [ApiAuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('/ulogovan-korisnik', fn (Request $request) => $request->user());

    Route::apiResources([
        'korisnik' =>  KorisnikController::class,
        'tim' => TimController::class
    ]);
    
    Route::post('/korisnik-promena-uloge/{korisnik_id}', [KorisnikController::class, 'promeniUlogu']);
    
    Route::post('/tim-korisnik/dodaj-korisnika', [TimKorisnikController::class, 'dodajKorisnikaUTim']);
    Route::delete('/tim-korisnik/obrisi-korisnika/{korisnik_id}', [TimKorisnikController::class, 'obrisiKorisnikaIzTima']);
    Route::post('/tim-korisnik/status-menadzera', [TimKorisnikController::class, 'postaviUkloniMenadzeraTima']);
});