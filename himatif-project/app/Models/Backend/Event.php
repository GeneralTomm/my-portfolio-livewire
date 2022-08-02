<?php

namespace App\Models\Backend;

use App\Models\Backend\KategoriEvent;
use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasTrixRichText;
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
    public function setting(){
        return $this->belongsTo(Setting::class);
    }


    public function scopeSearch($query,$term){
        $term = "%term%";
        $query->where(function($query)use($term){
            $query->where('nama_event','like', $term)
            ->orWhereHas('kategorievent',function($query)use($term){
                $query->where('nama_kategori','like', $term);
            });
        });
    }
}
