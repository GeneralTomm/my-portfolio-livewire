<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksi';
    protected $primaryKey='id_detail_transaksi';
    public $timestamps = false;
    protected $fillable = [
        'id_detail_transaksi', 'id_transaksi', 'no_kartu', 'nama_pemilik', 'kode_verifikasi'
    ];
}
