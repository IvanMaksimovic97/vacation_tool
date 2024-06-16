<?php

use App\Http\Controllers\API\ApiAuthController;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\KorisnikController;
use App\Http\Controllers\TimController;
use App\Http\Controllers\TimKorisnikController;
use App\Http\Controllers\TimZahtevController;
use App\Http\Middleware\AdministratorPristup;
use App\Http\Middleware\KorisnikPripadaTimu;
use App\Http\Middleware\MenadzerPristup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [ApiAuthController::class, 'login']);

//Rute kojima je moguce pristupiti samo ukoliko ste ulogovani na aplikaciju
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [ApiAuthController::class, 'logout']);
    Route::get('/ulogovan-korisnik', [ApiAuthController::class, 'ulogovanKorisnik']);

    //Rute za ulogu ADMINISTRATOR
    Route::middleware(AdministratorPristup::class)->group(function () { 
        Route::apiResources([
            'korisnik' =>  KorisnikController::class,
            'tim' => TimController::class
        ]);

        Route::post('/korisnik-promena-uloge/{korisnik_id}', [KorisnikController::class, 'promeniUlogu']);
        Route::post('/korisnik-promena-tima/{korisnik_id}', [KorisnikController::class, 'promeniTim']);
    });

    Route::get('/korisnik-pregled-tima', [KorisnikController::class, 'pregledTima'])->middleware(MenadzerPristup::class);
    
    Route::post('/zahtev/kreiraj-zahtev', [TimZahtevController::class, 'kreiranjeZahteva'])->middleware(KorisnikPripadaTimu::class);
    Route::get('/zahtev/pregled-zahteva', [TimZahtevController::class, 'pregledZahteva'])->middleware(KorisnikPripadaTimu::class);
    Route::get('/zahtev/pregled-sopstvenih-zahteva', [TimZahtevController::class, 'pregledSopstvenihZahteva'])->middleware(KorisnikPripadaTimu::class);

    Route::post('/zahtev/odgovor-na-zahtev/{zahtev_id}', [TimZahtevController::class, 'odgovorNaZahtev'])->middleware(MenadzerPristup::class);
});