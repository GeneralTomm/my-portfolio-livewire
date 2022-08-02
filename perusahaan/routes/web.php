<?php

use App\Http\Livewire\Backend\Area;
use App\Http\Livewire\Backend\Home;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Backend\Departemen;
use App\Http\Livewire\Backend\Section;
use App\Http\Livewire\Backend\Tipe;

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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/home', Home::class)->name('home');
    Route::get('/departemen', Departemen::class)->name('departemen');
    Route::get('/section', Section::class)->name('section');
    Route::get('/area', Area::class)->name('area');
    Route::get('/tipe', Tipe::class)->name('tipe');
});
