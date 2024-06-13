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
        Schema::create('tim_korisnik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('korisnik_id')->constrained('korisnik');
            $table->foreignId('tim_id')->constrained('tim');
            $table->boolean('je_menadzer')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tim_korisnik');
    }
};
