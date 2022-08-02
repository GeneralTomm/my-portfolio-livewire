<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Backend\Dashboard;
use App\Http\Livewire\Backend\MenuLivewire;
use App\Http\Livewire\Backend\SubMenuLivewire;

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
//     Route::get('dashboard', 'Dashboard')->name('dashboard');
// })->name('dashboard');

Route::middleware('auth:sanctum')->group(function(){
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('menu', MenuLivewire::class)->name('menu');
    Route::get('sub-menu', SubMenuLivewire::class)->name('submenu');
});
