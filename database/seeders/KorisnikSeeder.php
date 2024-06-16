<?php

namespace Database\Seeders;

use App\Models\Korisnik;
use App\Models\Tim;
use App\Models\Uloga;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KorisnikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ulogeIds = Uloga::all()->pluck("id")->toArray();
        $timoviIds = Tim::all()->pluck("id")->toArray();

        foreach (range(1, 20) as $index) {
            $noviKorisnik = new Korisnik;
            $noviKorisnik->tim_id = fake()->randomElement($timoviIds);
            $noviKorisnik->uloga_id = fake()->randomElement($ulogeIds);
            $noviKorisnik->ime = fake()->firstName;
            $noviKorisnik->prezime = fake()->lastName;
            $noviKorisnik->email = fake()->email;
            $noviKorisnik->password = Hash::make('test');
            $noviKorisnik->broj_dana_godisnjeg_odmora = 20;
            $noviKorisnik->broj_slobodnih_dana = 5;
            $noviKorisnik->created_at = Carbon::now();
            $noviKorisnik->save();
        }
    }
}
