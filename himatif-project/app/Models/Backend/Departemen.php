<?php

namespace App\Models\Backend;

use App\Models\Backend\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departemen extends Model
{
    use HasFactory;

    protected $table ='table_departemen';
    protected $fillable = ['nama' ,'deskripsi' , 'gambar'];

    public function setting(){
        return $this->belongsTo(Setting::class);
    }
}
