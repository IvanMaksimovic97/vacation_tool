<?php

use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\KorisnikController;
use App\Http\Controllers\TimController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/ruta', [ApiController::class, 'index']);

Route::apiResources([
    'korisnik' =>  KorisnikController::class,
    'tim' => TimController::class
]);

Route::post('/korisnik-promena-uloge/{korisnik_id}', [KorisnikController::class, 'promeniUlogu']);