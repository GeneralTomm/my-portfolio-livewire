<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\KategoriBlogModels;
use App\Http\Controllers\Controller;
use App\Http\Requests\KategoriBlogsRequest;

class KategoriBlogs extends Controller
{
    public function index()
    {   $kategoriBlogs = KategoriBlogModels::where('status', '1')->get();
        return view('Backend.KategoriBlog.index', compact('kategoriBlogs'));
    }
    public function create()
    {
        return view('Backend.KategoriBlog.create');
    }
    public function store(KategoriBlogsRequest $request){

        $validated = $request->validated();

        $kategoriBlogs = new KategoriBlogModels;
        $kategoriBlogs->nama_kategori = $request->nama_kategori;
        $kategoriBlogs->status = $request->status;
        $kategoriBlogs->hexa_colors = $request->hexa_colors;
        dd($kategoriBlogs->toArray());
        // $kategoriBlogs->save();

        return redirect()->route('kategori-blogs.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function show($id){
        $kategoriBlogs = KategoriBlogModels::find($id);
        var_dump($kategoriBlogs);
        return view('Backend.KategoriBlog.edit', compact('kategoriBlogs'));
    }
}
