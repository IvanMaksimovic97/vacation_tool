<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\returnSelf;

class Zahtev extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'zahtev';
    protected $guarded = [];
    public $timestamps = true;

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

    public static function brojPreklapajucihZahtevaKreiranje($tim_id, $datum_od, $datum_do)
    {
        return self::join('korisnik', 'zahtev.korisnik_id', '=', 'korisnik.id')
            ->where('korisnik.tim_id', '=', $tim_id)
            ->where('zahtev.datum_do', '>=', $datum_od)
            ->where('zahtev.datum_od', '<=', $datum_do)
            ->where(function ($query) { 
                $query->where('status', 0)->orWhere('status', 1);
            })
            ->count();
    }

    public static function brojPreklapajucihZahtevaOdobrenje($tim_id, $datum_od, $datum_do)
    {
        return self::join('korisnik', 'zahtev.korisnik_id', '=', 'korisnik.id')
            ->where([
                ['korisnik.tim_id', '=', $tim_id],
                ['zahtev.datum_do', '>=', $datum_od],
                ['zahtev.datum_od', '<=', $datum_do],
                ['zahtev.status', '=', 1]
            ])->count();
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
