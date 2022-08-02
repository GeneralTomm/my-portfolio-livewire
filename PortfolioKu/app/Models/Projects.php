<?php

namespace App\Models;

use App\Models\CategoriesProjects;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Projects extends Model
{
    use HasFactory;

    protected $table ='projects';
    protected $fillable = ['name' , 'slug' , 'images', 'description' , 'url' ,'categoriesproject_id'];

    public function categoriesprojects(){
        return $this->belongsTo(CategoriesProjects::class);
    }
}
