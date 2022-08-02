<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesProject extends Model
{
    use HasFactory;
    protected $table = 'categories_projects';
    protected $fillable = ['name_categories' ,'slug'];
}
