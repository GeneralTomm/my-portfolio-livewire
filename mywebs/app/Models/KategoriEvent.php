<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriEvent extends Model
{
    use HasFactory;

    protected $table = 'kategori_event';
    protected $fillable = ['nama_kategori' , 'slug', 'status'];

    public function event(){
        return $this->hasMany(Event::class);
    }
}
