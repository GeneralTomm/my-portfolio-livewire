<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\StokBahan;

class StokBahanController extends Controller
{
    public function store(Request $request) {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            // 'id_bahan' => 'required',
            'nama_bahan' => 'required',
            'jumlah_stok' => 'required',
            'harga_bahan' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $bahan = StokBahan::create($storeData);
        return response([
            'meesage' => 'Berhasil menambahkan Bahan ',
            'data' => $bahan,
        ],200);    
    }

    public function show($cari_bahan) {
        $bahan = StokBahan::find($cari_bahan);

        if(!is_null($bahan)){
            return response ([
                'message' => 'Retrive bahan By ID Success',
                'data' => $bahan
            ],200);
        }

        return response([
            'message' => 'bahan not found',
            'data' => null
        ],404);
    }

    public function update(Request $request, $cari_bahan) {
        $bahan = StokBahan::find($cari_bahan);
        if(is_null($bahan)) {
            return response([
                'message' => 'bahan tidak ditemukan',
                'data' =>null
            ],404); 
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            // 'id_bahan' => 'required',
            'nama_bahan' => 'required',
            'jumlah_stok' => 'required',
            'harga_bahan' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $bahan ->nama_bahan = $updateData['nama_bahan'];
        
        if($bahan->save()) {
            return response ([
                'message' => 'Update bahan Succes',
                'data' => $bahan,
            ],200);

        return response ([
            'message' => 'Update Bahan failes',
            'data' => null,
        ],400);    
        }
    }    

    public function index(){
        $bahan = StokBahan::all();
        $bahanCount = $bahan -> count();
        if(count($bahan)>0){
            return response ([
                'count' => $bahanCount,
                'message' => 'Retrieve All Success',
                'data' => $bahan
            ],200);
        }

        return response([
            'data' => null
        ],404);
    }
    
    public function destroy($cari_bahan) {
        $bahan = StokBahan::find($cari_bahan)->delete();
        if(!is_null($bahan)){
            return response ([
                'message' => 'Delete Bahan success',
                'data' => $bahan
            ],200);
        }

        return response ([
            'message' => 'Bahan not found',
            'data' => null
        ],404);
    }
}