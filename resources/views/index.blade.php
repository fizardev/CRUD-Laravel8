@extends('layouts.app')
@section('title', 'Data Barang')
@section('content')
    <div class="mt-4">
        <h1 class="float-left" style="margin-top: -5px">List Barang</h1>
        <button class="btn btn-primary float-right">[+] Tambah Barang</button>
    </div>
    <div class="wrapper">
        @if (session('success'))
            <div class="alert alert-success">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Kode Barang</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Jenis Barang</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $i => $b)
                    <tr>
                        <th scope="row">{{ ++$i }}</th>
                        <td valign="center"><img src="{{ asset('images/' . $b->gambar) }}" width="100" height="50"
                                style="object-fit: cover; object-position: center;"></td>
                        <td valign="center">{{ $b->kode_barang }}</td>
                        <td valign="center">{{ $b->nama_barang }}</td>
                        <td valign="center">{{ $b->jenis_barang }}</td>
                        <td valign="center">{{ $b->harga }}</td>
                        <td valign="center">{{ $b->jumlah }}</td>
                        <td valign="center">
                            <a href="{{ route('barang.edit', $b->id_barang) }}">Edit</a>
                            <form action="{{ route('barang.destroy', $b->id_barang) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $barang->links() }}
    </div>
@endsection
