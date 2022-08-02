<?php

namespace App\Models;

use App\Models\Area;
use App\Models\Tipe;
use App\Models\Section;
use App\Models\Departement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataPerusahaan extends Model
{
    use HasFactory;
    protected $table = 'data_perusahaan';

    protected $fillable = [
        'nip', 'departement_id' , 'area_id' , 'tipe_id' ,'alamat' ,'tanggal' , 'name', 'section_id', 'seksi'
    ];

    public function departement(){
        return $this->belongsTo(Departement::class);
    }
    public function section(){
        return $this->belongsTo(Section::class);
    }
    public function area(){
        return $this->belongsTo(Area::class);
    }
    public function tipe(){
        return $this->belongsTo(Tipe::class);
    }
}
