<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    protected $table = 'detail_pesanan';
    protected $primaryKey='id_detail_pesanan';
    public $timestamps = false;
    protected $fillable = [
        'id_detail_pesanan', 'id_menu', 'id_pesanan', 'jumlah_item_pesanan', 'subtotal_harga'
    ];
}