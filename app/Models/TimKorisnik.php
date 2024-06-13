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

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:d.m.Y H:i:s',
            'updated_at' => 'datetime:d.m.Y H:i:s',
        ];
    }
}
