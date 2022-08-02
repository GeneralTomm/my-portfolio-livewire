<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey='id_transaksi';
    public $timestamps = false;
    protected $fillable = [
        'id_transaksi', 'id_pesanan', 'id_karyawan', 'no_transaksi', 'tgl_transaksi', 'waktu_transaksi', 'jenis_pembayaran','status_transaksi','jumlah_bayar'
    ];
}
