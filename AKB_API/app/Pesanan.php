<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey='id_pesanan';
    public $timestamps = false;
    protected $fillable = [
        'id_pesanan', 'id_karyawan', 'id_reservasi', 'sub_total', 'status_pesanan', 'service', 'tax','total_qty','total_item','total_harga'
    ];
}
