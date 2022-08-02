<?php

namespace App\Models\Admin;

use App\Models\Admin\Blogs;
use App\Models\Admin\Abouts;
use App\Models\Admin\Projects;
use App\Models\Admin\Services;
use App\Models\Admin\Settings;
use App\Models\Admin\Testimonials;
use App\Models\Admin\CategoriesBlogs;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\CategoriesProjects;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dashboard extends Model
{
    use HasFactory;

    public function categoriesproject(){
        return $this->belongsTo(CategoriesProjects::class);
    }
    public function project(){
        return $this->belongsTo(Projects::class);
    }
    public function services(){
        return $this->belongsTo(Services::class);
    }
    public function categoriesblog(){
        return $this->belongsTo(CategoriesBlogs::class);
    }
    public function blog(){
        return $this->belongsTo(Blogs::class);
    }
    public function about(){
        return $this->belongsTo(Abouts::class);
    }
    public function settings(){
        return $this->belongsTo(Settings::class);
    }
    public function testimonial(){
        return $this->belongsTo(Testimonials::class);
    }
}
