<?php

use App\Http\Livewire\Admin\Setting;
use App\Http\Livewire\Admin\Projects;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\CategoriesProject;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('settings', Setting::class)->name('settings');
    Route::get('projects', Projects::class)->name('projects');
    Route::get('categories-project', CategoriesProject::class)->name('categories-project');
});
