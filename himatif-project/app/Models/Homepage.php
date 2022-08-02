<?php

namespace App\Models;

use App\Models\Backend\Departemen;
use App\Models\Backend\Tim;
use App\Models\Backend\Setting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homepage extends Model
{
    use HasFactory;

    public function settings(){
        return $this->belongsTo(Setting::class);
    }

    public function tim(){
        return $this->belongsTo(Tim::class);
    }
    public function departemen(){
        return $this->belongsTo(Departemen::class);

    }
}
