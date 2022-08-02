<?php

use App\Http\Livewire\Front\DaftarLivewire;
use App\Http\Livewire\Front\FrontPageLivewire;
use App\Http\Livewire\Front\HalamanDinamisLivewire;
use App\Http\Livewire\Front\KelasSemuaLivewire;
use App\Http\Livewire\Front\MasukLivewire;
use App\Http\Livewire\Front\ResetLivewire;
use Illuminate\Support\Facades\Route;

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

Route::get('/' , FrontPageLivewire::class)->name('beranda');
Route::get('/reset' , ResetLivewire::class)->name('reset');
Route::get('/kelas-semua' , KelasSemuaLivewire::class)->name('kelas-semua');
Route::get('/halaman' , HalamanDinamisLivewire::class)->name('menu-dinamis');


Route::group(['middleware' => 'guest'], function () {
   Route::get('/masuk' , MasukLivewire::class)->name('masuk');
    Route::post('/masuk' , [MasukLivewire::class, 'masukForm'])->name('masukForm');

    // register
    Route::get('/daftar' , DaftarLivewire::class)->name('daftar');
    Route::post('/daftar' , [DaftarLivewire::class, 'daftarUsers'])->name('daftarUsers');

});

require 'front.php';
