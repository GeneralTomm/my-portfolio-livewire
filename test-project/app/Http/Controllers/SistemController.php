<?php

namespace App\Http\Controllers;

use App\Models\Sistem;
use Illuminate\Http\Request;

class SistemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sistems = Sistem::latest()->paginate(10);
        return view('sistem.index', compact('sistems', $sistems));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sistem.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode'  => 'required|max:10',
            'nama'  => 'required',
            'sektor'  => 'required',
            'papan'  => 'required',
            'lembar'  => 'required',
            'lot'  => 'required',
        ]);

        $sistemku = Sistem::create([
        'kode'       => $request->input('kode'),
        'nama'   => $request->input('nama'),
        'sektor'   => $request->input('sektor'),
        'papan'           => $request->input('papan'),
        'lembar'           => $request->input('lembar'),
        'lot'           => $request->input('lot'),
        ]);

        return redirect()->route('sistem.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sistem = Sistem::find($id);
        return view('sistem.edit',compact('sistem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode'  => 'required|max:10',
            'nama'  => 'required',
            'sektor'  => 'required',
            'papan'  => 'required',
            'lembar'  => 'required',
            'lot'  => 'required',
        ]);

        $dataSistem = Sistem::create([
        'kode'       => $request->input('kode'),
        'nama'   => $request->input('nama'),
        'sektor'   => $request->input('sektor'),
        'papan'           => $request->input('papan'),
        'lembar'           => $request->input('lembar'),
        'lot'           => $request->input('lot'),
        ]);

        $sistem->update($dataSistem);

        return redirect()->route('sistem.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sistem = Sistem::find($id);
        $sistem->delete();

        return redirect()->route('sistem.index');
    }
}
