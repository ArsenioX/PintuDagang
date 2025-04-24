@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #f2f2f2;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            background-color: #fff;
            border: none;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
            margin-top: 40px;
        }

        h2 {
            color: #03ac0e;
            font-weight: bold;
            margin-bottom: 30px;
        }

        label {
            font-weight: 500;
            color: #333;
        }

        .form-control {
            border-radius: 8px;
            margin-bottom: 15px;
            padding: 10px 14px;
            border: 1px solid #ccc;
        }

        .btn-primary {
            background-color: #03ac0e;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            padding: 10px 20px;
        }

        .btn-primary:hover {
            background-color: #02940d;
        }

        .preview-img {
            margin-top: 10px;
            width: 120px;
            height: auto;
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 5px;
            background-color: #fff;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <h2>Edit Produk</h2>
                    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Kode Produk</label>
                            <input type="text" name="kode_produk" class="form-control" value="{{ $produk->kode_produk }}" required>
                        </div>
                        <div>
                            <label for="kategori_id">Kategori</label>
                            <select name="kategori_id" class="form-control">
                                <option value="">- Pilih Kategori -</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ (old('kategori_id') ?? ($produk->kategori_id ?? '')) == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" name="nama" class="form-control" value="{{ $produk->nama }}" required>
                        </div>

                        <div class="form-group">
                            <label>Harga per Kilo (Rp)</label>
                            <input type="number" name="harga" class="form-control" value="{{ $produk->harga }}" required>
                        </div>

                        <div class="form-group">
                            <label>Foto Produk</label>
                            <input type="file" name="foto" class="form-control">
                            @if($produk->foto)
                                <img src="{{ asset($produk->foto) }}" class="preview-img">
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Update Produk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
