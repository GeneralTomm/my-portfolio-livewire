<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriKelas extends Model
{
    use HasFactory;

    protected $table = 'kategori_kelas';

    protected $fillable = [
         'nama_kategori' ,'status' , 'user_id'
    ];

    public function getUsers(){
        return $this->belongsTo(User::class, 'user_id' , 'id');
    }
}
