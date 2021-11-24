<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{

    public function index()
    {
        $barang = DB::table('data_barang_20200120039')->all();

        return view('index', ['barang' => $barang]);
    }
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:data_barang_20200120039,kode_barang',
            'nama_barang' => 'required',
            'jenis_barang' => 'required',
            'harga' => 'required',
            'jumlah' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->gambar->extension();

        $request->gambar->move(public_path('images'), $imageName);
        $request->gambar = $imageName;
        $input = $request->all();

        $barang = DB::table('data_barang_20200120039')->insert(
            [
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'jenis_barang' => $request->jenis_barang,
                'jumlah' => $request->jumlah,
                'harga' => $request->harga,
                'gambar' => $imageName,
            ]
        );

        return back()->with('success', ' Barang baru berhasil dibuat.');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
