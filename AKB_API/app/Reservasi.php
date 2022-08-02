<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservasi extends Model
{
    protected $table = 'reservasi';
    protected $primaryKey='id_reservasi';
    public $timestamps = false;
    protected $fillable = [
        'id_reservasi', 'id_customer', 'id_meja','id_karyawan', 'tanggal_reservasi', 'sesi_reservasi'
    ];

}
