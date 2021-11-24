<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{

    public function index()
    {
        $barang = DB::table('data_barang_20200120039')->paginate(4);

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
        $barang = DB::table('data_barang_20200120039')->where('id_barang', $id)->first();
        return view('edit', compact('barang'));
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
        $barang = DB::table('data_barang_20200120039')->where('id_barang', $id)->first();
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'jenis_barang' => 'required',
            'harga' => 'required',
            'jumlah' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            File::delete('images/' . $barang->gambar);
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images'), $imageName);
            $request->gambar = $imageName;
        } else {
            $imageName = $barang->gambar;
        }

        $barang = DB::table('data_barang_20200120039')->where('id_barang', $id)->update(
            [
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'jenis_barang' => $request->jenis_barang,
                'jumlah' => $request->jumlah,
                'harga' => $request->harga,
                'gambar' => $imageName,
            ]
        );
        return back()->with('success', ' Barang berhasil diedit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = DB::table('data_barang_20200120039')->where('id_barang', $id)->first();
        File::delete('images/' . $barang->gambar);
        DB::table('data_barang_20200120039')->where('id_barang', $id)->delete();

        return back()->with('success', 'Barang berhasil didelete');
    }
}
