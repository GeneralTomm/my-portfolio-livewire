<?php
use App\Http\Livewire\UsersDashboard\DashboardLivewire;
use App\Http\Livewire\UsersDashboard\KategoriLivewire;
use App\Http\Livewire\UsersDashboard\KelasLivewire;
use App\Http\Livewire\UsersDashboard\KuponLivewire;
use App\Http\Livewire\UsersDashboard\PengaturanLivewire;
use App\Http\Livewire\UsersDashboard\PilihanKelasLivewire;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth'], function () {
   Route::get('/dasbor' , DashboardLivewire::class)->name('dasbor');
   Route::get('/pilihan-kelas' , PilihanKelasLivewire::class)->name('pilihan-kelas');
   Route::get('/kelas-anda' , KelasLivewire::class)->name('kelas-anda');
   Route::get('/kategori-kelas' , KategoriLivewire::class)->name('kategori-kelas');
   Route::get('/kupon-bootcamp' , KuponLivewire::class)->name('kupon-bootcamp');
   Route::get('/pengaturan' , PengaturanLivewire::class)->name('pengaturan');

});



