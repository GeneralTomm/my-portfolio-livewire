<?php

namespace App\Models\Backend;

use App\Models\Backend\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dashboard extends Model
{
    use HasFactory;

    public function setting(){
        return $this->belongsTo(Setting::class);
    }
}
