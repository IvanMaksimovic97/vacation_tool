<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Korisnik extends User
{
    use HasFactory, SoftDeletes, HasApiTokens;

    protected $table = 'korisnik';
    protected $guarded = [];
    protected $hidden = ['password'];
    public $timestamps = true;

    public function uloga()
    {
        return $this->belongsTo(Uloga::class);
    }

    public function tim()
    {
        return $this->hasOne(TimKorisnik::class);
    }

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:d.m.Y H:i:s',
            'updated_at' => 'datetime:d.m.Y H:i:s',
        ];
    }
}
