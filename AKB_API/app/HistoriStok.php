<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class HistoriStok extends Model
{
    protected $table = 'histori_stok';
    protected $primaryKey='id_histori_stok';
    public $timestamps = false;
    protected $fillable = [
        'id_bahan', 'tgl_masuk_stok', 'tgl_keluar_stok','remaining_stok','waste_stok','incomming_stok'
    ]; 
    
}
