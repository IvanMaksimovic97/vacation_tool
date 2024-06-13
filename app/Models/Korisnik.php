<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Korisnik extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'korisnik';
    protected $guarded = [];
    public $timestamps = true;

    public function uloga()
    {
        return $this->belongsTo(Uloga::class);
    }
}
