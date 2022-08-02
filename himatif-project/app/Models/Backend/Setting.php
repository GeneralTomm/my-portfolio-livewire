<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table= 'settings';
    protected $fillable = ['nama_website' , 'url_facebook', 'nomor_hp' , 'url_instagram' , 'url_youtube', 'deskripsi' ,'email'];
}
