<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tim extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tim';
    protected $guarded = [];
    public $timestamps = true;

    public function korisnici()
    {
        return $this->hasMany(TimKorisnik::class);
    }
}
