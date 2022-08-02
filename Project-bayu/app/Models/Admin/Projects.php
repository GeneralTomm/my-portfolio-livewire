<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\CategoriesProjects;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Projects extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $fillable = ['name' , 'description' , 'url' , 'images' ,'slug','categoriesproject_id'];

    public function categoriesproject(){
        return $this->belongsTo(CategoriesProjects::class);
    }
}