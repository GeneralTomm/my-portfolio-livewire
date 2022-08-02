<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Karyawan extends Model
{
    protected $table = 'karyawan';
    protected $primaryKey='id_karyawan';
    public $timestamps = false;
    protected $fillable = [
        'id_karyawan', 'nama_karyawan', 'jenis_kelamin','no_telp_karyawan', 'email_karyawan', 'password','status', 'tgl_bergabung',  'id_role'
    ];

}
