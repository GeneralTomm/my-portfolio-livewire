<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sistem extends Model
{
    use HasFactory;

    protected $table = 'sistems';

    protected $fillable = ['kode', 'nama','sektor' , 'papan', 'lembar' , 'lot'];
}
