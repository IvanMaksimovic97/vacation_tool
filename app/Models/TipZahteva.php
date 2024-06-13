<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipZahteva extends Model
{
    use HasFactory;

    protected $table = 'tip_zahteva';
    protected $guarded = [];
    public $timestamps = false;
}
