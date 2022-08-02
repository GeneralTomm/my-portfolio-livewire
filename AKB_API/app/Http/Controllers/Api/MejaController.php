<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Meja;

class MejaController extends Controller
{
    //method untuk menampilkan semua data product (read)
    public function index() {
        $meja = Meja::all();

        if(count($meja) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $meja
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 404);
    }

    public function showAvailable() {
        $meja = Meja::where('status_meja','like','available')->get();
        if(count($meja) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $meja
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 404);
    }

    //method untuk menampilkan 1 data product (search)
    public function show($cari) {
        $meja = Meja::find($cari);

        if(!is_null($meja)) {
            return response([
                'message' => 'Retrive Meja Success',
                'data' => $meja
            ], 200);
        }

        return response([
            'message' => 'Meja Not Found',
            'data' => null
        ], 404);
    }

    //method untuk menambah 1 data product baru (create)
    public function store(Request $request) {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'no_meja' => 'required',
            'status_meja' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $meja = Meja::create($storeData);
        return response([
            'message' => 'Add Meja Success',
            'data' => $meja,
        ], 200);

    }

    //method untuk menghapus 1 data product (delete)
    public function destroy($cari) {
        $meja = Meja::find($cari);

        if(is_null($meja)) {
            return response([
                'message' => 'Meja Not Found',
                'data' => null
            ], 404);
        }

        if($meja->delete()) {
            return response([
                'message' => 'Delete meja Success',
                'data' => $meja,
            ], 200);
        }
        return response([
            'message' => 'Delete Meja Failed',
            'data' => null
        ], 400);
    }

    //method untuk mengubah 1 data product (update)
    public function update(Request $request, $cari) {
        $meja = Meja::find($cari);
        if(is_null($meja)) {
            return response([
                'message' => 'Meja Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'no_meja' => 'required',
            'status_meja' => 'required'
        ]);

        if($validate->fails())              
            return response(['message' => $validate->errors()],400);
        
        $meja -> no_meja = $updateData['no_meja'];    
        $meja -> status_meja = $updateData['status_meja'];

        if($meja->save()){
            return response([
                'message' => 'Update Meja Success',
                'data' => $meja,
            ],200);
        }

        return response([
            'message' => 'Update meja Failed',
            'data' => null,    
            ],400);
    }
    

}
