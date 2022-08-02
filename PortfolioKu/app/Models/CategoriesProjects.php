<?php

namespace App\Models;

use App\Models\Projects;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoriesProjects extends Model
{
    use HasFactory;

    protected $table ='categories_projects';
    protected $fillable = ['name_categories_project', 'slug'];
}
