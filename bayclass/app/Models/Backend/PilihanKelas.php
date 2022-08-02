<?php

namespace App\Models\Backend;

use App\Models\User;
use App\Models\Backend\KategoriKelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PilihanKelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas', 'gambar_kelas', 'deskripsi_kelas', 'kategorikelas_id', 'user_id', 'harga_kelas', 'dipilih_user_id', 'status'
    ];

    public function getKategoriKelas()
    {
        return $this->belongsTo(KategoriKelas::class, 'kategorikelas_id')->select('id', 'nama_kategori', 'status');
    }

    public function getUsers()
    {
        return $this->belongsTo(User::class, 'user_id' , 'id');
    }

    public function dipilih_users()
    {
        return $this->belongsTo(User::class, 'dipilih_user_id' ,'id')->select('id', 'name');
    }



}
