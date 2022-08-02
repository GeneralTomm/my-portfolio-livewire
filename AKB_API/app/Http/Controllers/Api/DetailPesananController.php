<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\DetailPesanan;

class DetailPesananController extends Controller
{
    //method untuk menampilkan semua data product (read)
    public function index() {
        $detail_pesanan = DetailPesanan::all();

        if(count($detail_pesanan) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $detail_pesanan
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 404);
    }

    public function showdetail($cari) {
        $detail_pesanan = DetailPesanan::join('pesanan', 'detail_pesanan.id_pesanan', '=' ,'pesanan.id_pesanan' ) ->
                                join( 'menu' , 'detail_pesanan.id_menu', '=' ,'menu.id_menu') ->
                                select('menu.nama_menu', 'detail_pesanan.jumlah_item_pesanan', 'detail_pesanan.subtotal_harga')->
                                where('detail_pesanan.id_pesanan','like',$cari)->get();

        if(!is_null($detail_pesanan)) {
            return response([
                'message' => 'Retrive Detail Pesanan Success',
                'data' => $detail_pesanan
            ], 200);
        }

        return response([
            'message' => 'Reservasi Not Found',
            'data' => null
        ], 404);
    }

    public function showdetailMeja($cari) {
        $detail_pesanan = DetailPesanan::join('pesanan', 'detail_pesanan.id_pesanan', '=' ,'pesanan.id_pesanan' ) ->
                                        join('reservasi', 'reservasi.id_reservasi', '=' ,'pesanan.id_reservasi' ) ->
                                        join('meja', 'meja.id_meja', '=' ,'reservasi.id_meja' ) ->
                                        join( 'menu' , 'detail_pesanan.id_menu', '=' ,'menu.id_menu') ->
                                        select('menu.nama_menu', 'detail_pesanan.jumlah_item_pesanan', 'detail_pesanan.subtotal_harga')->
                                        where('meja.no_meja','=',$cari)->get();

        if(!is_null($detail_pesanan)) {
            return response([
                'message' => 'Retrive Detail Pesanan Success',
                'data' => $detail_pesanan
            ], 200);
        }

        return response([
            'message' => 'Detail Pesanan Not Found',
            'data' => null
        ], 404);
    }

    //method untuk menampilkan 1 data product (search)
    public function show($cari) {
        $detail_pesanan = DetailPesanan::find($cari);

        if(!is_null($detail_pesanan)) {
            return response([
                'message' => 'Retrive detail pesanan Success',
                'data' => $detail_pesanan
            ], 200);
        }

        return response([
            'message' => 'Detail Pesanan Not Found',
            'data' => null
        ], 404);
    }

    //method untuk menambah 1 data product baru (create)
    
    public function store(Request $request) {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'jumlah_item_pesanan'  => 'required',           
            'subtotal_harga' => 'required',
            'id_pesanan' => 'required',
            'id_menu' => 'required'             
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $detail_pesanan = DetailPesanan::create($storeData);
        return response([
            'message' => 'Add Detail Pesanan Success',
            'data' => $detail_pesanan,
        ], 200);
    }

    //method untuk menghapus 1 data product (delete)
    public function destroy($cari) {
        $detail_pesanan = DetailPesanan::find($cari);

        if(is_null($detail_pesanan)) {
            return response([
                'message' => 'Detail Pesanan Not Found',
                'data' => null
            ], 404);
        }

        if($detail_pesanan->delete()) {
            return response([
                'message' => 'Delete Detail Pesanan Success',
                'data' => $detail_pesanan,
            ], 200);
        }
        return response([
            'message' => 'Delete detail pesanan Failed',
            'data' => null
        ], 400);
    }

    //method untuk mengubah 1 data product (update)
    public function update(Request $request, $cari) {
        $detail_pesanan = DetailPesanan::find($cari);
        if(is_null($detail_pesanan)) {
            return response([
                'message' => 'detail pesanan Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'jumlah_item_pesanan'  => 'required',           
            'subtotal_harga' => 'required',
            'id_pesanan' => 'required',
            'id_menu' => 'required'         
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $detail_pesanan->jumlah_item_pesanan = $updateData['jumlah_item_pesanan'];
        $detail_pesanan->subtotal_harga = $updateData['subtotal_harga'];
        $detail_pesanan->id_pesanan = $updateData['id_pesanan'];
        $detail_pesanan->id_menu = $updateData['id_menu'];

        if($detail_pesanan->save()) {
            return response([
                'message' => 'Update detail pesanan Success',
                'data' => $detail_pesanan
            ], 200);
        }
        return response([
            'message' => 'Update detail pesanan Failed',
            'data' => null
        ], 400);
    }
}