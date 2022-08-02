<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesProjects extends Model
{
    use HasFactory;

    protected $table = 'categories_projects';
    protected $fillable =['name' , 'slug'];

}
