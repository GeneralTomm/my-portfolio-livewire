<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriEvent extends Model
{
    use HasFactory;
    protected $table = 'kategori_event';
    protected $fillable = ['nama_kategori' , 'slug', 'status'];

    public function setting(){
        return $this->belongsTo(Setting::class);
    }
}

