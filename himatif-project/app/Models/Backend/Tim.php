<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tim extends Model
{
    use HasFactory;
    protected $table ='tim';
    protected $fillable =
    [
        'nama' , 'jabatan' , 'instagram' , 'facebook' , 'twitter', 'gambar' , 'status'
    ];

    public function setting(){
        return $this->belongsTo(Setting::class);
    }
}
