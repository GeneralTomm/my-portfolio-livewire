<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaturanWeb extends Model
{
    use HasFactory;

    protected $table = 'pengaturan_website';
    protected $fillable = ['nama_website' , 'url_facebook', 'nomor_hp' , 'url_instagram' , 'url_youtube', 'deskripsi' ,'email'];
}
