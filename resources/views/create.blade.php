@extends('layouts.app')
@section('title', 'Tambah Data Barang')
@section('content')
    <div class="wrapper">
        <h1>Buat Barang Baru</h1>

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

        <form method="POST" action="{{ route('barang.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="kodeBarang">Kode Barang</label>
                <input type="text" name="kode_barang" class="form-control">
            </div>
            <div class="form-group">
                <label for="namaBarang">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control">
            </div>
            <div class="form-group">
                <label for="jenisBarang">Jenis Barang</label>
                <input type="text" name="jenis_barang" class="form-control">
            </div>
            <div class="form-group">
                <label for="hargaBarang">Harga</label>
                <input type="text" name="harga" class="form-control">
            </div>
            <div class="form-group">
                <label for="jumlahBarang">Jumlah Barang</label>
                <input type="text" name="jumlah" class="form-control">
            </div>
            <div class="form-group">
                <label for="gambarBarang">Gambar Barang</label>
                <input type="file" name="gambar" class="form-control">
            </div>
            <button class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
