<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login','Api\AuthController@login');
//Route::post('logout','Api\AuthController@logout');
    
    //Role
Route::get('role','Api\RoleController@index');//show
Route::get('role/{cari}','Api\RoleController@show');//show with id
Route::post('role','Api\RoleController@store');// insert
Route::put('role/{cari}','Api\RoleController@update');//update
Route::delete('role/{cari}','Api\RoleController@destroy');//delete

    //Karyawan
Route::get('karyawan','Api\KaryawanController@index');//show
Route::get('karyawanReservasi','Api\KaryawanController@indexReservasi');//show
Route::get('karyawan/{cari}','Api\KaryawanController@show');//show with id
Route::post('karyawan','Api\KaryawanController@store');// insert
Route::put('karyawan/{cari}','Api\KaryawanController@update');//update
Route::put('resignkaryawan/{cari}','Api\KaryawanController@resign');//update

    //Reservasi
Route::get('reservasi','Api\ReservasiController@index');//show
Route::get('reservasi/{cari}','Api\ReservasiController@show');//show with id
Route::post('reservasi','Api\ReservasiController@store');// insert
Route::put('reservasi/{cari}','Api\ReservasiController@update');//update
Route::delete('reservasi/{cari}','Api\ReservasiController@destroy');//delete

    //Pesanan
Route::get('pesanan','Api\PesananController@indexBelumSaji');//show
Route::get('pesananSiapSaji','Api\PesananController@indexSiapDisajikan');//show
Route::get('pesanan/{cari}','Api\PesananController@show');//show with id
Route::get('pesananByMeja/{cari}','Api\PesananController@showPesananMeja');//show with id
Route::post('status/{cari}','Api\PesananController@status');//show with id
Route::post('pesanan','Api\PesananController@store');// insert
Route::put('pesanan/{cari}','Api\PesananController@update');//update
Route::delete('pesanan/{cari}','Api\PesananController@destroy');//delete
Route::get('checkPesanan/{cari}','Api\PesananController@checkPesananByReservasi');
Route::get('totalHargaPesanan/{idPesanan}','Api\PesananController@updatePesananTotal');
Route::get('getMejaPesanan','Api\PesananController@getMeja');
Route::get('pesananTransaksi','Api\PesananController@pesananTransaksi');
Route::get('pesananHarga/{cari}','Api\PesananController@totalHargaMeja');//delete

    //Meja
Route::get('meja','Api\MejaController@index');//show
Route::get('mejaTersedia','Api\MejaController@showAvailable');//show
Route::get('meja/{cari}','Api\MejaController@show');//show with id
Route::post('meja','Api\MejaController@store');// insert
Route::put('meja/{cari}','Api\MejaController@update');//update
Route::delete('meja/{cari}','Api\MejaController@destroy');//delete
    //Menu
Route::get('menu','Api\MenuController@index');//show
Route::get('menu/{cari}','Api\MenuController@show');//show with id
Route::post('menu','Api\MenuController@store');// insert
Route::put('menu/{cari}','Api\MenuController@update');//update
Route::delete('menu/{cari}','Api\MenuController@destroy');//delete
Route::get('menu/image/{cari}','Api\MenuController@downloadImage'); //ambil meja image
Route::post('menu/image/{cari}','Api\MenuController@uploadImage'); //update image

    //DetailPesanan 
Route::get('detailpesanan','Api\DetailPesananController@index');//show
Route::get('detailpesanancari/{cari}','Api\DetailPesananController@show');//show with id
Route::get('detailcari/{cari}','Api\DetailPesananController@showdetail');
Route::get('detailpesananByMeja/{cari}','Api\DetailPesananController@showdetailMeja');
Route::post('detailpesanan','Api\DetailPesananController@store');// insert
Route::put('detailpesanan/{cari}','Api\DetailPesananController@update');//update
Route::delete('detailpesanan/{cari}','Api\DetailPesananController@destroy');//delete

    //Customer
Route::get('customer','Api\CustomerController@index');//show
Route::get('customer/{cari}','Api\CustomerController@show');//show with id
Route::post('customer','Api\CustomerController@store');// insert
Route::put('customer/{cari}','Api\CustomerController@update');//update
Route::delete('customer/{cari}','Api\CustomerController@destroy');//delete

    //Bahan
Route::get('bahan','Api\StokBahanController@index');//show
Route::get('bahan/{cari}','Api\StokBahanController@show');//show with id
Route::post('bahan','Api\StokBahanController@store');// insert
Route::put('bahan/{cari}','Api\StokBahanController@update');//update
Route::delete('bahan/{cari}','Api\StokBahanController@destroy');//delete

//HistoriStok
Route::get('historikal','Api\HistoriStokController@index');//show
Route::get('historikal/{cari}','Api\HistoriStokController@show');//show with id
Route::post('historikal','Api\HistoriStokController@store');// insert
Route::put('historikal/{cari}','Api\HistoriStokController@update');//update
Route::delete('historikal/{cari}','Api\HistoriStokController@destroy');//delete

//Transaksi
Route::get('transaksi','Api\TransaksiController@indexCustom');//show
Route::get('transaksi/{cari}','Api\TransaksiController@show');//show with id
Route::get('strukInfoTransaksi/{cari}','Api\TransaksiController@getStrukInfo');//show with i
Route::post('transaksi','Api\TransaksiController@store');// insert
Route::put('transaksi/{cari}','Api\TransaksiController@update');//update
Route::delete('transaksi/{cari}','Api\TransasksiController@destroy');//delete

//Laporan
Route::get('PendapatanMakanan/{tahun}','Api\LaporanController@laporanPendapatanMakanan');//show
Route::get('PendapatanSideDish/{tahun}','Api\LaporanController@laporanPendapatanSideDish');//show
Route::get('PendapatanMinuman/{tahun}','Api\LaporanController@laporanPendapatanMinuman');//show
Route::get('PendapatanMakananTahunan/{tahun1},{tahun2}','Api\LaporanController@laporanPendapatanMakananTahunan');//show
Route::get('PendapatanSideDishTahunan/{tahun1},{tahun2}','Api\LaporanController@laporanPendapatanSideDishTahunan');//show
Route::get('PendapatanMinumanTahunan/{tahun1},{tahun2}','Api\LaporanController@laporanPendapatanMinumanTahunan');//show

Route::get('PengeluaranMakanan/{tahun}','Api\LaporanController@laporanPengeluaranMakanan');//show
Route::get('PengeluaranSideDish/{tahun}','Api\LaporanController@laporanPengeluaranSideDish');//show
Route::get('PengeluaranMinuman/{tahun}','Api\LaporanController@laporanPengeluaranMinuman');//show
Route::get('PengeluaranMakananTahunan/{tahun1},{tahun2}','Api\LaporanController@laporanPengeluaranMakananTahunan');//show
Route::get('PengeluaranSideDishTahunan/{tahun1},{tahun2}','Api\LaporanController@laporanPengeluaranSideDishTahunan');//show
Route::get('PengeluaranMinumanTahunan/{tahun1},{tahun2}','Api\LaporanController@laporanPengeluaranMinumanTahunan');//show

Route::get('PenjualanMakananPerBulan/{tahun},{bulan}','Api\LaporanController@laporanPenjualanMakananPerBulan');//show
Route::get('PenjualanSideDishPerBulan/{tahun},{bulan}','Api\LaporanController@laporanPenjualanSideDishPerBulan');//show
Route::get('PenjualanMinumanPerBulan/{tahun},{bulan}','Api\LaporanController@laporanPenjualanMinumanPerBulan');//show
Route::get('PenjualanMakananPerTahun/{tahun}','Api\LaporanController@laporanPenjualanMakananPerTahun');//show
Route::get('PenjualanSideDishPerTahun/{tahun}','Api\LaporanController@laporanPenjualanSideDishPerTahun');//show
Route::get('PenjualanMinumanPerTahun/{tahun}','Api\LaporanController@laporanPenjualanMinumanPerTahun');//show

Route::delete('user/{id}','Api\AuthController@destroy');
Route::post('details', 'Api\AuthController@details')->middleware('verified');
Route::get('usercount','Api\AuthController@index');
Route::post('admin','Api\AdminController@login');

Route::post('updatePic/{id}','Api\AuthController@updatePic');//updatePicture
Route::put('update/{id}','Api\AuthController@update');//update Data User
Route::put('updateStatus/{id}','Api\TransaksiController@updateStatus');//Update Status id, Transaksi
Route::get('getT','Api\TransaksiController@getTransaksi');//get Data Transaksi

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
