<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Karyawan;

use Illuminate\Support\Facades\Auth;

use Validator;

class KaryawanController extends Controller
{


    public function update(Request $request, $cari){
        $karyawan = Karyawan::find($cari);
        if(is_null($karyawan)){
            return response([
                'message' => 'karyawan Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData,[
           'nama_karyawan'  => 'required',
           'jenis_kelamin'  => 'required',
           'no_telp_karyawan' => 'required|digits_between:10,13|numeric|starts_with:08',
           'email_karyawan' => 'required|email:rfc,dns',
           'tgl_bergabung' => 'required|date_format:Y-m-d',
           'status' => 'required',
           'id_role' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $updateData['password'] = bcrypt($request->password);

        $karyawan ->nama_karyawan = $updateData['nama_karyawan'];
        $karyawan ->jenis_kelamin = $updateData['jenis_kelamin'];
        $karyawan ->no_telp_karyawan = $updateData['no_telp_karyawan'];
        $karyawan ->email_karyawan = $updateData['email_karyawan'];
        $karyawan ->tgl_bergabung = $updateData['tgl_bergabung'];
        $karyawan ->status = $updateData['status'];
        $karyawan ->id_role = $updateData['id_role'];
        $karyawan ->password = $updateData['password'];

        if($karyawan->save()){
            return response([
                'message' => 'Update karyawan Success',
                'data' => $karyawan,
            ],200);
        }

        return response([
            'message' => 'Update karyawan Failed',
            'data' => null,
            ],400);
        }

    public function index(){
        $karyawan = karyawan:: join('role_karyawan', 'karyawan.id_role', '=' ,'role_karyawan.id_Role') -> select('karyawan.*', 'nama_role') ->get();
        // $karyawan = Karyawan::all();
        $karyawanCount = $karyawan ->count();
        if(count($karyawan)>0){
            return response([
                'count' => $karyawanCount,
                'message' => 'Retrieve All Success',
                'data' => $karyawan
            ],200);
        }

        return response([
            'data' => null
        ],404);

    }
    public function indexReservasi(){
        $karyawan = karyawan::where('id_role','=','2')->where('status','=','aktif')->
                              orwhere('id_role','=','4')->where('status','=','aktif')->
                              orwhere('id_role','=','5')->where('status','=','aktif')->get();
        $karyawanCount = $karyawan ->count();
        if(count($karyawan)>0){
            return response([
                'count' => $karyawanCount,
                'message' => 'Retrieve All Success',
                'data' => $karyawan
            ],200);
        }

        return response([
            'data' => null
        ],404);

    }

    public function show($cari) {
        $karyawan = Karyawan::  join('role_karyawan', 'karyawan.id_role', '=' ,'role_karyawan.id_Role') -> select('karyawan.*', 'nama_role') ->
                            where('id_karyawan','like',$cari,'or','nama_karyawan','like','%'.$cari.'%')->get();
        //$karyawan = Karyawan::find($id_karyawan);

        if(!is_null($karyawan)) {
            return response([
                'message' => 'Retrive Karyawan Success',
                'data' => $karyawan
            ], 200);
        }

        return response([
            'message' => 'Karyawan tidak ditemukan',
            'data' => null
        ], 404);
    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData,[
            'nama_karyawan'  => 'required',
            'jenis_kelamin'  => 'required',
            'no_telp_karyawan' => 'required|digits_between:10,13|numeric|starts_with:08',
            'email_karyawan' => 'required|email:rfc,dns',
            'tgl_bergabung' => 'required|date_format:Y-m-d',
            'status' => 'required',
            'id_role' => 'required',
            'password' => 'required'
        ]);

        if($validate->no_telp_karyawan != 'numeric' )
            return response(['message' => 'no telp hanya boleh angka'],400);


        // if($validate->fails())
        //     return response(['message' => $validate->errors()],400);

        $storeData['password'] = bcrypt($request->password);

        $karyawan = Karyawan::create($storeData);
        return response([
            'message' => 'Add Karyawan Success',
            'data' => $karyawan,
        ],200);
    }

    // DEACTIVATE ACCOUNT
    public function resign($id){
        $karyawan = Karyawan::find($id);

        if(is_null($karyawan)){
            return response([
                'message' => 'Karyawan Not Found',
                'data' => null
            ], 404);
        }

        $karyawan->status = 'non-aktif';

        if($karyawan->save()){
            return response([
                'message' => 'Resign Account Success',
                'data' => $karyawan
            ], 200);
        }

        return response([
            'message' => 'Resign Account Failed',
            'data' => null
        ], 400);
    }


}
