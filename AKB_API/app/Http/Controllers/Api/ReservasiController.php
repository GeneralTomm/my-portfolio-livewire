<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Reservasi;

class ReservasiController extends Controller
{
    // SHOW ALL
    public function index(){
        $reservasi = Reservasi::join('customer', 'reservasi.id_customer', '=' ,'customer.id_customer') 
                                ->join('meja', 'meja.id_meja', '=', 'reservasi.id_meja')
                                -> select('reservasi.*', 'customer.*','meja.*') ->get();

        if(count($reservasi) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $reservasi
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'daa' => null
        ], 404);
    }

    // CREATE
    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'id_customer' => 'required|numeric',
            'id_meja' => 'required|numeric',
            'id_karyawan' => 'required|numeric',
            'tanggal_reservasi' => 'required|date_format:Y-m-d',
            'sesi_reservasi' => 'required',
            
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $reservasi = Reservasi::create($storeData);


        return response([
            'message' => 'Create Reservasi Success',
            'data' => $reservasi,
        ], 200);
    }

    // UPDATE
    public function update(Request $request, $id){
        $reservasi = Reservasi::find($id);
        if(is_null($reservasi)){
            return response([
                'message' => 'Reservasi Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'id_customer' => 'required|numeric',
            'id_meja' => 'required|numeric',
            'tanggal_reservasi' => 'required|date_format:Y-m-d',
            'sesi_reservasi' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $reservasi->id_customer = $updateData['id_customer'];
        $reservasi->id_meja = $updateData['id_meja'];
        $reservasi->tanggal_reservasi = $updateData['tanggal_reservasi'];
        $reservasi->sesi_reservasi = $updateData['sesi_reservasi'];
       

        if($reservasi->save()){
            return response([
                'message' => 'Update Reservasi Success',
                'data' => $reservasi,
            ], 200);
        }
        
        return response([
            'message' => 'Update Reservasi Failed',
            'data' => null
        ], 400);
    }

    // DELETE
    public function destroy($id){
        $reservasi = Reservasi::find($id);

        if(is_null($reservasi)){
            return response([
                'message' => 'Reservasi Not Found',
                'data' => null
            ], 404);
        }

        if($reservasi->delete()){
            return response([
                'message' => 'Delete Reservasi Success',
                'data' => $reservasi
            ], 200);
        }

        return response([
            'message' => 'Delete Reservasi Failed',
            'data' => null
        ], 400);
    }

   
}
