<?php

use App\Http\Controllers\API\ApiAuthController;
use App\Http\Controllers\API\KorisnikController;
use App\Http\Controllers\API\TimController;
use App\Http\Controllers\API\ZahtevController;
use App\Http\Middleware\AdministratorPristup;
use App\Http\Middleware\KorisnikPripadaTimu;
use App\Http\Middleware\MenadzerPristup;
use Illuminate\Support\Facades\Route;

Route::post('/login', [ApiAuthController::class, 'login']);

/**
 * Rute kojima je moguce pristupiti samo ukoliko ste ulogovani na aplikaciju
 */
Route::middleware(['auth:sanctum'])->group(function () {
    /**
     * Rute za ulogu ADMINISTRATOR
     */
    Route::middleware(AdministratorPristup::class)->group(function () { 
        Route::apiResources([
            'korisnik' =>  KorisnikController::class,
            'tim' => TimController::class
        ]);

        Route::post('/korisnik-promena-uloge/{korisnik_id}', [KorisnikController::class, 'promeniUlogu']);
        Route::post('/korisnik-promena-tima/{korisnik_id}', [KorisnikController::class, 'promeniTim']);
    });

    /**
     * Rute za ulogu MENADZER
     */
    Route::middleware(MenadzerPristup::class)->group(function () {
        Route::get('/korisnik-pregled-tima', [KorisnikController::class, 'pregledTima']);
        Route::post('/zahtev/odgovor-na-zahtev/{zahtev_id}', [ZahtevController::class, 'odgovorNaZahtev']);
    });

    /**
     * Rute kojima moze pristupiti samo korisnik ukoliko je dodeljen timu
     */
    Route::middleware(KorisnikPripadaTimu::class)->group(function () {
        Route::post('/zahtev/kreiraj-zahtev', [ZahtevController::class, 'kreiranjeZahteva']);
        Route::get('/zahtev/pregled-zahteva', [ZahtevController::class, 'pregledZahteva']);
        Route::get('/zahtev/pregled-sopstvenih-zahteva', [ZahtevController::class, 'pregledSopstvenihZahteva']);
        Route::get('/zahtev/otkazi-zahtev/{zahtev_id}', [ZahtevController::class, 'otkazivanjeZahteva']);
    });

    /**
     * Ostale rute
     */
    Route::get('/ulogovan-korisnik', [ApiAuthController::class, 'ulogovanKorisnik']);
    Route::get('/logout', [ApiAuthController::class, 'logout']);
});