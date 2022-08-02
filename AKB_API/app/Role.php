<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Role extends Model
{
    protected $table = 'role_karyawan';
    protected $primaryKey='id_role';
    public $timestamps = false;
    protected $fillable = [
        'nama_role'
    ];

   
}
