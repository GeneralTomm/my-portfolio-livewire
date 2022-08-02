<?php

namespace App\Models;

use App\Models\Tim;
use App\Models\Event;
use App\Models\Kontak;
use App\Models\Departemen;
use App\Models\KategoriEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dashboard extends Model
{
    use HasFactory;

    public function kategorievent(){
        return $this->belongsTo(KategoriEvent::class);
    }
    public function event(){
        return $this->belongsTo(Event::class);
    }
    public function departement(){
        return $this->belongsTo(Departemen::class);
    }
    public function kontak(){
        return $this->belongsTo(Kontak::class);
    }
    public function team(){
        return $this->belongsTo(Tim::class);
    }
}
