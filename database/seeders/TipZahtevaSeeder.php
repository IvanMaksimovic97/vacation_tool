<?php

namespace Database\Seeders;

use App\Models\TipZahteva;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipZahtevaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipovi = ['Godišnji odmor', 'Slobodan dan'];

        foreach ($tipovi as $tip) {
            $noviTip = new TipZahteva;
            $noviTip->naziv = $tip;
            $noviTip->save();
        }
    }
}
