<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abouts extends Model
{
    use HasFactory;

    protected $table = 'abouts';

    protected $fillable = ['short_title' , 'title' ,'description'];
}
