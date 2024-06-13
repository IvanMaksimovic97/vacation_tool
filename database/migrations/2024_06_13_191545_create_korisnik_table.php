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
        Schema::create('korisnik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uloga_id')->comment('1. Administrator, 2. Menadzer, 3. Korisnik')->constrained('uloga');
            $table->string('ime')->default('');
            $table->string('prezime')->default('');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('broj_dana_godisnjeg_odmora')->default(0);
            $table->integer('broj_slobodnih_dana')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('korisnik');
    }
};
