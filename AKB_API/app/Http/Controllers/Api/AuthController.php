<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;

use Illuminate\Support\Facades\Auth;

use Validator;

class AuthController extends Controller
{
   
    public function login(Request $request) {
        $loginData = $request -> all();
        $validate = Validator::make($loginData, [
            'email_karyawan' => 'required',
            'password' => 'required'
        ]);

        if($validate -> fails())
            return response(['message' => $validate -> errors()], 400);

        if(!Auth::attempt($loginData)){
            return response(['message' => 'Email/Password Salah'], 401);
        }

        $karyawan = Auth::user();

        if ($karyawan -> status == 'non-aktif') {
            return response(['message' => 'Akun Tidak Aktif'], 400);
        }
        
        $token = $karyawan -> createToken('Authentication Token') -> accessToken;

        return response([
            'message' => 'Authenticated',
            'user' => $karyawan,
            'token_type' => 'Bearer',
            'access_token' => $token
        ]);
    }

    // public function logout (Request $request) {
    //     $logout = $request->user()->token()->revoke();
    //     if($logout){
    //         return response()->json([
    //             'message' => 'Successfully logged out'
    //         ]);
    //     }
    // }

}
