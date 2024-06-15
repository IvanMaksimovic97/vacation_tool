<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use function PHPUnit\Framework\returnSelf;

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

    public function tipZahteva()
    {
        return $this->belongsTo(TipZahteva::class);
    }

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:d.m.Y H:i:s',
            'updated_at' => 'datetime:d.m.Y H:i:s',
        ];
    }

    public static function brojRadnihDana($pocetniDatum, $krajnjiDatum) 
    {
        $pocetni = new \DateTime($pocetniDatum);
        $krajnji = new \DateTime($krajnjiDatum);
        
        if($krajnji < $pocetni) {
            $temp = $pocetni;
            $pocetni = $krajnji;
            $krajnji = $temp;
        }
    
        $ukupanBrojDana = $krajnji->diff($pocetni)->days + 1;
        $puneNedelje = floor($ukupanBrojDana / 7);
        $radniDani = $puneNedelje * 5;
        $preostaliDani = $ukupanBrojDana % 7;
        $pocetniDanUNedelji = $pocetni->format('N');
        
        for ($i = 0; $i < $preostaliDani; $i++) {
            if ($pocetniDanUNedelji <= 5) { // 6 i 7 su vikendi (subota i nedelja)
                $radniDani++;
            }
            $pocetniDanUNedelji++;
            if ($pocetniDanUNedelji > 7) {
                $pocetniDanUNedelji = 1;
            }
        }
        
        return (int) $radniDani;
    }
}
