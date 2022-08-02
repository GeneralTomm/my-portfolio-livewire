<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\HistoriStok;

class HistoriStokController extends Controller
{
    // SHOW ALL
    public function index(){
        $histori_stok = HistoriStok::join('stok_bahan', 'histori_stok.id_bahan', '=' ,'stok_bahan.id_bahan') -> select('histori_stok.*', 'stok_bahan.*') -> get();

        if(count($histori_stok) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $histori_stok
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'daa' => null
        ], 404);
    }

    // SHOW BY ID
    public function showByID($id){
        $histori_stok = HistoriStok::select('*')->where('id_bahan', '=', $id)->get();
        if($histori_stok->isEmpty()){
            return response([
                'message' => 'Detail Stok Bahan Not Found',
                'data' => null
            ], 404);
        } else {
            return response([
                'message' => 'Retrieve Detail Stok Bahan Success',
                'data' => $histori_stok
            ], 200);
        }
    }

    // CREATE
    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'id_bahan' => 'required|numeric',
            'tgl_masuk_stok' => 'required|date_format:Y-m-d',
            'tgl_keluar_stok' => 'required|date_format:Y-m-d',
            'remaining_stok' => 'nullable|numeric',
            'waste_stok' => 'nullable|numeric',
            'incomming_stok' => 'nullable|numeric'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $histori_stok = HistoriStok::create($storeData);
        return response([
            'message' => 'Create Histori Stok Bahan Success',
            'data' => $histori_stok,
        ], 200);
    }

    //TODO CALCULATE REMAINING


    //TODO CALCULATE WASTE

    
    // UPDATE
    public function update(Request $request, $id){
        $histori_stok = HistoriStok::find($id);
        if(is_null($histori_stok)){
            return response([
                'message' => 'Detail Stok Bahan Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'id_bahan' => 'required|numeric',
            'tgl_masuk_stok' => 'required|date_format:Y-m-d',
            'tgl_keluar_stok' => 'required|date_format:Y-m-d',
            'remaining_stok' => 'nullable|numeric',
            'waste_stok' => 'nullable|numeric',
            'incomming_stok' => 'nullable|numeric'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $histori_stok->id_bahan = $updateData['id_bahan'];
        $histori_stok->tgl_masuk_stok = $updateData['tgl_masuk_stok'];
        $histori_stok->tgl_keluar_stok = $updateData['tgl_keluar_stok'];
        $histori_stok->incomming_stok = $updateData['incomming_stok'];
        if(!empty($updateData['remaining_stok']))
            $histori_stok->remaining_stok = $updateData['remaining_stok'];
        if(!empty($updateData['waste_stok']))
            $histori_stok->waste_stok = $updateData['waste_stok'];

        if($histori_stok->save()){
            return response([
                'message' => 'Update Detail Stok Bahan Success',
                'data' => $histori_stok,
            ], 200);
        }
        
        return response([
            'message' => 'Update Detail Stok Bahan Failed',
            'data' => null
        ], 400);
    }

    // DELETE
    public function destroy($id){
        $histori_stok = HistoriStok::find($id);

        if(is_null($histori_stok)){
            return response([
                'message' => 'Stok Bahan Not Found',
                'data' => null
            ], 404);
        }

        if($histori_stok->delete()){
            return response([
                'message' => 'Delete Detail Stok Bahan Success',
                'data' => $histori_stok
            ], 200);
        }

        return response([
            'message' => 'Delete Detail Stok Bahan Failed',
            'data' => null
        ], 400);
    }
}
