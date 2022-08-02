<?php

use App\Http\Livewire\Admin\Blog;
use App\Http\Livewire\Admin\AboutMe;
use App\Http\Livewire\Admin\Project;
use App\Http\Livewire\Admin\Service;
use App\Http\Livewire\Admin\Setting;
use App\Http\Livewire\Front\Homepage;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\OrdersStep;
use App\Http\Livewire\Admin\Testimonial;
use App\Http\Livewire\Admin\CategoriesBlog;
use App\Http\Livewire\Admin\CategoriesProject;
use App\Http\Livewire\Front\AboutMe as FrontAboutMe;

// front-end

Route::get('/', Homepage::class);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('categories-project', CategoriesProject::class)->name('categories-project');
    Route::get('project', Project::class)->name('project');
    Route::get('services', Service::class)->name('services');
    Route::get('testimonial', Testimonial::class)->name('testimonial');
    Route::get('order-step', OrdersStep::class)->name('order-step');
    Route::get('settings', Setting::class)->name('settings');
    Route::get('about-me', AboutMe::class)->name('about-me');
    Route::get('blog', Blog::class)->name('blog');
    Route::get('categories-blog', CategoriesBlog::class)->name('categories-blog');
});

Route::get('about', FrontAboutMe::class)->name('about');
