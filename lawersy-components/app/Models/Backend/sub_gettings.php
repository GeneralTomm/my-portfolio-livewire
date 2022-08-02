<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_gettings extends Model
{
    use HasFactory;

    protected $table = 'sub_gettings';
    protected $fillable = ['sub_name_gettings', 'user_id'];


    public function user()
    {
        return $this->belongsTo('App\Models\user');
    }
}
