<?php

namespace App\Models;

use App\Models\KategoriEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $table ='events';
    protected $guarded = [];
    // protected $fillable = [
    //     'nama_event', 'slug' , 'gambar' , 'alamat',
    //     'deskripsi', 'acara_mulai' , 'acara_selesai' , 'pendaftaran', 'kategorievent_id'
    // ];

    public function kategorievent(){
        return $this->belongsTo(KategoriEvent::class);
    }


    public function scopeSearch($query,$term){
        $term = "%term%";
        $query->where(function($query)use($term){
            $query->where('nama_event','like', $term);
        });
    }
}
