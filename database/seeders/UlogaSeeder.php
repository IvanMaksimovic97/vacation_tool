<?php

namespace Database\Seeders;

use App\Models\Uloga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UlogaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $uloge = ['Administrator', 'Menadzer', 'Korisnik'];

        foreach ($uloge as $uloga) {
            $novaUloga = new Uloga;
            $novaUloga->naziv = $uloga;
            $novaUloga->save();
        }
    }
}
