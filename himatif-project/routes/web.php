<?php

use App\Http\Livewire\Homepage;
use App\Http\Livewire\EventShow;
use App\Http\Livewire\BackEnd\Tim;
use App\Http\Livewire\BackEnd\Event;
use App\Http\Livewire\Front\Contact;
use App\Http\Livewire\Front\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\BackEnd\Setting;
use App\Http\Livewire\Front\EventAcara;
use App\Http\Livewire\BackEnd\Dashboard;
use App\Http\Livewire\Backend\Departemen;
use App\Http\Livewire\BackEnd\KategoriEvent;

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

Route::get('/', Homepage::class)->name('/');
Route::get('/kontak-kami', Contact::class)->name('kontak-kami');
Route::get('/profil-kami', Profile::class)->name('profil-kami');
Route::get('/event-kami', EventAcara::class)->name('event-kami');
Route::get('/event/{event:slug}', EventShow::class)->name('event-show');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('event', Event::class)->name('event');
    Route::get('settings', Setting::class)->name('settings');
    Route::get('kategori-event', KategoriEvent::class)->name('kategori-event');
    Route::get('departemen', Departemen::class)->name('departemen');
    Route::get('tim', Tim::class)->name('tim');
});
