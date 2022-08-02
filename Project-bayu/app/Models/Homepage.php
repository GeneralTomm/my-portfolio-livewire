<?php

namespace App\Models;

use App\Models\Admin\Settings;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homepage extends Model
{
    use HasFactory;

    public function setting()
    {
        return $this->belongsTo(Settings::class);
    }
}
