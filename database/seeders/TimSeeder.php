<?php

namespace Database\Seeders;

use App\Models\Tim;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 20) as $index) {
            $noviTim = new Tim;
            $noviTim->naziv = 'Tim '.$index;
            $noviTim->opis = fake()->text(100);
            $noviTim->created_at = Carbon::now();
            $noviTim->save();
        }
    }
}
