<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBlogModels extends Model
{
    use HasFactory;

    protected $table = 'kategori_blog_models';

    protected $fillable = ['nama_kategori' , 'status'];
}
