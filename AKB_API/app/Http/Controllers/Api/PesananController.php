<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Pesanan;
use App\DetailPesanan;

class PesananController extends Controller
{
    //method untuk menampilkan semua data product (read)
    public function indexBelumSaji() {
        $pesanan = Pesanan::join('Reservasi' , 'pesanan.id_reservasi', '=' , 'reservasi.id_reservasi') ->
                            join('karyawan', 'reservasi.id_karyawan', '=' ,'karyawan.id_karyawan' ) ->
                            join( 'meja' , 'reservasi.id_meja', '=' ,'meja.id_meja') ->
                            join('customer' , 'reservasi.id_customer', '=' ,'customer.id_customer') ->
                            select('karyawan.nama_karyawan', 'meja.no_meja', 'pesanan.*', 'customer.nama_customer')->
                            where('status_pesanan', '=', 'Belum Disajikan')->get();

        if(count($pesanan) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $pesanan
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 404);
    }

    public function indexAll() {
        $pesanan = Pesanan::join('Reservasi' , 'pesanan.id_reservasi', '=' , 'reservasi.id_reservasi') ->
                            join( 'meja' , 'reservasi.id_meja', '=' ,'meja.id_meja') ->
                            join('customer' , 'reservasi.id_customer', '=' ,'customer.id_customer') -> where('reservasi.status', '=', 'Belum Selesai') ->
                            select('karyawan.nama_karyawan', 'meja.no_meja', 'pesanan.*', 'customer.nama_customer')->get();

        if(count($pesanan) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $pesanan
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 404);
    }

    public function indexAllOPM() {
        $pesanan = Pesanan::join('Reservasi' , 'pesanan.id_reservasi', '=' , 'reservasi.id_reservasi') ->
                            join('karyawan', 'reservasi.id_karyawan', '=' ,'karyawan.id_karyawan' ) ->
                            join( 'meja' , 'reservasi.id_meja', '=' ,'meja.id_meja') ->
                            join('customer' , 'reservasi.id_customer', '=' ,'customer.id_customer') -> 
                            select('karyawan.nama_karyawan', 'meja.no_meja', 'pesanan.*', 'customer.nama_customer')->get();

        if(count($pesanan) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $pesanan
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 404);
    }

    public function updatePesananTotal($idPesanan) {
        $pesanan = Pesanan::where('id_pesanan', '=', $idPesanan)->first();

        $subtotal = Pesanan::join('detail_pesanan', 'detail_pesanan.id_pesanan', '=', 'pesanan.id_pesanan')
            ->where('pesanan.id_pesanan', '=', $idPesanan)
            ->sum('detail_pesanan.subtotal_harga');

        $service = $subtotal * 5/100;

        $tax = $subtotal * 10/100;

        $total = $subtotal + $service + $tax;

        $totalQty = DetailPesanan::where('id_pesanan', '=', $idPesanan)
                    ->sum('jumlah_item_pesanan');

        $totalItem = DetailPesanan::where('id_pesanan', '=', $idPesanan)
                    ->count();

        $pesanan->sub_total = $subtotal;
        $pesanan->service = $service;
        $pesanan->tax = $tax;
        $pesanan->total_harga = $total;
        $pesanan->total_qty = $totalQty;
        $pesanan->total_item = $totalItem;


        if($pesanan->save()) {
            return response([
                'message' => 'Update Total Pesanan Success',
                'data' => $pesanan
            ], 200);
        }

        return response([
            'message' => 'Update Total Pesanan Failed',
            'data' => $totalQty
        ], 202);
    
    }

    public function checkPesananByReservasi($cari) {
        $pesanan = Pesanan::where('id_reservasi', '=', $cari)->first();

        if(is_null($pesanan)) {
            return response([
                'message' => 'Data Pesanan Not Found',
                'data' => $pesanan
            ], 202);
        }

        return response([
            'message' => 'Data Pesanan Found',
            'data' => $pesanan
        ], 200);
    }

    public function getMeja() {
        $pesanan = Pesanan::join('reservasi', 'pesanan.id_reservasi', '=', 'reservasi.id_reservasi')
                        ->join('meja', 'reservasi.id_meja', '=', 'meja.id_meja')
                        ->select('meja.no_meja')->where('reservasi.status', '=', 'Belum Selesai')
                        ->pluck('meja.no_meja');
        
        if(count($pesanan) > 0){
            return response([
                'message' => 'Retrieve No Meja Success',
                'data' => $pesanan
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 404);
    }

    public function showWaiter($cari) {
        $pesanan = Pesanan::join('reservasi', 'reservasi.id_reservasi', '=' ,'pesanan.id_reservasi' ) ->
                                join( 'karyawan' , 'karyawan.id_karyawan', '=' ,'reservasi.id_karyawan') ->
                                select('karyawan.nama_karyawan')->
                                where('pesanan.id_pesanan','like',$cari)->pluck('karyawan.nama_karyawan');

        if(!is_null($pesanan)) {
            return response([
                'message' => 'Retrive transaksi Success',
                'data' => $pesanan
            ], 200);
        }
    }

    // public function CountTotalItem() {
    //     $pesanan = Pesanan::join('detail_pesanan' , 'pesanan.id_pesanan', '=' , 'detail_.id_reservasi') ->
    //                         join('karyawan', 'reservasi.id_karyawan', '=' ,'karyawan.id_karyawan' ) ->
    //                         join( 'meja' , 'reservasi.id_meja', '=' ,'meja.id_meja') ->
    //                         join('customer' , 'reservasi.id_customer', '=' ,'customer.id_customer') ->
    //                         select('karyawan.nama_karyawan', 'meja.no_meja', 'pesanan.*', 'customer.nama_customer')->
    //                         where('status_pesanan', '=', 'Belum Disajikan')->get();

    //     if(count($pesanan) > 0) {
    //         return response([
    //             'message' => 'Retrieve All Success',
    //             'data' => $pesanan
    //         ], 200);
    //     }

    //     return response([
    //         'message' => 'Empty',
    //         'data' => null
    //     ], 404);
    // }

    public function indexSiapDisajikan() {
        $pesanan = Pesanan::join('Reservasi' , 'pesanan.id_reservasi', '=' , 'reservasi.id_reservasi') ->
                            join('karyawan', 'reservasi.id_karyawan', '=' ,'karyawan.id_karyawan' ) ->
                            join( 'meja' , 'reservasi.id_meja', '=' ,'meja.id_meja') ->
                            join('customer' , 'reservasi.id_customer', '=' ,'customer.id_customer') ->
                            select('karyawan.nama_karyawan', 'meja.no_meja', 'pesanan.*', 'customer.nama_customer')->
                            where('status_pesanan', '=', 'Siap disajikan')->get();

        if(count($pesanan) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $pesanan
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 404);
    }
    

    //method untuk menampilkan 1 data product (search)
    public function show($cari) {
        $pesanan = Pesanan::find($cari);

        if(!is_null($pesanan)) {
            return response([
                'message' => 'Retrive pesanan Success',
                'data' => $pesanan
            ], 200);
        }

        return response([
            'message' => 'pesanan Not Found',
            'data' => null
        ], 404);
    }

    //method untuk menambah 1 data product baru (create)
    
    public function store(Request $request) {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'status_pesanan'  => 'required',           
            'sub_total' => 'required',
            'total_harga' => 'required',
            'total_qty' => 'required',
            'total_item' => 'required',
            'service' => 'required',
            'tax' => 'required',
            'id_reservasi' => 'required'       
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $pesanan = Pesanan::create($storeData);
        return response([
            'message' => 'Add pesanan Success',
            'data' => $pesanan,
        ], 200);
    }

    //method untuk menghapus 1 data product (delete)
    public function destroy($cari) {
        $pesanan = Pesanan::find($cari);

        if(is_null($pesanan)) {
            return response([
                'message' => 'pesanan Not Found',
                'data' => null
            ], 404);
        }

        if($pesanan->delete()) {
            return response([
                'message' => 'Delete pesanan Success',
                'data' => $pesanan,
            ], 200);
        }
        return response([
            'message' => 'Delete pesanan Failed',
            'data' => null
        ], 400);
    }

    
    public function status($id){
        $pesanan = Pesanan::find($id);

        if(is_null($pesanan)){
            return response([
                'message' => 'pesanan Not Found',
                'data' => null
            ], 404);
        }

        $pesanan->status_pesanan = 'Siap Disajikan';

        if($pesanan->save()){
            return response([
                'message' => 'Pesanan Siap Disajikan',
                'data' => $pesanan
            ], 200);
        }

        return response([
            'message' => 'Gagal Ubah Status',
            'data' => null
        ], 400);
    }

    public function showPesananMeja($cari) {
        $pesanan = Pesanan::join('reservasi', 'pesanan.id_reservasi', '=', 'reservasi.id_reservasi')
        ->join('detail_pesanan', 'pesanan.id_pesanan', '=', 'detail_pesanan.id_pesanan')
        ->join('meja', 'reservasi.id_meja', '=', 'meja.id_meja')
        ->join('menu', 'detail_pesanan.id_menu', '=', 'menu.id_menu')
        ->select('menu.nama_menu', 'detail_pesanan.jumlah_item_pesanan','detail_pesanan.subtotal_harga','pesanan.*' )
        ->where('meja.no_meja', '=', $cari)->get();

        if(!is_null($pesanan)){
            return response ([
                'message' => 'Retrive pesanan By ID Success',
                'data' => $pesanan
            ],200);
        }

        return response([
            'message' => 'pesanan not found',
            'data' => null
        ],404);
    }

    public function totalHargaMeja($cari) {
        $pesanan = Pesanan::join('reservasi', 'pesanan.id_reservasi', '=', 'reservasi.id_reservasi')
        ->join('meja', 'reservasi.id_meja', '=', 'meja.id_meja')
        ->select('meja.no_meja' ,'pesanan.*' )
        ->where('meja.no_meja', '=', $cari)->get();

        if(!is_null($pesanan)){
            return response ([
                'message' => 'Retrive pesanan By ID Success',
                'data' => $pesanan
            ],200);
        }

        return response([
            'message' => 'pesanan not found',
            'data' => null
        ],404);
    }
    public function pesananTransaksi(){
        $pesanan = Pesanan::join('reservasi', 'pesanan.id_reservasi', '=', 'reservasi.id_reservasi')
        ->join('detail_pesanan', 'pesanan.id_pesanan', '=', 'detail_pesanan.id_pesanan')
        ->join('meja', 'reservasi.id_meja', '=', 'meja.id_meja')
        ->select('pesanan.id_pesanan')
        ->where('reservasi.status', '=', 'Belum Selesai')->get();
        $pesananCount = $pesanan -> count();
        if(count($pesanan)>0){
            return response ([
                'count' => $pesananCount,
                'message' => 'Retrieve All Success',
                'data' => $pesanan
            ],200);
        }

        return response([
            'data' => null
        ],404);
    }

    
}