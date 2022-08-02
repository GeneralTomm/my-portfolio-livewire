<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Role;

class RoleController extends Controller
{
    public function store(Request $request) {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            // 'id_role' => 'required',
            'nama_role' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $role = Role::create($storeData);
        return response([
            'meesage' => 'Berhasil menambahkan role karyawan',
            'data' => $role,
        ],200);    
    }

    public function show($cari_role) {
        $role = Role::find($cari_role);

        if(!is_null($role)){
            return response ([
                'message' => 'Retrive role By ID Success',
                'data' => $role
            ],200);
        }

        return response([
            'message' => 'role not found',
            'data' => null
        ],404);
    }

    public function update(Request $request, $cari_role) {
        $role = Role::find($cari_role);
        if(is_null($role)) {
            return response([
                'message' => 'role tidak ditemukan',
                'data' =>null
            ],404); 
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            // 'id_role' => 'required',
            'nama_role' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $role ->nama_role = $updateData['nama_role'];
        
        if($role->save()) {
            return response ([
                'message' => 'Update Role Succes',
                'data' => $role,
            ],200);

        return response ([
            'message' => 'Update Role failes',
            'data' => null,
        ],400);    
        }
    }    

    public function index(){
        $role = Role::all();
        $roleCount = $role -> count();
        if(count($role)>0){
            return response ([
                'count' => $roleCount,
                'message' => 'Retrieve All Success',
                'data' => $role
            ],200);
        }

        return response([
            'data' => null
        ],404);
    }
    
    public function destroy($cari_role) {
        $role = Role::find($cari_role)->delete();
        if(!is_null($role)){
            return response ([
                'message' => 'Delete Role success',
                'data' => $role
            ],200);
        }

        return response ([
            'message' => 'Role not found',
            'data' => null
        ],404);
    }
}