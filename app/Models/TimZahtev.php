<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimZahtev extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tim_zahtev';
    protected $guarded = [];
    public $timestamps = true;

    public function timKorisnik()
    {
        return $this->belongsTo(TimKorisnik::class);
    }

    public function tim()
    {
        return $this->belongsTo(Tim::class);
    }

    public function korisnik()
    {
        return $this->belongsTo(Korisnik::class);
    }

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:d.m.Y H:i:s',
            'updated_at' => 'datetime:d.m.Y H:i:s',
        ];
    }
}
