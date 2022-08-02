<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey='id_menu';
    public $timestamps = false;
    protected $fillable = [
        'id_menu', 'id_bahan', 'nama_menu', 'kategori_menu', 'deskripsi_menu', 'unit_menu', 'harga_menu'
    ]; 
    
}
