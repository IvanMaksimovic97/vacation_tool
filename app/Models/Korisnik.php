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
    protected $hidden = ['password'];
    public $timestamps = true;

    public function uloga()
    {
        return $this->belongsTo(Uloga::class);
    }

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:d.m.Y H:i:s',
            'updated_at' => 'datetime:d.m.Y H:i:s',
        ];
    }
}
