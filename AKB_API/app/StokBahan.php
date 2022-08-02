<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class StokBahan extends Model
{
    protected $table = 'stok_bahan';
    protected $primaryKey='id_bahan';
    public $timestamps = false;
    protected $fillable = [
        'nama_bahan', 'jumlah_stok', 'harga_bahan'
    ]; 
    
}
