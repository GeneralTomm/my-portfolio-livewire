<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Kontak_kami extends Controller
{
    public function index(){
        return view('kontak-kami.kontak');
    }
}
