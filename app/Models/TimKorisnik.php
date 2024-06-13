<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimKorisnik extends Model
{
    use HasFactory;

    protected $table = 'tim_korisnik';
    protected $guarded = [];
    public $timestamps = true;

    public function tim()
    {
        return $this->belongsTo(Tim::class);
    }

    public function korisnik()
    {
        return $this->belongsTo(Korisnik::class);
    }
}
