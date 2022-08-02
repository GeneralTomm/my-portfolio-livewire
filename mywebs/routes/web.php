<?php

use App\Http\Livewire\Event;
use App\Http\Livewire\Team\Tim;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Kontak\Kontak;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\PengaturanWebsite;
use App\Http\Livewire\Departemen\Departemen;
use App\Http\Livewire\KategoriEvent\KategoriEvent;

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




Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('pengaturan', PengaturanWebsite::class)->name('pengaturan');
    Route::get('acara', Event::class)->name('event');
    Route::get('kategori-acara', KategoriEvent::class)->name('kategoriEvent');
    Route::get('tim', Tim::class)->name('tim');
    Route::get('departemen', Departemen::class)->name('departemen');
    Route::get('kontak', Kontak::class)->name('kontak');
});


Route::get('/', function(){
    return view('home');
});
Route::get('kontak-kami', Kontak::class)->name('kontaks');
