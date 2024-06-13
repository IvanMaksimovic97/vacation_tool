<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tim_zahtev', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tim_korisnik_id')->constrained('tim_korisnik')->cascadeOnDelete();
            $table->foreignId('tim_id')->constrained('tim');
            $table->foreignId('korisnik_id')->constrained('korisnik');
            $table->foreignId('tip_zahteva_id')->comment('1. Godisnji odmor, 2. Slobodan dan')->constrained('tip_zahteva');
            $table->date('datum_od')->nullable()->default(null);
            $table->date('datum_do')->nullable()->default(null);
            $table->integer('broj_dana')->default(0);
            $table->integer('status')->comment('0. Na cekanju, 1. Odobren, 2. Odbijen')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tim_zahtev');
    }
};
