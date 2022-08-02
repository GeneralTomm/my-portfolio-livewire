<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\KategoriBlogs;

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    // Route::get('/kategori-blogs/{random}/tambahan', [KategoriBlogs::class, 'index'])->name('kategori-blogs.create');
    // Route::get('kategori-blogs', [KategoriBlogs::class, 'index'])->name('kategori-blogs.index');

    // Route::get('kategori-blogs/{id}'[KategoriBlogs::class, 'show'])->name('kategori-blogs.show');
    Route::resource('kategori-blogs', KategoriBlogs::class);
});




require __DIR__.'/auth.php';
require __DIR__.'/data.php';
